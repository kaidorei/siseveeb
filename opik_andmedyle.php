<?php
include("connect.php");
// Set encoding
header('Content-Type: text/html; charset=UTF-8');
mysql_set_charset('utf8');
mb_internal_encoding('UTF-8');

include("globals.php");
// Valemite tabel

$valemid=array();

// Kordamisküsimuste tabel

$nupula=array();
$nupula_offset = 570;

//struktuur ...

$struktuur=array();

// Piltide tabel

$exp=array();
$exp_offset = 1745;
$valem_offset = 120;
$valem_offset_2 = 120;
$stop_offset=0;;

// võtame sisu ...
$homepage = file_get_contents('em.html');



// NOPIME VÄLJA peatükid .......................................................


echo "<h1>Tekstid</h1>";

$query="SELECT * FROM raamat15 WHERE pid=0";
$result=mysql_query($query);
$ch_count=0;
while($line=mysql_fetch_array($result))
{
	echo $line["nimi_est"],"<br>";
		$var=3;
		$ch=1;
		while($var>2)
		{
			$var=1;
//			echo "UUS PEATÜKK<br>";
			while($pos1 = stripos($homepage, $line["id"].".".$ch.".".$var."."))
			{
				$chapter = $line["id"].".".$ch.".".$var.".";
				$pieces_ch = explode($chapter, $homepage); // lõige alates numbrist
				$pieces_ch_1 = explode("</p>", $pieces_ch[1]); // lõikan pealkirja
				echo "<b>",$chapter," ",$pieces_ch_1[0],"</b><br>";
				$struktuur[$ch_count]["number"]=$chapter;
				$struktuur[$ch_count]["nimi"]=$pieces_ch_1[0];
				$ch_count++;
				
// määran pealkirja lõpu asukoha, mis on siis selle alajaotuse alguseks
				$pos2 = stripos($pieces_ch[1], "</p>"); 
//määran järgmise alajaotuse pealkirja alguse asukoha		
				$jargmine=$var+1;
				$pos2_1 = stripos($pieces_ch[1], $line["id"].".".$ch.".".$jargmine.".");
				$pos3 = stripos($pieces_ch[1], "<p>YL</p>"); 
				$pos4 = stripos($pieces_ch[1], "<p>STOP</p>"); 
				
// see on neile alajaotustele, mille järel ei tule ülesandeid või stoppi				
				if($pos2_1 and $pos2_1<$pos3) 
				{
				$sisu = substr($pieces_ch[1], $pos2, $pos2_1-$pos2); 







//-------------------------------------------------------------
if(stripos($sisu, "<img src=\""))
{

?>

<table width="100%" border="1">
  <tr>
    <td bgcolor="#FFFF00"><strong>id</strong></td>
    <td bgcolor="#FFFF00"><strong>VALEM fail</strong></td>
    <td bgcolor="#FFFF00"><strong>nimi</strong></td>
    <td bgcolor="#FFFF00">&nbsp;</td>
    <td bgcolor="#FFFF00">&nbsp;</td>
  </tr>
 <?
	$v_count=0;
	$pieces_v = explode("<img src=\"", $sisu); // sisu sees olevate valemite jupid
	foreach($pieces_v as $v)
	{
		if($v_count>0)
		{
		$v_1 = explode("\"", $v);
		$valem_offset++;
		$valemid[$valem_offset]["id"]=$valem_offset;
		$valemid[$valem_offset]["url"]=$v_1[0];
		
// proovime kätte saada ka valemite numbrid ...		
		$v_2 = explode("</p>", $v_1[3]);
		$valemid[$valem_offset]["nimi"]=$v_2[0];
		$v_3 = explode("(", $v_2[0]);
		$v_4 = explode(")", $v_3[1]);
		$valemid[$valem_offset]["nimi"]=$v_4[0];
	
 ?> 
  <tr>
    <td><? echo $valemid[$valem_offset]["id"];?></td>
    <td><? echo $valemid[$valem_offset]["url"]; ?></td>
    <td><? echo $valemid[$valem_offset]["nimi"]; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<? }

$v_count++;
}
?>  
  
</table>
<?

} // END of IF

// asendan valemid ..................................

	foreach($valemid as $v)
	{
		
	$sisu = str_replace("<img src=\"".$v["url"]."\" alt=\"".$v["url"]."\" />","@{".$v["id"]."}@", $sisu);	
	}


				

//-------------------------------------------------------------
//-------------------------------------------------------------
// Siin alajaotuses teen selle triki, et otsin tekstist illustratsioonide 
// numbreid. Kui need leitakse, siis määran vastavalt tabelis raamat15_exp 
// välja oid1.

// Otsime selles alajaotuses jooniste numbreid, mis on siis kujul J.1.3 näiteks.
// Peatüki number on olemas, see on   $line["id"].
// Teeme lihtsa skaneerimise kujul J.$line["id"].1-100

// Peatüki ide leidmine ...
$query98="SELECT * FROM `raamat15` WHERE `nimi_est` LIKE '%".trim($pieces_ch_1[0])."%'";
//echo $query98,"<br>";
$result98=mysql_query($query98);
$line98=mysql_fetch_array($result98);
if($line98)
{
echo "SAIN peatüki vastavuse: ", $line98["id"],"<br>";
}
else
{
echo $query98;
	
}

$exp_number=1;
while ($exp_number<100)
{
	$exp_string = "J.".$line["id"].".".$exp_number.")";
	if(stripos($sisu,$exp_string))
	{
//		echo "LEIDSIN:",$exp_string,"<br>";
// Otsin sellist numbrit ka andmebaasis eksperimetide nimekirjas
		$exp_string_1 = "J.".$line["id"].".".$exp_number;


		$query989="SELECT * FROM `exp` WHERE `nimi_est` LIKE '%".$exp_string_1."%' LIMIT 0 , 30";
//		echo $query989,"<br>";
		$result989=mysql_query($query989);
		while($line989=mysql_fetch_array($result989))
		{
			echo "LEIDSIN exp ID:",$line989["id"]," ... nimega ... ",$line989["nimi_est"],"<br>";
			
//tuleb leida vastav kirje tabelist raamat15_exp ja muuta seal väli oid1, meta 1 on link õpiku sees, tuleb
// edaspidi kasutusse

			$query9899="UPDATE `fyysika_ee`.`raamat15_exp` SET `oid1` = '".$line98["id"]."', meta1='".$exp_string_1."' WHERE `raamat15_exp`.`oid2` =".$line989["id"]."";
			echo $query9899,"<br>";
//			$result9899=mysql_query($query9899);
//			$line9899=mysql_fetch_array($result9899);

// Lisame sisufailile [[456]] tüüpi tagi ...
			$sisu=$sisu."[[".$line989["id"]."]]";
		
		}
	}
	
	$exp_number++;
}


			echo "<br>";
			echo $sisu;
				
				
				
				
				
//............................................................

// Panen tekstid andmebaasi ....

$query23="SELECT * FROM `raamat15` WHERE `nimi_est` LIKE '%".trim($pieces_ch_1[0])."%'";
//echo $query23;
$result23=mysql_query($query23);
$line23=mysql_fetch_array($result23);
if($line23)
{
$query32="UPDATE `raamat15` SET tekst='".$sisu."' WHERE id='".$line23["id"]."'";
//$result32=mysql_query($query32);
//$line32=mysql_fetch_array($result32);
//echo $query32;
}



//-------------------------------------------------------------
				
				
				
				
				
				
				
				
				
				}
// kui tuleb alajaotuse järel midagi ...
				else
				{
//echo "<br>ei leidnud järgmise alajaotuse lõppu:",$line["id"].".".$ch.".".$jargmine.". <br>";

//määran  alajaotuse lõpu asukoha ($pos3_1), sisse jäävad ka ülesanded ja stop
				if($pos2_1)	
				{
				$pos3_1=$pos2_1;
				}
				else
				{
				$jargmine=$ch+1; // KUI ON JÄRGMINE PEATÜKK ...
				$pos3_1 = stripos($pieces_ch[1], $line["id"].".".$jargmine.".1.");
				}
				if(!$pos3_1) //kui on peatüki lõpp
				{
					$jargmine=$line["id"]+1; // KUI ON JÄRGMINE PEATÜKK ...
					$pos3_1 = stripos($pieces_ch[1], "<stop>");
				}
//				echo $pos3," ",$pos4," ",$pos3_1," ", $jargmine.".1.1.","<br>";	
				
				if($pos3>$pos3_1)	 	
				{
				$sisu = substr($pieces_ch[1], $pos2, $pos3_1-$pos2); 
				}
				else
				{
				$sisu = substr($pieces_ch[1], $pos2, $pos3-$pos2); 
				}

//-------------------------------------------------------------
if(stripos($sisu, "<img src=\""))
{

?>

<table width="100%" border="1">
  <tr>
    <td bgcolor="#FFFF00"><strong>id</strong></td>
    <td bgcolor="#FFFF00"><strong>VALEM fail</strong></td>
    <td bgcolor="#FFFF00"><strong>nimi</strong></td>
    <td bgcolor="#FFFF00">&nbsp;</td>
    <td bgcolor="#FFFF00">&nbsp;</td>
  </tr>
 <?
	$v_count=0;
	$pieces_v = explode("<img src=\"", $sisu); // sisu sees olevate valemite jupid
	foreach($pieces_v as $v)
	{
		if($v_count>0)
		{
		$v_1 = explode("\"", $v);
		$valem_offset++;
		$valemid[$valem_offset]["id"]=$valem_offset;
		$valemid[$valem_offset]["url"]=$v_1[0];
		
// proovime kätte saada ka valemite numbrid ...		
		$v_2 = explode("</p>", $v_1[3]);
		$valemid[$valem_offset]["nimi"]=$v_2[0];
		$v_3 = explode("(", $v_2[0]);
		$v_4 = explode(")", $v_3[1]);
		$valemid[$valem_offset]["nimi"]=$v_4[0];
	
 ?> 
  <tr>
    <td><? echo $valemid[$valem_offset]["id"];?></td>
    <td><? echo $valemid[$valem_offset]["url"]; ?></td>
    <td><? echo $valemid[$valem_offset]["nimi"]; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<? }

$v_count++;
}
?>  
  
</table>
<?

} // END of IF

// asendan valemid ..................................

	foreach($valemid as $v)
	{
		
	$sisu = str_replace("<img src=\"".$v["url"]."\" alt=\"".$v["url"]."\" />","@{".$v["id"]."}@", $sisu);	
	}






//-------------------------------------------------------------
//-------------------------------------------------------------
// Siin alajaotuses teen selle triki, et otsin tekstist illustratsioonide 
// numbreid. Kui need leitakse, siis määran vastavalt tabelis raamat15_exp 
// välja oid1.

// Otsime selles alajaotuses jooniste numbreid, mis on siis kujul J.1.3 näiteks.
// Peatüki number on olemas, see on   $line["id"].
// Teeme lihtsa skaneerimise kujul J.$line["id"].1-100

// Peatüki ide leidmine ...
$query98="SELECT * FROM `raamat15` WHERE `nimi_est` LIKE '%".trim($pieces_ch_1[0])."%'";
//echo $query98,"<br>";
$result98=mysql_query($query98);
$line98=mysql_fetch_array($result98);
if($line98)
{
echo "SAIN peatüki vastavuse: ", $line98["id"],"<br>";
}
else
{
//echo $query98;
	
}

$exp_number=1;
while ($exp_number<100)
{
	$exp_string = "J.".$line["id"].".".$exp_number.")";
	if(stripos($sisu,$exp_string))
	{
//		echo "LEIDSIN:",$exp_string,"<br>";
// Otsin sellist numbrit ka andmebaasis eksperimetide nimekirjas
		$exp_string_1 = "J.".$line["id"].".".$exp_number;


		$query989="SELECT * FROM `exp` WHERE `nimi_est` LIKE '%".$exp_string_1."%' LIMIT 0 , 30";
//		echo $query989,"<br>";
		$result989=mysql_query($query989);
		while($line989=mysql_fetch_array($result989))
		{
			echo "LEIDSIN exp ID:",$line989["id"]," ... nimega ... ",$line989["nimi_est"],"<br>";
			
//tuleb leida vastav kirje tabelist raamat15_exp ja muuta seal väli oid1, meta 1 on link õpiku sees, tuleb
// edaspidi kasutusse

			$query9899="UPDATE `fyysika_ee`.`raamat15_exp` SET `oid1` = '".$line98["id"]."', meta1='".$exp_string_1."' WHERE `raamat15_exp`.`oid2` =".$line989["id"]."";
			echo $query9899,"<br>";
//			$result9899=mysql_query($query9899);
//			$line9899=mysql_fetch_array($result9899);

// Lisame sisufailile [[456]] tüüpi tagi ...
			$sisu=$sisu."[[".$line989["id"]."]]";
		
		}
	}
	
	$exp_number++;
}










				echo $sisu;
				
//............................................................

// Panen tekstid sisse.

$query23="SELECT * FROM `raamat15` WHERE `nimi_est` LIKE '%".trim($pieces_ch_1[0])."%'";
//echo $query23;
$result23=mysql_query($query23);
$line23=mysql_fetch_array($result23);
if($line23)
{
$query32="UPDATE `raamat15` SET tekst='".$sisu."' WHERE id='".$line23["id"]."'";
//$result32=mysql_query($query32);
//$line32=mysql_fetch_array($result32);
//echo $query32;
}
				



//-------------------------------------------------------------
// YL ...				
				if($pos3 and $pos4 and $pos3<$pos4 and $pos4<$pos3_1)
				{
//				echo "YLESANDED<br>";
				$YL = substr($pieces_ch[1], $pos3, $pos4-$pos3); 
// Lõigume tükkideks ...				
				$pieces_yl = explode("<li>", $YL); // lõige alates numbrist
?><table width="100%" border="1">
  <tr>
    <td bgcolor="#00FF66"><strong>id</strong></td>
    <td bgcolor="#00FF66"><strong>ÜLESANNE tekst</strong></td>
    <td bgcolor="#00FF66"><strong>ptk</strong></td>
  </tr>
<? 				$y_n=0;
				foreach($pieces_yl as $y)
				{
					if($y_n>0)
					{
					
				$pieces_y = explode("</li>", $y); // lõige alates numbrist

					?>
					  <tr>
						<td><? echo	$nupula_offset; ?></td>
						<td><? echo $pieces_y[0]; ?></td>
						<td><? echo $line98["id"]; ?></td>
					  </tr>
	<?		
	
// Kirjutame ka kohe andmebaasi:

$query_nupula = "INSERT INTO `fyysika_ee`.`nupula` (`id`, `liik`, `nimi_est`, `probleem_est`, `vihje_est`, `vastus_est`, `script`, `valik1`, `komm1`, `vast1`, `valik2`, `komm2`, `vast2`, `valik3`, `komm3`, `vast3`, `valik4`, `komm4`, `vast4`, `valik5`, `komm5`, `vast5`, `valik6`, `komm6`, `vast6`, `naita_veebis`, `veeb_pilt_url`, `veeb_pilt_url_s`, `algallikas`, `lupdate`) VALUES (".$nupula_offset.", '0', 'nimi_est', '".$pieces_y[0]."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', CURRENT_TIMESTAMP)";
//	echo $query_nupula;
//	$result_nupula=mysql_query($query_nupula);
// 	mysql_fetch_array($result_nupula);


$query_nupula_raamat = "INSERT INTO `fyysika_ee`.`raamat15_nupula` (`id`, `oid1`, `oid2`, `order1`, `order2`, `width1`, `height1`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`) VALUES (NULL, '".$line98["id"]."', '".$nupula_offset."', '', '', '', '', 'title1', '', '', '', '', '', '0', '0')";
//	echo $query_nupula_raamat;
//	$result_nupula_raamat=mysql_query($query_nupula_raamat);
// 	mysql_fetch_array($result_nupula_raamat);

				$nupula_offset++;
	

			}	
				$y_n++;			
				}
?>				
</table>
<?				
//				echo $YL;
				}
// STOP ...				
				if($pos4 and $pos3_1 and $pos4<$pos3_1)
				{
				echo "STOP<br>";
				$STOP = substr($pieces_ch[1], $pos4, $pos3_1-$pos4); 
// Lõigume tükkideks ...				
				$pieces_s = explode("<li>", $STOP); // lõige alates numbrist
?><table width="100%" border="1">
  <tr bgcolor="#00CCFF">
    <td><strong>id</strong></td>
    <td><strong>STOP tekst</strong></td>
    <td><strong>ptk</strong></td>
  </tr>
<? 				$s_n=0;
				foreach($pieces_s as $s)
				{
					if($s_n>0)
					{
					
						$pieces_s = explode("</li>", $s); // lõige alates numbrist
		
						?>
						  <tr>
							<td><? echo	$stop_offset; ?></td>
							<td><? echo $pieces_s[0]; ?></td>
							<td><? echo $line98["id"]; ?></td>
						  </tr>
						<?								
						$stop_offset++;



// Kirjutame ka kohe andmebaasi:

$query_nupula = "INSERT INTO `fyysika_ee`.`pohivara` (`id`, `nimi`, `tekst`, `image`) VALUES (".$stop_offset.", NULL, '".$pieces_s[0]."', '')";
//	echo $query_nupula;
//	$result_nupula=mysql_query($query_nupula);
// 	mysql_fetch_array($result_nupula);


$query_nupula_raamat = "INSERT INTO `fyysika_ee`.`raamat15_pohivara` (`id`, `oid1`, `oid2`, `order1`, `order2`, `width1`, `height1`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`) VALUES (NULL, '".$line98["id"]."', '".$stop_offset."', '', '', '', '', 'title1', '', '', '', '', '', '0', '0')";
//	echo $query_nupula_raamat;
//	$result_nupula_raamat=mysql_query($query_nupula_raamat);
// 	mysql_fetch_array($result_nupula_raamat);





					}
					$s_n++;			
				}
?>				
</table>
<?				

//				echo $STOP;
				}
				
				
				}
				$var++;
			}
			$ch++;
		}
}





// NOPIME VÄLJA PILDID ...

$pieces = explode("<div>", $homepage);
reset($pieces);

$vajan_pildiallkirja=0;

foreach($pieces as $line)
{ 
if(strstr($line, "<img src") and !strstr($line, "<p>"))
{
	$pieces_exp = explode("\"", $line);
	// siit tuleb exp asi ...
	$exp_asi = array();
	$exp_asi["url"] = $pieces_exp[1];
	$exp_asi["id"] =  $exp_offset++;
	$exp[$exp_offset] = $exp_asi;
	$vajan_pildiallkirja = 1;
	
//echo "PILT";
} 
elseif ($vajan_pildiallkirja == 1) //oleme just saanud pildi, kleebime sellele nüüd 			allkirja külge
{
	$exp[$exp_offset]["allkiri"] = $line;
	$vajan_pildiallkirja = 0;
}
else
{

//echo "$line";
	
}
}


// vahetan sisus välja valemi vastava koodi vastu ...
echo "<h1>Raamatu struktuur</h1>";

?>
<table width="100%" border="1">
  <tr>
    <td bgcolor="#FF6699"><strong>number</strong></td>
    <td bgcolor="#FF6699"><strong></strong></td>
    <td bgcolor="#FF6699"><strong>nimi</strong></td>
    <td bgcolor="#FF6699">&nbsp;</td>
    <td bgcolor="#FF6699">&nbsp;</td>
  </tr>
 <?
	foreach($struktuur as $s)
	{
 ?> 
  <tr>
    <td><? echo $s["number"];?></td>
    <td><?
// kas leiame andmebaasist sama nimega alajaotuse?    

$query="SELECT * FROM `raamat15` WHERE `nimi_est` LIKE '%".trim($s["nimi"])."%'";
$result=mysql_query($query);
$ch_count=0;
$line=mysql_fetch_array($result);
if($line)
{
echo "sain: ", $line["id"];
}
else
{
echo $query;
	
}

	
	
	
	
	?></td>
    <td><? echo $s["nimi"]; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<?
// andmebaasi 


		$query3="INSERT INTO `fyysika_ee`.`valem` (`id`, `nimi`, `tex`, `image`) VALUES ('".$v["id"]."', '".$v["nimi"]."', NULL, '".$v["url"]."')";
//echo $query3,"</br>";
//		$result3=mysql_query($query3);
//		$line3=mysql_fetch_array($result3);


$v_count++;
}
?>  
  
</table>
<?
// vahetan sisus välja valemi vastava koodi vastu ...
echo "<h1>Raamatus esinevad valemid</h1>";

?>
<table width="100%" border="1">
  <tr>
    <td bgcolor="#CCCCCC"><strong>id</strong></td>
    <td bgcolor="#CCCCCC"><strong>VALEM fail</strong></td>
    <td bgcolor="#CCCCCC"><strong>nimi</strong></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
 <?
//	foreach($valemid as $v)
	{
 ?> 
  <tr>
    <td><? echo $v["id"];?></td>
    <td><? echo $v["url"]; ?></td>
    <td><? echo $v["nimi"]; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<?
// andmebaasi 


		$query3="INSERT INTO `fyysika_ee`.`valem` (`id`, `nimi`, `tex`, `image`) VALUES ('".$v["id"]."', '".$v["nimi"]."', NULL, '".$v["url"]."')";
//echo $query3,"</br>";
//		$result3=mysql_query($query3);
//		$line3=mysql_fetch_array($result3);


$v_count++;
}
?>  
  
</table>
<?


echo "<h1>Raamatus esinevad pildiobjektid</h1>";
?>
<table width="100%" border="1">
  <tr>
    <td bgcolor="#CC9900"><strong>id</strong></td>
    <td bgcolor="#CC9900"><strong>url</strong></td>
    <td bgcolor="#CC9900"><strong>pildiallkiri</strong></td>
    <td bgcolor="#CC9900"><strong>peatükk</strong></td>
    <td bgcolor="#CC9900"><strong>peatüki nimi</strong></td>
  </tr>
  
 <? 
 
 foreach($exp as &$value)
 
 {
 //------------------------- BAASI-----------------------------------
 
 $query55="INSERT INTO `fyysika_ee`.`exp` (`id`, `gpid_demo`, `naita_veebis`, `veeb_ok`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_url`, `veeb_pilt_url_s`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_est_check`, `kirjeldus_eng`, `kirjeldus_rus`, `seletus_est`, `seletus_est_check`, `seletus_eng`, `seletus_rus`, `misvalesti_est`, `misvalesti_est_check`, `ohud_est`, `ohud_est_check`, `hange_est`, `hange_est_check`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `video_player`, `orig_URL`, `sell_it`, `copyright`) VALUES ('".$value["id"]."', '0', '0', '0', '0', '0', '0', '0', '0', '0', '".urlencode("media/exp_pildid/".$value["url"])."', '".urlencode("media/exp_pildid/".$value["url"])."', '".trim(str_replace("</div>","",str_replace("</p>","",substr(str_replace("<p>","", $value["allkiri"]),0,30))))."', NULL, NULL, NULL, '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, CURRENT_TIMESTAMP, '', '', '', '1', '', '', 'FYYSIKA.EE')";
 
//echo $query55;
//	$result55=mysql_query($query55);
// 	$line55=mysql_fetch_array($result55);

 
 $query66="INSERT INTO `fyysika_ee`.`raamat15_exp` (`id`, `oid1`, `oid2`, `order1`, `order2`, `width1`, `height1`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`) VALUES (NULL, '0', '".$value["id"]."', '', '', '', '', '".trim(str_replace("</div>","",str_replace("</p>","",str_replace("<p>","", $value["allkiri"]))))."', '', 'sisse1 ', '', 'sisu1 ', '', '0', '0')";

//echo $query66;
 
// 	$result66=mysql_query($query66);
// 	$line66=mysql_fetch_array($result66);

 //-------------------------------
 
 
 
 
 
 ?>
 
  <tr>
    <td><? echo $value["id"];?></td>
    <td><? echo $value["url"]; ?></td>
    <td><? echo $value["allkiri"]?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <? }
  ?>
</table>




