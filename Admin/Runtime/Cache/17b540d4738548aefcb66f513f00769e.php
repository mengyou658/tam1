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
<div class="page_tit">[ <a href="__URL__/cate">类别管理</a> ]  [ <a href="__URL__/cateInfo"><span>添加顶级类别</span></a> ]<?php if($parentRs['id'] > 0): ?>[ <a href="__URL__/cateInfo/parentid/<?php echo ($parentRs['id']); ?>"><span>新增<font class="need">"<?php echo ($parentRs["name"]); ?>"</font>子类别</span></a> ] [ <a href="__URL__/cate/parentid/<?php echo ($parentRs["cid"]); ?>">返回上级 <img
						src="__PUBLIC__/admin/images/icon_up.gif" width="21" height="20"
						style="vertical-align: middle" /></a> ]<?php endif; ?></div>	
	<div class="list">
		<table>
			<tr overstyle='on'>
				<th><input type="checkbox" id="checkbox_handle"
					onclick="checkAll(this)" value="0"> ID</th>
				<th>类别名称</th>
				<th>添加时间</th>
                <th>状态</th>
				<th>排序</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="app<?php echo ($list["id"]); ?>">
				<td><input type="checkbox" name="delID" id="delID"
					onclick="chkon(this)" value="<?php echo ($list['id']); ?>"> <?php echo ($list['id']); ?></td>
				<td><a href="__URL__/cate/parentid/<?php echo ($list["id"]); ?>" title="查看子类别"><img
						src="__PUBLIC__/admin/images/icon_down.gif" width="21" height="20"
						style="vertical-align: middle" />&nbsp;<?php echo ($list["name"]); ?></a> (<span
					class="need"><?php echo ($list["nums"]); ?></span>)</td>
				<td><?php echo (date("Y-m-d H:i:s",$list["postdate"])); ?></td>
                <td title="点击可直接更改状态"><span id="ischecked_<?php echo ($list["id"]); ?>"><a href="javascript:setActive(<?php echo ($list["id"]); ?>,'Category');"><?php if(($list['ischecked']) == "1"): ?>正常<?php else: ?>锁定<?php endif; ?></a></span></td>
				<td><input type="text" name="displayorder_<?php echo ($list["id"]); ?>"
					value="<?php echo ($list["displayorder"]); ?>" id="displayorder_<?php echo ($list["id"]); ?>"
					style="width: 40px;" onblur="upCateSort(<?php echo ($list["id"]); ?>);" />
				</td>
				<td>
                	<a
					href="__URL__/edit/cid/<?php echo ($list["id"]); ?>">添加内容</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                	<a
					href="__URL__/cateInfo/gid/<?php echo ($list["id"]); ?>">编辑</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a
					href="javascript:void(0);"
					onclick="delItem('<?php echo ($list["id"]); ?>','__URL__/doDeleteCate');">删除</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a
                    href="__URL__/cateInfo/parentid/<?php echo ($list["id"]); ?>">新增子类别</a>
                    </td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>

	</div>
       
    <div class="Toolbar_inbox">
        <a href="javascript:void(0);" class="btn_a" onclick="delItem('','__URL__/doDeleteCate');"><span>删除所选</span></a> 
        <a href="__URL__/cateInfo" class="btn_a"><span>添加顶级类别</span></a>
    </div>
        
</div>
</div>
</body>
</html>