<link href="scat.css" rel="stylesheet" type="text/css" />
<br>
<?	$action=$_GET["action"];
	$sel=$_GET["sel"];
	$etendus_id=$_GET["etendus_id"];
	//--------------------------peaks individualiseerima
	if (!$etendus_id) $etendus_id=1;
	//--------------------------
	$ord=$_GET["ord"];
	if($ord==NULL) $ord="maakond";
	if($action=="del"){
		$fid=$_GET["fid"];
		$q="DELETE FROM kutse WHERE id= ".$fid." LIMIT 1";
		$r=mysql_query($q);
		$q="DELETE FROM kutse_kool WHERE oid1= ".$fid."";
		$r=mysql_query($q);
	}
//***protseduur Regio tabeli ja localhosti tabeli andmevahetuseks************************************************
/*	$query_asi="SELECT nimi,id,PK,email1, maakond, date, tyyp FROM kool WHERE nimi LIKE '%".$_POST["search_str"]."%'".$str1." ORDER BY ".$ord;
	$result_asi=mysql_query($query_asi);
	while($line_asi=mysql_fetch_array($result_asi))
	{
		$query_asi1="SELECT nimi,  PK, LK, kooli_tyyp FROM yldkoolid WHERE nimi='".$line_asi["nimi"]."'";
//	echo $query_asi1;
		$result_asi1=mysql_query($query_asi1);
		$line_asi1=mysql_fetch_array($result_asi1); 
		if($line_asi1["nimi"])
		{
		$query="UPDATE kool SET PK='".$line_asi1["PK"]."', LK='".$line_asi1["LK"]."', kooli_tyyp='".$line_asi1["kooli_tyyp"]."' WHERE nimi='".$line_asi1["nimi"]."'";
			echo $line_asi1["nimi"];
		}
		$result=mysql_query($query);

		//	echo $query;
	}

*///********************************************************************************************	
// kui ei ole tehtud valikut staatuse  järgi .. 
	if($sel==NULL) $sel=0;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="9" class="pealkiri">TODO, <? 	
switch ($etendus_id)
	{
	case 1: echo "FÜÜSIKA etendus"; break;
	case 2: echo "KEEMIA etendus"; break;
	case 4: echo "ROBOOTIKA etendus"; break;
	case 5: echo "MATERJALIDE etendus"; break;
	case 3: echo "VALGUSE etendus"; break;
	}
	
	 ?>, veebist, t&ouml;&ouml;tlemata <span class="smallbody">(on vaja l&auml;bi vaadata ja koolide/asutustega seostada)</span> </td>
  </tr>
  <tr> 
    <td class="menu">&nbsp;</td>
    <td width="34%" nowrap class="menu"><a href="index.php?page=kool_table&ord=nimi&sel=<? echo $sel?>">nimi</a></td>
    <td width="20%" nowrap class="menu"><div align="left">sisestaja</div></td>
    <td nowrap class="menu"><div align="left">tel</div></td>
    <td nowrap class="menu"><div align="center">seonduv exp </div></td>
    <td nowrap class="menu"><div align="center">seonduv seade </div></td>
    <td nowrap class="menu"><div align="center"><a href="index.php?page=kool_table&ord=date&sel=<? echo $sel?>"> reg.kuup</a></div></td>
    <td class="menu" valign="middle">&nbsp;</td>
    <td nowrap class="menu"><div align="right">M</div></td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="10" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <?
	$query="SELECT * FROM kutse WHERE nimi LIKE '%".$_POST["search_str"]."%'"." AND etendus_id=".$etendus_id." ORDER BY nimi";
//	echo $query;
	$result=mysql_query($query);
	$count=1;
//WHILE ALGAB--------------------------------------------------------------------------------------------------------------------------
	while($line=mysql_fetch_array($result)){
			// kui on tehtud valik saatude järele ...
			$state = 0;
			//... siis uurime, kas kutse on juba  määratud ...
				$query1="SELECT id,oid1 FROM kutse_kool WHERE oid1=".$line["id"];
			//	echo $query1;
				$result1=mysql_query($query1);
				$line1=mysql_fetch_array($result1);		
				if($line1==NULL)
				{
					$state=1;
				} // end of 
				else
				{
					$state=2; 
				} // end of else
// Näitame vaid määramata kutseid ...
if($state==1)
{
 ?>
  <tr> 
    <td align="center" valign="middle" class="smallbody" width="3%"> 
      <? echo $count,". ";?>    </td>
    <td nowrap class="menu"><? echo $line["nimi"];
?></td>
    <td nowrap class="menu"><a href="mailto:<? echo $line["email1"];?>"><? echo $line["email1"];
?></a></td>
    <td  width="6%" nowrap class="menu"> 
<? echo $line["tel1"];
?> </td>
    <td  width="8%" nowrap class="menu"><input type="button" name="suva1" class="button" value="M&auml;&auml;ra" onclick="window.open('addvalue_iid.php?domain=kutse_kool&oid=<? echo $line["id"];?>&sel=1&etendus_id=<? echo $etendus_id;?>','File_upload','toolbar=0,width=660,height=580,status=yes');" ></td>
    <td  width="8%" nowrap class="menu"><input class="button" type="button" name="Submit3" value="Lisa uus" onClick="document.location.href='index.php?page=kool_disp&action=new&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>&kutse_id=<? echo $line["id"]; ?>&etendus_id=<? echo  $etendus_id;?>'"></td>
    <td  width="12%" class="menu" nowrap> <div align="center"><? echo $line["date"]; ?>
   </div></td>
    <td width="5%" valign="middle"  class="smallbody"> 
      <div align="center">
        <? if($priv>=2) {?>
        <a href="index.php?page=masin_table&action=del&fid=<? echo $line["id"]; ?>&etendus_id=<? echo $etendus_id; ?>" class="menu_punane">x</a> 
        <? } ?>    
    </div></td>
    <td width="4%" align="right" nowrap class="smallbody"> 
      <?  if($line["maksab"]==1)
	  { echo "jah";}  else {echo "ei";}?>    </td>
  </tr>
<tr>
  <td colspan="10" class="smallbody"><strong>Sisestatud lisainfo :</strong> <? echo $line["markused"];
?></td>
</tr>  <? $count++;
	}
}
?>
</table>
<? 

				switch($sel){
				case 0: $url_t="image/eesti_asjas.jpg"; break;
				case 1: $url_t="image/eesti_ootel.jpg"; break;
				case 2: $url_t="image/eesti_toos.jpg"; break;
				case 3: $url_t="image/eesti_olemas.jpg"; break;
				case 5: $url_t="image/eesti_globe.jpg"; break;
				default: $url_t="image/eesti_asjas.jpg"; break;
				}
				$url = "image/eesti.jpg"; // name/location of original image.
				
				$src_img = ImageCreateFromJPEG($url); // make 'connection' to image
				
				$quality = 100; //quality of the .jpg
				$src_width = imagesx($src_img); // width original image
				$src_height = imagesy($src_img); // height original image
				
				$dest_img = imagecreatetruecolor($src_width,$src_height); 
				imagecopyresampled($dest_img, $src_img, 0, 0, 0 ,0, $src_width, $src_height, $src_width, $src_height); 

				// allocate some solors
				$white    = imagecolorallocate($dest_img, 0xFF, 0xFF, 0xFF);
				$gray     = imagecolorallocate($dest_img, 0xC0, 0xC0, 0xC0);
				$darkgray = imagecolorallocate($dest_img, 0x90, 0x90, 0x90);
				$navy     = imagecolorallocate($dest_img, 0x00, 0x00, 0x80);
				$green     = imagecolorallocate($dest_img, 0x00, 0x80, 0x00);
				$darknavy = imagecolorallocate($dest_img, 0x00, 0x00, 0x50);
				$red      = imagecolorallocate($dest_img, 0xFF, 0x00, 0x00);
				$darkred  = imagecolorallocate($dest_img, 0x90, 0x00, 0x00);
				
				
//				echo $linek["oid2"],"oa";
				$resultkoo=mysql_query("SELECT id, on_globe, PK, LK FROM kool");
			while($linekoo=mysql_fetch_array($resultkoo))
			{

//				echo $linekoo["PK"],"   ";
			  	$x=($linekoo["PK"]-373877)*($src_width/(745237-373877));
			  	$y=$src_height - ($linekoo["LK"]-6345722)*($src_height/(6648619-6345722));
//				echo $x," ",$y;
// kas seal on käidud?

				$query1="SELECT id,oid1 FROM reis_kool WHERE oid2=".$linekoo["id"];
				$result1=mysql_query($query1);
				$line1=mysql_fetch_array($result1);		
				if($line1){$color = $green;} else {$color = $red;}
				switch($sel){
				case 0: 			imagefilledarc($dest_img, $x, $y, 10, 10, 0, 360, $color, IMG_ARC_PIE); // kõik
									imageellipse($dest_img, $x, $y, 10, 10, $white);
									break;
				case 1:  if(!$line1){							// ootel
									imagefilledarc($dest_img, $x, $y, 10, 10, 0, 360, $color, IMG_ARC_PIE);
									imageellipse($dest_img, $x, $y, 10, 10, $white);
									} break;
				case 2: if($line1){$color = $green;} break;
				case 3: if($line1){							// ootel
									imagefilledarc($dest_img, $x, $y, 10, 10, 0, 360, $color, IMG_ARC_PIE);
									imageellipse($dest_img, $x, $y, 10, 10, $white);
									} break;
				case 5: if($linekoo["on_globe"]==1){$color = $green;							// on globe
									imagefilledarc($dest_img, $x, $y, 10, 10, 0, 360, $color, IMG_ARC_PIE);
									imageellipse($dest_img, $x, $y, 10, 10, $white);
									} break;
				default: 			imagefilledarc($dest_img, $x, $y, 10, 10, 0, 360, $color, IMG_ARC_PIE); // kõik
									imageellipse($dest_img, $x, $y, 10, 10, $white);
									break;
				}
				
}
//			imagerotate($dest_img, 90, 0);
			imagejpeg($dest_img, $url_t, $quality); 
			imagedestroy($src_img); 
			imagedestroy($dest_img);
			  
			  
			  


?>
