<?php
/*
*****
***** 处理表单
*****
*/
class doAction
{
	////字段ID
	private $fieldID;
	////表单返回数组
	private $reArr = array();
	
	public function __construct($gid)
	{
		if($gid) $this -> fieldID = $gid;
	}
	
	public function getInfo()
	{
		$fieldArr = explode("||",$this -> fieldID);
		$nums = count($fieldArr);
		for($i=0; $i<$nums; $i++)
		{
			$FRs = D("Field") -> find($fieldArr[$i]); 
			if($FRs["formType"] == "checkbox" or $FRs["formType"] == "filedir")
			{
				$reArr[$FRs["fieldName"]] = implode(",",$_POST[$FRs["fieldName"]]);
				
				if($FRs["formType"] == "filedir")
				{
					for($ww = 0;$ww < count($_POST[$FRs["fieldName"]]);$ww++)
					{
						M("File") -> where("id=".$_POST[$FRs["fieldName"]][$ww]) -> setField('displayorder',$_POST['displayorder'][$ww]);
					}
				}
			}
			elseif($FRs["formType"] == "city")
			{
				$province = $_POST[$FRs["fieldName"]];
				$city = $_POST["".$FRs["fieldName"]."_city"];
				$town = $_POST["".$FRs["fieldName"]."_town"];
				$area = array("province"=>$province, "city"=>$city, "town"=>$town);
				$reArr[$FRs["fieldName"]] = serialize($area);
			}
			elseif($FRs["formType"] == "file")
			{
				if($_FILES[$FRs["fieldName"]]["name"])
				{
					$info = $this->_upload($FRs["fieldName"]);
					$reArr[$FRs["fieldName"]] = $info;
				}
				else
				{
					$reArr[$FRs["fieldName"]] = $_POST["old_".$FRs["fieldName"]];
				}
			}
			else
			{
				$reArr[$FRs["fieldName"]] = $_POST[$FRs["fieldName"]];
			}
		}
		
		return $reArr;
	}
	
	public function _upload($names,$width='150',$height='150'){
		//检查文件合法性
		$sys = M('Settings') -> find();
		$name = $names == ""? 'attachment':$names;
		
		$pic_width  = $sys['pic_width'] == "" ? $width : $sys['pic_width'];
		$pic_height = $sys['pic_height'] == "" ? $height : $sys['pic_height'];
		
		$maxSize=$sys['attachsize'];
		$allowExts=explode(',',strtolower($sys['attachext']));
		
		$pathinfo = pathinfo($_FILES[$name]["name"]);
        $fileInfo = $pathinfo['extension'];
		
		if(!in_array(strtolower($fileInfo),$allowExts))
		{
			$this->error ='上传文件类型不允许';
		}
		if($_FILES[$name]["size"] > $maxSize)
		{
			$this->error = '上传文件大小不符！';
		}	
		
		$path = $_SERVER['DOCUMENT_ROOT'] ."/Attachments";
		require_once("Images_function.inc.php");
		
		mkdir($path.'/b/'.date("Ymd"));
		mkdir($path.'/s/'.date("Ymd"));
		
		$FileName  = time().randstr(10).".".$fileInfo;
		
		$bFileName = '/Attachments/b/'.date("Ymd").'/'.$FileName;
		$sFileName = '/Attachments/s/'.date("Ymd").'/'.$FileName;
		
		if(move_uploaded_file($_FILES[$name]['tmp_name'],".".$bFileName))
		{
			$old_file = $_POST['old_'.$name];
			
			del_old_file($old_file);

			MakeThumbImages(".".$bFileName,".".$sFileName,"120",$pic_width,$pic_height,2);
			
			if ($sys['iswater'] == "开启")
			{
				require_once ("MaskImages.inc.php");
				imageWaterMark($bFileName, waterMarkPos($sys['marklocation']), $_SERVER['DOCUMENT_ROOT'] .$sys['maskimg']);
				imageWaterMark($sFileName, waterMarkPos($sys['marklocation']), $_SERVER['DOCUMENT_ROOT'] .$sys['maskimg']);
			}
			
			$this -> savetofile($bFileName , $pathinfo['basename']);
		}
		return $bFileName;
	}
	
	
	public function savetofile($src , $name = '') 
	{
		$str = randstr(5, 'NUMBER');
		$File = M("File");
		$File -> postdate = time();
		$File -> attachment = $src;
		$File -> name = $name;
		$File -> add();	
	}
}
?>