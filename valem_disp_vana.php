
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
</script>
<script type="text/javascript"
  src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>


<?
	include("FCKeditor/fckeditor.php") ;
	$eh=$_GET["action"];
	$vid=$_GET["vid"];
	$aid=$_GET["aid"];
	$klass=$_GET["klass"];

	if($eh=="new"){
		$tmp=mysql_query("INSERT INTO valem (nimi_est) VALUES (\"Nimetu\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$vid=$tmp["last_insert_id()"];

// Kui on määratud peatükk 		
		if($aid and $klass)
		{
//			echo "teeme kohe seose vastava ainevärgiga<br>";
			$query_insert="INSERT INTO ".$klass."_valem (oid1,oid2) VALUES (\"".$aid."\",\"".$vid."\")";
			echo $query_insert;
			$tmp=mysql_query($query_insert);
				
		}
//			echo "tulemus",$expid;
		echo $vid;
		// ------------------------------------------------
	} elseif($eh=="save"){
		$valjad=array("nimi_est","tex");
		foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
		}
	if($eh=="save"){
		$query="UPDATE valem SET ".implode(",",$rida)." WHERE id=".$vid;		}
//		echo $query;
		$result=mysql_query($query);
	}	
	$query="SELECT * FROM valem WHERE id=".$vid;
//echo $query;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?>
<link href="scat.css" rel="stylesheet" type="text/css" />
 <br>

<form name="valem" method="post" action="<? echo $PHP_SELF."?page=valem_disp&klass=".$baas."&action=save&vid=".$vid; ?>">

<table width="100%" border="0" cellpadding="5">
  <tr>
    <td align="left" class="fields">Nimi: 
      </td>
    <td class="fields"><input name="nimi_est" type="text" class="fields" value="<? echo $line["nimi_est"]; ?>" size="65" /></td>
    <td class="fields"><input class="button" type="submit" name="Submit" value="Salvesta" /></td>
    </tr>
  <tr>
    <td align="left" class="fields">Tex:</td>
    <td class="fields"><input name="tex" type="text" class="pealkiri" value="<? echo $line["tex"]; ?>" size="65" /></td>
    <td class="fields">&nbsp;</td>
  </tr>
  <tr>
    <td width="38%" align="left" valign="top" class="fields">Img:</td>
    <td width="37%" align="center" valign="top"><? if ($line["image"]) {?><img src="http://www.fyysika.ee/omad/media/valem_pildid/<? echo urldecode($line["image"]); ?>" alt="Veebipilt puudub" name="image" /><? } ?></td>
    <td width="25%" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="38%" align="left" valign="top" class="fields">MathJax:</td>
    <td align="center" valign="top">
$$<? echo $line["tex"];?>$$</td>
    <td width="25%" valign="top">&nbsp;</td>
  </tr>
  </table>

</form>









