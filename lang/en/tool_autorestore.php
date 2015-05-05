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

defined('MOODLE_INTERNAL') || die;

/**
 * Strings for component 'tool_autorestore', language 'en'.
 *
 * @package   tool_autorestore
 * @copyright  2015 Universitat de les Illes Balears http://www.uib.es
 * @author     Toni Mas, Ricardo Díaz
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['active'] = 'Active';
$string['aftersaving'] = 'Once you have saved your settings, you may wish to';
$string['autoactivedescription'] = 'Choose whether or not to do automated restores. If manual is selected automated restores will be possible only by through the automated restore CLI script. This can be done either manually on the command line or through cron.';
$string['autoactivedisabled'] = 'Disabled';
$string['autoactiveenabled'] = 'Enabled';
$string['autoactivemanual'] = 'Manual';
$string['automatedrestoreschedule'] = 'Schedule'; //lib.php
$string['automatedrestoreschedulehelp'] = 'Choose which days of the week to perform automated restores.'; //lib.php
$string['autorestore:config'] = 'Allow to configure the autorestore tool';
$string['autorestore:view'] = 'Allow to view all things from tool';
$string['autorestorecrontask'] = 'Automated restores'; //cron_task.php
$string['autorestoreexecuteathelp'] = 'Choose what time automated restores should run at.';
$string['autorestorefromhelp'] = 'Choose your backup directory for auto restore courses';
$string['autorestoretohelp'] = 'Choose your directory to move restored courses';
$string['backups'] = 'Backups files location';
$string['backupsdirectory'] = 'Select your backups directory';
$string['basicsettings'] = 'Basic settings';
$string['backupname'] = 'Backup name';
$string['backupwitherrors'] = 'Backups with problems/errors.';
$string['configgeneralactivities'] = 'Sets the default for including activities in restore.';
$string['configgeneralanonymize'] = 'If enabled all information pertaining to users will be anonymised by default.';
$string['configgeneralbadges'] = 'Sets the default for including badges in a restore.';
$string['configgeneralblocks'] = 'Sets the default for including blocks in a restore.';
$string['configgeneralcomments'] = 'Sets the default for including comments in a restore.';
$string['configgeneralfilters'] = 'Sets the default for including filters in a restore.';
$string['configgeneralhistories'] = 'Sets the default for including user history within a restore.';
$string['configgenerallogs'] = 'If enabled logs will be included in restores by default.';
$string['configgeneralquestionbank'] = 'If enabled the question bank will be included in restores by default. PLEASE NOTE: Disabling this setting will disable the restore of activities which use the question bank, such as the quiz.';
$string['configgeneralroleassignments'] = 'If enabled by default roles assignments will also be restored.';
$string['configgeneralusers'] = 'Sets the default for whether to include users in restores.';
$string['configgeneraluserscompletion'] = 'If enabled user completion information will be included in restores by default.';
$string['disabled'] = 'The plugin is disabled. If you want to use it you need to activate';
$string['doitnow'] = 'perform an massive restore right now';
$string['emptydirbackup'] = 'No Moodle backups found.';
$string['emptydirrestored'] = 'No Moodle backups restored.';
$string['errordate'] = 'Execute date';
$string['errortext'] = 'Error or problem';
$string['executeat'] = 'Execute at';
$string['filespending'] = 'Files pending to restore';
$string['filesrestored'] = 'Restored backups';
$string['forceexecution'] = 'Force autorestore execution';
$string['forceexecution_desc'] = 'Autorestore will run the next time you run cron.';
$string['generalactivities'] = 'Include activities and resources';
$string['generalanonymize'] = 'Anonymise information';
$string['generalautorestoredefaults'] = 'Autorestores general defaults';
$string['generalbadges'] = 'Include badges';
$string['generalblocks'] = 'Include blocks';
$string['generalcomments'] = 'Include comments';
$string['generalfilters'] = 'Include filters';
$string['generalhistories'] = 'Include histories';
$string['generallogs'] = 'Include logs';
$string['generalquestionbank'] = 'Include question bank';
$string['generalroleassignments'] = 'Include role assignments';
$string['generalsettings'] = 'General restore settings';
$string['generalusers'] = 'Include users';
$string['generaluserscompletion'] = 'Include user completion information';
$string['logtolocation'] = 'Log file output location (blank for no logging)';
$string['nobackupswitherrors'] = 'No backups errors or problems found';
$string['mailadmins'] = 'Notify admins by email';
$string['maildefaultsubject'] = 'Moodle autorestore plugin notification';
$string['mailsubject'] = 'Subject for email notifications';
$string['messageprovider:autorestore'] = 'Autorestore plugin notifications'; //messages.php
$string['norestored'] = 'No restored files location';
$string['pluginname'] = 'Automated restore tool'; //restorenow.php,
$string['pluginname_desc'] = 'Description';
$string['restore'] = 'Restore'; //restorenow.php,
$string['restored'] = 'Restored files location';
$string['restoredcourses'] = 'Restored courses';
$string['restorefrom'] = 'Get backups from';
$string['restores'] = 'Auto restore tool';
$string['restoreto'] = 'Move restored courses to';
$string['setautorestoreparameters'] = 'Set autorestore parameters'; //restore_form.php,