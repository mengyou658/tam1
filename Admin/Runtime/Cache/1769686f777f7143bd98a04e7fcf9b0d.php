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

<div class="list">
	<div class="Toolbar_inbox">模版列表</div>
	<div class="spaceLine"></div>
      <table>
        <tr overstyle='on'>
          <th width="10%">查看</td>
          <th>名称</td>
          <th width="8%">版块</td>
          <th width="5%">排序</td>
          <th width="5%">每行</td>
          <th width="15%">操作</td>
          <th width="8%">字段分组</td>
          </tr>
		 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr  overstyle='on'>
          <td align="left"><a href="__URL__/moduleFields/id/<?php echo ($list["id"]); ?>">管理模版</a> <?php if(($list['issys']) == "1"): ?><img src="__PUBLIC__/images/icon_sys.gif"><?php endif; ?></td>
          <td><?php echo ($list["name"]); ?></td>
          <td><?php echo ($list["module"]); ?></td>
          <td><?php echo ($list["sort"]); ?></td>
          <td><?php echo ($list["perLine"]); ?></td>
          <td>
              <a href="javascript:;" onClick="document.form2.name.value='<?php echo ($list["name"]); ?>';document.form2.module.value='<?php echo ($list["module"]); ?>';document.form2.oldtb.value='<?php echo ($list["module"]); ?>';document.form2.sort.value='<?php echo ($list["sort"]); ?>';document.form2.id.value='<?php echo ($list["id"]); ?>';document.form2.perLine[0].value='<?php echo ($list["perLine"]); ?>';document.form2.perLine[0].text='<?php echo ($list["perLine"]); ?>';"><img src="__PUBLIC__/admin/images/write.gif"></a>&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="javascript:;" onclick="delTpl(<?php echo ($list["id"]); ?>);" ><img src="__PUBLIC__/admin/images/no.gif"></a>
          </td>
          <td><a href="__URL__/moduleGroup/gid/<?php echo ($list["id"]); ?>"><img src="__PUBLIC__/admin/images/icon_group.png"></a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
    <div class="spaceLine"></div>
	<div class="Toolbar_inbox">新增模版</div>
	<div class="spaceLine"></div>
	
	<form name="form2" id="form2" method="post" action="__URL__/TplAE" onSubmit="return CheckForm(this)">
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center">模版名称：
            <input name="name" id="name" type="text" size="30" check="^\S+" warning="请填写模版名称">
            版块：
            <input name="module" id="module" type="text" value="<?php echo ($_GET['tb']); ?>" check="^\S+" warning="请填写版块" size="10">
            排序：
            <input name="sort" id="sort" type="text" value="1" size="10">
            每行数据：
            <select name="perLine">
            	<option value="1">1</option>
            	<option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <input type="hidden" name="oldtb" value="" id="oldtb" />
            <input type="hidden" name="id" id="id" value="" />
            <input type="submit" class="btn_b" name="Submit" value=" 提 交 "></td>
        </tr>
      </table>
    </form>
    <div class="Toolbar_inbox">
      <div class="page right"><?php echo ($page); ?></div>
      </div>
    </div>
 </div>
<script>
function delTpl(tid) {
	if(confirm("警告!确定删除模版吗?\r\n删除模版将会清空该模块下的所有信息")==true) {
		if(confirm("删除操作不可还原，确定删除？")==true) {
			location.href = "__URL__/TplDel/id/"+tid;
		}
	}
}
</script>