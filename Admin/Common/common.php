<?php
/*
 * 截取字符
 */
function cutStr($title, $titlelen = 20)
{
	$title = iconv("utf-8", "gbk", $title);
	$title = strip_tags($title);
	$len = strlen($title);
	
	if ($len <= $titlelen)
	{
		$title = $title;
	}
	else
	{
		$title = substr($title, "0", "{$titlelen}");
		$parity = 0;
		$i = 0;
		
		for (; $i < $titlelen; ++$i)
		{
			$temp_str = substr($title, $i, 1);
			if (127 < ord($temp_str))
			{
				$parity += 1;
			}
		}
		if ($parity % 2 == 1)
		{
			$title = substr($title, 0, $titlelen - 1) . "...";
		}
		else
		{
			$title = substr($title, 0, $titlelen) . "...";
		}
	}
	$title = iconv("gbk", "utf-8", $title);
	return $title;
}
/*
 * 取得模块子菜单
 */
function getMenuList($m_name , $act_name, $adminStr)
{	
	$actModule = M('Sysmenu');
	$mRs = $actModule -> where("cid = 0 and url = '".$m_name."'") -> find();
	//chkAccsee($mRs['id'],$adminStr);
	
	$map['ischecked'] = array('eq',1);
	$map['cid'] = array('eq',$mRs['id']);
	$map['id'] = array('in',$adminStr);
	$rs = $actModule -> where($map) ->  order('sort desc,postdate desc') -> select();
	return $rs;
}


/*
 * 检测权限
 */
function chkAccsee($chkID,$adminStr) 
{
	if ( !in_array ($chkID, explode("," , $adminStr)) )
	{
		unset($_SESSION);
		session_destroy();
	}
}

/*
 * 取得模板名
 */
function getModule($gid)
{
	$Rs = M("FieldTpl") -> field('name') -> find($gid);	
	return $Rs['name'];
}


/*
 * 取得类别名称
 */
function getCate($id)
{
	$Rs = M("Category") -> field('name') -> find($id);	
	return $Rs['name'];
}

/*
 * 输出状态显示文字
 */
 
function outText($val , $types)
{
	switch ($types) 
	{
		case "ischecked" :
			if($val == 1)
			{
				$text = "Actived";
			}
			else
			{
				$text = "Locked";	
			}
		break;
		
		case "isgood" :
			if($val == 1)
			{
				$text = "Yes";
			}
			else
			{
				$text = "No";	
			}
		break;
		
		default :
			if($val == 1)
			{
				$text = "Yes";
			}
			else
			{
				$text = "No";	
			}
		break;
	}
	
	return $text;
}
/*
 * 判断值是否存在于数组中
 * $reKey = 1 返回存在数组中第几个;
 */
function isInArray( $Value, $Array, $reKey = 0 )
{
	$Num = 0;
	$i = 0;
	for ( ;	$i < count( $Array );	++$i	)
	{
		if ( $Value == $Array[$i] )
		{
			++$Num;
			$key = $i;
		}
	}
	if ( 0 < $Num )
	{
		if ( $reKey == 1 )
		{
			return $key;
		}
		else
		{
			return true;
		}
	}
	else
	{
		return false;
	}
}


/*
 * 模板每行的宽度
 */
function getLine($num) {
	switch($num)
	{
		case "1":
			$line[0] = "20%";
			$line[1] = "80%";
		break;
		
		case "2":
			$line[0] = "15%";
			$line[1] = "30%";
		break;
		
		case "3":
			$line[0] = "13%";
			$line[1] = "20%";
		break;
		
		case "4":
			$line[0] = "11%";
			$line[1] = "14%";
		break;
		
		case "5":
			$line[0] = "8%";
			$line[1] = "12%";
		break;
	}
	
	return $line;
}

/*
 * 下载
 */
function download( $file )
{
	if ( !is_file( $file ) )
	{
		exit( "<b>404 File not found!</b>" );
	}
	$len = filesize( $file );
	$filename = basename( $file );
	$file_extension = strtolower( substr( strrchr( $filename, "." ), 1 ) );
	switch ( $file_extension )
	{
	case "exe" :
		$ctype = "application/octet-stream";
		break;
	case "zip" :
		$ctype = "application/x-zip-compressed";
		break;
	case "rar" :
		$ctype = "application/x-rar";
		break;
	default :
		$ctype = "application/force-download";
	}
	header( "Cache-Control:" );
	header( "Cache-Control: public" );
	header( "Content-Type: {$ctype}" );
	if ( strstr( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) )
	{
		$iefilename = preg_replace( "/\\./", "%2e", $filename, substr_count( $filename, "." ) - 1 );
		header( "Content-Disposition: attachment; filename=\"{$iefilename}\"" );
	}
	else
	{
		header( "Content-Disposition: attachment; filename=\"{$filename}\"" );
	}
	header( "Accept-Ranges: bytes" );
	$size = filesize( $file );
	$fp = fopen( "{$file}", "rb" );
	fseek( $fp, $range );
	while ( !feof( $fp ) )
	{
		set_time_limit( 0 );
		print fread( $fp, 8192 );
	}
	fclose( $fp );
	exit( );
}

////编辑器
function create_html_editor($input_name, $input_value = '', $width = '250', $height = '260', $toolbarset = "wide")
{
	require ("ckeditor/ckeditor.php" );
	$editor = new CKEditor ( '/ckeditor/' );
	$editor->returnOutput = true;
	$config = array ();
	$config ['toolbar'] = array (
	array ('Source','Preview','-','Cut','Copy','Paste','PasteText','PasteFromWord','RemoveFormat','Bold','Italic','Underline','StrikeThrough','-','OrderedList','UnorderedList','-','Outdent','Indent'), 
	array ('JustifyLeft','JustifyCenter','JustifyRight','-','Link','Unlink','Anchor','-','TextColor','BGColor'),
	array('Font','FontSize','-'),
	array('Image','Flash','Rule','Table','Smiley'),
	 );
	$config ['font_names']= '微软雅黑;宋体;黑体;楷体_GB2312;Arial;Comic Sans MS;Courier New;Tahoma;Times New Roman;Verdana' ;
	$config ['width'] = $width;
	$config ['height'] = $height;
	$config ['resize_enabled'] = false; 
	$config ['filebrowserImageUploadUrl']= '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	$CKEditor = $editor->editor ( $input_name, $input_value, $config );
	return $CKEditor;
}	

/////格式化文件大小
function formatsize($fileSize)
{
	$size = sprintf("%u", $fileSize);
	if($size == 0)
	{
		return("0 Bytes");
	}
	$sizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
	return round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizename[$i];
}

/****
 *中国省市县联动
 *字段：$field (ex: provice)
 *字段值：$val (串行化)
****/
function chinaCity($field,$val) {
	$cityVal = unserialize($val);
	$province = M("Region") -> where('parent_id = 0 ') -> select();
	
	$selStr = "<select name='".$field."' id='".$field."' onchange=\"getCity(this.value,'".$field."')\">";
	$selStr .= "<option value=\"\">请选择</option>";
	foreach($province as $pv) {
		if($cityVal['province'] == $pv['region_id']) $selected = " selected=\"selected\"";
		
		$selStr .= "<option value=\"".$pv['region_id']."\" $selected>".$pv['region_name']."</option>";
		$selected = '';
	}
	
	if($cityVal['city']) {
		$selCityStr = "<select name='".$field."_city' id='".$field."_city' onchange=\"getTown(this.value,'".$field."')\">";
		$selCityStr .= "<option value=\"\">请选择</option>";
	
		$proCity = M("Region") -> where('parent_id =  '.$cityVal['province']) -> select();
		
		foreach($proCity as $cv) {
			if($cityVal['city'] == $cv['region_id']) $selected = " selected=\"selected\"";
			
			$selCityStr .= "<option value=\"".$cv['region_id']."\" $selected>".$cv['region_name']."</option>";
			$selected = '';
		}
		$selCityStr .= "</select>" ;
	}
	
	if($cityVal['town']) {
		$selTownStr = "<select name='".$field."_town' id='".$field."_town'>";
		$selTownStr .= "<option value=\"\">请选择</option>";
	
		$proTown = M("Region") -> where('parent_id =  '.$cityVal['city']) -> select();
		foreach($proTown as $tv) {
			if($cityVal['town'] == $tv['region_id']) $selected = " selected=\"selected\"";
			
			$selTownStr .= "<option value=\"".$tv['region_id']."\" $selected>".$tv['region_name']."</option>";
			$selected = '';
		}
		$selTownStr .= "</select>" ;
	}
	
	$selStr .= "</select>&nbsp;&nbsp;<span id=\"".$field."_city\">".$selCityStr."</span>&nbsp;&nbsp;<span id=\"".$field."_town\">".$selTownStr."</span>";
	
	return $selStr;
}

/**
 * 去一个二维数组中的每个数组的固定的键知道的值来形成一个新的一维数组
 * @param $pArray 一个二维数组
 * @param $pKey 数组的键的名称
 * @return 返回新的一维数组
 */
function getSubByKey($pArray, $pKey="", $pCondition="")
{
	$result = array();
	foreach($pArray as $temp_array)
	{
		if(is_object($temp_array))
		{
			$temp_array = (array) $temp_array;
		}
		if((""!=$pCondition && $temp_array[$pCondition[0]]==$pCondition[1]) || ""==$pCondition)
		{
			$result[] = (""==$pKey) ? $temp_array : isset($temp_array[$pKey]) ? $temp_array[$pKey] : "";
		}
	}
	return $result;
}


/****
*****生成文件名
***/
function new_name($filename)
{
	$ext = pathinfo($filename);
	$ext = $ext['extension'];
	$name = basename($filename,$ext); 
	$name = md5($name.time()).'.'.$ext;
	return $name;
}

/////随机字符
function randstr( $len = 6, $format = "ALL" )
{
	switch ( $format )
	{
		case "ALL" :
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			break;
		case "CHAR" :
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~";
			break;
		case "CHARSMALL" :
			$chars = "abcdefghijklmnopqrstuvwxyz";
			break;
		case "CHARBIG" :
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			break;
		case "WORD" :
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
			break;
		case "NUMBER" :
			$chars = "123456789";
			break;
		default :
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			break;
	}
	mt_srand( ( double )microtime( ) * 1000000 * getmypid( ) );
	$password = "";
	while ( strlen( $password ) < $len )
	{
		$password .= substr( $chars, mt_rand( ) % strlen( $chars ), 1 );
	}
	return $password;
}

/***
***   遍历删除文件夹
***/
function delDir($path)
{
	if (is_dir($path)) 
	{
		if ($dh = opendir($path))
		{
			while (($file = readdir($dh)) !== false) 
			{
				if($file!=".."&&$file!=".")
				{
					if(is_dir($path."/".$file))
					{
						if(!delDir($path."/".$file))
						{
							return 0;
						}
					}
					else
					{
						if(!unlink($path."/".$file))
						{
							return 0;
						}
					}
				}
			}
		closedir($dh);
		}
		return 1;
	}
} 

////输出列表展示

function outDateList($formType , $val)
{
	switch ($formType)
	{
		case "file" :
			$outStr = "<a href=\"$val\" class=\"lightbox\"><img src=\"$val\" class=\"sImg\"/></a>"; 
		break;
		case "filedir" :
			if(!$val)
			{
				$outStr = "未上传";
			}
			else
			{
				echo outFileDir($val);
			}
		break;
		default :
			$outStr = "<span title=\"$val\">".cutStr($val,38)."</span>";
		break;
	}
	
	echo $outStr;
	
	
	/*if($formType == 'file') {
		$outStr = "<a href=\"/$src\" class=\"lightbox\"><img src=\"/$src\" class=\"sImg\"/></a>"; 
		$outStr .= "<br />&nbsp;&nbsp;&nbsp;<a href=\"__APP__/Public/imgDown?f=$src\">下载</a>";
	}
	elseif($formType == 'uploadFile') {
		if(!$val) {
			$outStr = "未上传";
		} else {
			echo outUpFile($list[$show['fieldName']]);
		}
	}
	elseif($formType == 'upPics') {
		if(!$list[$show['fieldName']]) {
			echo "未上传";
		} else {
			echo outImgList($list[$show['fieldName']]);
		}
	}
	elseif($formType == 'city') {
		echo outCity($list[$show['fieldName']]);
	}
	else 
	{ 
		echo $list[$show['fieldName']];
	}	*/
}

function outUpFile($val)
{
	$fid = $val;
	
	$out .= "<div style=\"width:50px;\"><a href=\"__APP__/Public/fileDown?f=$fid\"><img src=\"/Public/images/download.png\" align=\"absmiddle\"> 下载</a></div>";
	return $out; 
}

function outFileDir($val)
{	
	$ImgID = $val;
	$out = "<div class=\"uploadFile\" style=\"width:80px;\">";
	$i = 0;
	$img = D("File") -> order("id desc") -> where("id in(" . $ImgID . ")") -> select();
	$countImg = count($img);
	
	for ($i = 0; $i < $countImg; $i++)
	{
		if ($i != 0) $style = "style=\"display:none\"";
		$out .= '<dl '.$style.'><dt><a href=\'' . $img[$i]['attachment'] . '\' rel="imgList"  class="lightbox"><img src=\'' . $img[$i]['attachment'] . '\' class="sImg"> </a></dt></dl>';
	}
						
	$out .= "</div>";
	return $out; 
}

//判断是否有下级分类
function isDownSort($cid)
{
	$Rs = D("Category") -> where('cid = '.$cid) -> find();
	
	if ( $Rs )
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
/*
 * 取类别ID及类别所有下级ID
 */
function getTreeIds($id)
{	
	$ids[] = $id;

	$Rs = D("Category") -> where('cid = "'.$id.'"') -> select();
	
	if( $Rs )
	{
		foreach($Rs as $key => $Cate)
		{
			if(!isDownSort($Cate['id']))
			{
				$ids[] = $Cate['id'];
			}
			else
			{ 
				$ids[] = getTreeIds($Cate['id']);
			}
		}
	}
	
	$cidstr = implode(',',$ids);
	
	return $cidstr;
}

//Get server name
function getServerById($server)
{
	$info = M("Server") -> where("id=".$server) -> find();
	return $info['name'];
}
//Get catagory name
function getCatagoryNameByCid($cid)
{
	$info = M("Category") -> where("id=".$cid) -> find();
	return $info['name'];
}
////add 20140828  删除旧图
function del_old_file($old_file)
{
	$b_file = ".".$old_file;
	$s_file = ".".str_replace("/Attachments/b/","/Attachments/s/",$old_file);
	
	if(file_exists($b_file))
	{
		unlink($b_file);
		M("File") -> where("attachment = '".$old_file."'") -> delete();
	}
	
	if(file_exists($s_file))
	{
		unlink($s_file);
	}
	
	return;
}
?>