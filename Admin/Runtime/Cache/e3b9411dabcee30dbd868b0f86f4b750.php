<?php if (!defined('THINK_PATH')) exit();?><div id="createFollowGroup2"  class="list">
<form id="menu_form" action="" method="post">
	<table width="280">
        <tr>
	<td align="right"> <?php if($gid): ?>修改菜单：<?php else: ?>新增菜单：<?php endif; ?></td>
    <td align="left"><input type="text" name="name" value="<?php echo ($vo["name"]); ?>" id="name" class="text"/></td>
    </tr>
    <tr>
	<td align="right"> 所属菜单：</td>
    <td align="left">
    	<select name="cid" id="cid">
    	<option value="0">第一级菜单</option>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><option value="<?php echo ($list["id"]); ?>" <?php if(($vo["cid"]) == $list['id']): ?>selected="selected"<?php endif; ?>><?php echo ($list["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    	</td></tr>
     <tr>
	<td align="right"> 链接：</td>
    <td align="left"><input type="text" name="url" value="<?php echo ($vo["url"]); ?>" id="url" class="text"/></td></tr>
    <tr>
	<td align="right"> Icon：</td>
    <td align="left">
    	<?php for($i=0; $i<10; $i++) { ?>
        <input name="logoimg" type="radio" id="radio" value="<?php echo ($i); ?>" <?php if(($vo['logoimg']) == $i): ?>checked="checked"<?php endif; ?> class="checkbox" /> <img src="__PUBLIC__/admin/images/icon/00<?php echo ($i); ?>.png" style="width:30px; height:30px;" />&nbsp;
        	<?php if(($i) == "4"): ?><br /><?php endif; ?>
        <?php } ?>
</td></tr>
    <tr>
	<td align="right"> 排序：</td>
    <td align="left"><input type="text" name="sort" value="<?php echo ($vo["sort"]); ?>" id="sort" class="text"/></td></tr>
    <tr>
	<td align="right"> 状态：</td>
    <td align="left"><input name="ischecked" type="radio" id="radio" value="1" <?php if(($vo['ischecked']) == "1"): ?>checked="checked"<?php endif; ?> class="checkbox" />
正常
<input type="radio" name="ischecked" id="radio2" value="0"  <?php if(($vo['ischecked']) == "0"): ?>checked="checked"<?php endif; ?> class="checkbox"/>
锁定</td></tr>
	<tr><td colspan="2" align="center"><input type="hidden" name="vid" id="vid" value="<?php echo ($vo["id"]); ?>" /><input type="submit"  class="btn_b" value="确定" />
	<input type="button" onclick="ui.box.close()" class="btn_w" value="取消" /></td></tr>
    </table>
    </form>
</div>
<script>
$(document).ready(function(){
var options = {
			    	type: 'post',
			    	url: '__URL__/doSysMenu',
				    dataType: 'json',
				    success: showResponse
			 };
			$('#menu_form').submit(function() {
			    $(this).ajaxSubmit(options);
			    return false;
			}); 
	}); 
		
function showResponse(txt)
{
	if(txt.status=='0')
	{
		ui.error("菜单名称必须");
	}
	else if(txt.status=='1')
	{
		ui.error("链接必须");
	}
	else if(txt.status=='2')
	{
		ui.error("修改失败");
	}
	else if(txt.status=='3')
	{
		ui.error("更新失败");
	} 
	else
	{
		ui.success('操作成功');
		ui.box.close();
		window.location.href=window.location.href;
	}
}
</script>