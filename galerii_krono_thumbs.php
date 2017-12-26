<? 
include("connect.php");
include("globals.php");
$kid=$_GET["kid"];

$_POST['kid'];
$kid++;

echo "Mitmes: ",$kid;

$query="SELECT url, oid FROM krono_pildid WHERE id=".$kid;
$result=mysql_query($query);
$line=mysql_fetch_array($result); 
echo "</br> pildi nimi: ", urldecode($line["url"]);
$imgdir="../omad/krono_pildid/";

//-----------------------------------
$vert=100;
//-----------------------------------
?>

<script>
function proovi_veel(kid) {
  vorm = document.forms ['muugi'];
  vorm.kid.value=kid;
  vorm.submit();
}
</script>


<html>
<body>
<!--- new stuff --->
  <table border="0" width="100%" style="padding: 0px; margin: 0px">
      <tr>
        <td >
		<?
if($line["oid"])
{
// lõikan maha faililaiendi ja kirjutan pildi kujul id.laiend kataloogi mis all näha ...
	$arr = split( '[.]',$line["url"], 2);

//teeme veebifailid, ühe pisikese, teise suurema ...
	$url="media/krono_pildid/".$line["oid"].".".$arr[1];
	$url_s="media/krono_pildid/".$line["oid"]."s.".$arr[1];
	$image = urldecode($line["url"]); // name/location of original image.
	$new_image = $url; // name/location of generated thumbnail.
	$new_image_s = $url_s; // name/location of generated thumbnail.
	$src_img = ImageCreateFromJPEG($image); // make 'connection' to image			
	$quality = 100; //quality of the .jpg
	$src_width = imagesx($src_img); // width original image
	$src_height = imagesy($src_img); // height original image
echo "</br> Siht: ", $url, "; k*l= ", $src_height, ", ", $src_width;

// pisipiltide mõõtmed
if($src_width > $src_height)
{
//thumbnail ...	landscape, kõrgus on teada		
	$dest_height = $vert; //max height of the thumbnail
	$dest_width = $vert; //width thumbnail (image will scale down completely to this width)
//weeb image ...				
	$ar = $src_width / $src_height; // aspect ratio
	$dest_width_s = 520; //width thumbnail (image will scale down completely to this width)
	$dest_height_s = $dest_width_s / $ar; //max height of the thumbnail
	$divX = ($src_width - $src_height)/2; // factor to calculate the scaled down height
	$divY=0;
	echo "</br>divX= ", $divX;
}
else
{
//thumbnail ...	landscape, kõrgus on teada		
	$dest_height = $vert; //max height of the thumbnail
	$dest_width = $vert; //width thumbnail (image will scale down completely to this width)
//weeb image ...				
	$ar = $src_width / $src_height; // aspect ratio
	$dest_width_s = 400; //width thumbnail (image will scale down completely to this width)
	$dest_height_s = $dest_width_s / $ar; //max height of the thumbnail
//	$divX = $src_width / $dest_width; // factor to calculate the scaled down height
	$divY = ($src_height - $src_width)/2; // factor to calculate the scaled down height
	$divX=0;
	echo "</br>divY= ", $divY;
}
				
					
	$dest_img = imagecreatetruecolor($dest_width,$dest_height); 
	$dest_img_s = imagecreatetruecolor($dest_width_s,$dest_height_s); 
	
	imagecopyresampled($dest_img, $src_img, 0, 0, $divX ,$divY, $dest_width, $dest_height, $src_width-2*$divX, $src_height-2*$divY); 
	imagecopyresampled($dest_img_s, $src_img, 0, 0, 0 ,0, $dest_width_s, $dest_height_s, $src_width, $src_height); 

	imagejpeg($dest_img, $new_image, $quality); 
	imagejpeg($dest_img_s, $new_image_s, $quality); 
	imagedestroy($src_img); 
	imagedestroy($dest_img);
	imagedestroy($dest_img_s);
// kirjutan andmebaasi vastava kirje ... pildi url/i				
/*	$query="UPDATE krono SET veeb_pilt_url='".urlencode($url)."' WHERE id=".$line["oid"];
	echo $query;
	$result=mysql_query($query);
	$query="UPDATE krono SET veeb_pilt_url_s='".urlencode($url_s)."' WHERE id=".$line["oid"];
	$result=mysql_query($query);
	echo $query;				
	$tehtud=1;
*/
?> </tr>
</table>



<form name="muugi" action="galerii_krono_thumbs.php?kid=<? echo $kid;?>">
  kid
<input type="text" name="kid" value="">
<input type="submit" value="Lammuta!!">
</form>

<script>
<?PHP if($line["oid"])
 echo "proovi_veel(".$kid.")";?>
</script>
<?php }?>
</body>
</html>

<?

/********* FUNCTIONNS *****************************************/

function list_dir($dirname)
{
	static $result_array=array();  
	$handle=opendir($dirname);
	while ($file = readdir($handle))
	{
		if($file=='.'||$file=='..')
			continue;
		if(is_dir($dirname.$file))
			list_dir($dirname.$file.'\\'); 
		else
			$result_array[]=$file;
	}	
	closedir($handle);
	return $result_array;

}
?>