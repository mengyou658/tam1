<?php
class AboutAction extends GlobalAction{
    public function about()
	{
        parent::top();
        parent::end();
		$this -> _getSelfConfig();
       	$this -> aboutImage = M("File") -> where("id in (".$this -> sys['about_images'].")")  ->find();
        $this->assign("aboutImage",$this ->aboutImage);
        //var_dump($aboutImage);
        //exit;

		
		$this->display();
	}

	
	public function _getSelfConfig()
	{
		$this -> banner = M("Banner") -> where("lang='".$this -> lang."' and ischecked=1 and cid=173") -> order("displayorder desc,id desc") -> find();
		
		$actClass = " class=\"hover\"";
		$this->assign("about",$actClass);
	}

}
?>