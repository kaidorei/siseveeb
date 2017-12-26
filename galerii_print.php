<? 
include("connect.php");
include("globals.php");

//echo $_POST["submit_value"];

$eh=$_GET["action"];
$id=$_GET["id"];
$domain=$_GET["domain"];

$query="SELECT galerii FROM ".$domain." WHERE id=".$id;
//echo $query;
$result=mysql_query($query);
$line=mysql_fetch_array($result);
 
switch($domain)
{
case 'exp': $imgdir="http://www.fyysika.ee/pildid/Image/Tootuba/".$line["galerii"]."/thumbs/"; $imgdir_s="http://www.fyysika.ee/pildid/Image/Tootuba/".$line["galerii"]."/thumbs_s/"; $misasjale="töötoale"; break;
case 'reis': $imgdir="http://www.fyysika.ee/pildid/Image/Teadusbuss/".$line["galerii"]."/thumbs/"; $imgdir_s="http://www.fyysika.ee/pildid/Image/Teadusbuss/".$line["galerii"]."/thumbs_s/"; $misasjale="reisile"; break;
default: $imgdir="http://www.fyysika.ee/pildid/Image/Teadusbuss/".$line["galerii"]."/thumbs/"; $imgdir_s="http://www.fyysika.ee/pildid/Image/Teadusbuss/".$line["galerii"]."/thumbs_s/"; $misasjale="reisile"; break;
}


$lst=list_dir($imgdir);
sort($lst);


// kontrollime, kas sellisele pildinimele vastab kirje tabelis "pildid_allkirjad" ...
foreach($lst as $img)
{

//	echo "SELECT * FROM pildid_allkirjad WHERE fail='".$img."' AND oid='".$id."'";
	$result_pilt=mysql_query("SELECT * FROM pildid_allkirjad WHERE fail='".$img."' AND oid='".$id."'" );
	if(!mysql_fetch_array($result_pilt))
	{ // pole allkirja, lisame kirje ...
		$query_insert="INSERT INTO `pildid_allkirjad` ( `id` ,`oid`, `ord` , `domain` , `url_kataloog` , `fail` , `pealkiri` , `allkiri`, `show_image` ) 
VALUES (NULL , '".$id."','".$count."','".$domain."', '".$imgdir."', '".$img."', '', '', '1')"; 
	$result_insert=mysql_query($query_insert);
//		$line_insert=mysql_fetch_array($result_insert);
	$count=$count+20;
	}
	else
	{
	}
}


?>
<html>
<link href="scat.css" rel="stylesheet" type="text/css">
<head>
 <title>galerii</title>
<STYLE TYPE='text/css'>
P.pagebreakhere {page-break-before: always}
.style1 {
	color: #00FF00;
	font-style: italic;
}
</STYLE>
</head>

<body>
<? 	

$result_exp=mysql_query("SELECT * FROM exp WHERE id='".$id."'" );
$line_exp=mysql_fetch_array($result_exp);

?>
  <u>Katsevahendid: </u><ul>
      <? 
	$result_vahe=mysql_query("SELECT * FROM exp_vahendid WHERE oid1='".$id."' ORDER BY id");
//	echo "SELECT * FROM exp_vahendid WHERE oid1='".$id."' ORDER BY id";
$count_t=0;
	while($line_vahe=mysql_fetch_array($result_vahe))
	{
			$result_vah=mysql_query("SELECT * FROM vahendid WHERE id=".$line_vahe[oid2]." ORDER BY id DESC " );
//	echo "SELECT * FROM vahendid WHERE id=".$line_vahe[oid2]." ORDER BY id DESC " ;
			if($line_vah=mysql_fetch_array($result_vah))
			{
				
				?><li><? echo $line_vahe['title1']; ?></li>
      <?
			}
			
	} ?>
	</ul>
  <p><br>
    
    <u>T&ouml;&ouml; k&auml;ik</u>    
  <?

//		$lst=list_dir($imgdir);
//		sort($lst);
	$count=100;

	
// Loeme andmebaasist sellele id-le vastavad failid ning teeme nendest tabeli	
	$result_pilt=mysql_query("SELECT * FROM pildid_allkirjad WHERE domain='".$domain."' AND oid='".$id."' AND show_image=1 ORDER BY ord" );
//	echo "SELECT * FROM pildid_allkirjad WHERE domain='".$domain."' AND oid='".$id."' ORDER BY ´ord´";
$count = 0;
	while($line_pilt=mysql_fetch_array($result_pilt))
	{
?>          
</p>
 
<table bord="0" cellpadding="0" cellspacing="0" width="100%" >
 
     <tr>
        <td width="4%" valign="top" ><img width="200" src="<? echo $imgdir_s,$line_pilt["fail"]; ?>" border="0" bord="0">          </td>
        <td width="1%" valign="top"><img src="http://www.fyysika.ee/omad/image/spacer.gif" alt="" width="5"></td>
        <td colspan="2" valign="top">      <? echo $line_pilt["allkiri"];?>         <div align="right"></div></td>
   </tr>
     
</table> 
<p>
  <? //		echo $img;
$count++;

	}?>
    </p>
<p><u>Kuidas asi töötab:</u></p>
<p><iframe width="420" height="315" src="//www.youtube.com/embed/af7gpFMiMvE" frameborder="0" allowfullscreen></iframe> </p>
<p><u>Võimalikud probleemid</u></p>
<? echo $line_exp["misvalesti_est"]; ?>   
</body>
</html>
<?

/********* FUNCTIONNS *****************************************/

function list_dir($dirname)
{
	static $result_array=array();  
	$handle=opendir($dirname);
//	echo  $handle;
	while ($file = readdir($handle))
	{
		if($file=='.'||$file=='..')
			continue;
		if(is_dir($dirname.$file))
			list_dir($dirname.$file.'\\'); 
		else
			$result_array[]=$file;
	}	
	closedir($handle);
	return $result_array;

}
?>