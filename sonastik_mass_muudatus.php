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



$query1="SELECT * FROM `dictconcept_dictterm2` ORDER BY id"; //<=  

$result1=mysql_query($query1);
$id1=0;
while($line1=mysql_fetch_array($result1))
{ 
	echo "<hr>".$line1["id"];	
/*$query3="SELECT * FROM `dictconcept_dictterm` WHERE id='".$line1["id"]."' ORDER BY id"; //<=  
$result3=mysql_query($query3);
$line3=mysql_fetch_array($result3);


$query11="SELECT id FROM `exp` WHERE ext_id=".$line3["oid1"]." AND gpid_demo=42 LIMIT 1"; //<=  
echo $query11."<br>";
$result11=mysql_query($query11);
$line11=mysql_fetch_array($result11);
*/
	$query_temp2="INSERT INTO `fyysika_ee`.`exp_exp`(`oid1`,`oid2`,`naita_veebis`) VALUES ('".$line1["oid1"]."', '".$line1["oid2"]."', '1')";
	echo $query_temp2."<br>";
	//$result_temp2=mysql_query($query_temp2);
	$query_temp2="INSERT INTO `fyysika_ee`.`exp_exp`(`oid1`,`oid2`,`naita_veebis`) VALUES ('".$line1["oid2"]."', '".$line1["oid1"]."', '1')";
	echo $query_temp2."<br>";
	//$result_temp2=mysql_query($query_temp2);
}
	echo "korras ...";

?>



	