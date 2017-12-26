<?

    /* Connecting, selecting database */

    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")

     	or die("Could not connect");

     print "Connected successfully <br>";

    mysql_select_db("fyysika_ee") or die("Could not select database"); 

?><? // note that multibyte support is enabled here 

	require_once 'header.php';


$id=0;
$query="SELECT * FROM `dict_y`";
$result=mysql_query($query);
while($sonad=mysql_fetch_array($result)) //
{<?php /*?> 
	// Teeme dictterm tabelisse vajalikud kirjed. EST
	$query_temp="INSERT INTO `fyysika_ee`.`dictterm` (`kirje`,`lang`,`valdkond`,`allikas`) VALUES ('".$sonad["EST"]."','est','kaug','".$sonad["paritolu"].", ".$sonad["allikas"]."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$eid=$tmp["last_insert_id()"];
	
	// Teeme dictterm tabelisse vajalikud kirjed. ENG
	$query_temp="INSERT INTO `fyysika_ee`.`dictterm` (`kirje`,`lang`,`valdkond`,`allikas`) VALUES ('".$sonad["ENG"]."','eng','kaug','".$sonad["paritolu"].", ".$sonad["allikas"]."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$iid=$tmp["last_insert_id()"];

	// Teeme dictconcept tabelisse vajaliku kirje. 
	$query_temp="INSERT INTO `fyysika_ee`.`dictconcept` (`nimi_est`,`nimi_eng`,`artikkel_est`,`allikas`) VALUES ('".$sonad["EST"]."','".$sonad["ENG"]."','".$sonad["Seletus"]."','KS')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$sid=$tmp["last_insert_id()"];

	//Teeme seosed

	$query_temp="INSERT INTO `fyysika_ee`.`dictconcept_dictterm` (`oid1`, `oid2`, `meta1`) VALUES ('".$sid."', '".$iid."','eng');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$query_temp="INSERT INTO `fyysika_ee`.`dictconcept_dictterm` (`oid1`, `oid2`, `meta1`) VALUES ('".$sid."', '".$eid."','est');";
	echo $query_temp."<br><br>";
	$result_temp=mysql_query($query_temp);
<?php */?>}
	echo "korras ...";

?>



	