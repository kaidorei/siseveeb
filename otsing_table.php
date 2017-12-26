<link href="scat.css" rel="stylesheet" type="text/css" />
<p><span class="pealkiri">Otsingu tulemused:</span><br />
  <? 
  
 // otsing stringi jarele ...
	$search_str=$_POST["search_str"];
 
  
  if($_POST["exp"]) {?>
<table width="100%" border="0">
  <tr>
    <td width="10%" bgcolor="#CCCCCC"><span class="menu">EKSPERIMENDID:</span></td>
    <td width="90%" bgcolor="#CCCCCC"><input class="button" type="button" name="Submit3" value="Lisa" onclick="document.location.href='index.php?page=<? echo "exp_disp&action=new"; ?>&aasta=<? echo $aastakene;?>'" /></td>
  </tr>
</table>
<?
// kui on tehtud valik staatuse j'rgi .. 
$query="SELECT nimi_est,video_player,nimi_eng,id,staatus_id,lupdate,veeb_pilt_url,veeb_pilt_url_s, naita_veebis, in_buss FROM exp WHERE nimi_est LIKE '%".$search_str."%' ORDER BY nimi_est";

//	echo $query;
	$result=mysql_query($query);
	include("globals.php");

	$id_prev=0;
	$counter = 1;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td width="2%" align="center">&nbsp;</td>
    <td width="2%" align="center" class="navi"></td>
    <td width="1%" align="center" class="navi">l</td>
    <td width="2%" align="center" class="navi">w</td>
    <td width="3%" align="center" class="navi">v</td>
    <td width="2%" align="center" class="navi"> <img src="image/spacer.gif" width="10" height="5"></td>
    <td width="74%" align="center" nowrap class="menu">Nimi</td>
    <td width="3%" align="center" nowrap class="menu">Buss?</td>
    <?	$expid = $line["id"];
if($veeb == "tee" && $exp == $expid)
	{}
?>
    <td width="3%" align="center" class="menu"  >Pilt</td>
    <td width="2%" align="center" valign="middle"></td>
    <td width="6%" align="center" nowrap class="smallbody"></td>
  </tr><?

	while($line=mysql_fetch_array($result))
	{
			// loeme kokku vastava id/ga vestluste kirjed exp_vestlus andmebaasis ...
					$query="SELECT COUNT( * ) FROM exparendus WHERE oid=".$line["id"]." ";
					$result1=mysql_query($query);
					$count=mysql_fetch_array($result1);
			//		echo $count[0];
					?>
			
  <tr> 
    <td colspan="11" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
    <td width="2%"><img border=0 src="image/index_41.gif" width=19 height=19 alt="">    </td>
    <td class="navi" width="2%"><? echo $counter?>.</td>
    <td width="1%" class="navi"><img src="image/spacer.gif" width="10" height="5"><?  // kontrollime, milliste kategooriate hulgas on selle asja kohta seosed juba loodud ...
//teadus:
				$query62="SELECT oid1 FROM pacs_exp WHERE oid2=".$line["id"];
				$result62=mysql_query($query62);
				if(mysql_fetch_array($result62))
				{
					echo "f";
				}
//tehnoloogia:
				$query63="SELECT oid1 FROM tehno_exp WHERE oid2=".$line["id"];
				$result63=mysql_query($query63);
				if(mysql_fetch_array($result63))
				{
					echo "t";
				}
//kool:
				$query64="SELECT oid1 FROM aine_exp WHERE oid2=".$line["id"];
				$result64=mysql_query($query64);
				if(mysql_fetch_array($result64))
				{
					echo "k";
				}
    ?></td>
    <td width="2%" class="navi"> 
 <?
 echo $line["veeb_ok"]; 
 ?>    </td>
    <td width="3%" class="navi"><img src="image/spacer.gif" width="10" height="5"><? echo $line["video_player"]; ?><img src="image/spacer.gif" width="10" height="5"></td>
    <td width="2%" class="navi"> <img src="image/spacer.gif" width="10" height="5"></td>
    <td width="74%" nowrap class="menu"><a href="index.php?page=exp_disp&expid=<? echo $line["id"]; ?>" target="_blank"><? echo $line["nimi_est"];?> 
      (<? echo $line["nimi_eng"];?>)</a></td>
    <td width="3%" nowrap class="menu"><? if($line["in_buss"]){?><img src="image/buss.jpg" width="30" height="28"><? }?></td>
    <?	$expid = $line["id"];
?>
    <td width="3%"  ><? if($line["veeb_pilt_url"]) {?><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" width="40" /><? } else { ?><img src="../images/spacer.gif"  width="40"/><? }?></td>
    <td width="2%" valign="middle"> 
      <? if($priv>=2) {?>
      <a href="index.php?page=<? echo $dom."_table"; ?>&sel=<? echo $sel; ?>&veeb=tee&exp=<? echo $expid; ?>"><img src="image/index_39.gif" border="0"  align="middle"></a> 
      <? } ?>    </td>
    <td width="6%" nowrap class="smallbody"> 
      <? if($priv>=2) {?>
      <div align="right"><a href="index.php?page=exp_table&action=del&expid=<? echo $line["id"]; ?>">kustuta</a> 
        <?		
	$id_prev = $line["id"];
		 } ?>
      </div></td>
  </tr>
<?
$counter++;
}	// ------------- peagrupi exponaat -----------
?>
</table>
<?
 } ?>
<? if($_POST["kool"]) {?>
<table width="100%" border="0">
  <tr>
    <td width="10%" bgcolor="#CCCCCC"><span class="menu">KOOLID:</span></td>
    <td width="90%" bgcolor="#CCCCCC"><input class="button" type="button" name="Submit3" value="Lisa" onclick="document.location.href='index.php?page=<? echo "kool_disp&action=new"; ?>&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>'" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr> 
    <td colspan="2" class="menu">staatus</td>
    <td width="39%" nowrap class="menu"><a href="index.php?page=kool_table&ord=nimi&sel=<? echo $sel?>">nimi</a></td>
    <td width="8%" nowrap class="menu">e-mail</td>
    <td width="7%" nowrap class="menu">www</td>
    <td nowrap class="menu"><a href="index.php?page=kool_table&ord=maakond&sel=<? echo $sel?>">maakond</a></td>
    <td nowrap class="menu"><a href="index.php?page=kool_table&ord=date&sel=<? echo $sel?>">esmareg.</a></td>
    <td class="menu" valign="middle">      </td>
    <td nowrap class="smallbody">&nbsp;<? if($priv>=2) {?>
      <a href="kool_table_mass.php">kiri</a> 
      <? } ?></td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="10" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <?
	$queryk="SELECT * FROM kool WHERE nimi LIKE '%".$search_str."%' ORDER BY nimi";
//	echo $queryk;
	$resultk=mysql_query($queryk);
//WHILE ALGAB--------------------------------------------------------------------------------------------------------------------------
	while($line=mysql_fetch_array($resultk)){
			// kui on tehtud valik staatuse järele ...
			$state = 0;
			//... siis uurime, kas kool on olnud juba kusagil reisil asjaline ...
				$query1="SELECT id,oid1 FROM reis_kool WHERE oid2=".$line["id"];
//					echo $query1;
				$result1=mysql_query($query1);
				$line1=mysql_fetch_array($result1);		
				
				if($line1==NULL)
				{
					$state=1;
					$aastalopp="0000-00-00"	;		 
			//	  $kaimata++;
			// 	 echo $kaimata;
				} // end of 
				else
				{
			// kui ei ole olnud asjaline, siis kontrollime, kas mõni kirjasolevatest reisidest on tulemas või on kõik juba läbi ja tehtud ...
				$result1=mysql_query($query1);
				while($line1=mysql_fetch_array($result1)){
 					$query2="SELECT nadal_nmbr, lopp, hooaeg_nmbr FROM reis WHERE id=".$line1["oid1"];
					$result2=mysql_query($query2);
					$line2=mysql_fetch_array($result2);
			
					// märgime eritähisega koolid, kellega on juba läbirääkimistesse asutud, ehk siis need koolid, mis on kirjas kusagil reisil, mille
					// toimumisaeg on kusagil tulevikus ... teeme seda nädala ja hooaja numbri kaudu, muidu tekib segadus märkimata algusajaga reisidega.		
					switch ($line2['hooaeg_nmbr'])
					{
						case "1": $pa=27; $yea=2004; $pl=2; $yel=2005; $hooaeg=1; $nihe=14; break;
						case "2": $pa=26; $yea=2005; $pl=1; $yel=2006; $hooaeg=2; $nihe=0; break;
						case "3": $pa=25; $yea=2006; $pl=31; $yel=2007; $hooaeg=3; $nihe=0; break;
						case "4": $pa=31; $yea=2007; $pl=6; $yel=2008; $hooaeg=4; $nihe=0; break;
					}
						$aastaalgus  = date("Y-m-d", mktime (0,0,0,12  ,$pa+($line2["nadal_nmbr"]+1)*7,$yea));
									
						if($aastaalgus  < date("Y-m-d"))
						{ 
						 $state=3;
//						 echo date("Y-m-d")," < ", $line2["lopp"];
						}else{ 
						 $state=2; 
//						 echo date("Y-m-d")," > ", $aastalopp;
						} 
					} // end of while
						
				} // end of else
 ?>
  <tr> 
    <td align="center" valign="middle" class="menu" width="5%"> 
      <? //echo "sel=   ", $sel;

	switch ($state)
	{
	case 1: 
// ajutine: kõik endise süsteemi käimata koolid saavad füüsikaetendusekutse märgi külge ...

	
/*	$query2222="UPDATE kool SET kutse_fyysika=1 WHERE id=".$line["id"]." AND on_globe=0";
	echo $query2222;
	$result2222=mysql_query($query2222);
*///	mysql_fetch_array($result2222)
	?>
      <img border=0 alt="reg" src="image/motik_rikkis.gif" width=23 height=15 > 
      <? break;
	case 2: ?>
      <img border=0 alt="Rikkis" src="image/motik_toos.gif" width=19 height=19 > 
      <? break;
	case 3: ?>
<!--      <img border=0 alt="Rikkis" src="image/motik_utiliseer.gif" width=15 height=15 > 
-->      <? break;
	case 4: ?>
<!--      <img border=0 alt="Rikkis" src="image/motik_utiliseer.gif" width=15 height=15 > 
-->      <? break;
	case 5: ?>
G<? break;
//	default: echo "ok   "; break;
	}
					

	?>    </td>
    <td align="center" valign="middle" class="menu_punane" width="5%"><img src="image/spacer.gif" width="1" height="15" />&nbsp;
    <? 
	if($line["tyyp"]==0) {echo "*";}
//	if($line["on_globe"]==1) {echo "G";}
	if($line["kutse_1"]==1) {echo "f";} 
	if($line["kutse_2"]==1) {echo "k";}
	if($line["kutse_5"]==1) {echo "m";}
	if($line["kutse_3"]==1) {echo "v";}
	if($line["kutse_4"]==1) {echo "r";}
	if($line["kutse_6"]==1) {echo "p";}?></td>
    <td nowrap class="menu"><a href="index.php?page=kool_disp&fid=<? echo $line["id"]; ?>"><? echo $line["nimi"]; if($line["on_globe"]==1) {echo "(G)";}
?></a></td>
    <td nowrap class="menu"><? echo $line["email1"];
?></td>
    <td nowrap class="menu"><a href="<? echo $line["veeb"]; ?>" target="_blank">www</a></td>
    <td  width="17%" class="menu" nowrap> 
      <?
	$query3="SELECT nimi FROM maakonnad WHERE id=".$line["maakond"];
	$result3=mysql_query($query3);
	$m=mysql_fetch_array($result3);
	
	echo $m["nimi"]; ?>    </td>
    <td  width="11%" class="menu" nowrap><? echo $line["date"]; ?></td>
    <td width="3%" valign="middle"  class="smallbody"> 
      <? if($priv>=2) {?>
      <a class="menu_punane" href="index.php?page=kool_table&action=del&fid=<? echo $line["id"]; ?>">x</a> 
      <? } ?></td>
    <td width="5%" align="right" nowrap class="smallbody"> 
      <?  if($line["PK"]>1000)
	  {
	  ?>
      <img  align="middle" src="image/index_39.gif"> 
      <? } ?>    </td>
  </tr>
  <?
	}
}
?>
</table>
<?  ?>
<? if($_POST["isik"]) {
$query="SELECT * FROM isik WHERE eesnimi LIKE '%".$search_str."%' or perenimi LIKE '%".$search_str."%' ORDER BY eesnimi ";
$result=mysql_query($query);
//echo $query;


?>
<table width="100%" border="0">
  <tr>
    <td width="10%" bgcolor="#CCCCCC"><span class="menu">ISIK:</span></td>
    <td width="90%" bgcolor="#CCCCCC"><input class="button" type="button" name="Submit3" value="Lisa" onclick="document.location.href='index.php?page=<? echo "isik_disp&action=new"; ?>&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>'" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">		<?
		

		while($line=mysql_fetch_array($result)){
			?>
	        <tr background="image/sinine.gif"> 
          	<td colspan="7" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td width="5%"><img src="image/spacer.gif" width="30" height="10"><?php if ($line["on_reisijuht"]) {?><img src="image/biggrin.gif" border="0" alt="reisijuht" width="15" height="15" /><? 
}else{?><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><? }?><img border=0 src="image/spacer.gif" width="10" height="10"></td>
	       <td  width="30%" class="menu" nowrap><a href="index.php?page=isik_disp&iid=<? echo $line["id"]; ?>&pw=<? echo $pw;?>&liik=<? echo $liik;?>"><? echo $line["eesnimi"]." ".$line["perenimi"]; ?></a></td>
           <td  width="30%" class="menu" nowrap><a href="mailto:<? echo $line["email1"]; ?>"><? echo $line["email1"]; ?></a></td>
           <td  width="11%" class="menu" nowrap> <? if($line["b_kat"]){?>B-kat<? }?> </td>
           <td  width="12%" class="menu" nowrap><a href="skype:<? echo $line["skype"]; ?>?chat"><?php if ($line["skype"]) {?><img src='http://mystatus.skype.com/mediumicon/<? echo $line["skype"]; ?>' style="border: none;" alt="Proovi helistada!" /></a><?php }?>
<!--see va pildi küsimine Skype'ist annab exploreris ühe tulemuse, Mozillas teise, õige  ...--></td>
           <td width="5%" valign="middle"> <img width="50" border="0" src="<? echo urldecode($line["veeb_pilt_url"]); ?>" alt="x" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC">    </td>
		   <td width="7%" nowrap class="smallbody"><? if($priv>=2) {?><a href="index.php?page=isik_table&action=del&iid=<? echo $line["id"]; ?>&liik=<? echo $liik; ?>">kustuta</a><? } ?></td>
	       </tr>
	<?
	}	// ------------- peagrupi exponaat -----------
?>
</table><? } ?>
<? if($_POST["vahendid"]) {

$query="SELECT * FROM vahendid WHERE nimi_est LIKE '%".$search_str."%' ORDER BY nimi_est";
//echo $query;
$result=mysql_query($query);

?>
<table width="100%" border="0">
  <tr>
    <td width="10%" bgcolor="#CCCCCC"><span class="menu">EKSPERIMENDIVAHENDID:</span></td>
    <td width="90%" bgcolor="#CCCCCC"><input class="button" type="button" name="Submit3" value="Lisa" onclick="document.location.href='index.php?page=<? echo "vahendid_disp&action=new"; ?>&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>'" /></td>
  </tr>
</table>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
    	<td width="5%" colspan="2"><img src="image/spacer.gif" width="30" height="10"></td>

        <td width="33">  </td>  <td align="center" valign="middle" class="menu" width="3%"> 
     </td>
<td width="0%"></td>
        <td  width="74%" class="menu" nowrap><a href="index.php?page=vahendid_table&ord=nimi_est&sel=<? echo $sel?>">Nimi</a></td>

		<td  width="6%" nowrap class="menu style1"><a href="index.php?page=vahendid_table&ord=kood&sel=<? echo $sel?>">Kood</a></td>
		<td width="5%" valign="middle"></td>

    	<td width="7%" nowrap class="smallbody"></td>
        </tr>
<?	while($line=mysql_fetch_array($result)){ ?>
        <tr background="image/sinine.gif"> 
          <td colspan="9" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
    	<td width="2%"><img src="image/spacer.gif" width="30" height="10"><?php if ($line["on_tooriist"]!=1) {?><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"><?php }else{  ?><img src="image/tools.jpg" alt="tööriist" /><?php }?></td>

        <td width="3%" bordercolor="1"><?php if ($line["netipood_url"]!="ise") {?><img border=0 src="image/spacer.gif" width="10" height="10"><?php }else{  ?><img src="image/copyright_symbol_v.jpg" alt="tööriist" width="20" height="20" /><?php }?></td>
        <td width="33">    <td align="center" valign="middle" class="menu" width="3%"> 
      <? 
	switch ($line["staatus_id"])
	{
	case 1: ?>
<img src="image/spacer.gif" width="23" height="10">      <? break;
	case 2: ?>
<img border=0 alt="Osta, on müügis" src="image/motik_osta.gif" width=33 height=15 >      <? break;
	case 3: ?>
      <img border=0 alt="reg" src="image/motik_rikkis.gif" width=23 height=15 ><? break;
	}
	?>
    </td>
<td width="0%"></td>
        <td  width="74%" class="menu" nowrap><a href="index.php?page=vahendid_disp&vid=<? echo $line["id"]; ?>"><? echo $line["nimi_est"]; ?></a></td>

		<td  width="6%" nowrap class="menu style1"><? echo $line["kood"]; ?></td>
		<td width="5%" valign="middle"><? if($line["veeb_pilt_url"]) {?><a href=<? echo urldecode($line["veeb_pilt_url_s"]); ?> target=_blank><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" width="80" border="0" /></a><? } else { ?><img src="../images/spacer.gif"  width="40"/><? }?></td>

    	<td width="7%" nowrap class="smallbody"><? if($priv>=2) {?><a href="index.php?page=vahendid_table&action=del&ord=<? echo $ord; ?>&vid=<? echo $line["id"]; ?>">kustuta</a><? } ?></td>
        </tr>
<?
}
?>      </table> <? } ?>
<? if($_POST["firma"]) {?><table width="100%" border="0">
  <tr>
    <td width="10%" bgcolor="#CCCCCC"><span class="menu">FIRMAD:</span></td>
    <td width="90%" bgcolor="#CCCCCC"><input class="button" type="button" name="Submit3" value="Lisa" onclick="document.location.href='index.php?page=<? echo "firma_disp&action=new"; ?>&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>'" /></td>
  </tr>
</table>
<? } ?>
<? if($_POST["reis"]) {?><table width="100%" border="0">
  <tr>
    <td width="10%" bgcolor="#CCCCCC"><span class="menu">REISID:</span></td>
    <td width="90%" bgcolor="#CCCCCC"><input class="button" type="button" name="Submit3" value="Lisa" onclick="document.location.href='index.php?page=<? echo "reis_disp&action=new"; ?>&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>'" /></td>
  </tr>
</table>
<? } ?>
<? if($_POST["uudis"]) {?><table width="100%" border="0">
  <tr>
    <td width="10%" bgcolor="#CCCCCC"><span class="menu">UUDISED:</span></td>
    <td width="90%" bgcolor="#CCCCCC"><input class="button" type="button" name="Submit3" value="Lisa" onclick="document.location.href='index.php?page=<? echo "uudis_disp&action=new"; ?>&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>'" /></td>
  </tr>
</table>
<? } ?>
<? if($_POST["nupula"]) {
	
$query="SELECT * FROM nupula WHERE nimi_est LIKE '%".$search_str."%' OR probleem_est LIKE '%".$search_str."%' ORDER BY nimi_est";
//echo $query;
$result=mysql_query($query);
	
	
	
	?><table width="100%" border="0">
  <tr>
    <td width="10%" bgcolor="#CCCCCC"><span class="menu">NUPULA:</span></td>
    <td colspan="3" bgcolor="#CCCCCC"><input class="button" type="button" name="Submit3" value="Lisa" onclick="document.location.href='index.php?page=<? echo "nupula_disp&action=new"; ?>&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>'" /></td>
  </tr>
  
  <?
		while($line=mysql_fetch_array($result)){
			?>
	        <tr> 
          	<td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td width="10%" valign="top"><a class="options" href="index.php?page=nupula_disp&nid=<? echo $line["id"]; ?>" ><? echo $line["id"];?></a></td>
	       <td  width="64%" valign="top" class="options"><? echo $line["probleem_est"];?></td>
	       <td width="11%" valign="top"><? if($line["naita_veebis"]==1) {?><img src="image/motik_exp.gif" alt="tanane" /> <? } else {?><img  align="middle" src="image/index_39.gif"><? } ?></td>
		   <td width="15%" valign="top" nowrap class="smallbody"><? if($priv>=2) {?><a href="index.php?page=nupula_table&action=del&nid=<? echo $line["id"]; ?>">kustuta</a><? } ?>		     </td>
	       </tr>
	<?
	
	
	}	
 
  
?></table>
<? } ?>
<? if($_POST["krono"]) {?><table width="100%" border="0">
  <tr>
    <td width="10%" bgcolor="#CCCCCC"><span class="menu">KRONOLOOGIA:</span></td>
    <td width="90%" bgcolor="#CCCCCC"><input class="button" type="button" name="Submit3" value="Lisa" onclick="document.location.href='index.php?page=<? echo "krono_disp&action=new"; ?>&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>'" /></td>
  </tr>
</table>
<? } ?>
<? if($_POST["pacs"]) {?><table width="100%" border="0">
  <tr>
    <td width="17%" bgcolor="#CCCCCC"><span class="menu">UURITAVAD TEADUSTEEMAD:</span></td>
    <td width="83%" bgcolor="#CCCCCC"><input class="button" type="button" name="Submit3" value="Lisa" onclick="document.location.href='index.php?page=<? echo "pacs_disp&action=new"; ?>&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>'" /></td>
  </tr>
</table>
<? } ?>
<? if($_POST["tehno"]) {?><table width="100%" border="0">
  <tr>
    <td width="10%" bgcolor="#CCCCCC"><span class="menu">TEHNOLOOGIAD:</span></td>
    <td width="90%" bgcolor="#CCCCCC"><input class="button" type="button" name="Submit3" value="Lisa" onclick="document.location.href='index.php?page=<? echo "tehno_disp&action=new"; ?>&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>'" /></td>
  </tr>
</table>
<? } ?>
<? if($_POST["aine"]) {?><table width="100%" border="0">
  <tr>
    <td width="10%" bgcolor="#CCCCCC"><span class="menu">AINEPUU:</span></td>
    <td width="90%" bgcolor="#CCCCCC"><input class="button" type="button" name="Submit3" value="Lisa" onclick="document.location.href='index.php?page=<? echo "aine_disp&action=new"; ?>&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>'" /></td>
  </tr>
</table>
<? } ?>
