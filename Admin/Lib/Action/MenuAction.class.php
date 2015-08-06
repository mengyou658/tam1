<?php
class MenuAction extends GlobalAction
{
	function _initialize()
	{
		parent::_initialize ();
		$this -> CommonMenu = getMenuList(MODULE_NAME,ACTION_NAME,$_SESSION['adminstr']);
		$this -> actModule = MODULE_NAME;
	}
	
	/*
	@栏目操作
	*/
	public function index()
	{
		$lists = D('Category') -> where("tb = '".$this->actModule."' and lang = '".$_SESSION["seslang"]."'") -> order('displayorder desc,postdate asc') -> select(); 
		
		foreach($lists as $k => $v)
		{
			$count  = M('Menu') -> where("cid = ".$v['id']) -> count(); 
			$lists[$k]['nums'] = $count;
		}
		
		$this -> lists = $lists;	
		$this -> display();
	}
	
	
	////类别管理
	public function cate()
	{
		$lists = D('Category') -> where("tb = '".$this->actModule."' and lang = '".$_SESSION["seslang"]."'") -> order('displayorder desc,postdate asc') -> select(); 
		
		foreach($lists as $k => $v)
		{
			$count  = M('Menu') -> where("cid = ".$v['id']) -> count(); 
			$lists[$k]['nums'] = $count;
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
		}
		
		if($_GET['parentid'])
		{
				$this -> parentid = $_GET['parentid'];
				$this -> parentRs = D("Category") -> find($this->parentid);
		}
		else
		{
			$this -> parentid = 0;
		}
				
		$this -> moduleList = D("FieldTpl") -> getByModule($this -> actModule);
		$this -> tb = MODULE_NAME;

		$this -> editor = create_html_editor("content",$this->vo['content'],'920','250');
		$this -> display();
	}
	
	public function eidt_cate()
	{
		if(!$_POST['name'])
		{
			$this->error("Name can't null");
		}
		
		if($_POST['mid'] == 0)
		{
			$this->error("Template must");
		}
		
		$db = M("Category");
		$db -> create();
		$db -> lang = $_SESSION["seslang"];
		
		$file = $_FILES['attachment']['name'];
		
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
			
			
			if($db->save())
			{
				$this -> assign('jumpUrl',__URL__);
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
			if ($file)
			{
				import('@.ORG.doAction');
				$doAction = new doAction();
				$info =$doAction -> _upload();
				$db -> attachment = substr($info[0]['savepath'],1) . $info[0]['savename'];
			}
			
			if($db->add())
			{
				$this -> assign('jumpUrl',__URL__);
				$this -> success("Add susscess");
			}
			else
			{
				$this -> error("Add fail");
			}
		}
	}
	/*
	@添加内容
	*/
	public function menuInfo()
	{
		if($_GET['id'])
		{
			$this -> vo = D($this -> actModule) -> find($_GET['id']); 
			
		} 
		
		$cid = $_GET['cid'] == '' ? $this -> vo['cid'] : $_GET['cid'];
		$this -> mRs = D("Category") -> find($cid); 
		
		$tplRs = M('FieldTpl') -> find($this -> mRs['mid']);
		$lines = getLine($tplRs['perLine']);
		$this -> assign('lines',$lines);
		
		import('@.ORG.Module');
		$m_tpl = new Module($tplRs,$this->vo);
		$groupRs = $m_tpl -> show();
		
		$this->assign("groupRs",$groupRs);	
		$this->assign("cid",$cid);
		$this -> display();
	}
		
	////处理添加内容
	public function edit_menu()
	{
		/*if(!$_POST['name'])
		{
			$this->error("名称不能为空");
		}*/
				
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
				
				$this -> assign('jumpUrl',__URL__."/menu/cid/".$_POST['cid']);
				$this -> success("Edit Success");
			}
			else
			{
				$this -> error("Edit Fail");
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
				$this -> assign('jumpUrl',__URL__."/menu/cid/".$_POST['cid']);
				$this -> success("Add Success");
			}
			else
			{
				$this -> error("Add Success");
			}
		}
		
	}
			
	public function doDeleteCate()
	{
		if( empty($_POST['ids']) )
		{
			echo 0;
			exit ;
		}
		$map['id'] = array('in', $_POST['ids']);
		//删除分类下的信息
		D("Category") -> infoDel($this -> actModule,$_POST['ids']);
		
		echo M('Category')->where($map)->delete() ? '1' : '0';
	}
	
	
	
	/*
	@栏目中内容管理
	*/	
	public function menu()
	{
		if($_GET['cid'] < 0)
		{
			$this -> assign('jumpUrl',__URL__);
			$this -> error("patameter lose");
		}
		
		$this -> cid = $_GET['cid'];
		
		$mTpl = D('FieldTpl') -> getByCid($_GET['cid']);
		
		$this -> listFileds = M('Field') -> where("mid = '".$mTpl['id']."' and islist = 1") -> order("sort desc,id asc") -> select();
		$this -> showDate = $this -> listFileds;
		
		$map["cid"] = $_GET['cid'];
		$map['lang'] = $_SESSION["seslang"];
		
		$this -> mRs = D("Category") -> find($_GET['cid']); 
		
		$this -> lists = D('Menu') -> where($map) -> order('displayorder desc,postdate asc') -> select(); 
		
		$this -> display();
	}
	
	////删除栏目中的内容	
	public function doDeleteMenu()
	{
		if( empty($_POST['ids']) )
		{
			echo 0;
			exit ;
		}
				
		$map['id'] = array('in', $_POST['ids']);
		
		D("Search") -> clearSearch($this -> actModule , $_POST['ids']);
		
		echo M('Menu')->where($map)->delete() ? '1' : '0';
	}
	
	//server list
	public function server()
	{
		$db = M("Server");
		
		$lang = $_SESSION["seslang"];
		$id = $_GET['id'];
		
		$vol = $db -> where("lang='".$lang."' and id=".$id) -> find();
		$this -> assign('vol',$vol);
		
		$list = $db -> select();
		$this -> assign('list',$list);
		
		$this -> display();
	}
	public function doServer()
	{
		$db = M("Server");
		$lang = $_SESSION["seslang"];
		
		if($_POST['id'])
		{
			$data['name'] = $_POST['name'];
			$data['state'] = $_POST['state'];
			$db->where('id='.$_POST['id'])->save($data);
			$this -> assign('jumpUrl',__URL__."/server");
			$this -> success("Edit Success");
		}
		else
		{
			$data['name'] = $_POST['name'];
			$data['state'] = $_POST['state'];
			$data['lang'] = $lang;
			$db->add($data);
			$this -> assign('jumpUrl',__URL__."/server");
			$this -> success("Add Success");
		}
	}
	public function delServer()
	{
		$id = $_GET['id'];
		if($id)
		{
			M("Server")->where('id='.$id)->delete();
			$this -> assign('jumpUrl',__URL__."/server");
			$this -> success("Delete Success");
		}
		else
		{
			$this -> assign('jumpUrl',__URL__."/server");
			$this -> error("Delete Fail!");
		}
	}
	public function win()
	{
		$db = M("Win");
		$lang = $_SESSION["seslang"];
		
		$vol = $db -> where("lang='".$lang."'") -> limit(1) -> find();
		$this -> assign('vol',$vol);
		
		$this -> display();
	}
	public function doWin()
	{
		$db = M("Win");
		$lang = $_SESSION["seslang"];
		
		if(!$_POST['win'])
		{
			$this -> assign('jumpUrl',__URL__."/Win");
			$this -> error("Maximun win can't be null!Please Input Again!");
		}
		if(!is_numeric($_POST['win']))
		{
			$this -> assign('jumpUrl',__URL__."/Win");
			$this -> error("Maximun win must be a number!Please Input Again!");
		}
		if($_POST['id'])
		{
			$data['win'] = $_POST['win'];
			$db->where('id='.$_POST['id'])->save($data);
			$this -> assign('jumpUrl',__URL__."/Win");
			$this -> success("Edit Success");
		}
		else
		{
			$this -> assign('jumpUrl',__URL__."/Win");
			$this -> error("Edit Fail!");
		}
	}	
} 
?>