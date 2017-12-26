<?
    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
	require_once 'header.php';

$query="SELECT * FROM `raamatX` WHERE book_id>0 and pid=2";
$result=mysql_query($query);



while($line=mysql_fetch_array($result))
{
	
	
$query1="SELECT * FROM `exp` WHERE raamatX_id=".$line["id"]."";
$result1=mysql_query($query1);
$line1=mysql_fetch_array($result1);
	
echo "raamatX: ".$line["nimi_est"]." <br>exp:".$line1["nimi_est"]."<br>";

if($line["book_id"])
{
	$query2="SELECT * FROM `raamat` WHERE id=".$line["book_id"]."";
	$result2=mysql_query($query2);
	$line2=mysql_fetch_array($result2);
	echo $line2["veeb_pilt_url"]."<br>";
	if(!$line["veeb_pilt_url"] and $line2["veeb_pilt_url"])
	{
		$query2="UPDATE `fyysika_ee`.`exp` SET veeb_pilt_url='".$db->real_escape_string($line2["veeb_pilt_url"])."' WHERE id=".$line1["id"]." LIMIT 1";
		
		echo $query2,"<br><br>";
//		$result2=mysql_query($query2);
	}
	
	
// ... ning nikerdame annotatsiooniks tekstikatke ...	
	$jupp=strip_tags(substr($line["tekst"],0,300));
	$pattern = '/\[\{\[\d+\]\}\]/';
	$replacement = '';
	$annot = preg_replace($pattern, $replacement, $jupp);

	$pattern = '/\[\@\[\d+\,\d+\]\@\]/';
	$annot = preg_replace($pattern, $replacement, $annot);

	$query23="UPDATE `fyysika_ee`.`exp` SET kirjeldus_est='".$annot."' WHERE id=".$line1["id"]." LIMIT 1";
		
		echo $query23,"<br><br>";
//		$result23=mysql_query($query23);
	$query24="UPDATE `fyysika_ee`.`exp` SET nimi_est='".$db->real_escape_string($line["nimi_est"])."' WHERE id=".$line1["id"]." LIMIT 1";
		
		echo $query24,"<br><br>";
//		$result24=mysql_query($query24);
	
	
	
}
	

	
}


	echo "korras ...";
?>

	