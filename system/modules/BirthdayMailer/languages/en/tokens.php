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
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['admin_email']              = 'The e-mail address of administrator of the system.';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaychild_*']          = 'All the field of birthday child (replace * with any attribute of the member, e.g. <i>firstname</i> or <i>company</i>, the attribute <i>password</i> is not allowed).';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaychild_name']       = 'A combination of first and last name of the birthday child.';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaychild_email']      = 'The e-mail address of the birthday child.';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaychild_age']        = 'The age of the birthday child.';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaychild_salutation'] = 'The salutation for the birthday child (depending on gender).';
$GLOBALS['TL_LANG']['NOTIFICATION_CENTER_TOKEN']['birthday_mail']['birthdaymailer_groupname'] = 'The name of the member group of the used birthday mailer configuration.';

?>