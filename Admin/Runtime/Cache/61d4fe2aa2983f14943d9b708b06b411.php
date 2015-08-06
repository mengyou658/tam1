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

<div class="page_tit">系统菜单管理  [ <a href="javascript:void(0);" class="btn_a" onclick="addSysMenu();"><span>新增菜单</span></a> ]</div>
   
  <div class="list">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">菜单名称</th>
    <th class="line_l" width="250">链接</th>
    <th class="line_l" width="150">排序</th>
    <th class="line_l" width="150">状态</th>
    <th class="line_l" width="380">操作</th>
  </tr>
  <?php if(is_array($MenuList)): $i = 0; $__LIST__ = $MenuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="app<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo['id']); ?>"></td>
        <td class="mainTitle"><?php echo ($vo["name"]); ?></td>
        <td class="mainTitle"><?php echo ($vo["url"]); ?></td>
        <td class="mainTitle"><?php echo ($vo["sort"]); ?></td>
        <td class="mainTitle"><?php if(($vo['ischecked']) == "1"): ?>正常<?php else: ?>锁定<?php endif; ?></td>
        <td><a href="javascript:void(0);" onclick="addSysMenu(<?php echo ($vo["id"]); ?>);">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delMenu('<?php echo ($vo["id"]); ?>');">删除</a>
        </td>
      </tr>
      <?php if(is_array($vo["DRs"])): $i = 0; $__LIST__ = $vo["DRs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$DRs): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="app<?php echo ($DRs["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($DRs['id']); ?>"></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;|--<?php echo ($DRs["name"]); ?></td>
        <td><?php echo ($vo["url"]); ?>/<?php echo ($DRs["url"]); ?></td>
        <td><?php echo ($DRs["sort"]); ?></td>
        <td><?php if(($DRs['ischecked']) == "1"): ?>正常<?php else: ?>锁定<?php endif; ?></td>
        <td><a href="javascript:void(0);" onclick="addSysMenu(<?php echo ($DRs["id"]); ?>);">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delItem('<?php echo ($DRs["id"]); ?>','__URL__/doDeleteMenu');">删除</a>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
 <div class="Toolbar_inbox">
    <a href="javascript:void(0);" class="btn_a" onclick="delItem('','__URL__/doDeleteMenu');"><span>删除菜单</span></a>  <a href="javascript:void(0);" class="btn_a" onclick="addSysMenu();"><span>新增菜单</span></a>
  </div>
</div>

<script>	
//添加修改系统菜单
function addSysMenu(gid)
{
	var title = gid?'修改菜单':'新增菜单';
	gid = gid? gid:'';
	ui.box.load( "__URL__/add_menu/gid/"+ gid,{title:title});
}  
</script>
</div>
</body>
</html>