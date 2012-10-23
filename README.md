Contao Birthday Mailer Extension
================================

Sends a birthday e-mail to all the members having their birtday on the current day.


Installation
------------

The extension can be installed using the Contao extension manager in the Contao
back end. If you prefer to install it manually, download the files here:

http://www.contao.org/en/extension-list/view/BirthdayMailer.html


Tracker
-------

https://github.com/cliffparnitzky/BirthdayMailer/issues


Compatibility
-------------

- min. version: Contao 2.9.5
- max. version: Contao 2.10.4


Inserttags
----------

    {{birthdaychild::*}} ... This tag returns all the values of the current member (replace * with any attribute of the member, e.g. firstname or company, the attribute password is not allowed).
    {{birthdaychild::salutation}} ... This tag returns the salutation of the member (depending on gender).
    {{birthdaychild::name}} ... This tag returns first and last name of the member.
    {{birthdaychild::groupname}} ... This tag returns the name of the member group of the current configuration.
    {{birthdaychild::age}} ... This tag returns the age of the member.
    {{birthdaymailer::email}} ... This tag returns the e-mail the configured sender.
    {{birthdaymailer::name}} ... This tag returns the name of the configured sender.