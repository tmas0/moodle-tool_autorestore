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
$string['autorestoreexecuted'] = 'Autorestore has been carried out within Moodle';
$string['backups'] = 'Backups files location';
$string['backupsdirectory'] = 'Select your backups directory';
$string['basicsettings'] = 'Basic settings';
$string['backupname'] = 'Backup name';
$string['backupwitherrors'] = 'Backups with problems/errors.';
$string['checkdirpermissions'] = 'Check that the file is writeable by the server:';
$string['configincludeactivities'] = 'Sets the default for including activities in restore.';
$string['configincludebadges'] = 'Sets the default for including badges in a restore.';
$string['configincludeblocks'] = 'Sets the default for including blocks in a restore.';
$string['configincludecomments'] = 'Sets the default for including comments in a restore.';
$string['configincludefilters'] = 'Sets the default for including filters in a restore.';
$string['configincludehistories'] = 'Sets the default for including user history within a restore.';
$string['configincludelogs'] = 'If enabled logs will be included in restores by default.';
$string['configincludequestionbank'] = 'If enabled the question bank will be included in restores by default. PLEASE NOTE: Disabling this setting will disable the restore of activities which use the question bank, such as the quiz.';
$string['configincluderoleassignments'] = 'If enabled by default roles assignments will also be restored.';
$string['configincludeusers'] = 'Sets the default for whether to include users in restores.';
$string['configgeneraluserscompletion'] = 'If enabled user completion information will be included in restores by default.';
$string['disabled'] = 'The plugin is disabled. If you want to use it you need to activate';
$string['doitnow'] = 'perform an massive restore right now';
$string['emailsended'] = 'Notification email sent to administrator.';
$string['emptydirbackup'] = 'No Moodle backups found.';
$string['emptydirrestored'] = 'No Moodle backups restored.';
$string['errordate'] = 'Execute date';
$string['errortext'] = 'Error or problem';
$string['executeat'] = 'Execute at';
$string['filenotexists'] = 'File {$a} not exists';
$string['filespending'] = 'Files pending to restore';
$string['filesrestored'] = 'Restored backups';
$string['forceexecution'] = 'Force autorestore execution';
$string['forceexecution_desc'] = 'Autorestore will run the next time you run cron.';
$string['includeactivities'] = 'Include activities and resources';
$string['generalautorestoredefaults'] = 'Autorestores general defaults';
$string['includebadges'] = 'Include badges';
$string['includeblocks'] = 'Include blocks';
$string['includecomments'] = 'Include comments';
$string['includefilters'] = 'Include filters';
$string['includehistories'] = 'Include histories';
$string['includelogs'] = 'Include logs';
$string['includequestionbank'] = 'Include question bank';
$string['includeroleassignments'] = 'Include role assignments';
$string['generalsettings'] = 'General restore settings';
$string['includeusers'] = 'Include users';
$string['generaluserscompletion'] = 'Include user completion information';
$string['lognowritten'] = 'The log file appears not to have been successfully written.';
$string['logtolocation'] = 'Log file output location (blank for no logging)';
$string['logwrittento'] = 'Log data has been written to:';
$string['logsize'] = '(Log file size: {$a} Kb)'; 
$string['nobackupswitherrors'] = 'No backups errors or problems found';
$string['mailadmins'] = 'Notify admins by email';
$string['maildefaultsubject'] = 'Moodle autorestore plugin notification';
$string['mailsubject'] = 'Subject for email notifications';
$string['messageprovider:autorestore'] = 'Autorestore plugin notifications'; //messages.php
$string['norestored'] = 'No restored files location';
$string['pluginname'] = 'Automated restore tool'; //restorenow.php,
$string['pluginname_desc'] = 'Description';
$string['timetaken'] = 'Time taken {$a} seconds';
$string['restore'] = 'Restore'; //restorenow.php,
$string['restored'] = 'Restored files location';
$string['restoredcourses'] = 'Restored courses';
$string['restorefrom'] = 'Get backups from';
$string['restores'] = 'Auto restore tool';
$string['restoreto'] = 'Move restored courses to';
$string['setautorestoreparameters'] = 'Set autorestore parameters'; //restore_form.php
$string['loggingnotactive'] = 'Logging is currently not active.';
$string['invalidbackupdir'] = 'The directory {$a} does not exists';
$string['invalidcategoryname'] = 'The category name: {$a} is empty or invalid';
$string['launched'] = 'Autorestore cron process launched at {$a}';
$string['newcourse'] = 'Create new course named {$a}';
$string['failcreatenewcourse'] = 'Cannot create course: {$a}';
$string['startrestoring'] = 'Starting the restore backup into the course';
$string['failprecheck'] = 'Precheck error: {$a}';
$string['executingrestore'] = 'Succeded precheck. Starting to restore';
$string['failedexecuterestore'] = 'Restoring process failed with: {$a}';
$string['restoresucceded'] = 'Succeded restore backup.';
$string['movedbackup'] = 'The backup has moved on successfully directory';
$string['failedmovedbackup'] = 'ERROR: The backup has not moved.';
$string['failedopencourse'] = 'File {$a} not found or you have not open permission';
$string['processcompleted'] = 'Process has completed. Time taken: {$a} seconds.';
$string['filesizeproblems'] = 'The backup file have {$a} Kb, it may be a problem.';