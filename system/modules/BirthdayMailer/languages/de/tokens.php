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
 * @copyright  Cliff Parnitzky 2015
 * @author     Cliff Parnitzky
 * @package    BirthdayMailer
 * @license    LGPL
 */

/**
 * Tokens
 */
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['admin_email']                        = 'Die E-Mail Adresse des Systemsadministrators.';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaychild_*']                    = 'Alle Felder des Geburtstagskindes (ersetzen Sie * mit jedem Attribut des Mitglieds, z.B. <i>firstname</i> oder <i>company</i>, das Attribut <i>password</i> ist nicht erlaubt).';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaychild_name']                 = 'Eine Kombination aus Vor- und Nachname des Geburtstagskindes.';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaychild_email']                = 'Die E-Mail Adresse des Geburtstagskindes.';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaychild_age']                  = 'Das Alter des Geburtstagskindes.';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaychild_salutation']           = 'Die Anrede für das Geburtstagskind (abhängig vom Geschlecht).';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaychild_welcoming_personally'] = 'Die persönliche Begrüßung für das Geburtstagskind (abhängig vom Geschlecht).';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaychild_welcoming_formally']   = 'Die formelle Begrüßung für das Geburtstagskind (abhängig vom Geschlecht).';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaymailer_groupname']           = 'Der Name der Mitgliedergruppe der verwendeten Geburtstagsmailer Konfiguration.';

?>