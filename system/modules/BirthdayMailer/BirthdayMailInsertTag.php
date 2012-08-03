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
 * Class BirthdayMailInsertTag
 *
 * InsertTag hook class.
 * @copyright  Cliff Parnitzky 2011-2012
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class BirthdayMailInsertTag extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->import('BirthdayMailSender', 'Base');
	}
	
	/**
	 * Replaces the special birthday mailer insert tags.
	 */
	public function replaceBirthdayMailInsertTags($strTag)
	{
		$currentConfig = BirthdayMailSender::getCurrentConfig();
		$currentLanguage = BirthdayMailSender::getCurrentLanguage();
		$defaultLanguage = BirthdayMailSender::getDefaultLanguage();
		
		$strTag = explode('::', $strTag);
		switch ($strTag[0])
		{
			case 'birthdaychild':

				if ($currentConfig)
				{
					switch ($strTag[1])
					{
						case 'salutation':
							$this->loadLanguageFile('BirthdayMailer', $currentLanguage);
							
							$salutation = $this->getSalutation($currentConfig, $currentLanguage, $defaultLanguage, 'salutation_' . $currentConfig->gender);
							if (strlen($salutation) == 0)
							{
								$salutation = $this->getSalutation($currentConfig, $currentLanguage, $defaultLanguage, 'salutation');
							}
							return $salutation;
							
						case 'name':
							return trim($currentConfig->firstname . ' ' . $currentConfig->lastname);
							
						case 'groupname':
							return trim($currentConfig->memberGroupName);
							
						case 'password':
							// do not allow extracting the password
							return "";
							
						case 'age':
							return date("Y") - date("Y", $currentConfig->dateOfBirth);
							
						default:
							return $currentConfig->$strTag[1];
					}
				}
				
			case 'birthdaymailer':

				if ($currentConfig)
				{
					switch ($strTag[1])
					{
						case 'email': return trim($currentConfig->mailSender);
						case 'name': return trim($currentConfig->mailSenderName);
					}
				}
		}
		return false;
	}
	
	/**
	 * Get the text for specific types. Fallback ist to 'default' if no text is set.
	 * FALLBACK Chain:
	 * 		1. check, if there is a text for the specified textKey and language (search in system/config/langconfig.php)
	 *		2. if nothing found, check, if there is a text for the specified textKey and 'en' (search in system/config/langconfig.php)
	 *		3. if nothing found, get default text in specified language
	 *		4. if nothing found, get default text in language 'en'
	 */
	private function getSalutation($currentConfig, $currentLanguage, $defaultLanguage, $textType)
	{
		$text = "";

		if ($currentConfig->mailUseCustomText)
		{
			$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail'][$currentConfig->mailTextKey][$textType][$currentLanguage];
			
			if (strlen($text) == 0 && $currentLanguage != $defaultLanguage)
			{
				$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail'][$currentConfig->mailTextKey][$textType][$defaultLanguage];
			}
		}

		if (strlen($text) == 0)
		{
			$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default'][$textType];
		}

		return $text;
	}
}
?>