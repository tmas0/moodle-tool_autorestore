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
 * Index page for automatic restore tool.
 *
 * @package		tool_autorestore
 * @copyright  	2015 Universitat de les Illes Balears http://www.uib.cat
 * @author     	Toni Mas, Ricardo Díaz
 * @license   	http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('restore_form.php');

// Security hack.
require_login();

admin_externalpage_setup('toolautorestore');

// Get context.
$context = context_system::instance();

// Restrict view.
require_capability('tool/autorestore:view', $context);

$strplugin = get_string('pluginname', 'tool_autorestore');
$title = format_string($SITE->fullname) . ': '. $strplugin;


$PAGE->set_context($context);

// Set up the page.
$indexurl = new moodle_url('/admin/tool/autorestore/index.php');
$PAGE->set_url($indexurl);
$PAGE->set_pagelayout('report');
$PAGE->set_title($title);
$PAGE->set_heading(format_string($SITE->fullname));

// Get renderer.
$renderer = $PAGE->get_renderer('tool_autorestore');

echo $renderer->header();
echo $renderer->heading($strplugin);

// Get config parameter.
$enabled = get_config('tool_autorestore', 'active');

if ( $enabled == 0 ) {
	echo $renderer->box(get_string('disabled', 'tool_autorestore'));
} else {

	// List of backups with restore errors.
	echo $renderer->heading( get_string('backupwitherrors', 'tool_autorestore'), 3 );

	if ( $errors = tool_autorestore::get_errors() ) {
		echo $renderer->print_errors($errors);
	} else {
		echo $renderer->box(get_string('nobackupswitherrors', 'tool_autorestore'));
	}

	// List of restored backups.
	echo $renderer->heading( get_string('filesrestored', 'tool_autorestore'), 3 );
	$restoreddir = get_config('tool_autorestore', 'destination');
	if ( $restoreddir && is_dir($restoreddir) ) {
		if ( $files = array_diff(scandir($restoreddir), array('..', '.', 'tool_autorestore.log')) ) {
			echo $renderer->files_restored($files);
		} else {
			echo $renderer->box(get_string('emptydirrestored', 'tool_autorestore'));          
		}
	}

	// List of pending backups.
	echo $renderer->heading( get_string('filespending', 'tool_autorestore'), 3 );
	$backupsdir = get_config('tool_autorestore', 'from');
	if ( $backupsdir && is_dir($backupsdir) ) {
		if ( $files = array_diff(scandir($backupsdir), array('..', '.', 'tool_autorestore.log')) ) {
			echo $renderer->files_pending($files);
		} else {
			echo $renderer->box(get_string('emptydirbackup', 'tool_autorestore'));          
		}
	}
}

echo $renderer->footer();
