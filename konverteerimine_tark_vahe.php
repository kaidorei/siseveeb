<?
    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database");
?><? // note that multibyte support is enabled here
$query="SELECT * FROM `exp` WHERE gpid_demo=42 AND raamatX_id=0";
$result=mysql_query($query);
echo "<br>",$line["nimi_est"],"<br>";
	echo "korras ...";

?>