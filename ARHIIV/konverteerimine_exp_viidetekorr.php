<?
    /* Connecting, selecting database */
	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
	require_once 'header.php';

$query="SELECT * FROM `raamatX_exp` WHERE book_id=63";
$result=mysql_query($query);



while($line=mysql_fetch_array($result))
{
	
//		$result24=mysql_query($query24);

$out = str_replace("(","",$line["meta1"]);	
$out = str_replace(")","",$out);	

echo $out,"<br><br>";
$query24="UPDATE `fyysika_ee`.`raamatX_exp` SET meta1='".$db->real_escape_string($out)."' WHERE id=".$line["id"]." LIMIT 1";
		
echo $query24,"<br><br>";
//$result24=mysql_query($query24);
	
}


	echo "korras ...";
?>

	