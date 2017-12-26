<link href="scat.css" rel="stylesheet" type="text/css" />
<? 	
	mb_internal_encoding('UTF-8');
?>
<?
//SQL rida ...
//mysql_query("UPDATE exp SET jarjest=jarjest-380;");

// otsing stringi jarele ...
		$str='';
// kui on tehtud valik staatuse j'rgi .. 

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="0%" align="center">&nbsp;</td>
    <td width="90%" align="center" class="navi"> <img src="image/spacer.gif" width="10" height="5"><span class="menu"><a href="index.php?page=exp_table&ord=nimi_est&kat=<? echo $kat;?>">Nimi</a></span></td>
    <?	$expid = $line["id"];
if($veeb == "tee" && $exp == $expid)
	{
		$dom1="exp_pildid";	
		$query1="SELECT id,url FROM ".$dom1." WHERE oid=".$expid;
		echo $query1;
		$result1=mysql_query($query1);
	while($line=mysql_fetch_array($result1))
	{
		$str = urldecode($line["url"]);
		$idpic = $line["id"];
// lõikan maha faililaiendi ja kirjutan pildi kujul id.laiend kataloogi mis all näha ...
		$arr = split( '[.]',$str, 2);
if($arr[1] == "jpg"){
//teeme veebifailid, ühe pisikese, teise suurema ..
		$arr1 = split( '[/]',$arr[0], 3);
		$url="media/exp_pildid_veeb/x".$arr1[2].".".$arr[1];
//				echo "kaido", $url;
		$url_s="media/exp_pildid_veeb/x".$arr1[2]."s.".$arr[1];
		$image = $str; // name/location of original image.
		$new_image = $url; // name/location of generated thumbnail.
		$new_image_s = $url_s; // name/location of generated thumbnail.
		
		$src_img = ImageCreateFromJPEG($image); // make 'connection' to image
		
		$quality = 40; //quality of the .jpg
		$src_width = imagesx($src_img); // width original image
		$src_height = imagesy($src_img); // height original image
		
//thumbnail ...				
		$dest_height = 50; //max height of the thumbnail
		$ar = $src_width / $src_height; // aspect ratio
		$dest_width = $dest_height * $ar; //width thumbnail (image will scale down completely to this width)
//weeb image ...				
		$dest_height_s = 400; //max height of the thumbnail
		$dest_width_s = $dest_height_s * $ar; //width thumbnail (image will scale down completely to this width)
		
//				$divX = $src_width / $dest_width; // factor to calculate the scaled down height
						
		$dest_img = imagecreatetruecolor($dest_width,$dest_height); 
		$dest_img_s = imagecreatetruecolor($dest_width_s,$dest_height_s); 
		imagecopyresampled($dest_img, $src_img, 0, 0, 0 ,0, $dest_width, $dest_height, $src_width, $src_height); 
		imagecopyresampled($dest_img_s, $src_img, 0, 0, 0 ,0, $dest_width_s, $dest_height_s, $src_width, $src_height); 
		imagejpeg($dest_img, $new_image, $quality); 
		imagejpeg($dest_img_s, $new_image_s, $quality); 
		imagedestroy($src_img); 
		imagedestroy($dest_img);
		imagedestroy($dest_img_s);
		
		
// kirjutan andmebaasi vastava kirje ... pildi url/i				
//				echo $query;				
	}		}
	}
?>
   </tr><?

	while($line=mysql_fetch_array($result))
	{
			// loeme kokku vastava id/ga vestluste kirjed exp_vestlus andmebaasis ...
					$query="SELECT COUNT( * ) FROM exparendus WHERE oid=".$line["id"]." ";
					$result1=mysql_query($query);
					$count=mysql_fetch_array($result1);
			//		echo $count[0];
					?>
			
  <tr> 
    <td background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
    <td valign="top"><img border=0 src="image/index_41.gif" width=19 height=19 alt="">    </td>
    <td valign="top" class="menu"><a href="index.php?page=exp_disp&expid=<? echo $line["id"]; ?>" target="_blank"><? echo $line["nimi_est"];?> 
      </a>(<a href="exp_print.php?domain=exp&id=<? echo $line["id"];?>" target="_blank">*</a>)<span class="navi"><br><? echo $line["kirjeldus_est"]; ?></span></td>
    <?	$expid = $line["id"];
if($veeb == "tee" && $exp == $expid)
	{
		$dom1="exp_pildid";	
		$query1="SELECT id,url FROM ".$dom1." WHERE oid=".$expid;
		echo $query1;
		$result1=mysql_query($query1);
	while($line=mysql_fetch_array($result1))
	{
		$str = urldecode($line["url"]);
		$idpic = $line["id"];
// lõikan maha faililaiendi ja kirjutan pildi kujul id.laiend kataloogi mis all näha ...
		$arr = split( '[.]',$str, 2);
if($arr[1] == "jpg"){
//teeme veebifailid, ühe pisikese, teise suurema ..
		$arr1 = split( '[/]',$arr[0], 3);
		$url="media/exp_pildid_veeb/x".$arr1[2].".".$arr[1];
//				echo "kaido", $url;
		$url_s="media/exp_pildid_veeb/x".$arr1[2]."s.".$arr[1];
		$image = $str; // name/location of original image.
		$new_image = $url; // name/location of generated thumbnail.
		$new_image_s = $url_s; // name/location of generated thumbnail.
		
		$src_img = ImageCreateFromJPEG($image); // make 'connection' to image
		
		$quality = 40; //quality of the .jpg
		$src_width = imagesx($src_img); // width original image
		$src_height = imagesy($src_img); // height original image
		
//thumbnail ...				
		$dest_height = 50; //max height of the thumbnail
		$ar = $src_width / $src_height; // aspect ratio
		$dest_width = $dest_height * $ar; //width thumbnail (image will scale down completely to this width)
//weeb image ...				
		$dest_height_s = 400; //max height of the thumbnail
		$dest_width_s = $dest_height_s * $ar; //width thumbnail (image will scale down completely to this width)
		
//				$divX = $src_width / $dest_width; // factor to calculate the scaled down height
						
		$dest_img = imagecreatetruecolor($dest_width,$dest_height); 
		$dest_img_s = imagecreatetruecolor($dest_width_s,$dest_height_s); 
		imagecopyresampled($dest_img, $src_img, 0, 0, 0 ,0, $dest_width, $dest_height, $src_width, $src_height); 
		imagecopyresampled($dest_img_s, $src_img, 0, 0, 0 ,0, $dest_width_s, $dest_height_s, $src_width, $src_height); 
		imagejpeg($dest_img, $new_image, $quality); 
		imagejpeg($dest_img_s, $new_image_s, $quality); 
		imagedestroy($src_img); 
		imagedestroy($dest_img);
		imagedestroy($dest_img_s);
		
		
// kirjutan andmebaasi vastava kirje ... pildi url/i				
//				echo $query;				
	}		}
	}
?>
   </tr>
<?
$counter++;
}	// ------------- peagrupi exponaat -----------
?>
</table>
