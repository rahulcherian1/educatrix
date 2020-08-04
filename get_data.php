<?php

include "admin/db_mk_connect.php";

$img_prfix = $confOps['img_prefix'];
$table_prefix = $confOps['prefix'];
global $img_prfix, $table_prefix, $NW_controller;
$sy = $table_prefix . 'syllabus';
$su = $table_prefix . 'subjects';
$cl = $table_prefix . 'class';
$subdata = $NW_controller->execute_query(" SELECT `id`,`subject`  FROM $su WHERE `status` = '1'");
$sydata = $NW_controller->execute_query(" SELECT `id`,`syllabus`  FROM $sy WHERE `status` = '1'");
$cldata = $NW_controller->execute_query(" SELECT `id`,`class`  FROM $cl WHERE `status` = '1'");
