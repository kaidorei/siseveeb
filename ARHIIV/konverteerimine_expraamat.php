<?
    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
	require_once 'header.php';

$query="SELECT * FROM `exp` WHERE gpid_demo=15";
$result=mysql_query($query);



$id_pilt=27000;
$id_raamat=7100;

while($line=mysql_fetch_array($result))
{
	   if($line["on_slave"]==0)
			{
	
	
	echo "<br><h2>",$line["nimi_est"],": ",$line["id"],"</h2><br>";
	$valjund = 	$line["kirjeldus_est"]."".$line["seletus_est"];	

	//asendan pildid asjad ...
		$tykid_uus_3 = NULL;
		$tykid_vv=explode("[img]", $valjund);
		$tykid_uus_3=$tykid_vv[0];
		$img_id=NULL;
		$img_align=NULL;
		$img_width=NULL;
		$img_height=NULL;
$count_sees=0;
		for($ii = 1; $ii < sizeof($tykid_vv); ++$ii)
		{
			$tykid_vv3=explode("[/img]", $tykid_vv[$ii]);
			//echo $tykid_vv2[0]," ";
			
// Eraldame välja align, laius, kõrgus
			$tykid_vv4=explode(",", $tykid_vv3[0]);
			$img_id=$tykid_vv4[0];
			$img_align=$tykid_vv4[1];
			$img_width=$tykid_vv4[2];
			$img_height=$tykid_vv4[3];
			

			$query_pilt="SELECT * FROM exp_pildid WHERE id=".$img_id." LIMIT 1";
			//echo $query_pilt;
			$result_pilt=mysql_query($query_pilt);
			$line_pilt=mysql_fetch_array($result_pilt);
			//echo $line_valem["tex"];
			//echo preg_replace('#\@\{(.*)\}\@#', 'kaido',$tykid_vv[$ii]);
	// hädavariant igasugu gif'ide jms, kuna veebipildi tegemise aken ei oska nende failidega midagi mõistlikku peale hakata. Kui ei ole veebipilti, siis kasutan originaali.

			if($line_pilt["veeb_pilt_url_s"])
			{
			$img_file=$line_pilt["veeb_pilt_url_s"];
			}
			else
			{
			$img_file=$line_pilt["url"];
			}
		
					
// teen uue pildiobjekti ...
$query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `pid`, `raamatX_id`, `valem_id`, `gpid_demo`, `naita_veebis`, `slideshow_id`, `on_slave`, `on_pohivara`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `image`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `tex`, `tex_html`, `tex1`, `misvalesti_est`, `ohud_est`, `kokku_est`, `kokkuprint_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `time_youtube`, `time_tegemine`, `id_uudis`, `id_3D`, `link`, `ext_url`, `ext_url_eng`, `video_player`, `orig_URL`, `sell_it`, `copyright`,  `aeg`, `aeg_lopp`) 
VALUES 
(".$id_pilt.", '0', '0', '', '9', '1', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '".$line_pilt["veeb_pilt_url"]."', '".$line_pilt["veeb_pilt_url_s"]."', '', '".$line["nimi_est"]."', NULL, NULL, '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '0', CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '', '', '', '', '1', '', '', '', '', '')";

//echo $query1,"<br><br>";
//$result1=mysql_query($query1);


$query_pilt1="INSERT INTO `fyysika_ee`.`exp_pildid` (`id`, `oid`, `ord`, `nimi`, `url`, `veeb_pilt_url`, `veeb_pilt_url_s`, `copyright`, `allikas`, `in_veeb`, `allkiri_est`, `allkiri_eng`, `allkiri_rus`, `naita_veebis`) 
VALUES 
(NULL, '".$id_pilt."', '0', 'pilt', '".$line_pilt["url"]."', '".$line_pilt["veeb_pilt_url"]."', '".$line_pilt["veeb_pilt_url_s"]."', '', '', '1', NULL, NULL, NULL, '0')";

echo $query_pilt1,"<br><br>";
//$result_pilt1=mysql_query($query_pilt1);


$query2="INSERT INTO `fyysika_ee`.`raamatX_exp` (`id`, `book_id`, `oid1`, `oid2`, `order1`, `order2`, `meta1`, `meta2`, `width1`, `height1`, `align1`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`, `lupdate`) 
VALUES 
(NULL, '', '".$id_raamat."', '".$id_pilt."', '', '', '', '', '', '', '0', '', '', '', '', '', '', '0', '0', '0000-00-00 00:00:00')";
echo $query2,"<br><br>";
//$result2=mysql_query($query2);

		$tykid_uus_3= $tykid_uus_3."[{[".$id_pilt."]}]";
		$tykid_uus_3= $tykid_uus_3."".$tykid_vv3[1];
		$id_pilt++;
		$count_sees++;
		}
	$valjund = 	$tykid_uus_3;
//	echo $valjund,"<br>";

if($count_sees==0)
{
	$valjund="<p>[{[ID]}]</p>".$valjund;
}	
	
$query_raamat="INSERT INTO `fyysika_ee`.`raamatX` (`id`, `book_id`, `open_exp`, `pid`, `tundide_arv`, `tykk`, `nimi_est`, `nimi_show`, `tekst`, `valjund_est`, `sissej_est`, `kokkuv_est`, `meetod_est`, `opilane_est`, `veeb_pilt_url`, `veeb_pilt_url_s`, `naita_veebis`, `deleted`, `jarjest`, `lupdate`) 
VALUES 
(".$id_raamat.", '', '', '2', '0', '', '".$line["nimi_est"]."', '1', '".$valjund."', '', '', '', '', '', '', '', '', '0', '0', '0000-00-00 00:00:00');";
echo $query_raamat,"<br><br>";
echo "PILTE SAI SISSE:".$count_sees,"<br><br>";
//$result_raamat=mysql_query($query_raamat);


$query_link="UPDATE exp set raamatX_id=".$id_raamat." WHERE id=".$line["id"]."";
echo $query_link,"<br><br>";
//$result_link=mysql_query($query_link);

$id_raamat++;
	}
}


	echo "korras ...";
?>

	