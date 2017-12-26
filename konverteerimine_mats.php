<?
    /* Connecting, selecting database */
mb_internal_encoding('UTF-8');require_once 'header.php';
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database");
?><? // note that multibyte support is enabled here

echo "<br>";
$query="SELECT sisu FROM `raamat` where id=37";$result=mysql_query($query);
$line=mysql_fetch_array($result);
$sisend = $line["sisu"];

$id_0=12505;$id_0_lah=3200;
//echo $sisend;
$tykid_vv=preg_split("/<p>(.+)<\/p>/", $sisend,-1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);//print_r($tykid_vv);
for($ii = 0; $ii<sizeof($tykid_vv); ++$ii){
  //echo $ii." - ".$tykid_vv[$ii]."<br>";
  $tykid_count=preg_split("/(.+)<strong>\si\s<.strong>(.+)<strong> v <.strong>(.+)/", $tykid_vv[$ii],-1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
  //echo count($tykid_count[1]);
if(strlen($tykid_count[1])>0)
{
  echo $tykid_count[0]." ".$tykid_count[1]." ".$tykid_count[2]."<br>";
  //print_r($tykid_count);
  $tykid_count_j=preg_split("/(.+)<strong>\si\s<.strong>(.+)<strong> v <.strong>(.+)/", $tykid_vv[$ii+2],-1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
  if(!strlen($tykid_count_j[1]))
  {
    echo $tykid_vv[$ii+2]."<br>";
  }
  echo "---------------------------------------------------------------------------------------<br>";
}



$query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `gpid_demo`, `naita_veebis`, `on_slave`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `misvalesti_est`, `ohud_est`, `kokku_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `id_uudis`, `id_3D`, `ext_url`, `video_player`, `orig_URL`, `sell_it`, `copyright`)
VALUES
(".$id_0.", '".$gpid_demo_uus."', '1', '0', '3', '0', '0', '0', '0', '0', '0', '', '', '', '".$nimi."', NULL, NULL, '', NULL, NULL, '".$db->real_escape_string(substr(strstr($ylesanne,'}'),2))."', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '1', '', '', '')";
 //echo $query1,"<br><br>";
//$result1=mysql_query($query1);
$lahendus = trim($tykid_vvvv[1]);
$query2="INSERT INTO `fyysika_ee`.`raamatX` (`id`, `book_id`, `pid`, `tundide_arv`, `tykk`, `nimi_est`, `nimi_show`, `tekst`, `valjund_est`, `sissej_est`, `kokkuv_est`, `meetod_est`, `opilane_est`, `veeb_pilt_url`, `veeb_pilt_url_s`, `naita_veebis`, `deleted`, `jarjest`, `lupdate`)
VALUES
(".$id_0_lah.", '', '1', '0', '', '".$nimi."_lahend', '1', '".$db->real_escape_string(substr(strstr($lahendus,'}'),2,strlen($lahendus)-20))."', '', '', '', '', '', '', '', '', '0', '0', '0000-00-00 00:00:00')";
//echo $query2;
//$result2=mysql_query($query2);$query4 = "INSERT INTO `fyysika_ee`.`raamatX_exp` (`id`, `oid1`, `oid2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`, `order1`, `order2`, `meta1`)
VALUES
(NULL, '".$id_0_lah."', '".$id_0."', '".$id_0."_".$id_0_lah."', '', '', '', '', '', '1', '1', '', '0','');";
//echo $query4." <br><br>";
//$result4=mysql_query($query4);
$id_0++;

$id_0_lah++;}
	echo "korras ...";
?>
