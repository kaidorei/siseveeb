<? 
include("connect.php");
include("globals.php");
$domain=$_GET["domain"];
$id=$_GET["id"];
$tootab=$_GET["tootab"];

$count=$_GET['count'];
$count++; echo "kaido",$count;

$query="SELECT galerii FROM ".$domain." WHERE id=".$id;
//echo $query;
$result=mysql_query($query);
$line=mysql_fetch_array($result); 
switch($domain)
{
case 'exp': $imgdir="../pildid/Image/Tootuba/".$line["galerii"]; break;
case 'reis': $imgdir="../pildid/Image/Teadusbuss/".$line["galerii"]; break;
default: $imgdir="../pildid/Image/Teadusbuss/".$line["galerii"]; break;
}
//echo "<br> imgdir = ".$imgdir;
// pisipiltide m��t ...
$vert=100;
?>

<script>
function proovi_veel() {
  vorm = document.forms ['muugi'];
  vorm.submit();
}
</script>
<html>
<link href="scat.css" rel="stylesheet" type="text/css">
<body>
  <!--- new stuff --->
  <span style="width: 7em; text-align: left">
  <?
  
//Teeme uued kataloogid ...
$thumbdir=$imgdir."/thumbs";
$thumbdir_s=$imgdir."/thumbs_s";
//echo "<br>",$thumbdir;

if(!is_dir($thumbdir) or !is_dir($thumbdir_s))
{
	mkdir ( $thumbdir); 
	mkdir ( $thumbdir_s);
}

chmod($thumbdir, 0777);
chmod($thumbdir_s, 0777);

/*if ($handle = opendir($imgdir)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            echo "$file\n";
        }
    }
    closedir($handle);
}
*/

$lst=list_dir($imgdir);

if(!$lst[$count]) {$j2tka=0; } else {$j2tka=1;}
//echo $imgdir,"<br>";
//echo $count, " pilt: ", $lst[$count];
$image = sprintf("%s/%s", $imgdir ,urldecode($lst[$count]));


// kontrollime, et on ikka jpg, teistega ei tegele ...

$arr = split( '[.]',$image, 4);
if($arr[3]=="jpg" or $arr[3]=="JPG" ) {$on_jpg=1;} else {$on_jpg=0;}
//echo $image,"    ", $arr[3],", kas j�tkame: ", $on_jpg;			


if(!is_dir($image) && $on_jpg==1)
	{ 
//echo "uus pilt";			
	
//teeme veebifailid, �he pisikese, teise suurema ...
				$image = sprintf("%s/%s", $imgdir ,urldecode($lst[$count]));
				$new_image = sprintf("%s/thumbs/%s", $imgdir ,urldecode($lst[$count]));// name and location of generated thumbnail.
				$new_image_s = sprintf("%s/thumbs_s/%s", $imgdir ,urldecode($lst[$count])); // name and location of generated thumbnail.
//				echo $new_image;
				
				$src_img = ImageCreateFromJPEG($image); // make 'connection' to image			
//				$src_img = imagerotate($src_img, 90, 0);
				$quality = 100; //quality of the .jpg
				$src_width = imagesx($src_img); // width original image
				$src_height = imagesy($src_img); // height original image

// pisipiltide m��tmed
if($src_width > $src_height)
{
//thumbnail ...	landscape, k�rgus on teada		
				$dest_height = $vert; //max height of the thumbnail
				$dest_width = $vert; //width thumbnail (image will scale down completely to this width)
//weeb image ...				
				$ar = $src_width / $src_height; // aspect ratio
				$dest_width_s = 520; //width thumbnail (image will scale down completely to this width)
				$dest_height_s = $dest_width_s / $ar; //max height of the thumbnail
				$divX = ($src_width - $src_height)/2; // factor to calculate the scaled down height
				$divY=0;
//				echo "<br>", $divX;
}
else
{
//thumbnail ...	landscape, k�rgus on teada		
				$dest_height = $vert; //max height of the thumbnail
				$dest_width = $vert; //width thumbnail (image will scale down completely to this width)
//weeb image ...				
				$ar = $src_height / $src_width; // aspect ratio
				$dest_height_s = 520; //width thumbnail (image will scale down completely to this width)
				$dest_width_s = $dest_height_s / $ar; //max height of the thumbnail
				$divX = 0; // factor to calculate the scaled down height
				$divY = ($src_height - $src_width)/2; // factor to calculate the scaled down height
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

} // end of IF, kui on kataloog

?></span>
  <form name="muugi" action="galerii_thumbs.php?id=<? echo $id;?>&domain=<? echo $domain;?>&tootab=1">
  <table border="0" width="100%" style="padding: 0px; margin: 0px">
      <tr>
        <td colspan="5" class="menu" ><div align="left"><? echo "Objekti id=",$id, ", pildikataloog=",$imgdir;
  ?>
        </div></td>
        <td class="menu_punane" width="233">
		<? if($j2tka){

 echo "fail: ",$lst[$count]; } else {echo "VALMIS!";}
 ?></td>
      </tr>
      <tr>
<? //echo "id=", $id;?>
        <td width="176" style="width: 7em; text-align: right">  <span class="menu">Objekti id:</span></td>

        <td width="176" style="width: 7em; text-align: right"><input type="text" name="id" class="fields" value="<? echo $id;?>" size="8"></td>
        <td width="58" style="width: 7em; text-align: right"><input type="text" name="count" class="fields" value="<? echo $count;?>" size="6"></td>
        <td width="59" style="width: 7em; text-align: right"><input type="text" name="domain" class="fields" value="<? echo $domain;?>" size="6"></td>
        <td width="176" style="width: 7em; text-align: right"><span class="menu">Mitmes:</span></td>
        <td style="width: 7em; text-align: right"><input type="submit" class="button" value="start"></td>
      </tr>
</table>
</form>
<script>
<?PHP 
if ($j2tka) echo "proovi_veel()";?>
</script>
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
		echo $dirname.$file;
	}	
	closedir($handle);
	return $result_array;

}
?>