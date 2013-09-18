<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2013 Leo Feyer
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
 * @copyright  Cliff Parnitzky 2011-2013
 * @author     Cliff Parnitzky
 * @package    BirthdayMailer
 * @license    LGPL
 */
 
$GLOBALS['TL_LANG']['tl_settings']['birthdayMailer_legend']                 = "Geburtstagsmailer";
$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerAllowDuplicates']         = array('Duplikate erlauben', 'Wenn diese Option gewählt ist, werden Geburtstagsmails an ein und dasselbe Mitglieder mit mehreren konfigurierten Mitgliedergruppen mehrfach gesendet (das Mitglieder bekommt dann mehrere Geburtstagsmails).');
$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerLogDebugInfo']            = array('Zusätzliche Debug Informationen loggen', 'Wenn diese Option gewählt ist, werden zusätzliche Debug Informationen im System-Log eingetragen (pro E-Mail die versendet werden soll ein Eintrag mit allen Inhalten).');
$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerDeveloperMode']           = array('Entwicklermodus', 'Aktiviert den Entwicklermodus. Emails gehen nur an die Entwickler E-Mail-Adresse.');
$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerDeveloperModeEmail']      = array('Entwickler E-Mail-Adresse', 'Im Entwicklermodus werden alle E-Mails an diese Adresse umgeleitet.');
$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerDeveloperModeIgnoreDate'] = array('Geburtsdatum ignorieren', 'Umgeht die Prüfung ob ein Mitglied am aktuellen Tag Geburtstag hat. Es wird für jedes aktive Mitglied eine Email gesendet.');

?>