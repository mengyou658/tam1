<?php
class WebmapAction extends GlobalAction{
    public function webmap()
	{
        parent::top();
        parent::end();
		$this -> _getSelfConfig();
		
		$this -> aboutImage = M("File") -> where("id in (".$this -> sys['about_images'].")") -> select();
		
		$this->display();
	}

	
	public function _getSelfConfig()
	{
		$this -> banner = M("Banner") -> where("lang='".$this -> lang."' and ischecked=1 and cid=173") -> order("displayorder desc,id desc") -> find();
		
		$actClass = " class=\"hover\"";
		$this->assign("WebmapAct",$actClass);
	}

}
?>