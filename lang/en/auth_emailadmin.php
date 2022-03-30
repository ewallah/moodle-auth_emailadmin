<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'auth_emailadmin', language 'en', branch 'MOODLE_20_STABLE'
 *
 * NOTE: Based on 'email' package by Martin Dougiamas
 *
 * @package   auth_emailadmin
 * @copyright 2012 onwards Felipe Carasso  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['auth_emailadmindescription'] = '<p>Email-based self-registration with Admin confirmation enables a user to create their own account via a \'Create new account\' button on the login page. The site admins then receive an email containing a secure link to a page where they can confirm the account. Future logins just check the username and password against the stored values in the Moodle database.</p><p>Note: In addition to enabling the plugin, email-based self-registration with admin confirmation must also be selected from the self registration drop-down menu on the \'Manage authentication\' page.</p>';
$string['auth_emailadminnoemail'] = 'Tried to send you an email but failed!';
$string['auth_emailadminrecaptcha'] = 'Adds a visual/audio confirmation form element to the signup page for email self-registering users. This protects your site against spammers and contributes to a worthwhile cause. See http://www.google.com/recaptcha/learnmore for more details. <br /><em>PHP cURL extension is required.</em>';
$string['auth_emailadminrecaptcha_key'] = 'Enable reCAPTCHA element';
$string['auth_emailadminsettings'] = 'Settings';
$string['auth_emailadminuserconfirmation'] = '';
$string['auth_emailadminconfirmation'] = '
--
Hi Moodle Admin,

A new account has been requested at \'{$a->sitename}\' with  the following data:

user->firstname: {$a->firstname}
user->lastname: {$a->lastname}
user->email: {$a->email}

All user fields + custom fields:
{$a->userdata}

To confirm the new account, please go to this web address:

{$a->link}

In most mail programs, this should appear as a blue link which you can just click on.  If that doesn\'t work, then cut and paste the address into the address line at the top of your web browser window.

You can also confirm accounts from within Moodle by going to
Site Administration -> Users

';
$string['auth_emailadminconfirmationsubject'] = '{$a}: account confirmation';
$string['auth_emailadminconfirmsent'] = '<p>
Your account has been registered and is pending confirmation by the administrator. You should expect to either receive a confirmation or to be contacted for further clarification.</p>
';
$string['auth_emailadminnotif_failed'] = 'Could not send registration notification to: ';
$string['auth_emailadminnoadmin'] = 'No admin found based on notification strategy. Please check auth_emailadmin configuration.';
$string['auth_emailadminnotif_strategy_key'] = 'Notification strategy:';
$string['auth_emailadminnotif_strategy'] = 'Defines the strategy to send the registration notifications. Available options are "first" admin user, "all" admin users or one specific admin user.';
$string['auth_emailadminnotif_strategy_first'] = 'First admin user';
$string['auth_emailadminnotif_strategy_all'] = 'All admin users';
$string['auth_emailadminnotif_strategy_allupdate'] = 'All admins and users with user update capability';
$string['auth_emailadminawaitingapproval'] = 'Your account is awaiting admin approval.';
$string['pluginname'] = 'Email-based self-registration with admin confirmation';
$string['privacy:metadata'] = 'The Email Admin plugin does not store user data.';
