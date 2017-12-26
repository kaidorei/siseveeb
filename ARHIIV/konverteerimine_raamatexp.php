<?
    /* Connecting, selecting database */
//	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
//	require_once 'header.php';

$query="SELECT * FROM `raamatX` WHERE pid=2 ORDER by id";
$result=mysql_query($query);


while($line=mysql_fetch_array($result))
{
	
	echo "<br><h2>",$line["nimi_est"],": ",$line["id"],"</h2><br>";
	echo $valjund,"<br>";
	
	
$query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `pid`, `raamatX_id`, `valem_id`, `gpid_demo`, `naita_veebis`, `slideshow_id`, `on_slave`, `on_pohivara`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `image`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `tex`, `tex_html`, `tex1`, `misvalesti_est`, `ohud_est`, `kokku_est`, `kokkuprint_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `time_youtube`, `time_tegemine`, `id_uudis`, `id_3D`, `link`, `ext_url`, `ext_url_eng`, `video_player`, `orig_URL`, `sell_it`, `copyright`, `aeg`, `aeg_lopp`) 
VALUES 
(NULL, '0', '".$line["id"]."', '', '43', '1', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '', '', '".($line["nimi_est"])."', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '0', CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '', '', '', '', '1', '', '', '', '', '')";

echo $query1,"<br><br>";
//$result4=mysql_query($query1);

$id_0++;
}
	echo "korras ...";
?>

	