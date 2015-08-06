<?php
class ModuleAction extends GlobalAction
{
	function _initialize()
	{
		parent::_initialize();
		$this->CommonMenu = getMenuList(MODULE_NAME,ACTION_NAME,$_SESSION['adminstr']);
	}
	
	/*
	@列表展示
	*/
	public function index()
	{
		$tb = ucfirst(strtolower($_GET['tb']));
		if($tb) $map['module'] = array("eq",$tb);
		$Moudle = M('FieldTpl'); 
		import('ORG.Util.Page');
		$count = $Moudle -> where($map) -> count();
		$Page  = new Page($count,10);
		$show  = $Page -> show();
		
		$list = $Moudle -> where($map)->order('sort desc,id asc')->limit($Page->firstRow.','.$Page->listRows) -> select();
		
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this -> menuTitle = "模版管理";
		$this->display();
	}
	
	////新增模版
	public function TplAE()
	{
		if(!$_POST['name'] || !$_POST['module'] )
		{
			$this -> error("模版名称和版块不能为空");
		}
		$tableName = ucfirst(strtolower($_POST['module']));
		$old_tableName = ucfirst(strtolower($_POST['oldtb']));
		
		$db = D("FieldTpl");
		$db -> create();
		$db -> module = $tableName;
		
		if($_POST['id']) 
		{
			if($tableName <> $old_tableName)
			{
				$from = C('DB_PREFIX').strtolower($old_tableName);
				$to = C('DB_PREFIX').strtolower($tableName);
				
				D('Database') -> renameTable($from,$to);	
			}
			
			$db -> editdate = time();
			
			if($db -> save())
			{
				$this->success("修改成功");
			}
			else
			{
				$this->error("新增失败");
			}
		}
		else
		{
			$cTable = C('DB_PREFIX').strtolower($_POST['module']);
			
			if(!D('Database') -> chkTable($cTable)) D('Database') -> createModule($cTable);
			
			$db -> postdate = time();	
			$db -> editdate = time();
			
			if($db -> add())
			{
				$this->success("新增成功");
			} 
			else
			{
				$this->error("新增失败");
			}
		}
	}
	
	////删除模版
	public function TplDel()
	{
		if(!$_GET['id']) $this -> error("参数错误");
		
		$Rs = M('FieldTpl') -> find($_GET['id']);
		
		M('FieldTpl') -> where("id='".$_GET['id']."'") -> delete();
		
		/*
		** 暂不删除表
		$delTable = C('DB_PREFIX').strtolower($Rs['module']);
		M('') -> query('DROP TABLE IF EXISTS `'.$delTable.'`');
		*/
		
		$this->success("删除成功");
	}
	
	
	/////模版详细
	public function moduleFields()
	{
		if(!$_GET['id']) $this -> error("参数错误");
		
		$id = $_GET['id'];
		
		$Rs = D('FieldTpl') -> find($id); 

		$GroupID = @explode("||",$Rs["groupID"]);
		$GroupName = @explode("||",$Rs["groupName"]);
		$FieldID = @explode("||",$Rs["fieldID"]);
		$FieldTitle = @explode("||",$Rs["fieldTitle"]);
		
		$i=0;
		
		foreach($GroupID as $GID)
		{
			$Rs["Group"][$GID] = $GID;
			$Rs["GName"][$GID] = $GroupName[$i];
			$i++;
		}
		
		$i=0;
		
		foreach($FieldID as $FID)
		{
			$Rs["Field"][$FID] = $FID;
			$Rs["FTitle"][$FID] = $FieldTitle[$i];
			$i++;
		}
		$GroupRs = D('FieldGroup') -> where('module="'.$Rs['module'].'"') -> order('sort desc,postdate asc') -> select(); 
		
		foreach($GroupRs as $k => $GRs)
		{
			$DRs = D('Field') -> where('groupID="'.$GRs['id'].'"') -> order('sort desc,id asc') -> select(); 
			$GroupRs[$k]["DRs"] = $DRs;
		}
		
		$this -> menuTitle = "模版详细";
		$this->assign("GroupRs",$GroupRs);	
		$this->assign("Rs",$Rs);
		$this->display();
	}
	
	
	////模版分组
	public function moduleGroup()
	{
		$tplRs = M("FieldTpl") ->field('module,name') -> find($_GET['gid']);	
		$this -> moduleName = $tplRs['name'];
		$this -> module = $tplRs['module'];
		
		$map['module'] = $tplRs['module'];
		$this -> lists = D('FieldGroup') -> where($map) -> order('sort desc,id asc') -> select();
		
		$this -> menuTitle = "模版分组信息";
		$this->display();
	}
	
	/////添加分组
	public function GroupAE()
	{
		$db = D("FieldGroup");
		$db -> name = $_POST['name'];
		$db -> sort = $_POST['sort'];
		$db -> postdate = time();	
		$db -> module = $_POST['module'];
		
		if($db->add())
		{
			$this->success("新增成功");
		}
		else
		{
			$this->error("新增失败");
		}
	}
	
	/////删除分组信息
	public function GroupDel()
	{
		if(!$_GET['id']) $this -> error("参数错误");
		
		M('FieldGroup') -> where("id='".$_GET['id']."'") -> delete();
		M('Field') -> where("groupID='".$_GET['id']."'") -> delete();
		
		$this -> success("删除成功");
	}
	
	/////模版字段页
	function fieldAE()
	{
		if(!$_REQUEST['mid'])
		{
			$this->assign('jumpUrl',__URL__."/moduleGroup");
			$this->error("未定义模版，请重新选择");
		}
		
		$this -> mid = $_REQUEST['mid'];
		$tplRs = M("FieldTpl") ->field('module') -> find($this -> mid);
		
		$this -> GroupRs = D('FieldGroup')->where('module = "'.$tplRs['module'].'"')->order('sort desc,postdate asc')->select(); 
		
		if($_REQUEST['id'])
		{
			$this -> Rs = D('Field') -> find($_REQUEST['id']); 	
		}
		
		$this -> menuTitle = "新增字段";
		$this -> display();
	}	
					
	////新增字段 操作
	public function doField()
	{
		if($_POST['groupID'] == '') $this->error("请选择分组");
		
		if(!$_POST['mid'])
		{
			$this->assign('jumpUrl',__URL__."/moduleGroup");
			$this->error("未定义模版，请重新选择");
		}
		
		$mid = $_POST['mid'];
		$actModuleRs = M("FieldTpl") -> find($mid);
		$actModule = $actModuleRs['module'];
		
		$db  = D("Field");
		$len = 255;
		
		if(intval($_POST['id']) > 0)
		{
			$chkRs = D('Field') -> where("id = ".$_REQUEST['id']) -> find(); 
			
			if($chkRs['fieldName'] != $_POST['fieldName']) 
			{
				$chkField = D('Field') -> where("mid = '".$mid."' and fieldName = '".trim($_POST['fieldName']."'")) -> find(); 
				if($chkField) $this->error("该字段己存在");
			}
			
			$db -> id = $_POST['id'];
			$db -> editdate = time();
			
			$Rs = D($actModule)->execute('DESC  __TABLE__  '.trim($chkRs['fieldName']).' ');
			
			if(!$Rs)
			{
				switch($_POST["fieldType"])
				{
					case "INT":
						D($actModule)->execute('ALTER TABLE __TABLE__ ADD  '.trim($_POST["fieldName"]).' INT');
					break;
					case "FLOAT":
						D($actModule)->execute('ALTER TABLE __TABLE__ ADD  '.trim($_POST["fieldName"]).' FLOAT( 16, 2 )');
					break;
					case "TEXT":
						D($actModule)->execute('ALTER TABLE __TABLE__ ADD  '.trim($_POST["fieldName"]).' TEXT');
					break;
					case "DATE":
						D($actModule)->execute('ALTER TABLE __TABLE__ ADD  '.trim($_POST["fieldName"]).' DATE');
					break;
					case "DATETIME":
						D($actModule)->execute('ALTER TABLE __TABLE__ ADD  '.trim($_POST["fieldName"]).' DATETIME');
					break;
					default: 
						D($actModule)->execute('ALTER TABLE __TABLE__ ADD  '.trim($_POST["fieldName"]).' VARCHAR( '.$len.' )');
					break;
				}
			}
			else
			{
				switch($_POST["fieldType"])
				{
					case "INT":
						D($actModule)->execute('ALTER TABLE __TABLE__ CHANGE '.trim($chkRs["fieldName"]).' '.trim($_POST["fieldName"]).' INT');
					break;
					case "FLOAT":
						D($actModule)->execute('ALTER TABLE __TABLE__ CHANGE '.trim($chkRs["fieldName"]).' '.trim($_POST["fieldName"]).' FLOAT( 16, 2 )');
					break;
					case "TEXT":
						D($actModule)->execute('ALTER TABLE __TABLE__ CHANGE '.trim($chkRs["fieldName"]).' '.trim($_POST["fieldName"]).' TEXT');
					break;
					case "DATE":
						D($actModule)->execute('ALTER TABLE __TABLE__ CHANGE '.trim($chkRs["fieldName"]).' '.trim($_POST["fieldName"]).' DATE');
					break;
					case "DATETIME":
						D($actModule)->execute('ALTER TABLE __TABLE__ CHANGE '.trim($chkRs["fieldName"]).' '.trim($_POST["fieldName"]).' DATETIME');
					break;
					default:
						D($actModule)->execute('ALTER TABLE __TABLE__ CHANGE '.trim($chkRs["fieldName"]).' '.trim($_POST["fieldName"]).' VARCHAR( '.$len.' )');
					break;
				}
			}
			$db -> create();
			$db -> fieldName = trim($_POST['fieldName']);
			$db -> postdate = time();
			$db -> editdate = time();
			if($db->save())
			{
				$this->assign('jumpUrl',__URL__."/moduleFields/id/".$mid);
				$this->success("修改成功");
			}
			else
			{
				$this->error("修改失败");
			}
		}
		else
		{
			$chkField = D('Field') -> where("mid = '".$mid."' and fieldName = '".trim($_POST['fieldName']."'")) -> find(); 
			if($chkField) $this->error("该字段己存在");
			
			switch($_POST["fieldType"])
			{
				case "INT":
					D($actModule)->execute('ALTER TABLE __TABLE__ ADD  '.trim($_POST["fieldName"]).' INT');
				break;
				case "FLOAT":
					D($actModule)->execute('ALTER TABLE __TABLE__ ADD  '.trim($_POST["fieldName"]).' FLOAT( 16, 2 )');
				break;
				case "TEXT":
					D($actModule)->execute('ALTER TABLE __TABLE__ ADD  '.trim($_POST["fieldName"]).' TEXT');
				break;
				case "DATE":
					D($actModule)->execute('ALTER TABLE __TABLE__ ADD  '.trim($_POST["fieldName"]).' DATE');
				break;
				case "DATETIME":
					D($actModule)->execute('ALTER TABLE __TABLE__ ADD  '.trim($_POST["fieldName"]).' DATETIME');
				break;
				default: 
					D($actModule)->execute('ALTER TABLE __TABLE__ ADD  '.trim($_POST["fieldName"]).' VARCHAR( '.$len.' )');
				break;
			}
			
			$db -> create();
			$db -> fieldName = trim($_POST['fieldName']);
			$db -> postdate=time();
			
			if($db -> add())
			{
				$this -> assign('jumpUrl',__URL__."/moduleFields/id/".$mid);
				$this -> success("新增成功");
			}
			else
			{
				$this -> error("新增失败");
			}
		}
		
	}
	
	////删除字段
	function fieldDel(){
		if(!$_GET['id']) $this->error("参数错误");
		
		$actModuleRs = M("FieldTpl") -> find($_GET['mid']);
		$actModule = $actModuleRs['module'];
		
		$Rs = M('field') -> find($_GET['id']);
		////删除字段表中的记录
		M('Field') -> where("id='".$_GET['id']."'") -> delete();
		////删除对应表的字段
		D($actModule) -> execute('ALTER TABLE __TABLE__ DROP '.$Rs["fieldName"].'');
		$this -> success("删除成功");
	}
	
	////保存字段修改
	function upTpl()
	{
		$GroupID = @implode("||",$_POST["GroupID"]);
		
		$GN = array();
		for($i=0;$i<count($_POST["GroupID"]);$i++)
		{
			$GN[] = $_POST["GroupName"][isInArray($_POST["GroupID"][$i],$_POST["GID"],1)];
		}
		
		$GroupName = @implode("||",$GN);
		
		$FieldID = @implode("||",$_POST["FieldID"]);
		
		$FT = array();
		$FN = array();

		for($i=0;$i<count($_POST["FieldID"]);$i++)
		{
			$FT[] = $_POST["name"][isInArray($_POST["FieldID"][$i],$_POST["upID"],1)];
			$FN[] = $_POST["fieldName"][isInArray($_POST["FieldID"][$i],$_POST["upID"],1)];
		}
		$FieldTitle = @implode("||",$FT);
		$FieldName = @implode("||",$FN);
		
		
		D('FieldTpl') -> execute('UPDATE __TABLE__ SET `groupID`="'.$GroupID.'",`groupName`="'.$GroupName.'",`fieldID`="'.$FieldID.'",`fieldTitle`="'.$FieldTitle.'",`fieldName`="'.$FieldName.'" WHERE `id` ='.$_POST['TplID'].'');
		
		$this->success("保存选择字段成功");
	}
	
	///修改字段信息	
	function saveTpl()
	{
		$tid = $_POST['upID'];
		for($i=0; $i<count($tid); $i++)
		{
			D('Field') -> execute('UPDATE __TABLE__ SET `name`="'.$_POST['name'][$i].'",`sort`="'.$_POST['sort'][$i].'" WHERE `id` ='.$tid[$i].'');
		}
		
		$this -> success("修改成功");
	}		
} 
?>