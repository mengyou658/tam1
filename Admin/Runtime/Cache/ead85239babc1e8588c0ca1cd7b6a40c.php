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
<div class="RootName"><?php if(($Rs['id']) == ""): ?>新增字段<?php else: ?>修改字段<?php endif; ?></div>
	<div class="line1px"></div>
<form id="formlist" name="formlist"  method="post" action="__URL__/doField" onsubmit="return CheckForm(this);">
	<table width="100%">
    <tr overstyle='on'>
      <td width="20%" align="right"><font color="#FF0000">* </font>所属分组：</td>
      <td><select name="groupID" id="groupID" check="^\S+" warning="请选择分组">
		<?php if(is_array($GroupRs)): $i = 0; $__LIST__ = $GroupRs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Group): $mod = ($i % 2 );++$i;?><option value="<?php echo ($Group["id"]); ?>" <?php if(($Rs['groupID']) == $Group['id']): ?>selected<?php endif; ?>><?php echo ($Group["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select></td>
    </tr>
    <tr overstyle='on'>
      <td align="right"><font color="#FF0000">* </font>字段标题：</td>
      <td><input name="name" type="text" id="name" value="<?php echo ($Rs["name"]); ?>" size="40" maxlength="20" check="^\S+" warning="请填写字段标题"></td>
    </tr>
    <tr overstyle='on'>
      <td align="right"><font color="#FF0000">* </font>字段名称：</td>
      <td><input name="fieldName" type="text" id="fieldName" value="<?php echo ($Rs["fieldName"]); ?>" size="40" maxlength="20" check="[A-Za-z]+" warning="请填写字段名称，且只能是英文字母">
      只能用英文字母</td>
    </tr>
    <tr overstyle='on'>
      <td align="right"><font color="#FF0000">* </font>字段类型：</td>
      <td><select name="fieldType" id="fieldType">
        <option value="VARCHAR" <?php if(($Rs['fieldType']) == "VARCHAR"): ?>selected<?php endif; ?>>字符类型</option>
        <option value="INT" <?php if(($Rs['fieldType']) == "INT"): ?>selected<?php endif; ?>>数字类型(整型)</option>
        <option value="FLOAT" <?php if(($Rs['fieldType']) == "FLOAT"): ?>selected<?php endif; ?>>数字类型(浮点型)</option>
        <option value="TEXT" <?php if(($Rs['fieldType']) == "TEXT"): ?>selected<?php endif; ?>>文本类型</option>
        <option value="DATE" <?php if(($Rs['fieldType']) == "DATE"): ?>selected<?php endif; ?>>日期类型(年月日)</option>
      </select></td>
    </tr>
    <tr overstyle='on'>
      <td align="right"><font color="#FF0000">* </font>表单类型：</td>
      <td><select name="formType" id="formType">
        <option value="text" <?php if(($Rs['formType']) == "text"): ?>selected<?php endif; ?>>文本</option>
        <option value="textarea" <?php if(($Rs['formType']) == "textarea"): ?>selected<?php endif; ?>>文本框</option>
        <option value="editor" <?php if(($Rs['formType']) == "editor"): ?>selected<?php endif; ?>>编辑器</option>
        <option value="select" <?php if(($Rs['formType']) == "select"): ?>selected<?php endif; ?>>下拉选项</option>
        <option value="checkbox" <?php if(($Rs['formType']) == "checkbox"): ?>selected<?php endif; ?>>多项选择</option>
        <option value="radio" <?php if(($Rs['formType']) == "radio"): ?>selected<?php endif; ?>>单项选择</option>
        <option value="password" <?php if(($Rs['formType']) == "password"): ?>selected<?php endif; ?>>密码</option>
      	<option value="file" <?php if(($Rs['formType']) == "file"): ?>selected<?php endif; ?>>图片</option>
        <option value="filedir" <?php if(($Rs['formType']) == "filedir"): ?>selected<?php endif; ?>>图集</option>
        <option value="upfile" <?php if(($Rs['formType']) == "upfile"): ?>selected<?php endif; ?>>大文件上传</option>
        <option value="date" <?php if(($Rs['formType']) == "date"): ?>selected<?php endif; ?>>时间</option>
        <option value="city" <?php if(($Rs['formType']) == "city"): ?>selected<?php endif; ?>>省市县</option>

      </select></td>
    </tr>
    <tr overstyle='on'>
      <td align="right">默 认 值：</td>
      <td><input name="fieldValue" type="text" id="fieldValue" value="<?php echo ($Rs["fieldValue"]); ?>" size="40"></td>
    </tr>
    <tr overstyle='on'>
      <td align="right" valign="top">多项选择值：</td>
      <td><textarea name="fieldSelect" cols="40" id="fieldSelect"><?php echo ($Rs["fieldSelect"]); ?></textarea></td>
    </tr>
    <!--<tr overstyle='on'>
      <td align="right">字段长度：</td>
      <td><input name="len" type="text" id="len" value="<?php echo ($Rs["len"]); ?>" size="40" maxlength="3"></td>
    </tr>-->
    <tr overstyle='on'>
      <td align="right"><font color="#FF0000">* </font>是否必填：</td>
      <td><input type="radio" name="iswrite" value="1" <?php if(($Rs['iswrite']) == "1"): ?>checked<?php endif; ?>>
        是
          <input name="iswrite" type="radio" value="0" <?php if($Rs['iswrite'] == '' or $Rs['iswrite'] == '0'): ?>checked<?php endif; ?>>
        否</td>
    </tr>
    <tr overstyle='on'>
      <td align="right"><font color="#FF0000">* </font>列表展示：</td>
      <td><input type="radio" name="islist" value="1" <?php if(($Rs['islist']) == "1"): ?>checked<?php endif; ?>>
        是
          <input name="islist" type="radio" value="0" <?php if($Rs['islist'] == '' or $Rs['islist'] == '0'): ?>checked<?php endif; ?>>
        否</td>
    </tr>
    <tr overstyle='on'>
      <td align="right"><font color="#FF0000">* </font>表格导出：</td>
      <td><input type="radio" name="isout" value="1" <?php if(($Rs['isout']) == "1"): ?>checked<?php endif; ?>>
        是
          <input name="isout" type="radio" value="0" <?php if($Rs['isout'] == '' or $Rs['isout'] == '0'): ?>checked<?php endif; ?>>
        否</td>
    </tr>
    <tr overstyle='on'>
      <td align="right"><font color="#FF0000">* </font>搜索字段：</td>
      <td><input type="radio" name="issearch" value="1" <?php if(($Rs['issearch']) == "1"): ?>checked<?php endif; ?>>
        是
          <input name="issearch" type="radio" value="0" <?php if($Rs['issearch'] == '' or $Rs['issearch'] == '0'): ?>checked<?php endif; ?>>
        否</td>
    </tr>
    <tr overstyle='on'>
      <td align="right">排列顺序：</td>
      <td><input name="sort" type="text" id="sort" value="<?php echo ($Rs["sort"]); ?>" size="40" maxlength="2"></td>
    </tr>
    <tr overstyle='on'>
      <td align="right" valign="top">文字提示：</td>
      <td><textarea name="topic" cols="40" id="topic"><?php echo ($Rs["topic"]); ?></textarea></td>
    </tr>
    <tr overstyle='on'>
      <td align="right" valign="top">错误提示：</td>
      <td><textarea name="erro" cols="40" id="erro"><?php echo ($Rs["erro"]); ?></textarea></td>
    </tr>
    <tr overstyle='on'>
    	<td></td>
    	<td>
        <input name="len" type="hidden" id="len" value="255" size="40">
            <input name="id" type="hidden" id="id" value="<?php echo ($Rs["id"]); ?>">
            <input name="mid" type="hidden" id="mid" value="<?php echo ($mid); ?>">
            <input type="submit" name="Submit2" value=" 提 交 ">
            <input type="button" name="Submit22" value=" 返 回 " onClick="history.back();">
    </td>
    </tr>
  </table>
    </form>
</div>
</div>