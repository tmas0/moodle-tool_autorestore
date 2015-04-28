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
 * Strings for component 'tool_autorestore', language 'en'.
 *
 * @package   tool_autorestore
 * @copyright  2015 Universitat de les Illes Balears http://www.uib.es
 * @authors     Toni Mas, Ricardo Díaz
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['aftersaving...'] = 'Once you have saved your settings, you may wish to';
$string['doitnow'] = 'perform an massive restore right now';
$string['restoredcourses'] = 'Restored courses';
$string['pluginname_desc'] = 'Description';
$string['autorestore:config'] = 'Allow to configure the autorestore tool';
$string['autorestore:view'] = 'Allow to view all things from tool';
$string['backupsdirectory'] = 'Select your backups directory';


//Settings
$string['basicsettings'] = 'Basic settings';
$string['forceexecution'] = 'Force autorestore execution';
$string['forceexecution_desc'] = 'Autorestore will run the next time you run cron.';
$string['backups'] = 'Backups files location';
$string['restored'] = 'Restored files location';
$string['norestored'] = 'No restored files location';

/*************************
 strings utilizados:
*************************/
$string['autorestorecrontask'] = 'Automated restores'; //cron_task.php
$string['setautorestoreparameters'] = 'Set autorestore parameters'; //restore_form.php,
$string['pluginname'] = 'Automated restore'; //restorenow.php,
$string['restore'] = 'Restore'; //restorenow.php,
$string['messageprovider:autorestore'] = 'Autorestore plugin notifications'; //messages.php
$string['automatedrestoreschedule'] = 'Schedule'; //lib.php
$string['automatedrestoreschedulehelp'] = 'Choose which days of the week to perform automated restores.'; //lib.php

//settings.php
//General restore defaults section
$string['restores'] = 'Restores';

$string['active'] = 'Active';
$string['autoactivedisabled'] = 'Disabled';
$string['autoactiveenabled'] = 'Enabled';
$string['autoactivemanual'] = 'Manual';
$string['autoactivedescription'] = 'Choose whether or not to do automated restores. If manual is selected automated restores will be possible only by through the automated restore CLI script. This can be done either manually on the command line or through cron.';
$string['executeat'] = 'Execute at';
$string['autorestoreexecuteathelp'] = 'Choose what time automated restores should run at.';
$string['generalautorestoredefaults'] = 'Autorestores general defaults';
$string['restorefrom'] = 'Get backups from';
$string['autorestorefromhelp'] = 'Choose your backup directory for auto restore courses';
$string['restoreto'] = 'Move restored courses to';
$string['autorestoretohelp'] = 'Choose your directory to move restored courses';
$string['logtolocation'] = 'Log file output location (blank for no logging)';
$string['mailadmins'] = 'Notify admins by email';
$string['mailsubject'] = 'Subject for email notifications';
$string['maildefaultsubject'] = 'Moodle autorestore plugin notification';


// General restore settings section.
$string['generalsettings'] = 'General restore settings';
$string['generalusers'] = 'Include users';
$string['configgeneralusers'] = 'Sets the default for whether to include users in restores.';
$string['generalanonymize'] = 'Anonymise information';
$string['configgeneralanonymize'] = 'If enabled all information pertaining to users will be anonymised by default.';
$string['generalroleassignments'] = 'Include role assignments';
$string['configgeneralroleassignments'] = 'If enabled by default roles assignments will also be restored.';
$string['generalactivities'] = 'Include activities and resources';
$string['configgeneralactivities'] = 'Sets the default for including activities in restore.';
$string['generalblocks'] = 'Include blocks';
$string['configgeneralblocks'] = 'Sets the default for including blocks in a restore.';
$string['generalfilters'] = 'Include filters';
$string['configgeneralfilters'] = 'Sets the default for including filters in a restore.';
$string['generalcomments'] = 'Include comments';
$string['configgeneralcomments'] = 'Sets the default for including comments in a restore.';
$string['generalbadges'] = 'Include badges';
$string['configgeneralbadges'] = 'Sets the default for including badges in a restore.';
$string['generaluserscompletion'] = 'Include user completion information';
$string['configgeneraluserscompletion'] = 'If enabled user completion information will be included in restores by default.';
$string['generallogs'] = 'Include logs';
$string['configgenerallogs'] = 'If enabled logs will be included in restores by default.';
$string['generalhistories'] = 'Include histories';
$string['configgeneralhistories'] = 'Sets the default for including user history within a restore.';
$string['generalquestionbank'] = 'Include question bank';
$string['configgeneralquestionbank'] = 'If enabled the question bank will be included in restores by default. PLEASE NOTE: Disabling this setting will disable the restore of activities which use the question bank, such as the quiz.';
