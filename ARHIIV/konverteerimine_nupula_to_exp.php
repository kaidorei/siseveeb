<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 

$query="SELECT * FROM `nupula` order by id";
$result=mysql_query($query);

$id_0=4500;
$id_1=6000;
$id_vahe_valik=6000;

while($line=mysql_fetch_array($result)){
	
$id_vahe=$id_0 + $line["id"];

echo "--------------------------------------------------------------------------<br>";

switch ($line["liik"])
{
	case 0: $gpid_demo_uus= 32; break;
	case 1: $gpid_demo_uus= 20; break;
	case 2: $gpid_demo_uus= 21; break;
	case 3: $gpid_demo_uus= 23; break;
	case 4: $gpid_demo_uus= 24; break;
	case 5: $gpid_demo_uus= 25; break;
	case 6: $gpid_demo_uus= 26; break;
	case 7: $gpid_demo_uus= 27; break;
	case 8: $gpid_demo_uus= 28; break;
	case 9: $gpid_demo_uus= 29; break;
	default: $gpid_demo_uus= 32; break; 	
}


if($line["on_seeria"])
{
	$gpid_demo_uus= 30;
}

$query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `gpid_demo`, `naita_veebis`, `on_slave`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `misvalesti_est`, `ohud_est`, `kokku_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `id_uudis`, `id_3D`, `ext_url`, `video_player`, `orig_URL`, `sell_it`, `copyright`)

VALUES

(".$id_vahe.", '".$gpid_demo_uus."', '".$line["naita_veebis"]."', '0', '".$line["raskus"]."', '0', '0', '0', '0', '0', '0', '', '".$line["veeb_pilt_url"]."', '".$line["veeb_pilt_url_s"]."', '".$line["nimi_est"]."', NULL, NULL, '', NULL, NULL, '".$line["probleem_est"]."', '', '', '', '".$line["vihje_est"]."', '".$line["vastus_est"]."', '".$line["lahendus_est"]."', '".$line["script"]."', '', '', '', '', '', NULL, NULL, CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '1', '', '', '')";


// echo $query1;
//$result1=mysql_query($query1);


for($i=1;$i<=6;$i++)
{
$id_vahe_valik++;
if($line["valik".$i]!=NULL or $line["pilt".$i])
{
	
echo "<br>VALIK".$i."<br>";

switch($line["liik"])
{
	
	case 6: $gpid_demo_uus = 9; break; // pildivalik -> pilt
	case 8: $gpid_demo_uus = 31; break; //valemivalik -> valem
	default: $gpid_demo_uus = 15; break; //muud valikud peaksid kõik tekstid olema-> html
	
}

if($line["liik"]==8)//kui on valemivalik, siis on asi lihtne, vaid exp_exp
{
/*	echo "<br>*******************VALEM**************<br>";
	$query6 = "INSERT INTO `fyysika_ee`.`exp_exp` (`id`, `oid1`, `oid2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`, `order1`, `order2`,`meta1`)

VALUES

(NULL, '".$id_0."', '".$line["pilt".$i]."', '".$id_0."_".$line["pilt".$i]."', '', '', '', '', '', '1', '1', '', '0','".$line["vast".$i]."');";
	echo $query6." <br><br>";
*///	$result6=mysql_query($query6);


}

else



{
//sisestame vastusevariandi kui kuue exp objekti.

$query2="INSERT INTO `fyysika_ee`.`exp` (`id`, `gpid_demo`, `naita_veebis`, `on_slave`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `misvalesti_est`, `ohud_est`, `kokku_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `id_uudis`, `id_3D`, `ext_url`, `video_player`, `orig_URL`, `sell_it`, `copyright`)

VALUES
	
(".$id_vahe_valik.", '".$gpid_demo_uus."', '".$line["naita_veebis"]."', '1', '', '0', '0', '0', '0', '0', '0', '', '".$line["veeb_pilt_url"]."', '".$line["veeb_pilt_url_s"]."', '".$id_vahe."_".$i."', NULL, NULL, '', NULL, NULL, '', '".$line["valik".$i]."', '', '', '".$line["komm".$i]."', '".$line["vast".$i]."', '', '', '', '', '', '', '', NULL, NULL, CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '1', '', '', '')";
echo $query2."<br><br>";


$query4 = "INSERT INTO `fyysika_ee`.`exp_exp` (`id`, `oid1`, `oid2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`, `order1`, `order2`, `meta1`)

VALUES

(NULL, '".$id_vahe."', '".$id_vahe_valik."', '".$id_vahe."_".$id_vahe_valik."', '', '', '', '', '', '1', '1', '', '0','".$line["vast".$i]."');";
echo $query4." <br><br>";


//$result2=mysql_query($query2);
//$result4=mysql_query($query4);



/*

// Kui on, siis tuleb loodud uue objekti juurde panna ka pilt, mis seal muidu oli
if($line["pilt".$i] and $line["liik"]==6)
{
		echo "<br>*******************PILT**************<br>";
		$query_pilt="SELECT * FROM `nupula_pildid` WHERE id=".$line["pilt".$i];
		$result_pilt=mysql_query($query_pilt);
		$line_pilt=mysql_fetch_array($result_pilt);
		
		$veeb_pilt_url = str_replace("nupula_pildid","exp_pildid",$line_pilt["url"]);
		

		$query3= "INSERT INTO `fyysika_ee`.`exp_pildid` (`id`, `oid`, `ord`, `nimi`, `url`, `veeb_pilt_url`, `veeb_pilt_url_s`, `copyright`, `allikas`, `in_veeb`, `allkiri_est`, `allkiri_eng`, `allkiri_rus`, `naita_veebis`) 
		
		VALUES
		
		(NULL, '".$id_vahe."', '', 'pilt', '".str_replace("nupula_pildid","exp_pildid",$line_pilt["url"])."', '".str_replace("nupula_pildid","exp_pildid",$line_pilt["veeb_pilt_url"])."', '".str_replace("nupula_pildid","exp_pildid",$line_pilt["veeb_pilt_url_s"])."', '', '', '1', NULL, NULL, NULL, '0');";
		
		echo $query3." <br><br>";
		$result3=mysql_query($query3);
}
*/
} //else

}//valik1

}//for
//$id_0=$id_vahe;
//$id_0++;
}//while
	echo "korras ...";
?>

	