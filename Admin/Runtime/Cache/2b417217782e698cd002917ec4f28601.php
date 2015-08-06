<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBliC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>平台登录</title>
<link href="__PUBLIC__/admin/css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/admin/js/Jquery/jquery-1.7.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/Jquery/jqueryform.js"></script>
<script type="text/javascript">
<!--
$(function(){
	$('#loginform').ajaxForm(
	{
		success:       complete,  // post-submit callback
		dataType: 'json'
	});
	
	function complete(data){
		if (data.status > 0)
		{
			$('#result').html(data.info).show();
			window.location.href = '__APP__';
		}
		else
		{
			$('#result').html(data.info).show();
		}
	}

});
   
function fleshVerify()
{ 
	//重载验证码
	var timenow = new Date().getTime();		
	$('.login_yzm').html("<img id=\"verifyImg\" SRC=\"__URL__/verify/"+timenow+"\" onClick=\"fleshVerify()\" BORDER=\"0\" ALT=\"Click to refresh verify code\" style=\"cursor:pointer\" align=\"absmiddle\">");
}
//-->
</script>
<!--[if lt IE 7]>
<script language="javascript" src="js/iepng.js"></script>
    <script type="text/javascript">
       EvPNG.fix('div, ul, img, li, input, a');  //EvPNG.fix('包含透明PNG图片的标签'); 多个标签之间用英文逗号隔开。
    </script>
<![endif]-->
<body>
<div class="login_index">
 <div class="login">
  <div class="login_box">
    <div class="login_logo"><img src="__PUBLIC__/en/images/logo.png" /></div>
    <div class="login_right">
               <h1 class="login_title">Web Management System</h1>
               <div class="login_list">
               <form id="loginform" method='post' action="__URL__/checkLogin">
                 <ul>
                   <li><span class="regist_name">Account：&nbsp;&nbsp;</span><input id="username" name="username" type="text" class="regist_list_input" value="Please input your account" onfocus="if(value=='Please input your account') {value=''}" onblur="if (value=='') {value='Please input your account'}"/></li>
                   <li><span class="regist_name">Password：</span><input name="password" type="password" class="regist_list_input"  /></li>
                   <li><span class="regist_name">Verify Code：</span><input name="verify" type="text"  class="regist_list_code" /><span class="login_yzm"><img id="verifyImg" SRC="__URL__/verify/" onClick="fleshVerify()" BORDER="0" ALT="Click to refresh verify code" style="cursor:pointer" align="absmiddle"></span></li> 
                   <li><div id="result"></div></li>                  
                   <li class="login_list_pm"><span class="regist_name_z">&nbsp;</span><input name="" type="submit" value="Login" class="login_btn" /><input name="" type="reset" value="Reset" class="login_btn_right" /></li>                 <input type="hidden" name="ajax" value="1">
                 </ul>
                 </form>
             </div>
            </div>
  </div>
  <div class="login_footer">Copyright ©2014  All rights reserved.</div>
 </div> 
</div>
</body>
</html>