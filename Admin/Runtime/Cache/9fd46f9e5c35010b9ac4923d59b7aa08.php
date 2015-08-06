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
<script>
function fold(index) {
  	$('#app_'+index).slideToggle('fast');
}
</script>
<div class="so_main">
<!--导航-->
<div class="Toolbar_inbox">
<?php if(is_array($CommonMenu)): $i = 0; $__LIST__ = $CommonMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$CommonMenu): $mod = ($i % 2 );++$i;?><a href="__URL__/<?php echo ($CommonMenu["url"]); ?>" class="btn_a"><span><?php echo ($CommonMenu["name"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
<div class="topline"></div>
<form method="post" name="form1" action="__URL__/doAdmin"  enctype="multipart/form-data">
<div class="list">
	<h3 onclick="fold('1');" title="点击标题可以折叠栏目">基本资料</h3>
    <div id="app_1">
    <table>
      <tr> 
            <td width="80" align="right">用 户 名：</td>
            <td align="left"><?php if(($list["id"]) != ""): echo ($list["username"]); else: ?><input name="username" type="text" id="username" class="txt"/><?php endif; ?></td>
           </tr>
        <tr>
            <td align="right">密　　码：</td>
            <td align="left"><input name="password" type="password" id="password" class="txt"/> （不更改请留空）
            <input name="opassword" type="hidden" id="opassword" value="<?php echo ($list["password"]); ?>" /></td>
        </tr>
        <tr>
            <td align="right">状　　态：</td>
            <td align="left"><input type="radio" name="ischecked" value="1" <?php if($list['ischecked'] == 1 ): ?>checked="checked"<?php endif; ?> class="checkbox"/>
                                正常 
                             <input name="ischecked" type="radio" value="0" <?php if($list['ischecked'] == 0 ): ?>checked="checked"<?php endif; ?> class="checkbox"/>
                                锁定</td>
           </tr>
          <tr>
            <td align="right">昵　　称：</td>
            <td align="left"><input name="nickname" type="text" id="nickname" value="<?php echo ($list["nickname"]); ?>" class="txt"/></td>
           </tr>
      </table>
     </div>
<h3 onclick="fold('2');" title="点击标题可以折叠栏目">管理员权限</h3>
<div id="app_2">
	<?php if(is_array($tMenu)): $i = 0; $__LIST__ = $tMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><table>
                <tr> 
                  <td><font color="#990000"><strong> <input name="AdminStr[]" type="checkbox" id="AdminStr[]" value="<?php echo ($vos["id"]); ?>" <?php if($vos['IsSelect'] == 'Y' ): ?>checked=checked<?php endif; ?> class="checkbox"> 
                    <?php echo ($vos["name"]); ?></strong></font></td>
                </tr>
                <tr> 
                  <td> 
                      <?php if(is_array($vos["DRs"])): $k = 0; $__LIST__ = $vos["DRs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$DRs): $mod = ($k % 2 );++$k;?><input name="AdminStr[]" type="checkbox" id="AdminStr[]" value="<?php echo ($DRs["id"]); ?>" <?php if($DRs['IsSelect'] == 'Y' ): ?>checked=checked<?php endif; ?> class="checkbox"><?php echo ($DRs["name"]); ?>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
						 </td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td>&nbsp;</td>
                </tr>
              </table><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
       <div class="page_btm">
       <input type="hidden" name="id" id="id" value="<?php echo ($list["id"]); ?>" />
	 <input type="submit" class="btn_b" id="btnSubmit" value=" 确定 ">
	 <input type="reset" class="btn_b" id="btnSubmit3" value=" 还原 " />
     		</div>
    	 </div>
 </form> 
</div> 
</body>
</html>