<?php
class IndexAction extends GlobalAction {
	public function index() {
		// 主控制页
		
		$map = array ();
		$map ["id"] = array (
				'IN',
				$_SESSION ['adminstr'] 
		);
		$map ["cid"] = 0;
		$map ["ischecked"] = 1;
		$Menu = D ( 'Sysmenu' )->where ( $map )->order ( 'sort desc,id asc' )->select ();
		foreach ( $Menu as $k => $v ) {
			$menustr .= '["1","/Public/admin/images/icon/00' . $v['logoimg'] . '.png","' . __APP__ . '/' . $v ["url"] . '","' . $v ["name"] . '","0","2","1"]' . ',';
			$mapc ["id"] = array (
					'IN',
					$_SESSION [ 'adminstr' ] 
			);
			$mapc ["ischecked"] = 1;
			$mapc ["cid"] = $v ['id'];
			$DRs = D ( 'Sysmenu' )->where ( $mapc )->order ( 'sort desc,id asc' )->select ();
			$Menu [$k] ['DRs'] = $DRs;
		}
		$this->menulist = substr ( $menustr, 0, - 1 );
		
		$this->assign ( 'allMenu', $Menu );
		$this->userName = $_SESSION['loginUserName'];
		
		$baseInfo = M ( 'Admin' )->find ( $_SESSION[ 'admin_ses_id' ] );
		if ($baseInfo)
			$this->baseInfo = $baseInfo;
		else
			$this->redirect ( 'login', 'Public' );
		$this->display ();		
	}
}
?>