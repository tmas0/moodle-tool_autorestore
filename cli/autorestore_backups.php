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
 * CLI Bulk to automatic restore courses.
 *
 * @package    tool_autorestore
 * @copyright  2015 Universitat de les Illes Balears http://www.uib.es
 * @author     Toni Mas, Ricardo Díaz
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('CLI_SCRIPT', true);

require(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->libdir . '/clilib.php');

require_once(dirname(dirname(__FILE__)) . '/lib.php');

// Now get cli options.
list($options, $unrecognized) = cli_get_params(array(
    'help' => false,
),
array(
    'h' => 'help',
));

if ($unrecognized) {
    $unrecognized = implode("\n  ", $unrecognized);
    cli_error(get_string('cliunknowoption', 'admin', $unrecognized));
}

$help =
"Execute Massive Restore Course Backups.

Options:
-h, --help                 Print out this help

Example:
\$sudo -u www-data /usr/bin/php admin/tool/autorestore/cli/autorestore_backups.php
";

if ($options['help']) {
    echo $help;
    die();
}
echo "Moodle automatic restoring backup courses running ...\n";

// Emulate normal session.
cron_setup_user();

$active = get_config('tool_autorestore','active');
/*
* active=2 Manual (Only CLI execution)
* active=1 Enable (cron execution)
* active=0 Disable
*/

if ($active == '2') {
    //Start the restore process for the mbz files
    tool_autorestore::execute();
} elseif ($active == '1') {
    mtrace("Autorestore is not configured to Manual.");
} else {
    mtrace("Autorestore is disabled.");
}
