<?
///////////////////////////////////////////////////////////////////
// KOOD exp tabeli kirjete kokku panemiseks dict tabelite järgi
///////////////////////////////////////////////////////////////////

    /* Connecting, selecting database */

    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")

     	or die("Could not connect");

     print "Connected successfully <br>";

    mysql_select_db("fyysika_ee") or die("Could not select database"); 

?><? // note that multibyte support is enabled here 

	require_once 'header.php';

// Kaugseire inglise-eesti 13973

$query1="select * from pohivara where on_pohivara=1"; //<=  

$result1=mysql_query($query1);
$id1=0;
while($line1=mysql_fetch_array($result1))
{ 
	$query2="select * from exp where nimi_est like '".$line1["nimi_est"]."' AND gpid_demo=38"; //<=  
	$result2=mysql_query($query2);
	while($line2=mysql_fetch_array($result2))
	{
		echo "<hr>";
		echo $line1["nimi_est"]." (".$line2[0].")<br>";
		$query_temp2="INSERT INTO `fyysika_ee`.`raamatX_exp` (`oid1`,`oid2`,`book_id`) VALUES ('13974','".$line2["id"]."',69)";
		echo $query_temp2."";
		//$result_temp2=mysql_query($query_temp2);
	}

}
	echo "korras ...";

?>



	