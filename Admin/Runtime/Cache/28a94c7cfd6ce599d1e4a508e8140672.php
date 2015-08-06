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

    <div class="RootName"><?php echo ($Rs["name"]); ?> <?php if(($Rs['issys']) == "1"): ?><img src="__PUBLIC__/admin/images/icon_sys.gif"><?php endif; ?></div>
	<div class="line1px"></div>

	<form name="formList" method="post" action="__URL__/upTpl" id="formList">
    <table width="100%%"  border="0" align="center">
    <tr align="center">
      <th width="5%">选择</td>
      <th>字段标题</td>
      <th width="12%">字段名称</td>
      <th width="6%">顺序</td>
      <th width="6%">必填</td>
      <th width="6%">列表展示</td>
      <th width="6%">汇出</td>
      <th width="5%">修改</td>
      <th width="5%">删除</td>
    </tr>
    </table>	
	<?php if(is_array($GroupRs)): $i = 0; $__LIST__ = $GroupRs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$GroupRs): $mod = ($i % 2 );++$i;?><div class="RootName"><input name="GroupID[]" type="checkbox" value="<?php echo ($GroupRs["id"]); ?>" <?php if(($Rs['Group'][$GroupRs['id']]) == $GroupRs['id']): ?>checked<?php endif; ?>> &nbsp;
      <input type="hidden" name="GID[]" value="<?php echo ($GroupRs["id"]); ?>" id="GID[]" />
      <input type="text" name="GroupName[]" value="<?php if(($Rs['Group'][$GroupRs['id']]) == $GroupRs['id']): echo ($Rs['GName'][$GroupRs['id']]); else: echo ($GroupRs["name"]); endif; ?>"/>
	  </div>
	<div class="line1px"></div>
      <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
	  <?php if(is_array($GroupRs["DRs"])): $i = 0; $__LIST__ = $GroupRs["DRs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$DRs): $mod = ($i % 2 );++$i;?><tr align="center" bgcolor="#FFFFFF">
          <td width="5%"><input name="FieldID[]" type="checkbox" value="<?php echo ($DRs["id"]); ?>" <?php if(($Rs['Field'][$DRs['id']]) == $DRs['id']): ?>checked<?php endif; ?>><input name="upID[]" type="hidden" value="<?php echo ($DRs["id"]); ?>"></td>
          <td align="Left"><input type="text" value="<?php if(($Rs['Field'][$DRs['id']]) == $DRs['id']): echo ($Rs['FTitle'][$DRs['id']]); else: echo ($DRs["name"]); endif; ?>" name="name[]" style="width:150px" /> <?php if(($DRs['issys']) == "1"): ?><img src="__PUBLIC__/admin/images/icon_sys.gif"><?php endif; ?></td>
          <td width="12%"><input type="text" value="<?php echo ($DRs["fieldName"]); ?>" name="fieldName[]" style="width:100px"  readonly="readonly" /></td>
          <td width="6%"><input type="text" value="<?php echo ($DRs["sort"]); ?>" name="sort[]" style="width:40px"/></td>
          <td width="6%" bgcolor="#FFFFFF">
            <?php if(($DRs['iswrite']) == "1"): ?>是<?php endif; ?>
            <?php if(($DRs['iswrite']) == "0"): ?><font style="color:#FF0000">否</font><?php endif; ?>
          </td>
          <td width="6%" bgcolor="#FFFFFF">
            <?php if(($DRs['islist']) == "1"): ?>是<?php endif; ?>
            <?php if(($DRs['islist']) == "0"): ?><font style="color:#FF0000">否</font><?php endif; ?>
          </td>
          <td width="6%" bgcolor="#FFFFFF">
            <?php if(($DRs['isout']) == "1"): ?>是<?php endif; ?>
            <?php if(($DRs['isout']) == "0"): ?><font style="color:#FF0000">否</font><?php endif; ?>
          </td>
          <td width="5%" bgcolor="#FFFFFF"><a href="__URL__/fieldAE/id/<?php echo ($DRs["id"]); ?>/mid/<?php echo ($Rs["id"]); ?>"><img src="__PUBLIC__/admin/images/write.gif" width="17" height="16" border="0"></a></td>
          <td width="5%" bgcolor="#FFFFFF"><a href="javascript:;"  onClick="delField(<?php echo ($DRs["id"]); ?>,<?php echo ($Rs["id"]); ?>);"><img src="__PUBLIC__/admin/images/del.gif" width="17" height="16" border="0"></a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="line10px">&nbsp;</div>
<div class="Center">
  <input name="TplID" type="hidden" id="TplID" value="<?php echo ($Rs["id"]); ?>"> 
  <input type="submit" name="Submit2" value=" 保存 " class="btn_b" onClick="if(!confirm('真的进行保存吗？')) return false;">
  <input type="button" name="Submit3" value=" 修改模版 " onClick="if(!confirm('真的要修改吗？')) return false;SubmitAction(document.formList,'__URL__/saveTpl')" class="btn_b">
  <input type="button" name="Submit4" value=" 新增字段 " class="btn_b" onclick="location.href='__URL__/fieldAE/mid/<?php echo ($Rs["id"]); ?>'" />
</div>
    </form>
    </div>
 </div>
  <script>
 
 function delField(id,mid) {
	if(!confirm('真的删除该字段吗？')) return false;
	location.href='__URL__/fieldDel/id/'+id+'/mid/'+mid 
 }
 </script>