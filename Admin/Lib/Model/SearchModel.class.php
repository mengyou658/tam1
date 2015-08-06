<?php
class SearchModel extends Model
{
	/**
	protected $_auto = array ( 
		array('postdate','time',1,'function'), 
		array('editdate','time',3,'function'), 
	);
	**/
	public function isExist($cfrom , $cfrom_id)
	{
		return $this -> where("cfrom = '".$cfrom."' and cfrom_id = ".$cfrom_id." ") -> count();
	}
	
	
	/**
	**** 把内容添加至搜索表
	**/
	public function saveToSearch ($cfrom,$cfrom_id,$cid,$name,$content,$type = 1)
	{
		$map['cfrom'] = $cfrom;
		$map['cfrom_id'] = $cfrom_id;
		$map['name'] = $name;
		$map['cid'] = $cid;
		$map['content'] = $content;
		
		$actType = $this -> isExist($cfrom,$cfrom_id);
		
		if($actType == 0)
		{
			$map['postdate'] = time();
			$this -> add($map);
		}
		else
		{
			$map['editdate'] = time();
			$this -> where("cfrom = '".$cfrom."'  and cfrom_id = ".$cfrom_id."") -> save($map);
		}
		
		return ;
	}
	
	
	/**
	**** 删除内容时，同时删除搜索表内容
	**/
	public function clearSearch ($cfrom,$cform_id,$cid = "")
	{
		$map['cfrom'] = $cfrom;
		
		if($cform_id)
		{
			$map['cfrom_id'] = array('in', $cform_id);
		}
		
		if($cid)
		{
			$map['cid'] = array("IN",$cid);
		}
		$this -> where( $map ) -> delete();
	}
}