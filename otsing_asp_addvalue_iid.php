<?
	require_once 'header.php';

	$dom=$_GET["domain"];
	$sel=$_GET["sel"];
	$oid1=$_GET["oid1"];
	$oid2=$_GET["oid2"];
	$value=$_GET["value"];
	$aine=$_GET["aine"];

	$gpid_demo=$_GET["gpid_demo"];

	if(!$gpid_demo){$gpid_demo=9;}

	$count_ups=0;

// uurime, kummatpidi seose osapooled on, st kumb läheb oid1-ks, kumb oid2-ks.

	$dom1=substr($dom,0,strpos($dom,"_"));
	$dom2=substr($dom,strpos($dom,"_")+1,strlen($dom));

if($oid2 && $oid1)

{
if($aine)
{
	if($sel==2) // see on juht, kus dom_list on oid1
	{
		$query="INSERT INTO ".$dom." (oid1,oid2,sisu2) VALUES (\"".$oid2."\",\"".$oid1."\",\"".$aine."\")";
	}

	else

	{
		$query="INSERT INTO ".$dom." (oid1,oid2,sisu2) VALUES (\"".$oid1."\",\"".$oid2."\",\"".$aine."\")";
	}
}
	else
{
	if($sel==2) // see on juht, kus dom_list on oid1

	{
		$query="INSERT INTO ".$dom." (oid1,oid2) VALUES (\"".$oid2."\",\"".$oid1."\")";
	}

	else

	{
		$query="INSERT INTO ".$dom." (oid1,oid2) VALUES (\"".$oid1."\",\"".$oid2."\")";
	}
}


$result = $db->query($query);
echo $query;

}

else

{

	echo "Uue elemendi tegemine: ",$value,"    ";

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
		case "exp":

			{
				switch($gpid_demo)
				{
					case 32:
					case 21:
					$q_fields = "nimi_est,gpid_demo,on_slave,owner_user_id";
					$query="INSERT INTO ".$d." (".$q_fields.") VALUES ('".$value."','".$gpid_demo."','0','25')";
					break;

					case 15:
					$q_fields = "nimi_est,kirjeldus_est,gpid_demo,on_slave,owner_user_id";
					$query="INSERT INTO ".$d." (".$q_fields.") VALUES ('".$oid1."_".$count_ups."','".$value."','".$gpid_demo."','1','25')";
					break;

					default:
					$q_fields = "nimi_est,kirjeldus_est,gpid_demo,on_slave,owner_user_id";
					$query="INSERT INTO ".$d." (".$q_fields.") VALUES ('".$value."','','".$gpid_demo."','0','25')";
					break;
				}


			}

			break;
		default:
			break;
	}

//echo"gpid_demo= ".$gpid_demo;

if($query)

{
		$tmp=mysql_query($query);
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$ooid=$tmp["last_insert_id()"];

//Genereerime nime objektidel, millele seda vaja ei ole, string ja KK
		if($gpid_demo==15)

		{
			$query_nimi="UPDATE exp set nimi_est='".$oid1."_".$ooid."' WHERE id='".$ooid."'";
			echo $query_nimi;
			$tmp=mysql_query($query_nimi);
		}

		//$result = $db->query($query);

		echo $query;

		// lisame seose ...

		if($sel==2) // see on juht, kus dom_list on oid1

		{

			$query="INSERT INTO ".$dom." (oid1,oid2) VALUES (\"".$ooid."\",\"".$oid1."\")";

		}

		else

		{

			$query="INSERT INTO ".$dom." (oid1,oid2) VALUES (\"".$oid1."\",\"".$ooid."\")";

		}



					// Kui on peatüki lisamine, siis tuleb teha vastav kirje raamatX tabelisse



		$result = $db->query($query);

		$result=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

		$expid=$result["last_insert_id()"];



// Kui teeme uue peatüki, siis on vaja ka raamatX tabel järele aidata, teha kirje ning panna exp objekt sellele külge.

		if($gpid_demo==43 OR $gpid_demo==42)

		{

			$query_x="INSERT INTO raamatX (nimi_est,pid) VALUES (\"".$value."\",2)";

			echo $query_x."<br>";

			$result_x=mysql_query($query_x);

//			$result_x = $db->query($query_x);

			$result_x=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

			$raamatX_id=$result_x["last_insert_id()"];



			$query_y="UPDATE exp set raamatX_id = ".$raamatX_id." WHERE id = ".$expid." LIMIT 1";

			echo 	$query_y."<br>";

			$result_y = $db->query($query_y);

		}

		echo $query;

}

else

{

		echo "see variant uue elemendi tegemisest on määramata";

}

		$count_ups++;

}

?>
