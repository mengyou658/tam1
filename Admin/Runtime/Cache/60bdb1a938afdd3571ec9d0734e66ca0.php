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
<div class="page_tit">[ <a href="__URL__/cate"><?php echo ($MenuTitle); ?>Category Management</a> ]  [ <a href="__URL__/cateInfo"><span>Add Top Category</span></a> ] <?php if($parentRs['id'] > 0): ?>[ <a href="__URL__/cateInfo/parentid/<?php echo ($parentRs['id']); ?>"><span>Add <font color="#BD0000">"<?php echo ($parentRs["name"]); ?>"</font> Sub Category</span></a> ]<?php endif; ?></div>

<div class="list">
	<form id="cate_form" method="post" name="cate_form"
		action="__URL__/eidt_cate" enctype="multipart/form-data">
		<table width="100%" cellpadding="5" cellspacing="1">
			<tr>
				<td width="10%" align="right"><span class="need">*</span> Category：</td>
				<td><input type="text" name="name" value="<?php echo ($vo["name"]); ?>" id="name"
					class="txt" /></td>
			</tr>
            <?php if($cid > 0): ?><tr>
				<td width="10%" align="right">Subname：</td>
				<td><input type="text" name="subname" value="<?php echo ($vo["subname"]); ?>" id="subname"
					class="txt" /></td>
			</tr><?php endif; ?>
			<tr>
				<td align="right">Sort：</td>
				<td><input type="text" name="displayorder"
					value="<?php echo ($vo["displayorder"]); ?>" id="displayorder" /></td>
			</tr>
			
			<tr>
				<td align="right">Status：</td>
				<td><input name="ischecked" type="radio" id="radio" value="1"
				<?php if($vo['ischecked'] == 1 or $vo['ischecked'] == ''): ?>checked="checked"<?php endif; ?>
					class="checkbox"/> Active <input type="radio" name="ischecked"
					id="radio2" value="0"
				<?php if(($vo['ischecked']) == "0"): ?>checked="checked"<?php endif; ?>
					class="checkbox"/> Locked</td>
			</tr>
            <!--<?php if($parentRs['id'] == 0): ?><tr>
				<td align="right">Upload Image(PC)：</td>
				<td><input name="attachment" type="file" id="attachment" /></td>
			</tr>
			<tr id="reviewImg" style="display: none">
				<td align="right">View Image(PC)：</td>
				<td colspan="3"><img id="viewImg" border="0" /></td>
			</tr>
			<?php if($vo['attachment'] != ''): ?><tr id="ImgAttach">
				<td align="right">Uploaded Image(PC)：</td>
				<td colspan="3"><span id="attachment_Html"><input
						type="hidden" name="old_attachment" value="<?php echo ($vo["attachment"]); ?>" /><a
						href="<?php echo ($vo["attachment"]); ?>" class="lightbox"><img
							src="<?php echo ($vo["attachment"]); ?>" class="sImg"></a>&nbsp;&nbsp;<input
						type="button" class="btn_b" name="dels" value=" Delete Image "
						onclick="MoveHtml('attachment_Html');"></span></td>
			</tr><?php endif; ?>
            
            <tr>
				<td align="right">Upload Image(MOBILE)：</td>
				<td><input name="doAction" type="file" id="doAction" /></td>
			</tr>
			<tr id="reviewImg" style="display: none">
				<td align="right">View Image(MOBILE)：</td>
				<td colspan="3"><img id="viewImg2" border="0" /></td>
			</tr>
			<?php if($vo['doAction'] != ''): ?><tr id="ImgAttach">
				<td align="right">Uploaded Image(MOBILE)：</td>
				<td colspan="3"><span id="attachment_Html2"><input
						type="hidden" name="old_attachment2" value="<?php echo ($vo["doAction"]); ?>" /><a
						href="<?php echo ($vo["doAction"]); ?>" class="lightbox"><img
							src="<?php echo ($vo["doAction"]); ?>" class="sImg"></a>&nbsp;&nbsp;<input
						type="button" class="btn_b" name="dels" value=" Delete Image "
						onclick="MoveHtml('attachment_Html2');"></span></td>
			</tr><?php endif; endif; ?>-->
            <tr>
				<td align="right">Module：</td>
				<td><select name="mid" id="mid">
						<?php if(is_array($moduleList)): $i = 0; $__LIST__ = $moduleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$moduleList): $mod = ($i % 2 );++$i;?><option value="<?php echo ($moduleList["id"]); ?>"
							<?php if(($moduleList["id"]) == $mid): ?>selected<?php endif; ?>
							><?php echo ($moduleList["name"]); ?>
						</option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select></td>
			</tr>
            
            <tr>
				<td width="10%" align="right"><span class="need">*</span> picture<br>(Size:700px*400px)：</td>
				<td><div class="upload_btn-group" ><input name="up" type="file" id="up" /></div><div class="picQueue" id="picQueue"></div><div id="uppic" class="outser">
                <?php echo ($ImgHtml); ?>
                </div></td>
			</tr>
            
			<tr>
				<td align="right">Description：</td>
				<td><?php echo ($editor); ?></td>
			</tr>
            
			<tr>
				<td colspan="2" align="center"><input type="hidden" name="tb"
					id="tb" value="<?php echo ($tb); ?>" /><input type="hidden" name="cid" id="cid"
					value="<?php echo ($cid); ?>" /><input type="hidden" name="id" id="id"
					value="<?php echo ($vo["id"]); ?>" /><input type="submit" class="btn_b" value="Submit" />
					<input type="button" onclick="history.go(-1)" class="btn_w"
					value="Back" /></td>
			</tr>
		</table>
	</form>
	</div>
</div>
<script>
$(document).ready(function() {
	$("#up").uploadify({
		'uploader'       : '__PUBLIC__/admin/js/JqueryUpload/uploadify.swf',
		'script'		 : '__APP__/Public/upPics',
		'scriptData'	 : {'field':'field'},
		'method'		 : 'GET',
		'queueID' 		 : 'uppic',		
		'cancelImg'      : '__PUBLIC__/admin/js/JqueryUpload/cancel.png',
		'folder'         : "__ROOT__/Attachments/upload/<?php echo date('Ymd'); ?>",
		'buttonImg' 	 : '__PUBLIC__/admin/images/browser.png',
		'queueID'        : 'picQueue',
		'fileExt' 		 : '*.jpg;*.gif;*.bmp;*.png',
		'fileDesc' 		 : '*.jpg;*.gif;*.bmp;*.png',
		'auto'           : true,
		'sizeLimit'      : '134217728',
		'multi'          : true,
		'onComplete':function(event,queueId,fileObj,response,data){
			$("#uppic").prepend(response); 
		}
	});
});
</script>