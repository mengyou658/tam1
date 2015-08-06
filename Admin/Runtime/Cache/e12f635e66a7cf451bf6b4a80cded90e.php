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
<div class="page_tit">管理员列表  [ <a href="__URL__/adminInfo" class="btn_a"><span>新增管理员</span></a> ]</div>
   
  <div class="list">
  <table>
  <tr>
    <th class="line_l">帐号</th>
    <th class="line_l" width="150">昵称</th>
    <th class="line_l" width="200">添加时间</th>
    <th class="line_l" width="200">最后登录时间</th>
    <th class="line_l" width="100">登录次数</th>
    <th class="line_l" width="150">状态</th>
    <th class="line_l" width="280">操作</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="<?php echo ($list["id"]); ?>">
        <td class="mainTitle"><a href="__URL__/adminInfo/vid/<?php echo ($list["id"]); ?>"><?php echo ($list["username"]); ?></a></td>
        <td class="mainTitle"><?php echo ($list["nickname"]); ?></td>
        <td><?php echo (date("Y-m-d",$list["regtime"])); ?></td>
        <td><?php echo (date("Y-m-d",$list["lastlogintime"])); ?></td>
        <td><?php echo ($list["logintimes"]); ?></td>
        <td><?php if(($list['ischecked']) == "1"): ?>正常<?php else: ?>锁定<?php endif; ?></td>
        <td><a href="__URL__/adminInfo/vid/<?php echo ($list["id"]); ?>">编辑</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" onclick="del('<?php echo ($list["id"]); ?>');">删除</a>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
  </div>
</div>

<script>	

    function del(ids) {
    	
    	if(confirm('删除操作无法恢复，确定继续？')) {
    		$.post("__URL__/doDeleteAdmin",{ids:ids},function(res){
    			if(res=='1') {
    				ui.success('删除成功');
    				removeItem(ids);
    			}else {
    				ui.error('操作失败');
    			}
    		});
    	}
    }
    
    function removeItem(ids) {
            $('#'+ids).remove();
    }
    
    
  //鼠标移动表格效果
    $(document).ready(function(){
        $("tr[overstyle='on']").hover(
          function () {
            $(this).addClass("bg_hover");
          },

          function () {
            $(this).removeClass("bg_hover");
          }
        );
    });
</script>
</div>
</body>
</html>