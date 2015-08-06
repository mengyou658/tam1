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
					$reArr[$FRs["fieldName"]] = substr($info[0]['savepath'],1) . $info[0]['savename'];
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
	
	
	////处理图片上传
	public function _upload() 
	{
		$maxSize = intval(C(ATTACHSIZE)) == "" ? 1024*1024*2 : intval(C(ATTACHSIZE));
		$defaultExt = array('jpg', 'gif', 'png', 'jpeg');
		$allowExt = C(ATTACHEXT) == "" ?  $defaultExt : explode("," , C(ATTACHEXT));
		$updir_b = $_SERVER['DOCUMENT_ROOT'] ."/Attachments/b/".date("Ymd")."/";
		$updir_s = $_SERVER['DOCUMENT_ROOT'] ."/Attachments/s/".date("Ymd")."/";
		
		@mkdir(str_replace('//','/',$updir_b), 0755, true);
		@mkdir(str_replace('//','/',$updir_s), 0755, true);
		
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();
		$upload -> maxSize  = $maxSize ;
		$upload -> allowExts  = $allowExt;
		$upload -> savePath =  "./Attachments/b/".date("Ymd")."/";
		$upload -> thumb = true;
		$upload -> thumbPrefix = '';
		$upload -> thumbMaxWidth = 150;
		$upload -> thumbMaxHeight = 150;
		$upload -> thumbPath = $updir_s;
		
		if(!$upload->upload())
		{
			//echo  $upload->getErrorMsg();
		}
		else
		{
			$info = $upload->getUploadFileInfo();
			$src = substr($info[0]['savepath'],1) . $info[0]['savename'];
			$name = $info[0]['name'];
			$this -> savetofile($src , $name);
			return $info;
		}
	}
	
	public function savetofile($src , $name) 
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