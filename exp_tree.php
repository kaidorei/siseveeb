<style type="text/css">
<!--
.style2 {color: #FF0000}
-->
</style>
<link href="scat.css" rel="stylesheet" type="text/css" />

<?
mb_internal_encoding('UTF-8');
$n2ita_querysid = FALSE;
@$klass=$_GET["klass"];
@$open_string=$_GET["op"];
switch ($klass)
{
	case "teadus": $baas="pacs"; $tutvustus="Teadusteemad"; break;
	case "tehno": $baas="tehno"; $tutvustus="Tehnoteemad"; break;
	case "kool": $baas="aine"; $tutvustus="EKSPERIMENDID LIIGITATUNA F&Uuml;&Uuml;SIKA TEEMADE J&Atilde;RGI"; break;
	case "raamat6": $baas=$klass; $tutvustus="F&uuml;&uuml;sika IX klassile"; break;
	case "raamat1": $baas=$klass; $tutvustus="F&uuml;&uuml;sika VIII klassile"; break;
	case "raamat17": $baas=$klass; $tutvustus="F&uuml;&uuml;sikalise loodusk&atilde;sitluse alused"; break;
	case "raamat16": $baas=$klass; $tutvustus="Materjalimaailm"; break;
	case "raamat14": $baas=$klass; $tutvustus="Indrek Peil \"MEHAANIKA\" - alajaotused ja &otilde;piobjektid"; break;
	case "raamat15": $baas=$klass; $tutvustus="Tarkpea, Voolaid \"Elektrod&uuml;naamika\" - alajaotused ja &otilde;piobjektid"; break;
	default:  $baas=$klass; $tutvustus="EKSPERIMENDID LIIGITATUNA TEEMADE JÄRGI (et n&auml;ha teemadele vastavaid eksponaati vajuta ristiga ikoonile)"; break;
}

	@$up1=$_GET["up1"];
	@$up2=$_GET["up2"];
	
	//echo @$up1.@$up2;
	$var_gpid=array();
	$query_gpid="SELECT id,ico_url_v FROM exp_grupid_demo";
	$result_gpid=mysql_query($query_gpid);
	while($line_gpid=mysql_fetch_array($result_gpid))
	{
		$var_gpid[$line_gpid["id"]]=$line_gpid["ico_url_v"];
//		echo $line_gpid["ico_url_v"];
	}

	
if($up1!=NULL)
{
//	echo $up1,"   ", $up2; miks siin üle kirjutatakse???
	//muudan kolme sammuga nende kahe id
	$que1  = array('oid1', 'oid2', 'title1', 'title2', 'sisse1', 'sisse2', 'sisu1', 'sisu2');
	$query1="SELECT ".implode(', ',$que1)." FROM aine_exp WHERE id=".$up1;
	$result1=mysql_query($query1);
	$var1=mysql_fetch_array($result1);
	$query2="SELECT ".implode(', ',$que1)." FROM aine_exp WHERE id=".$up2;
	$result2=mysql_query($query2);
	$var2=mysql_fetch_array($result2);

	//echo "kaido ".$var2["oid2"];
	
	$query1="UPDATE aine_exp SET oid1=".$var2["oid1"].", oid2=".$var2["oid2"].", title1='".$var2["title1"]."', title2='".$var2["title2"]."', sisse1='".$var2["sisse1"]."', sisse2='".$var2["sisse2"]."', sisu1='".$var2["sisu1"]."', sisu2='".$var2["sisu2"]."' WHERE id=".$up1;
	$result1=mysql_query($query1);
	$query2="UPDATE aine_exp SET oid1=".$var1["oid1"].", oid2=".$var1["oid2"].", title1='".$var1["title1"]."', title2='".$var1["title2"]."', sisse1='".$var1["sisse1"]."', sisse2='".$var1["sisse2"]."', sisu1='".$var1["sisu1"]."', sisu2='".$var1["sisu2"]."' WHERE id=".$up2;
	$result2=mysql_query($query2);
	
//	echo $query1;
//	echo $query2;
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="3">
	        <tr>			
  <td width="100%" class="pealkiri"><? echo $tutvustus;?></td></tr>
</table>
<?
if (isset($baas)) {
	$is_aine = ($baas === "aine");
	$is_pacs = ($baas === "pacs");
	$is_tehno = ($baas === "tehno");
	if ($is_aine) $tasemeid = 3;
	if ($is_pacs) $tasemeid = 3;
	if ($is_tehno) $tasemeid = 3;
	if (!$is_aine && !$is_pacs && !$is_tehno) {
//		echo $baas;
			$temp = explode("raamat",$baas);
			$raamatunumber = $temp[1];
			$query_0="SELECT tasemeid FROM raamat WHERE id=".$raamatunumber;
			$result_0=mysql_query($query_0);
			$temp2=mysql_fetch_array($result_0);
			$tasemeid=$temp2["tasemeid"];
	}
}$query="SELECT * FROM ".$baas." WHERE pid=0 ORDER BY id";
?>
<a href="aine_kursus_disp.php">Tunnijaotusplaan</a>
<?
if ($n2ita_querysid) echo $query."query";
$result=mysql_query($query);

while($line=mysql_fetch_array($result))
{
		$open=explode(',',@$_GET["op"]);	
		$openasi=0;
		if (in_array($line["id"],$open))
			{
				$openasi=1;	
				//echo $line['id'];
			}
?>

<span class="navi"><? //echo @$agrupp2_nimi["naita_veebis"]."aha";?></span>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="7" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td></tr>
  <tr>
<? 

	  	// kustutame või paneme selle id $open listi, väljundiks on $tmp mis pannakse edaspidises linkimisse
		//kui on avatud, siis paneme kinni, selleks kopeerime $open vektori va see id mis parajasti akuutne
		  $tmp=array();
		  	if($openasi){
			foreach($open as $val){
				if($val!=$line["id"]){ 
					array_push($tmp,$val); 
					}
				}
			} else {
			//kui oli suletud siis paneme id vektori lõppu ...
			if($open[0]!=0){$tmp=$open;}
			array_push($tmp,$line["id"]);
			}
?>
    <td width="4%" >
	<a href="index.php?page=exp_tree&op=<? echo implode(",",$tmp);?>&klass=<? echo $klass;?>"><img border=0 src="image/index_<?  if($openasi){ echo "39";  } else { echo "36"; }?>.gif" width=19 height=19 alt=""></a></td>
    <td  width="79%" class="navi" nowrap><a href="index.php?page=aine_disp&aid=<? echo $line["id"]; ?>&klass=<? echo $klass;?>" class="ekraan_link">
	<? echo $line["nimi_est"]; //siin on esimene aste ?> 
	</a> - <? echo $line["tundide_arv"] ;?></td>
   <td width="17%" valign="middle" > <a href="http://www.fyysika.ee/omad/index.php?page=aine_disp&action=new&klass=<? echo $klass;?>&parent=<? echo $line["id"];?>" class="smallbody" target="_blank">Lisa&nbsp;alajaotus</a></td>
  </tr>
</table>

							
<?

// Laotame lahti alamgrupi nr 1
		if ($openasi) {
				$query12="SELECT oid2, naita_veebis1 FROM ".$baas."_".$baas." WHERE oid1=".$line["id"]." ORDER BY id";
				if ($n2ita_querysid) echo $query12."query12";
				$result12=mysql_query($query12);
				
////////////////////////////////////////////////////////////////////////////////				
// siia kohta tuleb järjestamine pacs tabeli kirje jarjest järgi ...


//echo "<pre>";
//var_dump( $query12."1 <p>seal	</p>1");
//var_dump( mysql_fetch_array($result12));
//echo "</pre>";
				
				//Alamasja loop algab siit
				
				while($agrupp=mysql_fetch_array($result12)){ //tähtis while tsükkel
					$openasi_alamg=0;
					if (in_array($agrupp["oid2"],$open)){
						$openasi_alamg=1;	
						}
							
						$query13="SELECT * FROM ".$baas." WHERE id=".$agrupp["oid2"];
				 		if ($n2ita_querysid) echo $query13."query13";
						$result13=mysql_query($query13);

						$agrupp_nimi=mysql_fetch_array($result13);
						?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr> 
    	<td colspan="4" background="image/sinine.gif"><img src="image/valge.gif" width="55" height="1"></td>
  	</tr>
  	<tr> 
      <? // jällegi, avame või sulgeme alamrühma
		  	  		  $tmp=array();
					  if($openasi_alamg){
						foreach($open as $val){
							if($val!=$agrupp["oid2"]) { 
							array_push($tmp,$val); 
								}
							}
						} else {
						if($open[0]!=0){$tmp=$open;}
						array_push($tmp,$agrupp["oid2"]);
						}
						?>
   		<td width="3%" nowrap><img src="image/spacer.gif" width="33" height="9"> <a href="index.php?page=exp_tree&op=<? echo implode(",",$tmp);?>&klass=<? echo $klass;?>"><img border=0 src="image/index_<?  if($openasi_alamg){ echo "39";  } else { echo "36"; }?>.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></a></td> <? //see tekitab pluss märgi või miinusmärgi sinna ette koos lingiga ?>
   	  <td width="54%" align="left" class="navi"><a href="index.php?page=aine_disp&aid=<? echo $agrupp["oid2"]; ?>&klass=<? echo $klass;?>"  class="ekraan_link" target="_blank"><? echo $agrupp_nimi["nimi_est"];  ?></a> - <? echo $agrupp_nimi["tundide_arv"]; ?> <a href="index.php?page=aine_tund_disp&aid=<? echo $agrupp["oid2"]; ?>&klass=<? echo $baas;?>" target="_blank">&otilde;petajaraamat</a>
      <?
	
//	uurin, kas seal sees mõni objekt ka on ...

	$query34="SELECT id, oid2 FROM ".$baas."_exp WHERE oid1=".$agrupp_nimi["id"];
//echo $query34;
	$result34=mysql_query($query34);
	if(!mysql_fetch_array($result34)){
// et kui on veel üks tase, siis ei näita ...

				$query221="SELECT oid2, naita_veebis1, id FROM ".$baas."_".$baas." WHERE oid1=".$agrupp["oid2"];
				$result221=mysql_query($query221);
				if(!mysql_fetch_array($result221)){

	?><span class="style2">(T&uuml;hi)</span>      <? }}?></td>
<? if ($tasemeid == 2) { ?>		<td width="20%" class=\"menu\" ><input type="button" name="suva1" class="button" value="Lisa Exp/Demo" onClick="window.open('addvalue_iid.php?domain=<? echo $baas;?>_exp&oid=<? echo $agrupp["oid2"]; ?>&sel=1','File_upload','toolbar=0,width=630,height=450,status=yes');"><? } ?>
<td width="13%" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=aine_disp&action=new&klass=<? echo $klass;?>&parent=<? echo $agrupp_nimi["id"];?>" class="smallbody" target="_blank">Lisa&nbsp;alajaotus</a>
</td>
  	</tr>
</table>



<?

// Laotame lahti alamgrupi nr 2
		if ($openasi_alamg){					
				$query21="SELECT oid2, naita_veebis1, id FROM ".$baas."_".$baas." WHERE oid1=".$agrupp["oid2"]." ORDER BY id";
				if ($n2ita_querysid) echo $query21."query21".$agrupp["oid2"];
				$result21=mysql_query($query21);
				//Alamasja loop algab siit
				if ($n2ita_querysid) var_dump($agrupp2=mysql_fetch_array($result21));
				while($agrupp2=mysql_fetch_array($result21)){
					$openasi_alamg2=0;
					if ($n2ita_querysid) var_dump ($agrupp2." ");
					if (in_array($agrupp2["oid2"],$open)){
						$openasi_alamg2=1;	
						}
							
						$query22="SELECT * FROM ".$baas." WHERE id=".$agrupp2["oid2"];
						if ($n2ita_querysid) echo "<p>t".$query22."query22"."t<p>";
						$result22=mysql_query($query22);
						$agrupp2_nimi=mysql_fetch_array($result22)
						?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr> 
    	<td colspan="6" background="image/sinine.gif"><img src="image/valge.gif" width="55" height="1"></td>
  	</tr>
  	<tr> 
      <? // jällegi, avame või sulgeme alamrühma
		  	  		  $tmp=array();
					  if($openasi_alamg2){
						foreach($open as $val){
							if($val!=$agrupp2["oid2"]) { 
							array_push($tmp,$val); 
								}
							}
							} else {
							if($open[0]!=0){$tmp=$open;}
							array_push($tmp,$agrupp2["oid2"]);
						}
						?>
   		
    <td nowrap><img src="image/spacer.gif" width="73" height="11"> <a href="index.php?page=exp_tree&op=<? echo implode(",",$tmp);?>&klass=<? echo $klass;?>"><img border=0 src="image/index_<?  if($openasi_alamg2){ echo "39";  } else { echo "36"; }?>.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></a></td>
    	
    <td width="100%" class="navi"><a href="index.php?page=aine_disp&aid=<? echo $agrupp2["oid2"]; ?>&klass=<? echo $klass;?>" class="ekraan_link" target="_blank"><? echo $agrupp2_nimi["nimi_est"];  ?></a> - <? echo $agrupp2_nimi["tundide_arv"]; ?> <?
	
//	uurin, kas seal sees mõni objekt ka on ...

	$query34="SELECT * FROM ".$baas."_exp WHERE oid1=".$agrupp2_nimi["id"];
//echo $query34;
	$result34=mysql_query($query34);
	if(!mysql_fetch_array($result34)){

	?>
      <span class="style2">(T&uuml;hi)</span>      <? }?></td>
  		<td width="6%" bgcolor="#CCFF99" class=\"menu\" ><input type="button" name="suva1" class="button" value="Lisa exp" onClick="window.open('addvalue_iid.php?domain=<? echo $baas;?>_exp&oid=<? echo $agrupp2["oid2"]; ?>&sel=1','File_upload','toolbar=0,width=630,height=450,status=yes');">
  	</td>
  		<td width="7%" bgcolor="#CCFF99" class=\"menu\" ><a href="index.php?page=exp_disp&aid=<? echo $agrupp2["oid2"];?>&klass=<? echo $baas;?>&action=new" target="_blank" class="button">
        Uus</a></td>
    <td bgcolor="#FFFF99"><input type="button" name="suva2" class="button" value="Lisa Nupula" onClick="window.open('addvalue_iid.php?domain=<? echo $baas;?>_nupula&oid=<? echo $agrupp2["oid2"]; ?>&sel=1','File_upload','toolbar=0,width=630,height=450,status=yes');"></td>
    <td bgcolor="#FFFF99"><a href="index.php?page=nupula_disp&aid=<? echo $agrupp2["oid2"];?>&klass=<? echo $baas;?>&action=new" target="_blank" class="button">Uus</a></td>
  	</tr>
</table>

<? 
					if ($openasi_alamg2)
					{					
// Laotame lahti alamgrupi 2 eksponaadid ...
						$query34="SELECT * FROM ".$baas."_exp WHERE oid1=".$agrupp2["oid2"]." ORDER BY order1";
						if ($n2ita_querysid) echo $query34."query34 rrt".$exp_seos;
						$id_prev=0;
						
						$result34=mysql_query($query34);
						if($result34 == NULL) {}
						while($exp_seos=mysql_fetch_array($result34))
						{
						//echo "<pre>";
						
						//var_dump($exp_seos);
						//echo "</pre>";
						//echo "<p>";
							$query35="SELECT id,nimi_est, video_url, video_url_suur, veeb_pilt_url,gpid_demo FROM exp WHERE id=".$exp_seos["oid2"];
							if ($n2ita_querysid) echo $query35."query35"."<p>";
							$result35=mysql_query($query35);
							if ($n2ita_querysid) echo "<p>as".$query35;
							if ($result35 == TRUE) $exponaat_nimi=mysql_fetch_array($result35);
							//if ($result35 == FALSE)
							//echo "<p>";
							//
							
									?>
							
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td colspan="7" background="image/sinine.gif"><img src="image/valge.gif" width="80" height="1"></td>
  </tr>
  <tr> 
    <td width="10%" rowspan="3" valign="top"><div align="right"><img src="image/spacer.gif" width="129" height="12"><span class="ekspon"><? echo $exp_seos["meta1"]; ?><img src="image/spacer.gif" alt="ert" width="<? echo 25 - 6*strlen($exp_seos["order1"]); ?>" height="9" /></span></div></td>
    <td width="5%" rowspan="3" valign="top"><div align="center"><span class="ekspon"><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span><img src="<? echo $var_gpid[$exponaat_nimi["gpid_demo"]];?>"  alt="" border=0 ><span class="ekspon"><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span></div></td>
    <td class="ekspon"><a href="index.php?page=exp_disp&expid=<? echo $exponaat_nimi["id"];?>" target="_blank"><em><? echo $exponaat_nimi["nimi_est"]; ?></em></a><br />
      <? if($exponaat_nimi["video_url"]){ ?>
      <a class="button3" href="<? echo $exponaat_nimi["video_url"]; ?>">Video</a>
      <? }?>
 	</span></td>
    <td width="2%" rowspan="3" class="ekspon"><div align="right">
        <input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=<? echo $baas; ?>_exp&id=<? echo $exp_seos["id"]; ?>&sel=1','Delete','toolbar=0,width=920,height=800,status=yes');" >
    </div></td>
    <td width="2%" rowspan="3" class="ekspon"><input name="button2" type="button" class="button2" onclick="window.open('delvalue_iid.php?domain=<? echo $baas; ?>_exp&id=<? echo $exp_seos["id"]; ?>&sel=1','Delete','toolbar=0,width=420,height=200,status=yes');" value="x" /></td>
    <td width="8%" rowspan="3" align="right" class="ekspon"><? if($exponaat_nimi["veeb_pilt_url"]){?><img width="60" src="<? echo urldecode($exponaat_nimi["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"><? } else { ?><img border=1 src="image/spacer.gif" width="60" height="45"><? }?></td>
  </tr>
  <tr>
<!--pane tähele, et siin on küsitud otse title1-te, st teiselt poolt vaadates asi ei töötaks-->
    <td class="navi"><? echo "Pildiallkiri/before: "; ?><span class="menu"><? echo $exp_seos["title1"]; ?></span></td>
  </tr>
  <tr>
    <td class="navi"><? echo "Kokkuv&otilde;te: "; ?><? echo $exp_seos["sisu1"]; ?></td>
  </tr>
</table>	
<?

						$id_prev=$exp_seos["id"];


						} // end of alamgrupid 2 eksponaat
						
						
						// Laotame lahti alamgrupi 2 nupula ...
										
						$query74="SELECT * FROM ".$baas."_nupula WHERE oid1=".$agrupp2["oid2"]." ORDER BY order1";
						if ($n2ita_querysid) echo $query74."query74 rrt".$exp_seos;
						$id_prev=0;
						
						$result74=mysql_query($query74);
						if($result74 == NULL) {}
						while($nupula_seos=mysql_fetch_array($result74))
						{
						//echo "<pre>";
						
						//var_dump($exp_seos);
						//echo "</pre>";
						//echo "<p>";
							$query75="SELECT * FROM nupula WHERE id=".$nupula_seos["oid2"];
							if ($n2ita_querysid) echo $query75."query75"."<p>";
							$result75=mysql_query($query75);
							if ($n2ita_querysid) echo "<p>as".$query75;
							if ($result75 == TRUE) $nupula_nimi=mysql_fetch_array($result75);
							//if ($result35 == FALSE)
							//echo "<p>";
							//
							
									?>
							
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td colspan="7" background="image/sinine.gif"><img src="image/valge.gif" width="80" height="1"></td>
  </tr>
  <tr> 
    <td width="10%" rowspan="3" align="right" valign="top"><div align="right"><img src="image/spacer.gif" width="129" height="12"><span class="ekspon"><? echo $nupula_seos["meta1"]; ?><img src="image/spacer.gif" alt="ert" width="<? echo 25 - 6*strlen($exp_seos["order1"]); ?>" height="9" /></span></div></td>
    <td width="5%" rowspan="3" align="center" valign="middle"><span class="button2">N</span> </td>
    <td class="ekspon"><a href="index.php?page=nupula_disp&nid=<? echo $nupula_nimi["id"];?>" target="_blank"><em><? echo $nupula_nimi["nimi_est"]; ?></em></a> Tyyp: <? echo $nupula_nimi["liik"];?> <span class="navi">N&auml;ita &otilde;pikus:<? echo $nupula_seos["naita_veebis1"],"  ";?>N&auml;ita: <? echo $nupula_nimi["naita_veebis"];?></span> </td>
    <td width="2%" rowspan="3" class="ekspon"><div align="right">
        <input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=<? echo $baas; ?>_nupula&id=<? echo $nupula_seos["id"]; ?>&sel=1','Delete','toolbar=0,width=920,height=800,status=yes');" >
    </div></td>
    <td width="2%" rowspan="3" class="ekspon"><input name="button2" type="button" class="button2" onclick="window.open('delvalue_iid.php?domain=<? echo $baas; ?>_nupula&id=<? echo $nupula_seos["id"]; ?>&sel=1','Delete','toolbar=0,width=420,height=200,status=yes');" value="x" /></td>
   
  </tr>
  <tr>
<!--pane tähele, et siin on küsitud otse title1-te, st teiselt poolt vaadates asi ei töötaks-->
    <td class="navi"><span class="smallbody"><? echo $nupula_nimi["probleem_est"]; ?></span></td>
  </tr>
  <tr>
    <td class="navi">      
	<? if($nupula_nimi["valik1"]){ ?>
      <? echo "* ".$nupula_nimi["valik1"]." ".$nupula_nimi["vast1"]."<br>"; ?>
      <? }?>
	<? if($nupula_nimi["valik2"]){ ?>
      <? echo "* ".$nupula_nimi["valik2"]." ".$nupula_nimi["vast2"]."<br>"; ?>
      <? }?>
	<? if($nupula_nimi["valik3"]){ ?>
      <? echo "* ".$nupula_nimi["valik3"]." ".$nupula_nimi["vast3"]."<br>"; ?>
      <? }?>
	<? if($nupula_nimi["valik4"]){ ?>
      <? echo "* ".$nupula_nimi["valik4"]." ".$nupula_nimi["vast4"]."<br>"; ?>
      <? }?>
	<? if($nupula_nimi["valik5"]){ ?>
      <? echo "* ".$nupula_nimi["valik5"]." ".$nupula_nimi["vast5"]."<br>"; ?>
      <? }?>
	<? if($nupula_nimi["valik6"]){ ?>
      <? echo "* ".$nupula_nimi["valik6"]." ".$nupula_nimi["vast6"]."<br>"; ?>
      <? }?>
</td>
  </tr>
</table>	
<?

						} // end of alamgrupid 2 nupula
					
					
					
					
					
					
					}	// end of if
 			}// end of while alamgrupp 2 nimi
			
			
// SIIA TULEB MILLALGI TUNNILÕPUMATERJAL ... 


} // end of if alamgrupi 2  nimi





// Laotame lahti alamgrupi 1 eksponaadid ...
		if ($openasi_alamg){					
			$query24="SELECT oid2,id, order1, title1, sisse1, sisu1, naita_veebis1 FROM ".$baas."_exp WHERE oid1=".$agrupp["oid2"]." ORDER BY order1";
			if ($n2ita_querysid) echo $query24."query24"."<p>";
			$result24=mysql_query($query24);
			while($exponaat=mysql_fetch_array($result24))
			{
				$query25="SELECT nimi_est, id, video_url, video_url_suur, veeb_pilt_url FROM exp WHERE id=".$exponaat["oid2"];
				if ($n2ita_querysid) echo $query25."query25"."<p>";
				$result25=mysql_query($query25);
				$exponaat_nimi=mysql_fetch_array($result25);
					if ($n2ita_querysid) echo "<p><pre>cvbn";
					//echo $query35;
					if ($n2ita_querysid) var_dump($exponaat_nimi);
					if ($n2ita_querysid) echo "</pre>";
									?>
<? if ($tasemeid == 2) { ?>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td colspan="7" background="image/sinine.gif"><img src="image/valge.gif" width="80" height="1"></td>
  </tr>
  <tr> 
    <td width="10%" rowspan="3"><div align="left"><img src="image/spacer.gif" width="80
	" height="12"><span class="ekspon"><? echo $exponaat["order1"]; ?><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span></div></td>
    <td width="5%" rowspan="3"><div align="center"><span class="ekspon"><img src="image/spacer.gif" alt="ert" width="<? echo (25 - 6*strlen($exponaat["order1"])); ?>" height="9" /></span><img src="image/index_41.gif" width=19 height=19 alt="" border=0 ><span class="ekspon"><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span></div></td>
    <td class="ekspon"><a href="index.php?page=exp_disp&expid=<? echo $exponaat_nimi["id"];?>"><em><? echo $exponaat_nimi["nimi_est"]; ?></em></a><br />
      <? if($exponaat_nimi["video_url"]){ ?>
      <a class="button3" href="<? echo $exponaat_nimi["video_url"]; ?>">Video</a>
      <? }?>
      <? if($exponaat_nimi["video_url_suur"]){ ?>
      <a class="button3" href="<? echo $exponaat_nimi["video_url_suur"]; ?>">fail</a>
      <? }?>
    <span class="navi"> - <?
	   ?></span></td>
    <td width="2%" rowspan="3" class="ekspon"><div align="right">
        <input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=<? echo $baas; ?>_exp&id=<? echo $exponaat["id"]; ?>&sel=1','Delete','toolbar=0,width=920,height=800,status=yes');" >
    </div></td>
    <td width="2%" rowspan="3" class="ekspon"><input name="button" type="button" class="button2" onclick="window.open('delvalue_iid.php?domain=<? echo $baas; ?>_exp&id=<? echo $exponaat["id"]; ?>&sel=1','Delete','toolbar=0,width=420,height=200,status=yes');" value="x" /></td>
    <td width="8%" rowspan="3" align="right" class="ekspon"><? if($exponaat_nimi["veeb_pilt_url"]){?><img width="60" src="<? echo urldecode($exponaat_nimi["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"><? } else { ?><img border=1 src="image/spacer.gif" width="60" height="45"><? }?></td>
  </tr>
  <tr>
<!--pane tähele, et siin on küsitud otse title1-te, st teiselt poolt vaadates asi ei töötaks-->
    <td class="navi"><? echo "Title: "; ?><span class="menu"><? echo $exponaat["title1"]; ?></span></td>
  </tr>
  <tr>
    <td class="navi"><? echo $exponaat["sisse1"]; ?></td>
  </tr>
</table>
<? } ?> 

<?
		}	// end of if
	} // end of alamgrupid eksponaat
} // end of alamgrupi nimi

	} // ----------------- peagrupp avatud ---------		
}


// Määratlemata ...
?><a name="jarg"></a><? ?>