<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 


$query="SELECT * FROM nupula WHERE liik=4";
$result=mysql_query($query);
$exp_id=3700;

while($line=mysql_fetch_array($result)){
if($line["nimi_est"])
{
$query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `gpid_demo`, `naita_veebis`, `veeb_ok`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_est_check`, `kirjeldus_eng`, `kirjeldus_rus`, `seletus_est`, `seletus_est_check`, `seletus_eng`, `seletus_rus`, `misvalesti_est`, `misvalesti_est_check`, `ohud_est`, `ohud_est_check`, `hange_est`, `hange_est_check`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `id_uudis`, `ext_url`, `video_player`, `orig_URL`, `sell_it`, `copyright`) VALUES (NULL, '15', '1', '0', '0', '0', '0', '0', '0', '0', '', NULL, NULL, '".$line["nimi_est"]."', NULL, NULL, '".$line["probleem_est"]."', '', NULL, NULL, '".$line["vastus_est"]."', '', '', '', '', '', '', '', '', '', '', NULL, NULL, CURRENT_TIMESTAMP, '', '', '', '', '', '', '1', '', '', 'Wiley')";

echo $query1,"<br><br>";

//$result1=mysql_query($query1);
//Seoste kopeerimine?

$query2="INSERT INTO `fyysika_ee`.`isik_kool` (`id`, `oid1`, `oid2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`) VALUES (NULL, '".$isik_id."', '".$line["id"]."', '', '', '', '', '', 'direktor')";
//$result2=mysql_query($query2);
echo $query2,"<br><br>";

}
$isik_id++;
?><hr> <? }
?>

	