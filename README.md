[![Latest Version on Packagist](http://img.shields.io/packagist/v/cliffparnitzky/birthday-mailer.svg?style=flat)](https://packagist.org/packages/cliffparnitzky/birthday-mailer)
[![Installations via composer per month](http://img.shields.io/packagist/dm/cliffparnitzky/birthday-mailer.svg?style=flat)](https://packagist.org/packages/cliffparnitzky/birthday-mailer)
[![Installations via composer total](http://img.shields.io/packagist/dt/cliffparnitzky/birthday-mailer.svg?style=flat)](https://packagist.org/packages/cliffparnitzky/birthday-mailer)

Contao Extension: BirthdayMailer
================================

Sends a birthday e-mail to all the members having their birthday on the current day.


Installation
------------

Install the extension via composer: [cliffparnitzky/birthday-mailer](https://packagist.org/packages/cliffparnitzky/birthday-mailer).

If you prefer to install it manually, download the latest release here: https://github.com/cliffparnitzky/BirthdayMailer/releases


Tracker
-------

https://github.com/cliffparnitzky/BirthdayMailer/issues


Compatibility
-------------

- min. Contao version: >= 3.2.0
- max. Contao version: <  3.5.0


Dependency
----------

- This extension is dependent on the following extensions: [[contao-legacy/associategroups]](https://legacy-packages-via.contao-community-alliance.org/packages/contao-legacy/associategroups)


Simple tokens
-------------
```
##admin_email## ... returns the e-mail address of administrator of the system
##birthdaychild_*## ... returns all the field of birthday child (replace * with any attribute of the member, e.g. firstname or company, the attribute password is not allowed)
##birthdaychild_name## ... returns a combination of first and last name of the birthday child
##birthdaychild_email## ... returns the e-mail address of the birthday child
##birthdaychild_age## ... returns the age of the birthday child
##birthdaychild_salutation## ... returns the salutation for the birthday child (depending on gender)
##birthdaymailer_groupname## ... returns the name of the member group of the used birthdaymailer configuration
```


Hooks
-----

### birthdayMailerAbortSendMail

The "birthdayMailerAbortSendMail" hook is triggered for for checking if a birthday mail should be send. So custom checking for each birthday child is possible.
It passes `$birthdayChildConfig` (the config of the current birthday child) and `$blnAbortSendMail` (the current value, if sending should be aborted).
It expects a boolean return value.

```
// config.php

$GLOBALS['TL_HOOKS']['birthdayMailerAbortSendMail'][]   = array('MyClass', 'myAbortSendMail');

// MyClass.php

class MyClass
{
	public function myAbortSendMail($birthdayChildConfig, $blnAbortSendMail)
	{
		if ($blnAbortSendMail !== TRUE && $birthdayChildConfig->id == 1)
		{
			$blnAbortSendMail = true;
			$this->log('SEnding birthday mail to member with id "1" was aborted.', 'MyClass myAbortSendMail()', TL_INFO);
		}
		return $blnAbortSendMail;
	}
}
```