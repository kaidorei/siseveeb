<?
	$eh=$_GET["action"];
	$veeb=$_GET["veeb"];
	$toolid=$_GET["toolid"];
	$summa=$_GET["summa"];
	
	
	if($eh=="new"){
		$isik=$_GET["isik"];
		if ($isik==NULL) $isik=0;
		if ($summa==NULL) $summa=0;
		
		
// NB pane allkirja kuupäevaks alguskuupäev ...		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// Leiame sellele isikule tehtud kõige uuema töölepingu lõppkuupäeva ja paneme sellele järgneva päeva uue töölepingu alguskuupäevaks.
		
		// kui vahepeal ühtegi tehtud pole, pane selline ...
		$algus_tmp=date("Y-m-d", mktime (0,0,0,01,01,2006));
		$paevasid_tmp=1;		
		$query5="SELECT nmbr,id, algus, lopp, tegevus, isik_id,staatus, summa FROM tooleht WHERE isik_id=".$isik;
		$result5=mysql_query($query5);
			while($line5=mysql_fetch_array($result5))
			{
					$kuu=substr($line5["lopp"],5,2);
					$paev=substr($line5["lopp"],8,2);
					$aasta=substr($line5["lopp"],0,4);
					$paevasid= date("z", mktime (0,0,0,$kuu ,$paev,$aasta));
					if($paevasid>$paevasid_tmp)
					{
						$algus_tmp= date("Y-m-d", mktime (0,0,0,$kuu ,$paev+1,$aasta));
					}
			}
	// küsime mis on maksimaalne tööettevõtulepingu number andmebaasis ...
		$query6="SELECT MAX(nmbr) FROM tooleht";
		$result6=mysql_query($query6);
		$line6=mysql_fetch_array($result6);
		$max_nmbr = $line6[0] +1;
		$query="INSERT INTO tooleht (id,nmbr,allkiri,algus,lopp,isik_id,tegevus,summa) VALUES ('','".$max_nmbr."','".$algus_tmp."','".$algus_tmp."','".date("Y-m-d")."','".$isik."','3','".$summa."')";
		$tmp=mysql_query($query);
//		echo $query;
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$toolid=$tmp["last_insert_id()"];

//		echo $toolid;

		// ------------------------------------------------
	} elseif($eh=="save"){
		$valjad=array("nmbr", "algus", "lopp", "isik_id","tegevus", "summa","staatus","allkiri");
		foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
			}
		$query="UPDATE tooleht SET ".implode(",",$rida)." WHERE id=".$toolid;
//		echo $query;	
		$result=mysql_query($query);
	}	

	$valjad=array("nmbr", "algus", "lopp", "isik_id","tegevus", "summa","staatus","allkiri");
    $query="SELECT ".implode(",",$valjad)." FROM tooleht WHERE id=".$toolid;
//	echo $query;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
 ?> 
<br>
<form name="naitus" method="post" action="<? echo $PHP_SELF."?page=tool_disp&action=save&toolid=".$toolid; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
      <td width="65%" valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Lepingu number</td>
          <td width="65%" ><input name="nmbr" type="text" class="fields" value="<? echo $line["nmbr"]; ?>" size="45" > 
          </td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Isik</td>
          <td width="65%" >             <? 
			$query2="SELECT id,eesnimi, perenimi FROM isik WHERE in_buss=1 ORDER BY eesnimi;";
			$result2=mysql_query($query2);
			echo "<select  class=\"fields\" name=\"isik_id\">";
				while($var=mysql_fetch_array($result2)){
					if($var["id"]==$line["isik_id"]) { $sel="selected"; } else { $sel="";}
						echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["eesnimi"]." ".$var["perenimi"]."</option>"; 
				}
					echo "</select>";
		  ?>
 
          </td>
        </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Algus</td>
            <td width="65%" > <input name="algus" type="text" class="fields" value="<? echo $line["algus"]; ?>" size="45" ></td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">L&otilde;pp</td>
          <td width="65%" > <input name="lopp" type="text" class="fields" value="<? echo $line["lopp"]; ?>" size="45" > 
          </td>
        </tr>
       <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Allkirja kuup&auml;ev</td>
          <td width="65%" > <input name="allkiri" type="text" class="fields" value="<? echo $line["allkiri"]; ?>" size="45" > 
          </td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%"><p>Summa (k&auml;tte)</p>
              </td>
          <td width="65%" > <input name="summa" type="text" class="fields" value="<? echo $line["summa"]; ?>" size="45" > 
          </td>
        </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Mille eest</td>
          <td width="65%" >             <? 
			$query2="SELECT id,nimi FROM tooleht_liik ORDER BY nimi;";
			$result2=mysql_query($query2);
			echo "<select  class=\"fields\" name=\"tegevus\">";
				while($var=mysql_fetch_array($result2)){
					if($var["id"]==$line["tegevus"]) { $sel="selected"; } else { $sel="";}
						echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["nimi"]."</option>"; 
				}
					echo "</select>";
		  ?>
 
          </td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Staatus</td>
          <td width="65%" >             <? 
			$query2="SELECT id,nimi FROM tooleht_staatus ORDER BY nimi;";
			$result2=mysql_query($query2);
			echo "<select  class=\"fields\" name=\"staatus\">";
				while($var=mysql_fetch_array($result2)){
					if($var["id"]==$line["staatus"]) { $sel="selected"; } else { $sel="";}
						echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["nimi"]."</option>"; 
				}
					echo "</select>";
		  ?>
 
          </td>
        </tr>
</table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td width="100%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
        </table>


        <table width="100%" height="34" border="0" cellpadding="0" cellspacing="0">
          <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          	<td height="33"><img src="image/spacer.gif" width="20" height="40"><img src="image/spacer.gif" width="10" height="10"></td>
          	<td class="menu" width="35%">
			<? if($priv>=2) {?>      
              <input class="button2" type="submit" name="Submit" value="Salvesta">
      <? } ?>	         </td><td width="65%" bordercolor="#CCCCCC" >			<? if($priv>=2) {?>      

            <div align="left"><a class="menu" href="tool_tekst.php?toolid=<? echo $toolid; ?>&aasta=<? echo $aastakene;?>">Tr&uuml;ki 
                asi v&auml;lja</a></div></td>
      <? } ?>
        </tr>
</table> 
</td>

<td  valign="top"> 


</td>
</tr>
</table>
</form>
