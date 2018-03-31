<?

    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
	require_once 'header.php';

    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")

     	or die("Could not connect");

     print "Connected successfully";

    mysql_select_db("fyysika_ee") or die("Could not select database");

?><? // note that multibyte support is enabled here



$query="SELECT * FROM `exp` where gpid_demo=44 order by id";
$result=mysql_query($query);
$id_0 = 1;
while($line=mysql_fetch_array($result)){
$query1="INSERT INTO `fyysika_ee`.`raamatX_exp` (`oid1`, `oid2`,`book_id`, `sort_order`)
VALUES
('37396',".$line["id"].",74,".$id_0.")";

echo $query1."<br>";

//$result1=mysql_query($query1);
//$id_0=$id_vahe;
$id_0++;
}//while

echo "korras ...";

?>
