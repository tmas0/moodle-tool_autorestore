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
 * Lib for automatic restore tool.
 *
 * @package		tool_autorestore
 * @copyright  	2015 Universitat de les Illes Balears http://www.uib.cat
 * @author     	Toni Mas, Ricardo Díaz
 * @license   	http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 defined('MOODLE_INTERNAL') || die();
 
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot . '/backup/util/includes/backup_includes.php');
require_once($CFG->dirroot . '/backup/util/includes/restore_includes.php');

/**
 * Define list of week days who your choose to execute the autorestore.
 *
 */
class admin_setting_special_autorestoredays extends admin_setting_configmulticheckbox2 {
    /**
     * Calls parent::__construct with specific arguments
     */
    public function __construct() {
        parent::__construct('autorestore_weekdays', 
                            get_string('automatedrestoreschedule','tool_autorestore'), 
                            get_string('automatedrestoreschedulehelp','tool_autorestore'), 
                            array(), 
                            NULL
                    );

        $this->plugin = 'tool_autorestore';
    }

    /**
     * Load the available choices for the select box
     *
     * @return bool Always returns true
     */
    public function load_choices() {
        if (is_array($this->choices)) {
            return true;
        }
        $this->choices = array();
        $days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
        foreach ($days as $day) {
            $this->choices[$day] = get_string($day, 'calendar');
        }
        return true;
    }
}

/**
 * Progress class that records the result of restore_controller::is_executing calls.
 *
 * @package core_backup
 * @copyright 2014 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_backup_progress_autorestore_is_executing extends \core\progress\base {
    /** @var array Array of results from calling function */
    public $executing = array();

    public function update_progress() {
        $this->executing[] = restore_controller::is_executing();
    }
}

/**
 * Unzip moodle backup with progress bar.
 *
 */
class autorestore_unzip implements file_progress {

    /**
     * @var \core\progress\base Optional progress reporter
     */
    private $progressreporter;

    protected $restorepath = null;
    protected $backupfile = null;
    protected $restoredir = null;

    protected $logfile;

    /**
     * @var bool True if we have started reporting progress
     */
    protected $startedprogress = false;

    /**
     * Contructor.
     *
     * @param string $path Path to backups.
     * @param string $backupfile The backup file.
     * @param string $thelog The log file.
     * @return string Name of unzip directory.
     */
    public function __construct($path, $backupfile, $thelog) {
        global $CFG;

        // Create dirname from backup file name hash.
        $this->restoredir = sha1($backupfile);

        $this->restorepath = $CFG->dataroot . '/temp/backup/' . $this->restoredir;

        // Backup file path.
        $this->backupfile = $path . '/' . $backupfile;;
        $this->logfile = $thelog;
    }

    public function get_restoredir() {
        return $this->restoredir;
    }

    public function process() {
        global $CFG;

        // Check if folder exists.
        if ( file_exists($this->restorepath) ) {
            if ( ! remove_dir($this->restorepath) ) {
                throw new moodle_exception( get_string('removedirfailed', 
                                                        'tool_autorestore', 
                                                        $this->restorepath)
                                            );
                
            }
        }

        tool_autorestore::log($this->logfile, 
            get_string('filesizeproblems', 'tool_autorestore', tool_autorestore::get_filesize($this->backupfile))
        );

        // Extract backup file.
        $outcome = $this->extract_file_to_dir();
        
        return $outcome;
    }

    /**
     * Extracts the backup file.
     */
    protected function extract_file_to_dir() {
        global $CFG;

        $fb = get_file_packer('application/vnd.moodle.backup');
        
        $result = $fb->extract_to_pathname($this->backupfile,
                $this->restorepath . '/', null, $this);

        // If any progress happened, end it.
        if ($this->startedprogress) {
            $this->get_progress_reporter()->end_progress();
        }
        return $result;
    }

    /**
     * Implementation for file_progress interface to display unzip progress.
     *
     * @param int $progress Current progress
     * @param int $max Max value
     */
    public function progress($progress = file_progress::INDETERMINATE, $max = file_progress::INDETERMINATE) {
        $reporter = $this->get_progress_reporter();

        // Start tracking progress if necessary.
        if (!$this->startedprogress) {
            $reporter->start_progress('extract_file_to_dir',
                    ($max == file_progress::INDETERMINATE) ? \core\progress\base::INDETERMINATE : $max);
            $this->startedprogress = true;
        }

        // Pass progress through to whatever handles it.
        $reporter->progress(
                ($progress == file_progress::INDETERMINATE) ? \core\progress\base::INDETERMINATE : $progress);
    }

    /**
     * Gets the progress reporter object in use for this restore UI stage.
     *
     * IMPORTANT: This progress reporter is used only for UI progress that is
     * outside the restore controller. The restore controller has its own
     * progress reporter which is used for progress during the main restore.
     * Use the restore controller's progress reporter to report progress during
     * a restore operation, not this one.
     *
     * This extra reporter is necessary because on some restore UI screens,
     * there are long-running tasks even though there is no restore controller
     * in use. There is a similar function in restore_ui. but that class is not
     * used on some stages.
     *
     * @return \core\progress\null
     */
    public function get_progress_reporter() {
        if (!$this->progressreporter) {
            $this->progressreporter = new \core\progress\null();
        }
        return $this->progressreporter;
    }

    /**
     * Sets the progress reporter that will be returned by get_progress_reporter.
     *
     * @param \core\progress\base $progressreporter Progress reporter
     */
    public function set_progress_reporter(\core\progress\base $progressreporter) {
        $this->progressreporter = $progressreporter;
    }

    /**
     * Gets an array of progress bar items that can be displayed through the restore renderer.
     * @return array Array of items for the progress bar
     */
    public function get_progress_bar() {
        global $PAGE;
        $stage = restore_ui::STAGE_COMPLETE;
        $currentstage = $this->get_stage();
        $items = array();
        while ($stage > 0) {
            $classes = array('backup_stage');
            if (floor($stage/2) == $currentstage) {
                $classes[] = 'backup_stage_next';
            } else if ($stage == $currentstage) {
                $classes[] = 'backup_stage_current';
            } else if ($stage < $currentstage) {
                $classes[] = 'backup_stage_complete';
            }
            $item = array('text' => strlen(decbin($stage)).'. '.get_string('restorestage'.$stage, 'backup'),'class' => join(' ', $classes));
            if ($stage < $currentstage && $currentstage < restore_ui::STAGE_COMPLETE) {
                //$item['link'] = new moodle_url($PAGE->url, array('restore'=>$this->get_restoreid(), 'stage'=>$stage));
            }
            array_unshift($items, $item);
            $stage = floor($stage/2);
        }
        return $items;
    }
}


/**************************
* CRON Autorestore plugin.
*
* active=0 Disable
* active=1 Enable
* active=2 Manual (Only CLI execution)
*/

function autorestore_cron() {

    $active = get_config('tool_autorestore','active');

    if ($active == '1') {
        //Start the restore process for the mbz files
        tool_autorestore::execute();
    } elseif ($active == '2') {
        mtrace("Autorestore is configured to Manual. Only cli execution is permitted");
    } else {
        mtrace("Autorestore is disabled.");
    }
}


/**
 * Class to manage the automated restore tool.
 *
 * @package     tool_autorestore
 * @copyright   2015 Universitat de les Illes Balears http://www.uib.cat
 * @author      Toni Mas, Ricardo Díaz
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_autorestore {
    /**
     * Constructor.
     */
    public function __construct() {
        // Nothing to do.
    }

    /**
     * Get all errors.
     *
     * @return array Of errors.
     */
    public static function get_errors() {
        global $DB;

        return $DB->get_records('tool_autorestore_error');
    }

    /**
     * Get file size.
     *
     * @param string $file The file, include the full path.
     * @return string Humman readable size.
     */
    public static function get_filesize($file) {
        if ( file_exists($file) ) {
            $bytes = filesize($file);

            // Human readeble.
            $sz = 'BKMGTP';

            // Decimals.
            $decimals = 2;

            // Extract the factor.
            $factor = floor((strlen($bytes) - 1) / 3);

            return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
        }
        // If file not exists, throw exception.
        throw new moodle_exception(get_string('filenotexists', 'tool_autorestore', $file));
    }

    /**
     * Send email to admins.
     *
     * @param string $logfile The log file.
     * @param int $timeelapsed The time elapsed in the execution.
     * @return void
     */
    public static function send_email($logfile, $timeelapsed) {
        
        $msg = get_string('autorestoreexecuted', 'tool_autorestore') . ".\n";
        $msg .= get_string('timetaken', 'tool_autorestore', $timeelapsed) . "\n\n";

        if ( !empty(get_config('tool_autorestore', 'logtolocation')) ) {
            if ( file_exists($logfile) ) {
                $msg .= get_string('logwrittento', 'tool_autorestore') . "\n";
                $msg .= $logfile . "\n";
                $msg .= get_string('logsize', 'tool_autorestore', tool_autorestore::get_filesize($logfile) ) . "\n\n";
            } else {
                $msg .= get_string('lognowritten', 'tool_autorestore') . "\n";
                $msg .= get_string('checkdirpermissions', 'tool_autorestore') . "\n";
                $msg .= $logtolocation . "\n\n";
            }
        } else {
            $msg .= get_string('loggingnotactive', 'tool_autorestore');
        }

        $eventdata = new stdClass();
        $eventdata->modulename        = 'moodle';
        $eventdata->component         = 'tool_autorestore';
        $eventdata->name              = 'autorestore';
        $eventdata->userfrom          = get_admin();
        $eventdata->userto            = get_admin();
        $eventdata->subject           = get_config('tool_autorestore', 'mailsubject');
        $eventdata->fullmessage       = $msg;
        $eventdata->fullmessageformat = FORMAT_PLAIN;
        $eventdata->fullmessagehtml   = '';
        $eventdata->smallmessage      = '';
        message_send($eventdata);
    }

    /**
     * Get Moodle pending moodle backups.
     *
     * @param string $backupdir The backup directory.
     * @return array Of backup files.
     */
    public static function get_moodle_backups($backupdir) {

        $backupfiles = array();
        
        if ( file_exists($backupdir) ) {
            // Get potencial backups.
            if ( $files = scandir($backupdir) ) {
                foreach ( $files as $file ) {
                    $file_info = pathinfo($backupdir.$file);
                    if ( strtolower( $file_info['extension'] ) == "mbz" ) {
                        $backupfiles[] = $file;
                    }
                }
            }
            if(sizeof($backupfiles) == 0) {
                mtrace("Backup directory ($backupdir) is empty!.");
            }
        } else {
            throw new coding_exception(get_string('invalidbackupdir', 'tool_autorestore'), $backupdir);
        }

        return $backupfiles;
    }

    /**
     * Unzip the backup. (Tedioso cuando los zips sean grandes)
     *
     * @param string $path Path to backups.
     * @param string $backupfile The backup file.
     * @return string Name of unzip directory.
     */
    public static function unzip_moodle_backup($path, $backupfile, $thelog) {

        require_once(__DIR__. '/classes/progress/cmd.php');

        $slowprogress = new \core\progress\cmd();
        $slowprogress->start_progress('', 10);

        $unpacker = new autorestore_unzip($path, $backupfile, $thelog);

        $unpacker->set_progress_reporter($slowprogress);

        $unpacker->process();

        $slowprogress->end_progress();

        return $unpacker->get_restoredir();
    }

    /**
     * Get the category of restored course backup.
     *
     * @param string $categoryname The category name.
     * @param object $thelog The logfile.
     * @return int The category id.
     */
    public static function get_categoryid($categoryname, $thelog) {
        global $CFG, $DB;

        require_once($CFG->libdir.'/coursecatlib.php');

        if ( empty($categoryname) ) {
            tool_autorestore::log($thelog, get_string('invalidcategoryname', 'tool_autorestore', $categoryname));
            // Return default category.
            $default = coursecat::get_default();
            return $default->id;
        }

        // Get category, if it exists.
        $categoryid = $DB->get_field('course_categories', 'id', array('name' => $categoryname));

        if ( !$categoryid ) {
            // Create new category.
            $data = new stdClass();
            $data->name = $categoryname;
            $category = coursecat::create($data);

            return $category->id;
        } else {
            return $categoryid;
        }
    }

    /**
     * Apply settings into restore controller.
     *
     * @param restore_controller $controller The controller.
     * @return restore_controller applid config settings.
     */
    public static function set_settings(restore_controller $controller) {
        global $CFG;

        // Include users on import?
        if ( !get_config('tool_autorestore','autorestore_include_users') ) {
            $controller->get_plan()->get_setting('users')->set_status(backup_setting::LOCKED_BY_CONFIG);
        }
        
        // Restore as "Manual enrolments"?
        if ( get_config('tool_autorestore','autorestore_include_enrol_manual') ) {
            $controller->get_plan()->get_setting('enrol_manual')->set_status(backup_setting::LOCKED_BY_CONFIG);
        }

        // Include role assignments on import?
        if ( !get_config('tool_autorestore','autorestore_include_role_assignments') ) {
            $controller->get_plan()->get_setting('role_assignments')->set_status(backup_setting::LOCKED_BY_CONFIG);
        }

        // Include activities on import?
        if ( !get_config('tool_autorestore','autorestore_include_activities') ) {
            $controller->get_plan()->get_setting('activities')->set_status(backup_setting::LOCKED_BY_CONFIG);
        }

        // Include blocks on import?
        if ( !get_config('tool_autorestore','autorestore_include_blocks') ) {
            $controller->get_plan()->get_setting('blocks')->set_status(backup_setting::LOCKED_BY_CONFIG);
        }

        // Include filters on import?
        if ( !get_config('tool_autorestore','autorestore_include_filters') ) {
            $controller->get_plan()->get_setting('filters')->set_status(backup_setting::LOCKED_BY_CONFIG);
        }

        // Include comments on import?
        if ( !get_config('tool_autorestore','autorestore_include_comments') ) {
            $controller->get_plan()->get_setting('comments')->set_status(backup_setting::LOCKED_BY_CONFIG);
        }

        // Include badges on import?
        if ( !get_config('tool_autorestore','autorestore_include_badges') ) {
            $controller->get_plan()->get_setting('badges')->set_status(backup_setting::LOCKED_BY_CONFIG);
        }

        // Include users completion on import?
        if ( !get_config('tool_autorestore','autorestore_include_userscompletion') ) {
            $controller->get_plan()->get_setting('userscompletion')->set_status(backup_setting::LOCKED_BY_CONFIG);
        }

        // Include logs on import?
        if ( !get_config('tool_autorestore','autorestore_include_logs') ) {
            $controller->get_plan()->get_setting('logs')->set_status(backup_setting::LOCKED_BY_CONFIG);
        }

        // Include histories on import?
        if ( !get_config('tool_autorestore','autorestore_include_histories') ) {
            $controller->get_plan()->get_setting('grade_histories')->set_status(backup_setting::LOCKED_BY_CONFIG);
        }

        return $controller;
    }

    /**
     * Log on file an action.
     *
     * @param file_descriptor $file The file.
     * @param string $info Action or info.
     * @return void
     */
    public static function log($file, $info, $eol="\n") {
        
        if ( !empty($file) ) {
            fwrite($file, $info.$eol);
        } else {
            echo $info . $eol;
        }

        flush();
    }

    /**
     * Final action when succeded restored backup.
     *
     * @param string $file The file restored.
     * @param string $dest Location to move the succeded backup and the backupname.
     * @return bool Succeded or not.
     */
    public static function succeded($file, $dest) {
        return rename($file, $dest);
    }

    /**
     * Check if directory exists, if it not exists, created.
     *
     * @param string $dir The full path.
     * @return bool or exception.
     */
    public static function check_dir($dir) {
        global $CFG;

        // Check.
        if ( !check_dir_exists($dir) ) {
            throw new moodle_exception(get_string('failedcreatedir', 'tool_autorestore', $dir));
        }
    }

    /**
     * Save error on database.
     *
     * @param string The error.
     * @param string The backup name.
     * @return int Error id.
     */
    public static function save_error($backupname, $error) {
        global $DB;

        $row = new stdClass();
        $row->error = $error;
        $row->backupname = $backupname;
        $row->timeexcecuted = time();

        return $DB->insert_record('tool_autorestore_error', $row);
    }

    /**
     * Clean old errors.
     *
     * @param string $backupname The backup name.
     * @return bool
     */
    public static function clean_old_errors($backupname) {
        global $DB;

        return $DB->delete_records('tool_autorestore_error', array('backupname' => $backupname));
    }


    /**
     * Execute auto restore backups.
     *
     * @return void
     */
    public static function execute() {
        global $CFG;

        require_once($CFG->dirroot . '/backup/util/includes/restore_includes.php');

        // Get configs
        $backupsdir = get_config('tool_autorestore','from'); // Get backups path.

        if ( empty($backupsdir) ) {
            $backupsdir = $CFG->dataroot . '/backups';
        }
        
        // Check.
        tool_autorestore::check_dir($backupsdir);

        $successdir = get_config('tool_autorestore','destination'); // Move succeded restored backups to this path.

        if ( empty($successdir) ) {
            $successdir = $CFG->dataroot . '/restored';
        }

        // Check.
        tool_autorestore::check_dir($successdir);

        $logtolocation = get_config('tool_autorestore','logtolocation'); // path.

        // If not defined, set the default value.
        if ( empty($logtolocation) ) {
            $logtolocation = $CFG->dataroot . '/backups';
        }
        $logtolocation = $logtolocation.'/tool_autorestore.log'; //path and default filename


        if ( file_exists($logtolocation) && !is_file($logtolocation)) {
            throw new moodle_exception(get_string('logisnotfile', 'tool_autorestore', $logtolocation));
        }

        // Check if the temporary backups dir exists.
        check_dir_exists($CFG->dataroot . '/temp/backup');

        $mailadmins         = get_config('tool_autorestore','mailadmins'); // Send email to admins.
        $mailsubject        = get_config('tool_autorestore','mailsubject'); // The subject of mail.
        $running            = get_config('tool_autorestore','running'); // Flag autorestore is running.
        $separator          = '-------------------------------------------------------------------------';

        // The log file.
        $thelog = fopen($logtolocation, 'a');
      
        // Can be execute.
        if ( !$running ) {
            
            set_config('running', true, 'tool_autorestore');
            
            // Get current time.
            $starttime = time();

            tool_autorestore::log($thelog, $separator);
            tool_autorestore::log($thelog, get_string('launched', 'tool_autorestore', userdate(time())));

            // Get all backups.
            $backupsfiles = tool_autorestore::get_moodle_backups($backupsdir);

            // Walking for each pending backup.
            foreach ( $backupsfiles as $backupfile ) {
                // Unzip Moodle backup.
                $unzipdir = tool_autorestore::unzip_moodle_backup($backupsdir, $backupfile, $thelog);

                // Restore new course.
                if ( file_exists( $CFG->dataroot . '/temp/backup/' . $unzipdir . '/course/course.xml') ) {
                    $xml = simplexml_load_file($CFG->dataroot . '/temp/backup/' . $unzipdir . '/course/course.xml');
                    $shortname = (string)($xml->shortname);
                    $fullname = (string)($xml->fullname);
                    $categoryname = (string)($xml->category->name);

                    // First step, get category id. If it not exists, create and get this id.
                    $categoryid = tool_autorestore::get_categoryid($categoryname, $thelog);

                    // Create new course.
                    tool_autorestore::log($thelog, get_string('newcourse', 'tool_autorestore', $fullname));
                    try {
                        $courseid = restore_dbops::create_new_course($fullname, $shortname, $categoryid);
                    } catch (Exception $e) {
                        tool_autorestore::log($thelog, get_string('failcreatenewcourse', 'tool_autorestore', $e->getMessage()));
                        tool_autorestore::save_error($backupfile, $e->getMessage());
                        set_config('running', false, 'tool_autorestore');
                        // Goto next course backup.
                        continue;
                    }

                    // Get super admin.
                    $admin = get_admin();

                    // Restore backup controller into course.
                    $controller = new restore_controller($unzipdir, 
                                                    $courseid,
                                                    backup::INTERACTIVE_NO, 
                                                    backup::MODE_SAMESITE, 
                                                    $admin->id,
                                                    backup::TARGET_NEW_COURSE
                                                );

                    // Set all settings.
                    $controller = tool_autorestore::set_settings($controller);

                    tool_autorestore::log($thelog, get_string('startrestoring', 'tool_autorestore'));

                    // Define output logger.
                    $controller->get_logger()->set_next(new output_indented_logger(backup::LOG_INFO, true, true));

                    // Precheck.
                    try {
                        $controller->execute_precheck(true);
                    } catch (Exception $e) {
                        tool_autorestore::log($thelog, 'failprecheck', 'tool_autorestore', $e->getMessage());
                        tool_autorestore::save_error($backupfile, $e->getMessage());
                        set_config('running', false, 'tool_autorestore');
                        continue;
                    }

                    tool_autorestore::log($thelog, get_string('executingrestore', 'tool_autorestore'));

                    // Restore backup.
                    try {
                        $controller->execute_plan();
                    } catch (Exception $e) {
                        tool_autorestore::log($thelog, get_string('failedexecuterestore', 'tool_autorestore', $e->getMessage()));
                        tool_autorestore::save_error($backupfile, $e->getMessage());
                        set_config('running', false, 'tool_autorestore');
                        continue;
                    }
                    
                    tool_autorestore::log($thelog, get_string('restoresucceded', 'tool_autorestore'));

                    // Destroy the controller.
                    $controller->destroy();

                    // Move backup to success directory.
                    if ( tool_autorestore::succeded($backupsdir. '/' .$backupfile, $successdir. '/' .$backupfile) ) {
                        tool_autorestore::log($thelog, get_string('movedbackup', 'tool_autorestore'));
                    } else {
                        tool_autorestore::log($thelog, get_string('failedmovedbackup', 'tool_autorestore'));
                    }

                    // Clean old records.
                    tool_autorestore::clean_old_errors($backupfile);

                } else {
                    tool_autorestore::log($thelog, get_string('failedopencourse', 
                                                        'tool_autorestore', 
                                                        $CFG->dataroot . '/temp/backup/' . $unzipdir . '/course/course.xml')
                                        );
                }
            }

            $timeelapsed = time() - $starttime;
            tool_autorestore::log($thelog, get_string('processcompleted', 'tool_autorestore', $timeelapsed));

            // Close the log.
            fclose($thelog);

            // Send email to admins.
            if ( $mailadmins ) {
                tool_autorestore::send_email($logtolocation, $timeelapsed);
            }
            
            mtrace("Process has completed. Time taken: $timeelapsed seconds.");
            set_config('running', false, 'tool_autorestore');

        } else {
            mtrace("Autorestore are already running.");
            tool_autorestore::log($thelog, $separator);
            tool_autorestore::log($thelog, userdate(time()).' - '.gethostname().' - Autorestore are already running.');
            tool_autorestore::log($thelog, $separator);
        }
    }
}
