<? 
include("connect.php");
include("globals.php");
$tootab=$_GET["tootab"];

$count=$_GET['count'];
$count++;

$imgdir="media/temp";
$destdir="media/exp_pildid/"; 




//echo "<br> imgdir = ".$imgdir;
// pisipiltide mõõt ...
$vert=262;
$hor=300;
//echo $imgdir." ".$count."<br>";
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

$query="SELECT * FROM exp_pildid WHERE url='".urlencode($destdir."".$lst[$count])."'";
$result=mysql_query($query);
$line=mysql_fetch_array($result);

echo $query;


// kontrollime, et on ikka jpg, teistega ei tegele ...


$arr=explode(".", $image);
if($arr[1]=="jpg" or $arr[1]=="JPG" ) {$on_jpg=1;} else {$on_jpg=0;}
//echo $arr[1];
//echo $image,"    ", $arr[3],", kas jätkame: ", $on_jpg;			


if(!is_dir($image) && $on_jpg==1)
	{ 
//echo "uus pilt";			
	
//teeme veebifailid, ühe pisikese, teise suurema ...
				$image = sprintf("%s/%s", $imgdir ,urldecode($lst[$count]));
				$new_image = sprintf("%s%s", $destdir ,$line["oid"]."_".$line["id"].".jpg");
				$new_image_s = sprintf("%s%s", $destdir ,$line["oid"]."_".$line["id"]."s.jpg"); // name and location of generated thumbnail.
//				echo $new_image;
				
				$src_img = ImageCreateFromJPEG($image); // make 'connection' to image			
//				$src_img = imagerotate($src_img, 90, 0);
				$quality = 70; //quality of the .jpg
				$src_width = imagesx($src_img); // width original image
				$src_height = imagesy($src_img); // height original image

// pisipiltide mõõtmed
if($src_width > $src_height)
{
//thumbnail ...	landscape, kõrgus on teada		
				$dest_height = $vert; //max height of the thumbnail
				$dest_width = $hor; //width thumbnail (image will scale down completely to this width)
//weeb image ...				
				$ar = $src_width / $src_height; // aspect ratio
				$dest_width_s = 560; //width thumbnail (image will scale down completely to this width)
				$dest_height_s = $dest_width_s / $ar; //max height of the thumbnail
				$divX = ($src_width - $src_height)/2; // factor to calculate the scaled down height
				$divY=0;
//				echo "<br>", $divX;
}
else
{
//thumbnail ...	landscape, kõrgus on teada		
				$dest_height = $vert; //max height of the thumbnail
				$dest_width = $vert; //width thumbnail (image will scale down completely to this width)
//weeb image ...				
				$ar = $src_height / $src_width; // aspect ratio
				$dest_height_s = 560; //width thumbnail (image will scale down completely to this width)
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
//				echo "dsf",$new_image;// name and location of generated thumbnail.

?></span>
  <form name="muugi" action="import_pildid_thumbs_temp.php?tootab=1">
  <table border="0" width="600" style="padding: 0px; margin: 0px">
      <tr>
        <td class="menu" ><div align="left"><? echo " pildikataloog=",$imgdir;
  ?>
        </div></td>
        <td class="menu" >&nbsp;</td>
        <td class="menu" >&nbsp;</td>
        <td colspan="3" class="menu" >
        <? if($j2tka){

 echo "fail: ",$image; } else {echo "VALMIS!";}
 ?></td>
      </tr>
      <tr>
<? //echo "id=", $id;?>
        <td width="176" style="width: 7em; text-align: right">  <span class="menu">Objekti id:</span></td>

        <td width="1" style="width: 7em; text-align: right"><input type="text" name="id" class="fields" value="<? echo $id;?>" size="8"></td>
        <td width="58" style="width: 7em; text-align: right"><input type="text" name="count" class="fields" value="<? echo $count;?>" size="6"></td>
        <td width="59" style="width: 7em; text-align: right"><input type="text" name="domain" class="fields" value="<? echo $domain;?>" size="6"></td>
        <td width="176" style="width: 7em; text-align: right"><span class="menu">Mitmes:</span></td>
        <td width="233" style="width: 7em; text-align: right"><input type="submit" class="button" value="start"></td>
      </tr>
</table>
</form>
<? echo $new_image."<br>".$new_image_s;?>
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
//		echo $dirname.$file;
	}	
	closedir($handle);
	return $result_array;

}
?>