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

$rform = new restore_form('index.php');

$rform->display();

echo $renderer->footer();
