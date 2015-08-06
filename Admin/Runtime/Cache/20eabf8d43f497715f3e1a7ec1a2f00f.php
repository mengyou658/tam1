<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web Management System</title>
<link href="__PUBLIC__/admin/css/style.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/admin/css/iframe.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/admin/css/desktop.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="__PUBLIC__/admin/js/Jquery/jquery-1.7.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/desktop.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/hcooooh.js"></script>
<script type="text/JavaScript">
function logout() {
	if(!confirm("Sure you want to exit the system?")) {
		return;
	} else {
		location.href='__APP__/Public/logout';
	}	
}

window.onerror = function(){
	return true;
}
var winsize = new kwDesktop.winSize();
kwDesktop.ShowIcon = [
	<?php echo ($menulist); ?>
];
kwDesktop.environment = function(){
	var Environments = "";
	if ($.browser.msie && $.browser.version < 7) Environments = '您的浏览器版本太低，建议升級至 IE 7.0或以上版本获得最佳展示效果。<br>';
	var dir_name = document.location.pathname.substring(0,document.location.pathname.lastIndexOf("/"));
	dir_name = dir_name.substring(dir_name.lastIndexOf("/")+1);	
	return Environments;
};
KW.picsDir = '__PUBLIC__/admin/images/iframe/'; 
KW.lang.closeTitle = 'Close'; 
KW.allowMultipleInstances = true; 
KW.expandDuration = 300; 
KW.restoreDuration = 300; 
KW.marginLeft = 100; 
KW.marginTop = 10; 
KW.marginBottom = 40; 
if ($.browser.msie && $.browser.version < 8){ 
	KW.marginRight = 30; 
} else {
	KW.marginRight = 10; 
}	
KW.width = winsize.winWidth - (KW.marginLeft + KW.marginRight);
KW.height = winsize.winHeight - (KW.marginTop + KW.marginBottom);
KW.outlineType = 'kw_img'; 
KW.wrapperClassName = 'admin-style';
	var scrollNum;
	var scrollI=0;
$(document).ready(function(){
	$("#Desktop").css({width:"100%",height:winsize.winHeight}); 
	$("#Desktop").mousedown(function(){   
		$("#StartList").fadeOut("slow"); 
	});
	$("#StartList").css({width:kwDesktop.StartListWidth + 'px',height:kwDesktop.StartListHeight + 'px'}); 
	$("#Desktop").html(kwDesktop.inco()); 
	$("dd:not(:first)").hide(); 
	$("dt").click(function(){
		$("dd").slideUp("fast"); 
		$(this).next().slideDown("fast"); 
		return false;
	});
	 scrollNum=$(".scroller").length;
     setInterval("scrolling()",3500);
});
scrolling=function(){
	if(scrollI==scrollNum-1){
		scrollI=0;
		$(".scroller").eq(scrollI).animate({height:0}
		,1000
		,function(){
			$(".scroller").css('height','30px');
			} );
			
     }else{
		$(".scroller").eq(scrollI).animate({ 
        height:0
      },1000 );
		scrollI++;
		}


	}
</script>

</head>
<body>
<div id="Desktop"></div>
<div id="StartList">
  <ol id="starttoplogo"></ol>
  <div id="Menu">
    <div id="List">
    <?php if(is_array($allMenu)): $akey = 0; $__LIST__ = $allMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$allMenu): $mod = ($akey % 2 );++$akey;?><dt>
        <ol class="pics">
          <img src="__PUBLIC__/admin/images/icon/00<?php echo ($allMenu["logoimg"]); ?>.png" />
        </ol>
        <ol class="text">
          <?php echo ($allMenu["name"]); ?>
        </ol>
        <ol class="more">
        </ol>
      </dt>
      <dd>
      	<?php if(is_array($allMenu["DRs"])): $i = 0; $__LIST__ = $allMenu["DRs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$DRs): $mod = ($i % 2 );++$i;?><ul>
          <li class="pics"><img src="__PUBLIC__/admin/images/desktop/article_elite3.gif" width="9" height="15" /></li>
          <li class="text"><a href="__APP__/<?php echo ($allMenu["url"]); ?>/<?php echo ($DRs["url"]); ?>" onclick="return kwDesktop.ShowPlay(this);"><?php echo ($DRs["name"]); ?></a></li>
        </ul><?php endforeach; endif; else: echo "" ;endif; ?>
      </dd><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div>
</div>
<div id="StatusBar">
  <ol id="StartButton">
    <a href="javascript:kwDesktop.inShow('StartList');" title="Start Button"> </a>
  </ol>
  <ol id="Fast">
    <a title="Refresh" target="_self" href="__APP__?lang=<?php echo ($seslang); ?>"><img src="/Public/admin/images/icon/076.png" /></a>
		<a title="Go Home" target="_blank" href="/"><img src="/Public/admin/images/icon/086.png" /></a>
        <!--&nbsp;<span>请选择你的语言：</span>
        <?php if(is_array($web_lang)): $i = 0; $__LIST__ = $web_lang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a id="lang" title="<?php echo ($vo["lang_name"]); ?>" href="__APP__?lang=<?php echo ($vo["lang"]); ?>"<?php if($vo['lang'] == $seslang): echo ($LangAct); endif; ?>><img src="/Public/admin/images/language/<?php echo ($vo["lang_images"]); ?>.png" /><?php echo ($vo["lang_name"]); ?></a>--><?php endforeach; endif; else: echo "" ;endif; ?>
  </ol>
  <ol id="sCenter" style="padding-top:9px;">
    <div id='scroller_container'></div>
  </ol>
  <ol id="oRight">
		Administrator：<span><?php echo ($baseInfo["username"]); ?></span>Last login time：<span><?php echo (date("Y-m-d H:i:s",$baseInfo["lastlogintime"])); ?></span> [&nbsp;&nbsp;<a title="Exit" href="javascript:;" onclick="logout();"><span style="color:#FF0000; font-weight:bold">Exit</span></a>]
  </ol>
</div>
</body>
</html>