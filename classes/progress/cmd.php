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

namespace core\progress;

defined('MOODLE_INTERNAL') || die();

/**
 * Progress handler that uses a standard Moodle progress bar to display
 * progress. The Moodle progress bar cannot show indeterminate progress,
 * so we do extra output in addition to the bar.
 *
 * @package   autorestore_progress
 * @copyright 2015 Universitat de les Illes Balears.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cmd extends base {
    /**
     * @var int Number of wibble states (state0...stateN-1 classes in CSS)
     */
    const WIBBLE_STATES = 13;

    /**
     * @var \progress_bar Current progress bar.
     */
    private $bar;

    /**
     * @var string $lastwibble The last wibble.
     */
    private $lastwibble;

    /**
     * @var int $currentstate Current state.
     */
    private $currentstate = 0;

    /**
     * @var int $direction The direction.
     */
     private $direction = 1;

    /**
     * @var bool True to display names
     */
    protected $displaynames = false;

    /**
     * Constructs the progress reporter. This will output HTML code for the
     * progress bar, and an indeterminate wibbler below it.
     *
     * @param bool $startnow If true, outputs HTML immediately.
     */
    public function __construct($startnow = true) {
        if ($startnow) {
            $this->start_text();
        }
    }

    /**
     * By default, the progress section names do not display because
     * these will probably be untranslated and incomprehensible. To make them
     * display, call this method.
     *
     * @param bool $displaynames True to display names
     */
    public function set_display_names($displaynames = true) {
        $this->displaynames = $displaynames;
    }

    /**
     * Starts to output progress.
     *
     * Called in constructor and in update_progress if required.
     *
     * @throws \coding_exception If already started
     */
    public function start_text() {
        if ($this->bar) {
            throw new \coding_exception('Already started');
        }
        $this->bar = new \text_progress_trace();
        echo '.';
    }

    /**
     * Finishes output. (Progress can begin again later if there are more
     * calls to update_progress.)
     *
     * Automatically called from update_progress when progress finishes.
     */
    public function end_text() {
        // Finish progress bar.
        $this->bar->output('');
        $this->bar = null;
    }

    /**
     * When progress is updated, updates the bar.
     *
     * @see \core\progress\base::update_progress()
     */
    public function update_progress() {
        global $DB;

        // This used for prevent connection timeout on unzip bigger moodle compressed backups.
        $DB->get_records_sql('SELECT 1');

        // If finished...
        if (!$this->is_in_progress_section()) {
            if ($this->bar) {
                $this->end_text();
            }
        } else {
            if (!$this->bar) {
                $this->start_text();
            }
            // In case of indeterminate or small progress, update the wibbler
            // (up to once per second).
            if (time() != $this->lastwibble) {
                $this->lastwibble = time();
                echo '.';

                // Go on to next colour.
                $this->currentstate += $this->direction;
                if ($this->currentstate < 0 || $this->currentstate >= self::WIBBLE_STATES) {
                    $this->direction = -$this->direction;
                    $this->currentstate += 2 * $this->direction;
                }
            }

            // Get progress.
            list ($min, $max) = $this->get_progress_proportion_range();

            // Update progress bar.
            $message = '';
            if ($this->displaynames) {
                $message = $this->get_current_description();
            }
            $this->bar->output($message);

            // Flush output.
            flush();
        }
    }
}