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
namespace bbbext_sample\bigbluebuttonbn;

/**
 * Completion raise_hand_twice computation class
 *
 * @package   bbbext_sample
 * @copyright 2022 onwards, Blindside Networks Inc
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author    Laurent David (laurent@call-learning.fr)
 */
class completion_component extends \mod_bigbluebuttonbn\local\bigbluebutton\extension\completion_component {
    /**
     * Get current setting for this instance
     *
     * @param int $instanceid
     * @return array
     */
    public static function get_module_completion_info(int $instanceid): array {
        global $DB;
        $completionfield = 'completion' . static::get_group() . static::get_shortname();
        return [
            $completionfield => $DB->get_field('bbbext_sample', $completionfield,
                ['bigbluebuttonbnid' => $instanceid])
        ];
    }

    /**
     * Get rule group
     *
     * This is used in the form or other location where we need to regroup the completion information.
     *
     * @return string group name such as engagement
     */
    public static function get_group(): string {
        return 'ext';
    }

    /**
     * Get rule shortname
     *
     * @return string rule shortname such as raisehand
     */
    public static function get_shortname(): string {
        return 'raisehandtwice';
    }

    /**
     * Persist information related to the completion
     *
     * @param object $data an object as provided by the mod_form.
     * @return void
     */
    public static function save_settings($data): void {
        global $DB;
        $currentdata = $DB->get_record('bbbext_sample', ['bigbluebuttonbnid' => $data->id]);
        if (empty($data->completionextraisehandtwice)) {
            return;
        }
        if (empty($currentdata)) {
            $DB->insert_record('bbbext_sample', [
                'bigbluebuttonbnid' => $data->id,
                'completionextraisehandtwice' => $data->completionextraisehandtwice
            ]);
        } else {
            $currentdata->completionextraisehandtwice = $data->completionextraisehandtwice;
            $DB->update_record('bbbext_sample', $currentdata);
        }
    }

    /**
     * Compute completion value from given logs
     *
     * @return int
     */
    public function compute_value(): int {
        return self::do_compute_aggregated_value(
            function($log) {
                $raisehandvalue = $log->data->engagement->raisehand ?? 0;
                return $raisehandvalue > 2;
            }
        );
    }
    /**
     * Get current module name (or subplugin)
     *
     * @return string module name
     */
    public static function get_module_name(): string {
        return 'bbbext_sample';
    }

}
