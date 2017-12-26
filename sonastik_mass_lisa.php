<?

    /* Connecting, selecting database */

    $link = mysql_connect("localhost", "fyysika_opik3", "4dNobeliNitro")

     	or die("Could not connect");

     print "Connected successfully <br>";

    mysql_select_db("fyysika_opik3") or die("Could not select database"); 

?><? // note that multibyte support is enabled here 

	require_once 'header.php';



$query="SELECT * FROM `aine_uudis` WHERE id=4";
$result=mysql_query($query);
$sonad=mysql_fetch_array($result);
//$sonad = file_get_contents('http://fyysika.ee/omad/Glossary_2Kaile_PB2.htm');
//echo $sonad;
$kirjed=explode('<p>',$sonad["title1"]);


for($i=0;$i<count($kirjed);$i++) //

{ 
	$est = str_replace('<b>','',explode ('</b> ',$kirjed[$i]));
	$ing = str_replace ('ingl <i>','',explode('</i>.',$est[1]));
	$sel= trim(ltrim($ing[1],"."));
	if($sel=='')
	{
	echo "Est: ".$est[0]."<br>";
	echo "Eng: ".$ing[0]."<br>";
	echo "Seletus: ".$sel."<br>";
	echo "<hr>";
	}
	// Teeme dictterm tabelisse vajalikud kirjed. EST
	$query_temp="INSERT INTO `fyysika_ee`.`dictterm` (`kirje`,`lang`,`valdkond`,`allikas`) VALUES ('".$est[0]."','est','keem','KA')";
	echo $query_temp."<br>";
/*	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$eid=$tmp["last_insert_id()"];
*/	
	// Teeme dictterm tabelisse vajalikud kirjed. ENG
	$query_temp="INSERT INTO `fyysika_ee`.`dictterm` (`kirje`,`lang`,`valdkond`,`allikas`) VALUES ('".$ing[0]."','eng','keem','KA')";
	echo $query_temp."<br>";
/*	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$iid=$tmp["last_insert_id()"];
*/
	// Teeme dictconcept tabelisse vajaliku kirje. 
	$query_temp="INSERT INTO `fyysika_ee`.`dictconcept` (`nimi_est`,`nimi_eng`,`artikkel_est`,`allikas`) VALUES ('".$est[0]."','".$ing[0]."','".rtrim($sel,'</p>')."','KA')";
	echo $query_temp."<br>";
/*	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$sid=$tmp["last_insert_id()"];
*/
	//Teeme seosed

	$query_temp="INSERT INTO `fyysika_ee`.`dictconcept_dictterm` (`oid1`, `oid2`, `meta1`) VALUES ('".$sid."', '".$iid."','eng');";
	echo $query_temp."<br>";
	//$result_temp=mysql_query($query_temp);
	$query_temp="INSERT INTO `fyysika_ee`.`dictconcept_dictterm` (`oid1`, `oid2`, `meta1`) VALUES ('".$sid."', '".$eid."','est');";
	echo $query_temp."<br><br>";
	//$result_temp=mysql_query($query_temp);

}
	echo "korras ...";

?>



	