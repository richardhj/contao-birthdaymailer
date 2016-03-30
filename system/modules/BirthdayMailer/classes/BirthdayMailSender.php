<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2015 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2011-2015
 * @author     Cliff Parnitzky
 * @package    BirthdayMailer
 * @license    LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace BirthdayMailer;

use Haste\DateTime\DateTime;
use NotificationCenter\Model\Notification;

/**
 * Class BirthdayMailSender
 *
 * Provide methods to send the birthday emails
 * @copyright  Cliff Parnitzky 2011-2015
 * @author     Cliff Parnitzky
 * @package    BirthdayMailer
 */
class BirthdayMailSender extends \Controller
{

	/**
	 * Execute the sender manually from backend and get a result page.
	 */
	public function sendBirthdayMailManually()
	{
		if (TL_MODE != 'BE')
		{
			return '';
		}

		$result = $this->sendBirthdayMail();

		// Create template object
		$objTemplate = new \BackendTemplate('be_birthday-mailer');

		$objTemplate->backLink = '<a href="' . ampersand(str_replace('&key=sendBirthdayMail', '', \Environment::get('request'))) . '" class="header_back" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['backBT']) . '" accesskey="b">' . $GLOBALS['TL_LANG']['MSC']['backBT'] . '</a>';
		$objTemplate->headline = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['headline'];
		$objTemplate->sendingHeadline = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['sendingHeadline'];
		$objTemplate->success = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['successMessage'], sizeof($result['success']));

		$objTemplate->failed = sizeof($result['failed']) > 0;
		$objTemplate->failureMessage = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureMessage'], sizeof($result['failed']));
		$objTemplate->failureTableHead = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureTableHead'];
		$objTemplate->failures = $result['failed'];
		$objTemplate->failureInfo = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureInfo'];

		$objTemplate->aborted = sizeof($result['aborted']) > 0;
		$objTemplate->abortionMessage = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionMessage'], sizeof($result['aborted']));
		$objTemplate->abortionTableHead = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionTableHead'];
		$objTemplate->abortions = $result['aborted'];
		$objTemplate->abortionInfo = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionInfo'];

		if ($GLOBALS['TL_CONFIG']['birthdayMailerDeveloperMode'])
		{
			$objTemplate->developerMessage = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['developerMessage'], $GLOBALS['TL_CONFIG']['birthdayMailerDeveloperModeEmail']);
		}

		return $objTemplate->parse();
	}


	/**
	 * Sends the birthday emails.
	 */
	public function sendBirthdayMail()
	{
		$arrResult = array
		(
			'success' => array(),
			'failed'  => array(),
			'aborted' => array()
		);

		$time = time();

		$strQuerySelectDistinct = (\Config::get('birthdayMailerAllowDuplicates')) ? "" : "DISTINCT ";
		$strQueryWhereMemberActive = "m.disable<>1 AND (m.start='' OR m.start<$time) AND (m.stop='' OR m.stop>$time) ";
		$strQueryWhereMemberGroupActive = "AND mg.disable<>1 AND (mg.start='' OR mg.start<$time) AND (mg.stop='' OR mg.stop>$time) ";
		$strQueryWhereDateOfBirth = (\Config::get('birthdayMailerDeveloperMode') && \Config::get('birthdayMailerDeveloperModeIgnoreDate')) ? '' : "AND FROM_UNIXTIME(m.dateOfBirth, '%e.%m') = '" . date('d.m', $time) . "' ";

		$objResult = \Database::getInstance()->prepare(<<<SQL
SELECT {$strQuerySelectDistinct}m.*, 
		mg.name as memberGroupName, 
		tl_birthdaymailer.nc_notification as notification 
		FROM tl_member m
		JOIN tl_member_to_group ON tl_member_to_group.member_id=m.id 
		JOIN tl_member_group mg ON mg.id=tl_member_to_group.group_id 
		JOIN tl_birthdaymailer ON tl_birthdaymailer.membergroup=mg.id 
		WHERE {$strQueryWhereMemberActive}
		{$strQueryWhereMemberGroupActive}
		{$strQueryWhereDateOfBirth}
		ORDER BY m.id, tl_birthdaymailer.sorting DESC
SQL
		)
			->execute();

		if ($objResult->numRows < 1)
		{
			return array();
		}

		while ($objResult->next())
		{
			// now check via custom hook, if sending should be aborted
			$blnAbortSendMail = false;

			if (isset($GLOBALS['TL_HOOKS']['birthdayMailerAbortSendMail']) && is_array($GLOBALS['TL_HOOKS']['birthdayMailerAbortSendMail']))
			{
				foreach ($GLOBALS['TL_HOOKS']['birthdayMailerAbortSendMail'] as $callback)
				{
					$this->import($callback[0]);
					$blnAbortSendMail = $this->$callback[0]->$callback[1]($objResult, $blnAbortSendMail);
				}
			}

			if ($blnAbortSendMail)
			{
				$arrResult['aborted'][] = $objResult->row();
				continue;
			}

			if ($this->sendMail($objResult))
			{
				$arrResult['success'][] = $objResult->row();
			}
			else
			{
				$arrResult['failed'][] = $objResult->row();
			}
		}

		\System::log('BirthdayMailer: Daily sending of birthday mail finished. Send ' . sizeof($arrResult['success']) . ' emails. '
			. sizeof($arrResult['failed']) . ' emails could not be send due to errors. '
			. sizeof($arrResult['aborted']) . ' emails were aborted due to custom hooks. See birthdaymails.log for details.', __METHOD__, TL_CRON);

		return $arrResult;
	}

	/**
	 * Send an email.
	 *
	 * @param \Database\Result|object $objResult
	 *
	 * @return bool
	 */
	private function sendMail($objResult)
	{
		/** @var Notification $objNotification */
		/** @noinspection PhpUndefinedMethodInspection */
		$objNotification = Notification::findByPk($objResult->notification);

		// Build tokens
		$arrTokens = array();

		foreach ($objResult->row() as $field => $value)
		{
			if (in_array($field, ['memberGroupName', 'notification']))
			{
				continue;
			}

			$arrTokens['birthdaychild_' . $field] = $value;
		}
		$arrTokens['birthdaychild_name'] = trim(sprintf('%s %s', $objResult->firstname, $objResult->lastname));
		$arrTokens['birthdaychild_age'] = DateTime::createFromTimestamp($objResult->dateOfBirth)->getAge();
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


	/**
	 * Delete an according configuration, if the member group is deleted.
	 */
	public function deleteConfiguration(\DataContainer $dc)
	{
		\Database::getInstance()->prepare("DELETE FROM tl_birthdaymailer WHERE memberGroup = ?")
			->execute($dc->id);
	}


	/**
	 * Replaces all insert tags for the email text.
	 * @deprecated
	 */
	private function replaceBirthdayMailerInsertTags($text, $config, $language)
	{
		$textArray = preg_split('/\{\{([^\}]+)\}\}/', $text, -1, PREG_SPLIT_DELIM_CAPTURE);

		for ($count = 0; $count < count($textArray); $count++)
		{
			$parts = explode("::", $textArray[$count]);
			switch ($parts[0])
			{
				case 'birthdaychild':
					switch ($parts[1])
					{
						case 'salutation':
							$salutation = $this->getSalutation($config, $language, 'salutation_' . $config->gender);
							if (strlen($salutation) == 0)
							{
								$salutation = $this->getSalutation($config, $language, 'salutation');
							}
							$textArray[$count] = $salutation;
							break;

						case 'name':
							$textArray[$count] = trim($config->firstname . ' ' . $config->lastname);
							break;

						case 'groupname':
							$textArray[$count] = trim($config->memberGroupName);
							break;

						case 'password':
							// do not allow extracting the password
							$textArray[$count] = "";
							break;

						case 'age':
							$textArray[$count] = (date("Y") - date("Y", $config->dateOfBirth));
							break;

						default:
							$textArray[$count] = $config->$parts[1];
							break;
					}
					break;

				case 'birthdaymailer':
					switch ($parts[1])
					{
						case 'email':
							$textArray[$count] = trim($config->mailSender);
							break;

						case 'name':
							$textArray[$count] = trim($config->mailSenderName);
							break;
					}
					break;
			}
		}

		return implode('', $textArray);
	}

	/**
	 * Get the text for specific types. Fallback ist to 'default' if no text is set.
	 * FALLBACK Chain:
	 *        1. check, if there is a text for the specified textKey and language (search in
	 *        system/config/langconfig.php)
	 *        2. if nothing found, check, if there is a text for the specified textKey and 'en' (search in
	 *        system/config/langconfig.php)
	 *        3. if nothing found, get default text in specified language
	 *        4. if nothing found, get default text in language 'en'
	 * @deprecated
	 */
	private function getSalutation($config, $language, $textType)
	{
		$text = "";

		if ($config->mailUseCustomText)
		{
			$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail'][$config->mailTextKey][$textType][$language];

			if (strlen($text) == 0 && $language != self::DEFAULT_LANGUAGE)
			{
				$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail'][$config->mailTextKey][$textType][self::DEFAULT_LANGUAGE];
			}
		}

		if (strlen($text) == 0)
		{
			$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default'][$textType];
		}

		return $text;
	}
}
