<?
///////////////////////////////////////////////////////////////////
// KOOD korduvate kirjete kõrvaldaminseks dict tabelist
///////////////////////////////////////////////////////////////////

    /* Connecting, selecting database */

$link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")

     	or die("Could not connect");

print "Connected successfully <br>";

mysql_select_db("fyysika_ee") or die("Could not select database"); 

?><? // note that multibyte support is enabled here 

require_once 'header.php';
$query="SELECT * FROM `dictterm` where deleted=0  AND id>61146";
echo $query."<br>";
$result=mysql_query($query);
$id1=0;
while($line=mysql_fetch_array($result))
{ 
	// Korduvate kirjete kõrvaldamine

	$query_temp="SELECT COUNT(*) FROM `fyysika_ee`.`dictterm` WHERE kirje = '".$line["kirje"]."' AND deleted = 0";
	//echo $query_temp." <br>";
	$result_temp=mysql_query($query_temp);
	$r=mysql_fetch_array($result_temp);
	if($r[0]>1)
	{
		echo $query_temp." =>> ".$r[0]."<br>";
		
		$query_temp1="SELECT * FROM `fyysika_ee`.`dictterm` WHERE kirje = '".$line["kirje"]."' AND deleted = 0";
		$result_temp1=mysql_query($query_temp1);
		$count=0;
		$id_asi=0;
		while($line_all=mysql_fetch_array($result_temp1))
		{
			echo $line_all["id"]."<br>";
			if($count>0)
			{
				$qyery_d="UPDATE dictterm SET deleted=1 WHERE id=".$line_all["id"];
				$result_d=mysql_query($qyery_d);
				echo $qyery_d."<br>";
				$qyery_r="UPDATE dictconcept_dictterm SET oid2=".$id_asi.", allikas='KA' WHERE oid2=".$line_all["id"];
				echo $qyery_r."<br>";
				$result_r=mysql_query($qyery_r);
				$qyery_u="DELETE FROM exp WHERE ext_id=".$line_all["id"]." AND gpid_demo=38 LIMIT 1";
				$result_u=mysql_query($qyery_u);
				echo $qyery_u."<br>";
			}
			else
			{
				$id_asi=$line_all["id"];
			}
			$count++;
			
		}

	}

}
	echo "korras ...";

?>



	