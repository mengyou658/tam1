
ui = window.ui ||{
	success:function(message,error){
		var style = (error==1)?"html_clew_box clew_error ":"html_clew_box";
		var html   =   '<div class="" id="ui_messageBox" style="display:none">'
					   + '<div class="html_clew_box_close"><a href="javascript:void(0)" onclick="$(this).parents(\'.html_clew_box\').hide()" title="Close">Close</a></div>'
					   + '<div class="html_clew_box_con" id="ui_messageContent">&nbsp;</div></div>';
		var init      =  0;
		
		var showMessage = function( message ){		
			if( !init ){
				$('body').append( html );
				init = 1;
			}
			

			
			$( '#ui_messageContent' ).html( message );
			$('#ui_messageBox').attr('class',style);
			
			var v =  ui.box._viewport() ;
			
			jQuery('<div class="boxy-modal-blackout"></div>')
	        .css(jQuery.extend(ui.box._cssForOverlay(), {
	            zIndex: 99, opacity: 0.2
	        })).appendTo(document.body);
			
			
			$( '#ui_messageBox' ).css({
				left:( v.left + v.width/2  - $( '#ui_messageBox' ).outerWidth()/2 ) + "px",
				top:(  v.top  + v.height/2 - $( '#ui_messageBox' ).outerHeight()/2 ) + "px"
			});			
			
			$( '#ui_messageBox' ).fadeIn("slow");
		}
		
		
		var closeMessage = function(){
			setTimeout( function(){  
				$( '#ui_messageBox' ).fadeOut("fast",function(){
					jQuery('.boxy-modal-blackout').remove(); 
				});
			} , 1000);
		}
		
		showMessage( message );
		closeMessage();

	},
	
	error:function(message){
		ui.success(message,1);
	},

	load:function(){
		var init = 0
		var loadingBox = '<div class="html_clew_box" id="ui_loading" style="display:none"><div class="html_clew_box_con"><span class="ico_waiting">Loading……</span></div></div>';
		if( !init ){
			$('body').append( loadingBox );
			init = 1;
		}
		
		$( '#ui_loading' ).css({
			right:100+"px",
			top:($(document).scrollTop())+"px"
		});
		$( '#ui_loading' ).fadeIn("slow");
	},
	
	loaded:function(){
		var loadingBox = '#ui_loading';
		$( loadingBox ).fadeOut("slow");
	},
	
	
	confirm:function(o,text){
		var callback = $(o).attr('callback');
		text = text || 'Determined to do this operation？';
		this.html = '<div id="ts_ui_confirm" class="ts_confirm"><span class="txt"></span><br><input type="button" value="Submit"  class="btn_b mr5"><input type="button" value="Cancel"  class="btn_w"></div>';
		// 修改原因: ts_ui_confirm .btn_b按钮会重复提交
		//if( $('#ts_ui_confirm').html()==null ){
			$('body').append(this.html);
		//}
		var position = $(o).offset();
		$('#ts_ui_confirm').css({"top":position.top+"px","left":position.left-($("#ts_ui_confirm").width()/2)+"px","display":"none"});
		$("#ts_ui_confirm .txt").html(text);
		$('#ts_ui_confirm').fadeIn("fast");
		$("#ts_ui_confirm .btn_w").one('click',function(){
			$('#ts_ui_confirm').fadeOut("fast");
			// 修改原因: ts_ui_confirm .btn_b按钮会重复提交
			$('#ts_ui_confirm').remove();
		});
		$("#ts_ui_confirm .btn_b").one('click',function(){
			$('#ts_ui_confirm').fadeOut("fast");
			// 修改原因: ts_ui_confirm .btn_b按钮会重复提交
			$('#ts_ui_confirm').remove();
			eval(callback);
		});
	}
	
};
