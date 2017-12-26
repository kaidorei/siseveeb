<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 

$query="SELECT * FROM `pildid_allkirjad` WHERE domain='exp' AND show_image=1";
$result=mysql_query($query);

$id_0=3900;
while($line=mysql_fetch_array($result)){

$arr_fail = explode( ".",$line["fail"]);

$query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `gpid_demo`, `naita_veebis`, `on_slave`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `seletus_est`, `seletus_eng`, `seletus_rus`, `misvalesti_est`, `ohud_est`, `kokku_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `id_uudis`, `id_3D`, `ext_url`, `video_player`, `orig_URL`, `sell_it`, `copyright`) 

VALUES 

(".$id_0.", '9', '0', '1', '0', '0', '0', '0', '0', '0', '', 'media%2Fexp_pildid%2F".$arr_fail[0]."v.jpg', 'media%2Fexp_pildid%2F".$arr_fail[0]."s.jpg', '".$id_0."', NULL, NULL, '".$line["allkiri"]."', NULL, NULL, '', '', '', '', '', '', '', '', NULL, NULL, CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '1', '', '', 'FYYSIKA.EE');";

$query2 = "INSERT INTO `fyysika_ee`.`exp_exp` (`id`, `oid1`, `oid2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`, `order1`, `order2`)
VALUES

(NULL, '".$line["oid"]."', '".$id_0."', '".$id_0."', '', '".$line["allkiri"]."', '', '".$line["allkiri"]."', '', '".$line["show_image"]."', '".$line["show_image"]."', '".$line["ord"]."', '0');";

$query3= "INSERT INTO `fyysika_ee`.`exp_pildid` (`id`, `oid`, `ord`, `nimi`, `url`, `veeb_pilt_url`, `veeb_pilt_url_s`, `copyright`, `allikas`, `in_veeb`, `allkiri_est`, `allkiri_eng`, `allkiri_rus`, `naita_veebis`) 

VALUES

(NULL, '".$id_0."', '".$line["ord"]."', 'pilt', 'media%2Fexp_pildid%2F".$arr_fail[0].".jpg', 'media%2Fexp_pildid%2F".$arr_fail[0]."v.jpg', 'media%2Fexp_pildid%2F".$arr_fail[0]."s.jpg', '', '', '1', NULL, NULL, NULL, '0');";

echo $query1." <br><br>";
echo $query2." <br><br>";
echo $query3." <br><br>";
//$result1=mysql_query($query1);
//$result2=mysql_query($query2);
//$result3=mysql_query($query3);
	$i=5;
/*	while($i<35)
	{
		$query2="INSERT INTO `moodle_nina`.`mdl_user_info_data` (
		`id` ,
		`userid` ,
		`fieldid` ,
		`data` 
		)
		VALUES (
		NULL , '".$post_id."', '".$i."', '".$line[4+$i]."'
		)";
		echo $query2," <br><br>";
		$result2=mysql_query($query2);
		$i++;
	}

	$query2="INSERT INTO `moodle_nina`.`mdl_user_info_data` (
	`id` ,
	`userid` ,
	`fieldid` ,
	`data` 
	)
	VALUES (
	NULL , '".$post_id."', '37', '".$line["klass"]."'
	)";
//	echo $query2," <br><br>";
	$result2=mysql_query($query2);

	$query2="INSERT INTO `moodle_nina`.`mdl_user_info_data` (
	`id` ,
	`userid` ,
	`fieldid` ,
	`data` 
	)
	VALUES (
	NULL , '".$post_id."', '38', '".$line["adr_too"]."'
	)";
//	echo $query2," <br><br>";
	$result2=mysql_query($query2);
*/
$id_0++;
}
	echo "korras ...";
?>

	