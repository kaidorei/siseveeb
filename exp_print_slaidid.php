<? 
require_once 'header.php';
mb_internal_encoding('UTF-8');
include("connect.php");
include("globals.php");

$kat=$_GET["kat"];
$expid=$_GET["expid"];

echo "Uuendan k&otilde;igi asjakohaste exp_objektide slaidiesitlused ... <br>";
//$line_temp["id"]=$_GET["id"];
//$query="SELECT * FROM exp WHERE on_slave=0 AND naita_veebis=1 AND gpid_demo=37 ORDER BY id";
$query="SELECT * FROM exp WHERE id=".$expid." LIMIT 1";

	echo $query;
$result=mysql_query($query);
$slideshow_id=0;
while($line=mysql_fetch_array($result))
{
	
// uus slaidishow tabelis book_slideshow
if($line["gpid_demo"]==30 OR $line["gpid_demo"]==37) //$line["gpid_demo"]==6 OR 
{

if($line["slideshow_id"]==0) //kui ei ole, siis teeme ...
{
	$query_slideshow="INSERT INTO `fyysika_ee`.`book_slideshow` (`id`, `user_id`, `title`, `slide_count`, `is_deleted`, `is_public`, `updated`) VALUES (NULL, '25', '".$db->real_escape_string($line["nimi_est"])."', NULL, '0', '1', '')";
	echo "ESITLUS uus: ",$query_slideshow,"<br>";
	$tmp=mysql_query($query_slideshow);
	$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
	$slideshow_id=$tmp["last_insert_id()"];
	mysql_query("UPDATE exp SET slideshow_id=".$slideshow_id." WHERE id=".$line["id"]."");
}
else
{
	$slideshow_id=$line["slideshow_id"];
//	echo "olemas: ".$slideshow_id."<br>";
}

//echo "ESITLUS ID: ",$line["slideshow_id"],"<br>";

// puhastame vana värgi ära ...
if($slideshow_id)
{
	$q_slides_del="DELETE FROM book_slide WHERE slideshow_id=".$slideshow_id." ";
	echo "ESITLUS puhastus: ",$q_slides_del,"<br>";
	$r_slides_del=mysql_query($q_slides_del);
}

// uued slaidid ...
	$q_slides="SELECT * from exp_exp WHERE oid1=".$expid." AND naita_veebis1=1 ORDER BY order1";
	echo $q_slides,"<br>";
	$r_slides=mysql_query($q_slides);
	$count_slides = 1;
	while($slide=mysql_fetch_array($r_slides))
	{
		//Meil on vaja pildiallkirjasid...
		$qq = "SELECT * from exp WHERE id=".$slide["oid2"];
		$rr = mysql_query($qq);
		$objekt = mysql_fetch_array($rr);		
		//echo $objekt["seletus_est"];
		
		if($objekt["gpid_demo"]==9)
		$position = 1;
		else
		$position = 1;
		
		$q_addslide="INSERT INTO `fyysika_ee`.`book_slide` (`id`, `slideshow_id`, `order_nr`, `exp_id`, `title`, `content`, `media`, `thumb`, `position`, `setup`, `notes`) VALUES (NULL, '".$line["slideshow_id"]."', '".$count_slides."', '".$slide["oid2"]."', '', '".$db->real_escape_string($objekt["kirjeldus_est"])."', NULL, NULL, '".$position."', NULL, NULL);";
		$r_addslide=mysql_query($q_addslide);
		
		
	echo "ESITLUS uued: ",$q_addslide,"<br>";
		
		
		
		$count_slides++;
	}
	mysql_query("UPDATE book_slideshow set slide_count=".$count_slides." WHERE id=".$line["slideshow_id"]);
	mysql_query("UPDATE book_slideshow set is_public=1 WHERE id=".$line["slideshow_id"]);
	mysql_query("UPDATE `fyysika_ee`.`book_slideshow` SET title='".$db->real_escape_string($line["nimi_est"])."' WHERE id=".$line["slideshow_id"]);
echo "uuendatud: ",$line["nimi_est"];?>

<a href="http://opik.fyysika.ee/index.php/slide/run/<? echo $slideshow_id;?>;" target="_blank"><img src="image/icon_slideshow.png" alt="slaididena" width="30" border="0" /></a>
<?
echo "<br>";
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
	
}
        
?>