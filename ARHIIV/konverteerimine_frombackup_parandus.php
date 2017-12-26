<?
    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
	require_once 'header.php';

$query="SELECT * FROM `expbackup2` WHERE nimi_est='Nimetu' and gpid_demo=31";
$result=mysql_query($query);



while($line=mysql_fetch_array($result))
{
	
$query1="UPDATE `fyysika_ee`.`exp` SET tex='".$db->real_escape_string($line["tex"])."' WHERE id=".$line["id"]." LIMIT 1";

echo $query1,"<br><br>";
//$result1=mysql_query($query1);

	
}


	echo "korras ...";
?>

	