<? 
include("connect.php");
include("globals.php");
//echo $_POST["submit_value"];

$aid=$_GET["aid"];
//echo $aid;

$query0="SELECT * FROM raamatX WHERE pid='0' and book_id=15 ORDER BY id";
//echo $query0;
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
		if($line4["gpid_demo"]==8 or $line4["gpid_demo"]==2)
		{
			//echo "3d:",$line4["nimi_est"];
			$exp_3d[$count_3d]=$line4;	
			$count_3d++;
		}
		if($line4["gpid_demo"]==5 or $line4["gpid_demo"]==4)
		{
			//echo "3d:",$line4["nimi_est"];
			//$exp_simu[$count_simu]=$line4;	
			//$count_simu++;
		}
		if($line4["gpid_demo"]==4)
		{
			//echo "3d:",$line4["nimi_est"];
//			$exp_simu[$count_simu]=$line4;	
//			$count_simu++;
		}
		if($line4["gpid_demo"]==3 or $line4["gpid_demo"]==6)
		{
			//echo "3d:",$line4["nimi_est"];
			//$exp_tool[$count_tool]=$line4;	
			//$count_tool++;
		}
		
		
	}
// oskused, hindamismudeliks.

	$query6="SELECT * FROM raamatX_oskus WHERE oid1='".$line2["id"]."' ORDER BY id";
	$result6=mysql_query($query6);
	while($line6=mysql_fetch_array($result6))
	{
		$query7="SELECT * FROM oskus WHERE id='".$line6["oid2"]."'";
		$result7=mysql_query($query7);
		$line7=mysql_fetch_array($result7);
		//$oskus[$count_oskus]=$line7;	
		//$count_oskus++;
	}


}

$query12="SELECT oid2, naita_veebis1 FROM ".$baas."_".$baas." WHERE oid1=".$line["id"]." ORDER BY id ";
	$result12=mysql_query($query12);






	 ?>

  <?
/*for($i=0;$i<count($nimi_alateema);$i++)
{
	echo "<p>",$nimi_alateema[$i],"</p>";
}*/

?>



    <? 
	//echo $line["meetod_est"];	
	
	?>
<table>
  <? for($i=0;$i<$count_simu;$i++)
{
?>
  <tr>
   <td width="90%" >
     
     
     <strong>Nimi:</strong>
  <? 
	echo $exp_simu[$i]["nimi_est"];	
	
	?>
     <br />
     <strong>Annotatsioon:</strong> <? echo $exp_simu[$i]["kirjeldus_est"];?><br />
    <a href="https://www.youtube.com/v/<? echo $exp_simu[$i]["id_youtube"]; ?>" target="_blank">Link &otilde;piobjektile</a></td>
    <td width="138" ><? if ($exp_simu[$i]["veeb_pilt_url"]) {?><a href="https://www.youtube.com/v/<? echo $exp_simu[$i]["id_youtube"]; ?>" target=_blank><img src="<? echo urldecode($exp_simu[$i]["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" width="100" style="background-color: #CCCCCC" /></a><? } ?>
    
    
    </td>
  </tr>
  <? }?>
</table>
<table width="100%">
 <? for($i=0;$i<$count_3d;$i++)
{
?>
 <tr>
   <td valign="top" width="90%">
     <strong>Nimi:</strong>
  <? 
	echo $exp_3d[$i]["nimi_est"];	
	
	?>
     <br />
     <strong>Annotatsioon:</strong> <? echo $exp_3d[$i]["kirjeldus_est"];?><br />
     <? if ($exp_3d[$i]["gpid_demo"]==8) {
     
     
     
     if(strlen($exp_3d[$i]["id_3D"])<15)
							{// pikk kood ja lühike kood, lühike läheb välja vahetamisele
							?><a href="https://skfb.ly/<? echo $exp_3d[$i]["id_3D"];?>" target="_blank">Link simulatsioonile</a><?
							}
							else
							{ ?>
							<a href="https://sketchfab.com/models/<? echo $exp_3d[$i]["id_3D"];?>/embed" target="_blank">Link simulatsioonile</a>
								<?
							}
     
     ?>
     
     
      <? 
	 } else {?>
	 <a href="http://www.fyysika.ee/omad/exp_print.php?domain=exp&id=<? echo $exp_3d[$i]["id"];?>" target="_blank">Link simulatsioonile</a>
	 
	 <? }?></td>
    <td align="center" valign="top"><? if ($exp_3d[$i]["veeb_pilt_url"]) {?><a href=<? echo urldecode($exp_3d[$i]["veeb_pilt_url_s"]); ?> target=_blank><img src="<? echo urldecode($exp_3d[$i]["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" width="100" style="background-color: #CCCCCC" /></a><? } else {?>
              <img src="image/noimage.jpg" width="90" height="98" />              <? }?></td>
  </tr>
<?	} ?>
</table>
  
    T&ouml;&ouml;leht:
  </h2>
  <h2>
      <? for($i=0;$i<$count_tool;$i++)
{
?>
    <h2>
  <? 
	echo $exp_tool[$i]["nimi_est"];	
	
	?></h2>
      <br /><? echo $exp_tool[$i]["kokku_est"]; ?>
      <hr>
  <? }?>
  <table>
  <tr>
    <td valign="top"><p>Hindama peaks, kas &otilde;pilane on aru saanud, et:
      </p>
      <ul>
        <?
     for($i=0;$i<$count_oskus;$i++)
{
?>       <li>
          
          <? echo  $oskus[$i]["oskus_est"];?>
          </li>
        
      <?
     }
	
	?>     </ul>
      Hindamiseks soovitame kasutada siin esitatud testi ning kontrollk&uuml;simusi.
    </td>
  </tr>
</table>
<?
}}
?> 
             