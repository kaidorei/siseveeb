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



$query1="SELECT * FROM `dictterm` where deleted=0 and id>63730 "; //<=  

$result1=mysql_query($query1);
$id1=0;
while($line1=mysql_fetch_array($result1))
{ 
	echo "<hr>";	

$query="SELECT * FROM `exp` where ext_id=".$line1["id"]." AND gpid_demo=38";
//echo $query."<br>";
$result=mysql_query($query);


if($line=mysql_fetch_array($result))
{
	$expid=$line["id"];
	echo "ON KIRJE<br>";
}
else
{
	$query_temp2="INSERT INTO `fyysika_ee`.`exp` (`nimi_est`,`ext_id`,`gpid_demo`,`owner_user_id`) VALUES ('".$line1["kirje"]."','".$line1["id"]."',38,25)";
	echo $query_temp2."<br>";
	$result_temp2=mysql_query($query_temp2);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$expid=$tmp["last_insert_id()"];
}
	// ALLPOOL on kirjete tegemine ...
	echo "TERMIN (dictterm): ".$line1["kirje"]."</b>";
	$kirje_term="";
	$kirje_term_alg="";
	$kirje_term_teine="";
	$algkeel = $line1["lang"];
	if ($algkeel == 'est') $teinekeel = 'eng'; else $teinekeel='est';
	
	//Lugemine üle erinevate sisude: 
	$query_temp="SELECT oid1 FROM `fyysika_ee`.`dictconcept_dictterm` WHERE oid2 = '".$line1["id"]."' ";
	//echo $query_temp;
	$result_temp=mysql_query($query_temp);
	
	$ids = array(); 
	while ($row = mysql_fetch_assoc($result_temp))  
	{
		$ids[] = $row["oid1"]; 
	} 
	$iids = implode(", ", $ids);
	
// Otsime üles tõlked		
	$query_t= "SELECT DISTINCT dictterm.kirje
	FROM dictterm
	INNER JOIN dictconcept_dictterm
	ON dictconcept_dictterm.oid2=dictterm.id WHERE dictconcept_dictterm.oid1 IN (".$iids.") AND  dictterm.lang='".$teinekeel."' AND dictterm.deleted=0";
	//echo $query_t."<br>";
	$result_t=mysql_query($query_t);
	
	while($line_t=mysql_fetch_array($result_t))
	{
		$kirje_term_teine=$kirje_term_teine." ".$line_t["kirje"].", ";
	}

// Otsime üles sünonüümid
	$query_t= "SELECT DISTINCT dictterm.kirje
	FROM dictterm
	INNER JOIN dictconcept_dictterm
	ON dictconcept_dictterm.oid2=dictterm.id WHERE dictconcept_dictterm.oid1 IN (".$iids.") AND  dictterm.lang='".$algkeel."' AND dictterm.deleted=0";
	//echo $query_t."<br>";
	$result_t=mysql_query($query_t);
	
	while($line_t=mysql_fetch_array($result_t))
	{
		$kirje_term_alg=$kirje_term_alg." ".$line_t["kirje"].", ";
	}
	
	if($line1["lang"]=="eng")
	{
		$kirje_term = $kirje_term."<br>".substr(trim($kirje_term_teine), 0, -1)."<br> <i>Synonyms</i>: ".substr(trim($kirje_term_alg), 0, -1)."";
	}
	else
	{	

		$kirje_term = $kirje_term."<br>".substr(trim($kirje_term_teine), 0, -1)."<br> <i>Sünonüümid</i>: ".substr(trim($kirje_term_alg), 0, -1)."";
	}
	switch($line1["allikas"])
	{
		case 'KK': $all = "Korrovits Käämbre füüsikasõnastik";
		case 'KA': $all = "Keemia alused";
		case 'KS': $all = "Kaugseire sõnastik";
	}
	$kirje_term = $kirje_term."<br> Allikas: ".$all;
	
		echo $kirje_term;
	
	$query_kirje = "UPDATE exp set kirjeldus_est='".$kirje_term."', lemmad_title='".$line1["kirje"]."' WHERE id=".$expid." LIMIT 1";
	echo $query_kirje."<br>";
	$result_kirje=mysql_query($query_kirje);
}
	echo "korras ...";

?>



	