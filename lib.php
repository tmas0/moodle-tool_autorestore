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

class admin_setting_special_autorestoredays extends admin_setting_configmulticheckbox2 {
    /**
     * Calls parent::__construct with specific arguments
     */
    public function __construct() {
        parent::__construct('autorestore_weekdays', get_string('automatedrestoreschedule','tool_autorestore'), get_string('automatedrestoreschedulehelp','tool_autorestore'), array(), NULL);
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


/**************************
* CRON Autorestore plugin.
*
*/

function cron() {

    //Start the restore process for the mbz files
    require_once($CFG->dirroot . '/backup/util/includes/restore_includes.php');
    

    global $CFG;
//Print_object($CFG);

    // Get configs
    $backups            = get_config('tool_autorestore','from'); // Get backups from
    $restored           = get_config('tool_autorestore','destination'); //Move restored backups to
    $norestored         = $restored.'/norestored/'; //Move NO restored backups to
    $logtolocation      = get_config('tool_autorestore','logtolocation');
    $mailadmins         = get_config('tool_autorestore','mailadmins');
    $mailsubject        = get_config('tool_autorestore','mailsubject');

    $running            = get_config('tool_autorestore','running'); //Flag autorestore is running

    $this->logfp = false; // File pointer for writing log data to
    if(!empty($logtolocation)) {
        $this->logfp = fopen($logtolocation, 'a');
    }

    if ($running==false) {
        @set_time_limit(0);
        $starttime = time();

        $this->log_line("----------------------------------------------------------------------------------\nAutorestore cron process launched at ".userdate(time())."\n");

        // Get all backups.
        $backupfiles = tool_autorestore::get_moodle_backups($backups); // $mbzArr = array(); 

        foreach ( $backupsfiles as $backupfile ) {
        //for($i=0;$i<count($mbzArr);$i++) {
            $this->log_line('Start for()'."\n\n");

            // Unzip Moodle backup.
            $unzipdir = tool_autorestore::unzip_moodle_backup($backups, $backupfile);

            // Get or create category
            if (file_exists($CFG->dataroot . '/temp/backup/' . $unzipdir . '/course/course.xml')) {
                $xml = simplexml_load_file($CFG->dataroot . '/temp/backup/' . $unzipdir . '/course/course.xml');
                $shortname = (string)($xml->shortname);
                $fullname = (string)($xml->fullname);
                $categoryname = (string)($xml->category->name);
                $DB->get_records_sql('SELECT 1');
                $categoryid = $DB->get_field('course_categories', 'id', array('name'=>$categoryname));
$DB->get_records_sql('SELECT 1');

                if (!$categoryid) {
                    $categoryid = $DB->insert_record('course_categories', (object)array(
                                      'name' => $categoryname,
                                      'parent' => 0,
                                      'visible' => 1
                                      ));
                    $DB->set_field('course_categories', 'path', '/' . $categoryid, array('id'=>$categoryid));
                }
                // Create new course
                $this->log_line("Create new course\n");
$DB->get_records_sql('SELECT 1');

                $courseid = restore_dbops::create_new_course($fullname, $shortname, $categoryid);
                $this->log_line('restore_dbops::create_new_course'."\n");
$DB->get_records_sql('SELECT 1');

                // Restore backup into course
                $controller = new restore_controller($rand, $courseid,
                                backup::INTERACTIVE_NO, backup::MODE_SAMESITE, 2,
                                backup::TARGET_NEW_COURSE);
                $this->log_line("Restore backup into course\n");
$DB->get_records_sql('SELECT 1');

                $controller->get_logger()->set_next(new output_indented_logger(backup::LOG_INFO, false, true));
                $this->log_line('get_logger()->set_next(new output_indented_logger(backup::LOG_INFO, false, true))'."\n");
$DB->get_records_sql('SELECT 1');

                $controller->execute_precheck();
                $this->log_line('execute_precheck()'."\n");
$DB->get_records_sql('SELECT 1');

		$controller->execute_plan();
                $this->log_line('execute_plan()'."\n");
$DB->get_records_sql('SELECT 1');

                //Mover backups restaurados
                $mover_backup= shell_exec('mv '.$backups."$mbzArr[$i] ".$restored);
                $this->log_line('Mover backups restaurados'."\n\n");
$DB->get_records_sql('SELECT 1');

            } else {
                $this->log_line('Failed to open course'."\n\n");
                $mover_backup= shell_exec('mv '.$backups."$mbzArr[$i] ".$norestored);
                exit('Failed to open course.xml.');
            }
            unset($xml,$shortname,$fullname,$categoryname,$categoryid,$courseid,$controller,$nmuext,$rand);
            $this->log_line('Unset variables'."\n\n");
$DB->get_records_sql('SELECT 1');
        }
    
    $timeelapsed = time() - $starttime;
    $this->log_line('Process has completed. Time taken: '.$timeelapsed.' seconds.');

    } elseif ($running==true) {
        $this->log_line("----------------------------------------------------------------------------------\n".userdate(time())." -> Autorestore cron process is running\n----------------------------------------------------------------------------------");
    }

    if ( $mailadmins ) {
        tool_autorestore::send_email($logtolocation, $timeelapsed);
        $this->log_line(get_string('emailsended', 'tool_autorestore'));
    }

    if ($this->logfp) {
        fclose($this->logfp);
    }

}//END cron

/**
* Store logging information. This does two things: uses the {@link mtrace()}
* function to print info to screen/STDOUT, and also writes log to a text file
* if a path has been specified.
* @param string $string Text to write (newline will be added automatically)
*/
function log_line($string) {
    mtrace($string);
    if ($this->logfp) {
        fwrite($this->logfp, $string . "\n");
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
     * @return int size in KB.
     */
    public static function get_filesize($file) {
        if ( file_exists($file) ) {
            return ceil(filesize($file)/1024);
        }
        // If file not exists, throw exception.
        throw new coding_exception(get_string('filenotexists', 'tool_autorestore', $file));
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
    public static function unzip_moodle_backup($path, $backupfile) {
        global $CFG;

        require_once($CFG->dirroot . '/lib/filestorage/zip_packer.php');

        // Create dirname from backup file name hash.
        $extractdir = sha1($backupfile);
        
        // Check.
        check_dir_exists($CFG->dataroot . '/temp/backup');
        
        $nmuext = new zip_packer();

        // mtrace("Starting to extract: ".$backups . $mbzArr[$i]." to: ".$CFG->dataroot . '/temp/backup/' . $rand);

        // Extract backup file.
        $nmuext->extract_to_pathname($path . $backupfile, $CFG->dataroot . '/temp/backup/' . $extractdir);

        return $extractdir;
    }
}