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
 * BirthdayMailer defaults
 */
$GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default']['salutation']        = 'Sehr geehrte/-r';
$GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default']['salutation_female'] = 'Sehr geehrte Frau';
$GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default']['salutation_male']   = 'Sehr geehrter Herr';
$GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default']['subject']           = 'Herzliche Glückwünsche zum Geburtstag';
$GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default']['text'] = '
{{birthdaychild::salutation}} {{birthdaychild::name}},

als Mitglied der Gruppe {{birthdaychild::groupname}} gratulieren wir Ihnen recht herzlich zu Ihrem {{birthdaychild::age}}. Geburtstag und
wünschen Ihnen alles erdenklich Gute, viel Glück und vor allem Gesundheit.
Genießen Sie Ihren ganz besonderen Ehrentag.

Viele Grüße, {{birthdaymailer::name}} (mailto:{{birthdaymailer::email}})
';
$GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default']['html'] = '
{{birthdaychild::salutation}} <b>{{birthdaychild::firstname}} {{birthdaychild::lastname}}</b>,
<br/><br/>
als Mitglied der Gruppe <i>{{birthdaychild::groupname}}</i> gratulieren wir Ihnen recht herzlich zu Ihrem {{birthdaychild::age}}. Geburtstag und
wünschen Ihnen alles erdenklich Gute, viel Glück und vor allem Gesundheit.<br/>
Genießen Sie Ihren ganz besonderen Ehrentag.
<br/><br/>
Viele Grüße, <a href="mailto:{{birthdaymailer::email}}">{{birthdaymailer::name}}</a>
';

?>