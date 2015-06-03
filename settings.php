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
 * @copyright   2015 Universitat de les Illes Balears http://www.uib.cat
 * @author      Toni Mas, Ricardo Díaz
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/'.$CFG->admin.'/tool/autorestore/lib.php');

if ($hassiteconfig) {
    // Add category for restore.
    $ADMIN->add('courses', new admin_category('restores', new lang_string('restores', 'tool_autorestore')));

    // Create a page for autorestore general tool configuration and defaults.

    // General restore defaults section.
    $temp = new admin_settingpage(  'autorestoregeneralsettings', 
                                    new lang_string('generalautorestoredefaults', 'tool_autorestore'), 
                                    'moodle/site:config'
                                );

    // State of tool.
    $temp->add( new admin_setting_configselect('tool_autorestore/active',
                    new lang_string('active', 'tool_autorestore'),
                    new lang_string('autoactivedescription', 'tool_autorestore'),
                    0, 
                    array(
                            0 => new lang_string('autoactivedisabled', 'tool_autorestore'),
                            1 => new lang_string('autoactiveenabled', 'tool_autorestore'),
                            2 => new lang_string('autoactivemanual', 'tool_autorestore')
                    )
                )
            );

    // Directory of the backups.
    $temp->add( new admin_setting_configdirectory('tool_autorestore/from',
                    new lang_string('restorefrom', 'tool_autorestore'),
                    new lang_string('autorestorefromhelp', 'tool_autorestore'),
                    $CFG->dataroot . '/backups'
                )
            );

    // If backup restored successfully, move to this directory.
    $temp->add( new admin_setting_configdirectory('tool_autorestore/destination',
                    new lang_string('restoreto', 'tool_autorestore'),
                    new lang_string('autorestoretohelp', 'tool_autorestore'),
                    $CFG->dataroot . '/restored'
                )
            );
    
    // Log location.
    $temp->add( new admin_setting_configfile('tool_autorestore/logtolocation',
                    new lang_string('logtolocation', 'tool_autorestore'),
                    '',
                    $CFG->dataroot . '/backups'
                )
            );

    // Send email to admin.
    $temp->add( new admin_setting_configcheckbox('tool_autorestore/mailadmins',
                    new lang_string('mailadmins', 'tool_autorestore'),
                    '',
                    0
                )
            );
    
    // Choose select email.
    $temp->add( new admin_setting_configtext('tool_autorestore/mailsubject',
                    new lang_string('mailsubject', 'tool_autorestore'),
                    '',
                    new lang_string('maildefaultsubject', 'tool_autorestore')
                )
            );

    // General restore settings section.
    $temp->add(new admin_setting_heading('generalsettings', new lang_string('generalsettings', 'tool_autorestore'), ''));


    $temp->add( new admin_setting_configcheckbox('tool_autorestore/autorestore_include_users',
                    new lang_string('settingincludeusers','tool_autorestore'),
                    new lang_string('configincludeusers','tool_autorestore'),
                    array('value' => 1, 'locked' => 0)
                )
            );

    $temp->add( new admin_setting_configcheckbox('tool_autorestore/autorestore_include_enrol_manual',
                    new lang_string('settingenrolmanual','tool_autorestore'),
                    new lang_string('configincludenrolmanual','tool_autorestore'),
                    array('value' => 0, 'locked' => 0)
                )
            );

    $temp->add( new admin_setting_configcheckbox('tool_autorestore/autorestore_include_role_assignments',
                    new lang_string('settingroleassignments','tool_autorestore'),
                    new lang_string('configincluderoleassignments','tool_autorestore'),
                    array('value' => 1, 'locked' => 0)
                )
            );

    $temp->add( new admin_setting_configcheckbox('tool_autorestore/autorestore_include_activities',
                    new lang_string('settingactivities','tool_autorestore'),
                    new lang_string('configincludeactivities','tool_autorestore'),
                    array('value' => 1, 'locked' => 0)
                )
            );

    $temp->add( new admin_setting_configcheckbox('tool_autorestore/autorestore_include_blocks',
                    new lang_string('settingblocks','tool_autorestore'),
                    new lang_string('configincludeblocks','tool_autorestore'),
                    array('value' => 1, 'locked' => 0)
                )
            );

    $temp->add( new admin_setting_configcheckbox('tool_autorestore/autorestore_include_filters',
                    new lang_string('settingfilters','tool_autorestore'),
                    new lang_string('configincludefilters','tool_autorestore'),
                    array('value' => 1, 'locked' => 0)
                )
            );

    $temp->add( new admin_setting_configcheckbox('tool_autorestore/autorestore_include_comments',
                    new lang_string('settingcomments','tool_autorestore'),
                    new lang_string('configincludecomments','tool_autorestore'),
                    array('value' => 1, 'locked' => 0)
                )
            );

    $temp->add( new admin_setting_configcheckbox('tool_autorestore/autorestore_include_badges',
                    new lang_string('settingbadges','tool_autorestore'),
                    new lang_string('configincludebadges','tool_autorestore'),
                    array('value' => 1, 'locked' => 0)
                )
            );

    $temp->add( new admin_setting_configcheckbox('tool_autorestore/autorestore_include_calendarevents',
                    new lang_string('settingcalendarevents','tool_autorestore'),
                    new lang_string('configincludecalendarevents','tool_autorestore'),
                    array('value' => 1, 'locked' => 0)
                )
            );

    $temp->add( new admin_setting_configcheckbox('tool_autorestore/autorestore_include_userscompletion',
                    new lang_string('settinguserscompletion','tool_autorestore'),
                    new lang_string('configincludeuserscompletion','tool_autorestore'),
                    array('value' => 1, 'locked' => 0)
                )
            );

    $temp->add( new admin_setting_configcheckbox('tool_autorestore/autorestore_include_logs',
                    new lang_string('settinglogs','tool_autorestore'),
                    new lang_string('configincludelogs','tool_autorestore'),
                    array('value' => 0, 'locked' => 0)
                )
            );

    $temp->add( new admin_setting_configcheckbox('tool_autorestore/autorestore_include_histories',
                    new lang_string('settinggradehistories','tool_autorestore'),
                    new lang_string('configincludehistories','tool_autorestore'),
                    array('value' => 0, 'locked' => 0)
                )
            );

    $ADMIN->add('restores', $temp);

    // Needs this condition or there is error on login page.
    $ADMIN->add('restores', new admin_externalpage('toolautorestore',
            get_string('pluginname', 'tool_autorestore'),
            $CFG->wwwroot.'/'.$CFG->admin.'/tool/autorestore/index.php',
            'tool/autorestore:config'));
}
