<?php
if (!defined('THINK_PATH')) exit();
$config = array(
	'DEFAULT_MODULE'			=>  'Index', //默认模块
	'TMPL_PARSE_STRING'  		=>array(
     							'__APP__' => '/index.php', // 更改默认的__APP__ 替换规则
								),
	'URL_ROUTER_ON'				=>	true, 
    'URL_MODEL'					=>  '2', //URL模式
    'SESSION_AUTO_START'		=>  true, //是否开启session
	'USER_LOGIN_ON'             =>  true,
	'USER_LOGIN_KEY'            =>  'userId',	// 用户认证SESSION标记
    'USER_LOGIN_MODEL'          =>  'user',	// 默认验证数据表模型
    'LOGIN_PWD_ENCODER'         =>  'md5',	// 用户认证密码加密
	'TMPL_ACTION_ERROR' 		=>  '/Public/success',
	'TMPL_ACTION_SUCCESS'		=>  '/Public/success',
	'SHOW_ERROR_MSG'			=>  true,
	'HTML_URL_SUFFIX'			=>  '.html',
	'LANG_SWITCH_ON' 			=> true,
    'DEFAULT_LANG' 				=> 'en', // 默认语言
    'LANG_AUTO_DETECT' 			=> true, // 自动侦测语言
    'LANG_LIST'					=>'en,cn',//必须写可允许的语言列表
	'VAR_LANGUAGE'     			=> 'lang', // 默认语言切换变量
);
$routes = include 'routes.php';
//$config_ver = include './config_en.inc.php';
$database = require './database.inc.php';
return array_merge($config,$routes,$database);
?>