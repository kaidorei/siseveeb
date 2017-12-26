<?
    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
	require_once 'header.php';

$query="SELECT * FROM `exp` WHERE gpid_demo=21 order by id ";
$result=mysql_query($query);



while($line=mysql_fetch_array($result))
{
$tekst='';
echo "exp probleem: ".$line["id"]." - ".$line["nimi_est"]." <br>";
	
$tekst="<p>[[".$line["id"]."]]</p>";
$query1="SELECT * FROM `exp_exp` WHERE oid1=".$line["id"]." AND naita_veebis1=1";
$result1=mysql_query($query1);
while($line1=mysql_fetch_array($result1))
{
	$tekst=$tekst."<p>Lahendus:</p>";
	$tekst=$tekst."<p>[[".$line1["oid2"]."]]</p>";
}
	
echo $tekst;

$query2="UPDATE `fyysika_ee`.`raamatX` SET tekst='".$tekst."' WHERE id=".$line["raamatX_id"]." LIMIT 1";
		
echo $query2,"<br><br>";
//		$result2=mysql_query($query2);
}

	echo "korras ...";
?>

	