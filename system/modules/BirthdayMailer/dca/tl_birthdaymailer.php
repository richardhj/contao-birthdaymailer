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
			'icon'                  => 'system/modules/BirthdayMailer/assets/icon_root.png',
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
				'attributes'          => 'onclick="Backend.getScrollOffset();" style="background: url(\'system/modules/BirthdayMailer/assets/icon_execute.png\') no-repeat scroll left center transparent; margin-left: 15px; padding: 2px 0 3px 20px;"'
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
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_birthdaymailer', 'toggleIcon')
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
		'default'      => '{config_legend},memberGroup,nc_notification;{disable_legend},disable'
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
			'eval'                  => array('mandatory'=>true, 'unique'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50', 'chosen'=>true),
			'sql'                   => "int(10) unsigned NOT NULL default '0'",
			'relation'              => array('type'=>'hasOne', 'load'=>'eager')
		),
		'nc_notification' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['nc_notification'],
			'exclude'               => true,
			'inputType'             => 'select',
			'foreignKey'            => 'tl_nc_notification.title',
			'filter'                => true,
			'options_callback'      => array('tl_birthdaymailer', 'getNotificationChoices'), 
			'eval'                  => array('mandatory'=>true, 'unique'=>true, 'includeBlankOption'=>true, 'tl_class'=>'clr w50', 'chosen'=>true, 'submitOnChange'=>true),
			'wizard' => array
			(
				array('tl_birthdaymailer', 'editNotification')
			),
			'sql'                   => "int(10) unsigned NOT NULL default '0'",
			'relation'              => array('type'=>'hasOne', 'load'=>'eager')
		),
		'disable' => array
		(
			'label'                 => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['disable'],
			'exclude'               => true,
			'filter'                => true,
			'inputType'             => 'checkbox',
			'sql'                   => "char(1) NOT NULL default ''"
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
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
	
	/**
	 * Add an image to each record
	 * @param array
	 * @param string
	 * @param \DataContainer
	 * @param array
	 * @return string
	 */
	public function addIcon($row, $label, DataContainer $dc, $args)
	{
		
		$image = 'icon';

		if ($row['disable'])
		{
			$image .= '_1';
		} 

		// get group from database
		$objMemberGroup = \MemberGroupModel::findByPk($row['memberGroup']); 
		
		$memberGroupImage = 'mgroup';
		$memberGroupTitle = $GLOBALS['TL_LANG']['tl_birthdaymailer']['group_enabled'];

		if ($objMemberGroup->disable || strlen($objMemberGroup->start) && $objMemberGroup->start > time() || strlen($objMemberGroup->stop) && $objMemberGroup->stop < time())
		{
			$memberGroupImage .= '_';
			$memberGroupTitle = $GLOBALS['TL_LANG']['tl_birthdaymailer']['group_disabled'];
		}

		return sprintf('<img width="16" height="16" style="margin-left: 0px;" alt="Status icon" src="system/modules/BirthdayMailer/assets/%s.png"/> %s <img src="system/themes/%s/images/%s.gif" alt="%s" title="%s" />', $image, $label, $this->getTheme(), $memberGroupImage, $memberGroupTitle, $memberGroupTitle);
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
	
	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen(Input::get('tid')))
		{
			$this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_birthdaymailer::disable', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.$row['disable'];

		if ($row['disable'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
	}


	/**
	 * Disable/enable a configuration
	 * @param integer
	 * @param boolean
	 * @param \DataContainer
	 */
	public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
	{
		// Check permissions
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_birthdaymailer::disable', 'alexf'))
		{
			$this->log('Not enough permissions to activate/deactivate bithday mailer configuration ID "'.$intId.'"', __METHOD__, TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$objVersions = new Versions('tl_birthdaymailer', $intId);
		$objVersions->initialize();

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_birthdaymailer']['fields']['disable']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_birthdaymailer']['fields']['disable']['save_callback'] as $callback)
			{
				if (is_array($callback))
				{
					$this->import($callback[0]);
					$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, ($dc ?: $this));
				}
				elseif (is_callable($callback))
				{
					$blnVisible = $callback($blnVisible, ($dc ?: $this));
				}
			}
		}

		$time = time();

		// Update the database
		\Database::getInstance()->prepare("UPDATE tl_birthdaymailer SET tstamp=$time, disable='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
														->execute($intId);

		$objVersions->create();
		$this->log('A new version of record "tl_birthdaymailer.id='.$intId.'" has been created'.$this->getParentEntries('tl_birthdaymailer', $intId), __METHOD__, TL_GENERAL);
	}
	
	/**
	 * Get notification choices
	 *
	 * @return array
	 */
	public function getNotificationChoices()
	{
			$arrChoices = array();
			$objNotifications = \Database::getInstance()->execute("SELECT id,title FROM tl_nc_notification WHERE type='birthday_mail' ORDER BY title");

			while ($objNotifications->next()) {
					$arrChoices[$objNotifications->id] = $objNotifications->title;
			}

			return $arrChoices;
	}
	
	/**
	 * Return the edit notification wizard
	 * @param \DataContainer
	 * @return string
	 */
	public function editNotification(DataContainer $dc)
	{
		return ($dc->value < 1) ? '' : ' <a href="contao/main.php?do=nc_notifications&table=tl_nc_message&amp;id=' . $dc->value . '&amp;popup=1&amp;nb=1&amp;rt=' . REQUEST_TOKEN . '" title="' . sprintf(specialchars($GLOBALS['TL_LANG']['tl_birthdaymailer']['edit_notification'][1]), $dc->value) . '" style="padding-left:3px" onclick="Backend.openModalIframe({\'width\':768,\'title\':\'' . specialchars(str_replace("'", "\\'", sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['edit_notification'][1], $dc->value))) . '\',\'url\':this.href});return false">' . Image::getHtml('alias.gif', $GLOBALS['TL_LANG']['tl_birthdaymailer']['edit_notification'][0], 'style="vertical-align:top"') . '</a>';
	} 
}

?>