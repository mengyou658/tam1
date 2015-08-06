<?php
class ContactAction extends GlobalAction{
    public function contact()
	{
        parent::top();
        parent::end();
		$this -> _getSelfConfig();
		
		$this->display();
	}
	
	
	public function _getSelfConfig()
	{
		$this -> banner = M("Banner") -> where("lang='".$this -> lang."' and ischecked=1 and cid=181") -> order("displayorder desc,id desc") -> find();
		
		$actClass = " class=\"hover\"";
		$this->assign("contactAct",$actClass);
	}
	
}
?>