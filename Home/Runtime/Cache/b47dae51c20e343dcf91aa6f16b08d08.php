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
    <script type="text/javascript" src="__PUBLIC__/<?php echo ($lang); ?>/js/common.js"></script>
    <script type="text/javascript" src="__PUBLIC__/<?php echo ($lang); ?>/js/angular.min.js"></script>
    <title>Self Design | <?php if(($sys["indexTitle"]) != ""): echo ($sys["indexTitle"]); else: echo ($sys["title"]); endif; ?></title>
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
    <div class="about" style=" background-color: #fcfaf3">
        <div class="share">
            <a href="" class="share1 fl"></a>
            <a href="" class="share2 fl"></a>

            <p class="fl song">LOCATION: 342 - 40 Avenue NE Calgary, AB T2E2M7 | TEL: 403-27</p>
        </div>
        <div class="content fl">
            <div class="location clearfix mt10">
                <h2 class="Roman fl f30">SELF DESIGN</h2>

                <div CLASS="mbx fr"><a href="__APP__/">HOME<span> > </span></a><a href="__APP__/design">Granite and Quartz<span> > </span></a><a
                        href="">Granite</a></div>
            </div>
            <div class="clear"></div>
            
            <script type="text/javascript">
        	$(document).ready(function(e) {
					$('.selectcolor ul li a').hover(function(){
						if(!$(this).parent().hasClass('active')){
							var className = $(this).attr('class');
							newClass = className.replace('_a','_hover');
							$(this).removeClass(className);
							$(this).addClass(newClass);
							
						}
					},function(){
						if(!$(this).parent().hasClass('active')){
							var className = $(this).attr('class');
							newClass = className.replace('_hover','_a');
							$(this).removeClass(className);
							$(this).addClass(newClass);	
							
						}
					});
					
					$('.selectcolor ul li a').click(function(){
						$('.cabinet_hover').removeClass('cabinet_hover');
						$(this).addClass('cabinet_hover');
					});
					

					$('.selectcolor ul li').click(function(){
						var eq = $(this).index();
						
						showDiv(eq);
						var linum = $('.selectcolor ul li').length;
						
						if(eq == 0){
							var cer0 = $(this).children().attr('class');
							
							$(this).children().removeClass("cabinet_a")
							$(this).children().addClass(cer0);
							for(var k = 0; k<linum; k++){
								
								if(k!=eq){	
									var className = $(".selectcolor ul li:eq(" + k + ")").children().attr('class');
									if(className == "wall_hover" || className == "floor_hover"||className == "stone_hover"){
									newClass = className.replace('_hover','_a');
									$(".selectcolor ul li:eq(" + k + ")").children().removeClass(className);
									$(".selectcolor ul li:eq(" + k + ")").children().addClass(newClass);}
									
									}
								}
							}
						if(eq == 1){
							var cer = $(this).children().attr('class');
							
							$(this).children().removeClass("wall_a");
							$(this).children().addClass("wall_hover");
							for(var k = 0; k<linum; k++){
									if(k!=eq){
									var className = $(".selectcolor ul li:eq(" + k + ")").children().attr('class');
									if(className == "cabinet_hover" || className == "floor_hover"||className == "stone_hover"){
									newClass = className.replace('_hover','_a');
									$(".selectcolor ul li:eq(" + k + ")").children().removeClass(className);
									$(".selectcolor ul li:eq(" + k + ")").children().addClass(newClass);}
									
									}
								}
							}
						if(eq == 2){
							$(this).children().removeClass("floor_a");
							$(this).children().addClass("floor_hover");
							for(var k = 0; k<linum; k++){
								if(k!=eq){
									var className = $(".selectcolor ul li:eq(" + k + ")").children().attr('class');
									if(className == "wall_hover" || className == "cabinet_hover"||className == "stone_hover"){
									newClass = className.replace('_hover','_a');
									$(".selectcolor ul li:eq(" + k + ")").children().removeClass(className);
									$(".selectcolor ul li:eq(" + k + ")").children().addClass(newClass);}
									
									}
								}
							}
						if(eq == 3){
							$(this).children().removeClass("stone_a");
							$(this).children().addClass("stone_hover");
							for(var k = 0; k<linum; k++){
								if(k!=eq){
									var className = $(".selectcolor ul li:eq(" + k + ")").children().attr('class');
									if(className == "wall_hover" || className == "floor_hover"||className == "cabinet_hover"){
										newClass = className.replace('_hover','_a');
										$(".selectcolor ul li:eq(" + k + ")").children().removeClass(className);
										$(".selectcolor ul li:eq(" + k + ")").children().addClass(newClass);
									}
									
									}
								}
							}
						
							
						});
						
						
					function showDiv(a){
						var num =$(".aDIV").children().length;
						for(var j= 0; j<num;j++){
							if(a==j){
									$("div.aDIV div:eq(" + j + ")").removeClass("none");
									$("div.aDIV div:eq(" + j + ")").addClass("block");
								}
								else{
									$("div.aDIV div:eq(" + j + ")").removeClass("block");
									$("div.aDIV div:eq(" + j + ")").addClass("none");}
						}
					}
				});
        	</script>
            <div class="selectcolor">
                <ul>
                    <li class="active"><a href="#" class="cabinet_a"></a></li>
                    <li><a href="#" class="wall_a"></a></li>
                    <li><a href="#" class="floor_a"></a></li>
                    <li><a href="#" class="stone_a"></a></li>
                </ul>
            </div>
            <div class="design-box mt10 clearfix">
                <div class="show-box fl" id="show_png">
                   <!-- <img src="__PUBLIC__/<?php echo ($lang); ?>/images/simg1.png">-->
                   <div class="img"><img src="__PUBLIC__/<?php echo ($lang); ?>/images/空白.png"/></div>
                   <div class="img"><img id="c_img" src="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/1.png"/></div>
                   <div class="img"><img id="wl_img" src="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/1.png"/></div>
                   <div class="img"><img id="f_img" src="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/1.png"/></div>
                   <div class="img"><img id="s_img" src="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/4.png"/></div>
                   <div class="img"><img id="ft_img" src="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/full_tile/png/2.png"/></div>
                   <!--<div class="img"><img id="ht_img" src="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/half_tile/png/1.png"/></div>-->
                   <div class="img"><img id="o_img" src="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/outlets/png/1.png"/></div>
                   <div class="img"><img id="wd_img" src="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/windows/png/1.png"/></div>
                </div>
                <div class="cabinet-color fl">

               		<div class="aDIV">
                        <div class="block">
                            <h2 class="roman mt10">CABINET COLOR</h2>
                            <ul class="general" id="cabinet">
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-1.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/1.png" data_c="#c_img">></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-2.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/2.png" data_c="#c_img">></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-3.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/3.png" data_c="#c_img">></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-4.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/4.png" data_c="#c_img">></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-5.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/5.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-6.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/6.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-7.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/7.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-8.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/8.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-9.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/9.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-10.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/10.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-11.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/11.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-12.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/12.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-13.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/13.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-14.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/14.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-15.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/15.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-16.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/16.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-17.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/17.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-18.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/18.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-19.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/19.png" data_c="#c_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/cabinet/cabinet-20.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/cabinet/png/20.png" data_c="#c_img"></li>
                                
                            </ul>
                       </div>
                       
                        <div class="none">
                            <h2 class="roman mt10">WALL COLOR</h2>
                            <ul class="general" id="wall">
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-1.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/1.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-2.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/2.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-3.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/3.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-4.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/4.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-5.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/5.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-6.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/6.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-7.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/7.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-8.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/8.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-9.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/9.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-10.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/10.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-11.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/11.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-12.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/12.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-13.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/13.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-14.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/14.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-15.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/15.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-16.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/16.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-17.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/17.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-18.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/18.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-19.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/19.png" data_c="#wl_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/wall/wall-20.gif" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/wall/png/20.png" data_c="#wl_img"></li>
                                
                            </ul>
                       </div>
                        <div class="none">
                            <h2 class="roman mt10">FLOOR COLOR</h2>
                            <ul class="general" id="floor">
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-1.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/1.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-2.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/2.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-3.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/3.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-4.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/4.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-5.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/5.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-6.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/6.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-7.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/7.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-8.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/8.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-9.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/9.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-10.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/10.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-11.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/11.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-12.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/12.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-13.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/13.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-14.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/14.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-15.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/15.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-16.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/16.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-17.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/17.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-18.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/18.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-19.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/19.png" data_c="#f_img"></li>
                                <li><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/floor/floor-20.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/floor/png/20.png" data_c="#f_img"></li>
                            </ul>
                       </div>
                        <div class="none">
                            <h2 class="roman mt10">STONE COLOR</h2>

                            <div class="stone">
                              <a href="javascript:void(0);" class="btn btnPre" id="banner_index_pre"></a>
                              <a href="javascript:void(0);" class="btn btnNext" id="banner_index_next"></a>
                                <ul class="stoneli" id="stonelist">
                                  <li>
                                    <table>
                                        <tr>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/1/EMPERADOR-DARK.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/2.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/1/1.jpg" data_c="#s_img" /></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/2/RAINFOREST-BROWN.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/1.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/2/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/3/ROJO-ALICANTE.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/3.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/3/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/4/FANTAS-ONYX.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/4.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/4/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/5/1.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/5.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/5/1.jpg" data_c="#s_img"/></td>
                                         </tr>
                                        <tr>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/6/AZUL-BAHIA.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/6.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/6/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/7/BLACK-GALAXY.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/7.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/7/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/8/BLUE-PEARL.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/8.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/8/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/9/DAKOTA-MAHOGONY.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/9.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/9/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/10/GOLDEN-RUSTIC.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/10.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/10/1.jpg" data_c="#s_img"/></td>
                                        </tr>
                                        <tr>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/11/GOLDEN-WAVE.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/11.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/11/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/12/IVORY-BROWN.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/12.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/12/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/13/JUPARANA-BORDEAUX.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/13.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/13/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/14/LAPIDUS-GOLD.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/14.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/14/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/15/MAGMA-GOLD.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/15.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/15/1.jpg" data_c="#s_img"/></td>
                                        </tr>
                                        <tr>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/16/PARADISO-CLASSICO.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/16.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/16/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/17/RED-DRAGON.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/17.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/17/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/18/SHIVAKASHI.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/18.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/18/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/19/TYPHOON-BORDEAUX.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/19.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/19/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/20/VERDE-MARINACE.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/20.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/20/1.jpg" data_c="#s_img"/></td>
                                        </tr>
                                    </table>
                                  </li>
                                  <li>
                                    <table>
                                        <tr>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/21/ABSOLUTE-BLACK.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/21.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/21/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/22/BALTIC-BROWN.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/22.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/22/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/23/BLACK-MARINACE.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/23.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/23/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/24/EMERALD-PEARL.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/24.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/24/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/25/GIALLO-FIORITO.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/25.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/25/1.jpg" data_c="#s_img"/></td>
                                         </tr>
                                        <tr>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/26/IMPALA-BLACK.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/26.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/26/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/27/IVORY-FANTASY.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/27.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/27/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/28/KASHMIRE-WHITE.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/28.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/28/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/29/LABRADORITE-ANTIQUE.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/29.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/29/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/30/LUNA-PEARL.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/30.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/30/1.jpg" data_c="#s_img"/></td>
                                        </tr>
                                        <tr>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/31/NEW-VENETIAN-GOLD.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/31.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/30/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/32/PEACOCK-GREEN.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/32.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/31/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/33/TAN-BROWN.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/33.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/32/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/34/TROPIC-BROWN.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/34.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/33/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/35/UBA-TUBA.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/35.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/34/1.jpg" data_c="#s_img"/></td>
                                        </tr>
                                        <tr>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/36/VERDE-BUTTERFLY.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/36.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/36/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/37/VERDE-LAURA.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/37.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/37/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/38/GIALLO-ORNAMENTAL.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/38.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/38/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/39/NEW-VENETIAN-GOLD.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/39.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/39/1.jpg" data_c="#s_img"/></td>
                                            <td><img src="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/40/VOLGA-BLUE.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/stone/png/40.png" bigimg="__PUBLIC__/<?php echo ($lang); ?>/images/thumbimages/stone/40/1.jpg" data_c="#s_img"/></td>
                                        </tr>
                                    </table>
                                  </li>
                                </ul>
                            </div>
                            <!--<bottom class="cabinetnext"><span>NEXT</span></bottom>-->
                       </div>
                   </div>
                    <div class="clear"></div>
					<script type="text/javascript">
						var ShowPre1 = new ShowPre({box:"stonelist",Pre:"banner_index_pre",Next:"banner_index_next",numIco:"index_numIco",loop:1,auto:1});
					</script>
                    <img src="__PUBLIC__/<?php echo ($lang); ?>/images/table.png" class="table-img" id="stone_table_img">
                    <p class="cabinetdetail">Fantasy Onyx</p>
                </div>
            </div>

            <div class="design-property clearfix">
                <div style="width: 804px; margin: 0 auto">
                    <div class="property1 fl" ng-app="" ng-init="name='1/2 Bevel'">

                        <h2 class="roman mt15">EDGE TYPE</h2>

                        <p class="f10">select your title backsplash..</p>

                        <div class="fl mt5" id="full_title">
                            <h3>Full tile</h3>
                            <img src="__PUBLIC__/<?php echo ($lang); ?>/images/b1.png" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/full_tile/png/1.png" data_c="#ft_img">
                            <img src="__PUBLIC__/<?php echo ($lang); ?>/images/b2.png" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/full_tile/png/2.png" data_c="#ft_img">

                        </div>
                        <div class="fl ml10 mt5" id="half_title">
                            <h3>half tile</h3>
                            <img src="__PUBLIC__/<?php echo ($lang); ?>/images/b3.png" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/half_tile/png/1.png" data_c="#ft_img">
                            <img src="__PUBLIC__/<?php echo ($lang); ?>/images/b4.jpg" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/half_tile/png/2.png" data_c="#ft_img">
                        </div>

                    </div>
                    <div class="property2 fl">
                        <h2 class="roman mt10">WINDOWS</h2>

                        <p class="f10 mb5">choose your window style...</p>
                        <div id="windows">
                            <img src="__PUBLIC__/<?php echo ($lang); ?>/images/w1.png" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/windows/png/1.png" data_c="#wd_img">
                            <img src="__PUBLIC__/<?php echo ($lang); ?>/images/w2.png" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/windows/png/2.png" data_c="#wd_img">
                            <img src="__PUBLIC__/<?php echo ($lang); ?>/images/w3.png" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/windows/png/3.png" data_c="#wd_img">
                        </div>
                    </div>
                    <div class="property3 fl">
                        <h2 class="roman mt10">OUTLEFS</h2>

                        <p class="f10 mb5">choose your window style...</p>
                        <div id="outlefs">
                        <img src="__PUBLIC__/<?php echo ($lang); ?>/images/w4.png" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/outlets/png/1.png" data_c="#o_img">
                        <img src="__PUBLIC__/<?php echo ($lang); ?>/images/w5.png" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/outlets/png/2.png" data_c="#o_img">
                        <img src="__PUBLIC__/<?php echo ($lang); ?>/images/w6.png" data-show="__PUBLIC__/<?php echo ($lang); ?>/images/bigmages/outlets/png/3.png" data_c="#o_img">
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!--背景图 start-->
        <div class="fr design-bj">
        </div>
        <!--背景图 end-->
    </div>
</div>

</body>
</html>

<script type="text/javascript">
		//$("#cabinet li").bind("click",change(this));
		$("#cabinet li").click(function(){
				var imgsrc = $(this).find("img").attr('data-show');
				var img_c = $(this).find("img").attr('data_c');
				$(img_c).attr("src", imgsrc);
			});

		$("#wall li").click(function(){
				var imgsrc = $(this).find("img").attr('data-show');
				var img_c = $(this).find("img").attr('data_c');
				$(img_c).attr("src", imgsrc);
			});

		$("#floor li").click(function(){
				var imgsrc = $(this).find("img").attr('data-show');
				var img_c = $(this).find("img").attr('data_c');
				$(img_c).attr("src", imgsrc);
			});

		$("#stonelist li table tr td").click(function(){
				var imgsrc = $(this).find("img").attr('data-show');
				var bigimg = $(this).find("img").attr('bigimg');
				var img_c = $(this).find("img").attr('data_c');
				$(img_c).attr("src", imgsrc);
				$("#stone_table_img").attr("src",bigimg);
			});
		$("#full_title img").click(function(){
				var imgsrc = $(this).attr('data-show');
				var img_c = $(this).attr('data_c');
				$(img_c).attr("src", imgsrc);
			});
		$("#half_title img").click(function(){
				var imgsrc = $(this).attr('data-show');
				var img_c = $(this).attr('data_c');
				$(img_c).attr("src", imgsrc);
			});
		$("#windows img").click(function(){
				var imgsrc = $(this).attr('data-show');
				var img_c = $(this).attr('data_c');
				$("#s_img").removeClass("index");
				$(img_c).attr("src", imgsrc);
			});
			
		$("#outlefs img").click(function(){
				var imgsrc = $(this).attr('data-show');
				var img_c = $(this).attr('data_c');
				$(img_c).attr("src", imgsrc);
			});
		/*var change = function(){
			var imgsrc = $(this).find("img").attr('data-show');
			var img_c = $(this).find("img").attr('data_c');
			alert(img_c);
			$(img_c).attr("src", imgsrc);
			}*/
			
							
</script>