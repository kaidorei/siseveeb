<style type="text/css">
<!--
.style2 {color: #FF0000}
-->
</style>
<br>
<?
@$klass=$_GET["klass"];
@$open_string=$_GET["op"];
switch ($klass)
{
	case "teadus": $baas="pacs"; break;
	case "tehno": $baas="tehno"; break;
	case "kool": $baas="aine"; break;
	default:  $baas=$klass; break;
}

	@$up1=$_GET["up1"];
	@$up2=$_GET["up2"];
	
	//echo @$up1.@$up2;
	
if($up1!=NULL)
{
//	echo $up1,"   ", $up2;
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr><td colspan="2" background="image/sinine.gif"><img src="image/valge.gif" width="80" height="1"></td></tr>
	        <tr><td><img src="image/spacer.gif" width="17" height="10"></td>			
    <td width="100%" class="MENU">EKSPERIMENDID LIIGITATUNA TEEMADE J�RGI (et n&auml;ha teemadele vastavaid eksponaati vajuta ristiga ikoonile)</td></tr>
</table>
<?

$query="SELECT nimi_est,id,naita_veebis FROM ".$baas." WHERE pid=0 ORDER BY id";
//echo $query." <p>siin</p>";
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

	  	// kustutame v�i paneme selle id $open listi, v�ljundiks on $tmp mis pannakse edaspidises linkimisse
		//kui on avatud, siis paneme kinni, selleks kopeerime $open vektori va see id mis parajasti akuutne
		  $tmp=array();
		  	if($openasi){
			foreach($open as $val){
				if($val!=$line["id"]){ 
					array_push($tmp,$val); 
					}
				}
			} else {
			//kui oli suletud siis paneme id vektori l�ppu ...
			if($open[0]!=0){$tmp=$open;}
			array_push($tmp,$line["id"]);
			}
?>
    <td width="3%" >
	<a href="index.php?page=exp_tree&op=<? echo implode(",",$tmp);?>&klass=<? echo $klass;?>"><img border=0 src="image/index_<?  if($openasi){ echo "39";  } else { echo "36"; }?>.gif" width=19 height=19 alt=""></a></td>
    <td  width="91%" class="navi" nowrap><a href="index.php?page=aine_disp&pid=<? echo $line["id"]; ?>&klass=<? echo $klass;?>" class="ekraan_link">
	<? echo $line["nimi_est"]; //siin on esimene aste ?> 
	</a> - <? echo $line["naita_veebis"] ;?></td>
   <td width="6%" valign="middle"> <? //if($priv==2) {?><img  align="middle" src="image/index_36.gif"> <? //} ?></td>
  </tr>
</table>

							
<?

// Laotame lahti alamgrupi nr 1
		if ($openasi) {
				$query12="SELECT oid2, naita_veebis1 FROM ".$baas."_".$baas." WHERE oid1=".$line["id"]." ORDER BY id";
//				echo $query12;
				$result12=mysql_query($query12);
				
////////////////////////////////////////////////////////////////////////////////				
// siia kohta tuleb j�rjestamine pacs tabeli kirje jarjest j�rgi ...


//echo "<pre>";
//var_dump( $query12."1 <p>seal	</p>1");
//var_dump( mysql_fetch_array($result12));
//echo "</pre>";
				
				//Alamasja loop algab siit
				
				while($agrupp=mysql_fetch_array($result12)){ //t�htis while ts�kkel
					$openasi_alamg=0;
					if (in_array($agrupp["oid2"],$open)){
						$openasi_alamg=1;	
						}
							
						$query13="SELECT nimi_est FROM ".$baas." WHERE id=".$agrupp["oid2"];
				 		//echo $query13;//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						$result13=mysql_query($query13);

						$agrupp_nimi=mysql_fetch_array($result13);
						?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr> 
    	<td colspan="4" background="image/sinine.gif"><img src="image/valge.gif" width="55" height="1"></td>
  	</tr>
  	<tr> 
      <? // j�llegi, avame v�i sulgeme alamr�hma
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
   		<td nowrap><img src="image/spacer.gif" width="33" height="9"> <a href="index.php?page=exp_tree&op=<? echo implode(",",$tmp);?>&klass=<? echo $klass;?>"><img border=0 src="image/index_<?  if($openasi_alamg){ echo "39";  } else { echo "36"; }?>.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></a></td> <? //see tekitab pluss m�rgi v�i miinusm�rgi sinna ette koos lingiga ?>
    	<td width="100%" class="navi"><a href="index.php?page=aine_disp&pid=<? echo $agrupp["oid2"]; ?>&klass=<? echo $klass;?>"  class="ekraan_link"><? echo $agrupp_nimi["nimi_est"];  ?></a> - <? echo $agrupp["naita_veebis1"];?></td>
		<td width="13%" class=\"menu\" ><input type="button" name="suva1" class="button" value="Lisa Exp/Demo" onClick="window.open('addvalue_iid.php?domain=<? echo $baas;?>_exp&oid=<? echo $agrupp["oid2"]; ?>&sel=1','File_upload','toolbar=0,width=630,height=450,status=yes');">
  	
		<td class="menu">
</td>
  	</tr>
</table>



<?

// Laotame lahti alamgrupi nr 2
		if ($openasi_alamg){					
				$query21="SELECT oid2, naita_veebis1, id FROM ".$baas."_".$baas." WHERE oid1=".$agrupp["oid2"]." ORDER BY id";
				//echo $query21."<p>";
				$result21=mysql_query($query21);
				//Alamasja loop algab siit
				while($agrupp2=mysql_fetch_array($result21)){
					$openasi_alamg2=0;
					if (in_array($agrupp2["oid2"],$open)){
						$openasi_alamg2=1;	
						}
							
						$query22="SELECT nimi_est, naita_veebis FROM ".$baas." WHERE id=".$agrupp2["oid2"];
						//echo $query22."<p>";
						$result22=mysql_query($query22);
						$agrupp2_nimi=mysql_fetch_array($result22)
						?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr> 
    	<td colspan="4" background="image/sinine.gif"><img src="image/valge.gif" width="55" height="1"></td>
  	</tr>
  	<tr> 
      <? // j�llegi, avame v�i sulgeme alamr�hma
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
    	
    <td width="100%" class="navi"><a href="index.php?page=aine_disp&pid=<? echo $agrupp2["oid2"]; ?>&klass=<? echo $klass;?>" class="ekraan_link"><? echo $agrupp2_nimi["nimi_est"];  ?></a> - <? echo $agrupp2["naita_veebis1"];?></td>
  		<td width="13%" class=\"menu\" ><input type="button" name="suva1" class="button" value="Lisa Exp/Demo" onClick="window.open('addvalue_iid.php?domain=<? echo $baas;?>_exp&oid=<? echo $agrupp2["oid2"]; ?>&sel=1','File_upload','toolbar=0,width=630,height=450,status=yes');">
  	</tr>
</table>

<? 
// Laotame lahti alamgrupi 2 eksponaadid ...
					if ($openasi_alamg2)
					{					
						$query34="SELECT id, order1, oid2, title1, sisse1, sisu1, naita_veebis1 FROM ".$baas."_exp WHERE oid1=".$agrupp2["oid2"]." ORDER BY order1";
						//echo $query34;
						$id_prev=0;
						
						$result34=mysql_query($query34);
						if($result34 == NULL) {echo $query34;var_dump(NULL);}
						while($exp_seos=mysql_fetch_array($result34))
						{
						//echo "<pre>";
						//echo $query34;
						//var_dump($exp_seos);
						//echo "</pre>";
						//echo "<p>";
							$query35="SELECT id,nimi_est, video_url, video_url_suur, veeb_pilt_url FROM exp WHERE id=".$exp_seos["oid2"];
							//echo $query35."<p>";
							$result35=mysql_query($query35);
							$exponaat_nimi=mysql_fetch_array($result35);
							//echo "<pre>";
							//echo $query35;
							//var_dump($exponaat_nimi);
							//echo "</pre>";
							//echo "<p>";
							//
							
									?>
							
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td colspan="7" background="image/sinine.gif"><img src="image/valge.gif" width="80" height="1"></td>
  </tr>
  <tr> 
    <td width="10%" rowspan="3"><div align="left"><img src="image/spacer.gif" width="129" height="12"><span class="ekspon"><? echo $exp_seos["order1"]; ?><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span></div></td>
    <td width="5%" rowspan="3"><div align="center"><span class="ekspon"><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span><img src="image/index_41.gif" width=19 height=19 alt="" border=0 ><span class="ekspon"><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span></div></td>
    <td class="ekspon"><a href="index.php?page=exp_disp&expid=<? echo $exponaat_nimi["id"];?>"><em><? echo $exponaat_nimi["nimi_est"]; ?></em></a><br />
      <? if($exponaat_nimi["video_url"]){ ?>
      <a class="button3" href="<? echo $exponaat_nimi["video_url"]; ?>">Video</a>
      <? }?>
      <? if($exponaat_nimi["video_url_suur"]){ ?>
      <a class="button3" href="<? echo $exponaat_nimi["video_url_suur"]; ?>">fail</a>
      <? }?>
      <span class="navi"> - <? echo $exp_seos["naita_veebis1"];?></span></td>
    <td width="2%" rowspan="3" class="ekspon"><div align="right">
        <input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=<? echo $baas; ?>_exp&id=<? echo $exp_seos["id"]; ?>&sel=1','Delete','toolbar=0,width=920,height=800,status=yes');" >
    </div></td>
    <td width="2%" rowspan="3" class="ekspon"><input name="button" type="button" class="button2" onclick="window.open('delvalue_oid_exp.php?domain=<? echo $baas; ?>&oid2=<? echo $exp_seos["oid2"]; ?>&sel=1','Delete','toolbar=0,width=420,height=200,status=yes');" value="x" /></td>
    <td width="8%" rowspan="3" align="right" class="ekspon"><? if($exponaat_nimi["veeb_pilt_url"]){?><img width="60" src="<? echo urldecode($exponaat_nimi["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"><? } else { ?><img border=1 src="image/spacer.gif" width="60" height="45"><? }?></td>
  </tr>
  <tr>
<!--pane t�hele, et siin on k�situd otse title1-te, st teiselt poolt vaadates asi ei t��taks-->
    <td class="navi"><? echo "Title: "; ?><span class="menu"><? echo $exp_seos["title1"]; ?></span></td>
  </tr>
  <tr>
    <td class="navi"><? echo $exp_seos["sisse1"]; ?></td>
  </tr>
</table>	
<?

						$id_prev=$exp_seos["id"];


						} // end of alamgrupid 2 eksponaat
					}	// end of if
 			}// end of while alamgrupp 2 nimi
} // end of if alamgrupi 2  nimi





// Laotame lahti alamgrupi 1 eksponaadid ...
		if ($openasi_alamg){					
			$query24="SELECT oid2,id, order1, title1, sisse1, sisu1, naita_veebis1 FROM ".$baas."_exp WHERE oid1=".$agrupp["oid2"];
			//echo $query24."<p>";
			$result24=mysql_query($query24);
			while($exponaat=mysql_fetch_array($result24))
			{
				$query25="SELECT nimi_est, id, video_url, video_url_suur, veeb_pilt_url FROM exp WHERE id=".$exponaat["oid2"];
				//echo $query25."<p>";
				$result25=mysql_query($query25);
				$exponaat_nimi=mysql_fetch_array($result25)
									?>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td colspan="7" background="image/sinine.gif"><img src="image/valge.gif" width="80" height="1"></td>
  </tr>
  <tr> 
    <td width="10%" rowspan="3"><div align="left"><img src="image/spacer.gif" width="80
	" height="12"><span class="ekspon"><? echo $exponaat["order1"]; ?><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span></div></td>
    <td width="5%" rowspan="3"><div align="center"><span class="ekspon"><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span><img src="image/index_41.gif" width=19 height=19 alt="" border=0 ><span class="ekspon"><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span></div></td>
    <td class="ekspon"><a href="index.php?page=exp_disp&expid=<? echo $exponaat_nimi["id"];?>"><em><? echo $exponaat_nimi["nimi_est"]; ?></em></a><br />
      <? if($exponaat_nimi["video_url"]){ ?>
      <a class="button3" href="<? echo $exponaat_nimi["video_url"]; ?>">Video</a>
      <? }?>
      <? if($exponaat_nimi["video_url_suur"]){ ?>
      <a class="button3" href="<? echo $exponaat_nimi["video_url_suur"]; ?>">fail</a>
      <? }?>
      <span class="navi"> - <? echo $exponaat["naita_veebis1"];?></span></td>
    <td width="2%" rowspan="3" class="ekspon"><div align="right">
        <input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=<? echo $baas; ?>_exp&id=<? echo $exponaat_nimi["id"]; ?>&sel=1','Delete','toolbar=0,width=920,height=800,status=yes');" >
    </div></td>
    <td width="2%" rowspan="3" class="ekspon"><input name="button" type="button" class="button2" onclick="window.open('delvalue_oid_exp.php?domain=<? echo $baas; ?>&oid2=<? echo $exponaat["oid2"]; ?>&sel=1','Delete','toolbar=0,width=420,height=200,status=yes');" value="x" /></td>
    <td width="8%" rowspan="3" align="right" class="ekspon"><? if($exponaat_nimi["veeb_pilt_url"]){?><img width="60" src="<? echo urldecode($exponaat_nimi["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"><? } else { ?><img border=1 src="image/spacer.gif" width="60" height="45"><? }?></td>
  </tr>
  <tr>
<!--pane t�hele, et siin on k�situd otse title1-te, st teiselt poolt vaadates asi ei t��taks-->
    <td class="navi"><? echo "Title: "; ?><span class="menu"><? echo $exponaat["title1"]; ?></span></td>
  </tr>
  <tr>
    <td class="navi"><? echo $exponaat["sisse1"]; ?></td>
  </tr>
</table>
<?
		}	// end of if
	} // end of alamgrupid eksponaat
} // end of alamgrupi nimi

	} // ----------------- peagrupp avatud ---------		
}


// M��ratlemata ...
?><a name="jarg"></a><? ?>