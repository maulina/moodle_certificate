<?php



defined('MOODLE_INTERNAL') || die();

/** example constant */
//define('NEWMODULE_ULTIMATE_ANSWER', 42);

////////////////////////////////////////////////////////////////////////////////
// Moodle core API                                                            //
////////////////////////////////////////////////////////////////////////////////


function newmodule_supports($feature) {
    switch($feature) {
        case FEATURE_MOD_INTRO:         return true;
        default:                        return null;
    }
}


function newmodule_add_instance(stdClass $newmodule, mod_newmodule_mod_form $mform = null) {
    global $DB;

    $newmodule->timecreated = time();

    # You may have to add extra stuff in here #

    return $DB->insert_record('newmodule', $newmodule);
}

function newmodule_update_instance(stdClass $newmodule, mod_newmodule_mod_form $mform = null) {
    global $DB;

    $newmodule->timemodified = time();
    $newmodule->id = $newmodule->instance;

    # You may have to add extra stuff in here #

    return $DB->update_record('newmodule', $newmodule);
}


function newmodule_delete_instance($id) {
    global $DB;

    if (! $newmodule = $DB->get_record('newmodule', array('id' => $id))) {
        return false;
    }

    # Delete any dependent records here #

    $DB->delete_records('newmodule', array('id' => $newmodule->id));

    return true;
}


function newmodule_user_outline($course, $user, $mod, $newmodule) {

    $return = new stdClass();
    $return->time = 0;
    $return->info = '';
    return $return;
}


function newmodule_user_complete($course, $user, $mod, $newmodule) {
}


function newmodule_print_recent_activity($course, $viewfullnames, $timestart) {
    return false;  //  True if anything was printed, otherwise false
}


function newmodule_get_recent_mod_activity(&$activities, &$index, $timestart, $courseid, $cmid, $userid=0, $groupid=0) {
}


function newmodule_print_recent_mod_activity($activity, $courseid, $detail, $modnames, $viewfullnames) {
}


function newmodule_cron () {
    return true;
}


function newmodule_get_participants($newmoduleid) {
    return false;
}

function newmodule_get_extra_capabilities() {
    return array();
}

////////////////////////////////////////////////////////////////////////////////
// Gradebook API                                                              //
////////////////////////////////////////////////////////////////////////////////


function newmodule_scale_used($newmoduleid, $scaleid) {
    global $DB;

    /** @example */
    if ($scaleid and $DB->record_exists('newmodule', array('id' => $newmoduleid, 'grade' => -$scaleid))) {
        return true;
    } else {
        return false;
    }
}


function newmodule_scale_used_anywhere($scaleid) {
    global $DB;

    /** @example */
    if ($scaleid and $DB->record_exists('newmodule', array('grade' => -$scaleid))) {
        return true;
    } else {
        return false;
    }
}


function newmodule_grade_item_update(stdClass $newmodule) {
    global $CFG;
    require_once($CFG->libdir.'/gradelib.php');

    /** @example */
    $item = array();
    $item['itemname'] = clean_param($newmodule->name, PARAM_NOTAGS);
    $item['gradetype'] = GRADE_TYPE_VALUE;
    $item['grademax']  = $newmodule->grade;
    $item['grademin']  = 0;

    grade_update('mod/newmodule', $newmodule->course, 'mod', 'newmodule', $newmodule->id, 0, null, $item);
}


function newmodule_update_grades(stdClass $newmodule, $userid = 0) {
    global $CFG, $DB;
    require_once($CFG->libdir.'/gradelib.php');

    /** @example */
    $grades = array(); // populate array of grade objects indexed by userid

    grade_update('mod/newmodule', $newmodule->course, 'mod', 'newmodule', $newmodule->id, 0, $grades);
}

////////////////////////////////////////////////////////////////////////////////
// File API                                                                   //
////////////////////////////////////////////////////////////////////////////////


function newmodule_get_file_areas($course, $cm, $context) {
    return array();
}


function newmodule_pluginfile($course, $cm, $context, $filearea, array $args, $forcedownload) {
    global $DB, $CFG;

    if ($context->contextlevel != CONTEXT_MODULE) {
        send_file_not_found();
    }

    require_login($course, true, $cm);

    send_file_not_found();
}

////////////////////////////////////////////////////////////////////////////////
// Navigation API                                                             //
////////////////////////////////////////////////////////////////////////////////


function newmodule_extend_navigation(navigation_node $navref, stdclass $course, stdclass $module, cm_info $cm) {
}


function newmodule_extend_settings_navigation(settings_navigation $settingsnav, navigation_node $newmodulenode=null) {
}
