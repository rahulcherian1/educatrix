<?php
session_start();
ini_set('display_errors',0);
error_reporting(0);
include "admin/db_mk_connect.php";

$img_prfix = $confOps['img_prefix'];
$table_prefix = $confOps['prefix'];
global $img_prfix, $table_prefix, $NW_controller;
$student = $table_prefix . 'students';
$teacher = $table_prefix . 'teacher';
extract($_POST);
$stdata = $NW_controller->execute_query(" SELECT `name`,`id`,`status`,`admin_verified` FROM $student WHERE `email` = '$email' AND `password` = '".md5($password)."' ");
$ttdata = $NW_controller->execute_query(" SELECT `name`,`id`,`status`,`admin_verified` FROM $teacher WHERE `email` = '$email' AND `password` = '".md5($password)."' ");

if (count($stdata) > 0) {
    if ($stdata[0]['status'] == 0 || $stdata[0]['admin_verified'] == 0)
        exit('{"msg":"login failed, your account is not activated contact admin"}');
    $_SESSION['uid'] = $stdata[0]['id'];
    $_SESSION['name'] = $stdata[0]['name'];
    $_SESSION['type'] = 'STUDENT';
    exit('{"msg":"login success","redirect":"student_dashboard.php"}');
}
else if (count($ttdata) > 0) {
    if ($ttdata[0]['status'] == 0 || $ttdata[0]['admin_verified'] == 0)
     exit('{"msg":"login failed, your account is not activated contact admin"}');
    $_SESSION['uid'] = $ttdata[0]['id'];
    $_SESSION['name'] = $ttdata[0]['name'];
    $_SESSION['type'] = 'TEACHER';
    exit('{"msg":"login success","redirect":"teacher_dashboard.php"}');
} else {
    exit('{"msg":"login failed incorrect email or password"}');
}
