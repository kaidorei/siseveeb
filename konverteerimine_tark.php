<?
    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');  require_once 'header.php';
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database");
?><? // note that multibyte support is enabled here
$query="SELECT * FROM `raamatX` where id=19033";
$result=mysql_query($query);$line=mysql_fetch_array($result);
echo "<br>",$line["nimi_est"],"<br>";$sisend = $line["tekst_est"];
$id_0=226200;$id_0_lah=20200;
$id__=105200;

$tykid_vv=explode("<p>", $sisend);for($ii = 1; $ii<sizeof($tykid_vv); ++$ii)
{

	$tykid_nimi=explode("</strong>", $tykid_vv[$ii]);  $nimi = str_replace("<strong>","",$tykid_nimi[0]);
  $_tekst = str_replace("</p>","",$tykid_vv[$ii]);
  $_tekst = str_replace("&nbsp;","",$_tekst);
  $_tekst = str_replace("\\r\\n\\r\\n","",$_tekst);
	echo "<br>",$ii,"*************",$nimi,"***************<br>";
	$gpid_demo_uus=42;

	$tykid_vvvv=explode("\lah", $tykid_vvv[1]);
	echo $tykid_vvvv[0];
	echo "<br>--------------------------------------------------------------------------<br>";
	$ylesanne = str_replace( "M&auml;rkus:}","ssM&auml;rkus:",$tykid_vvvv[0]);

$query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `raamatX_id`, `gpid_demo`,  `nimi_est`,`kirjeldus_est`, `owner_user_id`)VALUES
(".$id_0.",'".$id_0_lah."', '".$gpid_demo_uus."', '".$db->real_escape_string($nimi)."','".$db->real_escape_string($_tekst)."','25')";

 echo $query1,"<br><br>";//$result1=mysql_query($query1);

$lahendus = trim($tykid_vvvv[1]);$query2="INSERT INTO `fyysika_ee`.`raamatX` (`id`, `book_id`, `pid`, `nimi_est`,`tekst_est`)
VALUES
(".$id_0_lah.", '55', '2','".$nimi."','".$db->real_escape_string($_tekst)."')";
echo $query2,"<br><br>";

//$result2=mysql_query($query2);
$query4 = "INSERT INTO `fyysika_ee`.`raamatX_exp` (`id`, `oid1`, `oid2`, `book_id`)VALUES
('".$id__."', '19030', '".$id_0."', '55');";
echo $query4." <br><br>";
//$result4=mysql_query($query4);

$id_0++;
$id_0_lah++;$id__++;}
	echo "korras ...";

?>