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
 * Table tl_birthdaymailer
 */
$GLOBALS['TL_DCA']['tl_birthdaymailer'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'           => 'Table',
		'enableVersioning'        => true,
		'label'                   => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['root_label'],
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		),
	),

	// List
	'list' => array
	(
		'sorting' => array (
			'mode'                  => 5,
			'fields'                => array('sorting'),
			'flag'                  => 11,
			'panelLayout'           => 'filter,limit',
			'paste_button_callback' => array('tl_birthdaymailer', 'pasteConfig'),
			'icon'                  => 'system/modules/BirthdayMailer/assets/icon.png',
		),
		'label' => array
		(
			'fields'                => array('memberGroup:tl_member_group.name'),
			'format'                => '%s',
			'label_callback'        => array('tl_birthdaymailer', 'addIcon') 
		),
		'global_operations' => array
		(
			'sendBirthdayMail' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['sendBirthdayMail'],
				'href'                => 'key=sendBirthdayMail',
				'attributes'          => 'onclick="Backend.getScrollOffset();" style="background: url(system/modules/BirthdayMailer/assets/sendBirthdayMail.png) no-repeat scroll left center transparent; margin-left: 15px; padding: 2px 0 3px 20px;"'
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
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset()"', 
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
		'default'      => '{config_legend},memberGroup'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                   => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'sorting' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['MSC']['sorting'],
			'sorting'               => true,
			'flag'                  => 11,
			'sql'                   => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                   => "int(10) unsigned NOT NULL default '0'"
		),
		'memberGroup' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['memberGroup'],
			'exclude'               => true,
			'inputType'             => 'select',
			'foreignKey'            => 'tl_member_group.name',
			'filter'                => true,
			'eval'                  => array('mandatory'=>true, 'unique'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'                   => "int(10) unsigned NOT NULL default '0'",
			'relation'              => array('type'=>'hasOne', 'load'=>'eager')
		)
	)
);

/**
 * Class tl_birthdaymailer
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2011-2015
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

		return sprintf('<img width="18" height="18" style="margin-left: 0px;" alt="" src="system/themes/%s/images/%s.gif"/> %s', $this->getTheme(), $image, $label);
		//return sprintf('<div class="list_icon" style="background-image:url(\'system/themes/%s/images/%s.gif\');">%s</div>', $this->getTheme(), $image, $label);
	}
	
	/**
	 * Return the paste button
	 * @param object
	 * @param array
	 * @param string
	 * @param boolean
	 * @param array
	 * @return string
	 */
	public function pasteConfig(DataContainer $dc, $row, $table, $cr, $arrClipboard=false)
	{
		$this->import('BackendUser', 'User');
		$imagePasteAfter = $this->generateImage('pasteafter.gif', sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteafter'][1], $row['id']));
		$imagePasteInto = $this->generateImage('pasteinto.gif', sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteinto'][1], $row['id']));
		if ($row['id'] == 0)
		{
			return $cr ? $this->generateImage('pasteinto_.gif').' ' : '<a href="'.$this->addToUrl('act='.$arrClipboard['mode'].'&mode=2&pid='.$row['id'].'&id='.$arrClipboard['id']).'" title="'.specialchars(sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteinto'][1], $row['id'])).'" onclick="Backend.getScrollOffset();">'.$imagePasteInto.'</a> ';
		}
		return (($arrClipboard['mode'] == 'cut' && $arrClipboard['id'] == $row['id']) || $cr) ? $this->generateImage('pasteafter_.gif').' ' : '<a href="'.$this->addToUrl('act='.$arrClipboard['mode'].'&mode=1&pid='.$row['id'].'&id='.$arrClipboard['id']).'" title="'.specialchars(sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteafter'][1], $row['id'])).'" onclick="Backend.getScrollOffset();">'.$imagePasteAfter.'</a> ';
	}
} 

?>