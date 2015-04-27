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
 * Settings for automatic restore tool.
 *
 * @package     tool_autorestore
 * @copyright  	2015 Universitat de les Illes Balears http://www.uib.cat
 * @author     	Toni Mas, Ricardo Díaz
 * @license   	http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
	// Add category for restore.
	$ADMIN->add('courses', new admin_category('restores', new lang_string('restores', 'tool_autorestore')));

	// Create a page for autorestore general tool configuration and defaults.
    $temp = new admin_settingpage('autorestoregeneralsettings', new lang_string('generalautorestoredefaults', 'tool_autorestore'), 'moodle/restore:restorecourse');

    $temp->add(new admin_setting_configdirectory('restore/autorestore_destination', new lang_string('restorefrom', 'tool_autorestore'), new lang_string('autorestorefromhelp', 'tool_autorestore'), ''));

    $ADMIN->add('restores', $temp);

    // Needs this condition or there is error on login page.
    $ADMIN->add('restores', new admin_externalpage('toolautorestore',
            get_string('pluginname', 'tool_autorestore'),
            $CFG->wwwroot.'/'.$CFG->admin.'/tool/autorestore/index.php',
            'tool/autorestore:config'));
}
