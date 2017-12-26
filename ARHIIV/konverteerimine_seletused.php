<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
	require_once 'header.php';
?><? // note that multibyte support is enabled here 

$query="SELECT * FROM `exp` WHERE gpid_demo = 9 and length(seletus_est)>1";
$result=mysql_query($query);

$id_0=31100;
$id_X=8400;

while($line=mysql_fetch_array($result))
{
$lugu = "<p>[{[".$line["id"]."]}]</p>".$line["kirjeldus_est"]."".$line["seletus_est"];

echo "<hr>".$lugu."<br><br>";


//echo "--------------------------------------------------------------------------<br>";
// teen raamatX objekti

$query11 = "INSERT INTO `fyysika_ee`.`raamatX` (
 `id` ,
`book_id` ,
`open_exp` ,
`pid` ,
`tundide_arv` ,
`tykk` ,
`nimi_est` ,
`nimi_show` ,
`tekst` ,
`valjund_est` ,
`sissej_est` ,
`kokkuv_est` ,
`meetod_est` ,
`opilane_est` ,
`veeb_pilt_url` ,
`veeb_pilt_url_s` ,
`naita_veebis` ,
`deleted` ,
`jarjest` ,
`lupdate` 
)
VALUES (
 ".$id_X." , '', '', '2', '', '', '".$db->real_escape_string($line["nimi_est"])."', '1', '".$lugu."', '', '', '', '', '', '', '', '', '0', '0', '0000-00-00 00:00:00'
)";


// teen vastava ptk objekti

echo $query11,"<br><br>";
//$result11=mysql_query($query11);

// Panen värgi raamatX külge

$query12="INSERT INTO `fyysika_ee`.`raamatX_exp` (
 `id` ,
`book_id` ,
`oid1` ,
`oid2` ,
`order1` ,
`order2` ,
`meta1` ,
`meta2` ,
`width1` ,
`height1` ,
`align1` ,
`title1` ,
`title2` ,
`sisse1` ,
`sisse2` ,
`sisu1` ,
`sisu2` ,
`naita_veebis1` ,
`naita_veebis2` ,
`lupdate` 
)
VALUES (
 NULL , '', '".$id_X."', '".$line["id"]."', '', '', '', '', '', '', '0', '', '', '', '', '', '', '0', '0', '0000-00-00 00:00:00'
);
";

echo $query12."<br><br>";
//$result12=mysql_query($query12);

$query1 = "INSERT INTO `fyysika_ee`.`exp` (`id`, `raamatX_id`, `valem_id`, `gpid_demo`, `naita_veebis`, `slideshow_id`, `on_slave`, `on_pohivara`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `image`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `tex`, `tex_html`, `tex1`, `misvalesti_est`, `ohud_est`, `kokku_est`, `kokkuprint_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `time_youtube`, `id_uudis`, `id_3D`, `ext_url`, `ext_url_eng`, `video_player`, `orig_URL`, `sell_it`, `copyright`, `aeg`, `aeg_lopp`) 

VALUES 

(".$id_0.", '".$id_X."', '', '43', '1', '', '0', '', '0', '0', '0', '0', '0', '0', '0', '', '".$line["veeb_pilt_url"]."','".$line["veeb_pilt_url_s"]."', '', '".$db->real_escape_string($line["nimi_est"])."', NULL, NULL, '".$db->real_escape_string($line["kirjeldus_est"])."', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '0', CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '".$line["link_valja"]."', '', '1', '', '', '', '".$line["aeg"]."', '".$line["aeg_lopp"]."')";

echo $query1,"<br><br>";
//$result1=mysql_query($query1);

// teen seletus_est välja puhtaks

$query23="UPDATE exp set seletus_est='' where ";
echo $query23."<br><br>";
//$result23=mysql_query($query23);



$id_0++;
$id_X++;
}

// Panen pildid külge ...

/*$query11="SELECT * FROM `krono_pildid` order by oid";
$result11=mysql_query($query11);

$ooid=0;
while($line11=mysql_fetch_array($result11))
{
$ooid = $id_0 + $line11["oid"];	
$query2 = "INSERT INTO `fyysika_ee`.`exp_pildid` (`id`, `oid`, `ord`, `nimi`, `url`, `veeb_pilt_url`, `veeb_pilt_url_s`, `copyright`, `allikas`, `in_veeb`, `allkiri_est`, `allkiri_eng`, `allkiri_rus`, `naita_veebis`) 
VALUES 
(NULL, '".$ooid."', '0', 'nimi_krono', '".$line11["url"]."', '', '', '', '', '1', NULL, NULL, NULL, '0');";

//echo $query2;
//$result2=mysql_query($query2);

}//while
*/	echo "korras ...";
?>

	