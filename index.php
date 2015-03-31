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
 
require_once(__DIR__ . '/../../../config.php');


// Always build the page in site context.
$context = context_system::instance();
$sitename = format_string($SITE->fullname, true, array('context' => $context));
$PAGE->set_context($context);

// Set up the page.
$indexurl = new moodle_url('/admin/tool/autorestore/index.php');
$PAGE->set_url($indexurl);
$PAGE->set_pagelayout('report');
$PAGE->set_title($sitename);
$PAGE->set_heading($sitename);

echo $OUTPUT->header();
echo $OUTPUT->heading('Automated restore');

echo "HELLO WORLD!!!";

echo $OUTPUT->footer();
