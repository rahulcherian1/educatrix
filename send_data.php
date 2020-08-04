<?php
ini_set('display_errors',0);
error_reporting(0);
include "admin/db_mk_connect.php";

$img_prfix = $confOps['img_prefix'];
$table_prefix = $confOps['prefix'];
global $img_prfix, $table_prefix, $NW_controller;
$student = $table_prefix . 'students';
$teacher = $table_prefix . 'teacher';
extract($_POST);

if ($type == 1) {
    //student case

    $student_exists = $NW_controller->execute_query("SELECT COUNT(*) as `count`  FROM $student WHERE `email` = '".$email."'");


    if ($student_exists[0]['count'] > 0) {
        exit('{"msg":"Email already exists!"}');
    }

    $data_array = array();
    $data_array['options']['table'] = $student;
    $data_array['data']['name'] = $name;
    $data_array['data']['email'] = $email;
    $data_array['data']['phone'] = $phone;
    $data_array['data']['skype_id'] = $skype;
    $data_array['data']['password'] = md5($passwd);
    $data_array['data']['avail_from'] = $from;
    $data_array['data']['avail_to'] = $to;
    $data_array['data']['syllabus_type'] = $syllabus;
    $data_array['data']['class'] = $class_stud;
    $data_array['data']['subject'] = implode($subjects,',');
    $data_array['data']['comments'] = $comments;
    $data_array['data']['status'] = '0';
    $data_array['data']['admin_verified'] = 0;
    $data_array['data']['date'] = strtotime("NOW");
    $data_array['options']['type'] = 'INSERT';
    $NW_controller->query_input($data_array);

    exit('{"msg":"Registration success!"}');

} else {

    $data_array = array();
    $data_array['options']['table'] = $teacher;
    $data_array['data']['name'] = $name;
    $data_array['data']['email'] = $email;
    $data_array['data']['phone'] = $phone;
    $data_array['data']['skype_id'] = $skype;
    $data_array['data']['qualification'] = $hqui;
    $data_array['data']['wages'] = $wages;
    $data_array['data']['password'] = md5($passwd);
    $data_array['data']['avail_from'] = $from;
    $data_array['data']['avail_to'] = $to;
    $data_array['data']['syllabus'] = implode($syllabus,',');
    $data_array['data']['class'] = implode($class_stud,',');
    $data_array['data']['subject'] = implode($subjects,',');
    $data_array['data']['comments'] = $comments;
    $data_array['data']['status'] = '0';
    $data_array['data']['date'] = strtotime("NOW");
    $data_array['data']['admin_verified'] = 0;

    $data_array['options']['type'] = 'INSERT';
    $NW_controller->query_input($data_array);

    exit('{"msg":"Registration success!"}');
}
