<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "kaido", "biefeldt")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 


$query="SELECT * FROM materjalimaailm_ee.wp_posts WHERE post_status='publish'";
$result=mysql_query($query);
$raamatX_id=2300;

//echo $query;

while($line=mysql_fetch_array($result)){
if($line["post_title"])
{
	
// asendan <h3> boldiga	
	
$text_out = str_replace("<h3>","<strong>",$line["post_content"]);
$text_out = str_replace("</h3>","</strong>",$text_out);
$text_out = str_replace("../materjalid/","http://www.materjalimaailm.ee/materjalid/",$text_out);


$query1="INSERT INTO `fyysika_ee`.`raamatX` (`id`, `book_id`, `pid`, `tundide_arv`, `tykk`, `nimi_est`, `nimi_show`, `tekst`, `valjund_est`, `sissej_est`, `kokkuv_est`, `meetod_est`, `opilane_est`, `veeb_pilt_url`, `veeb_pilt_url_s`, `naita_veebis`, `deleted`, `jarjest`, `lupdate`) 
VALUES 
(".$raamatX_id.", '16', '1', '0', '', '".$line["post_title"]."', '1', '".$text_out."', '', '', '', '', '', '', '', '', '0', '0', '0000-00-00 00:00:00')";

echo $query1,"<br><br>";

//$result1=mysql_query($query1);
//Seoste kopeerimine?

$query2="INSERT INTO `fyysika_ee`.`raamatX_raamatX` (`id`, `book_id`, `order1`, `order2`, `oid1`, `oid2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naite_veebis2`) VALUES (NULL, '16', '0', '0', '2211', '".$raamatX_id."', '', '', '', '', '', '', '1', '1');";
//$result2=mysql_query($query2);
echo $query2,"<br><	br>";

}
$raamatX_id++;
?><hr> <? }
?>

	