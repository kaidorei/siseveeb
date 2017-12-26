<?
    /* Connecting, selecting database */
//	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
//	require_once 'header.php';
	require_once 'header.php';

$query="SELECT * FROM `raamatX_exp` WHERE book_id=44 ";
$result=mysql_query($query);
while($line=mysql_fetch_array($result))
{
	$query1="SELECT * FROM `exp` WHERE id=".$line["oid2"];
	$result1=mysql_query($query1);
	$line1=mysql_fetch_array($result1)	;
	echo "<br><h2>",$line1["nimi_est"],": ",$line1["id"],"</h2><br>";
if($line1["gpid_demo"]==21)
{
/*	$query2="SELECT * FROM `exp_pildid` WHERE oid=".$line["oid2"]." ORDER BY id DESC";
	$result2=mysql_query($query2);
	$line2=mysql_fetch_array($result2)	;
*/	
				$query_vahh="SELECT * FROM exp_exp WHERE oid1=".$line1["id"]." order by order1";
				//echo $query_vahh."<br>";
				$result_vahh=mysql_query($query_vahh);
				while($line_vahh=mysql_fetch_array($result_vahh))
				{
		
				$mudel="";
				
				$query_exp="SELECT * FROM exp WHERE id=".$line_vahh["oid2"]." LIMIT 1";
				//echo $query_exp."<br><br>";
				$result_exp=mysql_query($query_exp);
				$line_exp=mysql_fetch_array($result_exp);
				//echo $line_exp["gpid_demo"].".............................<br>";
				switch($line_exp["gpid_demo"])
				{
					case 9: 
					//echo "PILTTTTTTTTTTTTTTTTTTT <br>";
					$mudel=$mudel."<p>[{[".$line_vahh["oid2"]."]}]</p>";
					
					break;
					case 43:
		
					break;
					default:
					 			echo "midagi muud!!! <br>";
					break;
				}

				}
				$mudel=$mudel."<p>".strip_tags($line1["probleem_est"]."</p>",'<sub></sub><sup></sup>');



				
				 
				$query_vahh="SELECT * FROM exp_exp WHERE oid1=".$line1["id"]." AND naita_veebis1=1 order by order1";
				//echo $query_vahh;
				$result_vahh=mysql_query($query_vahh);
//				$sammud=$sammud."<p>";
				$count_row=0;
				while($line_vahh=mysql_fetch_array($result_vahh))
				{
				$query_exp="SELECT * FROM exp WHERE id=".$line_vahh["oid2"]." LIMIT 1";
				//echo $query_exp."<br><br>";
				$result_exp=mysql_query($query_exp);
				$line_exp=mysql_fetch_array($result_exp);
				//echo $line_exp["seletus_est"]."<br><br>";
				switch($line_exp["gpid_demo"])
				{
					case 43: 
					$mudel=$mudel."<p>[£[".$line_vahh["oid2"]."]£]</p>";
					
					break;
					default:
					break;
				}
				}
				
				$valjund = 	$mudel;
				$valjund_print = $mudel;
		
		
			$query2="UPDATE exp set nimi_est='efo ".$db->real_escape_string($line1["nimi_est"])."' WHERE id= ".$line1["id"]." LIMIT 1";
		//echo $query2,"<br><br>";
	
			
		//$r=mysql_query($query2);
	}}
	echo "korras ...";
?>

	