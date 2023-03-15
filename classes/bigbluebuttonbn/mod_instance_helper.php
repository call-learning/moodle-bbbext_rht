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
 * Completion raise hand twice computation class
 *
 * @package   bbbext_sample
 * @copyright 2023 onwards, Blindside Networks Inc
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author    Laurent David (laurent@call-learning.fr)
 */
class mod_instance_helper extends \mod_bigbluebuttonbn\local\extension\mod_instance_helper {
    /**
     * Is the form element enabled
     *
     * @param array $currentdata current data allowing to check if completion enabled or not.
     * @return bool
     */
    public static function completion_rule_enabled(array $currentdata): bool {
        return !empty($currentdata['completionextraisehandtwice']);
    }

    /**
     * Add additional form elements for this completion group (module editing form)
     *
     * @return array
     */
    public function add_completion_rule(): void {
        $this->mform->addElement('advcheckbox', 'completionextraisehandtwice',
            get_string('completionextraisehandtwice', 'bbbext_sample'),
            get_string('completionextraisehandtwice_desc', 'bbbext_sample'));

        $this->mform->addHelpButton('completionextraisehandtwice', 'completionextraisehandtwice',
            'bbbext_sample');
        $this->mform->disabledIf('completionextraisehandtwice', 'completion', 'neq', COMPLETION_AGGREGATION_ANY);
    }

    /**
     * Get completion added element names
     *
     * @return array
     */
    public function get_completion_elements_names(): array {
        return ['completionextraisehandtwice'];
    }
    /**
     * Get all added element names
     *
     * @return array
     */
    public function get_elements_names(): array {
        return self::get_completion_elements_names();
    }

    /**
     * Preprocess process data for completion
     *
     * @param array $defaultvalues
     * @param object $currentdata
     * @return void
     */
    public static function data_preprocessing(array &$defaultvalues, object $currentdata): void {
        // Fetch data from the submodule table.
        $completioninfo = [];
        if (!empty($currentdata->id)) {
            $completioninfo = completion_component::get_module_completion_info($currentdata->id);
        }
        $defaultvalues = array_merge($defaultvalues, $completioninfo);
    }
}
