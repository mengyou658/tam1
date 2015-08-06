<?php 
//session无效时候启用该代码
session_start();
$lifeTime = 3000; 
setcookie(session_name(), session_id(), time() + $lifeTime, "/");
define('APP_DEBUG',TRUE);
define('APP_NAME', 'Home');
///项目路径
define('APP_PATH', './Home/');
require './ThinkPHP/ThinkPHP.php';
?>