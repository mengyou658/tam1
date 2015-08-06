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
<!--<div class="page_tit">温馨提示：点击主标题可折叠栏目 </div>-->
<form method="post" name="form1" action="__URL__/updates"  enctype="multipart/form-data">
<div class="list">
	<?php if(is_array($groupRs)): $gkey = 0; $__LIST__ = $groupRs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$groupRs): $mod = ($gkey % 2 );++$gkey;?><div class="RootName" onclick="fold('<?php echo ($gkey); ?>');"><?php echo ($groupRs["name"]); ?></div>
        <div class="line1px"></div>
        <table id="app_<?php echo ($gkey); ?>">
           <tr overstyle="on">
            <?php if(is_array($groupRs["DRs"])): $k = 0; $__LIST__ = $groupRs["DRs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$DRs): $mod = ($k % 2 );++$k;?><td width="<?php echo ($lines["0"]); ?>" align="right"><?php echo ($DRs["nameStr"]); ?></td>
                <td width="<?php echo ($lines["1"]); ?>" align="left"><?php echo ($DRs["FieldNameStr"]); ?></td>
                <?php if($k % $mTpl['perLine'] == 0): ?></tr><tr overstyle="on"><?php endif; endforeach; endif; else: echo "" ;endif; ?> 
            </tr>
            <tr overstyle='on'>
                <td></td>
                <td>
                    <input class="btn_b" type="submit" name="Submit2" value=" Submit ">
            	</td>
            </tr>
         </table><?php endforeach; endif; else: echo "" ;endif; ?>  
     <input type="hidden" name="lang" value="<?php echo ($lang); ?>" />
     </div>
 </form> 
</div> 
</body>
</html>