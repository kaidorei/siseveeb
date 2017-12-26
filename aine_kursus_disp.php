<? 	include ("connect.php");
	include("tabel_class_iid.php");

	header('Content-Type: text/html; charset=utf-8');
	require_once 'header.php';

	$klass=15;
 	$baas="raamat15";

	$query="SELECT * FROM raamat WHERE id=".$klass;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?>
<link href="scat.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js"></script>

  <table border="1" width="800" align="center">
  <tr>
    <td colspan="4" class="pealkiri"><? echo $line["nimi"]; ?></td>
    <td align="center" class="pealkiri">3D</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>


  
  <?
$count=1;
$query="SELECT * FROM ".$baas." WHERE pid=0 ORDER BY id";
$result=mysql_query($query);
while($line=mysql_fetch_array($result))
{
	$query12="SELECT oid2, naita_veebis1 FROM ".$baas."_".$baas." WHERE oid1=".$line["id"]." ORDER BY id ";
	$result12=mysql_query($query12);
?>
 <tr class="options">
    <td bgcolor="#FFFFCC">&nbsp;</td>
    <td bgcolor="#FFFFCC">Tunni teema</td>
    <td bgcolor="#FFFFCC">Peatükk</td>
    <td bgcolor="#FFFFCC">Test</td>
    <td bgcolor="#FFFFCC">LoodudSim</td>
    <td bgcolor="#FFFFCC">OlemasSim</td>
    <td bgcolor="#FFFFCC">Ülesanded</td>
    <td bgcolor="#FFFFCC">Tööleht</td>
    <td bgcolor="#FFFFCC">Juhend</td>
    <td bgcolor="#FFFFCC">Esitlus</td>
    <td bgcolor="#FFFFCC">LoodudVid</td>
    <td bgcolor="#FFFFCC">OlemasVid</td>
    <td bgcolor="#FFFFCC">HindamisMudel</td>
    <td bgcolor="#FFFFCC">Tunde</td>
    <td bgcolor="#FFFFCC">KOKKU</td>
    </tr>

<?
	while($agrupp=mysql_fetch_array($result12))
	{
		$query13="SELECT * FROM ".$baas." WHERE id=".$agrupp["oid2"];
		if ($n2ita_querysid) echo $query13."query13";
		$result13=mysql_query($query13);

		$agrupp_nimi=mysql_fetch_array($result13);
		?>
   <tr class="options">
    <td><? echo $count."."?></td>
    <td><? echo $agrupp_nimi["nimi_est"];?></td>
	<td><? echo $line["nimi_est"];?></td>
    <td>&nbsp;</td>
    <td><? 

// üle alam-alamgrupi
$query_123="SELECT oid2, naita_veebis1 FROM ".$baas."_".$baas." WHERE oid1=".	
$agrupp["oid2"]." ORDER BY id";
//echo $query_123;
$result_123=mysql_query($query_123);
while($line_123=mysql_fetch_array($result_123))
{
$query_tr="SELECT * FROM exp WHERE gpid_demo=8 ORDER BY id";
//echo $query_tr;
$result_tr=mysql_query($query_tr);
while($line_tr=mysql_fetch_array($result_tr))
{
	$query1234="SELECT * FROM ".$baas."_exp WHERE oid2=".$line_tr["id"]." AND oid1=".$line_123["oid2"];
//	echo $query1234;
	$result1234=mysql_query($query1234);
	if(mysql_fetch_array($result1234))
	{
		$query12345="SELECT * FROM exp WHERE id=".$line_tr["id"];
		$result12345=mysql_query($query12345);
		$exp_3d=mysql_fetch_array($result12345);
		?><img src="<? echo urldecode($exp_3d["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" width="50" name="veeb_pilt_url" style="background-color: #CCCCCC" /><?
	}
}
}
	?></td>
    <td><?

// üle alam-alamgrupi
$query_123="SELECT oid2, naita_veebis1 FROM ".$baas."_".$baas." WHERE oid1=".	
$agrupp["oid2"]." ORDER BY id";
//echo $query_123;
$result_123=mysql_query($query_123);
while($line_123=mysql_fetch_array($result_123))
{
$query_tr="SELECT * FROM exp WHERE gpid_demo=2 ORDER BY id";
//echo $query_tr;
$result_tr=mysql_query($query_tr);
while($line_tr=mysql_fetch_array($result_tr))
{
	$query1234="SELECT * FROM ".$baas."_exp WHERE oid2=".$line_tr["id"]." AND oid1=".$line_123["oid2"];
//	echo $query1234;
	$result1234=mysql_query($query1234);
	if(mysql_fetch_array($result1234))
	{
		$query12345="SELECT * FROM exp WHERE id=".$line_tr["id"];
		$result12345=mysql_query($query12345);
		$exp_3d=mysql_fetch_array($result12345);
		?><img src="<? echo urldecode($exp_3d["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" width="50" name="veeb_pilt_url" style="background-color: #CCCCCC" /><?
	}
}
}
	?></td>
    <td>&nbsp;</td>
    <td><?

// üle alam-alamgrupi
$query_123="SELECT oid2, naita_veebis1 FROM ".$baas."_".$baas." WHERE oid1=".	
$agrupp["oid2"]." ORDER BY id";
//echo $query_123;
$result_123=mysql_query($query_123);
while($line_123=mysql_fetch_array($result_123))
{
$query_tr="SELECT * FROM exp WHERE gpid_demo=3 OR gpid_demo=6 ORDER BY id";
//echo $query_tr;
$result_tr=mysql_query($query_tr);
while($line_tr=mysql_fetch_array($result_tr))
{
	$query1234="SELECT * FROM ".$baas."_exp WHERE oid2=".$line_tr["id"]." AND oid1=".$line_123["oid2"];
//	echo $query1234;
	$result1234=mysql_query($query1234);
	if(mysql_fetch_array($result1234))
	{
		$query12345="SELECT * FROM exp WHERE id=".$line_tr["id"];
		$result12345=mysql_query($query12345);
		$exp_3d=mysql_fetch_array($result12345);
		?><img src="<? echo urldecode($exp_3d["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" width="50" name="veeb_pilt_url" style="background-color: #CCCCCC" /><?
	}
}
}
	?></td>
    <td><p><strong>Sissejuhatuseks</strong>:</p>
     <p><strong>Õpiväljundid</strong>:</p>
     <p><strong>Metoodilised märkused</strong>:</p>     <? //echo $agrupp_nimi["meetod_est"];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><? echo $agrupp_nimi["tundide_arv"];?></td>
    <td>&nbsp;</td>
    </tr>
      
        <? $count++;

	} //tähtis while 
	?>
	<?
	
	
	
} 
  
  
 
  ?>  
  </table>










