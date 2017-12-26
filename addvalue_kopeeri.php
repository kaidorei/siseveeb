<?
		mb_internal_encoding('UTF-8');		require_once 'header.php';	$link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")    	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database");

	  $id_from=$_GET["id_from"];	  $id_to=$_GET["id_to"];
	  $dom=$_GET["domain"];
	  $sel=$_GET["sel"];

//Kopeerin alajaotuse
$query22="SELECT * FROM raamatX where id=".$id_from;
echo "<br>".$query22."<br>";
$result22=mysql_query($query22);
$line22=mysql_fetch_array($result22);
$query23 = "INSERT INTO `raamatX` (`id`, `book_id`, `open_exp`, `open_meta`, `pid`, `tundide_arv`, `nimi_est`, `nimi_eng`, `nimi_rus`, `nimi_show`, `tekst_est`, `tekst_eng`, `tekst_rus`, `meetod_est`, `meetod_eng`, `meetod_rus`, `opilane_est`, `opilane_eng`, `opilane_rus`, `veeb_pilt_url`, `veeb_pilt_url_s`, `naita_veebis`, `deleted`, `jarjest`, `lupdate`) VALUES (NULL, '77', '', '0', '".$line22["pid"]."', '0', '".$db->real_escape_string($line22["nimi_est"])."_koopia', '".$db->real_escape_string($line22["nimi_eng"])."', '".$db->real_escape_string($line22["nimi_rus"])."', '1', '".$db->real_escape_string($line22["tekst_est"])."', '".$db->real_escape_string($line22["nimi_eng"])."', '".$db->real_escape_string($line22["nimi_rus"])."', '', '', '', '', '', '', '', '', '0', '0', '0', '0000-00-00 00:00:00.000000')";
echo "<br>".$query23."<br>";
$tmp=mysql_query($query23);
$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
$raamatX_uus=$tmp["last_insert_id()"];

//Teen vastava exp objektidele

$query55 = "INSERT INTO `exp` (`id`, `origin_id`, `owner_user_id`, `raamatX_id`, `ext_id`, `gpid`, `gpid_demo`, `terms`, `lemmad`, `lemmad_title`, `naita_veebis_est`, `naita_veebis_eng`, `naita_veebis_rus`, `on_slave`, `raskus`, `veeb_pilt_url`, `veeb_pilt_url_s`, `veeb_pilt_w`, `veeb_pilt_h`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `script`, `tex`, `staatus_id`, `lupdate`, `viimane_uuendus`, `time_duration`, `copyright`, `aeg`, `aeg_lopp`) VALUES (NULL, '0', '25', '".$raamatX_uus."', '', '', '43', '', NULL, NULL, '0', '0', '0', '0', '0', NULL, NULL, '0', '0', '".$db->real_escape_string($line22["nimi_est"])."_koopia', NULL, NULL, '', NULL, NULL, '', '', '0', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000', '', '', '', '')";

echo "<br>".$query55."<br>";
mysql_query($query55);

//Kopeerin seose exp objektidele

$query2="SELECT * FROM raamatX_exp where oid1=".$id_from;//			echo $query2,"<br>";
$result2=mysql_query($query2);
while($line2=mysql_fetch_array($result2))
{
		$query="INSERT INTO raamatX_exp (oid1,oid2,meta_est,title_est) VALUES (\"".$raamatX_uus."\",\"".$line2["oid2"]."\",\"".$db->real_escape_string($line2["meta_est"])."\",\"".$db->real_escape_string($line2["title_est"])."\")";
		echo $query,"<br>";
		$result=mysql_query($query);
}
?>
