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
<title>Contact us | <?php if(($sys["indexTitle"]) != ""): echo ($sys["indexTitle"]); else: echo ($sys["title"]); endif; ?></title>
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
            <li style="list-style:none;"><a href="__APP__/contact.html"<?php echo ($contactAct); ?>>Contact us</a></li>

        </ul>
        <div class="copyright">
            <?php echo ($sys["copyright"]); ?>

            <p class="dan-lv  mt10">Website by TOTHETOP</p>
        </div>
    </div>
    <!--导航 end-->
    <!--contact us start-->
    <div class="about" style="background: none; background-color: #fcfaf3">
        <div class="share">
<a href="__APP__/contact.html" class="share1 fl"></a>
<a href="__APP__/contact.html" class="share2 fl"></a>
<p class="fl song"><?php echo ($sys["top_location"]); ?></p>
</div>
        <div class="content fl">
            <div class="location clearfix mt10">
                <h2 class="Roman fl f30">CONTACT US</h2>
                <div CLASS="mbx fr"><a href="__APP__/">HOME</a><span> > </span><a href="__APP__/contact.html">Contact us</a></div>
            </div>
            <div class="clear"></div>
                <?php echo stripslashes($sys['contact']); ?>
            <div class="share3">
              <a href="<?php echo ($sys["facebook"]); ?>" target="_blank" class="facebook"></a>
                <a href="<?php echo ($sys["twitter"]); ?>" target="_blank" class="twitter"></a>

			<span style="float:right"><a href="__APP__/carrer.html" style="width: 50px;height: 24px;margin-top: 10px;background-color: #323f26;color: #fff;line-height: 24px;border-radius: 3px;margin: 0 auto; display: block;padding-left: 5px;">Career</a></span>
            </div>
            <br>
            <div class="map mt30" align="center">
				<img src="<?php echo ($sys["map"]); ?>" style="width: 800px; height: 432px;" />
            </div>
    
      </div>
        <!--背景图 start-->
        <div class="fr contact-bj" style="background: url(<?php echo ($banner["logo"]); ?>);">


        </div>


        <!--背景图 end-->
    </div>
    <!--contact us end-->
</div>
</body>
</html>