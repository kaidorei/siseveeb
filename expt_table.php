<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<br>
<? 
	$action=$_GET["action"];
	$klass=$_GET["klass"];
	$sel=$_GET["sel"];
	$kat=$_GET["kat"];
	$veeb=$_GET["veeb"]; // parameeter k'eseb allpool konverteerida teatud sorts pilte veebiformaati

	$up1=$_GET["up1"];
	$up2=$_GET["up2"];

	$pw=$_GET["pw"];

//SQL rida ...
//mysql_query("UPDATE exp SET jarjest=jarjest-380;");


	if($action=="del")
	{
		$expid=$_GET["expid"];
		$mediadirs=array("exp_pildid","exp_doclist","exp_kasutusjuhend","exp_skeem");
		foreach($mediadirs as $tmp)
		{
			$dd="media/".$tmp;
			$q="SELECT url FROM ".$tmp." WHERE oid=".$expid;
//			echo $q;
			$r=mysql_query($q);
			while($line=mysql_fetch_array($r)){
				unlink(urldecode($line["url"]));  
				}	
		}				
		$tables=array('exp_lingid','exp_analoogid');
		
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$expid;
			$r=mysql_query($q);
		}

		$tables=array('exp_naitused','exp_jnaitused','exparendus','exp_doclist','exp_pildid','exp_kasutusjuhend','exp_mudel','exp_naitused','exp_skeem','exp_vestlus');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE expid=".$expid;
			$r=mysql_query($q);
		}

		$q="DELETE FROM exp WHERE id=".$expid;
		$r=mysql_query($q);
	}

// otsing stringi jarele ...
		$str='';
// kui on tehtud valik staatuse j'rgi .. 
	if($sel!=NULL) 
	{
		$str1 = " AND staatus_id =".$sel;
//	echo $str1;
	}
	else
	{	
		$str1='';
	}
// kui on tehtud valik demolisuse j'rgi .. 
	if($kat!=NULL) 
	{
		$str2 = " AND gpid_demo =".$kat;
	}
	else
	{	
		$str2='';
	}
	$query="SELECT nimi_est,nimi_eng,id,staatus_id,lupdate,veeb_pilt_url,veeb_pilt_url_s, naita_veebis, veeb_ok FROM exp WHERE nimi_est LIKE '%".$_POST["search_str"]."%'".$str." ".$str1." ".$str2." AND on_tootuba=1 ORDER BY nimi_est";
//	echo $query;
	$result=mysql_query($query);
	include("globals.php");

	$id_prev=0;
	$counter = 1;
?>
			
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr> 
    <td width="1%" valign="middle">&nbsp;</td>
    <td width="1%" align="center" valign="middle" class="menu">k</td>
    <td width="1%" valign="middle" class="menu"><img src="image/spacer.gif" width="10" height="5"></td>
    <td width="3%" valign="middle" class="menu">wok</td>
    <td width="3%" align="center" valign="middle" class="menu">w1</td>
    <td width="2%" valign="middle" class="menu"></td>
    <td width="78%" valign="middle" nowrap class="menu">nimi</td>
    <td width="3%" valign="middle" class="menu"  >pilt</td>
    <td width="2%" valign="middle"> </td>
    <td width="6%" valign="middle" nowrap class="smallbody"> </td>
  </tr>
  <?
  
  	while($line=mysql_fetch_array($result))
	{
			// loeme kokku vastava id/ga vestluste kirjed exp_vestlus andmebaasis ...
					$query="SELECT COUNT( * ) FROM exparendus WHERE oid=".$line["id"]." ";
					$result1=mysql_query($query);
					$count=mysql_fetch_array($result1);
				//	echo $count[0];
					
  
  ?>
 <tr> 
    <td colspan="10" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
    <td width="1%"><img border=0 src="image/index_41.gif" width=19 height=19 alt="" /></td>
    <td width="1%" align="center" class="navi"><? echo $count[0]; ?></td>
    <td width="1%" align="center" class="navi">&nbsp;</td>
    <td width="3%" align="center" class="navi"><span class="style1"><?
/* // kontrollime, milliste kategooriate hulgas on selle asja kohta seosed juba loodud ...
//teadus:
				$query62="SELECT oid1 FROM pacs_exp WHERE oid2=".$line["id"];
				$result62=mysql_query($query62);
				if(mysql_fetch_array($result62))
				{
					echo "f";
				}
//tehnoloogia:
				$query63="SELECT oid1 FROM tehno_exp WHERE oid2=".$line["id"];
				$result63=mysql_query($query63);
				if(mysql_fetch_array($result63))
				{
					echo "t";
				}
//kool:
				$query64="SELECT oid1 FROM aine_exp WHERE oid2=".$line["id"];
				$result64=mysql_query($query64);
				if(mysql_fetch_array($result64))
				{
					echo "k";
				} */
echo $line["veeb_ok"];
 ?>
      </span></td>
    <td width="3%" align="center" class="navi"><? echo $line["naita_veebis"]; ?></td>
    <td width="2%" class="navi"> <img src="image/spacer.gif" width="10" height="5">-</td>
    <td width="78%" nowrap class="menu"><a href="index.php?page=exp_disp&expid=<? echo $line["id"]; ?>&pw=<? echo $pw; ?>"><? echo $line["nimi_est"];?> 
      (<? echo $line["nimi_eng"];?>)</a></td>
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
    <td width="3%"  > <? if($line["veeb_pilt_url"]) {?><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" width="40" /><? } else { ?><img src="../images/spacer.gif"  width="40"/><? }?></td>
    <td width="2%" valign="middle"> 
      <? if($priv>=2) {?>
      <a href="index.php?page=<? echo $dom."_table"; ?>&sel=<? echo $sel; ?>&veeb=tee&exp=<? echo $expid; ?>"><img src="image/index_39.gif" border="0"  align="middle"></a> 
      <? } ?>    </td>
    <td width="6%" nowrap class="smallbody"> 
      <? if($priv>=2) {?>
      <div align="right"><a href="index.php?page=exp_table&action=del&expid=<? echo $line["id"]; ?>">kustuta</a> 
        <?		
	$id_prev = $line["id"];
		 } ?>
      </div></td>
  </tr>
<?
$counter++;
}
	// ------------- peagrupi exponaat -----------
?>
</table>

