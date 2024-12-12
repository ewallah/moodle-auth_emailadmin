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
 * EmailAdmin auth privacy tests.
 *
 * @package   auth_emailadmin
 * @copyright 2012 onwards Felipe Carasso (http://carassonet.org)
 * @author    Renaat Debleu <info@eWallah.net>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace auth_emailadmin\privacy;

use core_privacy\tests\provider_testcase;

/**
 * EmailAdmin auth privacy tests.
 *
 * @package   auth_emailadmin
 * @copyright 2012 onwards Felipe Carasso (http://carassonet.org)
 * @author    Renaat Debleu <info@eWallah.net>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class privacy_test extends provider_testcase {

    /**
     * Test returning metadata.
     * @covers \auth_emailadmin\privacy\provider
     */
    public function test_get_metadata(): void {
        $collection = new \core_privacy\local\metadata\collection('auth_emailadmin');
        $reason = \auth_emailadmin\privacy\provider::get_reason($collection);
        $this->assertEquals($reason, 'privacy:metadata');
        $this->assertStringContainsString('does not store', get_string($reason, 'auth_emailadmin'));
    }
}
