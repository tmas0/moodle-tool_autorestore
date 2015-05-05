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
 * Renderer for automatic restore tool.
 *
 * @package     tool_autorestore
 * @copyright  	2015 Universitat de les Illes Balears http://www.uib.cat
 * @author     	Toni Mas, Ricardo Díaz
 * @license   	http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Renderer for the automatic restore tool.
 *
 * @package    tool_autorestore
 * @copyright  	2015 Universitat de les Illes Balears http://www.uib.cat
 * @author     	Toni Mas, Ricardo Díaz
 * @license   	http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_autorestore_renderer extends plugin_renderer_base {
	/**
	 * Display backups errors when it's restored.
	 *
	 * @param array $errors The errors.
	 * @return string The HTML.
	 */
	public function print_errors($errors) {
		global $CFG;

		$output = '';

		if ( $errors && is_array($errors) ) {
			// Prepare the table of errors.
			$tablecolumns = array('errordate', 'backupname', 'errortext');
			$tableheaders = array(get_string('errordate', 'tool_autorestore'),
								get_string('backupname', 'tool_autorestore'),
								get_string('errortext', 'tool_autorestore'));

			$errorstable = new flexible_table('tool_autorestore_errors');
			$errorstable->define_columns($tablecolumns);
			$errorstable->define_headers($tableheaders);
			
			// Set the sortable.
			$errorstable->sortable(true, 'errordate', SORT_DESC);
			$errorstable->sortable(true, 'backupname', SORT_DESC);
			$errorstable->no_sorting('errortext');

			foreach ($errors as $error) {
				$data = array();
				$data[] = userdate($error->timeexecuted);
				$data[] = format_string($error->backupname);
				$data[] = $error->error;
				$errorstable->add_data($data);
			}

			$output .= html_writer::table($table);
		}

		return $output;
	}
	/**
	 * Print the restored files.
	 *
	 * @param array $files The files.
	 * @return string The HTML.
	 */
	public function files_restored($files) {
		$output = '';

		if ( !empty($files) && is_array($files) ) {
			$output .= html_writer::start_tag('ul');

			foreach ( $files as $file ) {
				$output .= html_writer::start_tag('li');
				$output .= format_string($file);
				$output .= html_writer::end_tag('li');
			}
			$output .= html_writer::end_tag('ul');
		}

		return $output;
	}

	/**
	 * Print the files pending to restore.
	 *
	 * @param array $files The files.
	 * @return string The HTML.
	 */
	public function files_pending($files) {
		$output = '';

		if ( !empty($files) && is_array($files) ) {
			$output .= html_writer::start_tag('ul');

			foreach ( $files as $file ) {
				$output .= html_writer::start_tag('li');
				$output .= format_string($file);
				$output .= html_writer::end_tag('li');
			}
			$output .= html_writer::end_tag('ul');
		}

		return $output;
	}
}