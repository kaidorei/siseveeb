<?

    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
	require_once 'header.php';

    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")

     	or die("Could not connect");

     print "Connected successfully";

    mysql_select_db("fyysika_ee") or die("Could not select database"); 

?><? // note that multibyte support is enabled here 



$query="SELECT * FROM `kool` order by id";

$result=mysql_query($query);



$id_0=212600;

while($line=mysql_fetch_array($result)){

	

$id_vahe=$id_0;



echo "--------------------------------------------------------------------------<br>";


$query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `gpid_demo`, `naita_veebis_est`, `on_slave`, `nimi_est`,`ext_id`,`owner_user_id`)
VALUES
(".$id_0.",'51','0','0','".$db->real_escape_string($line["nimi"])."','".$line["id"]."','25')";

echo $query1;

//$result1=mysql_query($query1);






//$id_0=$id_vahe;

$id_0++;

}//while

	echo "korras ...";

?>



	