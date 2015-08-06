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
<div class="form2">
  <!-- 备份选项 -->
  <div id="begin_backup" style="display:none;">
    <div class="page_tit">Backup options [ <a href="javascript:void(0);" onclick="$('#begin_backup').slideUp();">Hide</a> ]</div>
    
    <div class="form2">
    <form method="post" action="__URL__/doBackUp">
    <dl class="lineD">
      <dt>Option: </dt>
      <dd>
        <input name="backup_type" type="radio" value="all" checked onclick="$('#backup_size').removeClass('lineD');$('#backup_table').slideUp();">All Backup<br/>
        <input name="backup_type" type="radio" value="custom" onclick="$('#backup_size').addClass('lineD');$('#backup_table').slideDown();">Select the backup
      </dd>
    </dl>
    <dl class="" id="backup_size">
      <dt>Volume size: </dt>
      <dd>
        <input type="text" name="sizelimit" value="1000"> K
      </dd>
    </dl>
    <dl class="" id="backup_table" style="display:none">
        <dt>Database table: </dt>
        <dd>
        <?php if(is_array($table)): $i = 0; $__LIST__ = $table;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="checkbox" name="backup_table[]" value="<?php echo ($vo["Name"]); ?>"><?php echo ($vo["Name"]); ?> ( <?php echo (formatsize($vo['Data_length'])); ?> )<br/><?php endforeach; endif; else: echo "" ;endif; ?>
        </dd>
    </dl>
    <div class="page_btm">
      <input type="submit" class="btn_b" value="Submit" />
    </div>
    </form>
  </div>
  </div>
  
  <div class="page_tit">Database Backup</div>
  <div class="Toolbar_inbox">
    <a href="javascript:void(0);" class="btn_a" onclick="$('#begin_backup').slideDown();"><span>Start Backup</span></a>
    <a href="javascript:void(0);" class="btn_a" onclick="delsql();"><span>Delete Backup</span></a>
  </div>
  
  <div class="list">
  <table id="backup_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">Filename(data/database/...)</th>
    <th class="line_l">Backup Time</th>
    <th class="line_l">File Size</th>
    <th class="line_l">Option</th>
  </tr>
  <?php if(is_array($log)): $i = 0; $__LIST__ = $log;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $filename = substr($vo['filename'], 0, -4); ?>
      <tr overstyle='on' id="backup_<?php echo ($filename); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($filename); ?>"></td>
        <td><a href="<?php echo '/data/database/'.$vo['filename']; ?>" title="Download" target="_blank"><?php echo ($vo["filename"]); ?></a></td>
        <td><?php echo ($vo["addtime"]); ?></td>
        <td><?php echo ($vo["filesize"]); ?></td>
        <td>
            <a href="<?php echo '/data/database/'.$vo['filename']; ?>">Download</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="__URL__/import/filename/<?php echo ($vo["filename"]); ?>">Restore the backup</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delsql('<?php echo ($filename); ?>');">Delete</a>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  <div class="Toolbar_inbox">
    <a href="javascript:void(0);" class="btn_a" onclick="$('#begin_backup').slideDown();"><span>Start Backup</span></a>
    <a href="javascript:void(0);" class="btn_a" onclick="delsql();"><span>Delete Backup</span></a>
  </div>
</div>
</div>
<script>

//删除备份文件
function delsql(bid)
{
	bid = bid ? bid : getChecked();
	bid = bid.toString();
	if(bid == '')
	{
		alert("请至少选择一个文件");
		return false;
	}
	if(!confirm('删除后无法恢复，确定删除？'))
		return false;

	//提交删除
	$.post("__URL__/doDeleteBackUp", {selected:bid}, function(res)
	{
		if(res == '1')
		{
			bid = bid.split(',');
			$.each(bid, function(i,n)
			{
				$('#backup_'+n).remove();
			});
			ui.success('删除成功');
		}
		else 
		{
			ui.error('删除失败');
		}
	});
}

function importsql( filename )
{
	if(!confirm('导入后数据库数据将被完全覆盖，确定导入？'))
		return false;

	window.location.href = "__URL__/import/filename/" + filename;
}
    
 
</script>

</body>
</html>