<?
#######################
### 按比例裁图片
#######################
function MakeThumbImages($srcFile,$destFile,$ImgWH=120,$ImgW="",$ImgH="",$Qtype=1,$ImgGD="GD2")
{
	$ImgInfo = @GetImageSize($srcFile);
	$srcWidth = $ImgInfo[0];
	$srcHeight = $ImgInfo[1];

	if($Qtype==1){
		if($ImgW!="") $ratio = min($srcWidth, $srcHeight) / max($ImgW,$ImgH);
		else $ratio = max($srcWidth, $srcHeight) / $ImgWH;

			$ratio = max($ratio, 1.0);
			$destWidth = (int)($srcWidth / $ratio);
			$destHeight = (int)($srcHeight / $ratio);

	}elseif($Qtype==2){
		$destWidth	= $ImgW;
		$destHeight = $ImgH;
	}

	switch ($ImgInfo[2]) {
		case 1:
			  $SrcImg = @ImageCreateFromGIF($srcFile);
		break;
		case 2:
			  $SrcImg = @imagecreatefromjpeg($srcFile);
		break;
		case 3:
			 $SrcImg = @ImageCreateFromPNG($srcFile);
        break;
  }

#### 使用图形组件版本 2.0以下
if ($ImgGD=="GD1"){
	$DstImg = @imagecreate($destWidth, $destHeight);
	@imagecopyresized($DstImg, $SrcImg, 0, 0, 0, 0, $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
	@imagejpeg($DstImg,$destFile,100);
	@imagedestroy($SrcImg);
	@imagedestroy($DstImg);
}

#### 使用图形组件版本 2.0以上
if ($ImgGD=="GD2"){
	$DstImg = @imagecreatetruecolor($destWidth, $destHeight);
	@imagecopyresampled($DstImg, $SrcImg, 0, 0, 0, 0, $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
	@imageJPEG($DstImg,$destFile,100);
}

}
?>