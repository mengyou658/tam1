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
<title>Quote | <?php if(($sys["indexTitle"]) != ""): echo ($sys["indexTitle"]); else: echo ($sys["title"]); endif; ?></title>
<meta content="<?php echo ($sys["indexKeyword"]); ?>" name="keywords" />
<meta content="<?php echo ($sys["indexDiscription"]); ?>" name="description" />
</head>
<body>
<script type="text/javascript" src="__PUBLIC__/admin/js/Jquery/jquery-1.7.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/Jquery/jqueryform.js"></script>
<script type="text/javascript">
<!--
$(function(){
	$('#feedbackform').ajaxForm(
	{
		success:       complete,  // post-submit callback
		dataType: 'json'
	});
	
	function complete(data){
		if (data.status > 0)
		{
			$('#result').html(data.info).show();
			window.setTimeout("location.href=''",1000);
		}
		else
		{
			$('#result').html(data.info).show();
			window.setTimeout("$('#result').hide('slow')",2000);
		}
	}

});
//-->
</script>
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
    <!--contact us start-->
    <div class="about quote-box" style="background: none; background-color: #fcfaf3">
        <div class="share">
<a href="__APP__/contact.html" class="share1 fl"></a>
<a href="__APP__/contact.html" class="share2 fl"></a>
<p class="fl song"><?php echo ($sys["top_location"]); ?></p>
</div>
        <div class="content fl">
            <div class="location clearfix mt10">
                <h2 class="Roman fl f30">Request a Quote</h2>

                <div CLASS="mbx fr"><a href="__APP__/">HOME</a><span> > </span><a href="__APP__/quote.html">Request a Quote</a></div>
            </div>
            <div class="clear"></div>
            <form class="quote" method="post" action="__APP__/feedback.html"  enctype="multipart/form-data" id="feedbackform">

                <p class="clearfix"><span>First Name</span><input type="text" name="FirstName"></p>

                <p class="clearfix"><span>Last Name</span><input type="text" name="LastName"></p>

                <p class="clearfix"><span>Email</span><input type="text" name="email"></p>

                <p class="clearfix"><span>Telephone</span><input type="text" name="Telephone"></p>
                <dl>
                    <dt>Postal Code</dt>
                    <dd><input type="checkbox" name="Codes[]" value="Kitchen"><span>Kitchen</span></dd>
                    <dd><input type="checkbox" name="Codes[]" value="Bathroom"><span>Bathroom</span></dd>
                    <dd><input type="checkbox" name="Codes[]" value="Flooring"><span>Flooring</span></dd>
                    <dd><input type="checkbox" name="Codes[]" value="Mantel"><span>Mantel</span></dd>
                    <dd><input type="checkbox" name="Codes[]" value="Hardwood"><span>Hardwood</span></dd>
                    <dd><input type="checkbox" name="Codes[]" value="Tiles"><span>Tiles</span></dd>
                    <dd><input type="checkbox" name="Codes[]" value="Countertops"><span>Countertops</span></dd>
                    <dd><input type="checkbox" name="Codes[]" value="Cabinets"><span>Cabinets</span></dd>
                    <dd><input type="checkbox" name="Codes[]" value="Granite"><span>Granite</span></dd>


                </dl>
                <div class="clear"></div>
                <p class="clearfix"><span>Space SqFt</span><input type="text" name="Space"></p>

                <p class="clearfix"><span>Budget</span><input type="text" name="Budget"></p>

                <p class="clearfix" style="width: 625px"><span class="fl">Comment</span><textarea class="fl" style="resize: none;" name="Comment" ></textarea>
                </p>

                <p class="clearfix file">
                    <span>File Upload</span>
                    <span class="file-img-btn">choose img
                        <input type="file" name="attachment"></span>
                </p>
                <p>
                <div id="result" style="text-align:center;letter-spacing:2px;border:1px solid #d4d4d4; background:#FFC; padding:8px 12px; margin:1px 0px 5px 0px; line-height:100%; color:#393939; font-weight:bold;float:auto; display:none; width:445px;"></div>
				<input type="hidden" name="ajax" value="1">
                </p>
				<style>
				.sub-resbtn button{display: block; width: 118px; border-radius: 5px;float: left;cursor: pointer;font-size: 13px; color: #fff; text-align: center; border:0;}
				</style>
                <p class="clearfix  sub-resbtn"><button type="submit" class="sumbit-btn">SUBMIT</button>
                <button type="reset" class="reset-btn">RESET</button></p>


            </form>


        </div>
        <!--背景图 start-->
        <div class="fr quote-bj" style="background: url(<?php echo ($banner["logo"]); ?>);">


        </div>


        <!--背景图 end-->
    </div>
    <!--contact us end-->
</div>
</body>
</html>