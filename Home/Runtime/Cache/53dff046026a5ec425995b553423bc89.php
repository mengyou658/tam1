<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta  charset="utf-8" />
<title>关于我们-董事致词</title>
<link rel="stylesheet" type="text/css" href="Public/en/css/public.css">
<script src="Public/en/js/jquery-1.7.2.min.js" type="text/javascript" language="javascript"></script>
<script src="Public/en/js/zzsc.js" type="text/javascript" language="javascript"></script>
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
                    	<li class="navfirt"><a href="../About/index.html"><P>首页</P><span>HOME</span></a></li>
                        <li><a href="../About/index.html"><P>关于凯莉娅</P><span>ABOUT KARLIA</span></a></li>
                        <li><a href="news.html"><P>时尚资讯</P><span>FASHION NEWS</span></a></li>
                        <li><a href="product.html"><P>产品展示</P><span>PRODUCTS</span></a></li>
                        <li><a href="../About/about4.html"><P>加盟专区</P><span>JOIN US</span></a></li>
                        <li><a href="contact.html"><P>联系我们</P><span>CONTACT US</span></a></li>
                    </ul>
                </div>
            </div>
        </div>

        
        <div class="neiye_banner">
        	<div class="neiye_img">
                <div class="neiyetopimg">
                    <a  href="javascript:;" ><img src="Public/en/images/neiyetop1.png"/></a>
                    <a  href="javascript:;" ><img src="Public/en/images/neiyetop2.png"/></a>
                    <a  href="javascript:;" ><img src="Public/en/images/neiyetop3.png"/></a>
                    <a  href="javascript:;" ><img src="Public/en/images/neiyetop4.png"/></a>
                    <a  href="javascript:;" ><img src="Public/en/images/neiyetop5.png"/></a>
                    <a  href="javascript:;" ><img src="Public/en/images/neiyetop6.png"/></a>
                 </div>
            </div>
        
        </div>
    <!--content-->
    	<!--<div class="content width1">
        		<div class="content-top">
                	<div class="vadio left"><a href="#"><img src="Public/en/images/法国凯莉娅V2_22.jpg"/></a></div>
                    <script type="text/javascript">
								$(function() {
									//点击换图
									$('.Gallery').children('input').click(function(){
										var number = $(this).attr('id');
										var bigall = $(this).parent().parent();
										bigall.find('.hover').removeClass('hover');
										bigall.find('#g'+number).addClass('hover');
										$(this).addClass('hover');
									});
									//点击换图 end
									
									//自动换图
									function gos(){
										$('.set_img').each(function() {
											var id =  Number($(this).parent().parent().find('.Gallery').children('.hover').attr('id'));
											if ( id > 4 ) {
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
                            <div class="Gallery-line1"></div>
                            <div class="Gallery">
                                <input type="button" id="0" class="ne hover" />
                                <input type="button" id="1" class="ne" />
                                <input type="button" id="2" class="ne" />
                                <input type="button" id="3" class="ne" />
                                <input type="button" id="4" class="ne" />
                                <input type="button" id="5" class="ne" />
                            </div>
                            <div class="Gallery-line2"></div>
                            </div>
                            <div class="set_img">
                                <div class="img">
                                    <a href="javascript:;" id="g0" class="hover"><div><img src="Public/en/images/法国凯莉娅V2_24.jpg"/></div></a>
                                    <a href="javascript:;" id="g1" class=""><div><img src="Public/en/images/法国凯莉娅V2_09.jpg"/></div></a>
                                    <a href="javascript:;" id="g2" class=""><div><img src="Public/en/images/banner01.png"/></div></a>
                                    <a href="javascript:;" id="g3" class=""><div><img src="Public/en/images/法国凯莉娅V2_24.jpg"/></div></a>
                                    <a href="javascript:;" id="g4" class=""><div><img src="Public/en/images/法国凯莉娅V2_09.jpg"/></div></a>
                                    <a href="javascript:;" id="g5" class=""><div><img src="Public/en/images/banner01.png"/></div></a>
                                </div>
                            </div>
                        </div>
                 </div>
                </div>
        		<div class="content-bottom">
                    <div class="box">
						<div class="picbox">
                            <ul class="piclist mainlist">
                                <li><a href="#"><img src="Public/en/images/法国凯莉娅V2_28.jpg"/></a></li>
                                <li><a href="#"><img src="Public/en/images/法国凯莉娅V2_30.jpg"/></a></li>
                                <li><a href="#"><img src="Public/en/images/法国凯莉娅V2_32.jpg"/></a></li>
                                <li class="last"><a href="#"><img src="Public/en/images/法国凯莉娅V2_34.jpg"/></a></li>
                                <li><a href="#"><img src="Public/en/images/法国凯莉娅V2_28.jpg"/></a></li>
                                <li><a href="#"><img src="Public/en/images/法国凯莉娅V2_30.jpg"/></a></li>
                                <li><a href="#"><img src="Public/en/images/法国凯莉娅V2_32.jpg"/></a></li>
                                <li class="last"><a href="#"><img src="Public/en/images/法国凯莉娅V2_34.jpg"/></a></li>
                            </ul>
                            <ul class="piclist swaplist"></ul>
                        </div>
                        <div class="og_prev"></div>
                        <div class="og_next"></div>
					</div>
                </div>
        </div>-->
        <div  class="neiye_content width1">
        	<div class="neiyecontent_top">
                <div class="left leftbar">
                	<h5>关于凯莉娅</h5>
                    <p>About KARLIA</p>
                    <ul>
                    	<li><a href="../About/index.html" class="hover">集团简介</a></li>
                        <li><a href="index.html">董事致词</a></li>
                        <li><a href="../About/about2.html">品牌视频</a></li>
                        <li><a href="../About/about3.html">形象大片</a></li>
                        <li><a href="../About/about4.html">加盟专区</a></li>
                        <li><a href="../About/about5.html">形象门店</a></li>
                    </ul>
                    <div class="bott"><img src="Public/en/images/list3.png"/></div>
                </div>
                <div class="left rightbar">
                	<div class="rightbar_top">
                    	<h2><a href="#">董事致词</a></h2>
                        <ul>
                        	<li><a href="../About/index.html">首页</a></li>
                            <li><a href="#">董事致词</a></li>
                        </ul>
                        <script type="text/javascript">
							  $(function(){
								  $('.rightbar_top ul li:last').css({"background":"none","padding-right":"0px"});
								        })
						 </script>
                    </div>
                    <div class="rightbar_bottom">
                    	<!--<table cellpadding="6" class="jituan_table">
                        	<tr>
                            	<td valign="top" align="left">
                                	<h4>法国凯莉娅集团介绍</h4>
                                    <h2>(FRENCH KARLIA GROUP Introduction of Company)</h2>
                                    <p>法国凯莉娅集团 (FRENCH KARLIA GROUP)始创于 2010年法国巴黎。</p>
                                    <p>法国是一个飘荡着浪漫气息、莹绕着丝丝优雅的城市，崇尚着自由的奔放、个性张扬的国度，并以时尚的时装闻名于世； 更是一个有着优雅女人和浪漫情怀的国度，传说中女人的天堂......着实令人向往...... 无限遐想女性优雅性感的魅力...... 全面绽放。</p>
                                    <p>凯莉娅(KARLIA)品牌灵感源自于法国人的生活观，严谨积极的工作态度，浪漫快乐的生活方式。品牌设计师兼创始人MIKE在游历法国后，希望将法国时尚的浪漫生活带入中国，因此创立了法国凯莉娅服饰品牌，为消费者打造一个具有优雅魅力，精致体验的时尚品牌。</p>
                                    <p>凯莉娅(KARLIA)女人欣赏极致优雅的自己，坚持绽放自我风采；凯莉娅(KARLIA)为精致女人而生，为极致优雅女人所追求。凯莉娅(KARLIA)通过对多种服装风格和美学的研究，找寻出最能诠释凯莉娅(KARLIA)女人浪漫梦想的设计方法，从内至外的展现凯莉娅(KARLLA)女人精致典雅的形象，无时无刻的让凯莉娅(KARLIA)女人展现最美姿态。</p>
                                    <p>法国凯莉娅集团 (FRENCH KARLIA GROUP)自创建以来，集团始终站在世界潮流的前沿，以"打造世界名牌"为目标，为大都市的时尚潮人打造极致优雅形象，并荣获中央电视台授权为其形象服装高级定制。集团一直坚持"诚信、卓越、创新、奉献"的经营理念，现已发展成为以产品研发为核心导向，集生产、营销、管理、务服为一体的多元化现代企业。在发展中始终坚持稳中求进，精益求精的发展思路，专注市场的需求，关注生产品的研发，强化人力的培养和管理。我们坚信在集团所有合作伙伴及全体的同仁不懈努力下，法国凯莉娅集团 (FRENCH KARLIA GROUP)一定会成为深受社会尊敬，同行敬仰的企业。</p>
                                </td>
                                <td valign="top" align="left"><div><img src="Public/en/images/neiyepic1.png"/></div></td>
                            </tr>
                        </table>-->
                    </div>
                </div>
            </div>
            <div class="content-bottom">
                    <div class="box">
						<div class="picbox">
                            <ul class="piclist mainlist">
                                <li><a href="#"><img src="Public/en/images/neiyepic2.png"/></a></li>
                                <li><a href="#"><img src="Public/en/images/neiyepic3.png"/></a></li>
                                <li><a href="#"><img src="Public/en/images/neiyepic4.png"/></a></li>
                                <li class="last"><a href="#"><img src="Public/en/images/neiyepic5.png"/></a></li>
                                <li><a href="#"><img src="Public/en/images/neiyepic2.png"/></a></li>
                                <li><a href="#"><img src="Public/en/images/neiyepic3.png"/></a></li>
                                <li><a href="#"><img src="Public/en/images/neiyepic4.png"/></a></li>
                                <li  class="last"><a href="#"><img src="Public/en/images/neiyepic5.png"/></a></li>
                                <li><a href="#"><img src="Public/en/images/neiyepic2.png"/></a></li>
                                <li><a href="#"><img src="Public/en/images/neiyepic3.png"/></a></li>
                                <li><a href="#"><img src="Public/en/images/neiyepic4.png"/></a></li>
                                <li  class="last"><a href="#"><img src="Public/en/images/neiyepic5.png"/></a></li>
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
                <div class="copyright right">© Copyright exiva 2014</div>
        </div>
    </div>
    </div>
</body>
</html>