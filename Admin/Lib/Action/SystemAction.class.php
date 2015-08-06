<?php
class SystemAction extends GlobalAction
{
	function _initialize()
	{
		parent::_initialize ();
		$this->CommonMenu = getMenuList(MODULE_NAME,ACTION_NAME,$_SESSION['adminstr']);
	}
	
	/*
	 * @系统环境
	 */
	public function index()
	{
		$serverInfo ['The Core Version'] = '2.0';
		$serverInfo ['System & PHP'] = PHP_OS . ' / PHP v' . PHP_VERSION;
		$serverInfo ['Web Server'] = $_SERVER ['SERVER_SOFTWARE'];
		$serverInfo ['Max Upload Size'] = (@ini_get ( 'file_uploads' )) ? ini_get ( 'upload_max_filesize' ) : '<font color="red">no</font>';
		
		$mysqlinfo = M ( '' )->query ( "SELECT VERSION() as version" );
		$serverInfo ['MySQL'] = $mysqlinfo [0] ['version'];
		
		$t = M ( '' )->query ( "SHOW TABLE STATUS LIKE '" . C ( 'DB_PREFIX' ) . "%'" );
		foreach ( $t as $k ) {
			$dbsize += $k ['Data_length'] + $k ['Index_length'];
		}
		$serverInfo ['System Time'] = gmdate ( "Y-n-j H:i:s", time () + 8 * 3600 );
		$statistics ['Server Information'] = $serverInfo;
		unset ( $serverInfo );
			
		$this->assign ( 'statistics', $statistics );
		$this->display ();
	
	}
	
	/*
	 * @网站参数设置
	 */
	public function setting()
	{
		$actModule = "Settings";
		$this -> vo = D($actModule) -> where("lang = '".$_SESSION["seslang"]."'") -> find(); 

		$date['module'] = $actModule;
		
		$tplRs = M('FieldTpl') -> where("module = '".$actModule."'") -> find();
		$lines = getLine($tplRs['perLine']);
		$this -> assign('lines',$lines);
		
		import('@.ORG.Module');
		$m_tpl = new Module($tplRs,$this->vo);
		$groupRs = $m_tpl -> show();
		
		$this->assign("groupRs",$groupRs);		
		
		$this->display();
		
	}
	
	
	////更新 && 写入配置
	public function update()
	{
		$actModule = "Settings";
		$Rs = D($actModule) -> where("lang = '".$_SESSION["seslang"]."'") -> find(); 
		
		$tplRs = M('FieldTpl') -> where("module = '".$actModule."'") -> find();
		
		import('@.ORG.doAction');
		$doAction = new doAction($tplRs['fieldID']);
		$formArr = $doAction -> getInfo();
		
		$db = D($actModule);
		$db -> create();
		$db -> lang = $_SESSION["seslang"];
		
		foreach($formArr as $k => $v)
		{
			$db -> $k = $v;
		}
		
		if($Rs)
		{
			$db ->where("id = ".$Rs['id']) -> save();
		}
		else 
		{
			$db -> add();
		}
					
		
		$list = $db ->where("lang = '".$_SESSION["seslang"]."'") -> find ();
		$content = "<?php\r\n// 核心配置文件\r\nif (!defined('THINK_PATH')) exit();\r\nreturn array(\r\n";
		// 获取数组
		foreach ( $list as $key => $value )
		{
			$key = strtoupper ( $key );
			$value = $value ;
			if (strtolower ( $value ) == "true" || strtolower ( $value ) == "false" || is_numeric ( $value ))
				$content .= "\t'$key'=>$value, \r\n";
			else
				$content .= "\t'$key'=>'$value',\r\n";
		}
		$content .= ");\r\n?>";
		// 写入配置文件
		$file = './config_'.$_SESSION['seslang'].'.inc.php';
		$r = @chmod ( $file, 0777 );
		$hand = file_put_contents ( $file, $content );
		if (! $hand)
			$this->error ( $file . 'Fail' );
		$this->success ( "Success" );
	}
	
	/*
	 * @数据库备份
	 */
	public function backup()
	{
		$dir = './data/database/';
		if (is_dir ( $dir ))
		{
			if ($dh = opendir ( $dir ))
			{
				while ( ($filename = readdir ( $dh )) !== false )
				{
					if ($filename != '.' && $filename != '..')
					{
						if (substr ( $filename, strrpos ( $filename, '.' ) ) == '.sql')
						{
							$file = $dir . $filename;
							$filemtime = date ( 'Y-m-d H:i:s', filemtime ( $file ) );
							$addtime [] = $filemtime;
							$log [] = array (
									'filename' => $filename,
									'filesize' => formatsize ( filesize ( $file ) ),
									'addtime'  => $filemtime,
									'filepath' => C ( 'SITEURL' ) . $file 
							);
						}
					}
				}
			}
		}
		else
		{
			mk_dir ( $dir, 0777 );
		}
		
		array_multisort ( $addtime, SORT_ASC, $log );
		$this->assign ( 'log', $log );
		
		$this->assign ( 'table', D ( 'Database' )->getTableList () );
		$this->display ();
	}
	
	public function doBackUp()
	{
		if (empty ( $_REQUEST ['backup_type'] ))
			$this->error ( 'Parameter Error' );
		
		$tables = array ();
		// 当前卷号
		$volume = isset ( $_GET ['volume'] ) ? (intval ( $_GET ['volume'] ) + 1) : 1;
		// 备份文件的文件名
		$filename = date ( 'ymd' ) . '_' . substr ( md5 ( uniqid ( rand () ) ), 0, 10 );
		
		$_REQUEST ['backup_type'] = t ( $_REQUEST ['backup_type'] ) == 'custom' ? 'custom' : 'all';
		
		if ($_REQUEST ['backup_type'] == 'all') {
			$tables = D ( 'Database' )->getTableList ();
			$tables = getSubByKey ( $tables, 'Name' );
		
		} else if ($_REQUEST ['backup_type'] == 'custom') {
			if ($_POST ['backup_table']) {
				$tables = $_POST ['backup_table'];
				$_SESSION ['backup_custom_table'] = $tables;
			} else {
				$tables = $_SESSION ['backup_custom_table'];
			}
		}
		
		$filename = trim ( $_REQUEST ['filename'] ) ? trim ( $_REQUEST ['filename'] ) : $filename;
		$startfrom = intval ( $_REQUEST ['startform'] );
		$tableid = intval ( $_REQUEST ['tableid'] );
		$sizelimit = intval ( $_REQUEST ['sizelimit'] ) ? intval ( $_REQUEST ['sizelimit'] ) : 1000;
		$tablenum = count ( $tables );
		$filesize = $sizelimit * 1000;
		$complete = true;
		$tabledump = '';
		
		if ($tablenum == 0)
			$this->error ( 'Please select tables' );
		
		for(; $complete && ($tableid < $tablenum) && strlen ( $tabledump ) + 500 < $filesize; $tableid ++) {
			
			$sqlDump = D ( 'Database' )->getTableSql ( $tables [$tableid], $startfrom, $filesize, strlen ( $tabledump ), $complete );
			
			$tabledump .= $sqlDump ['tabledump'];
			$complete = $sqlDump ['complete'];
			$startfrom = intval ( $sqlDump ['startform'] );
			if ($complete)
				$startfrom = 0;
		}
		
		! $complete && $tableid --;
		
		if (trim ( $tabledump )) {
			$filepath = './data/database/' . $filename . "_$volume" . '.sql';
			$fp = @fopen ( $filepath, 'wb' );
			
			if (! fwrite ( $fp, $tabledump )) {
				$this->error ( 'File directory write failure, please check the directory "data" can write or not' );
			} else {
				$url_param = array (
						'filename' => $filename,
						'backup_type' => $_REQUEST ['backup_type'],
						'sizelimit' => $sizelimit,
						'tableid' => $tableid,
						'startform' => $startfrom,
						'volume' => $volume 
				);
				
				$url = U ( '/System/doBackUp', $url_param );
				$this->assign ( 'jumpUrl', $url );
				
				$this->success ( "Backup No.{$volume} volume success" );
			}
		} else {
			$this->assign ( 'jumpUrl', __URL__.'/backup' );
			$this->success ( "Backup success" );
		}
	}
	
	public function doDeleteBackUp()
	{
		$_POST ['selected'] = explode ( ',', $_POST ['selected'] );
		
		foreach ( $_POST ['selected'] as $file )
		{
			$file = './data/database/' . $file . '.sql';
			file_exists ( $file ) && @unlink ( $file );
		}
		
		echo 1;
	}
	
	// 导入备份
	function import()
	{
		$filename = $_GET ['filename'];
		$sqldump = '';
		$file = './data/database/' . $filename;
		
		if (file_exists ( $file ))
		{
			$fp = @fopen ( $file, 'rb' );
			$sqldump = fread ( $fp, filesize ( $file ) );
			
			fclose ( $fp );
		}
		
		$ret = D ( 'Database' )->import ( $sqldump );
		
		if ($ret)
		{
			$this->success ( 'Import success' );
		}
		else
		{
			$this->error ( 'Import fail' );
		}
	}
	
	/*
	 * @管理员
	 */
	public function admin()
	{
		$this->list = D ( 'Admin' )->order ( 'id asc' )->select ();
		$this->display ();
	}
	
	public function doDeleteAdmin()
	{
		if (empty ( $_POST ['ids'] ))
		{
			echo 0;
			exit ();
		}
		
		$map ['id'] = t ( $_POST ['ids'] );
		echo M ( 'Admin' )->where ( $map )->delete () ? '1' : '0';
	}
	
	public function adminInfo()
	{
		if ($_GET ['vid'])
		{
			$this->list = D ( "Admin" )->find ( $_GET ['vid'] );
		}
		
		$Menu = D ( "Sysmenu" );
		$Menu = $Menu->where ( "cid=0" )->order ( 'sort desc,postdate desc' )->select ();
		$MenuNum = count ( $Menu );
		$AdminStr = explode ( ',', $this->list ["adminstr"] );
		for($i = 0; $i < $MenuNum; $i ++)
		{
			if (in_array ( $Menu [$i] ["id"], $AdminStr ))
			{
				$Menu [$i] ["IsSelect"] = 'Y';
			}
			$DRs = D ( 'Sysmenu' )->where ( "cid = " . $Menu [$i] ['id'] )->order ( 'sort desc,postdate desc' )->select ();
			$DRsNum = count ( $DRs );
			for($j = 0; $j < $DRsNum; $j ++)
			{
				if (in_array ( $DRs [$j] ["id"], $AdminStr ))
				{
					$DRs [$j] ["IsSelect"] = 'Y';
				}
			}
			$Menu [$i] ["DRs"] = $DRs;
		}
		
		$this->assign ( 'tMenu', $Menu );
		$this->assign ( 'AdminStr', $AdminStr );
		
		$this->display ();
	}
	
	public function adminpassword()
	{
		if ($_SESSION[C('USER_AUTH_KEY')])
		{
			$this->list = D ( "Admin" )->find ( $_SESSION[C('USER_AUTH_KEY')] );
		}
		
		$this->display ();
	}
	
	public function admindopassword()
	{
		$id = intval ( $_POST ['id'] );
		
		if ($id)
		{
			$password = $_POST ['password'];
			$opassword = $_POST ['opassword'];
			
			if ($password != '')
			{
				$adminpassword = md5 ( $password );
			}
			else
			{
				$adminpassword = $opassword;
			}

			M("Admin")  -> where("id = ".$id) -> setField('password',$adminpassword);
			$this->assign ( 'jumpUrl', "" . __URL__ . "/adminpassword" );
			$this->success ( "Edit Success" );
		}
	}
	
	public function doAdmin()
	{
		$id = intval ( $_POST ['id'] );
		$Admin = D ( "Admin" );
		
		if ($id)
		{
			$password = $_POST ['password'];
			$opassword = $_POST ['opassword'];
			
			if ($Admin->create ())
			{
				$Admin->adminstr = implode ( ',', $_POST ["AdminStr"] );
				if ($password != '')
				{
					$Admin->password = md5 ( $password );
				}
				else
				{
					$Admin->password = $opassword;
				}
				
				if ($Admin->save ())
				{
					$this->assign ( 'jumpUrl', "" . __URL__ . "/admin" );
					$this->success ( "更新成功" );
				}
				else
				{
					$this->error ( "更新失败,请联系管理员" );
				}
			}
		}
		else
		{
			$data = $_POST;
			
			if ($Admin->create ())
			{
				$Admin->adminstr = implode ( ',', $_POST ["AdminStr"] );
				$Admin->password = md5 ( $data ['password'] );
				$Admin->regtime = time ();
				
				if ($Admin->add ())
				{
					$this->assign ( 'jumpUrl', "" . __URL__ . "/admin" );
					$this->success ( "新增成功" );
				}
				else
				{
					$this->error ( "新增失败,请联系管理员" );
				}
			}
		}
	}
	/*
	 * @系统菜单管理
	 */
	public function sysmenu()
	{
		$list = D ( 'Sysmenu' )->where ( 'cid=0' )->order ( 'sort desc,id asc' )->select ();
		
		foreach ( $list as $k => $v )
		{
			$DRs = D ( 'Sysmenu' )->where ( 'cid=' . $v ['id'] )->order ( 'sort desc,postdate desc' )->select ();
			$list [$k] ["DRs"] = $DRs;
		}
		$this->assign ( "MenuList", $list );
		$this->display ();
	
	}
	
	public function add_menu()
	{
		
		$this->list = D ( 'Sysmenu' )->where ( 'cid=0' )->order ( 'sort desc,postdate desc' )->select ();
		
		$this->gid = $_GET ['gid'];
		
		if ($this->gid)
		{
			$this->vo = D ( 'Sysmenu' )->where ( 'id=' . $this->gid )->find ();
		}
		
		$this->display ();
	}
	
	
	public function doDeleteMenu()
	{
		if (empty ( $_POST ['ids'] ))
		{
			echo 0;
			exit ();
		}
		
		$map ['id'] = array ( 'in', $_POST ['ids'] );
		echo M ( 'Sysmenu' )->where ( $map )->delete () ? '1' : '0';
	}
	
	public function doSysMenu()
	{
		if ($_POST ['name'] == '')
		{
			echo '{"status":"0"}';
			exit ();
		}
		
		if ($_POST ['url'] == '')
		{
			echo '{"status":"1"}';
			exit ();
		}
		
		$Form = D ( "Sysmenu" );
		if ($_POST ["vid"])
		{
			$Form->create ();
			$Form->id = $_POST ["vid"];
			$list = $Form->save ();
			if ($list !== false)
			{
				echo '{"status":"success"}';
				exit ();
			} 
			else
			{
				echo '{"status":"2"}';
				exit ();
			}
		}
		else
		{
			$Form->create ();
			$list = $Form->add ();
			
			if ($list !== false)
			{
				echo '{"status":"success"}';
				exit ();
			}
			else
			{
				echo '{"status":"3"}';
				exit ();
			}
		}
	}
	
	/*
	 * @更新缓存
	 */
	public function cache()
	{
		$this->assign ( "cache", array (
				"(Website background)" => array (
						"Function library(Lib)" => "Admin/Runtime",
						"Template cache(Cache)" => "Admin/Runtime/Cache",
						"Data cache folder(Temp)" => "Admin/Runtime/Temp",
						"Log folder(Logs)" => "Admin/Runtime/Logs",
						"Data folder(Data)" => "Admin/Runtime/Data" 
				),
				"(Website Front)" => array (
						"Function library(Lib)" => "Home/Runtime",
						"Template cache(Cache)" => "Home/Runtime/Cache",
						"Data cache folder(Temp)" => "Home/Runtime/Temp",
						"Log folder(Logs)" => "Home/Runtime/Logs",
						"Data folder(Data)" => "Home/Runtime/Data" 
				) 
		) );
		$this->display ();
	}
	
	public function clearcache()
	{
		$dirs = $_POST ['id'];
		
		foreach ( $dirs as $value )
		{
			if (delDir ( $value ))
			{
				$say .= "Clear the cache folder successfully! " . $value . "</br>";
			}
			else
			{
				$say .= $value . "Delete fail</br>";
			}
		}
		$this->success ( $say );
	}
	
	/*
	 * @网站其它设置
	 */
	public function subsetting()
	{
				
		$actModule = "Subsetting";
		$this -> vo = D($actModule) -> find();
		
		$date['module'] = $actModule;
		
		$tplRs = M('FieldTpl') -> where("module = '".$actModule."'") -> find();
		$lines = getLine($tplRs['perLine']);
		$this -> assign('lines',$lines);
		
		import('@.ORG.Module');
		$m_tpl = new Module($tplRs,$this->vo);
		$groupRs = $m_tpl -> show();
		
		$this->assign("groupRs",$groupRs);		
		
		$this->display();	
	}
	////更新
	public function updates()
	{
		$actModule = "Subsetting";
		$Rs = D($actModule) -> find(); 
		
		$tplRs = M('FieldTpl') -> where("module = '".$actModule."'") -> find();
		
		import('@.ORG.doAction');
		$doAction = new doAction($tplRs['fieldID']);
		$formArr = $doAction -> getInfo();
		
		$db = D($actModule);
		$db -> create();
		
		foreach($formArr as $k => $v)
		{
			$db -> $k = $v;
		}
		
		if($Rs)
		{
			$db ->where("id = ".$Rs['id']) -> save();
		}
		else 
		{
			$db -> add();
		}
					
		$this->success ( "更新配置成功" );
	}
}
?>