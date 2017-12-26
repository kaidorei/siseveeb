<?
    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
	require_once 'header.php';

$query="SELECT * FROM `exp` where id=10268";
//$result=mysql_query($query);
$line=mysql_fetch_array($result);

echo "<br>",$line["nimi_est"],"<br>";
$sisend = $line["kirjeldus_est"];

$id_0=12505;
$id_0_lah=13100;


$tykid_vv=explode("teema", $sisend);
for($ii = 1; $ii<sizeof($tykid_vv); ++$ii)
{
	$tykid_vvv=explode("\yl", $tykid_vv[$ii]);
	$tykid_nimi=explode("}", $tykid_vvv[1]);
	$tykid_nimi=explode("{", $tykid_nimi[0]);
	$nimi = $tykid_nimi[1];
	echo "<br>",$ii,"*************",$nimi,"***************<br>";
	if(strpos($tykid_vvv[0], "EKSPERIMENT"))
	{
		$gpid_demo_uus=34;
	}
	else
	{
		$gpid_demo_uus= 21;
	}
	
	$tykid_vvvv=explode("\lah", $tykid_vvv[1]);
	echo $tykid_vvvv[0];
	echo "<br>--------------------------------------------------------------------------<br>";
	$ylesanne = str_replace( "M&auml;rkus:}","ssM&auml;rkus:",$tykid_vvvv[0]);

$query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `gpid_demo`, `naita_veebis`, `on_slave`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `misvalesti_est`, `ohud_est`, `kokku_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `id_uudis`, `id_3D`, `ext_url`, `video_player`, `orig_URL`, `sell_it`, `copyright`)

VALUES

(".$id_0.", '".$gpid_demo_uus."', '1', '0', '3', '0', '0', '0', '0', '0', '0', '', '', '', '".$nimi."', NULL, NULL, '', NULL, NULL, '".$db->real_escape_string(substr(strstr($ylesanne,'}'),2))."', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '1', '', '', '')";

 echo $query1,"<br><br>";
//$result1=mysql_query($query1);
$lahendus = trim($tykid_vvvv[1]);

$query2="INSERT INTO `fyysika_ee`.`raamatX` (`id`, `book_id`, `pid`, `tundide_arv`, `tykk`, `nimi_est`, `nimi_show`, `tekst`, `valjund_est`, `sissej_est`, `kokkuv_est`, `meetod_est`, `opilane_est`, `veeb_pilt_url`, `veeb_pilt_url_s`, `naita_veebis`, `deleted`, `jarjest`, `lupdate`) 
VALUES 
(".$id_0_lah.", '', '1', '0', '', '".$nimi."_lahend', '1', '".$db->real_escape_string(substr(strstr($lahendus,'}'),2,strlen($lahendus)-20))."', '', '', '', '', '', '', '', '', '0', '0', '0000-00-00 00:00:00')";

$query2="INSERT INTO `fyysika_ee`.`exp` (`id`, `gpid_demo`, `naita_veebis`, `on_slave`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `misvalesti_est`, `ohud_est`, `kokku_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `id_uudis`, `id_3D`, `ext_url`, `video_player`, `orig_URL`, `sell_it`, `copyright`)

VALUES

(".$id_0_lah.", '9', '1', '1', '3', '0', '0', '0', '0', '0', '0', '', '', '', '".$nimi."_lahend', NULL, NULL, '', NULL, NULL, '".$db->real_escape_string(substr(strstr($lahendus,'}'),2,strlen($lahendus)-20))."', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '1', '', '', '')";

echo $query2;
//$result2=mysql_query($query2);


$query4 = "INSERT INTO `fyysika_ee`.`exp_exp` (`id`, `oid1`, `oid2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`, `order1`, `order2`, `meta1`)

VALUES

(NULL, '".$id_0."', '".$id_0_lah."', '".$id_0."_".$id_0_lah."', '', '', '', '', '', '1', '1', '', '0','');";


echo $query4." <br><br>";


//$result4=mysql_query($query4);

$id_0++;
$id_0_lah++;

}


	echo "korras ...";
?>

	