<link href="scat.css" rel="stylesheet" type="text/css" />

<style type="text/css">

<!--

.style1 {color: #FF0000}

-->

</style>

<br>

<?	$action=$_GET["action"];

	$sel=$_GET["sel"];

	$ord=$_GET["ord"];

	$etendus_id=$_GET["etendus_id"];

	if($ord==NULL) $ord="nimi";

	if($action=="del"){

		$expid=$_GET["fid"];

		$tables=array('kool_lingid','kool_isikud');

		foreach($tables as $name){

			$q="DELETE FROM ".$name." WHERE oid=".$fid;

			$r=mysql_query($q);

			}

			$q="DELETE FROM kool WHERE id=".$fid;

			$r=mysql_query($q);

	}

// kui ei ole tehtud valikut staatuse  j�rgi ..

if($sel==NULL) $sel=0;

if($sel==5) { $globe=" AND on_globe = 1";} else {$globe="";}





$query="SELECT * FROM kool WHERE nimi LIKE '%".$_POST["search_str"]."%'".$str1."".$globe."".$str_kutse." AND tyyp != 10 ORDER BY ".$ord;

//echo $query,"<br>";

$result=mysql_query($query);



if($sel==10) // Tegeleme �pikodadega

	{



?>

<a href="http://www.fyysika.ee/omad/user_tunnistused2012.php">T&otilde;endid 2011/2012</a><a href="http://www.fyysika.ee/omad/user_tunnistused2013.php">T&otilde;endid 2012/2013</a><a href="http://www.fyysika.ee/omad/user_tunnistused2014.php">T&otilde;endid 2013/2014</a> <a href="index.php?page=avaldus_table&liik=2">Laekunud avaldused (ei t��ta)</a> <a href="http://www.fyysika.ee/registreerumine.php">Reg leht</a>

<table width="100%" border="1">

  <tr>

    <td class="menu">Kool</td>

    <td class="menu">www</td>

    <td class="menu">T&Uuml;P</td>

    <td class="menu">n</td>



<?

		$query1="SELECT * FROM reis WHERE tyyp=10 ORDER BY nimi";

	//echo $query1;

	$result1=mysql_query($query1);

	$kojad=array();



	while($line1=mysql_fetch_array($result1))

	{

		echo "<td class=\"menu\"> <a href=\"http://www.fyysika.ee/omad/index.php?page=reis_disp&reisid=".$line1["id"]."\">".$line1["nimi_lyh"]."</a></td>";

		array_push($kojad, $line1); // j�tan meelde, mis �pikojad olemas on

    }



		?>

  </tr>







<? //WHILE ALGAB, k�iakse l�bi k�ik kooolid.

	while($line=mysql_fetch_array($result)){

//	 Kas konkreetsel koolil on miskit �pikodadega tyyp=10 pistmist olnud?

	$fkb_kool=0;

	$etendus_koda_id=NULL;

	foreach ($kojad as $koda) // selekteerin asjassepuutuvad koolid

	{

// Kas on toimunud �pikodasid, vaatan reis_kool tabelit ...

		$query2="SELECT * FROM reis_kool WHERE oid1='".$koda["id"]."' AND oid2='".$line["id"]."'";

//		echo $query2;

		$result2=mysql_query($query2);

		if(mysql_fetch_array($result2))

		{

				$fkb_kool=1;

				break;

		}

//

	}

	if($fkb_kool==0) // �kki on lihtsalt kutse, varem k�inud ei ole ...

	{

		$query25="SELECT * FROM kutse_kool WHERE oid2='".$line["id"]."'";

//		echo "fkbkool=",$fkb_kool," and ",$query25,"<br>";

		$result25=mysql_query($query25);

		while($line25=mysql_fetch_array($result25))

		{



			$query26="SELECT * FROM kutse WHERE id='".$line25["oid1"]."'";

//			echo $query26,"<br>";

			$result26=mysql_query($query26);

			$line26=mysql_fetch_array($result26);

			if($line26["etendus_id"]==38)

			{

				$fkb_kool=1;

//				echo "KIIIIIIIIIIIIIIIIIIIIIIIIIIIII";

				break;

			}

		}

	}















if($fkb_kool==1)

{

		?>

  <tr>

    <td class="options"><a href="http://www.fyysika.ee/omad/index.php?page=kool_disp&fid=<? echo $line["id"];?>" target="_blank" ><? echo $line["nimi"];?></a></td>

    <td align="center" class="options"><a href="<? echo $line["veeb"];?>" target="_blank">www</a></td>

    <td align="center" class="options"><? echo $line["ty_partnerkool"];?></td>

    <td align="center" class="options"><? echo $line["o_arv"];?></td>

    <?

	$count=0;

 	foreach ($kojad as $koda)

	{



		// Saame teada sellele reisile vastava kava ID ...

		$query_eid="SELECT * FROM etendus_reis WHERE oid2=".$koda["id"]."";

//		echo $query_eid;

		$result_eid=mysql_query($query_eid);

		$line_eid=mysql_fetch_array($result_eid);



		$etendus_koda_id=$line_eid["oid1"];

		//if($etendus_koda_id) echo $etendus_koda_id," ";





		// m�rgin kutse olemasolu �ra kollase v�rviga ... ehk siis k�simus, kas on kutse v�i ei ole mitte ... k�in l�bi k�ik konkreetsele koolile saadetud kutsed ...

		$varviline="";

		$query_kutse="SELECT * FROM kutse_kool WHERE oid2='".$line["id"]."'";

		//echo $query_kutse;

		$result_kutse=mysql_query($query_kutse);

		while($line_kutse=mysql_fetch_array($result_kutse))

		{

//			echo $line_kutse["id"]," ";

			$query_etendus="SELECT * FROM kutse_etendus WHERE oid1='".$line_kutse["oid1"]."' AND oid2='". $etendus_koda_id."'";

			//echo $query_etendus;

			$result_etendus=mysql_query($query_etendus);

			if($line_etendus=mysql_fetch_array($result_etendus))

			{

				$varviline="bgcolor=\"#FFFF00\"";

				//echo "HEI HOPSTI", $query_etendus;

			}

			else

			{

				$varviline="";

			}



		}

		echo"<td class=\"menu\" align=\"center\" ".$varviline.">";



//		echo $koda." ";

		//echo $query_etendus;

		//echo $etendus_koda_id;

		$query3="SELECT * FROM reis_kool WHERE oid1='".$koda["id"]."' AND oid2='".$line["id"]."'";

//		echo $query2;

		$result3=mysql_query($query3);

		if($line3=mysql_fetch_array($result3))

		{

				echo str_replace(" ","",$koda["nimi_lyh"]),"<br>";//(",$koda["id_m"],"-",$koda["id_m_context"],"-".$line3["groupid"].")<br>";



//-------------------------MITU T�ENDIT?--------------

		$count_tunnistus=0;

		$count_isik=0;

		$query_m="SELECT * FROM moodle_nina.mdl_groups_members WHERE groupid=".$line3["groupid"];

//		echo $query_m;

		$result_m=mysql_query($query_m);

		while($line_m=mysql_fetch_array($result_m)){

		if($koda["id_m_context"])

		{



		$query_r="SELECT * FROM moodle_nina.mdl_role_assignments WHERE userid=".$line_m["userid"]." AND contextid=".$koda["id_m_context"];

//		echo $query_r;

		$result_r=mysql_query($query_r);

		$line_r=mysql_fetch_array($result_r);

		if (1) // �pilased=5

		{

		$query_u="SELECT * FROM moodle_nina.mdl_user WHERE id=".$line_m["userid"];

		$result_u=mysql_query($query_u);

		$line_u=mysql_fetch_array($result_u);

		//echo $line_u["firstname"]." ".$line_u["lastname"]; //siit saab �pilaste nimed ...



		$query_k="SELECT * FROM moodle_nina.mdl_user_info_data WHERE fieldid=38 AND userid=".$line_m["userid"];

		$result_k=mysql_query($query_k);

		$line_k=mysql_fetch_array($result_k);

		//echo $line_k["data"] //Siit saaks kooli nime ...

		$range_g="itemid>".$koda["id_m_item_min"]." AND itemid<".$koda["id_m_item_max"]."";



		$query_o="SELECT SUM(finalgrade) FROM moodle_nina.mdl_grade_grades WHERE userid=".$line_m["userid"]." AND ".$range_g;

		//echo $query_o;

		$result_o=mysql_query($query_o);

		$line_o=mysql_fetch_array($result_o);

		  // echo $line_o[0]." <br><br> "; //echo $query_o;?>

		  <? if ($line_o[0]>3)

		  {

//			echo "+".$count_tunnistus;

		  	$count_tunnistus++;

		  }

		  $count_isik++;

?>

	<?

// lisa uus tegelane t�endite andmebaasi



		$query_t="INSERT INTO `moodle_nina`.`mdl_user_toendid_13` (`id`, `username`, `firstname`, `lastname`, `email`, `skype`, `phone1`, `phone2`, `institution`, `department`, `address`, `city`, `country`, `course`, `group`, `count`) VALUES (NULL, 'usern', '".$line_u["firstname"]."', '".$line_u["lastname"]."', '".$line_u["email"]."', '', '', '', '".$line_k["data"]."', '', '', '', 'EE', '".$line["fullname"]."', '".$line_ryhmad["name"]."', '".$line_o[0]."')";

//		echo $query_t;

//		$result_t=mysql_query($query_t);



	$count++;

	}

		}



		}			?><div class="button2">(<? echo $count_tunnistus;?>/<? echo $count_isik;?>)</div><?



//-------------------------END OF MITU T�ENDIT--------------

		}

		echo"</td>";

	$count++;

	if($count==3)$count=0;

	}





	?>

  </tr>

<?

}

}

	?></table>

<?

	}



	else



	{



?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="13" class="pealkiri"><?



// kui otsitakse konkreetse etenduse kutseid ...

	if($sel==10) { echo "FKB �pikojad";	}

	if($sel==5) { echo "GLOBE Eesti koolid";	}

	if($sel==2) { echo "Koolid (v�i asutused), mis on m�ne tuleva reisi plaani v�etud";	}

	if($sel==3) { echo "Koolid (v�i asutused), kus me oleme k�inud, misiganes kavaga";	}

	if($etendus_id) { $str_kutse=" AND kutse_".$etendus_id."=1 AND tyyp=1 ";

?>

      Koolid <span class="smallbody">(<img src="image/motik_rikkis.gif" width="23" height="15" />- kool/asutus ei ole ega ole olnud &uuml;hegi reisi nimekirjas. Ei t�henda tingimata seda, et meid oleks sinna kutsutud)</span> <? }?></td>

  </tr>

  <tr>

    <td colspan="2" class="menu">staatus</td>

    <td width="44%" nowrap class="menu"><a href="index.php?page=kool_table&ord=nimi&sel=<? echo $sel?>">nimi</a></td>

    <td width="6%" nowrap class="menu" align="center">e-mail</td>

    <td width="4%" nowrap class="menu" align="center">www</td>

    <td width="4%" align="center" nowrap class="menu">F&Otilde;</td>

    <td width="4%" align="center" nowrap class="menu">K&Otilde;</td>

    <td width="4%" align="center" nowrap class="menu">B&Otilde;</td>

    <td width="3%" align="center" nowrap class="menu">G&Otilde;</td>

    <td nowrap class="menu"><a href="index.php?page=kool_table&ord=maakond&sel=<? echo $sel?>">maakond</a></td>

    <td nowrap class="menu"><a href="index.php?page=kool_table&ord=date&sel=<? echo $sel?>">esmareg.</a></td>

    <td class="menu" valign="middle">      </td>

    <td nowrap class="smallbody">&nbsp;<? if($priv>=2) {?>

      <a href="kool_table_mass.php">kiri</a>

      <? } ?></td>

  </tr>

  <tr background="image/sinine.gif">

    <td colspan="14" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>

  <?

//WHILE ALGAB--------------------------------------------------------------------------------------------------------------------------

	while($line=mysql_fetch_array($result)){



			// kui on tehtud valik staatuse j�rele ...

			$state = 0;

			//... siis uurime, kas kool on olnud juba kusagil reisil asjaline ...

				$query1="SELECT id,oid1 FROM reis_kool WHERE oid2=".$line["id"];

				//	echo $query1;

				$result1=mysql_query($query1);

				$line1=mysql_fetch_array($result1);



				if($line1==NULL)

				{

					$state=1;

					$aastalopp="0000-00-00"	;

			//	  $kaimata++;

			// 	 echo $kaimata;

				} // end of

				else

				{

			// kui ei ole olnud asjaline, siis kontrollime, kas m�ni kirjasolevatest reisidest on tulemas v�i on k�ik juba l�bi ja tehtud ...

				$result1=mysql_query($query1);

				while($line1=mysql_fetch_array($result1)){

 					$query2="SELECT nadal_nmbr, lopp, hooaeg_nmbr FROM reis WHERE id=".$line1["oid1"];

					$result2=mysql_query($query2);

					$line2=mysql_fetch_array($result2);



					// m�rgime erit�hisega koolid, kellega on juba l�bir��kimistesse asutud, ehk siis need koolid, mis on kirjas kusagil reisil, mille

					// toimumisaeg on kusagil tulevikus ... teeme seda n�dala ja hooaja numbri kaudu, muidu tekib segadus m�rkimata algusajaga reisidega.

					switch ($line2['hooaeg_nmbr'])

					{

						case "1": $pa=27; $yea=2004; $pl=2; $yel=2005; $hooaeg=1; $nihe=14; break;

						case "2": $pa=26; $yea=2005; $pl=1; $yel=2006; $hooaeg=2; $nihe=0; break;

						case "3": $pa=25; $yea=2006; $pl=31; $yel=2007; $hooaeg=3; $nihe=0; break;

						case "4": $pa=31; $yea=2007; $pl=6; $yel=2008; $hooaeg=4; $nihe=0; break;

					}

						$aastaalgus  = date("Y-m-d", mktime (0,0,0,12  ,$pa+($line2["nadal_nmbr"]+1)*7,$yea));



						if($aastaalgus  < date("Y-m-d"))

						{

						 $state=3;

//						 echo date("Y-m-d")," < ", $line2["lopp"];

						}else{

						 $state=2;

//						 echo date("Y-m-d")," > ", $aastalopp;

						}

					} // end of while



				} // end of else

// Kui meid on teist korda k�lla kutsutud

if($sel==5&&$line["on_globe"]==1) {$state=5;};

//echo "state = ",$state;

// Kui on valitud "sel", siis n�itame vaid neid koole, mis vastavad m��ratlusele ...

if($sel==0||$state==$sel)

{

//	if($line["kutse_fyysika"] or $line["kutse_keemia"] or $line["kutse_valgus"] or $line["kutse_materjal"] or $line["kutse_robot"]) {$state=1;} ?>

  <tr>

    <td align="center" valign="middle" class="menu" width="3%">

      <? //echo "sel=   ", $sel;



	switch ($state)

	{

	case 1:

// ajutine: k�ik endise s�steemi k�imata koolid saavad f��sikaetendusekutse m�rgi k�lge ...





/*	$query2222="UPDATE kool SET kutse_fyysika=1 WHERE id=".$line["id"]." AND on_globe=0";

	echo $query2222;

	$result2222=mysql_query($query2222);

*///	mysql_fetch_array($result2222)

	?>

      <img border=0 alt="reg" src="image/motik_rikkis.gif" width=23 height=15 >

      <? break;

	case 2: ?>

      <img border=0 alt="Rikkis" src="image/motik_toos.gif" width=19 height=19 >

      <? break;

	case 3: ?>

<!--      <img border=0 alt="Rikkis" src="image/motik_utiliseer.gif" width=15 height=15 >

-->      <? break;

	case 4: ?>

<!--      <img border=0 alt="Rikkis" src="image/motik_utiliseer.gif" width=15 height=15 >

-->      <? break;

	case 5: ?>

G<? break;

//	default: echo "ok   "; break;

	}





	?>    </td>

    <td align="center" valign="middle" class="menu_punane" width="3%"><img src="image/spacer.gif" width="1" height="15" />&nbsp;

    <? /*

	if($line["tyyp"]==0) {echo "*";}

//	if($line["on_globe"]==1) {echo "G";}

	if($line["kutse_1"]==1) {echo "f";}

	if($line["kutse_2"]==1) {echo "k";}

	if($line["kutse_5"]==1) {echo "m";}

	if($line["kutse_3"]==1) {echo "v";}

	if($line["kutse_4"]==1) {echo "r";}

	if($line["kutse_6"]==1) {echo "p";}

	if($line["kutse_7"]==1) {echo "G";}*/?></td>

    <td nowrap class="menu"><a href="index.php?page=kool_disp&fid=<? echo $line["id"]; ?>" target="_blank"><? echo $line["nimi"]; if($line["on_globe"]==1) {echo "(G)";}

?></a>  <span class="navi"><? echo $line["aadress"];?></span></td>

    <td nowrap class="menu" align="center"><? if ($line["email1"]) {?><a href="mailto:<? echo $line["email1"];?>"><img src="image/EmailIcon.jpg" width="18" height="20" border="0" /></a><? }?></td>

    <td align="center" nowrap class="pealkiri"><? if ($line["veeb"]) {?><a href="<? echo $line["veeb"];?>" target="_blank">W</a><? }?></td>



<?



					$query_onopetaja="SELECT * FROM isik_kool WHERE oid2=".$line["id"]." AND sisu2='fyysika'";

					$result_onopetaja=mysql_query($query_onopetaja);

					$line_onopetaja=mysql_fetch_array($result_onopetaja);





?>



    <td align="center" nowrap class="pealkiri"><? if ($line_onopetaja) {?>

    <a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&iid=<? echo $line_onopetaja["oid1"];?>" target="_blank">f</a><? }?></td>

    <?



					$query_onopetaja="SELECT * FROM isik_kool WHERE oid2=".$line["id"]." AND sisu2='keemia'";

					$result_onopetaja=mysql_query($query_onopetaja);

					$line_onopetaja=mysql_fetch_array($result_onopetaja);





?>

    <td align="center" nowrap class="pealkiri"><? if ($line_onopetaja) {?>

    <a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&iid=<? echo $line_onopetaja["oid2"];?>" target="_blank">k</a><? }?></td>

    <?



					$query_onopetaja="SELECT * FROM isik_kool WHERE oid2=".$line["id"]." AND sisu2='bioloogia'";

					$result_onopetaja=mysql_query($query_onopetaja);

					$line_onopetaja=mysql_fetch_array($result_onopetaja);





?>

    <td align="center" nowrap class="pealkiri"><? if ($line_onopetaja) {?>

    <a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&iid=<? echo $line_onopetaja["oid1"];?>" target="_blank">b</a><? }?></td>

    <?



					$query_onopetaja="SELECT * FROM isik_kool WHERE oid2=".$line["id"]." AND sisu2='geograafia'";

					$result_onopetaja=mysql_query($query_onopetaja);

					$line_onopetaja=mysql_fetch_array($result_onopetaja);





?>

    <td align="center" nowrap class="pealkiri"><? if ($line_onopetaja) {?>

    <a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&iid=<? echo $line_onopetaja["oid1"];?>" target="_blank">g</a><? }?></td>

    <td  width="14%" class="menu" nowrap>

      <?

	$query3="SELECT nimi FROM maakonnad WHERE id=".$line["maakond"];

	$result3=mysql_query($query3);

	$m=mysql_fetch_array($result3);



	echo $m["nimi"]; ?>    </td>

    <td  width="4%" class="menu" nowrap><? echo $line["date"]; ?></td>

    <td width="2%" valign="middle"  class="smallbody">

      <? if($priv>=2) {?>

      <a class="menu_punane" href="index.php?page=kool_table&action=del&fid=<? echo $line["id"]; ?>">x</a>

      <? } ?></td>

    <td width="5%" align="right" nowrap class="smallbody">

      <?  if($line["PK"]>1000)

	  {

	  ?>

      <img  align="middle" src="image/index_39.gif">

      <? } ?>    </td>

  </tr>

  <?

	}

}



}

?>

</table>

<?

/*

				switch($sel){

					case 0: $url_t="image/eesti_asjas.jpg"; break;

					case 1: $url_t="image/eesti_ootel.jpg"; break;

					case 2: $url_t="image/eesti_toos.jpg"; break;

					case 3: $url_t="image/eesti_olemas.jpg"; break;

					case 5: $url_t="image/eesti_globe.jpg"; break;

					default: $url_t="image/eesti_asjas.jpg"; break;

				}

*/// Kui on �ldine tabel ...

				if (!$etendus_id) $etendus_id=0;

// Tehtava pildi nimi ...

				switch ($etendus_id)

					{

					case 0: $url_t="image/eesti_asjas.jpg"; break;

					case 1: $url_t="image/eesti_ootel_fyysika.jpg"; break;

					case 2: $url_t="image/eesti_ootel_keemia.jpg"; break;

					case 4: $url_t="image/eesti_ootel_robootika.jpg"; break;

					case 5: $url_t="image/eesti_ootel_materjal.jpg"; break;

					case 7: $url_t="image/eesti_ootel_GLOBE.jpg"; break;

					case 3: $url_t="image/eesti_ootel_valgus.jpg"; break;

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

				$resultkoo=mysql_query("SELECT id, on_globe, PK, LK FROM kool WHERE PK>0 ".$str_kutse." ");

			while($linekoo=mysql_fetch_array($resultkoo))

			{



//				echo $linekoo["PK"],"   ";

			  	$x=($linekoo["PK"]-373877)*($src_width/(745237-373877));

			  	$y=$src_height - ($linekoo["LK"]-6345722)*($src_height/(6648619-6345722));

//				echo $x," ",$y;

// kas seal on k�idud?



				$query1="SELECT id,oid1 FROM reis_kool WHERE oid2=".$linekoo["id"];

				$result1=mysql_query($query1);

				$line1=mysql_fetch_array($result1);

				if($line1){$color = $green;} else {$color = $red;}

				switch($sel){

				case 0: 			imagefilledarc($dest_img, $x, $y, 10, 10, 0, 360, $color, IMG_ARC_PIE); // k�ik

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

				default: 			imagefilledarc($dest_img, $x, $y, 10, 10, 0, 360, $color, IMG_ARC_PIE); // k�ik

									imageellipse($dest_img, $x, $y, 10, 10, $white);

									break;

				}



}

//			imagerotate($dest_img, 90, 0);

			imagejpeg($dest_img, $url_t, $quality);

			imagedestroy($src_img);

			imagedestroy($dest_img);











?>

<div align="center">

  <p class="fields"><?php

  if($etendus_id==0)

  echo "Sellel kaardil t&auml;histavad rohelised ringid koole, kus me oleme varame ka k&auml;inud v&otilde;i mis on juba mingi reisi nimekirjas, punastega t&auml;histatud koolides ei ole me kunagi k&auml;inud.";

  else

  echo "Sellel kaardil t&auml;histavad rohelised ringid koole, kuhu seda konkreetset etendust on tahetud, aga kus me oleme varame ka k&auml;inud v&otilde;i mis on juba mingi reisi nimekirjas, punastega t&auml;histatud koolides ei ole me kunagi k&auml;inud."; ?></p>

  <p><img src="<? echo $url_t;?>" alt="koolikaart" /></p>

</div>
