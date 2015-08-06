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
    <link href="__PUBLIC__/<?php echo ($lang); ?>/css/lightSlider.css" rel="stylesheet">
    <link href="__PUBLIC__/<?php echo ($lang); ?>/css/prettify.css" rel="stylesheet">
    <script type="text/javascript" src="__PUBLIC__/<?php echo ($lang); ?>/js/jquery.js"></script>
    <script type="text/javascript" src="__PUBLIC__/<?php echo ($lang); ?>/js/jquery.lightSlider.js"></script>
    <script type="text/javascript" src="__PUBLIC__/<?php echo ($lang); ?>/js/prettify.js"></script>
    <script type="text/javascript" src="__PUBLIC__/<?php echo ($lang); ?>/js/phone.js"></script>
    <script type="text/javascript" src="__PUBLIC__/<?php echo ($lang); ?>/js/main.js"></script>
<title><?php echo ($cateInfo["name"]); ?> | Tiles | <?php if(($sys["indexTitle"]) != ""): echo ($sys["indexTitle"]); else: echo ($sys["title"]); endif; ?></title>
<meta content="<?php echo ($sys["indexKeyword"]); ?>" name="keywords" />
<meta content="<?php echo ($sys["indexDiscription"]); ?>" name="description" />
</head>
<body>

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
<style>
 .wrap{height: 1500px; background-color: #fcfaf3}
 .menu{height: 1500px}
  .cSGallery{display: none}

</style>
  <div class="about" style="background: none">
      <div class="share">
<a href="__APP__/contact.html" class="share1 fl"></a>
<a href="__APP__/contact.html" class="share2 fl"></a>
<p class="fl song"><?php echo ($sys["top_location"]); ?></p>
</div>
      <div class="content fl">
          <div class="location clearfix mt10" style="margin-bottom: 15px">
          <h2 class="Roman fl ">Mantel</h2>
            <div CLASS="mbx fr"><a href="__APP__">HOME</a><span> > </span><a href="__APP__/mantel.html">Mantel</a><span> > </span><a href="__APP__/mantel/<?php echo ($cateInfo["id"]); ?>.html"><?php echo ($cateInfo["name"]); ?></a></div>
          </div>
      <ul class="granite-menu">
		  <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="__APP__/mantel/<?php echo ($vo["id"]); ?>.html" <?php if($vo['id'] == $cateInfo['id']): ?>style="font-weight:bold"<?php endif; ?>><?php echo ($vo["name"]); ?></a><i></i></li><?php endforeach; endif; else: echo "" ;endif; ?>

      </ul>
          <div class="clear"></div>
          <?php echo stripslashes($cateInfo['content']); ?>
          <?php if(($catePics) != ""): ?><div class="abot-slide">
              <ul id="imageGallery">
                  <?php if(is_array($catePics)): $i = 0; $__LIST__ = $catePics;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-thumb="<?php echo ($vo["attachment"]); ?>">
                      <img src="<?php echo ($vo["attachment"]); ?>" />
                  <p class="text"><?php echo ($vo["displayorder"]); ?></p>
                  </li><?php endforeach; endif; else: echo "" ;endif; ?>
              </ul>
<a class="tab-l"></a>
 <a class="tab-r"></a>
      <script>
                  $(document).ready(function() {
                      $('.tab-l').on('click',function(){
                          $('.csPrev').trigger('click')

                      })
                      $('.tab-r').on('click',function(){
                          $('.csNext').trigger('click')

                      })
                      $('#imageGallery').lightSlider({
                          thumbWidth: 100,
                          gallery:true,
                          minSlide:1,
                          maxSlide:1,
                          thumbMargin: 1,
                          currentPagerPosition:'left'
                      });
                  });

              </script>

          </div><?php endif; ?>
          <div class="quartz-box">
          <ul class="quartz-list">
              <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                  <div class="img">
                      <img src="<?php echo ($vo["attachment"]); ?>" width="287" height="166">

                  </div>
                  <div class="text">
                      <dl>
                          <dt class="f14 roman" style="color: #323f26">PRODUCT NAME</dt>
                          <dd class="f13" title="<?php echo ($vo["name"]); ?>"><?php echo (substr($vo["name"],0,36)); ?></dd>
                      </dl>
                      <dl>
                          <dt class="f14 roman" style="color: #323f26">PRODUCTS NUMBER</dt>
                          <dd class="f13"><?php echo ($vo["number"]); ?> &nbsp;</dd>
                      </dl>
                  </div>

              </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
          </div>
      </div>
<!--背景图 start-->
<div class="fr quartz-bj" style="background: url(<?php echo ($banner["logo"]); ?>);">


</div>


<!--背景图 end-->
</div>

</div>
</body>
</html>