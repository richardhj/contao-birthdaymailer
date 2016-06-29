<?php
/**
 * BirthdayMailer for Contao Open Source CMS
 *
 * Copyright (c) 2011-2016 Cliff Parnitzky
 *
 * @package BirthdayMailer
 * @author  Cliff Parnitzky
 * @author  Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 */


namespace BirthdayMailer\Model;

use Haste\DateTime\DateTime;
use NotificationCenter\Model\Notification;


/**
 * Class BirthdayMailer
 * @package BirthdayMailer\Model
 */
class BirthdayMailer extends \Model
{

	/**
	 * The table name
	 *
	 * @var string
	 */
	protected static $strTable = 'tl_birthdaymailer';


	/**
	 * Send the birthday emails for the current configuration
	 *
	 * @return array
	 */
	public static function sendBirthdayMails()
	{
		$arrResult = array
		(
			'success' => array(),
			'failed'  => array(),
			'aborted' => array()
		);

		$time = time();

		/** @noinspection PhpUndefinedMethodInspection */
		$objResult = \Database::getInstance()->query(sprintf('
	SELECT%4$s m.*, mg.name as memberGroupName, %1$s.nc_notification 
		FROM %2$s m
		JOIN tl_member_to_group ON tl_member_to_group.member_id=m.id 
		JOIN %3$s mg ON mg.id=tl_member_to_group.group_id 
		JOIN %1$s ON %1$s.membergroup=mg.id 
		WHERE %5$s%6$s%7$s
		ORDER BY m.id, %1$s.sorting DESC',
				static::getTable(),
				\MemberModel::getTable(),
				\MemberGroupModel::getTable(),
				// Select distinct
				\Config::get('birthdayMailerAllowDuplicates') ? "" : " DISTINCT",
				// Only active members
				"m.disable<>1 AND (m.start='' OR m.start<$time) AND (m.stop='' OR m.stop>$time) ",
				// Only active member groups
				"AND mg.disable<>1 AND (mg.start='' OR mg.start<$time) AND (mg.stop='' OR mg.stop>$time) ",
				// Only birthday members if not in developer mode
				(\Config::get('birthdayMailerDeveloperMode') && \Config::get('birthdayMailerDeveloperModeIgnoreDate')) ? '' : "AND FROM_UNIXTIME(m.dateOfBirth, '%e.%m') = '" . date('d.m', $time) . "' "
			)
		);

		if ($objResult->numRows < 1)
		{
			return array();
		}

		while ($objResult->next())
		{
			// now check via custom hook, if sending should be aborted
			$blnAbortSendMail = false;

//			if (isset($GLOBALS['TL_HOOKS']['birthdayMailerAbortSendMail']) && is_array($GLOBALS['TL_HOOKS']['birthdayMailerAbortSendMail']))
//			{
//				foreach ($GLOBALS['TL_HOOKS']['birthdayMailerAbortSendMail'] as $callback)
//				{
//					$this->import($callback[0]);
//					$blnAbortSendMail = $this->$callback[0]->$callback[1]($objResult, $blnAbortSendMail);
//				}
//			}

			if ($blnAbortSendMail)
			{
				$arrResult['aborted'][] = $objResult->row();
				continue;
			}

			if (static::sendMail($objResult))
			{
				$arrResult['success'][] = $objResult->row();
			}
			else
			{
				$arrResult['failed'][] = $objResult->row();
			}
		}

		return $arrResult;
	}


	/**
	 * Send an email.
	 *
	 * @param \Database\Result|object $objResult
	 *
	 * @return bool
	 */
	protected static function sendMail($objResult)
	{
		/** @var Notification $objNotification */
		/** @noinspection PhpUndefinedMethodInspection */
		$objNotification = Notification::findByPk($objResult->nc_notification);

		// Build tokens
		$arrTokens = array();
		$objDateOfBirth = new DateTime('@' . $objResult->dateOfBirth);

		foreach ($objResult->row() as $field => $value)
		{
			if (in_array($field, ['memberGroupName', 'nc_notification']))
			{
				continue;
			}

			$arrTokens['birthdaychild_' . $field] = $value;
		}

		$arrTokens['birthdaychild_name'] = trim(sprintf('%s %s', $objResult->firstname, $objResult->lastname));
		$arrTokens['birthdaychild_age'] = $objDateOfBirth->getAge();
//		$arrTokens['birthdaychild_salutation'] =
//		$arrTokens['birthdaychild_welcoming_personally']
//		$arrTokens['birthdaychild_welcoming_formally']
//		$arrTokens['birthdaymailer_groupname']

		if (null !== $objNotification)
		{
			$objNotification->send($arrTokens);

			return true;
		}

		return false;
	}
}
