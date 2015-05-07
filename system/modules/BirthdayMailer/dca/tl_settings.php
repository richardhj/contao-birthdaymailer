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
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'birthdayMailerDeveloperMode';
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{birthdayMailer_legend},birthdayMailerAllowDuplicates, birthdayMailerLogDebugInfo, birthdayMailerDeveloperMode;';
$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['birthdayMailerDeveloperMode'] = 'birthdayMailerDeveloperModeEmail, birthdayMailerDeveloperModeIgnoreDate';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['birthdayMailerAllowDuplicates'] = array(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerAllowDuplicates'],
	'inputType' => 'checkbox',
	'eval'      => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['birthdayMailerLogDebugInfo'] = array(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerLogDebugInfo'],
	'inputType' => 'checkbox',
	'eval'      => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['birthdayMailerDeveloperMode'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerDeveloperMode'],
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 clr')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['birthdayMailerDeveloperModeEmail'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerDeveloperModeEmail'],
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'rgxp'=>'email', 'tl_class'=>'w50 clr')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['birthdayMailerDeveloperModeIgnoreDate'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerDeveloperModeIgnoreDate'],
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50')
);

?>