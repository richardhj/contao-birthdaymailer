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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['memberGroup']       = array('Mitgliedergruppe', 'Bitte wählen Sie die Mitgliedergruppe aus, die automatische Geburtstagsemails erhalten soll.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['priority']          = array('Priorität', 'Bitte geben Sie einen Prioritätswert für diese Konfiguration ein. Bei mehreren Konfigurationen, die für ein Mitglied zutreffen, wird immer die mit dem höchsten Wert zuerst verwendet.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['sender']            = array('Absenderadresse', 'Bitte geben Sie die E-Mail-Adresse für den Absender ein.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['senderName']        = array('Absendername', 'Bitte geben Sie einen individuellen Namen für den Absender ein.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailCopy']          = array('Kopie an (CC)', 'Bitte geben Sie eine Liste kommagetrennter E-Mail-Adressen an, die eine Kopie der Geburtstagsemail erhalten sollen.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailBlindCopy']     = array('Blindkopie an (BCC)', 'Bitte geben Sie eine Liste kommagetrennter E-Mail-Adressen an, die eine Blindkopie der Geburtstagsemail erhalten sollen.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailUseCustomText'] = array('Eigene E-Mail Texte verwenden', 'Bitte geben Sie ob statt der Standardinhalte (<i>Anrede, Betreff, HTML, Text</i>) in der E-Mail eigene Texte verwendet werden sollen.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailTextKey']       = array('Schlüssel für eigene E-Mail Texte', 'Bitte geben Sie den Schlüssel für die eigenen E-Mail Texte. Dieser wird benötigt um die eigenen Texte zu ermitteln.<br/><br/>Beispiel (Eintrag in <i>system/config/langconfig.php</i>):<br/><code>$GLOBALS[\'TL_LANG\'][\'BirthdayMailer\'][\'mail\'][\'<b>MEIN_SCHLUESSEL</b>\'][\'subject\'][\'en\'] = \'English Custom Subject\'; </code>');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['config_legend'] = 'Konfiguration';
$GLOBALS['TL_LANG']['tl_birthdaymailer']['email_legend']  = 'Emaileinstellungen';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['sendBirthdayMail'] = array('Manuelle Ausführung', 'Senden der Geburtstagsmails manuell ausführen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['new']              = array('Neue Konfiguration', 'Eine neue Konfiguration für Geburtstagsmails anlegen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['show']             = array('Konfigurationsdetails', 'Details der Konfiguration ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['edit']             = array('Konfiguration bearbeiten', 'Konfiguration ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['copy']             = array('Konfiguration duplizieren', 'Konfiguration ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['delete']           = array('Konfiguration löschen', 'Konfiguration ID %s löschen');

/**
 * Manual execution messages
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['headline']         = "Manuelle Ausführung";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['sendingHeadline']  = "Systemnachrichten";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['success']          = "%s E-Mails wurden erfolgreich versendet";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failed']           = "%s E-Mails konnten nicht gesendet werden";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureHeadline']  = "Fehler";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureMessage']   = "Bitte prüfen Sie das Contao <b>System-Log</b> oder die Log-Dateien (<i>birthdaymails.log</i>, <i>error.log</i>) um weitere Informationen zu den Fehlern zu erhalten.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['developerMessage'] = "Sie befinden sich im Entwicklermodus. Alle E-Mails werden an die folgende Entwickler E-Mail-Adresse gesendet: <i>%s</i>. Bitte stellen Sie sicher, dass dies eine gültige E-Mail-Adresse ist. Änderungen können in den <b>Einstellungen</b> vorgenommen werden.";

?>