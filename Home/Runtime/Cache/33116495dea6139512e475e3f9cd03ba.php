<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<body>
<head>
    <meta  charset="utf-8" />
    <title><?php if(($sys["indexTitle"]) != ""): echo ($sys["indexTitle"]); else: echo ($sys["title"]); endif; ?></title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/<?php echo ($lang); ?>/css/public.css">
    <script src="__PUBLIC__/<?php echo ($lang); ?>/js/jquery-1.7.2.min.js" type="text/javascript" language="javascript"></script>
    <script src="__PUBLIC__/<?php echo ($lang); ?>/js/zzsc.js" type="text/javascript" language="javascript"></script>
</head>

<body>
<div class="info">
    <!--logo ang nav-->
    <div class="logo_nav width1">
        <div class="logo  left">
            <a href="#"><img src="<?php echo ($sys["logo"]); ?>"/></a>
        </div>
        <div class="nav right">
            <div class="select_company"><span class="active"><a href="#"><img src="Public/en/images/logosmall.png"/>伊丝娃儿时装公司</a></span><span><a href="#"><img src="Public/en/images/logosmall.png"/>伊丝娃儿文化传媒公司</a></span></div>
            <div class="navlist">
                <ul>
                    <li class="navfirt"><a href="index.html"><P>首页</P><span>HOME</span></a></li>
                    <li><a href="about.html"><P>关于凯莉娅</P><span>ABOUT KARLIA</span></a></li>
                    <li><a href="news.html"><P>时尚资讯</P><span>FASHION NEWS</span></a></li>
                    <li><a href="product.html"><P>产品展示</P><span>PRODUCTS</span></a></li>
                    <li><a href="about4.html"><P>加盟专区</P><span>JOIN US</span></a></li>
                    <li><a href="contact.html"><P>联系我们</P><span>CONTACT US</span></a></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="neiye_banner">
        <div class="neiye_img">
            <div class="neiyetopimg">
                <?php if(is_array($lists1)): $i = 0; $__LIST__ = $lists1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a  href="javascript:;" ><img src="<?php echo ($vo["attachment"]); ?>"/></a><?php endforeach; endif; else: echo "" ;endif; ?>
                <
            </div>
        </div>

    </div>

<div  class="neiye_content width1">
    <div class="neiyecontent_top">
        <div class="left leftbar">
            <h5>关于凯莉娅</h5>
            <p>About KARLIA</p>
            <ul>
                <li><a href="about.html" class="hover">集团简介</a></li>
                <li><a href="about1.html">董事致词</a></li>
                <li><a href="about2.html">品牌视频</a></li>
                <li><a href="about3.html">形象大片</a></li>
                <li><a href="about4.html">加盟专区</a></li>
                <li><a href="about5.html">形象门店</a></li>
            </ul>
            <div class="bott"><img src="Public/en/images/list3.png"/></div>
        </div>
        <div class="left rightbar">
            <div class="rightbar_top">
                    	<h2><a href="#">形象门店</a></h2>
                        <ul>
                        	<li><a href="index.html">首页</a></li>
                            <li><a href="index.html">关于凯莉娅</a></li>
                            <li><a href="#">形象门店</a></li>
                        </ul>
                        <script type="text/javascript">
							  $(function(){
								  $('.rightbar_top ul li:last').css({"background":"none","padding-right":"0px"});
								        })
						 </script>
                    </div>
                    <div class="rightbar_bottom">
                    	<div class="xingxiangdoor"></div>
                    </div>
                </div>
            </div>
            <div class="content-bottom">
    <div class="box">
        <div class="picbox">
            <ul class="piclist mainlist">
                <?php if(is_array($lists10)): $i = 0; $__LIST__ = $lists10;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li> <a  href="#" ><img src="<?php echo ($vo["attachment"]); ?>"/></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                <li class="last"><a href="#"><img src="Public/en/images/neiyepic5.png"/></a></li>
                <?php if(is_array($lists10)): $i = 0; $__LIST__ = $lists10;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li> <a  href="#" ><img src="<?php echo ($vo["attachment"]); ?>"/></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                <li class="last"><a href="#"><img src="Public/en/images/neiyepic5.png"/></a></li>
                <?php if(is_array($lists10)): $i = 0; $__LIST__ = $lists10;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li> <a  href="#" ><img src="<?php echo ($vo["attachment"]); ?>"/></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                <li class="last"><a href="#"><img src="Public/en/images/neiyepic5.png"/></a></li>
                <?php if(is_array($lists10)): $i = 0; $__LIST__ = $lists10;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li> <a  href="#" ><img src="<?php echo ($vo["attachment"]); ?>"/></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                <li class="last"><a href="#"><img src="Public/en/images/neiyepic5.png"/></a></li>

            </ul>
            <ul class="piclist swaplist"></ul>
        </div>
        <div class="og_prev"></div>
        <div class="og_next"></div>
    </div>
</div>
</div>
<!--foot-->
<div class="footer">
    <div class="width1 foo">
        <p class="wangzhi left">www.kerrya.com</p>
        <div class="copyright right"><a href="webmap.html" class="webmap1">网站地图</a><?php echo ($sys["top_location"]); ?></div>
    </div>
</div>
</div>
</body>
</html>