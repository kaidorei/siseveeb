<link href="scat.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<br>
<?	$action=$_GET["action"];
	$sel=$_GET["sel"];
	$ord=$_GET["ord"];
	$etendus_id=$_GET["etendus_id"];
	if($ord==NULL) $ord="maakond";
	if($action=="del"){
		$expid=$_GET["fid"];
		$tables=array('kool_lingid','kool_isikud');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$fid;
			$r=mysql_query($q);
			}
			$q="DELETE FROM kool WHERE id=".$fid;
			$r=mysql_query($q);
	}
//***protseduur Regio tabeli ja localhosti tabeli andmevahetuseks************************************************
/*	$query_asi="SELECT * FROM yldkoolid ORDER BY nimi";
	$result_asi=mysql_query($query_asi);
	while($line_asi=mysql_fetch_array($result_asi))
	{
		$query_asi1="SELECT nimi FROM kool WHERE nimi LIKE '%".$line_asi["nimi"]."%'";
//	echo $query_asi1;
		$result_asi1=mysql_query($query_asi1);
		$line_asi1=mysql_fetch_array($result_asi1); 
		if($line_asi1["nimi"])
		{
//		$query="UPDATE kool SET PK='".$line_asi1["PK"]."', LK='".$line_asi1["LK"]."', kooli_tyyp='".$line_asi1["kooli_tyyp"]."' WHERE nimi='".$line_asi1["nimi"]."'";
		}
		else
		{
			$pos2 = stripos($line_asi["nimi"], "Lasteaed");
			$pos1 = stripos($line_asi["nimi"], "Algkool");
			
			if ($pos2 === false&&$pos1 === false) 
			
			{
//			echo $line_asi["nimi"];
//		$query_new="INSERT INTO kool (nimi, PK, LK) VALUES ('".$line_asi["nimi"]."', '".$line_asi["PK"]."', '".$line_asi["LK"]."')";
//		echo $query_new;
//		$tmp=mysql_query($query_new);
			}


		
		}
//		$result=mysql_query($query);

		//	echo $query;
	}
*/
//********************************************************************************************	
// kui ei ole tehtud valikut staatuse  järgi .. 
	if($sel==NULL) $sel=0;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr> 
    <td class="menu">&nbsp;</td>
    <td width="36%" nowrap class="menu"><a href="index.php?page=kool_table&ord=nimi&sel=<? echo $sel?>">nimi</a></td>
    <td width="36%" nowrap class="menu">Tugiisik</td>
    <td width="5%" nowrap class="menu" align="center">e-mail</td>
    <td width="4%" nowrap class="menu" align="center">kooli <br />
    e-mail </td>
    <td width="5%" nowrap class="menu">&nbsp;</td>
    <td class="menu" valign="middle"><a href="index.php?page=kool_table&ord=maakond&sel=<? echo $sel?>">maakond</a> </td>
    <td nowrap class="smallbody">&nbsp;</td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="9" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <?
  	if($sel==5) { $globe=" AND on_globe = 1";} else {$globe="";}
	

	$query="SELECT * FROM kool WHERE nimi LIKE '%".$_POST["search_str"]."%'".$str1."".$globe."".$str_kutse." AND on_tugikool=1 ORDER BY ".$ord;
//	echo $query;
	$result=mysql_query($query);
//WHILE ALGAB--------------------------------------------------------------------------------------------------------------------------
	$count = 1;
	while($line=mysql_fetch_array($result)){
	
		
			
			
			
			
			
			
	
			// kui on tehtud valik staatuse järele ...
			$state = 0;
			//... siis uurime, kas kool on olnud juba kusagil reisil asjaline ...
				$query1="SELECT id,oid1 FROM reis_kool WHERE oid2=".$line["id"];
				//	echo $query1;
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
// Kui meid on teist korda külla kutsutud
if($sel==5&&$line["on_globe"]==1) {$state=5;};
//echo "state = ",$state;
// Kui on valitud "sel", siis näitame vaid neid koole, mis vastavad määratlusele ...
if($sel==0||$state==$sel)
{
//	if($line["kutse_fyysika"] or $line["kutse_keemia"] or $line["kutse_valgus"] or $line["kutse_materjal"] or $line["kutse_robot"]) {$state=1;} ?>
  <tr> 
    <td align="center" valign="top" class="menu_punane" width="3%"><img src="image/spacer.gif" width="1" height="15" /><? echo $count;?></td>
    <td nowrap class="menu"><a href="index.php?page=koolt_disp&fid=<? echo $line["id"]; ?>"><? echo $line["nimi"]; if($line["on_globe"]==1) {echo "(G)";}
?></a><br><span class="navi"><? echo $line["aadress"];?></span></td>
    <td nowrap class="menu" valign="top"><?

					$query_33="SELECT id, eesnimi, perenimi, mobla, email1 FROM isik WHERE on_tugiisik='1'";
					$result_33=mysql_query($query_33);
					while($line_33=mysql_fetch_array($result_33))
					{	//echo "siin";
						$query_onopetaja="SELECT * FROM isik_kool WHERE oid2='".$line["id"]."' AND oid1='".$line_33["id"]."'";
						$result_onopetaja=mysql_query($query_onopetaja);
						if($line_onopetaja=mysql_fetch_array($result_onopetaja))
						{	
								?><a href="mailto:<? echo $line_33["email1"];?>"> <? echo $line_33["eesnimi"]," ",$line_33["perenimi"], " (",$line_33["mobla"],")";
								?>
								 </a><?
								
						}

					}
?>	
</td>
    <td align="center" valign="top" nowrap class="menu"><? if ($line["email1"]) {?><a href="mailto:<? echo $line["email1"];?>"><img src="image/EmailIcon.jpg" width="18" height="20" border="0" /></a><? }?></td>
    <td align="center" valign="top" nowrap class="pealkiri"><? if ($line["veeb"]) {?><a href="<? echo $line["veeb"];?>" target="_blank">www</a><? }?></td>
	
    <td  width="5%" class="menu" nowrap valign="top"> 
      <?
	$query3="SELECT nimi FROM maakonnad WHERE id=".$line["maakond"];
	$result3=mysql_query($query3);
	$m=mysql_fetch_array($result3);
	
	echo $m["nimi"]; ?>    </td>
    <td width="2%" valign="top"  class="smallbody"> 
      <? if($priv>=2) {?>
      <a class="menu_punane" href="index.php?page=kool_table&action=del&fid=<? echo $line["id"]; ?>">x</a> 
      <? } ?></td>
    <td width="4%" align="right" valign="top" nowrap class="smallbody"> 
      <?  if($line["PK"]>1000)
	  {
	  ?>
      <img  align="middle" src="image/index_39.gif"> 
      <? } ?>    </td>
  </tr>
  <?
	}
	$count++;
}
?>
</table><table width="100%" border="0">
  <tr>
    <td>
    <div align="center"><iframe align="middle" src="kaart.html" width="550" height="350"></iframe></div></td>
  </tr>
</table>

