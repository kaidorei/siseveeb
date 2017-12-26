<?
///////////////////////////////////////////////////////////////////
// KOOD korduvate kirjete kõrvaldaminseks term tabelist
///////////////////////////////////////////////////////////////////
// Kaks paralleelset tabelit: exp, gpid_demo=42 ja dictconcept
// seosed on defineeritud tabelis exp_exp
// Kui korduvad kirjed on leitud, tuleb valida üks välja ning suunata kõik exp_exp kirjed sellele.
// Kontrollida saab siseveebis - terminile peaks üldjuhul vastama üks seletus, 
// praegu on neid seal samapalju kui terminitel sünonüüme.

$link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
require_once 'header.php';
$eelmine='';
$query="SELECT * FROM `exp` where gpid_demo=42 ORDER BY nimi_est";
$result=mysql_query($query);
while($line=mysql_fetch_array($result))
{ 
	if($line["nimi_est"]==$eelmine)
	{
		$vordus=1;
		echo "--".$eelmine_id." ".$eelmine." ".$line["id"]." ".$line["nimi_est"]."<br>";

		$query_temp="SELECT * FROM `fyysika_ee`.`exp_exp` WHERE oid2=".$line["id"]."";
		$result_temp=mysql_query($query_temp);
		while($line_temp=mysql_fetch_array($result_temp))
		{
			$query_u="UPDATE exp_exp SET oid2=".$eelmine_id." WHERE id=".$line_temp["id"]."";
			echo $query_u."<br>";
			$result_temp=mysql_query($query_u);
		}	
		$query_temp2="SELECT * FROM `fyysika_ee`.`exp_exp` WHERE oid1=".$line["id"]."";
		$result_temp2=mysql_query($query_temp2);
		while($line_temp2=mysql_fetch_array($result_temp2))
		{
			$query_u2="UPDATE exp_exp SET oid1=".$eelmine_id." WHERE id=".$line_temp2["id"]."";
			echo $query_u2."<br>";
			$result_temp=mysql_query($query_u2);
		}	

			$query_u4="DELETE FROM exp WHERE id=".$line["id"]." LIMIT 1";
			echo $query_u4."<br>";
			$result_temp=mysql_query($query_u4);

	}
	else
	{
		$vordus=0;
	}
	if($vordus==0)
	{
$eelmine = $line["nimi_est"];
$eelmine_id=$line["id"];
	}
//echo "--".$line["nimi_est"]."--<br>";
//echo $query."<br>";

// Võtame termini, vaatame üle vastavad mõisted, läbi exp_exp tabeli

/*	$query_temp1="SELECT * FROM `fyysika_ee`.`exp` WHERE id = '".$line_temp["oid2"]."'";
	$result_temp1=mysql_query($query_temp1);
	$line_temp1=mysql_fetch_array($result_temp1);
	$esimene =  $line_temp1["nimi_est"];
	echo $esimene." ID ".$line_temp["id"]."           (see on esimene) <br>";
*/	
/*	while($line_temp=mysql_fetch_array($result_temp))
	{
		$query_temp1="SELECT * FROM `fyysika_ee`.`exp` WHERE id = '".$line_temp["oid2"]."'";
		$result_temp1=mysql_query($query_temp1);
		$line_temp1=mysql_fetch_array($result_temp1);
		echo $line_temp1["nimi_est"]." ID ".$line_temp["id"]."<br>";
		if($line_temp1["nimi_est"] == $esimene) 
		{
			$qyery_u="DELETE FROM exp_exp WHERE id=".$line_temp["id"]." LIMIT 1";
			echo $qyery_u."<br>";
			$result_u=mysql_query($qyery_u);
		}
	}
*/}
	echo "korras ...";

?>



	