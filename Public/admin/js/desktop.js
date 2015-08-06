var kwDesktop = {
	winWidth : 0, 
	winHeight : 0, 
	TaskbarHeight : 40, 
	StartListHeight : 530, 
	StartListWidth : 220, 
	ShowIcon : '',  
	iconDivWidth : 90, 
	iconDivHeight : 90, 
	winSize : function(){ 
		if (window.innerWidth){
			this.winWidth = window.innerWidth;
		}else if ((document.body) && (document.body.clientWidth)){
			this.winWidth = document.body.clientWidth;
		}
		if (window.innerHeight){
			this.winHeight = window.innerHeight;
		}else if ((document.body) && (document.body.clientHeight)){
			this.winHeight = document.body.clientHeight;
		}
		if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth){
			this.winWidth = document.documentElement.clientWidth;
			this.winHeight = document.documentElement.clientHeight;
		}
	},
	aNUT : (navigator.userAgent.toLowerCase()),
	IeTrueBody : function(){
		return (document.compatMode && document.compatMode != "BackCompat") ? document.documentElement : document.body;
	},
	GetScrollTop : function(){
		return ($.browser.msie) ? this.IeTrueBody().scrollTop : window.pageYOffset;
	},
	floating : function(id,tpe){
		var winsize = this.winSize();
		var Top = (tpe == 'Task') ? ( this.GetScrollTop() + this.winHeight - this.TaskbarHeight) : (this.GetScrollTop() + this.winHeight - this.StartListHeight - this.TaskbarHeight + 8);
		document.getElementById(id).style.top = Top + "px";
	},
	inShow : function(id){
		var idDisplay = $('#' + id).css("display");
		if(idDisplay == 'none'){
			$('#' + id).show(250);
		} else {
			$('#' + id).hide(250);
		}
	},
	ShowPlay : function(id){
		$("#StartList").fadeOut("slow"); 
		return KW.htmlExpand(id,{objectType:'iframe'});
	},
	inco : function(){
		this.winSize();
		var dHeight = this.iconDivHeight; 
		var table = '<table><tr>';
		table += '<td>';
		$.each(this.ShowIcon,function(i,n){
			table += '<div class="icon">';
			table += '<ol class="img"><a href="' + n[2] + '" onclick="return KW.htmlExpand(this,{objectType:\'iframe\'});"><img src="' + n[1] + '" width="40" height="40" /></a></ol>';
			table += '<ol class="text">' + n[3] + '</ol>';
			table += '</div>';
			dHeight = dHeight + kwDesktop.iconDivHeight; 
			if(dHeight >= (kwDesktop.winHeight - kwDesktop.TaskbarHeight + 10)){
				table += '</td><td>';
				dHeight = kwDesktop.iconDivHeight;
			}
		}); 
		table += '</td>';
		table += '</tr></table>';
		return table;	
	},
	startmarquee : function(lh,speed,delay,id){ 
		var t; 
		var p=false; 
		var o=document.getElementById(id); 
		o.innerHTML+=o.innerHTML; 
		o.onmouseover=function(){p=true} 
		o.onmouseout=function(){p=false} 
		o.scrollTop = 0; 
		function start(){ 
			t=setInterval(scrolling,speed); 
			if(!p) o.scrollTop += 2; 
		} 
		function scrolling(){ 
			if(o.scrollTop%lh!=0){ 
				o.scrollTop += 2; 
				if(o.scrollTop>=o.scrollHeight/2) o.scrollTop = 0; 
			}else{ 
				clearInterval(t); 
				setTimeout(start,delay); 
			} 
		} 
		setTimeout(start,delay); 
	},
	environment : function(){}
};