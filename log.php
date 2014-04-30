<?php


defined('MOODLE_INTERNAL') || die();

global $DB;

$logs = array(
    array('module'=>'newmodule', 'action'=>'add', 'mtable'=>'newmodule', 'field'=>'name'),
    array('module'=>'newmodule', 'action'=>'update', 'mtable'=>'newmodule', 'field'=>'name'),
    array('module'=>'newmodule', 'action'=>'view', 'mtable'=>'newmodule', 'field'=>'name'),
    array('module'=>'newmodule', 'action'=>'view all', 'mtable'=>'newmodule', 'field'=>'name')
);
