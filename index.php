<?php 
/*
*new code ->20131026
*/
header('Content-type: text/html; charset=utf8');
include 'class/ez_sql_core.php';
include 'class/ez_sql_mysql.php';
include 'config.inc.php';
include 'class/basic.php';
include 'class/route.php';
$basic=new basic();
$path=route::router();
 ?>