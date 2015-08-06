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
            <a href="#"><img src="Public/en/images/logo.png"/></a>
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

        
        <script type="text/javascript">
		$(function(){
			//点击换图
			$('#Gallery_bk').find('.img_box').children('a').click(function(){
				var number = $(this).attr('id');
				var bigall = $(this).parent().parent().parent().parent();
				var gsrc = $(this).children('img').attr('src');
				var hrefa = $(this).attr('data');
				bigall.find('.hover').removeClass('hover');
				$(this).addClass('hover');
				$(bigall).css('backgroundImage','url('+gsrc+')')
				$(bigall).attr('class',number)
				$(bigall).children('.Gallery_a').attr('href',hrefa);
			});
			//点击换图 end
			//自动换图
			function gos(){
				var id =  Number($('#Gallery_bk').attr('class'));
				var count = $('#Gallery_bk').find('.img_box').children('a').length;
				if ( id == count-1 ) {
					id = 0;
				}else{
					id = id+1;
				};
				
				$('#Gallery_bk').find('.hover').removeClass('hover');
				$('#Gallery_bk').find('#'+id).addClass('hover');
				$('#Gallery_bk').attr('class',id)
				$('#Gallery_bk').css('backgroundImage','url('+$('#Gallery_bk').find('#'+id).children('img').attr('src')+')');
				$('#Gallery_bk').children('.Gallery_a').attr('href',$('#Gallery_bk').find('#'+id).attr('data'));
				
				setTimeout(gos,5000);
			}
			setTimeout(gos,5000);//自动换图开关
			//自动换图 end
		});
	</script>
    	<div id="Gallery_bk" style="background:url(Public/en/images/banner/banner01.png) no-repeat center top;" class="0">
        <div class="color_title"></div>
        <a href="Public/en/images/banner/banner01.png" class="Gallery_a"></a>
        <div class="Gallery_bk_box">
        	<div class="bk_beijingbox"></div>
        	<div class="bk_box">
            	<div class="img_box">
                    <?php if(is_array($catePics)): $k = 0; $__LIST__ = $catePics;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><a data="<?php echo ($vo["attachment"]); ?>" href="javascript:;" id="<?php echo ($k-1); ?>" class="hover"><img src="<?php echo ($vo["attachment"]); ?>" class="smallpic"/></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
    </div>
        
    <!--content-->
    	<div class="content width1">
        		<div class="content-top">
                	<div class="vadio left">
                    	<a href="#" class="invideo"><img src="Public/en/images/invideo1.png"/></a>
                        <div class="dianjivideo">
                        	<div class="video-img"><a><img src="Public/en/images/video.png"/></a></div>
                            <div class="video-more"><a href="#"><img src="Public/en/images/video-more.png"/></a></div>
                        </div>
                    </div>
                    <script type="text/javascript">
								$(function() {
									//点击换图
									$('.Gallery').children('input').click(function(){
										var number = $(this).attr('id');
										var bigall = $(this).parent().parent().parent();
										bigall.find('.hover').removeClass('hover');
										bigall.find('#g'+number).addClass('hover');
										$(this).addClass('hover');
									});
									//点击换图 end
									
									//自动换图
									function gos(){
										$('.set_img').each(function() {
											var id =  Number($(this).parent().parent().find('.Gallery').children('.hover').attr('id'));
											if ( id > 3) {
												id = 0;
											}else{
												id = id+1;
											};
											$(this).parent().find('.hover').removeClass('hover');
											$(this).find('#g'+id).addClass('hover');
											$(this).parent().find('.Gallery').children('#'+id).addClass('hover');
												
										});
										setTimeout(gos,5000);
									}
									setTimeout(gos,5000);//自动换图开关
									//自动换图 end
									
								});
					</script>
                    <div class="content-banner left">
                        <div class="box_bo">
                        	<div class="box_bottom">
                                <div class="Gallery-line1"><div class="line-line"></div></div>
                                <div class="Gallery">
                                    <input type="button" id="0" class="ne hover" />
                                    <input type="button" id="1" class="ne" />
                                    <input type="button" id="2" class="ne" />
                                    <input type="button" id="3" class="ne" />
                                    <input type="button" id="4" class="ne" />
                                    
                                </div>
                                <div class="Gallery-line2"><div class="line-line"></div></div>
                            </div>

                            <div class="set_img">
                                <div class="img">
                                    <a href="javascript:;" id="g0" class="hover"><div><img src="Public/en/images/show.jpg"/></div></a>
                                    <?php if(is_array($a)): $k = 0; $__LIST__ = $a;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><a href="javascript:;" id="g<?php echo ($k); ?>" class=""><div><img src="<?php echo ($vo["logo"]); ?>"/></div></a><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>

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