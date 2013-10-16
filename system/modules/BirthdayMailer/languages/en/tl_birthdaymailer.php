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
 * @filesource
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['memberGroup']       = array('Membergroup', 'Please select the member group, that should receive the automatic birthday emails.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['priority']          = array('Priority', 'Please enter a priority value for this configuration. With several configurations that fit to a member, the one with the highest value will be used first.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['sender']            = array('Senderaddress', 'Please enter the e-mail address for the sender.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['senderName']        = array('Sendername', 'Please enter a individual name for the sender.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailCopy']          = array('Copy to (CC)', 'Please enter a comma-delimited list of email addresses that should receive a copy of the birthday email.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailBlindCopy']     = array('Blind copy (BCC)', 'Please enter a comma-delimited list of email addresses that should receive a blind copy of the birthday email.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailUseCustomText'] = array('Use custom email texts', 'Please select if instead of the default content (<i>salutation, subject, html, text</i>) in the email custom texts should be used.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailTextKey']       = array('Key for custom email texts', 'Please enter a key for the custom email texts. This is needed to determine the custom texts.<br/><br/>Example (insert into <i>system/config/langconfig.php</i>):<br/><code>$GLOBALS[\'TL_LANG\'][\'BirthdayMailer\'][\'mail\'][\'<b>MY_KEY</b>\'][\'subject\'][\'en\'] = \'English Custom Subject\'; </code>');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['config_legend'] = 'Configuration';
$GLOBALS['TL_LANG']['tl_birthdaymailer']['email_legend']  = 'Email settings';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['sendBirthdayMail'] = array('Manual execution', 'Execute manually sending birthday emails');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['new']              = array('New configuration', 'Create a new configuration for birthday emails');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['show']             = array('Configuration details', 'Show the details of configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['edit']             = array('Edit configuration', 'Edit configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['copy']             = array('Duplicate configuration', 'Duplicate configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['delete']           = array('Delete configuration', 'Delete configuration ID %s');

/**
 * Manual execution messages
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['headline']          = "Manual execution";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['sendingHeadline']   = "System messages";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['successMessage']    = "%s emails were sent successfully.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureMessage']    = "%s emails could not be sent due to errors.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureTableHead']  = "Errors";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureInfo']       = "Please check the Contao <b>System log</b> or the log files (<i>birthdaymails.log</i>, <i>error.log</i>) to get additional information about the errors.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionMessage']   = "%s emails could not be sent due to abortions.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionTableHead'] = "Abortions";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionInfo']      = "Please check the Contao <b>System log</b> to get additional information about the abortions.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['developerMessage']  = "You are in developermode. All emails will be send to the folowing developer email address: <i>%s</i>. Please make sure that this is a valid email address. Changes can be made in the <b>Settings</b>.";

?>