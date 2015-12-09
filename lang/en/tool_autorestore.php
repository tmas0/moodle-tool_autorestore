<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.e
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
 * @package    tool_autorestore
 * @copyright  2015 Universitat de les Illes Balears http://www.uib.es
 * @author     Toni Mas, Ricardo Díaz
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['active'] = 'Active';
$string['aftersaving'] = 'Once you have saved your settings, you may wish to';
$string['autoactivedescription'] = 'Choose whether or not to do automated restores. If enabled is selected you can specify when you want to run using scheduled tasks. If manual is selected automated restores will be possible only by through the automated restore CLI script. This can be done either manually on the command line or through cron.';
$string['autoactivedisabled'] = 'Disabled';
$string['autoactiveenabled'] = 'Enabled';
$string['autoactivemanual'] = 'Manual';
$string['automatedrestoreschedule'] = 'Schedule';
$string['automatedrestoreschedulehelp'] = 'Choose which days of the week to perform automated restores.';
$string['autorestore:config'] = 'Allow to configure the autorestore tool';
$string['autorestore:view'] = 'Allow to view all things from tool';
$string['autorestorecrontask'] = 'Automated restores';
$string['autorestoreexecuteathelp'] = 'Choose what time automated restores should run at.';
$string['autorestoreexecuted'] = 'Autorestore has been carried out within Moodle';
$string['autorestorefromhelp'] = 'Choose your backup directory for auto restore courses';
$string['autorestoretohelp'] = 'Choose your directory to move restored courses';
$string['backupname'] = 'Backup name';
$string['backups'] = 'Backups files location';
$string['backupsdirectory'] = 'Select your backups directory';
$string['backupwitherrors'] = 'Backups with problems/errors.';
$string['basicsettings'] = 'Basic settings';
$string['checkdirpermissions'] = 'Check that the file is writeable by the server:';
$string['configincludeactivities'] = 'Sets the default for including activities in restore.';
$string['configincludebadges'] = 'Sets the default for including badges in a restore.';
$string['configincludeblocks'] = 'Sets the default for including blocks in a restore.';
$string['configincludecalendarevents'] = 'Sets the default for including calendar events in a restore.';
$string['configincludecomments'] = 'Sets the default for including comments in a restore.';
$string['configincludefilters'] = 'Sets the default for including filters in a restore.';
$string['configincludehistories'] = 'Sets the default for including user history within a restore.';
$string['configincludelogs'] = 'If enabled logs will be included in restores by default.';
$string['configincludenrolmanual'] = 'Sets the default for not including enrolment method as "Manual enrolment"';
$string['configincluderoleassignments'] = 'If enabled by default roles assignments will also be restored.';
$string['configincludeusers'] = 'Sets the default for whether to include users in restores.';
$string['configincludeuserscompletion'] = 'If enabled user completion information will be included in restores by default.';
$string['disabled'] = 'The plugin is disabled. If you want to use it you need to activate';
$string['doitnow'] = 'perform a massive restore right now';
$string['emailsended'] = 'Notification email sent to administrator.';
$string['emptydirbackup'] = 'No Moodle backups found.';
$string['emptydirrestored'] = 'No Moodle backups restored.';
$string['errordate'] = 'Execute date';
$string['errortext'] = 'Error or problem';
$string['executeat'] = 'Execute at';
$string['executingrestore'] = 'Precheck succeeded. Starting to restore';
$string['failcreatenewcourse'] = 'Cannot create course: {$a}';
$string['failedcreatedir'] = 'Directory ({$a}) does not exist. Failed to create. You must check your path in MoodleData or permissions.';
$string['failedexecuterestore'] = 'Restoring process failed with: {$a}';
$string['failedmovedbackup'] = 'ERROR: The backup has not moved.';
$string['failedopencourse'] = 'File {$a} not found or you have not open permission';
$string['failprecheck'] = 'Precheck error: {$a}';	
$string['filenotexists'] = 'File {$a} not exists';
$string['filesizeproblems'] = 'The backup file have {$a}, it may be a problem.';
$string['filespending'] = 'Files pending to restore';
$string['filesrestored'] = 'Restored backups';
$string['forceexecution'] = 'Force autorestore execution';
$string['forceexecution_desc'] = 'Autorestore will run the next time you run cron.';
$string['generalautorestoredefaults'] = 'Autorestores general defaults';
$string['generalsettings'] = 'General restore settings';
$string['generaluserscompletion'] = 'Include user completion information';
$string['invalidbackupdir'] = 'The directory {$a} does not exists';
$string['invalidcategoryname'] = 'The category name: {$a} is empty or invalid';
$string['launched'] = 'Autorestore cron process launched at {$a}';
$string['loggingnotactive'] = 'Logging is currently not active.';
$string['logisnotfile'] = 'Log destination must be a file. ({$a} is not file)';
$string['lognowritten'] = 'The log file appears not to have been successfully written.';
$string['logsize'] = '(Log file size: {$a})'; 
$string['logtolocation'] = 'Log file output location';
$string['logwrittento'] = 'Log data has been written to:';
$string['mailadmins'] = 'Notify admins by email';
$string['maildefaultsubject'] = 'Moodle autorestore plugin notification';
$string['mailsubject'] = 'Subject for email notifications';
$string['messageprovider:autorestore'] = 'Autorestore plugin notifications';
$string['movedbackup'] = 'The backup has moved on successfully directory';
$string['newcourse'] = 'Create new course named {$a}';
$string['nobackupswitherrors'] = 'No backups errors or problems found';
$string['norestored'] = 'No restored files location';
$string['pluginname'] = 'Automated restore tool';
$string['pluginname_desc'] = 'Description';
$string['processcompleted'] = 'Process has completed. Time taken: {$a} seconds.';
$string['restore'] = 'Restore';
$string['restored'] = 'Restored files location';
$string['restoredcourses'] = 'Restored courses';
$string['restorefrom'] = 'Get backups from';
$string['restores'] = 'Auto restore tool';
$string['restoresucceded'] = 'Restore backup succeeded.';
$string['restoreto'] = 'Move restored courses to';
$string['setautorestoreparameters'] = 'Set autorestore parameters';
$string['settingactivities'] = 'Include activities and resources';
$string['settingbadges'] = 'Include badges';
$string['settingblocks'] = 'Include blocks';
$string['settingcalendarevents'] = 'Include calendar events';
$string['settingcomments'] = 'Include comments';
$string['settingenrolmanual'] = 'Restore as manual enrolments';
$string['settingfilters'] = 'Include filters';
$string['settinggradehistories'] = 'Include grade history';
$string['settingincludeusers'] = 'Include enrolled users';
$string['settinglogs'] = 'Include course logs';
$string['settingroleassignments'] = 'Include user role assignments';
$string['settinguserscompletion'] = 'Include user completion details';
$string['startrestoring'] = 'Starting the restore backup into the course';
$string['timetaken'] = 'Time taken {$a} seconds';
