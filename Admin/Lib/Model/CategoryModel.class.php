<?php
class CategoryModel extends Model
{
	public function infoDel($tb,$ids)
	{
		$map['cid'] = array("IN",$ids);
		////删除信息
		M($tb) -> where($map) -> delete();
		////删除搜索表记录
		D("Search") -> clearSearch($tb, "", $ids);
	}
}