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
 * Table tl_birthdaymailer
 */
$GLOBALS['TL_DCA']['tl_birthdaymailer'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'           => 'Table',
		'enableVersioning'        => true
	),

	// List
	'list' => array
	(
		'sorting' => array (
			'panelLayout'           => 'filter,limit',
			'fields'                => array('priority'),
			'flag'                  => 2,
			'mode'                  => 1,
			'disableGrouping'       => true
		),
		'label' => array
		(
			'fields'                => array('memberGroup:tl_member_group.name', 'priority'),
			'format'                => '%s <span style="color:#b3b3b3; padding-left:3px;">[' . $GLOBALS['TL_LANG']['tl_birthdaymailer']['priority'][0] . ': %s]</span>',
			'label_callback'        => array('tl_birthdaymailer', 'addIcon') 
		),
		'global_operations' => array
		(
			'sendBirthdayMail' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['sendBirthdayMail'],
				'href'                => 'key=sendBirthdayMail',
				'attributes'          => 'onclick="Backend.getScrollOffset();" style="background: url(system/modules/BirthdayMailer/html/sendBirthdayMail.png) no-repeat scroll left center transparent; padding: 2px 0 3px 20px;"'
			),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__' => array('mailUseCustomText'),
		'default'      => '{config_legend},memberGroup,priority;{email_legend},sender,senderName,mailCopy,mailBlindCopy,mailUseCustomText'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'mailUseCustomText' => 'mailTextKey'
	),


	// Fields
	'fields' => array
	(
		'memberGroup' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['memberGroup'],
			'exclude'               => true,
			'inputType'             => 'select',
			'foreignKey'            => 'tl_member_group.name',
			'filter'                => true,
			'eval'                  => array('mandatory'=>true, 'unique'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50')
		),
		'priority' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['priority'],
			'exclude'               => true,
			'inputType'             => 'text',
			'eval'                  => array('rgxp' => 'digit','maxlength'=>10, 'tl_class'=>'w50')
		),
		'sender' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['sender'],
			'exclude'               => true,
			'inputType'             => 'text',
			'eval'                  => array('mandatory'=>true, 'rgxp' => 'email','maxlength'=>128, 'tl_class'=>'w50')
		),
		'senderName' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['senderName'],
			'exclude'               => true,
			'inputType'             => 'text',
			'eval'                  => array('rgxp' => 'extnd','maxlength'=>128, 'tl_class'=>'w50')
		),
		'mailCopy' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailCopy'],
			'exclude'               => true,
			'inputType'             => 'text',
			'eval'                  => array('rgxp' => 'emailList','maxlength'=>255, 'tl_class'=>'w50')
		),
		'mailBlindCopy' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailBlindCopy'],
			'exclude'               => true,
			'inputType'             => 'text',
			'eval'                  => array('rgxp' => 'emailList','maxlength'=>255, 'tl_class'=>'w50')
		),
		'mailUseCustomText' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailUseCustomText'],
			'exclude'               => true,
			'inputType'             => 'checkbox',
			'eval'                  => array('tl_class'=>'w50', 'submitOnChange'=>true)
		),
		'mailTextKey' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailTextKey'],
			'exclude'               => true,
			'inputType'             => 'text',
			'eval'                  => array('mandatory'=>true, 'maxlength'=>20, 'spaceToUnderscore'=>true, 'tl_class'=>'w50')
		)
	)
);

/**
 * Class tl_birthdaymailer
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2011
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_birthdaymailer extends Backend
{
	/**
	 * Add an image to each record
	 * @param array
	 * @param string
	 * @return string
	 */
	public function addIcon($row, $label)
	{
		 $memberGroupId = $row['memberGroup']; 
 
        // get group from database
        $memberGroup = $this->Database->prepare("SELECT * FROM tl_member_group WHERE id=?") 
                               ->execute($memberGroupId);
		
		$image = 'mgroup';

		if ($memberGroup->disable || strlen($memberGroup->start) && $memberGroup->start > time() || strlen($memberGroup->stop) && $memberGroup->stop < time())
		{
			$image .= '_';
		}

		return sprintf('<div class="list_icon" style="background-image:url(\'system/themes/%s/images/%s.gif\');">%s</div>', $this->getTheme(), $image, $label);
	}
} 

?>