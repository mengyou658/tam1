<?php
class WebsiteAction extends GlobalAction
{
	function _initialize()
	{
		parent::_initialize ();
		$this->CommonMenu = getMenuList(MODULE_NAME,ACTION_NAME,$_SESSION['adminstr']);
		$this -> actModule = MODULE_NAME;
	}
	
	/*
	 * @网站架构
	 */
	public function index()
	{
		$lang = $_SESSION["seslang"];
		
		$list = D ( 'Website' )-> where ( "cid = 0 and lang='".$lang."'" )->order ( 'sort desc,id asc' )->select ();
		
		$this->assign ( "MenuList", $list );
		$this->display ();
	
	}
	
	public function add_menu()
	{
		$lang = $_SESSION["seslang"];
		
		$this -> gid = $_GET ['gid'];
		
		if ($this -> gid)
		{
			$this -> vo = D ( 'Website' ) -> where ( "lang='".$lang."'" ) -> find ($this->gid);
		}
		
		$this -> display ();
	}
	
	
	public function doDeleteMenu()
	{
		if (empty ( $_POST ['ids'] ))
		{
			echo 0;
			exit ();
		}
		
		$map ['id'] = array ( 'in', $_POST ['ids'] );
		echo M ( 'Website' )->where ( $map )->delete () ? '1' : '0';
	}
	
	public function doSysMenu()
	{
		$lang = $_SESSION["seslang"];
		
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
		
		$Form = D ( "Website" );
		if ($_POST ["id"])
		{
			$Form -> create ();
			$Form -> id = $_POST ["id"];
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
			
			$Form -> lang = $lang;
			
			$list = $Form -> add ();
			
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
}
?>