<? 	
	mb_internal_encoding('UTF-8');
	$action=$_GET["action"];
	$klass=$_GET["klass"];
	$bookid=$_GET["bookid"];
	$aid=$_GET["aid"];
	$kat=$_GET["kat"];
	
	$tykid_kat=explode(",", $kat);
	for($ii = 1; $ii < sizeof($tykid_vv); ++$ii)
	{
		
	}
	
	
include("connect.php");
include("globals.php");
//echo $_POST["submit_value"];

$aid=$_GET["aid"];
//echo $aid;
$raamat_id=15;

$query0="SELECT * FROM raamatX WHERE book_id='".$raamat_id."' AND pid=0 ORDER BY jarjest";
$result0=mysql_query($query0);
while($line0=mysql_fetch_array($result0))
{
	echo "<h1>".$line0["nimi_est"]."</h1>";
	$query01="SELECT * FROM raamatX_raamatX WHERE oid1='".$line0["id"]."' ORDER BY order1";
	$result01=mysql_query($query01);
	while($line01=mysql_fetch_array($result01))
	{
		$query="SELECT * FROM raamatX WHERE id='".$line01["oid2"]."'";
		$result=mysql_query($query);
		$line=mysql_fetch_array($result);
		echo "<h2>".$line["nimi_est"]."</h2>";
		
		$nimi_teema=$line["nimi_est"];
		//echo "<h1>",$nimi_teema,"</h1>";
		
		$query1="SELECT * FROM raamatX_raamatX WHERE oid1='".$line["id"]."' ORDER BY id";
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

// paneme objektid kirja
while($line1=mysql_fetch_array($result1))
{
	$query2="SELECT * FROM raamatX WHERE id='".$line1["oid2"]."' ORDER BY id";
	$result2=mysql_query($query2);
	$line2=mysql_fetch_array($result2);
	array_push($nimi_alateema,$line2["nimi_est"]);

	$query3="SELECT * FROM raamatX_exp WHERE oid1='".$line2["id"]."' ORDER BY id";
	$result3=mysql_query($query3);
	while($line3=mysql_fetch_array($result3))
	{
		$query4="SELECT * FROM exp WHERE id='".$line3["oid2"]."'";
		$result4=mysql_query($query4);
		$line4=mysql_fetch_array($result4);
		if($line4["gpid_demo"]==8 or $line4["gpid_demo"]==2 or $line4["tex1"])// paneme kirja 3d simulatsioonid
		{
			//echo "3d:",$line4["nimi_est"];
			//kontrollime, kas selle id-ga video juba on nimekirjas ...
			$olemas=0;
			for($ii=0; $ii<count($exp_3d) ;$ii++ )
			{
				if($exp_3d[$ii]["id"]==$line4["id"])
				{
					$olemas=1;
				}
			}
			if($olemas==0)
			{
				$exp_3d[$count_3d]=$line4;	
				$count_3d++;
			}
		}
		if($line4["gpid_demo"]==5 or $line4["gpid_demo"]==4) // videod
		{
			//echo "3d:",$line4["nimi_est"];
			//kontrollime, kas selle id-ga video juba on nimekirjas ...
			$olemas=0;
			for($ii=0; $ii<count($exp_simu) ;$ii++ )
			{
				if($exp_simu[$ii]["id"]==$line4["id"])
				{
					$olemas=1;
				}
			}
			if($olemas==0)
			{
				$exp_simu[$count_simu]=$line4;	
				$count_simu++;
			}
		}
		if($line4["gpid_demo"]==6) // laborid
		{
			//echo "3d:",$line4["nimi_est"];
			//kontrollime, kas selle id-ga video juba on nimekirjas ...
			$olemas=0;
			for($ii=0; $ii<count($exp_tool) ;$ii++ )
			{
				if($exp_tool[$ii]["id"]==$line4["id"])
				{
					$olemas=1;
				}
			}
			if($olemas==0)
			{
				$exp_tool[$count_tool]=$line4;	
				$count_tool++;
			}
		}
		if($line4["gpid_demo"]==40 or $line4["gpid_demo"]==32 or $line4["gpid_demo"]==21 ) // kontrollkküsimused
		{
			//echo "3d:",$line4["nimi_est"];
			//kontrollime, kas selle id-ga video juba on nimekirjas ...
			$olemas=0;
			for($ii=0; $ii<count($exp_kk) ;$ii++ )
			{
				if($exp_kk[$ii]["id"]==$line4["id"])
				{
					$olemas=1;
				}
			}
			if($olemas==0)
			{
				$exp_kk[$count_kk]=$line4;	
				$count_kk++;
			}
		}
		
		
	}

}


$query12="SELECT oid2, naita_veebis1 FROM ".$baas."_".$baas." WHERE oid1=".$line["id"]." ORDER BY id ";
	$result12=mysql_query($query12);



	 ?>
    <h3>
   <? 
	//echo $line["meetod_est"];	
	
	?>
 Videod:
    </h3>
<table width="100%">
  <? for($i=0;$i<$count_simu;$i++)
{
	if($exp_simu[$i]["naita_veebis"]==1)
	{
?>
  <tr>
   <td valign="top" >
     
     
     <p><a href="https://www.youtube.com/v/<? echo $exp_simu[$i]["id_youtube"]; ?>" target=_blank><img vspace="8" hspace="8" align="right" src="<? echo urldecode($exp_simu[$i]["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" width="100" style="background-color: #CCCCCC" /></a><strong>Nimi:</strong>
       <? 
	echo $exp_simu[$i]["nimi_est"];	
	
	?>
       <br />
       <strong>Pikkus:</strong> <? echo $exp_simu[$i]["time_youtube"];?>
  <br />
       <strong>Annotatsioon:</strong> <? 
	   $text = $exp_simu[$i]["kirjeldus_est"];
	   $text = str_replace('<p>', '', $text);
	   $text = str_replace('</p>', '', $text);
	   echo $text;
	   
	   
	   ?><br />
    <a href="http://www.fyysika.ee/omad/exp_print.php?domain=exp&id=<? echo $exp_simu[$i]["id"];?>" target="_blank">Link &otilde;piobjektile</a>&nbsp;</p></td>
  </tr>
  <? } }?>
</table>
		
		
		<?
		
		
		
	}
}



?>







