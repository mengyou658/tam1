//鼠标移动表格效果
$(document).ready(function()
{
	$("tr[overstyle='on']").hover(function()
	{
		$(this).addClass("bg_hover");
	},

	function()
	{
		$(this).removeClass("bg_hover");
	});

});

////选择单个
function checkon(o)
{
	if( o.checked == true )
	{
		$(o).parents('tr').addClass('bg_on') ;
	}
	else
	{
		$(o).parents('tr').removeClass('bg_on') ;
	}
}
////选择多个   
function checkAll(o)
{
	if( o.checked == true )
	{
		$('input[type="checkbox"]').attr('checked','true');
		$('tr[overstyle="on"]').addClass("bg_on");
    }
	else
	{
		$('input[type="checkbox"]').removeAttr('checked');
		$('tr[overstyle="on"]').removeClass("bg_on");
    }
}

//获取已选择用户的ID数组
function getChecked()
{
	var gids = new Array();
	$.each($('table input:checked'), function(i, n)
	{
		if($(n).val() != 0)
		{
			gids.push( $(n).val() );
		}
	});
	return gids;
}
////删除内容
function removeObj(ids) {
	ids = ids.split(',');
	for (i = 0; i < ids.length; i++) {
		$('#app' + ids[i]).remove();
	}
}

function delItem(ids, url) {
	var length = 0;
	if (ids) {
		length = 1;
	} else {
		ids = getChecked();
		length = ids[0] == 0 ? ids.length - 1 : ids.length;
		ids = ids.toString();
	}
	
	if (ids == '') {
		ui.error('Please select a category');
		return;
	}
	
	if (!confirm("Are you sure?Delete operation will never recover"))
		return false();
	if (confirm('You will delete' + length + 'rows record，this operation will never recover，are you sure？')) {
		$.post(url, {
			ids : ids
		}, function(res) {
			if (res == '1') {
				ui.success('Delete success');
				removeObj(ids);
			} else {
				
				ui.error(res);
			}
		});
	}
}

// 添加修改系统菜单
function doItem(gid, url) {
	var title = gid ? 'Edit Item' : 'Add item';
	gid = gid ? gid : '0';
	url = url + "/gid/" + gid;
	ui.box.load(url, {
		title : title
	});
}
// 移除区块
function MoveHtml(name) {
	$("#" + name).hide("slow");
	$("#" + name).html("");
}

// 清空内容
function clearHtml(name) {
	$("#uped_" + name) .html('');
	$("#" + name).val("");
	ui.success('Success');
}

function SubmitAction(obj, Url) {
	obj.action = Url;
	obj.submit();
}

///类别排序
function upCateSort(id)
{
	var  SpanId="displayorder_"+id;
	sortVal=$("#"+SpanId).val();
	
	$("#"+SpanId).load('/admin.php/Global/upCateSort/id/'+id+'/val/'+sortVal); 
	
	ui.success('Update order Success');
		
}

//文章排序
function upSort(id,module)
{
	var  SpanId = "displayorder_"+id;
	sortVal = $("#"+SpanId).val();
	
	$("#"+SpanId).load('/admin.php/Global/upSort/id/'+id+'/val/'+sortVal+'/module/'+module); 
	
	ui.success('Update order Success');
		
}


///文章状态更换
function setActive(id,module,field)
{
	var  SpanId = field + "_" + id;	
	$("#"+SpanId).load('/admin.php/Global/setActive/id/'+id+'/module/'+module+'/field/'+field); 
}