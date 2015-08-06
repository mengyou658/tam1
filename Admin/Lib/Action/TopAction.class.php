<?php
class TopAction extends GlobalAction
{
	function _initialize()
	{
		parent::_initialize();
		$this -> CommonMenu = getMenuList(MODULE_NAME,ACTION_NAME,$_SESSION['adminstr']);
		$this -> actModule = MODULE_NAME;
	}
	
	/*
	@列表展示 
	*/
	public function index()
	{
		$mTpl = M('FieldTpl') -> where("module = '".$this -> actModule."'") -> find();	
		
		$this -> allFields = M('Field') -> where("mid = '".$mTpl['id']."'") -> order("sort desc,id asc") -> select();
		$this -> selFields = M('Field') -> where("mid = '".$mTpl['id']."' and issearch = 1") -> order("sort desc,id asc") -> select();
		$this -> listFileds = M('Field') -> where("mid = '".$mTpl['id']."' and islist = 1") -> order("sort desc,id asc") -> select();
		$this -> showDate = $this -> listFileds;
		$this -> fieldNum = count($this -> listFileds);
		


		$p = $_GET['p'] == "" ? 1:$_GET['p'];
		
		$order = $_GET['_order'] == "" ? "postdate" : $_GET['_order'];
		$sort = $_GET['_sort'] == "" ? "desc" : $_GET['_sort'];
		
		$field = 'name';
		$kw = $_GET['keyword'];
		if($kw)
		{
			if($field) 
			{
				$map[$field] = array("like","%$kw%");	
			}
			else
			{
				$mapStr = array();
				foreach($this -> selFields as $v)
				{
					$mapStr[] = $v['fieldName']; 
				}
				$fieldStr = implode("|",$mapStr);
				$map[$fieldStr] = array("like","%$kw%");
			}
		}
		
		$_start_time = $_REQUEST['startTime'];
		$_end_time = $_REQUEST['endTime'];
		
		if ($_end_time) {
			$_end_time .= ' 23:59:59';
		}
		
		if ($_start_time or $_end_time)
		{
			if ($_start_time && !$_end_time)
			{
				$map['postdate'] = array('EGT', strtotime($_start_time));
			}
			if (!$_start_time && $_end_time)
			{
				$map['postdate'] = array('ELT', strtotime($_end_time));
			}
			if ($_start_time && $_end_time)
			{
				$map['postdate'] = array('BETWEEN', array(strtotime($_start_time),strtotime($_end_time)));
			}

		}
		
		if($_GET['chk'] == 'y')
		{
			$map['ischecked'] = 0;
		}
		
		if($_GET['cid'])
		{
			$map['cid'] = $_GET['cid'];
		}
		
		$map['lang'] = $_SESSION["seslang"];
		
		$db = M($this -> actModule); 
		
		import('ORG.Util.Page');
		$count      = $db -> where($map) -> count();
		$Page       = new Page($count,$thisPage);
		$show       = $Page->show();
	
		$list = $db->where($map)->order("isgood desc,$order $sort")->limit($Page->firstRow.','.$Page->listRows)->select();
		//echo $db->getlastsql();
		$this->assign('mTpl',$mTpl);
		$this->assign('list',$list);
		$this->assign('page',$show);
		
		if($sort == "desc") $sortby = "asc";
		else $sortby = "desc";
		
		$this->assign('sortby',$sortby);
		$this->assign('order',$order);
		$this->assign('thisPage',$thisPage);
		$this->assign('p',$p);
		
		
		///类别
		
		$date["lang"] = $_SESSION["seslang"];
		$date['tb'] = $this -> actModule;
		$Category = D('Category') -> order("displayorder desc,id asc") -> where($date) -> select();
		foreach($Category as $catid => $category)
		{
			$Categorys[$category['id']] = array('id'=>$category['id'],'parentid'=>$category['cid'],'title'=>$category['name']);
		}
		import('ORG.Util.Tree');	
		$tree = new tree($Categorys);
		$str = "<option value=\$id \$selected>\$spacer\$title</option>";
		$cateStr .= $tree -> get_tree(0,$str,$_GET['cid']);
		
		$this->assign('cateStr',$cateStr);
		$this->display();
	}
		
	/*
	@编辑、新增记录
	*/
	
	public function edit()
	{
		if($_GET['id'])
		{
			$this -> vo = D($this -> actModule) -> find($_GET['id']); 
			
		} 
		
		$cid = $_GET['cid'] == '' ? $this -> vo['cid'] : $_GET['cid'];
		
		$date["lang"] = $_SESSION["seslang"];
		$date['tb'] = $this -> actModule;
		$Category = D('Category') -> order("displayorder desc,id asc") -> where($date) -> select();
		foreach($Category as $catid => $category)
		{
			$Categorys[$category['id']] = array('id'=>$category['id'],'parentid'=>$category['cid'],'title'=>$category['name']);
		}
		import('ORG.Util.Tree');	
		$tree = new tree($Categorys);
		$str = "<option value=\$id \$selected>\$spacer\$title</option>";
		$cateStr .= $tree -> get_tree(0,$str,$cid);
		
		$this->assign('cateStr',$cateStr);
		
		if($cid) 
		{	
			$this -> mRs = D("Category") -> find($cid); 
			$tplRs = M('FieldTpl') -> find($this -> mRs['mid']);
			
			$lines = getLine($tplRs['perLine']);
			$this -> assign('lines',$lines);
			
			import('@.ORG.Module');
			$m_tpl = new Module($tplRs,$this->vo);
			$groupRs = $m_tpl -> show();
			
			$this->assign("groupRs",$groupRs);	
		}
		
		$this->assign("cid",$cid);	
		$this->assign("bp",$_GET['bp']);
		$this -> display();
	}	
	
	/*
	@删除记录
	*/	
	public function doDelete()
	{
		if( empty($_POST['ids']) )
		{
			echo 0;
			exit ;
		}
		
		$map['id'] = intval($_POST['ids']);
		
		D("Search") -> clearSearch($this -> actModule , $_POST['ids']);
		
		echo M($this -> actModule) -> where($map) -> delete() ? '1' : '0';
	}
	
	/*
	@新增编辑提交处理
	*/	
		
	public function doInfo()
	{
		if(!$_POST['name'])
		{
			$this->error("Name can't null!");
		}
				
		$tplRs = D('FieldTpl') -> getByCid($_POST['cid']);
		
		import('@.ORG.doAction');
		$doAction = new doAction($tplRs['fieldID']);
		$formArr = $doAction -> getInfo();
		
		$db = D($this -> actModule);
		$db -> create();
		$db -> lang = $_SESSION["seslang"];
		
		foreach($formArr as $k => $v)
		{
			$db -> $k = $v;
		}
		
		$name = $_POST['name'];
		$content = $_POST['content'];
		$cfrom = $this -> actModule;
		
		if($_POST['id']>0)
		{
			$db -> id = $_POST['id'];
			$db -> editdate = time();
			if($db->save())
			{
				$cfrom_id = $_POST['id'];
				D("Search") -> saveToSearch($cfrom,$cfrom_id,$_POST['cid'],$name,$content,2);
				
				$this -> assign('jumpUrl',__URL__."/index/p/".$_POST['bp'].".html");
				$this -> success("Edit susscess");
			}
			else
			{
				$this -> error("Edit fail");
			}
		}
		else
		{
			$db -> postdate = time();
			$db -> editdate = time();
			$db -> ischecked = 1;
			if($inSertID = $db->add())
			{
				$cfrom_id = $inSertID;
				D("Search") -> saveToSearch($cfrom,$cfrom_id,$_POST['cid'],$name,$content,1);
				$this -> assign('jumpUrl',__URL__."/index/p/".$_POST['bp'].".html");
				$this -> success("Add susscess");
			}
			else
			{
				$this -> error("Add fail");
			}
		}
		
	}
	
	/*
	@自动搜索
	*/		
	public function search_auto()
	{
		if($_REQUEST['do'] == 'search')
		{
			$v = $_POST[value];
			if($v)
			{
				$map['name'] = array("like","%$v%");
				if($_POST['cid'] > 0)
				{
					$map['cid'] = $_POST['cid'];
				}
				$re = D($this -> actModule) -> where($map) -> order("displayorder desc,postdate desc") -> select(); 
				if(!$re) exit();
				echo '<ul>';
				foreach($re as $k => $val)
				{
					$str = preg_replace("/".$v."/", "<font style='color:#f00' >".$v."</font>", $val['name']);
					echo "<li><a href='javascript:;' onclick='insertIt({$val['id']})'>{$str}<span id='s_{$val['id']}' style='display:none;'>{$val['name']}</span></a></li>";
				}
				echo '</ul>';
			}
			exit();
		}
		
		$this->display();
	}	
	
	////类别管理
	public function cate()
	{
		$parentid = intval($_GET['parentid']) == "" ? 0 : intval($_GET['parentid']);

		$map['tb'] = $this->actModule;
		$map['lang'] = $_SESSION["seslang"];
		$map['cid'] = $parentid;
		
		$lists = D('Category') -> where($map) -> order('displayorder desc,postdate asc') -> select(); 
		
		foreach($lists as $k => $v)
		{
			$count  = M('Category') -> where("cid = ".$v['id']) -> count(); 
			$lists[$k]['nums'] = $count;
		}
		
		if($parentid > 0)
		{
			$this -> parentRs = D("Category") -> find($parentid);
		}
		$this -> lists = $lists;	
		$this -> display();
	}
	
	/////类别管理
	public function cateInfo()
	{
		if($_GET['gid'] != '0')
		{
			$this -> vo = D("Category") -> where( "id='".$_GET['gid']."'" ) -> find();
			$mid = $this -> vo['mid'];
			$this -> cid = $this -> vo['cid'];
		}
		
		if($_GET['parentid'])
		{
				$this -> cid = $_GET['parentid'];
				$this -> parentRs = D("Category") -> find($_GET['parentid']);
				$mid = $this -> parentRs['mid'];
		}
		
	    if($this -> vo["subname"])
		{
			$ImgID = $this -> vo["subname"];
			$ImgHtml = "";
			$i = 0;
			$img = D("File") -> order("displayorder desc,id desc") -> where("id in(" . $ImgID . ")") -> select();
			$countImg = count($img);
			for ($i = 0; $i < $countImg; $i++) {
				$sn = "";
				$sn = time() . $i;
				$ImgHtml .= '<dl id=\'' . $sn . '\'><dt><input type=\'hidden\' name=\'field[]\' value=\'' . $img[$i]['id'] . '\'><a href=\'' . $img[$i]['attachment'] . '\' rel=\'rel\' class=\'lightbox\' target="_blank"><img src=\'' . $img[$i]['attachment'] . '\' class=\'sImg\' width=\'70\' height=\'70\'></a></dt><dd><a href=\'javascript:MoveHtml(' . $sn . ')\'>删除 <img src=\'__PUBLIC__/admin/images/del.gif\' align=\'absbottom\'></a><br /><input type=\'text\' name=\'displayorder[]\' value=\'' . $img[$i]['displayorder'] . '\' style="width:85px;text-align:center;" ></dd></dl>';
			}
		}
		$this -> assign("ImgHtml", $ImgHtml);
		
		
		$this -> moduleList = D("FieldTpl") -> getByModule($this -> actModule);
		$this -> assign("mid",$mid);
		$this -> tb = MODULE_NAME;

		$this -> editor = create_html_editor("content",$this->vo['content'],'920','250');
		$this -> display();
	}
	
	public function eidt_cate()
	{
		if(!$_POST['name'])
		{
			$this->error("类别名称不能为空");
		}
		
		if($_POST['mid'] == 0)
		{
			$this->error("模版名称必须");
		}
		
		$db = M("Category");
		$db -> create();
		$db -> lang = $_SESSION["seslang"];
		
		$file = $_FILES['attachment']['name'];
		
		$db -> subname = implode($_POST['field'], ",");
		
		if($_POST['id']>0)
		{
			$db -> id = $_POST['id'];
			$db -> editdate = time();
			
			if ($file)
			{
				import('@.ORG.doAction');
				$doAction = new doAction();
				$info = $doAction -> _upload();
				$db -> attachment = substr($info[0]['savepath'],1) . $info[0]['savename'];
			}
			else
			{
				$db -> attachment = $_POST["old_attachment"];
			}
			
			$file2 = $_FILES['doAction']['name'];
			if ($file2)
			{
				import('@.ORG.doAction');
				$doAction = new doAction();
				$info = $doAction -> _upload();
				$db -> doAction = substr($info[0]['savepath'],1) . $info[0]['savename'];
			}
			else
			{
				$db -> doAction = $_POST["old_attachment2"];
			}
			
			//更新图集排序
			for($w = 0; $w < count($_POST['field']); $w++)
			{
				M("File") -> where("id=".$_POST['field'][$w]) -> setField('displayorder',$_POST['displayorder'][$w]);
			}
			
			if($db->save())
			{
				$this -> assign('jumpUrl',__URL__."/cate/parentid/".$_POST['cid']);
				$this -> success("编辑成功");
			}
			else
			{
				$this -> error("编辑失败");
			}
		}
		else
		{
			$db -> postdate = time();
			$db -> editdate = time();
			if ($file)
			{
				import('@.ORG.doAction');
				$doAction = new doAction();
				$info =$doAction -> _upload();
				$db -> attachment = substr($info[0]['savepath'],1) . $info[0]['savename'];
			}
			$file2 = $_FILES['doAction']['name'];
			if ($file2)
			{
				import('@.ORG.doAction');
				$doAction = new doAction();
				$info =$doAction -> _upload();
				$db -> doAction = substr($info[0]['savepath'],1) . $info[0]['savename'];
			}
			if($db->add())
			{
				$this -> assign('jumpUrl',__URL__."/cate/parentid/".$_POST['cid']);
				$this -> success("添加成功");
			}
			else
			{
				$this -> error("添加失败");
			}
		}
	}
	
	////删除类别
	public function doDeleteCate()
	{
		if( empty($_POST['ids']) )
		{
			echo 0;
			exit ;
		}
		
		$idArr = explode("," , $_POST['ids']);
		
		foreach($idArr as $k => $v)
		{
			if($v)
			{
				////取类别ID，包含子类别ID
				$idsCate = getTreeIds($v);
				
				$map['id'] = array('IN', $idsCate);
				
				//删除分类下的信息
				D("Category") -> infoDel($this -> actModule,$idsCate);
				
				M('Category') -> where ($map) -> delete();
				
				$idsCate = '';
			}
		}
		
		echo 1;
	}
	
	/////批量提交操作
	public function submit()
	{
		$act = $_REQUEST['act'];
		$id = $_REQUEST['actID'];
		
		if ($act == 'delete' && !is_array($id))
		{
			$S = M($this -> actModule) -> find( $id );
			if (!$id || !$S)
				$this -> error(L('_SELECT_NOT_EXIST_'));
		}
		$this -> _subAction($this -> actModule);
	}
} 
?>