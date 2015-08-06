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

    
<div class="search" id="serach">
    <form method="get" name="searchform" id="searchform" action="__URL__">
    	Keyword：
        <input name="keyword" type="text" id="keyword" class="txt" value="<?php echo ($_GET['keyword']); ?>" /> 
        &nbsp;  
        <select name="cid" id="cid">
        <option value="">Please select category</option>
        <?php echo ($cateStr); ?>
        </select>  
         &nbsp;  
        Date From：<input name="startTime" id="startTime" type="text" value="<?php echo ($_GET['startTime']); ?>">
                    <script type="text/javascript">
                        RANGE_CAL_1 = new Calendar({
                            inputField: "startTime",
                            dateFormat: "%Y-%m-%d",
                            trigger: "startTime",
                            bottomBar: false,
                            onSelect: function() {
                                  this.hide();
                             }
                        });
                    </script>
        &nbsp;
        To：<input name="endTime" id="endTime" type="text" value="<?php echo ($_GET['endTime']); ?>">
				<script type="text/javascript">
                    RANGE_CAL_1 = new Calendar({
                        inputField: "endTime",
                        dateFormat: "%Y-%m-%d",
                        trigger: "endTime",
                        bottomBar: false,
                        onSelect: function() {
                              this.hide();
                         }
                    });
                </script>
       &nbsp;
        Per page：
        <select name="thisPage">
            <option value="10" <?php if(($thisPage) == "10"): ?>selected="selected"<?php endif; ?>>10</option>
            <option value="15" <?php if(($thisPage) == "15"): ?>selected="selected"<?php endif; ?>>15</option>
            <option value="20" <?php if(($thisPage) == "20"): ?>selected="selected"<?php endif; ?>>20</option>
            <option value="30" <?php if(($thisPage) == "30"): ?>selected="selected"<?php endif; ?>>30</option>
            <option value="50" <?php if(($thisPage) == "50"): ?>selected="selected"<?php endif; ?>>50</option>
            <option value="100" <?php if(($thisPage) == "100"): ?>selected="selected"<?php endif; ?>>100</option>
        </select>
        &nbsp;
        <input type="submit" value="Search" class="btn_s" />
	</form>
  <div id="search_auto"></div>
	
  </div>
<div class="line10px"></div>
<?php if(isset($list)): ?><div class="list">
<form name="form1" method="post" action="__URL__/submit">
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th class="line_l"><input type="checkbox" id="checkbox_handle"
                        onclick="checkAll(this)" value="0">Number</th>
        <?php if(is_array($listFileds)): $i = 0; $__LIST__ = $listFileds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$listFileds): $mod = ($i % 2 );++$i;?><th class="line_l"><?php echo ($listFileds["name"]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
        <th>Category</th>
        <th>Add time</th>
        <th>Sort</th>
        <th>Status</th>
        <!--<th>Recommend</th>-->
        <th>Option</th>
      </tr>
      
      <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($k % 2 );++$k;?><tr overstyle='on' id="app<?php echo ($list["id"]); ?>">
            <td class="mainTitle"><input type="checkbox" name="actID[]" id="actID[]" onclick="chkon(this)" value="<?php echo ($list['id']); ?>"> <?php echo ($list['id']); ?></td>
            <?php if(is_array($showDate)): $i = 0; $__LIST__ = $showDate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$show): $mod = ($i % 2 );++$i;?><td>
            <?php echo outDateList($show['formType'] , $list[$show['fieldName']]); ?>
            </td><?php endforeach; endif; else: echo "" ;endif; ?>
            <td><?php echo getCate($list['cid']); ?></td>
            <td><?php echo (date("Y-m-d H:i:s",$list["postdate"])); ?></td>
            <td><input type="text" name="displayorder_<?php echo ($list["id"]); ?>" value="<?php echo ($list["displayorder"]); ?>" id="displayorder_<?php echo ($list["id"]); ?>" style="width:40px;" onblur="upSort(<?php echo ($list["id"]); ?>,'<?php echo ($actModule); ?>');" /></td>
            <td title="Click to change status"><span id="ischecked_<?php echo ($list["id"]); ?>"><a href="javascript:setActive(<?php echo ($list["id"]); ?>,'<?php echo ($actModule); ?>','ischecked');"><?php echo outText($list['ischecked'],'ischecked'); ?></a></span></td>
            <!--<td title="Click to change status"><span id="isgood_<?php echo ($list["id"]); ?>"><a href="javascript:setActive(<?php echo ($list["id"]); ?>,'<?php echo ($actModule); ?>','isgood');"><?php echo outText($list['isgood'],'isgood'); ?></a></span></td>-->
            <td nowrap="nowrap"><a href="__URL__/edit/id/<?php echo ($list["id"]); ?>/bp/<?php echo ($_GET['p']); ?>">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delItem('<?php echo ($list["id"]); ?>','__URL__/doDelete');">Delete</a></eq>
            </td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
      <table>
      	<tr>
            <td bgcolor="#FFFFFF" height="35"><font color="red">Option：</font>
            <input name="act" type="radio"  class="checkbox" value="ischecked" checked="checked"/>
            Active
            <input name="act" type="radio" value="unischecked"  class="checkbox"/>
            Locked
            <!--<input name="act" type="radio" value="good"  class="checkbox"/>
            Recommend
            <input name="act" type="radio" value="ungood"  class="checkbox"/>
            Unrecommend-->
            <input name="act" type="radio" value="delete" class="checkbox"/>
            Delete
            <input name="act" type="radio" value="remove"  class="checkbox"/>
            Move
            <select name="category" id="category">
                <?php echo ($cateStr); ?>
            </select>
            <input name="submit" type="submit" class="btn_s" onclick="return confirm('Sure you want to submit?');" value="Submit"/>
            </td>
        </tr>
      </table>
    </form> 
</div>  

  <div class="Toolbar_inbox">
      <div class="page right"><?php echo ($page); ?></div>
      </div>
  </div>
  <?php else: ?>
  	<div class="Toolbar_inbox">
      		<div class="msg">No data</div>
      </div>
  </div><?php endif; ?>
</div>
<script language="javascript">

$(function(){
	$("#cid").change(function(){
			$('#keyword').trigger('keyup');
	})
	
	$('#keyword').keyup(function(){
		var cid = $("#cid").val();
		
		$.post('__URL__/search_auto/do/search',{'value':$(this).val() , 'cid' : cid},function(data){
			if(!data) $('#search_auto').html("").css('display','none');
			else $('#search_auto').html(data).css('display','block');
		});
	});
});

function insertIt(id){
	var kval=$("#s_"+id).html();
	$("#keyword").val(kval);
	$('#search_auto').html("").css('display','none');
	document.searchform.submit();
}

</script>
</body>
</html>