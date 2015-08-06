<?php
class ProductAction extends GlobalAction{
    public function product()
	{
        parent::top();
        parent::end();
        $this -> cate = M("Category") -> where("ischecked=1 and tb='product' and lang='".$this -> lang."'") -> order("displayorder desc,id asc") -> select();

        $cid = $_GET['cid'] ? $_GET['cid'] : $this -> cate[0]['id'];
        $this -> cateInfo = M("Category") -> where("id=".$cid) -> find();

        $this -> catePics = M("File") -> order("displayorder desc,id desc") -> where("id in(" . $this -> cateInfo['subname'] . ")") -> select();

        $a = M("product") -> where("ischecked=1 and lang='".$this -> lang."' and cid=".$cid) -> select();
        $this->assign("a",$a);

        $this -> _getSelfConfig();
		
		$this->display();
	}
	
	
	public function _getSelfConfig()
	{
		$this -> banner = M("Banner") -> where("lang='".$this -> lang."' and ischecked=1 and cid=181") -> order("displayorder desc,id desc") -> find();
		
		$actClass = " class=\"hover\"";
		$this->assign("productAct",$actClass);
	}
	
}
?>