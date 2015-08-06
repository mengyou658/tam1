<?php
class GlobalAction extends Action
{	
	function _initialize()
	{
		header("Content-Type: text/html; charset=utf-8");
		
		if($_SESSION['isLogin'] != 'Y' )
		{
			echo "<script>";
			echo "window.location.href='".__APP__."/Public/login'";
			echo "</script>";
			exit;
		}

		$webInfo = M("Siteinfo") -> find();
		
		if(!$_SESSION["seslang"])
		{
			$_SESSION["seslang"] = $webInfo["default_lang"];
		}
		elseif($_GET["lang"] != "") $_SESSION["seslang"] = $_GET["lang"];
		
		$web_lang_lang = explode( '|' , $webInfo['lang'] );
		$web_lang_name = explode( '|' , $webInfo['lang_name'] );
		$web_lang_images = explode( '|' , $webInfo['lang_images'] );
		$web_lang_count = count($web_lang_lang);
		$web_lang = array();
		for( $w = 0; $w < $web_lang_count; $w++)
		{
			$web_lang[$w]['lang'] = $web_lang_lang[$w];
			$web_lang[$w]['lang_name'] = $web_lang_name[$w];
			$web_lang[$w]['lang_images'] = $web_lang_images[$w];
		}
		$this->assign ( 'web_lang', $web_lang );
		$LangAct = " class=\"hover\"";
		$this->assign("LangAct",$LangAct);
		$this->assign("seslang",$_SESSION["seslang"]);
		
		$this -> perPage = 10;
	}
		
	/////更新类别排序
	public function upCateSort()
	{
		$val = intval(trim($_REQUEST['val']));
		
		$id = $_REQUEST['id'];
		
		M("Category")->execute('UPDATE __TABLE__ SET `displayorder`='.$val.' WHERE `id` ='.$id.'');
		
		exit();
	}
	
	////更新文章排序
	public function upSort()
	{
		$tb = $_REQUEST['module'];
		
		$val = intval(trim($_REQUEST['val']));
		
		$id = $_REQUEST['id'];
		
		M($tb)->execute('UPDATE __TABLE__ SET `displayorder`='.$val.' WHERE `id` ='.$id.'');
		
		exit();
	}
	
	/*
		@ajax状态变换
	*/
	public function setActive()
	{
		
		$id = $_REQUEST['id'];
		$tb = $_REQUEST['module'];
		$field = $_REQUEST['field'];
		
		$vo = M($tb) -> find($id); 
		
		if($vo[$field] == '1')
		{
			D($tb) -> execute('UPDATE __TABLE__ SET `'.$field.'`="0" WHERE `id` ='.$id.'');
			echo '<a href="javascript:setActive('.$id.',\''.$tb.'\',\''.$field.'\');"><span class="active_no">'.outText(0,$field).'</span></a>';
			exit();
		}
		else
		{
			D($tb) -> execute('UPDATE __TABLE__ SET `'.$field.'`="1" WHERE `id` ='.$id.'');
			echo '<a href="javascript:setActive('.$id.',\''.$tb.'\',\''.$field.'\');"><span class="active_no">'.outText(1,$field).'</span></a>';
			exit();
		}
	}
	
	/*
	 @ 公共操作
	 @ 删除/锁定/推荐/置顶/审核/移动
	 @ $dbclass 指定操作数据库默认为 MODULE_NAME
	 */
	public function _subAction($dbclass = "")
	{
		$dbname = $dbclass == "" ? MODULE_NAME : $dbclass;
		
		
		$getid = $_REQUEST['actID'];
		if (!$getid)
			$this -> error('未选择记录');
			
		$getids = implode(',', $getid);

		$id = is_array($getid) ? $getids : $getid;
		$act = $_REQUEST['act'];
		$category = $_REQUEST['category'];
		//过滤操作类型
		if (!$act)
			$this -> error('操作类型必须选择');
		//操作类型必须选择
		$allowact = array('good', 'ungood','ischecked', 'unischecked','remove', 'delete');
		
		if (!in_array($act, $allowact))
			$this -> error('未知操作');
		//未知操作
		if (!$id)
			$this -> error('ID丢失');
		
		switch ($act)
		{
			case 'good' :
				$Result = D($dbname) -> execute('UPDATE __TABLE__ SET `isgood`=1 WHERE `id` IN (' . $id . ')');
				$say = '推荐成功';
				break;
			//推荐
			case 'ungood' :
				$Result = D($dbname) -> execute('UPDATE __TABLE__ SET `isgood`=0 WHERE `id` IN (' . $id . ')');
				$say = '取消推荐成功';
				break;
			//取消推荐												
			case 'ischecked' :
				$Result = D($dbname) -> execute('UPDATE __TABLE__ SET `ischecked`=1 WHERE `id` IN (' . $id . ')');
				$say = '发布成功';
				;
				break;
			//审核
			case 'unischecked' :
				$Result = D($dbname) -> execute('UPDATE __TABLE__ SET `ischecked`=0 WHERE `id` IN (' . $id . ')');
				$say = '锁定成功';
				;
				break;
			//取消审核
			case 'remove' :
				$Result = D($dbname) -> execute('UPDATE __TABLE__ SET `cid`=' . $category . ' WHERE `id` IN (' . $id . ')');
				$say = '移动成功';
				break;
			//移动
			case 'delete' :
				$Result = D($dbname) -> execute('DELETE FROM __TABLE__ where `id` IN (' . $id . ')');
				$say = '删除成功';
				break;
			//删除
			default :
				$this -> error(L('_OPERATION_WRONG_'));
				break;
			//未知操作类型
		}
		
		if ($Result === false)
		{
			$this -> error(L('_OPERATION_FAIL_'));
		}
		else
		{
			$this -> assign('jumpUrl', __URL__ / $dbname);
			$this -> success($say);
		}
	}
}
?>