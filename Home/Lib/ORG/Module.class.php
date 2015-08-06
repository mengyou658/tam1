<?php
/*
*****
***** 生成表单
*****
*/
class Module {
	////模版记录
	private $mRs = array();
	
	private $groupID = array();
	
	private $groupName = array();
	
	private $fieldID = array();
	
	private $fieldName = array();
	
	private $fTitle = array();
	
	private $isVal = false;
	
	////构造传递要操作的模版 && 数据值
	public function __construct($mRs,$val = "")
	{
		$this -> mRs = $mRs;
		if($val)
		{
			$this -> isVal = true;
			$this -> vo = $val;
		}
		$this -> parse($mRs);
	}
	
	/*
		预处理模版
	*/
	public function parse($mRs)
	{
		
		$this -> groupID = explode("||",$this -> mRs['groupID']);
		$this -> groupName = explode("||",$this -> mRs['groupName']);
		$this -> fieldID = explode("||",$this -> mRs['fieldID']);
		$this -> fieldTitle = explode("||",$this -> mRs['fieldTitle']);
		
		
		for($i=0;$i<count($this -> fieldID);$i++)
		{
			$this -> fTitle[$this -> fieldID[$i]] = $this -> fieldTitle[$i];
		}
	}
	
	/*
		返回模版表单
	*/
	public function show()
	{
		$groupRs = $this -> getInfo($this -> groupID);		
		return $groupRs;
	}
	
	
	/*
		取表单记录
	*/
	public function getInfo($GroupID)
	{
		$groupRs = array();
		
		foreach($GroupID as $k => $v)
		{
			$groupRs[$k] = array( "id" => $this->groupID[$k], "name" => $this->groupName[$k] );
			
			$DRs = M("Field") -> where("groupID='".$v."' and id in (".implode("," , $this -> fieldID).")") -> order("sort desc ,id asc")-> select(); 
			
			$fNum = count($DRs);
			
			for($j=0; $j<$fNum; $j++)
			{
				if($DRs[$j]["topic"])$topic[$j] = "<font class=\"tips\">".$DRs[$j]["topic"]."</font>";
				else $topic[$j]="";
				
				if($this -> isVal) $DRs[$j]["fieldValue"] = $this -> vo[$DRs[$j]["fieldName"]];
				
				if($DRs[$j]["iswrite"] == "1")
				{
					$DRs[$j]["iswrite" ]	= '<font style="color:#ff3300">*</font> ';
					$DRs[$j]["erro"]	 	= $DRs[$j]["name"].' 为必填项';
					$DRs[$j]["jscript"]		= ' check="^\S+"';
					$DRs[$j]["check"]		= $DRs[$j]["jscript"].' warning="'.$DRs[$j]["erro"].'"';
				}
				else $DRs[$j]["iswrite"] = "";
				
				$DRs[$j]["nameStr"] = $DRs[$j]["iswrite"].$this -> fTitle[$DRs[$j]["id"]].'：';
					
				switch($DRs[$j]["formType"])
				{
					case "select":
						$DRs[$j]["fieldSelect"] = explode(',',$DRs[$j]["fieldSelect"]);
						$DRs[$j]["FieldNameStr"] = '<select name="'.$DRs[$j]["fieldName"].'" '.$DRs[$j]["check"].'>'.chr(10).chr(13);
						$DRs[$j]["FieldNameStr"] .= '<option value="">请选择'.$DRs[$j]["Name"].'</option>'.chr(10).chr(13);
						foreach($DRs[$j]["fieldSelect"] as $select)
						{
							$selected="";
							if($select == $DRs[$j]["fieldValue"]) $selected=" selected ";
							$DRs[$j]["FieldNameStr"] .= '<option value="'.$select.'" '.$selected.'>'.$select.'</option>'.chr(10).chr(13);
						}
						$DRs[$j]["FieldNameStr"] .= '</select>'.$topic[$j].'';
						
					break;
					case "upfile":
					$DRs[$j]["FieldNameStr"] = '<div class="upload_btn-group"><input name="upfile_'.$DRs[$j]["fieldName"].'" type="file" id="upfile_'.$DRs[$j]["fieldName"].'" /></div><div class="bigfileQueue" id="fileQueue_'.$DRs[$j]["fieldName"].'"></div><div class="showupfile" name="info_'.$DRs[$j]["fieldName"].'" id="info_'.$DRs[$j]["fieldName"].'">已上传文件：<input type="text" class="txt" name="'.$DRs[$j]["fieldName"].'" id="'.$DRs[$j]["fieldName"].'" value="'.$DRs[$j]["fieldValue"].'"/>';
					if($DRs[$j]["fieldValue"])
					{
						$DRs[$j]["FieldNameStr"] .= "<span id=\"uped_".$DRs[$j]["fieldValue"]."\"><input class=\"btn_b\" type=\"button\" value=\" 查看已上传 \" onclick=\"window.open('__APP__/Public/download?fid=".$DRs[$j]["fieldValue"]."')\"><input class=\"btn_b\" type=\"button\" value=\" 删 除 \" onclick=\"clearHtml('".$DRs[$j]["fieldName"]."');\"></span>";
					}
					$DRs[$j]["FieldNameStr"] .= "</div>";
					$DRs[$j]["FieldNameStr"] .= "<script type=\"text/javascript\">
									$(document).ready(function() {
										$(\"#upfile_".$DRs[$j]["fieldName"]."\").uploadify({
											'uploader'       : '__PUBLIC__/admin/js/JqueryUpload/uploadify.swf',
											'script'		 : '__APP__/Public/upbigfile',
											'cancelImg'      : '__PUBLIC__/admin/js/JqueryUpload/cancel.png',
											'folder'         : \"__ROOT__/Attachments/upload/".date('Ymd')."/\",
											'buttonImg' 	 : '".__PUBLIC__."/admin/images/upload.png',
											'queueID'        : 'fileQueue_".$DRs[$j]["fieldName"]."',
											'auto'           : true,
											'multi'          : false,
											'onComplete':function(event,queueId,fileObj,response,data){
												$(\"#".$DRs[$j]["fieldName"]."\").val(response); 
											}
										});
									});
									</script>";
					break;					
					case "filedir":
					$DRs[$j]["FieldNameStr"] = '<div class="upload_btn-group" ><input name="up_'.$DRs[$j]["fieldName"].'" type="file" id="up_'.$DRs[$j]["fieldName"].'" /></div><div class="picQueue" id="picQueue_'.$DRs[$j]["fieldName"].'"></div><div id="uppic_'.$DRs[$j]["fieldName"].'" class="outser">';
					if($DRs[$j]["fieldValue"])
					{
						$ImgID = $DRs[$j]["fieldValue"];
						$ImgHtml = "";
						$i = 0;
						$img = D("File") -> order("id desc") -> where("id in(" . $ImgID . ")") -> select();
						$countImg = count($img);
						for ($i = 0; $i < $countImg; $i++) {
							$sn = "";
							$sn = time() . $i;
							$ImgHtml .= '<dl id=\'' . $sn . '\'><dt><input type=\'hidden\' name=\''.$DRs[$j]["fieldName"].'[]\' value=\'' . $img[$i]['id'] . '\'><a href=\'' . $img[$i]['attachment'] . '\' rel=\'rel_'.$DRs[$j]["fieldName"].'\' class=\'lightbox\'><img src=\'' . $img[$i]['attachment'] . '\' class=\'sImg\'></a></dt><dd><a href=\'javascript:MoveHtml(' . $sn . ')\'>删除 <img src=\'__PUBLIC__/admin/images/del.gif\' align=\'absbottom\'></a></dd></dl>';
						}
			
						$DRs[$j]["FieldNameStr"] .= $ImgHtml;
					}
					$DRs[$j]["FieldNameStr"] .= "</div>";
					$DRs[$j]["FieldNameStr"] .= "<script type=\"text/javascript\">
									$(document).ready(function() {
										$(\"#up_".$DRs[$j]["fieldName"]."\").uploadify({
											'uploader'       : '__PUBLIC__/admin/js/JqueryUpload/uploadify.swf',
											'script'		 : '__APP__/Public/upPics',
											'scriptData'	 : {'field':'".$DRs[$j]["fieldName"]."'},
											'method'		 : 'GET',
											'queueID' 		 : 'uppic_".$DRs[$j]["fieldName"]."',		
											'cancelImg'      : '__PUBLIC__/admin/js/JqueryUpload/cancel.png',
											'folder'         : \"__ROOT__/Attachments/upload/".date('Ymd')."/\",
											'buttonImg' 	 : '".__PUBLIC__."/admin/images/browser.png',
											'queueID'        : 'picQueue_".$DRs[$j]["fieldName"]."',
											'fileExt' 		 : '*.jpg;*.gif;*.bmp;*.png',
											'fileDesc' 		 : '*.jpg;*.gif;*.bmp;*.png',
											'auto'           : true,
											'sizeLimit'      : '134217728',
											'multi'          : true,
											'onComplete':function(event,queueId,fileObj,response,data){
												$(\"#uppic_".$DRs[$j]["fieldName"]."\").prepend(response); 
											}
										});
									});
									</script>";
					break;					
					case "checkbox":
						$DRs[$j]["fieldSelect"] = explode(',',$DRs[$j]["fieldSelect"]);
						$DRs[$j]["fieldValue"]  = explode(',',$DRs[$j]["fieldValue"]);
						foreach($DRs[$j]["fieldSelect"] as $select)
						{
							$selected = "";
							if(in_array($select,$DRs[$j]["fieldValue"])) $selected = " checked ";
							$DRs[$j]["FieldNameStr"] .= '<input type="checkbox" name="'.$DRs[$j]["fieldName"].'[]" value="'.$select.'" '.$selected.$DRs[$j]["check"].'>'.$select;
						}
					break;
					case "radio":
						$DRs[$j]["fieldSelect"] = @explode(',',$DRs[$j]["fieldSelect"]);
						foreach($DRs[$j]["fieldSelect"] as $select)
						{
							$selected = "";
							if($select == $DRs[$j]["fieldValue"]) $selected = " checked ";
							$DRs[$j]["FieldNameStr"] .= '<input type="radio" name="'.$DRs[$j]["fieldName"].'" value="'.$select.'" '.$selected.$DRs[$j]["check"].'>'.$select;
						}
					break;
					case "file":
						$DRs[$j]["FieldNameStr"] = '<input type="file" name="'.$DRs[$j]["fieldName"].'" size="20"> '.$topic[$j].'';
						if($DRs[$j]["fieldValue"] != "") 
						{
							$DRs[$j]["FieldNameStr"] .= '<div id="'.$DRs[$j]["fieldName"].'_Html"><input type="hidden" name="old_'.$DRs[$j]["fieldName"].'" value="'.$DRs[$j]["fieldValue"].'" /><a href="'.$DRs[$j]["fieldValue"].'" class="lightbox"><img src="'.$DRs[$j]["fieldValue"].'" class="sImg"></a>&nbsp;&nbsp;<input type="button" class="btn_b" name="dels" value=" 删除图片 " onclick="MoveHtml(\''.$DRs[$j]["fieldName"].'_Html\');"></div>';
						}
					break;					
					case "date":
						$DRs[$j]["FieldNameStr"] = '<input readonly="readonly"
 type="text" id="'.$DRs[$j]["fieldName"].'" name="'.$DRs[$j]["fieldName"].'" value="'.$DRs[$j]["fieldValue"].'" '.$DRs[$j]["check"].'>'.$topic[$j].'';
 						$DRs[$j]["FieldNameStr"] .= '<script type="text/javascript">
														RANGE_CAL_1 = new Calendar({
															inputField: "'.$DRs[$j]["fieldName"].'",
															dateFormat: "%Y-%m-%d",
															trigger: "'.$DRs[$j]["fieldName"].'",
															bottomBar: false,
															onSelect: function() {
																  this.hide();
															 }
														});
													</script>';
					break;
					case "textarea":
						$DRs[$j]["FieldNameStr"] = '<textarea name="'.$DRs[$j]["fieldName"].'" class="t_area">'.$DRs[$j]["fieldValue"].'</textarea> '.$topic[$j].'';
					break;
					case "editor":
						$DRs[$j]["FieldNameStr"] = create_html_editor($DRs[$j]["fieldName"],$DRs[$j]["fieldValue"],'920','350').' '.$topic[$j].'';
					break;
					case "city":
						$DRs[$j]["FieldNameStr"] = chinaCity($DRs[$j]["fieldName"],$DRs[$j]["fieldValue"]);
					break;
					case "password":
						$DRs[$j]["FieldNameStr"] = '<input type="password" name="'.$DRs[$j]["fieldName"].'" value="'.$DRs[$j]["fieldValue"].'" size="30" maxlength="'.$DRs[$j]["len"].'" '.$DRs[$j]["check"].'> '.$topic[$j].'';
					break;
					default:
						$DRs[$j]["FieldNameStr"] = '<input type="text" name="'.$DRs[$j]["fieldName"].'" value="'.$DRs[$j]["fieldValue"].'" class="txt" '.$DRs[$j]["check"].'> '.$topic[$j].'';
					break;
				}
			}
			$groupRs[$k]["DRs"] = $DRs;		
		}
		return $groupRs;
	}
}
?>