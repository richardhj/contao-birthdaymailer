<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
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
 * @copyright  Cliff Parnitzky 2011-2012
 * @author     Cliff Parnitzky
 * @package    BirthdayMailer
 * @license    LGPL
 * @filesource
 */

/**
 * Class BirthdayMailSender
 *
 * Provide methods to send the birthday emails
 * @copyright  Cliff Parnitzky 2011-2012
 * @author     Cliff Parnitzky
 * @package    BirthdayMailer
 */
class BirthdayMailSender extends Backend
{
	// the default language will always be englisch
	private static $defaultLanguage = 'en';

	private static $currentConfig;
	private static $currentLanguage;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Returns the actual config
	 */
	public static function getCurrentConfig()
	{
		return self::$currentConfig;
	}	

	/**
	 * Returns the actual language
	 */
	public static function getCurrentLanguage()
	{
		return self::$currentLanguage;
	}

	/**
	 * Returns the default language
	 */
	public static function getDefaultLanguage()
	{
		return self::$defaultLanguage;
	}
	
	/**
	 * Execute the sender manually from backend and get a result page.
	 */
	public function sendBirthdayMailManually()
	{
		if (TL_MODE == 'BE')
		{ 
			$result = $this->sendBirthdayMail();
			
			// Create template object
			$objTemplate = new BackendTemplate('be_birthdaymailer');

			$objTemplate->backLink = '<a href="'.ampersand(str_replace('&key=sendBirthdayMail', '', $this->Environment->request)).'" class="header_back" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['backBT']).'" accesskey="b">'.$GLOBALS['TL_LANG']['MSC']['backBT'].'</a>';
			$objTemplate->headline = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['headline'];
			$objTemplate->sendingHeadline = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['sendingHeadline'];
			$objTemplate->success = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['success'], $result['success']);
			if (sizeof($result['failed']) > 0)
			{
				$objTemplate->failed = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failed'], sizeof($result['failed']));
			}
			$objTemplate->failureHeadline = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureHeadline'];
			$objTemplate->failureArray = $result['failed'];		
			$objTemplate->failureMessage = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureMessage'];		
			if ($GLOBALS['TL_CONFIG']['birthdayMailerDeveloperMode'])
			{
				$objTemplate->developerMessage = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['developerMessage'], $GLOBALS['TL_CONFIG']['birthdayMailerDeveloperModeEmail']);
			}
			
			return $this->replaceInsertTags($objTemplate->parse());
		}
		return;
	}

	/**
	 * Sends the birthday emails.
	 */
	public function sendBirthdayMail()
	{
		// first check if required extension 'associategroups' is installed
		if (!in_array('associategroups', $this->Config->getActiveModules()))
		{
			$this->log('BirthdayMailSender: Extension "associategroups" is required!', 'BirthdayMailSender sendBirthdayMail()', TL_ERROR);
			return false;
		}

		// first check if required extension 'ExtendedEmailRegex' is installed
		if (!in_array('extendedEmailRegex', $this->Config->getActiveModules()))
		{
			$this->log('BirthdayMailSender: Extension "ExtendedEmailRegex" is required!', 'BirthdayMailSender sendBirthdayMail()', TL_ERROR);
			return false;
		}
		
		$this->import('ExtendedEmailRegex', 'Base');
		
		$alreadySendTo = array();
		$notSendCauseOfErrors = array();
		
		$config = $this->Database->prepare("SELECT tl_member.*, "
												. "tl_member_group.name as memberGroupName, tl_member_group.disable as memberGroupDisable, tl_member_group.start as memberGroupStart, tl_member_group.stop as memberGroupStop, "
												. "tl_birthdaymailer.sender as mailSender, tl_birthdaymailer.senderName as mailSenderName, tl_birthdaymailer.mailCopy as mailCopy, tl_birthdaymailer.mailBlindCopy as mailBlindCopy, "
												. "tl_birthdaymailer.mailUseCustomText as mailUseCustomText, tl_birthdaymailer.mailTextKey as mailTextKey "
												. "FROM tl_member "
												. "JOIN tl_member_to_group ON tl_member_to_group.member_id = tl_member.id "
												. "JOIN tl_member_group ON tl_member_group.id = tl_member_to_group.group_id "
												. "JOIN tl_birthdaymailer ON tl_birthdaymailer.membergroup = tl_member_group.id "
												. "ORDER BY tl_member.id, tl_birthdaymailer.priority DESC")
											 ->execute();
											
		if($config->numRows < 1)
		{
			return;
		}
		
		while($config->next())
		{
			self::$currentConfig = $config;
			if((($GLOBALS['TL_CONFIG']['birthdayMailerDeveloperMode'] && $GLOBALS['TL_CONFIG']['birthdayMailerDeveloperModeIgnoreDate'])
				|| (is_numeric($config->dateOfBirth) && date("d.m") == date("d.m", $config->dateOfBirth)))
				&& ($this->isMemberActive() && $this->isMemberGroupActive() && $this->allowSendingDuplicates($alreadySendTo)))
			{
				if ($this->sendMail())
				{
					$alreadySendTo[] =  $config->id;
				}
				else
				{
					$notSendCauseOfErrors[] =  array('id' => $config->id, 'firstname' => $config->firstname, 'lastname' => $config->lastname, 'email' => $config->email);
				}
			}
		}
		
		$this->log('BirthdayMailer: Daily sending of birthday mail finished. Send ' . sizeof($alreadySendTo) . ' emails. ' . sizeof($notSendCauseOfErrors) . ' emails could not be send. See birthdaymails.log for details.', 'BirthdayMailSender sendBirthdayMail()', TL_CRON);
		
		return array('success' => sizeof($alreadySendTo), 'failed' => $notSendCauseOfErrors);
	}
	
	/**
	 * Get the text for specific types for the email. Fallback ist to 'default' if no text is set.
	 * FALLBACK Chain:
	 * 		1. check, if there is a text for the specified textKey and language (search in system/config/langconfig.php)
	 *		2. if nothing found, check, if there is a text for the specified textKey and 'en' (search in system/config/langconfig.php)
	 *		3. if nothing found, get default text in specified language
	 *		4. if nothing found, get default text in language 'en'
	 */
	private function getEmailText ($textType)
	{
		$text = "";

		if (self::$currentConfig->mailUseCustomText)
		{
			$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail'][self::$currentConfig->mailTextKey][$textType][self::$currentLanguage];
			
			if (strlen($text) == 0 && self::$currentLanguage != $defaultLanguage)
			{
				$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail'][self::$currentConfig->mailTextKey][$textType][$defaultLanguage];
			}
		}

		if (strlen($text) == 0)
		{
			$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default'][$textType];
		}

		$textReplaced = $this->replaceInsertTags($text);
		
		if ($textReplaced)
		{
			return $textReplaced;
		}
		
		return $text;
	}
	
	/**
	 * Send an email.
	 * @return boolean
	 */
	private function sendMail()
	{
		self::$currentLanguage = self::$currentConfig->language;
		if (strlen(self::$currentLanguage) == 0)
		{
			self::$currentLanguage = self::$defaultLanguage;
		}
		
		$this->loadLanguageFile('BirthdayMailer', self::$currentLanguage);
		
		$emailSubject = self::getEmailText('subject');
		$emailText = self::getEmailText('text');
		$emailHtml = self::getEmailText('html');
	
		if ($GLOBALS['TL_CONFIG']['birthdayMailerDeveloperMode'] || $GLOBALS['TL_CONFIG']['birthdayMailerLogDebugInfo'])
		{
			$mailTextUsageOutput = self::$currentConfig->mailUseCustomText ? 'yes' : 'no';
			$this->log('BirthdayMailer: These are additional debugging information that will only be logged in developer mode.'
									 . ' | Userlanguage = ' . self::$currentConfig->language
								   . ' | used language = ' . self::$currentLanguage
								   . ' | mailTextUsage = ' . $mailTextUsageOutput
								   . ' | mailTextKey = ' . self::$currentConfig->mailTextKey
								   . ' | email = ' . self::$currentConfig->email
								   . ' | subject = ' . $emailSubject
								   . ' | text = ' . $emailText
								   . ' | html = ' . $emailHtml, 'BirthdayMailSender sendMail()', TL_CRON);
		}
		
		$objEmail = new Email();

		$objEmail->logFile = 'birthdaymails.log';
		
		$objEmail->from = self::$currentConfig->mailSender;
		if (strlen(self::$currentConfig->mailSenderName) > 0)
		{
			$objEmail->fromName = self::$currentConfig->mailSenderName;
		}
		$objEmail->subject = $emailSubject;
		$objEmail->text = $emailText;
		$objEmail->html = $emailHtml;
		
		try
		{
			$emailTo = self::$currentConfig->email;
			
			if ($GLOBALS['TL_CONFIG']['birthdayMailerDeveloperMode'])
			{
				$emailTo = $GLOBALS['TL_CONFIG']['birthdayMailerDeveloperModeEmail'];
			}
			else
			{
				if (strlen(self::$currentConfig->mailCopy) > 0)
				{
					$emailCC = ExtendedEmailRegex::getEmailsFromList(self::$currentConfig->mailCopy);
					$objEmail->sendCc($emailCC);
				}
				
				if (strlen(self::$currentConfig->mailBlindCopy) > 0)
				{
					$emailBCC = ExtendedEmailRegex::getEmailsFromList(self::$currentConfig->mailBlindCopy);
					$objEmail->sendBcc($emailBCC);
				}
				
				$emailTo = self::$currentConfig->email;			
			}
			return $objEmail->sendTo($emailTo);
		}
		catch (Swift_RfcComplianceException $e)
		{
			return false;
		}
	}

	/**
	 * Checks if the member is active.
	 * @return boolean
	 */
	private function isMemberActive()
	{
		if (self::$currentConfig->disable ||
			(strlen(self::$currentConfig->start) > 0 &&
			self::$currentConfig->start > time()) ||
			(strlen(self::$currentConfig->stop) > 0 &&
			self::$currentConfig->stop < time()))
		{
			return false;
		}
		return true;
	}

	/**
	 * Checks if the associated group is active.
	 * @return boolean
	 */
	private function isMemberGroupActive()
	{
		if (self::$currentConfig->memberGroupDisable ||
			(strlen(self::$currentConfig->memberGroupStart) > 0 &&
			self::$currentConfig->memberGroupStart > time()) ||
			(strlen(self::$currentConfig->memberGroupStop) > 0 &&
			self::$currentConfig->memberGroupStop < time()))
		{
			return false;
		}
		return true;
	}
	
	/**
	 * Checks if sending duplicate emails is allowed.
	 * @return boolean
	 */
	private function allowSendingDuplicates($alreadySendTo)
	{
		if (!$GLOBALS['TL_CONFIG']['birthdayMailerAllowDuplicates'] && in_array(self::$currentConfig->id, $alreadySendTo))
		{
			return false;
		}
		return true;
	}
	
	/**
	 * Delete an according configuration, if the member group is deleted.
	 */
	public function deleteConfiguration(DataContainer $dc)
	{
		$this->Database->prepare("DELETE FROM tl_birthdaymailer WHERE memberGroup = ?")
						 ->execute($dc->id);
	}
}

?>