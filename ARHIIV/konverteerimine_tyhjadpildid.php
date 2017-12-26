<?
    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
	require_once 'header.php';

$query="SELECT * FROM `exp` WHERE gpid_demo=9 and length(nimi_est)<5";
$result=mysql_query($query);



while($line=mysql_fetch_array($result))
{
	
echo "<br>Nimi: ".$line["nimi_est"]." Tyyp:".$line["gpid_demo"]." Slave:".$line["on_slave"]." naita_veebis:".$line["naita_veebis"]." Pilt:".$line["veeb_pilt_url"]." <br>Kirjeldus_est:".$line["kirjeldus_est"]." <br><strong>Seletus_est:".$line["seletus_est"]."</strong><br>";
if(is_numeric($line["nimi_est"]))
{
$query1="UPDATE `fyysika_ee`.`exp` SET gpid_demo=15 WHERE gpid_demo=9 and length(nimi_est)<5";
echo $query1,"<br><hr>";
//$result1=mysql_query($query1);

}


	
}


	echo "korras ...";
?>

	