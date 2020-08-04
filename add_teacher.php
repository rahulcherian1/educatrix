<?php

session_start();
extract($_SESSION);
extract($_POST);

ini_set('display_errors',0);
error_reporting(0);
include "admin/db_mk_connect.php";

$img_prfix = $confOps['img_prefix'];
$table_prefix = $confOps['prefix'];
global $img_prfix, $table_prefix, $NW_controller;
$res = $table_prefix . 'student_teacher';

$chk = "SELECT  COUNT(*) AS `count`  FROM `student_teacher` WHERE `student_id` = '$uid' AND `teacher_id` = '$id'";
$cnt = $NW_controller->execute_query($chk);
$cnt =  $cnt[0]['count'];
if($cnt == 0) {
    $NW_controller->execute_query("INSERT INTO `student_teacher`(`student_id`, `teacher_id`, `approve`) VALUES ('$uid','$id',0)");
    exit("Request sent to admin!");
} else {
    exit("Request already in process!");
}
