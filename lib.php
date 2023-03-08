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
 * This file common functions and hooks for this subplugin
 *
 * @package   bbbext_sample
 * @copyright 2023 onwards, Blindside Networks Inc
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author    Laurent David  (laurent [at] call-learning [dt] fr)
 */

/**
 * Mutate parameters before we send an action to the BBB server.
 *
 * @param string $action
 * @param array $data
 * @param array $metadata
 * @return void
 */
function bbbext_sample_action_url_mutate(string $action, array &$data = [], array &$metadata = []): void {
    if ($action === "create") {
        $metadata['analytics-callback-url'] = \mod_bigbluebuttonbn\local\config::get('analytics_callback_url') ?? "";
        $data['meetingKeepEvents'] = true;
    }
}
