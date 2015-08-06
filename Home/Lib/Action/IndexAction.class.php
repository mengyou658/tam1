<?php
class IndexAction extends GlobalAction{
    public function index()
	{parent::end();
        $this -> cate = M("Category") -> where("ischecked=1 and tb='banner' and lang='".$this -> lang."'") -> order("displayorder desc,id asc") -> select();

        $cid = $_GET['cid'] ? $_GET['cid'] : $this -> cate[0]['id'];
        $this -> cateInfo = M("Category") -> where("id=".$cid) -> find();

        $this -> catePics = M("File") -> order("displayorder desc,id desc") -> where("id in(" . $this -> cateInfo['subname'] . ")") -> select();

        $a = M("banner") -> where("ischecked=1 and lang='".$this -> lang."' and cid=199") -> select();
        $this->assign("a",$a);




		$this -> _getSelfConfig();
        $this->display();
	}


	public function _getSelfConfig()
	{


		$actClass = " class=\"hover\"";
		$this->assign("indexAct",$actClass);
	}
	
}
?>