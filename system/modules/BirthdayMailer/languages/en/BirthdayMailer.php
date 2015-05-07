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
 * BirthdayMailer defaults
 */
$GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default']['salutation']        = 'Dear Ms/Mr';
$GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default']['salutation_female'] = 'Dear Ms'; 
$GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default']['salutation_male']   = 'Dear Mr';
$GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default']['subject']           = 'Happy Birthday';
$GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default']['text'] = '
{{birthdaychild::salutation}} {{birthdaychild::name}},

as a member of group {{birthdaychild::groupname}}, we heartily congratulate you on your {{birthdaychild::age}}th birthday and
wish you all the very best, good luck and health in particular.
Enjoy your very special day.

Best regards, {{birthdaymailer::name}} (mailto:{{birthdaymailer::email}})
';
$GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default']['html'] = '
{{birthdaychild::salutation}} <b>{{birthdaychild::firstname}} {{birthdaychild::lastname}}</b>,
<br/><br/>
as a member of group <i>{{birthdaychild::groupname}}</i>, we heartily congratulate you on your {{birthdaychild::age}}th birthday and
wish you all the very best, good luck and health in particular.<br/>
Enjoy your very special day.
<br/><br/>
Best regards, <a href="mailto:{{birthdaymailer::email}}">{{birthdaymailer::name}}</a>
';

?>