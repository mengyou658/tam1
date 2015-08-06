<?php
class FieldTplModel extends Model {
	
	public function getAll() {
		return $this -> order("sort desc,postdate asc") -> select();
	}
	
	/***
	**** 通过分类ID取模版
	***/
	public function getByCid($cid)
	{
		$cRs = M("Category") -> find($cid);
		
		$Rs = $this -> find($cRs['mid']);
		
		return $Rs;
	}
	
	public function getByModule($m)
	{
		return $this -> where( "module = '".$m."'" ) -> select();
	}
}