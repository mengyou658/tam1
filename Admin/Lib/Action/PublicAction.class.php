<?php
class PublicAction extends Action
{
	// 用户登录页面
    public function login()
	{   
        if(!isset($_SESSION['isLogin']))
		{
			$webInformation = M("Siteinfo") -> find();
			$sysManage = M('Settings') -> where( "lang='".$webInformation["default_lang"]."'" ) -> find();
			$this->assign("sysManage",$sysManage);
            $this->display();
        } 
		else 
		{
            $this->redirect('/Index/index');
        }
		
    }

    // 用户登出
    public function logout()
	{        
		unset($_SESSION);
		session_destroy();
		$this->redirect('/Public/login');
    }

    // 登录检测
    public function checkLogin()
	{
		if($_SESSION['verify'] != md5($_POST['verify']))
		{
            $this->error('Verify Code Wrong！');
        }
		
        if(empty($_POST['username']))
		{
            $this->error('Account Must！');
        }
		elseif (empty($_POST['password']))
		{
            $this->error('Password Must！');
        }
		
        $map            	= array();
        $map['username']	= $_POST['username'];
        $map["ischecked"]	= array('eq',1);
        
       $authInfo = M('Admin') -> where($map) -> find();
        //使用用户名、密码和状态的方式进行认证
        if(!$authInfo)
		{
            $this->error('Account isn\'t exist or was baned!');
        }
		else
		{
            if($authInfo['password'] != md5($_POST['password']))
			{
                $this->error('Password Wrong！');
            }
			
            $_SESSION[C('USER_AUTH_KEY')]	= $authInfo['id'];
            $_SESSION['loginUserName']		= $authInfo['nickname'];
            $_SESSION['lastLoginTime']		= $authInfo['last_login_time'];
            $_SESSION['login_count']		= $authInfo['login_count'];
			$_SESSION['adminstr']			= $authInfo['adminstr'];
			$_SESSION['isLogin']			= 'Y';
			$_SESSION['admintype']			= $authInfo['admintype'];
			 
			if($authInfo['username'] == 'administrator')
			{
                $_SESSION[C('ADMIN_AUTH_KEY')]		=	true;
            }           
            //保存登录信息
            $User	=	M('Admin');
            $ip		=	get_client_ip();
            $time	=	time();
            $data   = array();
            $data['id']				= $authInfo['id'];
            $data['lastlogintime']	= $time;
            $data['logintimes']		= array('exp','logintimes+1');
            $data['lastloginip']	= $ip;
            $User->save($data);
			
            $this->ajaxReturn('', 'Login Success！', 1);
        }
    }
	
	//验证码
    public function verify()
	{
        $type =	isset($_GET['type'])?$_GET['type']:'gif';
        import("ORG.Util.Image");
        Image::buildImageVerify(4,1,$type);
    }

    // 修改资料
    public function change()
	{
        $this -> checkUser();
		
        $User =	D("User");
        if(!$User->create())
		{
            $this->error($User->getError());
        }
        $result	= $User->save();
		
        if(false !== $result)
		{
            $this->success('资料修改成功！');
        }
		else
		{
            $this->error('资料修改失败!');
        }
    }
	
	///提示页
	public function success()
	{
		
		$this -> display();	
	}
	
	/////修改密码
	public function pwd()
	{
		$this -> menuTitle = "修改密码";
		$this -> display();	
	}
	////修改密码操作
	public function changePwd()
    {
		/*if(session('verify') != md5($_POST['verify']))
		{
            $this->error('验证码错误！');
        }*/
		
		if($_POST["password"]=='' || $_POST["repassword"]=='')
		{
			$this->error('新密码和确认密码不能为空！');
		}
		
		if($_POST["password"]!=$_POST["repassword"])
		{
			$this->error('确认密码与新密码不一致！');
		}
		
		$map				= array();
        $map['password']	= md5($_POST['oldpassword']);
        $map['id']			= $_SESSION[C('USER_AUTH_KEY')];
        //检查用户
        $User = M("Admin");
		
        if(!$User->where($map)->field('id')->find())
		{
            $this->error('旧密码不符或者用户名错误！');
        }
		else
		{
			$User->password	= md5($_POST['password']);
			$User->save();
			$this->success('密码修改成功！');
        }
    }
	
	/*
	@大文件上传
	*/		
	public function upbigfile()
	{
		if (!empty($_FILES))
		{
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	
			$new_file_name = new_name( $_FILES['Filedata']['name'] );
			$targetFile =  str_replace('//','/',$targetPath) . $new_file_name;
	    	@mkdir(str_replace('//','/',$targetPath), 0755, true);
	
			//防止中文文件名乱码
			move_uploaded_file($tempFile,iconv('utf-8','gbk', $targetFile));
			$fSrc = $_REQUEST['folder'] .  $new_file_name;
			$f = $_REQUEST['field'];
			$str = randstr(5, 'NUMBER');
			$File = M("File");
			$File -> postdate = time();
			$File -> attachment = $fSrc;
			$File -> name = $_FILES['Filedata']['name'];
			$File -> add();
			$insertID = mysql_insert_id();
			$sn = time().$str;
			
			echo $fSrc;
		}
	}
	
	/*
	@图片批量上传
	*/	
	
	public function upPics() {
		if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';

			$new_file_name = new_name($_FILES['Filedata']['name']);
			$targetFile = str_replace('//', '/', $targetPath) . $new_file_name;
			@mkdir(str_replace('//', '/', $targetPath), 0755, true);

			//防止中文文件名乱码
			move_uploaded_file($tempFile, iconv('utf-8', 'gbk', $targetFile));
			$imgSrc = $_REQUEST['folder'] . '/' . $new_file_name;
			
			$f = $_REQUEST['field'];
			
			$str = randstr(5, 'NUMBER');
			$File = D("File");
			$File -> postdate = time();
			$File -> attachment = $imgSrc;
			$File -> name = $_FILES['Filedata']['name'];
			$File -> add();
			$insertID = mysql_insert_id();
			$sn = time() . $str;
			$Html = '<dl id=\'' . $sn . '\'><dt><input type=\'hidden\' name=\''.$f.'[]\' value=\'' . $insertID . '\'><a href=\'' . $imgSrc . '\' target=\'_blank\'><img src=\'' . $imgSrc . '\' width=\'98\' height=\'98\'></a></dt><dd><a href=\'javascript:MoveHtml(' . $sn . ')\'>Delete <img src=\'/Public/admin/images/del.gif\' align=\'absbottom\'></a><br /><input type=\'text\' name=\'displayorder[]\' value=\''.$insertID.'\' style="width:80px;text-align:center;" ></dd></dl>';
			echo $Html;
		}

	}
	
	public function download()	
	{
		download(".".$_GET['fid']);
	}
	
	public function getAccess()
	{
		
		$conn=new COM("ADODB.Connection");
		$dsn="DRIVER={Microsoft Access Driver (*.mdb)};DBQ=".realpath("./aspDate/Database3.mdb").";";
		$conn->open($dsn);
		//$pro = iconv( "utf-8", "gbk", '贵州' );
		//$cit = iconv( "utf-8", "gbk", '遵义' );
		$sql = "select * from Products where ClassID=729";

		$res = $conn -> execute($sql);
		while(!$res -> EOF) {
			$f1 = $res ->fields['ProductName']->value;
			$f2 = $res ->fields['ProductModel']->value;
			$f3 = $res ->fields['SmallPic']->value;
			$f4 = $res ->fields['UpdateTime']->value;
			$f5 = $res ->fields['BigPic']->value;
			//$cid = iconv( "gbk", "utf-8", $f3 );
			
			$db = M("products1");
			$date["ProductName"] = iconv( "gbk", "utf-8", $f1 );
			$date["Code"] = iconv( "gbk", "utf-8", $f2 );
			$date["Images"] = iconv( "gbk", "utf-8", $f3 );
			$date["AddDay"] = str_replace('/','-',iconv( "gbk", "utf-8", $f4 ));
			$date["Content"] = "<p>".iconv( "gbk", "utf-8", $f5 )."</p>";
			$date["SID"] = 71;
			$date["Domain"] = 'localhost';
			$date["Ver"] = 'cn';
			$date["doAction"] = 'zhinengsuo';
			$date["Active"] = '上架';
			//$date["postdate"] = strtotime(iconv( "gbk", "utf-8", $f4 ));
			//$db->add($date);
			//echo $db->getlastsql();exit;
			echo "OK";
			$res -> movenext(); 
		}  	
	}
}
?>