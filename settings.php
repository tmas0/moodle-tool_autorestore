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

    //General restore defaults section
    $temp = new admin_settingpage('autorestoregeneralsettings', new lang_string('generalautorestoredefaults', 'tool_autorestore'), 'moodle/restore:restorecourse');
    $temp->add(new admin_setting_configdirectory('tool_autorestore/destination', new lang_string('restorefrom', 'tool_autorestore'), new lang_string('autorestorefromhelp', 'tool_autorestore'), ''));

    // General restore settings section
    $temp->add(new admin_setting_heading('generalsettings', new lang_string('generalsettings', 'tool_autorestore'), ''));
    $temp->add(new admin_setting_configcheckbox_with_lock('tool_autorestore/autorestore_general_users', new lang_string('generalusers','tool_autorestore'), new lang_string('configgeneralusers','tool_autorestore'), array('value'=>1, 'locked'=>0)));
    $temp->add(new admin_setting_configcheckbox_with_lock('tool_autorestore/autorestore_general_anonymize', new lang_string('generalanonymize','tool_autorestore'), new lang_string('configgeneralanonymize','tool_autorestore'), array('value'=>0, 'locked'=>0)));
    $temp->add(new admin_setting_configcheckbox_with_lock('tool_autorestore/autorestore_general_role_assignments', new lang_string('generalroleassignments','tool_autorestore'), new lang_string('configgeneralroleassignments','tool_autorestore'), array('value'=>1, 'locked'=>0)));
    $temp->add(new admin_setting_configcheckbox_with_lock('tool_autorestore/autorestore_general_activities', new lang_string('generalactivities','tool_autorestore'), new lang_string('configgeneralactivities','tool_autorestore'), array('value'=>1, 'locked'=>0)));
    $temp->add(new admin_setting_configcheckbox_with_lock('tool_autorestore/autorestore_general_blocks', new lang_string('generalblocks','tool_autorestore'), new lang_string('configgeneralblocks','tool_autorestore'), array('value'=>1, 'locked'=>0)));
    $temp->add(new admin_setting_configcheckbox_with_lock('tool_autorestore/autorestore_general_filters', new lang_string('generalfilters','tool_autorestore'), new lang_string('configgeneralfilters','tool_autorestore'), array('value'=>1, 'locked'=>0)));
    $temp->add(new admin_setting_configcheckbox_with_lock('tool_autorestore/autorestore_general_comments', new lang_string('generalcomments','tool_autorestore'), new lang_string('configgeneralcomments','tool_autorestore'), array('value'=>1, 'locked'=>0)));
    $temp->add(new admin_setting_configcheckbox_with_lock('tool_autorestore/autorestore_general_badges', new lang_string('generalbadges','tool_autorestore'), new lang_string('configgeneralbadges','tool_autorestore'), array('value'=>1,'locked'=>0)));
    $temp->add(new admin_setting_configcheckbox_with_lock('tool_autorestore/autorestore_general_userscompletion', new lang_string('generaluserscompletion','tool_autorestore'), new lang_string('configgeneraluserscompletion','tool_autorestore'), array('value'=>1, 'locked'=>0)));
    $temp->add(new admin_setting_configcheckbox_with_lock('tool_autorestore/autorestore_general_logs', new lang_string('generallogs','tool_autorestore'), new lang_string('configgenerallogs','tool_autorestore'), array('value'=>0, 'locked'=>0)));
    $temp->add(new admin_setting_configcheckbox_with_lock('tool_autorestore/autorestore_general_histories', new lang_string('generalhistories','tool_autorestore'), new lang_string('configgeneralhistories','tool_autorestore'), array('value'=>0, 'locked'=>0)));
    $temp->add(new admin_setting_configcheckbox_with_lock('tool_autorestore/autorestore_general_questionbank', new lang_string('generalquestionbank','tool_autorestore'), new lang_string('configgeneralquestionbank','tool_autorestore'), array('value'=>1, 'locked'=>0)));

    $ADMIN->add('restores', $temp);

    // Needs this condition or there is error on login page.
    $ADMIN->add('restores', new admin_externalpage('toolautorestore',
            get_string('pluginname', 'tool_autorestore'),
            $CFG->wwwroot.'/'.$CFG->admin.'/tool/autorestore/index.php',
            'tool/autorestore:config'));
}