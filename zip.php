<?PHP
        include_once('pclzip.lib.php');
		
		$handle = $_SERVER['DOCUMENT_ROOT'].'/';
		//echo $handle;
		
		set_time_limit(0);
		
		if($_GET['do'] == "zip")
		{
			$archive = new PclZip($_POST['zipname'].".zip");
			
			$filelist = '';
			foreach($_POST['actID'] as $k => $v)
			{
				if($k == 0)
				{
					$tag = '';
				}
				else
				{
					$tag = ',';
				}
				$filelist .= $tag.$handle.$v;
			}
			
        	$v_list = $archive->create($filelist);
        	if ($v_list == 0)
			{
            	die("Error : ".$archive->errorInfo(true));
        	}
			echo '<script>alert("压缩成功！");location="zip.php";</script>';
		}
        
		
		
		if($_GET['do'] == "unzip")
		{
			$archive = new PclZip($_POST['zipname'].'.zip');
			if ($archive->extract() == 0)
			{
				die("Error : ".$archive->errorInfo(true));
			}
			echo '<script>alert("解压成功！");location="zip.php";</script>';
		}
?>
<?
function dir_c($handle)
{
	$url=$handle;
	$html = '';
	if ($handle = opendir($handle) )
	{
		while (($file = readdir($handle))==true) 
		{
			if ($file != "." && $file != "..") 
			{
				$url_c=$url."/".$file ;
				$url_c=str_replace("///","/",$url_c);
				$url_c=str_replace("//","/",$url_c);
				$html .= '<tr overstyle="on" class="bg_on"><td><input type="checkbox" name="actID[]" id="actID[]" checked="checked" onclick="checkon(this)" value="'.$file.'"></td><td><a href='.$url_c.'>'.mb_convert_encoding($file, "UTF-8", "GBK").'</a></td></tr>';
				if(is_dir($url_c)==true)
				{
					dir_c($url_c);
				}
			}
		}
		closedir($handle);
	}
	
	return $html;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP在线压缩/解压</title>
<script type="text/javascript" src="jquery-1.7.min.js"></script>
</head>
<style>
.bg_on { background-color:#ECEFF4; }
.bg_hover { background-color:#F2F2F2; }
</style>
<script type="text/javascript" language="javascript">
////选择单个
function checkon(o)
{
	if( o.checked == true )
	{
		$(o).parents('tr').addClass('bg_on') ;
	}
	else
	{
		$(o).parents('tr').removeClass('bg_on') ;
	}
}
////选择多个   
function checkAll(o)
{
	if( o.checked == true )
	{
		$('input[type="checkbox"]').attr('checked','true');
		$('tr[overstyle="on"]').addClass("bg_on");
    }
	else
	{
		$('input[type="checkbox"]').removeAttr('checked');
		$('tr[overstyle="on"]').removeClass("bg_on");
    }
}
</script>
<body>
<form name="form1" method="post" action="zip.php?do=zip">
<table border="1" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="checkbox" id="checkbox_handle" checked="checked" onclick="checkAll(this)" value="0" /></td>
    <td>文件名称</td>
</tr>
<?php
echo dir_c($handle);
?>
</table>
压缩文件名：<input type="text" name="zipname" value="zip" />（不需写后缀，压缩文件后缀为zip）<br />
<input type="submit" value="压缩" />
</form>
<div align="center" style="margin-top:100px;">
<br /><br /><br />
<form method="post" action="zip.php?do=unzip">
压缩文件名：<input type="text" name="zipname" value="zip" />（不需写后缀，压缩文件后缀必须为zip，解压到当前文件夹）<br />
<input type="submit" value="解压" />
</form>
</div>
</body>
</html>