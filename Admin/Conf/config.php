<?php
if (!defined('THINK_PATH')) exit();
$config = array(
	'DEFAULT_MODULE'			=>  'Index', //默认模块
    'URL_MODEL'					=>  '1', //URL模式
    'SESSION_AUTO_START'		=>  true, //是否开启session
	'USER_AUTH_ON'              =>  true,
    'USER_AUTH_TYPE'			=>  2,		// 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'             =>  'authId',	// 用户认证SESSION标记
    'ADMIN_AUTH_KEY'			=>  'administrator',
    'USER_AUTH_MODEL'           =>  'User',	// 默认验证数据表模型
    'AUTH_PWD_ENCODER'          =>  'md5',	// 用户认证密码加密方式
    'USER_AUTH_GATEWAY'         =>  '/Public/login',// 默认认证网关
    'NOT_AUTH_MODULE'           =>  'Public',	// 默认无需认证模块
	'TMPL_ACTION_ERROR' 		=>  '/Public/success',
	'TMPL_ACTION_SUCCESS'		=>  '/Public/success',
	'SHOW_ERROR_MSG'			=>  true
);
//$config_ver = include './config_en.inc.php';
$database = require './database.inc.php';
return array_merge($config,$database);
?>