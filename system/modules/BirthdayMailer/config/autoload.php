<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package BirthdayMailer
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'BirthdayMailSender' => 'system/modules/BirthdayMailer/BirthdayMailSender.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_birthdaymailer' => 'system/modules/BirthdayMailer/templates',
));
