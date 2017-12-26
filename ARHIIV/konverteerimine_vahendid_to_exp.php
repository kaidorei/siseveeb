<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
	require_once 'header.php';
?><? // note that multibyte support is enabled here 

$query="SELECT * FROM `vahendid` order by id ";
$result=mysql_query($query);

$id_0=27500;

while($line=mysql_fetch_array($result))
{
	
$id_vahe=$id_0 + $line["id"];

//echo "--------------------------------------------------------------------------<br>";
// teen raamatX 


// teen kronole vastavad pildiobjektid
$query1 = "INSERT INTO `fyysika_ee`.`exp` (`id`, `vahend_id`, `gpid_demo`,`naita_veebis`, `veeb_pilt_url`, `veeb_pilt_url_s`, `nimi_est`, `kirjeldus_est`) 
VALUES 
(".$id_vahe.", '".$line["id"]."', '35', '1', '".$line["veeb_pilt_url"]."', '".$line["veeb_pilt_url_s"]."', '".$db->real_escape_string($line["nimi_est"])."', '".$db->real_escape_string($line["kirjeldus_est"])."')";

echo $query1,"<br><br>";
//$result1=mysql_query($query1);
}

// Panen pildid külge ...

/*$query11="SELECT * FROM `krono_pildid` order by oid";
$result11=mysql_query($query11);

$ooid=0;
while($line11=mysql_fetch_array($result11))
{
$ooid = $id_0 + $line11["oid"];	
$query2 = "INSERT INTO `fyysika_ee`.`exp_pildid` (`id`, `oid`, `ord`, `nimi`, `url`, `veeb_pilt_url`, `veeb_pilt_url_s`, `copyright`, `allikas`, `in_veeb`, `allkiri_est`, `allkiri_eng`, `allkiri_rus`, `naita_veebis`) 
VALUES 
(NULL, '".$ooid."', '0', 'nimi_krono', '".$line11["url"]."', '', '', '', '', '1', NULL, NULL, NULL, '0');";

//echo $query2;
//$result2=mysql_query($query2);
}//while
*/	echo "korras ...";
?>

	