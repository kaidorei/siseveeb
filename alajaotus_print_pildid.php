<? 
include("connect.php");
include("globals.php");
//echo $_POST["submit_value"];

$aid=$_GET["aid"];
//echo $aid;

$query0="SELECT * FROM raamatX WHERE pid='0' and book_id=15 ORDER BY id";
echo $query0;
$result0=mysql_query($query0);
while($line0=mysql_fetch_array($result0))
{

$query00="SELECT * FROM raamatX_raamatX WHERE oid1='".$line0["id"]."' and book_id=15 ORDER BY id";
$result00=mysql_query($query00);


while($line00=mysql_fetch_array($result00))
{

$aid = $line00["oid2"];


$query="SELECT * FROM raamatX WHERE id='".$aid."' ORDER BY id";
$result=mysql_query($query);
$line=mysql_fetch_array($result);

$nimi_teema=$line["nimi_est"];
echo "<h1>",$nimi_teema,"</h1>";

$query1="SELECT * FROM raamatX_raamatX WHERE oid1='".$aid."' ORDER BY id";
//echo $query1;
$result1=mysql_query($query1);
$nimi_alateema=array();

$exp_3d=array();
$exp_tool=array();
$exp_oskus=array();
$count_3d=0;
$count_simu=0;
$count_tool=0;
$count_oskus=0;

while($line1=mysql_fetch_array($result1))
{
	$query2="SELECT * FROM raamatX WHERE id='".$line1["oid2"]."' ORDER BY id";
	$result2=mysql_query($query2);
	$line2=mysql_fetch_array($result2);
	array_push($nimi_alateema,$line2["nimi_est"]);
// paneme kirja 3d simulatsioonid
	$query3="SELECT * FROM raamatX_exp WHERE oid1='".$line2["id"]."' ORDER BY id";
	$result3=mysql_query($query3);
	while($line3=mysql_fetch_array($result3))
	{
		$query4="SELECT * FROM exp WHERE id='".$line3["oid2"]."'";
		$result4=mysql_query($query4);
		$line4=mysql_fetch_array($result4);
		if($line4["gpid_demo"]==9 or $line4["gpid_demo"]==5)
		{
			//echo "3d:",$line4["nimi_est"];
			$line4["nimi_est"]=$line3["title1"];
			$exp_simu[$count_simu]=$line4;	
			
			$count_simu++;
		}		
		
	}


}

$query12="SELECT oid2, naita_veebis1 FROM ".$baas."_".$baas." WHERE oid1=".$line["id"]." ORDER BY id ";
	$result12=mysql_query($query12);






	 ?>
<h2>Alateemad:</h2>

  <?
for($i=0;$i<count($nimi_alateema);$i++)
{
	echo "<p>",$nimi_alateema[$i],"</p>";
}

?>
<h2>  Pildid ja allkirjad</h2>
<table>
  <? for($i=0;$i<$count_simu;$i++)
{
?>
  <tr>
   <td width="90%" valign="top" ><? 
	echo $exp_simu[$i]["nimi_est"];	
	
	?>
     
    </td>
    <td width="138" ><? if ($exp_simu[$i]["veeb_pilt_url"]) {?><img width="350" src="<? echo urldecode($exp_simu[$i]["veeb_pilt_url_s"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url_s"  style="background-color: #CCCCCC" /><? } ?>
    
    
    </td>
  </tr>
  <? }?>
</table>
  <h2>
    <?
}}
?> 
  </h2>