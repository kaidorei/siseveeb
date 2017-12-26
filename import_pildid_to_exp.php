<?
    /* Connecting, selecting database */
//	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
//	require_once 'header.php';
	require_once 'header.php';

$query="SELECT * FROM `raamatX_exp` WHERE book_id=44 ";
$result=mysql_query($query);
$id_0 = 35900;
while($line=mysql_fetch_array($result))
{
	$query1="SELECT * FROM `exp` WHERE id=".$line["oid2"];
	$result1=mysql_query($query1);
	$line1=mysql_fetch_array($result1)	;
	echo "<br><h2>",$line1["nimi_est"],": ",$line1["id"],"</h2><br>";
if($line1["veeb_pilt_url"])
{
	$query2="SELECT * FROM `exp_pildid` WHERE oid=".$line["oid2"]." ORDER BY id DESC";
	$result2=mysql_query($query2);
	$line2=mysql_fetch_array($result2)	;
	
	
$query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `pid`, `raamatX_id`, `valem_id`, `gpid_demo`, `naita_veebis`, `slideshow_id`, `on_slave`, `on_pohivara`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `image`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `tex`, `tex_html`, `tex1`, `misvalesti_est`, `ohud_est`, `kokku_est`, `kokkuprint_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `time_youtube`, `time_tegemine`, `id_uudis`, `id_3D`, `link`, `ext_url`, `ext_url_eng`, `video_player`, `orig_URL`, `sell_it`, `copyright`, `aeg`, `aeg_lopp`) 
VALUES 
(".$id_0.", '0', '', '', '9', '1', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '".$db->real_escape_string($line1["veeb_pilt_url"])."', '".$db->real_escape_string($line1["veeb_pilt_url_s"])."', '', '".$db->real_escape_string($line1["nimi_est"])." joonis', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '0', CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '', '', '', '', '1', '', '', '', '', '')";

echo $query1,"<br><br>";
//$r=mysql_query($query1);

$query2="INSERT INTO `fyysika_ee`.`exp_pildid` (`id`, `oid`, `ord`, `nimi`, `url`, `veeb_pilt_url`, `veeb_pilt_url_s`, `copyright`, `allikas`, `in_veeb`, `allkiri_est`, `allkiri_eng`, `allkiri_rus`, `naita_veebis`) 
VALUES 
(NULL, '".$id_0."', '0', 'Pilt', '".$line2["url"]."', '".$line2["veeb_pilt_url"]."', '".$line2["veeb_pilt_url_s"]."', '', '', '1', NULL, NULL, NULL, '0')";
echo $query2,"<br><br>";
//$r=mysql_query($query2);

$query3="INSERT INTO `fyysika_ee`.`exp_exp` (`id`, `oid1`, `oid2`, `meta1`, `meta2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`, `order1`, `order2`) 
VALUES 
(NULL, '".$line1["id"]."', '".$id_0."', '', '', '', '', '', '', '', '', '1', '1', '100', '0')";
echo $query3,"<br><br>";
//$r=mysql_query($query3);

}
$id_0++;
}
	echo "korras ...";
?>

	