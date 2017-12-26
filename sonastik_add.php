<?

	require_once 'header.php';
	$dom=$_GET["domain"];
	$sel=$_GET["sel"];
	$oid1=$_GET["oid1"];	
	$oid2=$_GET["oid2"];	
	$value=$_GET["value"];	
	$gpid_demo=$_GET["gpid_demo"];	

	$count_ups=0;

// uurime, kummatpidi seose osapooled on, st kumb läheb oid1-ks, kumb oid2-ks.
	$dom1=substr($dom,0,strpos($dom,"_"));
	$dom2=substr($dom,strpos($dom,"_")+1,strlen($dom));

if(1)
{
	echo "Sõnastik: Uue elemendi tegemine: ",$value,"    ";
	// konstrueerin elemendile sobiva INSERT käsu
	if($sel==2) // see on juht, kus dom_list on oid1

	{
		$d = $dom1;
	}
	else
	{
		$d = $dom2;
	}

	switch($d)

	{
		default:
			$q_fields = "nimi_est,oskus_est";
			$query="INSERT INTO ".$d." (".$q_fields.") VALUES ('".$oid1."_".$count_ups."','".$value."')";
			break;
	}

		//echo"gpid_demo= ".$gpid_demo;

if($query)
{	
		echo $query;
		$tmp=mysql_query($query);
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$ooid=$tmp["last_insert_id()"];
/*		if($d=="exp")//paneme nime slave'ile kohaseks

		{
			$query_nimi="UPDATE exp set nimi_est='".$oid1."_".$ooid."' WHERE id='".$ooid."'";
			echo $query_nimi;
			$tmp=mysql_query($query_nimi);						
		}
*/
		//$result = $db->query($query);
		$result = $db->query($query);
		$result=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$expid=$result["last_insert_id()"];
}
else
{
		echo "Sonastik: see variant uue elemendi tegemisest on määramata";
}
		$count_ups++;

}

?>