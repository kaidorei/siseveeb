<? 
include("connect.php");
include("globals.php");

//echo $_POST["submit_value"];

$eh="save";
$id=590;
$domain="exp";

$query="SELECT galerii FROM ".$domain." WHERE id=".$id;
$result=mysql_query($query);
$line=mysql_fetch_array($result);
 
switch($domain)
{
case 'exp': $imgdir="../pildid/Image/Tootuba/".$line["galerii"]."/thumbs/"; $imgdir_s="../pildid/Image/Tootuba/".$line["galerii"]."/thumbs_s/"; $misasjale="töötoale"; break;
case 'reis': $imgdir="../pildid/Image/Teadusbuss/".$line["galerii"]."/thumbs/"; $imgdir_s="../pildid/Image/Teadusbuss/".$line["galerii"]."/thumbs_s/"; $misasjale="reisile"; break;
default: $imgdir="../pildid/Image/Teadusbuss/".$line["galerii"]."/thumbs/"; $imgdir_s="../pildid/Image/Teadusbuss/".$line["galerii"]."/thumbs_s/"; $misasjale="reisile"; break;
}


$lst=list_dir($imgdir);
sort($lst);

if($eh == "save" )
{
//	echo "Salvesta!!!! </br>";
	// salvestame kogu lehe ...
// Loeme andmebaasist sellele id-le vastavad failid ning teeme nendest tabeli	
	$result_pilt=mysql_query("SELECT * FROM pildid_allkirjad WHERE domain='".$domain."' AND oid='".$id."' ORDER BY ord" );
//	echo "SELECT * FROM pildid_allkirjad WHERE domain='".$domain."' AND oid='".$id."' ORDER BY ´ord´";
	while($line_pilt=mysql_fetch_array($result_pilt))
	{
	// leiame pildi nimele vastava id ...
//			echo "pildi id=",$line_pilt["id"],"; ";
			$query_update = "UPDATE `pildid_allkirjad` SET `ord` = '".$_POST["ord_".$line_pilt["id"]]."', `url_kataloog` = '".$imgdir."',`pealkiri` = '".$_POST["pealkiri_".$line_pilt["id"]]."', `allkiri` = '".$_POST["allkiri_".$line_pilt["id"]]."', `show_image` = '".$_POST["show_image_".$line_pilt["id"]]."' WHERE `id` =".$line_pilt["id"]." LIMIT 1";
			echo $line_pilt["fail"]," keerake CW";
			// File and rotation
			$filename = $imgdir."".$line_pilt["fail"] ;
			echo $filename;
			$degrees = 90;
//				header('Content-type: image/jpeg');
			$source = imagecreatefromjpeg($filename);
			$rotate = imagerotate($source, $degrees, 0);
			imagejpeg($rotate, $filename); 
			
			if($_POST["CCW_".$line_pilt["id"]])
			{
				echo $line_pilt["fail"]," keerake CCW";
			}
			if($_POST["180_".$line_pilt["id"]])
			{
				echo $line_pilt["fail"]," keerake 180";
			}
		$result_update=mysql_query($query_update);
//		$line_update=mysql_fetch_array($result_update);
	}
	
}


// kontrollime, kas sellisele pildinimele vastab kirje tabelis "pildid_allkirjad" ...
foreach($lst as $img)
{

//	echo "SELECT * FROM pildid_allkirjad WHERE fail='".$img."' AND oid='".$id."'";
	$result_pilt=mysql_query("SELECT * FROM pildid_allkirjad WHERE fail='".$img."' AND oid='".$id."'" );
	if(!mysql_fetch_array($result_pilt))
	{ // pole allkirja, lisame kirje ...
		$query_insert="INSERT INTO `pildid_allkirjad` ( `id` ,`oid`, `ord` , `domain` , `url_kataloog` , `fail` , `pealkiri` , `allkiri`, `show_image` ) 
VALUES (NULL , '".$id."','".$count."','".$domain."', '".$imgdir."', '".$img."', '', '', '1')"; 
	$result_insert=mysql_query($query_insert);
//		$line_insert=mysql_fetch_array($result_insert);
	$count=$count+20;
	}
	else
	{
	}
}


?>
<html>
<link href="scat.css" rel="stylesheet" type="text/css">
<head>
 <title>galerii</title>
</head>

<body>

<span class="pealkiri">Galerii <? echo $misasjale," ",$id;?> </span>
<form name="form1" method="post" action="<? echo $PHP_SELF."?action=save&domain=".$domain."&id=".$id.""; ?>">

  <table bord="0" cellpadding="0" cellspacing="0" width="800" align="center" >
    <tbody>
      <tr>
        <td colspan="9" class="menu">		<? echo $line["galerii"]; ?></td>
 </tr>
<?

//		$lst=list_dir($imgdir);
//		sort($lst);
	$count=100;
	
// Loeme andmebaasist sellele id-le vastavad failid ning teeme nendest tabeli	
	$result_pilt=mysql_query("SELECT * FROM pildid_allkirjad WHERE domain='".$domain."' AND oid='".$id."' ORDER BY ord" );
//	echo "SELECT * FROM pildid_allkirjad WHERE domain='".$domain."' AND oid='".$id."' ORDER BY ´ord´";
	while($line_pilt=mysql_fetch_array($result_pilt))
	{
?>         <tr> 
          <td colspan="9" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
     <tr>
        <td width="4%" rowspan="7" valign="top" class="menu">
          <a href="<? echo $imgdir_s,$img; ?>"><img src="<? echo $line_pilt["url_kataloog"],$line_pilt["fail"]; ?>" border="0" bord="0"></a>          </td>
        <td width="1%" rowspan="7" valign="top" class="menu"><img src="image/spacer.gif" alt="xcv" width="5"></td>
        <td colspan="4" class="menu">Pealkiri (kui on vaja panna):</td>
        <td width="40%" rowspan="7" valign="top" class="menu">Allkiri: </br>
        <textarea name="allkiri_<? echo $line_pilt["id"];?>" cols="60" rows="5" class="fields"><? echo $line_pilt["allkiri"];?></textarea></td>
        <td width="18%" colspan="2" rowspan="5" valign="top" class="menu"><div align="right">
          <input name="submit_value" type="submit" class="button" value="Salvesta">
          </div></td>
     </tr>
     <tr> 
          <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
     <tr>
       <td colspan="4" class="menu">
         <div align="center">
           <input name="pealkiri_<? echo $line_pilt["id"];?>" type="text" class="fields" value="<? echo $line_pilt["pealkiri"];?>" size="40">
          </div></td>
     </tr>
     <tr> 
          <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
     <tr>
       <td colspan="4" class="menu"><div align="left"></div></td>
      </tr>
      <tr>
        <td width="9%" valign="middle" class="menu"><div align="right" class="options">
          <div align="left"><strong>Order:</strong>&nbsp; </div>
        </div></td>
        <td width="9%" align="right" valign="middle" class="menu"><input name="ord_<? echo $line_pilt["id"];?>" type="text" class="fields" value="<? echo $line_pilt["ord"];?>" size="5"></td>
        <td width="10%" valign="middle" class="menu">
          <div align="left" class="options">:90CCW</div></td>
        <td width="9%" align="right" valign="middle" class="menu"><input type="checkbox" name="CCW_<? echo $line_pilt["id"];?>2" value="1" ></td>
        <td width="18%" align="right" rowspan="2" valign="middle" class="options"><span class="options">Show image </span></td>
        <td width="9%" rowspan="2" align="right" valign="middle" class="menu"><input type="checkbox" name="show_image_<? echo $line_pilt["id"];?>" value="1" <? if($line_pilt["show_image"]) echo "checked"; ?>></td>
      </tr>
      <tr>
        <td valign="middle" class="menu"><span class="options">180</span></td>
        <td align="right" valign="top" class="menu"><input type="checkbox" name="180_<? echo $line_pilt["id"];?>" value="1"></td>
        <td valign="middle" class="options"><span class="options">90CW </span></td>
        <td align="right" valign="middle" class="menu"><span class="options">
          <input type="checkbox" name="CW_<? echo $line_pilt["id"];?>" value="1">
        </span></td>
      </tr>
<? //		echo $img;
	}?>              <tr background="image/sinine.gif"> 
          <td colspan="9" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
</table>
</form>
</body>
</html>
<?

/********* FUNCTIONNS *****************************************/

function list_dir($dirname)
{
	static $result_array=array();  
	$handle=opendir($dirname);
//	echo  $handle;
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