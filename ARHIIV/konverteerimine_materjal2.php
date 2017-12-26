<?
    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
	require_once 'header.php';

$query="SELECT * FROM `raamatX` WHERE book_id=16 and pid=1";
$result=mysql_query($query);



while($line=mysql_fetch_array($result))
{
	echo $line["nimi_est"]." --- ".$line["id"]."<br>";
	$sisu='';
$query1="SELECT * FROM `raamatX_raamatX` WHERE oid1=".$line["id"]." order by order1 LIMIT 10";
$result1=mysql_query($query1);
while($line1=mysql_fetch_array($result1))
{

/*$query4="SELECT * FROM `raamatX` WHERE id=".$line1["oid2"]." LIMIT 1";
$result4=mysql_query($query4);
$line4=mysql_fetch_array($result4);
//echo "-- ".$line4["nimi_est"]."<br>";
$sisu=$sisu."<p><strong>".$line4["nimi_est"]."</strong></p>".$line4["tekst"];
*/
/*$query5="SELECT * FROM `raamatX_exp` WHERE oid1=".$line4["id"]." order by order1";
$result5=mysql_query($query5);
while($line5=mysql_fetch_array($result5))
{
	$query7="UPDATE `fyysika_ee`.`raamatX_exp` SET oid1='".$line["id"]."' WHERE id=".$line5["id"]." LIMIT 1";
	echo $query7."<br><br>";
//		$result7=mysql_query($query7);
	
}*/

$query9="delete FROM `raamatX` WHERE id=".$line1["oid2"]." LIMIT 1";
$result9=mysql_query($query9);
echo $query9."<br>";
//$query8="delete FROM `raamatX_raamatX` WHERE id=".$line1["id"]." and oid2=".$line1["oid2"]." LIMIT 1";
echo $query8."<br>";
//$result8=mysql_query($query8);

	
}
	$query2="UPDATE `fyysika_ee`.`raamatX` SET tekst='".$sisu."' WHERE id=".$line["id"]." LIMIT 1";
		
//		echo $query2,"<br><br>";
//		$result2=mysql_query($query2);
//echo $sisu;	
}


	echo "korras ...";
?>

	