<br>
<?
$klass=$_GET["klass"];
switch ($klass)
{
case "teadus": $baas="pacs"; break;
case "tehno": $baas="tehno"; break;
case "kool": $baas="aine"; break;
}

?><table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr background="image/sinine.gif"> 
				<td colspan="2" background="image/sinine.gif"><img src="image/valge.gif" width="80" height="1"></td>
			</tr>
	        <tr> 
 				<td><img src="image/spacer.gif" width="17" height="10"></td>
				
    <td width="100%" class="MENU">EKSPONAADID JA DEMOD LIIGITATUNA TEEMADE JÄRGI 
      (et n&auml;ha teemadele vastavaid eksponaate vajuta ristiga ikoonile) </td>
        	</tr>
</table>
<?

$query="SELECT nimi_est,id FROM ".$baas." WHERE pid=0 ORDER BY id";
//echo $query;
$result=mysql_query($query);
while($line=mysql_fetch_array($result))
{
		$open=explode(',',$_GET["op"]);	
		$openasi=0;
		if (in_array($line["id"],$open))
			{
				$openasi=1;	
			}
?>
 

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
    <td colspan="7" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
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
    <td width="3%" > <a href="index.php?page=exp_tree&op=<? echo implode(",",$tmp);?>&klass=<? echo $klass;?>"><img border=0 src="image/index_<?  if($openasi){ echo "39";  } else { echo "36"; }?>.gif" width=19 height=19 alt=""></a></td>
    <td  width="91%" class="menu" nowrap><a href="index.php?page=<? echo $baas;?>_disp&pid=<? echo $line["id"]; ?>" class="ekraan_link"><? echo $line["nimi_est"]; ?></a></td>
   <td width="6%" valign="middle"> <? //if($priv>=2) {?><img  align="middle" src="image/index_36.gif"> <? //} ?></td>
  </tr>
</table>

							
<?

// Laotame lahti alamgrupi nr 1
		if ($openasi) {
				$query12="SELECT oid2 FROM ".$baas."_".$baas." WHERE oid1=".$line["id"]." ORDER BY id";
//				echo $query12;
				$result12=mysql_query($query12);
				
////////////////////////////////////////////////////////////////////////////////				
// siia kohta tuleb järjestamine pacs tabeli kirje jarjest järgi ...


				
				//Alamasja loop algab siit
				while($agrupp=mysql_fetch_array($result12)){
					$openasi_alamg=0;
					if (in_array($agrupp["oid2"],$open)){
						$openasi_alamg=1;	
						}
							
						$query13="SELECT nimi_est FROM ".$baas." WHERE id=".$agrupp["oid2"];
// 						echo $query13;
						$result13=mysql_query($query13);
						$agrupp_nimi=mysql_fetch_array($result13)
						?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
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
   		<td nowrap><img src="image/spacer.gif" width="33" height="9"> <a href="index.php?page=exp_tree&op=<? echo implode(",",$tmp);?>&klass=<? echo $klass;?>"><img border=0 src="image/index_<?  if($openasi_alamg){ echo "39";  } else { echo "36"; }?>.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></a></td>
    	<td width="100%" class="menu"><a href="index.php?page=<? echo $baas;?>_disp&pid=<? echo $agrupp["oid2"]; ?>"  class="ekraan_link"><? echo $agrupp_nimi["nimi_est"];  ?></a></td>
		<td class="menu"><input type="button" name="suva1" class="button" value="Lisa Exp/Demo" onClick="window.open('addvalue_iid.php?domain=<? echo $baas;?>_exp&oid=<? echo $agrupp["oid2"]; ?>&sel=1','File_upload','toolbar=0,width=500,height=150,status=yes');">
</td>
  	</tr>
</table>



<?

// Laotame lahti alamgrupi nr 2
		if ($openasi_alamg){					
				$query21="SELECT oid2 FROM ".$baas."_".$baas." WHERE oid1=".$agrupp["oid2"]." ORDER BY id";
				$result21=mysql_query($query21);
				//Alamasja loop algab siit
				while($agrupp2=mysql_fetch_array($result21)){
					$openasi_alamg2=0;
					if (in_array($agrupp2["oid2"],$open)){
						$openasi_alamg2=1;	
						}
							
						$query22="SELECT nimi_est FROM ".$baas." WHERE id=".$agrupp2["oid2"];
						$result22=mysql_query($query22);
						$agrupp2_nimi=mysql_fetch_array($result22)
						?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
    	<td colspan="4" background="image/sinine.gif"><img src="image/valge.gif" width="55" height="1"></td>
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
    	
    <td width="100%" class="menu"><a href="index.php?page=<? echo $baas;?>_disp&pid=<? echo $agrupp2["oid2"]; ?>" class="ekraan_link"><? echo $agrupp2_nimi["nimi_est"];  ?></a></td>
  		<td width="13%" class=\"menu\" ><input type="button" name="suva1" class="button" value="Lisa Exp/Demo" onClick="window.open('addvalue_iid.php?domain=<? echo $baas;?>_exp&oid=<? echo $agrupp2["oid2"]; ?>&sel=1','File_upload','toolbar=0,width=500,height=150,status=yes');">
  	</tr>
</table>

<? 
// Laotame lahti alamgrupi 2 eksponaadid ...
					if ($openasi_alamg2)
					{					
						$query34="SELECT oid2 FROM ".$baas."_exp WHERE oid1=".$agrupp2["oid2"];
						$result34=mysql_query($query34);
						while($exponaat=mysql_fetch_array($result34))
						{
							$query35="SELECT nimi_est, id FROM exp WHERE id=".$exponaat["oid2"];
							$result35=mysql_query($query35);
							$exponaat_nimi=mysql_fetch_array($result35)
									?>
							
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
    <td colspan="3" background="image/sinine.gif"><img src="image/valge.gif" width="80" height="1"></td>
  </tr>
  <tr> 
    <td width="14%"><img src="image/spacer.gif" width="121" height="10"><a href="index.php?page=exp_disp&expid=<? echo $exponaat_nimi["id"];?>"><img src="image/index_41.gif" width=19 height=19 alt="" border=0 ><img border=0 src="image/spacer.gif" width="10" height="10"></a></td>
    <td width="76%" class="ekspon"><a href=\"index.php?page=exp_disp&expid=<? echo $exponaat_nimi["id"];?>"><em><? echo $exponaat_nimi["nimi_est"]; ?></em></a></td>
    <td width="10%" class="ekspon"><div align="right">
        <input type="button" class="button2" value="x" onClick="window.open('delvalue_iid.php?domain=<? echo $domain; ?>&oid2=<? echo $tulem["oid2"]; ?>&id=<? echo $tulem["id"]; ?>','Delete','toolbar=0,width=420,height=200,status=yes');" >
      </div></td>
  </tr>
</table>	
<?
						} // end of alamgrupid 2 eksponaat
					}	// end of if
 			}// end of while alamgrupp 2 nimi
} // end of if alamgrupi 2  nimi





// Laotame lahti alamgrupi 1 eksponaadid ...
		if ($openasi_alamg){					
			$query24="SELECT oid2 FROM ".$baas."_exp WHERE oid1=".$agrupp["oid2"];
			$result24=mysql_query($query24);
			while($exponaat=mysql_fetch_array($result24))
			{
				$query25="SELECT nimi_est, id FROM exp WHERE id=".$exponaat["oid2"];
				$result25=mysql_query($query25);
				$exponaat_nimi=mysql_fetch_array($result25)
									?>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr background="image/sinine.gif"> 
				<td colspan="2" background="image/sinine.gif"><img src="image/valge.gif" width="80" height="1"></td>
			</tr>
	        <tr> 
          		<td><img src="image/spacer.gif" width="80" height="10"><a href="index.php?page=exp_disp&expid=<? echo $exponaat_nimi["id"];?>"><img src="image/index_41.gif" width=19 height=19 alt="" border=0 ><img border=0 src="image/spacer.gif" width="10" height="10"></a></td>
          		<td width="100%" class="ekspon"><a href=\"index.php?page=exp_disp&expid=<? echo $exponaat_nimi["id"];?>"><? echo $exponaat_nimi["nimi_est"]; ?></a></td>
        	</tr>
      	</table>
<?
		}	// end of if
	} // end of alamgrupid eksponaat
} // end of alamgrupi nimi

	} // ----------------- peagrupp avatud ---------		
}


// Määratlemata ...
?> 
<? ?>