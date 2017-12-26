<?

    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
	require_once 'header.php';

    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")

     	or die("Could not connect");

     print "Connected successfully";

    mysql_select_db("fyysika_ee") or die("Could not select database"); 

?><? // note that multibyte support is enabled here 



$query="SELECT * FROM `raamatX_raamatX` WHERE book_id=75 and id>8844 order by id";

$result=mysql_query($query);


$id_0=18400;

while($line=mysql_fetch_array($result)){
	
//teeme uue pid=1 objekti
$query4="SELECT * FROM `raamatX` WHERE id='".$line["oid2"]."' LIMIT 1";
$result4=mysql_query($query4);
$line4=mysql_fetch_array($result4);

$query1="INSERT INTO `fyysika_ee`.`raamatX` (`id`, `nimi_est`,`pid`,`book_id`)
VALUES
(".$id_0.",'".$db->real_escape_string($line4["nimi_est"])."','1','75')";
echo $query1."<br>";
//$result1=mysql_query($query1);

$query6="INSERT INTO `fyysika_ee`.`raamatX_raamatX` (`oid1`, `oid2`,`book_id`)
VALUES
('16644','".$id_0."','75')";
echo $query6."<br>";
//$result6=mysql_query($query6);

$query2="UPDATE `fyysika_ee`.`raamatX_raamatX` SET oid1 = '".$id_0."' WHERE id='".$line["id"]."'";
echo $query2."<br>";
//$result2=mysql_query($query2);


//$result1=mysql_query($query1);


//$id_0=$id_vahe;

$id_0++;

}//while

echo "korras ...";

?>



	