<?


//Tegeleme sellega, et teksti ja valemite vahelt on paljud seosed puudu, otsib tekstist valemite kirjed ja loob vastavad seosed.


    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
	require_once 'header.php';
?><? // note that multibyte support is enabled here 

$query="SELECT * FROM `exp` WHERE gpid_demo=32 or gpid_demo=29 or gpid_demo=20 ORDER BY id LIMIT 20";
$result=mysql_query($query);

while($line=mysql_fetch_array($result))
{
		echo "<strong>".$line["probleem_est"],"</strong><br>";
		$query_valem="SELECT * FROM exp_exp WHERE oid1=".$line["id"];
		$result_valem=mysql_query($query_valem);
		while($line_valem=mysql_fetch_array($result_valem)) //üle alajaotuse ja valemite vaheliste seoste
		{	//vaatan, kas mõne seose juures on eelmise süsteemi id, väljal valem_id
			$query_valem1="SELECT * FROM exp WHERE id=".$line_valem["oid2"];
			$result_valem1=mysql_query($query_valem1);
			$line_valem1=mysql_fetch_array($result_valem1);
			echo "kirjeldus_est: ".$line_valem1["kirjeldus_est"]."<br>";
			echo "seletus_est: ".$line_valem1["seletus_est"]."<br>";
				
		}
}
	
	echo "korras ...";
?>

	