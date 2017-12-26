<?


//Tegeleme sellega, et teksti ja valemite vahelt on paljud seosed puudu, otsib tekstist valemite kirjed ja loob vastavad seosed.


    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
	require_once 'header.php';
?><? // note that multibyte support is enabled here 

$query="SELECT * FROM `raamatX` order by id";
$result=mysql_query($query);

while($line=mysql_fetch_array($result))
{

				$tykid_vv=explode("@{", $line["tekst"]);
				for($ii = 1; $ii < sizeof($tykid_vv); ++$ii) // üle tekstis olevate valemite
				{
					$tykid_vv2=explode("}@", $tykid_vv[$ii]); //lõikan valemi id välja
					$query_valem="SELECT * FROM raamatX_exp WHERE oid1=".$line["id"];
					$result_valem=mysql_query($query_valem);
					$on_olemas="";
					while($line_valem=mysql_fetch_array($result_valem)) //üle alajaotuse ja valemite vaheliste seoste
					{	//vaatan, kas mõne seose juures on eelmise süsteemi id, väljal valem_id
						$query_valem1="SELECT id,valem_id FROM exp WHERE id=".$line_valem["oid2"];
						echo $query_valem1."<br>";
						$result_valem1=mysql_query($query_valem1);
						$line_valem1=mysql_fetch_array($result_valem1);
						if($line_valem1["valem_id"] == trim($tykid_vv2[0]))
						{
							$on_olemas="On olemas";
						}
						
					}
						
						
						
					if(!$on_olemas)
					{
						$query_valem1="SELECT id,valem_id FROM exp WHERE valem_id=".trim($tykid_vv2[0]);
						echo $query_valem1."<br>";
						$result_valem1=mysql_query($query_valem1);
						$line_valem1=mysql_fetch_array($result_valem1);
						
						$on_olemas="INSERT INTO `fyysika_ee`.`raamatX_exp` (`id`, `book_id`, `oid1`, `oid2`, `order1`, `order2`, `meta1`, `meta2`, `width1`, `height1`, `align1`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`, `lupdate`) 
					VALUES 
					(NULL, '".$line["book_id"]."', '".$line["id"]."', '".$line_valem1["id"]."', '', '', '', '', '', '', '0', '', '', '', '', '', '', '0', '0', '0000-00-00 00:00:00');";
					//$result11=mysql_query($on_olemas);
					}
					
					echo trim($tykid_vv2[0])." uus id on ".$line_valem1["id"]." sql: ".$on_olemas."<br>";
					//echo $line_valem["tex"];
					//echo preg_replace('#\@\{(.*)\}\@#', 'kaido',$tykid_vv[$ii]);
		
		
				}
}
	
	echo "korras ...";
?>

	