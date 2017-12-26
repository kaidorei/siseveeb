<?

    /* Connecting, selecting database */

	mb_internal_encoding('UTF-8');

    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")

     	or die("Could not connect");

     print "Connected successfully";

    mysql_select_db("fyysika_ee") or die("Could not select database"); 

?><? // note that multibyte support is enabled here 

	require_once 'header.php';



$query="SELECT * FROM `raamatX_exp` WHERE book_id=41"; //Kõik laborid

$result=mysql_query($query);

while($line=mysql_fetch_array($result))

{

$query1="SELECT * FROM `exp` WHERE id=".$line["oid2"]."";

$result1=mysql_query($query1);

$line1=mysql_fetch_array($result1);

//echo "<br><br>LABOR: ".$line1["nimi_est"]."<br>";

$query3="SELECT * FROM `exp_exp` WHERE oid1=".$line1["id"];
//echo $query3." <br>";
$result3=mysql_query($query3);
while($line3=mysql_fetch_array($result3))

{

$query4="SELECT * FROM `exp` WHERE id=".$line3["oid2"]." ";
//echo $query4;
$result4=mysql_query($query4);

$line4=mysql_fetch_array($result4);


if($line4["probleem_est"]=='' AND $line4["kirjeldus_est"]=='' AND $line4["gpid_demo"]==21)

{
//echo $query4;
echo "<br><br>LABOR: ".$line1["nimi_est"]."(".$line4["id"].")<br>";
echo "hi!<br>"; 

$query24="UPDATE `fyysika_ee`.`exp` SET probleem_est='".$line3["title1"]."', gpid_demo=21 WHERE id=".$line4["id"]." LIMIT 1";

echo $query24,"<br>";
//$result24=mysql_query($query24);
$query25="UPDATE `fyysika_ee`.`exp_exp` SET title1='' WHERE id=".$line3["id"]." LIMIT 1";
echo $query25,"<br>";
//$result54=mysql_query($query25);
}



// Muurab exp_exp.meta1 exp.nimi_est tunnuse järgi
/*if(strstr($line4["nimi_est"],"Selgitus"))

{

echo "--------".$line4["nimi_est"]."<br>"; // META 1 välja muutmine

//$query24="UPDATE `fyysika_ee`.`exp_exp` SET meta1='Selgitus' WHERE id=".$line3["id"]." LIMIT 1";
$query24="UPDATE `fyysika_ee`.`exp` SET kirjeldus_est='Selgitus' WHERE id=".$line3["id"]." LIMIT 1";

echo $query24,"<br>";
//$result24=mysql_query($query24);

}
*/
/*if(strlen($line4["veeb_pilt_url"])<4 and $line4["gpid_demo"]==9 and strlen($line4["nimi_est"])<4) // objekti tüübi muutmine

{

echo "--------".$line4["nimi_est"]."<br>";

$query24="UPDATE `fyysika_ee`.`exp` SET gpid_demo = '15', seletus_est=kirjeldus_est WHERE id=".$line4["id"];

//$result24=mysql_query($query24);

		

echo $query24,"<br>";

$query25="UPDATE `fyysika_ee`.`exp` SET kirjeldus_est='' WHERE id=".$line4["id"];

echo $query25,"<br>";

//$result25=mysql_query($query25);

}*/



}



$out = str_replace("(","",$line["meta1"]);	

$out = str_replace(")","",$out);	



//echo $out,"<br><br>";

$query24="UPDATE `fyysika_ee`.`raamatX_exp` SET meta1='".$db->real_escape_string($out)."' WHERE id=".$line["id"]." LIMIT 1";

		

//echo $query24,"<br><br>";

//$result24=mysql_query($query24);

//		$result24=mysql_query($query24);

	

}





	echo "korras ...";

?>



	