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
 * Auth emailadmin external functions tests.
 *
 * @package   auth_emailadmin
 * @copyright 2021 Renaat Debleu <info@eWallah.net>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


namespace auth_emailadmin;

defined('MOODLE_INTERNAL') || die();


/**
 * Auth emailadmin external functions tests.
 *
 * @package   auth_emailadmin
 * @copyright 2021 Renaat Debleu <info@eWallah.net>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class classes_test extends \advanced_testcase {

    /**
     * Set up for every test
     */
    public function setUp(): void {
        global $CFG;
        require_once($CFG->dirroot . '/auth/emailadmin/auth.php');
        $this->resetAfterTest(true);
        $CFG->registerauth = 'emailadmin';
    }

    /**
     * Test message class.
     */
    public function test_message_class() {
        global $CFG, $USER;

        $this->setAdminUser();
        $datagenerator = $this->getDataGenerator();
        $user = $datagenerator->create_user();
        $user->mnethostid = $CFG->mnet_localhost_id;
        $sink = $this->redirectMessages();
        \auth\emailadmin\message::send_confirmation_email_user($user);
        $this->assertGreaterThanOrEqual(0, count($sink->get_messages()));
        \auth\emailadmin\message::send_confirmation_email_user($USER);
        $sink->clear();
        $sink->close();
    }

    /**
     * Test class.
     */
    public function test_class() {
        global $CFG, $DB, $COURSE, $OUTPUT, $PAGE;

        $CFG->defaultcity = 'Bcn';
        $CFG->country = 'ES';
        $CFG->sitepolicy = 'https://moodle.org';
        $datagenerator = $this->getDataGenerator();
        $user = $datagenerator->create_user(['auth' => 'emailadmin']);
        $user->mnethostid = $CFG->mnet_localhost_id;

        $auth = new \auth_plugin_emailadmin();
        $this->assertFalse($auth->user_login('a', 'b'));
        $this->assertFalse($auth->user_login(fullname($user), 'b'));
        $this->assertFalse($auth->user_login($user->username, 'b'));
        $this->assertTrue($auth->user_update_password($user, 'b'));
        $this->assertTrue($auth->can_signup());
        $this->assertTrue($auth->can_confirm());
        $this->assertTrue($auth->is_internal());
        $this->assertTrue($auth->can_change_password());
        $this->assertTrue($auth->can_reset_password());

        $this->assertFalse($auth->prevent_local_passwords());
        $this->assertFalse($auth->is_captcha_enabled());
        $this->assertEquals('', $auth->list_custom_fields($user));
        $this->assertEquals(null, $auth->change_password_url());

        $sink = $this->redirectMessages();
        $this->assertEquals(AUTH_CONFIRM_ALREADY, $auth->user_confirm($user->username, 'newkey'));
        $DB->set_field("user", "confirmed", 0, ["id" => $user->id]);
        $user->email = 'newemail@moodle.org';
        $user->username = 'newemail@moodle.org';
        $auth->user_signup($user, false);
        $this->assertTrue($auth->send_confirmation_email_support($user));
        $this->assertGreaterThanOrEqual(0, count($sink->get_messages()));
        $sink->clear();
        $sink->close();
        $this->setAdminUser();
        chdir($CFG->dirroot . '/auth/emailadmin');
        $_POST['data'] = "newkey/newuser";
        $this->expectException(\moodle_exception::class);
        $this->expectExceptionMessage('Invalid confirmation data');
        include($CFG->dirroot . '/auth/emailadmin/confirm.php');
    }
}
