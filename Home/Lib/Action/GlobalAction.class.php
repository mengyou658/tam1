<?php
class GlobalAction extends Action{
    function _initialize()
	{
		//Current Lang
		$webInfo = M("Siteinfo") -> find();
		if(!$_SESSION["ses_lang"])
		{
			$_SESSION["ses_lang"] = $webInfo["default_lang"];
		}
		elseif($_GET["lang"] != "") $_SESSION["ses_lang"] = $_GET["lang"];
		
		//Current Lang
		$this -> lang = $_SESSION["ses_lang"];
		
		
		
		//Web setting
		$sys = M('Settings') -> where( "lang='".$_SESSION["ses_lang"]."'" ) -> find();
		$this->assign("sys",$sys);
		
		
		
		
		//Header
		
		
		
		//Other Global
		
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		
		$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile)/i";
		if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap'))
		{
			$Loaction = '/m/';
			if (!empty($Loaction))
			{
				/*if(!strpos($ua,'ipad'))
				{
					echo '<script>location.href="'.$Loaction.'"</script>';
					exit;
				}
				echo '<script>location.href="'.$Loaction.'"</script>';
				exit;
				*/
			}
		}
	}
	function top(){
        $this -> cate = M("Category") -> where("ischecked=1 and tb='top' and lang='".$this -> lang."'") -> order("displayorder desc,id asc") -> select();
        $cid = $_GET['cid'] ? $_GET['cid'] : $this -> cate[0]['id'];
        $this -> lists1 = M("top") -> where("ischecked=1 and lang='".$this -> lang."' and cid=".$cid) -> select();
    }
    function end(){
        $this -> cate = M("Category") -> where("ischecked=1 and tb='end' and lang='".$this -> lang."'") -> order("displayorder desc,id asc") -> select();
        $cid = $_GET['cid'] ? $_GET['cid'] : $this -> cate[0]['id'];
        $this -> lists10 = M("end") -> where("ischecked=1 and lang='".$this -> lang."' and cid=".$cid) -> select();
    }
}
?>