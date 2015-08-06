<?php
class About2Action extends GlobalAction{
    public function about2()
	{
        parent::top();
        parent::end();
		$this -> _getSelfConfig();

        $this -> cate = M("Category") -> where("ischecked=1 and tb='vidio' and lang='".$this -> lang."'") -> order("displayorder desc,id asc") -> select();

        $cid = $_GET['cid'] ? $_GET['cid'] : $this -> cate[0]['id'];
        $this -> cateInfo = M("Category") -> where("id=".$cid) -> find();

        $this -> catePics = M("File") -> order("displayorder desc,id desc") -> where("id in(" . $this -> cateInfo['subname'] . ")") -> select();

        $a = M("vidio") -> where("ischecked=1 and lang='".$this -> lang."' and cid=".$cid) -> select();
        $this->assign("a",$a);


        $this->display();
	}

	
	public function _getSelfConfig()
	{
		$this -> banner = M("Banner") -> where("lang='".$this -> lang."' and ischecked=1 and cid=173") -> order("displayorder desc,id desc") -> find();
		
		$actClass = " class=\"hover\"";
		$this->assign("about2Act",$actClass);
	}

}
?>