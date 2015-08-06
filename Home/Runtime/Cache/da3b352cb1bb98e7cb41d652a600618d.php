<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link href="__PUBLIC__/<?php echo ($lang); ?>/css/base.css" rel="stylesheet">
    <link href="__PUBLIC__/<?php echo ($lang); ?>/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="__PUBLIC__/<?php echo ($lang); ?>/js/jquery.js"></script>
    <script type="text/javascript" src="__PUBLIC__/<?php echo ($lang); ?>/js/phone.js"></script>
    
<script type="text/javascript"src="__PUBLIC__/<?php echo ($lang); ?>/js/slideshow/jquery.lightSlider.js"></script>

<title>Gallery | <?php if(($sys["indexTitle"]) != ""): echo ($sys["indexTitle"]); else: echo ($sys["title"]); endif; ?></title>
<meta content="<?php echo ($sys["indexKeyword"]); ?>" name="keywords" />
<meta content="<?php echo ($sys["indexDiscription"]); ?>" name="description" />
</head>
<body>
<style>
.about .csSlideOuter {
            width: 700px; height:auto;
        }
</style>
<div class="wrap">
    <!--导航 start-->
    <div class="menu fl">
        <div class="logo">
            <a href="__APP__/"><img src="<?php echo ($sys["logo"]); ?>"></a>
        </div>
        <style>
		.menu-list li .hover{ background-color: #202918}
		</style>
        <ul class="menu-list">
            <li style="list-style:none;"><a href="__APP__/"<?php echo ($indexAct); ?>>Home</a></li>
            <li style="list-style:none;"><a href="__APP__/about.html"<?php echo ($aboutAct); ?>>About us</a></li>
            <li style="list-style:none;"><a href="__APP__/granite.html"<?php echo ($graniteAct); ?>>Granite and quartz</a></li>
            <li style="list-style:none;"><a href="__APP__/hardwood.html"<?php echo ($hardwoodAct); ?>>Hardwood</a></li>
            <li style="list-style:none;"><a href="__APP__/title.html"<?php echo ($titleAct); ?>>Tiles</a></li>
            <li style="list-style:none;"><a href="__APP__/cabinets.html"<?php echo ($cabinetsAct); ?>>Cabinets</a></li>
            <li style="list-style:none;"><a href="__APP__/mantel.html"<?php echo ($mantelAct); ?>>Mantel</a></li>
            <li style="list-style:none;"><a href="__APP__/design"<?php echo ($designAct); ?>>Self Design</a></li>
            <li style="list-style:none;"><a href="__APP__/gallery.html"<?php echo ($galleryAct); ?>>Gallery</a></li>
            <li style="list-style:none;"><a href="__APP__/quote.html"<?php echo ($quoteAct); ?>>Get a quote</a></li>
            <li style="list-style:none;"><a href="__APP__/contact.html"<?php echo ($contactAct); ?>>Contact us</a></li>

        </ul>
        <div class="copyright">
            <?php echo ($sys["copyright"]); ?>

            <p class="dan-lv  mt10">Website by TOTHETOP</p>
        </div>
    </div>
    <!--导航 end-->
    <!--about start-->
    <div class="about" style="background: none">
        <div class="share">
<a href="__APP__/contact.html" class="share1 fl"></a>
<a href="__APP__/contact.html" class="share2 fl"></a>
<p class="fl song"><?php echo ($sys["top_location"]); ?></p>
</div>
        <div class="content fl">
            <div class="location clearfix mt10">
                <h2 class="Roman fl ">GALLERY</h2>
                <div CLASS="mbx fr"><a href="__APP__/">HOME</a><span> > </span><a href="__APP__/gallery.html">Gallery</a></div>
            </div>
            <div class="clear"></div>
            <p class="lg22 fw" style="text-align: center;margin:50px 0 10px 0; position: relative ">GALLERY 
            </p>





            <div class="gallery_content">
        	 <div class="gallery_btn">
             	<a id="goToPrevSlide"><img src="__PUBLIC__/<?php echo ($lang); ?>/images/tab-l2.jpg"></a>
             </div>  
             
             <div class="gallery_images " style="border: 2px solid #3e4a32; padding-bottom:10px;">
             	<ul id="imageGallery" class="gallery list-unstyled">
                	<?php if(is_array($info["attachments"])): $i = 0; $__LIST__ = $info["attachments"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-thumb="<?php echo ($vo["attachment"]); ?>"><img src="<?php echo ($vo["attachment"]); ?>" width="700" height="400"></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
             </div>
             
             <div class="gallery_btn g_btn_right">
             	<a id="goToNextSlide"><img src="__PUBLIC__/<?php echo ($lang); ?>/images/tab-r.jpg"></a>
             </div> 
             <link rel="stylesheet" type="text/css" href="__PUBLIC__/<?php echo ($lang); ?>/js/slideshow/lightSlider02.css"> 
            <script type="text/javascript">
			$(document).ready(function() {
				 var slider = $('#imageGallery').lightSlider({
					gallery:true,
					minSlide:1,
					maxSlide:1,
					loop:true,
					currentPagerPosition:'left',
					thumbWidth:86,
					width:750,
					thumbMargin:9,
					pause:5000,
					auto:true,
					
				});
				
				 $('#goToPrevSlide').click(function(){
					slider.goToPrevSlide();
				});
				$('#goToNextSlide').click(function(){
					slider.goToNextSlide();
				});
			});
			</script>   
            <div class="clearDiv"></div>
        </div>







        </div>
        <!--背景图 start-->
        <div class="fr about-bj" style="background: url(<?php echo ($banner["logo"]); ?>);">


        </div>


        <!--背景图 end-->
    </div>
    <!--about end-->
</div>
</body>
</html>