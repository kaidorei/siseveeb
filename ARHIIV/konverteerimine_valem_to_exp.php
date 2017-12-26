<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
	require_once 'header.php';
?><? // note that multibyte support is enabled here 

$query="SELECT * FROM `valem` order by id";
$result=mysql_query($query);

$id_0=15000;

while($line=mysql_fetch_array($result))
{
	
$id_vahe=$id_0 + $line["id"];

echo "--------------------------------------------------------------------------<br>";

$query1 = "INSERT INTO `fyysika_ee`.`exp` (`id`, `valem_id`, `gpid_demo`, `naita_veebis`, `slideshow_id`, `on_slave`, `on_pohivara`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `image`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `tex`, `tex_html`, `tex1`, `misvalesti_est`, `ohud_est`, `kokku_est`, `kokkuprint_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `time_youtube`, `id_uudis`, `id_3D`, `ext_url`, `ext_url_eng`, `video_player`, `orig_URL`, `sell_it`, `copyright`, `aeg`, `aeg_lopp`) 

VALUES 

(".$id_vahe.", '".$line["id"]."', '31', '0', '', '0', '".$line["on_pohivara"]."', '0', '0', '0', '0', '0', '0', '0', '', NULL, NULL, '".$line["image"]."', '".$db->real_escape_string($line["nimi_est"])."', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '".$db->real_escape_string($line["tex"])."', '".$db->real_escape_string($line["tex_html"])."', '".$db->real_escape_string($line["tex1"])."', '', '', '', '', '', '', NULL, '0', CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '', '', '1', '', '', '', '', '')";

echo $query1,"<br><br>";
//$result1=mysql_query($query1);
}



$query11="SELECT * FROM `raamatX_valem` order by oid2";
//$result11=mysql_query($query11);

$ooid=0;
while($line11=mysql_fetch_array($result11))
{
$ooid = $id_0 + $line11["oid2"];	
$query2 = "INSERT INTO `fyysika_ee`.`raamatX_exp` (`id`, `book_id`, `oid1`, `oid2`, `order1`, `order2`, `meta1`, `meta2`, `width1`, `height1`, `align1`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`, `lupdate`) VALUES (NULL, '".$line11["book_id"]."', '".$line11["oid1"]."', '".$ooid."', '".$line11["order1"]."', '".$line11["order2"]."', '".$line11["meta1"]."', '".$line11["meta2"]."', '', '', '0', '', '', '', '', '', '', '0', '0', '0000-00-00 00:00:00')";

echo $query2;
//$result2=mysql_query($query2);
}//while
	echo "korras ...";
?>

	