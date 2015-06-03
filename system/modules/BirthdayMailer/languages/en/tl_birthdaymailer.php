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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['memberGroup']       = array('Membergroup', 'Please select the member group, that should receive the automatic birthday emails.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['config_legend'] = 'Configuration';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['sendBirthdayMail'] = array('Manual execution', 'Execute manually sending birthday emails');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['new']              = array('New configuration', 'Create a new configuration for birthday emails');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['show']             = array('Configuration details', 'Show the details of configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['edit']             = array('Edit configuration', 'Edit configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['copy']             = array('Duplicate configuration', 'Duplicate configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['cut']              = array('Move configuration', 'Move configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['delete']           = array('Delete configuration', 'Delete configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['pasteafter']       = array('Paste after', 'Paste after configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['pasteinto']        = array('Paste on top', 'Paste on top');

/**
 * Misc texts
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['root_label'] = 'Birthday mailer configurations';

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