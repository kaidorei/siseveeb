<?

		include("connect.php");

//		include("authsys.php");	

//		if($loginform==1) { echo "Sorry. Permission denied!";}

//		else {

			$oid=$_GET["oid"];					//objekti id

			$dom=$_GET["domain"];				//mis pildiga on tegu	

			$vert=$_GET["vert"]; 				//pöidlapildi kõrgus

			$vert_s=$_GET["vert_s"]; 

			$hor=$_GET["hor"];					//pöidlapildi laius

			$hor_s=$_GET["hor_s"];					

			

			$id_pilt=$_GET["id_pilt"];			//pildi id tabelis ..._pildid

			$mis_nurk=$_POST["radiobutton"];	//kui ei mahu ära, siis kustpoolt trimmitakse

			$pane_pildiks=$_POST["pane_pildiks"];	//kas teen veebipildiks?

			echo "Kas?:",$pane_pildiks;

			if (!$mis_nurk) $mis_nurk=5;

			$kylg=$_POST["kylg"];	//kui ei mahu ära, siis kustpoolt trimmitakse

			if (!$kylg) $kylg=1;

			

			

			$t_height = $_POST["t_height"];

			$t_width = $_POST["t_width"];

			if (!$t_height) $t_height=$vert;

			if (!$t_width) $t_width=$hor;



			$suurendus = $_POST["suurendus"];

			if (!$suurendus) $suurendus=1;

			$t_height_s = round($t_height * 3.125,0);

			$t_width_s = round($t_width * 3.125,0);

			$arr_dom = explode( "_",$dom);



		  ?> <p class="Pealkiri">Sea veebipilt</p>

		  <?

		  	$tehtud=0;	

			$query="SELECT url FROM ".$dom." WHERE id=".$id_pilt;

//			echo $query;

//			echo $expid;

			$result=mysql_query($query);

			$line=mysql_fetch_array($result); 

			

			$str = urldecode($line["url"]);

			$image = $str; 					// name/location of original image.

			

// lõikan maha faililaiendi ja kirjutan pildi kujul id.laiend kataloogi mis all näha ...

			$arr = split( '[.]',$str, 2);

//echo $arr[1];			

if($arr[1]!="svg")

{

			

//teeme veebifailid, ühe pisikese, teise suurema ...

			$url="media/".$arr_dom[0]."_pildid/".$oid."_".$id_pilt.".jpg";

			$url_s="media/".$arr_dom[0]."_pildid/".$oid."_".$id_pilt."s.jpg";

			$url_png="media/".$arr_dom[0]."_pildid/".$oid."_".$id_pilt.".png";

			$url_s_png="media/".$arr_dom[0]."_pildid/".$oid."_".$id_pilt."s.png";

			$new_image = $url; // name/location of generated thumbnail.

			$new_image_s = $url_s; // name/location of generated thumbnail.

			$new_image_png = $url_png; // name/location of generated thumbnail.

			$new_image_s_png = $url_s_png; // name/location of generated thumbnail.

			

			$quality = 70; //quality of the .jpg

			switch($arr[1])

			{

				case "jpeg":
				case "JPEG":
				case "JPG":
				case "jpg": $src_img = imagecreatefromjpeg($image); 				

				break;

				

				case "PNG":

				case "png": $src_img = imagecreatefrompng($image); 

				break;

			}

			$src_width = imagesx($src_img); // width original image

			$src_height = imagesy($src_img); // height original image

			

if($_GET["act"]=="upi")

{	

//	echo "oota ... ";

	$src_aspect_ratio=$src_width/$src_height;

	$dest_height = $t_height; // vaikimisi väärtus aktiivse algpildi ala kõrgusele

	$dest_width = $t_width; // vaikimisi väärtus aktiivse algpildi ala laiusele

	$dest_height_s =  $t_height_s;

	$dest_width_s = $t_width_s;	

	$dest_aspect_ratio=$dest_width/$dest_height;

	$vahe_x = 0;

	$vahe_y = 0;



//	echo "Nurk ",$mis_nurk,", allika l&k ",$src_width, " ja  ", $src_height, ", tulemuse l&k ",$dest_width, " ja  ", $dest_height,", tulemus_s l&k ",$dest_width_s, " ja  ", $dest_height_s,", külje valik: ", $kylg;

if($t_height and $t_width)

{

	switch ($kylg)

	{

	case 1:	// Kui mängu läheb max laius ... siis saab kohe paika panna allika x-algpunkti ja laiuse

		$src_x=0; $dest_x=0; $dest_x_s=0; $src_width_a = $src_width;

			// Allika kõrguse saab nüüd kätte soovitud pöidlapildi proportsioonide kaudu arvutades ...

		$src_height_a = $src_width_a/$dest_aspect_ratio;

			// Kui leitud kõrgus mahub algpildi raamidesse, siis kasutatakse asendiruutu alg_y määramiseks

		if ($src_height_a <= $src_height)

			{

//				echo "esimene";

				$dest_y=0; 

				$dest_y_s=0;

				$vahe = $src_height - $src_height_a;

				switch($mis_nurk) // on kolm asendit, üleval, keskel või all ...

				{

				case 1: $src_y=0;

				case 2: $src_y=0;

				case 3: $src_y=0;

				break;

				case 4: $src_y=$vahe/2;

				case 5: $src_y=$vahe/2;

				case 6: $src_y=$vahe/2;

				break;

				case 7: $src_y=$vahe;

				case 8: $src_y=$vahe;

				case 9: $src_y=$vahe;

				break;

				}

			}

			else

			{

//				echo "teine";

				$src_y=0;

				$dest_height = ($dest_width/$src_width)* $src_height;

				$dest_width_s=500;

				$dest_height_s = round(($dest_width_s/$src_width)* $src_height,0);

				$vahe = $t_height - $dest_height;

				$src_height_a = $src_height;

				$dest_y=round($vahe/2,0);

				$dest_y_s = 0;

			}

		break;

	case 2:	// Kui mängu läheb max kõrgus ... siis saab kohe paika panna allika y-alguspunkti ja laiuse

		$src_y=0; $dest_y=0; $dest_y_s=0; $src_height_a = $src_height;

			// Allika laiuse saab nüüd kätte soovitud pöidlapildi proportsioonide kaudu arvutades ...

		$src_width_a = $src_height_a * $dest_aspect_ratio;

			// Kui leitud laius mahub algpildi raamidesse, siis kasutatakse asendiruutu alg_x määramiseks

		if ($src_width_a <= $src_width)

			{ 	

				$dest_x=0;

				$vahe = $src_width - $src_width_a;

				switch($mis_nurk) // on kolm asendit, vasakul, keskel või paremal ...

				{

				case 1:

				case 4:

				case 7: $src_x=0;

				break;

				case 2:

				case 5:

				case 8: $src_x=$vahe/2;

				break;

				case 3:

				case 6:

				case 9: $src_x=$vahe;

				break;

				}

			}

			else

			{ 

//				echo "ohooo";

				$src_x=0;

				$dest_width = ($dest_height/$src_height)* $src_width;

				$dest_width_s = ($dest_height_s/$src_height)* $src_width;

				$vahe = $t_width - $dest_width;

				$src_width_a = $src_width;

				$dest_x=$vahe/2; /////////////////////////////

			}

		break;

	default:

		echo "Viga: switch ($kylg)";

		break;

	}

}

else

{

if($t_width)

{

//	echo "Fiks hor res";

	$src_x=0;

	$src_y=0;

	$dest_x=0;

	$dest_y=0;

	$dest_width = $t_width;

	$src_width_a = $src_width;

	$src_height_a = $src_height;

	$dest_width_s = 500;

	$dest_height_s = round(($dest_width_s/$src_width)* $src_height,0); 

}

else

{

//	echo "Fiks ver res";

}

}

		

//echo "  Rehk.allika algkoord: (x):",$src_x, "  (y):", $src_y,", laius ja kõrgus: (l)", $src_width_a ," ja (k)", $src_height_a,". Vahe = ",$vahe,"<br>" ;			

//echo "  Rehk.dest algkoord: (x):",$dest_x, "  (y):", $dest_y,", laius ja kõrgus: (l)", $dest_width ," ja (k)", $dest_height,"<br>";			

//echo "  Rehk.dest_s algkoord: (x):",$dest_x_s, "  (y):", $dest_y_s,", laius ja kõrgus: (l)", $dest_width_s ," ja (k)", $dest_height_s;			



if($t_width and $t_height)

{

$dest_img = imagecreatetruecolor($t_width,$t_height); //echo "kumb?";

}

else

{

$dest_img = imagecreatetruecolor($dest_width,$dest_height); 

}



$dest_img_s = imagecreatetruecolor($suurendus*$src_width,$suurendus*$src_height); 





$white = imagecolorallocate($dest_img, 255, 255, 255);

$white_s = imagecolorallocate($dest_img_s, 255, 255, 255);



imagefill($dest_img, 0, 0, $white);

imagefill($dest_img_s, 0, 0, $white_s);



// Teeme väikese pöidlapildi...

imagecopyresampled($dest_img, $src_img, $dest_x, $dest_y, $src_x ,$src_y, $dest_width, $dest_height, $src_width_a, $src_height_a); 



// Teeme suure pöidlapildi ...

imagecopyresampled($dest_img_s, $src_img, 0, 0, 0 ,0, round($suurendus*$src_width,0), round($suurendus*$src_height), $src_width, $src_height);



// Kirjutame faili

//					imagepng($dest_img, $new_image_png); 

//					imagepng($dest_img_s, $new_image_s_png); 

					imagejpeg($dest_img, $new_image, $quality); 

					imagejpeg($dest_img_s, $new_image_s, $quality); 

					//echo  $new_image_s, $new_image,"tere";

// puhver kinni ...

imagedestroy($dest_img);

imagedestroy($dest_img_s);

				

if($pane_pildiks) 

{				

// kirjutan andmebaasi vastava kirje ... pildi url/i				

$query="UPDATE ".$arr_dom[0]." SET veeb_pilt_url='".urlencode($url)."' , veeb_pilt_w=0 , veeb_pilt_h=0 WHERE id=".$oid;

$result=mysql_query($query);

$query="UPDATE ".$arr_dom[0]." SET veeb_pilt_url_s='".urlencode($url_s)."' WHERE id=".$oid;

$result=mysql_query($query);

}



// kirjutan pisipildi ka XX_pildid tabelisse.



$query="UPDATE ".$dom." SET veeb_pilt_url='".urlencode($url)."' WHERE id=".$id_pilt;

$result=mysql_query($query);

$query="UPDATE ".$dom." SET veeb_pilt_url_s='".urlencode($url_s)."' WHERE id=".$id_pilt;

$result=mysql_query($query);





//				echo $query;				

//				$tehtud=1;

} 



imagedestroy($src_img); 



?><HEAD>	

<meta http-equiv="Pragma" content="no_cache">

</HEAD>





<link href="scat.css" rel="stylesheet" type="text/css">

<style type="text/css">

<!--

.back {

	background-color: #FFFFFF;

	border: 2px none #CCCCCC;

}

-->

</style>



<script>



function aken(){

window.open('about:blank','uploader','width=520,height=350,top=100,toolbar=no');

return true;

}



function ending(){

	window.opener.location.reload();

	window.close();

}

function reload(){

	window.location.reload();

}



function ehee(){

		self.opener.ending();

		window.close();

}



</script>





<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>>

<? if($tehtud!=1) {?>

	<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&oid=<? echo $oid; ?>&id_pilt=<? echo $id_pilt; ?>&domain=<? echo $dom; ?>&t_height=<? echo $t_height; ?>&t_width=<? echo $t_width; ?>" >

<table width="100%" border="0" cellspacing="1" cellpadding="0">

  <tr> 

    <td width="94" background="image/sinine.gif" class="menu" >V&auml;li</td>

    <td colspan="4" background="image/sinine.gif" class="menu">Sisu</td>

  </tr>

  <tr>

  	<td class="options"> <?  echo $dom; ?></td>

  	<td colspan="3" class="options">Kas pilt panna <? echo $arr_dom[0];?> (id=<? echo $oid; ?>) veebipildiks?</td>

			<tr background="image/sinine.gif"> 

			  <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

			</tr>

			 <tr align="left" > 

			  <td align="center" class="menu" ><input type="submit" name="suva1" class="button" value="Proovi j&auml;rele" ></td>

			  <td width="425" colspan="2" valign="bottom" class="navi" >			    <div align="left">

		        <p>Andmete ruut on 100% <br>

		        </p>

		       </div></td>

			  <td width="205" rowspan="3" align="right" class="menu" ><table width="200" border="1" cellpadding="0" cellspacing="0" bordercolor="#D9E9FE">

                <tr>

                  <td><div align="center">

                      <input name="radiobutton" type="radio" value="1" <? if ($mis_nurk == 1) {?>checked="checked"<? }?>>

                  </div></td>

                  <td><div align="center">

                      <input name="radiobutton" type="radio" value="2" <? if ($mis_nurk == 2) {?>checked="checked"<? }?>>

                  </div></td>

                  <td><div align="center">

                      <input name="radiobutton" type="radio" value="3" <? if ($mis_nurk == 3) {?>checked="checked"<? }?>>

                  </div></td>

                </tr>

                <tr>

                  <td><div align="center">

                      <input name="radiobutton" type="radio" value="4" <? if ($mis_nurk == 4) {?>checked="checked"<? }?>>

                  </div></td>

                  <td><div align="center">

                      <input name="radiobutton" type="radio" value="5" <? if ($mis_nurk == 5) {?>checked="checked"<? }?>>

                  </div></td>

                  <td><div align="center">

                      <input name="radiobutton" type="radio" value="6" <? if ($mis_nurk == 6) {?>checked="checked"<? }?>>

                  </div></td>

                </tr>

                <tr>

                  <td><div align="center">

                      <input name="radiobutton" type="radio" value="7" <? if ($mis_nurk == 7) {?>checked="checked"<? }?>>

                  </div></td>

                  <td><div align="center">

                      <input name="radiobutton" type="radio" value="8" <? if ($mis_nurk == 8) {?>checked="checked"<? }?>>

                  </div></td>

                  <td><div align="center">

                      <input name="radiobutton" type="radio" value="9" <? if ($mis_nurk == 9) {?>checked="checked"<? }?>>

                  </div></td>

                </tr>

              </table></td>

			 </tr>

			 

			 <tr align="left" >

			   <td align="center" class="menu" ><input type="button" name="suva122" class="button" value="Reload" onClick="reload();"></td>

			   <td width="425" align="center" valign="middle" class="navi" ><input name="kylg" type="radio" value="1" <? if ($kylg == 1) {?>checked="checked"<? }?>>

laiusest</td>

			   <td width="425" align="center" valign="middle" class="navi" ><input name="kylg" type="radio" value="2"<? if ($kylg == 2) {?>checked="checked"<? }?>>

k&otilde;rgusest

                   

               . </td>

			 </tr>

			 

			 <tr align="left" >

			   <td align="center" class="menu" ><input type="button" name="suva12" class="button" value="Valmis" onClick="ending();"></td>

               <td width="425" colspan="2" valign="middle" class="navi" >Suurt pilti skaleeritakse:

                 <input class="fields" name="suurendus" type="text" value="<? echo $suurendus; ?>"  size="5">

x.</td>

    </tr>

			  

    <td class="options">    

</table>

	<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#D9E9FE">

      <tr>

        <td width="50%" valign="middle"><div align="left" class="navi">Originaal: k&otilde;rgus = <? echo $src_height;?>, laius = <? echo $src_width;?></div></td>

        <td width="50%" valign="middle"><div align="left" class="navi">

          <p>P&ouml;idlapilt: k&otilde;rgus =

            <input class="navi" name="t_height" type="text" value="<? echo $t_height; ?>"  size="4">

            , laius =

            <input class="navi" name="t_width" type="text" value="<? echo $t_width; ?>"  size="4">

          </p>

          </div></td>

      </tr>

      <tr>

        <td><div align="center"><span class="menu"><img src="<? echo $str;?>" alt="pilt" height="100"></span></div></td>

        <td><div align="center"><span class="menu"><img src="<? echo $url;?>" alt="pilt" ></span></div></td>

      </tr><tr>

        <td valign="middle" class="navi">Suure pildi k&otilde;rgus =

          <? echo $suurendus*$src_height;?>

, laius =

<? echo $suurendus*$src_width;?></td>

        <td class="navi">Pane exp objekti veebipildiks? <input name="pane_pildiks" type="checkbox" <? if(1) {?>checked="checked"<? }?>></td>

      </tr>

    </table>

	</form>

<? } 

}//if jpg

elseif($arr[1]=="svg")

{

echo "teresvg";

			$url="media/".$arr_dom[0]."_pildid/".$oid.".svg";

			$url_s="media/".$arr_dom[0]."_pildid/".$oid."s.svg";

// kirjutan andmebaasi vastava kirje ... pildi url/i				

$query="UPDATE ".$arr_dom[0]." SET veeb_pilt_url='".$line["url"]."' WHERE id=".$oid;

$result=mysql_query($query);

$query="UPDATE ".$arr_dom[0]." SET veeb_pilt_url_s='".$line["url"]."' WHERE id=".$oid;

$result=mysql_query($query);

				echo $query;	



}

else

{

echo "Tundmatu failiformaat.";

}



//} 

?>