<link href="scat.css" rel="stylesheet" type="text/css" />

<br>

<?			include("globals.php");
	require_once 'header.php';

$all=$_GET["all"];

$etendus_id=$_GET["etendus_id"];

echo $etendus_id;

if(!$all) $all=0;



$action=$_GET["action"];

	$sel=$_GET["sel"];

	$etendus_id=$_GET["etendus_id"];

	//--------------------------peaks individualiseerima

	//if (!$etendus_id) $etendus_id=1;

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

    <td colspan="9" class="pealkiri">Kutsed, veebist <span class="smallbody">(on vaja l&auml;bi vaadata ning koolide/asutustega ja reisidega seostada)</span> </td>

  </tr>

  <tr> 

    <td class="menu">&nbsp;</td>

    <td width="17%" nowrap class="menu"><a href="index.php?page=kool_table&ord=nimi&sel=<? echo $sel?>">Kutsuja</a></td>

    <td width="17%" nowrap class="menu">Etendus</td>

    <td width="19%" nowrap class="menu"><div align="left">kutsuja e-mail</div></td>

    <td nowrap class="menu"><div align="left">tel</div></td>

    <td nowrap class="menu"><div align="center">Kool</div></td>

    <td nowrap class="menu"><div align="center"><a href="index.php?page=kool_table&ord=date&sel=<? echo $sel?>"> reg.kuup</a></div></td>

    <td class="menu" valign="middle">&nbsp;</td>

    <td nowrap class="menu"><div align="right">M</div></td>

  </tr>

  <tr background="image/sinine.gif"> 

    <td colspan="10" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>

  <?

	$query="SELECT * FROM kutse WHERE nimi LIKE '%".$_POST["search_str"]."%'"." ORDER BY id DESC LIMIT 150";

//	echo $query;

	$result=mysql_query($query);

	$count=1;

//WHILE ALGAB--------------------------------------------------------------------------------------------------------------------------

$koolid_kaardile = array();

	while($line=mysql_fetch_array($result)){

			//... siis uurime, kas kutse on juba  määratud kooli juurde ...

				$query1="SELECT * FROM kutse_kool WHERE oid1=".$line["id"];

			//	echo $query1;

				$result1=mysql_query($query1);

				$line1=mysql_fetch_array($result1);		

				if($line1)

				{

					$query55="SELECT * FROM kool WHERE id=".$line1["oid2"];

					//echo $query55;

					$result55=mysql_query($query55);

					$line_kool=mysql_fetch_array($result55);		

					$kutse_kool=$line_kool["nimi"]; 

					$kool_id=$line_kool["id"];

				} 

				else

				{

					$kutse_kool=NULL; 

				}// end of else

				

			//... siis uurime, kas kutse on juba  reisi juurde määratud ...

				$query1="SELECT * FROM kutse_reis WHERE oid1=".$line["id"];

			//	echo $query1;

				$result1=mysql_query($query1);

				$line1=mysql_fetch_array($result1);		

				if($line1)

				{

					$query55="SELECT * FROM reis WHERE id=".$line1["oid2"];

					//echo $query55;

					$result55=mysql_query($query55);

					$line55=mysql_fetch_array($result55);

					

					

					

$algus=$line55['algus'];

$kuu=substr($algus,5,2);

$paeva=substr($algus,8,2);

$kuua = kuud($kuu, $keel);			

$lopp=$line55['lopp'];

$aasta=substr($lopp,0,4);

$kuu=substr($lopp,5,2);

$paevl=substr($lopp,8,2);

$kuul = kuud($kuu, $keel);

if($kuua == $kuul&&$paeva!=$paevl)	

	$reisiaeg=$paeva.". - ".$paevl.". ".$kuul.' '.$aasta;

if($kuua == $kuul&&$paeva==$paevl)

	$reisiaeg=$paeva.'. '.$kuua.' '.$aasta;

if($kuua != $kuul&&$paeva!=$paevl)	

	$reisiaeg=$paeva.". ".$kuua.' - '.$paevl.". ".$kuul.' '.$aasta;

$asi3=$line55["nimi"]." ".$reisiaeg;					

					

						

					$kutse_reis=$asi3; 

					$reis_id=$line55["id"];

				} 

				else

				{

					$kutse_reis=NULL; 

				}// end of else



// kui otsitakse mingi etenduse järgi, siis uurime, kas konkreetne kutse on sellele etendusele.

if($etendus_id)

//echo "on etendus";

{

			$query_et="SELECT * FROM kutse_etendus WHERE oid1=".$line["id"]." AND oid2=".$etendus_id;

	//		echo $query_et;

			$result_et=mysql_query($query_et);

			$line_et=mysql_fetch_array($result_et);		

			

}

			

if($etendus_id)

{

	if($line_et)

	{

	$naita=1;

	}

	else

	{

	$naita=0;

	}

}

else

{

//	echo "ahhoi";

	// Näitame vaid määramata kutseid ...

	if($all==1 or $kutse_reis==NULL)

	{

	$naita=1;

	}

	else

	{

	$naita=0;

	}

	if($line["etendus_id"]==38)

	{

	$naita=0;

	}



}				



//echo "Näita: ".$naita;		

if($naita)

{

	

// Lisame kooli kaardile joonistatavate koolide seltskonda ...	

array_push($koolid_kaardile, $line_kool);

	

 ?>

  <tr> 

    <td align="center" valign="middle" class="smallbody" width="2%"> 

        <a href="http://www.fyysika.ee/omad/index.php?page=masin_disp&kid=<? echo $line["id"];?>" class="smallbody" target="_blank"><? echo $count,". ";?></a></td>

    <td nowrap class="menu"><? echo $line["nimi"];

?></td><?





	$querywr="SELECT * FROM etendus WHERE id =".$line["etendus_id"];

//	echo $query;

	$etenduseasi=mysql_fetch_array(mysql_query($querywr));



?>

    <td nowrap class="menu"><? echo $etenduseasi["nimi_est_lyhike"];?></td>

    <td nowrap class="menu"><a href="mailto:<? echo $line["email1"];?>"><? echo $line["email1"];

?></a></td>

    <td  width="7%" nowrap class="menu"> 

<? echo $line["tel1"];

?> </td>

    <td nowrap bgcolor="#FFFF00" class="menu"><? if($kutse_kool==NULL) {?>

    <input type="button" name="suva1" class="button" value="Otsi andmebaasist" onclick="window.open('addvalue_iid.php?domain=kutse_kool&oid=<? echo $line["id"];?>&sel=1&etendus_id=<? echo $etendus_id;?>','File_upload','toolbar=0,width=660,height=580,status=yes');" />      <input class="button" type="button" name="Submit3" value="Uus kool" onClick="document.location.href='index.php?page=kool_disp&action=new&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>&kutse_id=<? echo $line["id"]; ?>&etendus_id=<? echo  $etendus_id;?>'"> <? } else { ?> <a href="http://www.fyysika.ee/omad/index.php?page=kool_disp&fid=<? echo $kool_id?>"><? echo $kutse_kool; ?> </a> <? }?></td>

    <td  width="11%" class="menu" nowrap> <div align="center"><? echo $line["date"]; ?>

    </div></td>

    <td width="4%" valign="middle"  class="smallbody"> 

      <div align="center">

        <? if($priv>=2) {?>

        <a href="index.php?page=masin_table&action=del&fid=<? echo $line["id"]; ?>&etendus_id=<? echo $etendus_id; ?>" class="menu_punane">x</a> 

        <? } ?>    

    </div></td>

    <td width="3%" align="right" nowrap class="smallbody"> 

      <?  if($line["maksab"]==1)

	  { echo "jah";}  else {echo "ei";}?>    </td>

  </tr>

<tr>

  <td colspan="5" valign="top" class="smallbody"><? echo $line["markused"];?><?php /*?><strong><input type="button" name="suva1" class="button" value="Sisestatud lisainfo" onclick="window.open('masin_disp_print.php?kutse_id=<? echo $line["id"];?>','File_upload','toolbar=0,width=660,height=580,status=yes');" ></strong><?php */?></td>

  <td valign="top" bgcolor="#33FF99" class="options"><? if($kutse_reis==NULL) {?>

    <input type="button" name="suva1" class="button" value="Vali" onclick="window.open('addvalue_iid.php?domain=kutse_reis&oid=<? echo $line["id"];?>&sel=1&etendus_id=<? echo $etendus_id;?>','File_upload','toolbar=0,width=660,height=580,status=yes');" />      <input class="button" type="button" name="Submit3" value="Uus reis" onClick="document.location.href='index.php?page=reis_disp&action=new&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>&kutse_id=<? echo $line["id"]; ?>&etendus_id=<? echo  $etendus_id;?>'"> <? } else {?> <a href="http://www.fyysika.ee/omad/index.php?page=reis_disp&reisid=<? echo $reis_id?>"><? echo $kutse_reis; ?> </a> <? }?></td>

  <td class="smallbody">&nbsp;</td>

  <td class="smallbody">&nbsp;</td>

  <td class="smallbody">&nbsp;</td>

  <td rowspan="2" class="smallbody">&nbsp;</td>

</tr>

<tr>

  <td colspan="9" class="smallbody"><hr></td>

  </tr>  

<? $count++;

	}

}

?>

</table><? 

/*

				switch($sel){

					case 0: $url_t="image/eesti_asjas.jpg"; break;

					case 1: $url_t="image/eesti_ootel.jpg"; break;

					case 2: $url_t="image/eesti_toos.jpg"; break;

					case 3: $url_t="image/eesti_olemas.jpg"; break;

					case 5: $url_t="image/eesti_globe.jpg"; break;

					default: $url_t="image/eesti_asjas.jpg"; break;

				}

*/				$url_t="image/eesti_kutsed.jpg";

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

				

$i=0;

while($i < count($koolid_kaardile))

			{

//echo $koolid_kaardile[$i]["nimi"],$i;

//				echo $linekoo["PK"],"   ";

			  	$x=($koolid_kaardile[$i]["PK"]-373877)*($src_width/(745237-373877));

			  	$y=$src_height - ($koolid_kaardile[$i]["LK"]-6345722)*($src_height/(6648619-6345722));

//				echo $x," ",$y;

// kas seal on käidud?



				$query1="SELECT id,oid1 FROM reis_kool WHERE oid2=".$koolid_kaardile[$i]["id"];

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

$i++;				

}

//			imagerotate($dest_img, 90, 0);

			imagejpeg($dest_img, $url_t, $quality); 

			imagedestroy($src_img); 

			imagedestroy($dest_img);

			  

			  

			  





?>

<div align="center">

  <p><img src="<? echo $url_t;?>" alt="koolikaart" /></p>

</div>



