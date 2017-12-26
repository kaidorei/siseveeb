<?
    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');  require_once 'header.php';
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database");
?><? // note that multibyte support is enabled here
$query="SELECT * FROM `exp` WHERE gpid_demo=42 AND raamatX_id=0";
$result=mysql_query($query);$id_x=20301;while($line=mysql_fetch_array($result)){
echo "<br>",$line["nimi_est"],"<br>";$query2="INSERT INTO `fyysika_ee`.`raamatX` (`id`, `pid`, `nimi_est`,`tekst_est`)VALUES('".$id_x."', '2','".$line["nimi_est"]."','".$db->real_escape_string($line["kirjeldus_est"])."')";echo $query2,"<br><br>";$result2=mysql_query($query2);$query3="UPDATE `fyysika_ee`.`exp`SET raamatX_id= '".$id_x."' WHERE id='".$line["id"]."' LIMIT 1";echo $query3,"<br><br>";$result3=mysql_query($query3);$id_x++;}
	echo "korras ...";

?>