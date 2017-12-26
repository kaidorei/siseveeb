<?
    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
	require_once 'header.php';

$query="SELECT * FROM `raamatX` WHERE `nimi_est` LIKE '%_lahend%' and pid=3";
//$result=mysql_query($query);


echo "<br>",$line["nimi_est"],"<br>";

$id_0=18900;

while($line=mysql_fetch_array($result))
{

$query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `gpid_demo`, `naita_veebis`, `on_slave`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `misvalesti_est`, `ohud_est`, `kokku_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `id_uudis`, `id_3D`, `ext_url`, `video_player`, `orig_URL`, `sell_it`, `copyright`)

VALUES

(".$id_0.", '15', '1', '0', '3', '0', '0', '0', '0', '0', '0', '', '', '', '".$line["nimi_est"]."', NULL, NULL, '".$db->real_escape_string(str_replace('\celsius','^{\circ}',str_replace('\SI',"",$line["tekst"])))."', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '1', '', '', '')";

 echo $query1,"<br><br>";
//$result1=mysql_query($query1);

$query2="UPDATE raamatX set exp_id=".$id_0." WHERE id=".$line["id"];

echo $query2;
//$result2=mysql_query($query2);

$query33="SELECT * FROM `raamatX_exp` WHERE oid1=".$line["id"]." LIMIT 1";
//$result33=mysql_query($query33);
$line33=mysql_fetch_array($result33);




$query4 = "INSERT INTO `fyysika_ee`.`exp_exp` (`id`, `oid1`, `oid2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`, `order1`, `order2`, `meta1`)

VALUES

(NULL, '".$line33["oid2"]."', '".$id_0."', '', '', '', '', '', '', '1', '1', '', '0','');";


echo $query4." <br><br>";


//$result4=mysql_query($query4);

$id_0++;
}


	echo "korras ...";
?>

	