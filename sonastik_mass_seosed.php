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

// Füüsika eesti-inglise terminoloogiasõnastik 13964
// Füüsika inglise-eesti terminoloogiasõnastik 13963
// Keemia inglise-eesti 13969
// 13970
// Kaugseire inglise-eesti 13972
// Kaugseire inglise-eesti 13973

$query1="select exp.id, exp.nimi_est,dictterm.lang,dictterm.allikas from exp inner join dictterm on exp.ext_id=dictterm.id where dictterm.lang='est' AND exp.gpid_demo=38 AND dictterm.allikas='KS'"; //<=  

$result1=mysql_query($query1);
$id1=0;
while($line1=mysql_fetch_array($result1))
{ 
	echo "<hr>";
	$query_temp2="INSERT INTO `fyysika_ee`.`raamatX_exp` (`oid1`,`oid2`,`book_id`) VALUES ('13973','".$line1[0]."',69)";
	echo $query_temp2."<br>";
	//$result_temp2=mysql_query($query_temp2);
}
	echo "korras ...";

?>



	