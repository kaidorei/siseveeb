<?

    /* Connecting, selecting database */

    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")

     	or die("Could not connect");

     print "Connected successfully <br>";

    mysql_select_db("fyysika_ee") or die("Could not select database"); 

?><? // note that multibyte support is enabled here 

	require_once 'header.php';



$query="SELECT * FROM `dict_en_term` LIMIT 500";

$result=mysql_query($query);
$id1=0;
while($line=mysql_fetch_array($result))

{

	

	

/*$query1="SELECT * FROM `exp` WHERE raamatX_id=".$line["id"]."";

$result1=mysql_query($query1);

$line1=mysql_fetch_array($result1);

*/ ?>

<xmp>

<?	

echo "termin: ".$line["kirje_eng"]." ";

?>

</xmp>

<xmp><?

//echo "artikkel_b:".$line["artikkel"]."";	

?>

</xmp>

<?



$asi = str_replace("xmlns:f=\"http://www	.eki.ee/dict/ief\"","",$line["artikkel"]);

?>



<xmp><?

echo "artikkel_b:".$asi."<br>";	

?>

</xmp>

<?

libxml_use_internal_errors(true);
$xml = simplexml_load_string($asi)->children('f', true);
if ($xml === false) {
    echo "Failed loading XML\n";
    foreach(libxml_get_errors() as $error) {
        echo "\t", $error->message;
    }
}

print_r($xml);

echo "<br>";

echo "po:  ".$xml->po."<br>";

echo "K:  ".$xml->K."<br>";
echo "KA:  ".$xml->KA."<br>";

echo "ter:  ".$xml->P->terg->ter."<br>";
	/*$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->P->terg->ter."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];

	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','eng');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
*/	
	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept` (`id`,`nimi_est`, `nimi_eng`,`valdkond`) VALUES ('".$line["id"]."','".$xml->P->terg->ter."','".$xml->S->tp->xp[0]->xg[0]->x."','".$xml->P->terg->v."')";
	echo $query_temp."<br>";
	//$result_temp=mysql_query($query_temp);
	
	
	/*echo "syng0:  ".$xml->S->tp->tg->tes->syng[0]->syn[0]."<br>";
if($xml->S->tp->tg->tes->syng[0]->syn[0])
{
	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->tg->tes->syng[0]->syn[0]."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];

	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','eng');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
}
echo "syng1:  ".$xml->S->tp->tg->tes->syng[1]->syn[0]."<br>";
if($xml->S->tp->tg->tes->syng[1]->syn[0])
{
	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->tg->tes->syng[1]->syn[0]."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];

	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','eng');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
}
echo "syng2:  ".$xml->S->tp->tg->tes->syng[2]->syn[0]."<br>";
if($xml->S->tp->tg->tes->syng[2]->syn[0])
{
	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->tg->tes->syng[2]->syn[0]."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];

	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','eng');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
}
echo "syng3:  ".$xml->S->tp->tg->tes->syng[3]->syn[0]."<br>";
if($xml->S->tp->tg->tes->syng[3]->syn[0])
{
	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->tg->tes->syng[3]->syn[0]."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];

	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','eng');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
}
echo "syng4:  ".$xml->S->tp->tg->tes->syng[4]->syn[0]."<br>";
if($xml->S->tp->tg->tes->syng[4]->syn[0])
{
	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->tg->tes->syng[4]->syn[0]."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];

	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','eng');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
}
echo "syng5:  ".$xml->S->tp->tg->tes->syng[5]->syn[0]."<br>";
if($xml->S->tp->tg->tes->syng[5]->syn[0])
{
	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->tg->tes->syng[5]->syn[0]."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];

	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','eng');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
}
echo "syng6:  ".$xml->S->tp->tg->tes->syng[6]->syn[0]."<br>";
if($xml->S->tp->tg->tes->syng[6]->syn[0])
{
	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->tg->tes->syng[6]->syn[0]."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];

	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','eng');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
}
echo "syng7:  ".$xml->S->tp->tg->tes->syng[7]->syn[0]."<br>";
if($xml->S->tp->tg->tes->syng[7]->syn[0])
{
	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->tg->tes->syng[7]->syn[0]."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];

	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','eng');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
}
echo "syng8:  ".$xml->S->tp->tg->tes->syng[8]->syn[0]."<br>";
if($xml->S->tp->tg->tes->syng[8]->syn[0])
{
	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->tg->tes->syng[8]->syn[0]."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];

	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','eng');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
}
*/
if(!$line_temp1["id"])
{
/*	$query_temp="INSERT INTO `fyysika_ee`.`dict_en_term` (`kirje_eng`) VALUES ('".$xml->P->mvt."')";
	echo $query_temp."<br>";
*///	$result_temp=mysql_query($query_temp);
}






//echo "eesti 1:  ".$xml->S->tp->xp[0]->xg[0]->x."<br>";
if($xml->S->tp->xp[0]->xg[0]->x)
{
/*	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->xp[0]->xg[0]->x."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];

	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','est');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
*/}




//echo "xd:  ".$xml->S->tp->xp[0]->xg[0]->xd."<br>";

//echo "eesti 2:  ".$xml->S->tp->xp[0]->xg[1]->x."<br>";
if($xml->S->tp->xp[0]->xg[1]->x)
{
/*	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->xp[0]->xg[1]->x."')";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];
	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','est');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
*/}


//echo "xd:  ".$xml->S->tp->xp[0]->xg[1]->xd."<br>";

//echo "eesti 3:  ".$xml->S->tp->xp[0]->xg[2]->x."<br>";
if($xml->S->tp->xp[0]->xg[2]->x)
{
/*	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->xp[0]->xg[2]->x."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];
	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','est');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
*/}
//echo "xd:  ".$xml->S->tp->xp[0]->xg[2]->xd."<br>";

//echo "eesti 4:  ".$xml->S->tp->xp[0]->xg[3]->x."<br>";
if($xml->S->tp->xp[0]->xg[3]->x)
{
/*	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->xp[0]->xg[3]->x."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];
	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','est');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
*/}

//echo "xd:  ".$xml->S->tp->xp[0]->xg[3]->xd."<br>";

//echo "eesti 5:  ".$xml->S->tp->xp[0]->xg[4]->x."<br>";
if($xml->S->tp->xp[0]->xg[4]->x)
{
/*	$query_temp="INSERT INTO `fyysika_ee`.`dict_et_term` (`kirje`) VALUES ('".$xml->S->tp->xp[0]->xg[4]->x."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$vid=$tmp["last_insert_id()"];
	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line["id"]."', '".$vid."','est');";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
*/}


echo "xd:  ".$xml->S->tp->xp[0]->xg[4]->xd."<br>";

echo "x21:  ".$xml->S->tp->xp[1]->xg[0]->x."<br>";
echo "xd:  ".$xml->S->tp->xp[1]->xg[0]->xd."<br>";

echo "x22:  ".$xml->S->tp->xp[1]->xg[1]->x."<br>";
echo "xd:  ".$xml->S->tp->xp[1]->xg[1]->xd."<br>";

echo "x23:  ".$xml->S->tp->xp[1]->xg[2]->x."<br>";
echo "xd:  ".$xml->S->tp->xp[1]->xg[2]->xd."<br>";

echo "x31:  ".$xml->S->tp->xp[2]->xg[0]->x."<br>";
echo "xd:  ".$xml->S->tp->xp[2]->xg[0]->xd."<br>";
echo "x32:  ".$xml->S->tp->xp[2]->xg[1]->x."<br>";
echo "xd:  ".$xml->S->tp->xp[2]->xg[1]->xd."<br>";
echo "x33:  ".$xml->S->tp->xp[2]->xg[2]->x."<br>";
echo "xd:  ".$xml->S->tp->xp[2]->xg[2]->xd."<br>";

echo "terg:  ".$xml->P->terg->v."<br>";

echo "mvt:  ".$xml->P->mvt."<br>";


if(!$xml->S->tp->xp[0]->xg[0]->x AND $xml->P->mvt) // algsetes kirjetes sisalduvate sünonüümide eraldi kirjetena tabelisse kandmine
{
/*	$query_temp1 = "SELECT * FROM dict_concept WHERE nimi_eng = '".$xml->P->mvt."' ";
	echo $query_temp1."<br>";
	$result_temp1=mysql_query($query_temp1);
	$line_temp1=mysql_fetch_array($result_temp1);	
*///	$query_temp = "UPDATE dict_concept SET nimi_est = '".$xml->S->tp->xp[0]->xg[0]->x."' WHERE id=".$line_temp1["id"]." LIMIT 1";
if(!$line_temp1["id"])
{
/*	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept` (`nimi_eng`) VALUES ('".$xml->P->mvt."')";
	echo $query_temp."<br>";
	$result_temp=mysql_query($query_temp);
*/}
/*	$query_temp="INSERT INTO `fyysika_ee`.`dict_concept_term` (`oid1`, `oid2`, `meta1`) VALUES ('".$line_temp1["id"]."', '".$line["id"]."','mvt');";
	echo $query_temp."<br>";
*///	$result_temp=mysql_query($query_temp);

}
}

	echo "korras ...";

?>



	