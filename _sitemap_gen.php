<?

    /* Connecting, selecting database */

	mb_internal_encoding('UTF-8');

    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")

     	or die("Could not connect");

//     print "Connected successfully";

    mysql_select_db("fyysika_ee") or die("Could not select database"); 

?><? // note that multibyte support is enabled here 

	require_once 'header.php';

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo "\n";
echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
echo "\n";


$query="SELECT * FROM `exp` WHERE gpid_demo=43";

$result=mysql_query($query);

while($line=mysql_fetch_array($result))
{
	echo "<url>";
		echo "\n";
	echo "<loc>http://opik.fyysika.ee/index.php/book/section/".$line["raamatX_id"]."</loc>";
		echo "\n";
/*	
$query1="SELECT * FROM `exp` WHERE id=".$line["oid2"];
$result1=mysql_query($query1);
$line1=mysql_fetch_array($result1);
echo $line1["nimi_est"]."<br>";
*/
echo "</url>";
echo "\n";


}
echo "</urlset> ";

?>



	