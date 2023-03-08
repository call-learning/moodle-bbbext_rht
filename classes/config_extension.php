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
namespace bbbext_sample;

use mod_bigbluebuttonbn\local\bigbluebutton\api\config;

/**
 * Completion raise hand twice computation class
 *
 * @package   bbbext_sample
 * @copyright 2023 onwards, Blindside Networks Inc
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author    Laurent David (laurent@call-learning.fr)
 */
class config_extension implements config {

    /**
     * Get current settings.
     *
     * This is not really useful right now as all the settings are in the $CFG.
     *
     * @param string $setting
     * @return string|null
     */
    public static function get(string $setting): ?string {
        $settingfullname = 'bbbext_sample_' . $setting;
        if (isset($CFG->$settingfullname)) {
            return (string) $CFG->$settingfullname;
        }
        return self::defaultvalue($setting);
    }

    /**
     * Default value for analytics callback.
     *
     * @param string $setting
     * @return string|null
     */
    public static function defaultvalue(string $setting): ?string {
        global $CFG;
        $defaults = [
            'analytics_callback_url' => $CFG->wwwroot,
            ];
        return $defaults[$setting] ?? null;
    }
}
