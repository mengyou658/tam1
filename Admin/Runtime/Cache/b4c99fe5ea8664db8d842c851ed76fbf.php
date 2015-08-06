<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/style.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/admin/js/tbox/box.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/admin/css/lightbox.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/admin/css/uploadcss/uploadify.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/admin/css/uploadcss/default.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/admin/js/JSCal/css/jscal2.css" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/admin/js/JSCal/css/border-radius.css" />
<script type="text/javascript" src="__PUBLIC__/admin/js/Jquery/jquery-1.7.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/jquery.form.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/base.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/tbox/box.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/Form/CheckForm.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/JqueryUpload/swfobject.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/JqueryUpload/jquery.uploadify.v2.1.0.min.js"></script>
<script src="__PUBLIC__/admin/js/JSCal/js/jscal2.js"></script>
<script src="__PUBLIC__/admin/js/JSCal/js/unicode-letter.js"></script>
<script src="__PUBLIC__/admin/js/JSCal/js/lang/cn.js"></script>
<script src="__PUBLIC__/admin/js/jquery.lightbox.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		$(".lightbox").lightbox({
			fitToScreen: true,
			imageClickClose: false
		});
		
	});

</script>
</head>
<body>
<div class="div_body">
<div class="so_main">
<!--导航-->
<div class="Toolbar_inbox">
<?php if(is_array($CommonMenu)): $i = 0; $__LIST__ = $CommonMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$CommonMenu): $mod = ($i % 2 );++$i;?><a href="__URL__/<?php echo ($CommonMenu["url"]); ?>" class="btn_a"><span><?php echo ($CommonMenu["name"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
<div class="topline"></div>
<div class="form">

<div class="list">
	<div class="Toolbar_inbox">分组列表</div>
	<div class="spaceLine"></div>
      <table width="100%" >
        <tr overstyle='on' bgcolor="#E7E7E7">
          <td width="8%">所属模版</td>
          <td width="50%">分组名称</td>
          <td width="10%">排序</td>
          <td width="8%">删除</td>
          </tr>
		 <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr  overstyle='on'>
          <td><?php echo ($moduleName); ?></td>
          <td><?php echo ($list["name"]); ?></td>
          <td><?php echo ($list["sort"]); ?></td>
          <td><a href="__URL__/GroupDel/id/<?php echo ($list["id"]); ?>"><img src="__PUBLIC__/admin/images/no.gif"></a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
    <div class="spaceLine"></div>
	<div class="Toolbar_inbox">新增分组</div>
	<div class="spaceLine"></div>
	
	<form name="form2" method="post" action="__URL__/GroupAE" onSubmit="return CheckForm(this)">
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center">分组名称：
            <input name="name" id="name" type="text" size="30" check="^\S+" warning="请填写分组名称">
            排序：
            <input name="sort" id="sort" type="text" value="1" size="10">
            <input type="text" name="module" id="module" value="<?php echo ($module); ?>" />
            <input type="submit" class="btn_b" name="Submit" value=" 提 交 "></td>
        </tr>
      </table>
    </form>
    </div>
    </div>
 </div>