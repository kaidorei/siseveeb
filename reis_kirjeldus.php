<?
	$reisid=$_GET["reisid"];
	$aastakene=$_GET["aasta"];
	$valjad=array("nimi", "algus", "lopp", "reisikiri","hooaeg_nmbr","et_arv","nadal_nmbr",  "naita_veeb", "pealik");
    $query="SELECT ".implode(",",$valjad)." FROM reis WHERE id=".$reisid;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
 ?> 
<table class="fields" width="100%" border="0">
  <tr> 
    <td width="3%">&nbsp;</td>
    <td width="34%">Nimi</td>
    <td width="63%"><? echo $line["nimi"]; ?></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Reisi PEALIK</td>
    <td> 
      <? 
			$query2="SELECT id,eesnimi, perenimi FROM isik WHERE in_buss=1 ORDER BY eesnimi;";
			$result2=mysql_query($query2);
				while($var=mysql_fetch_array($result2)){
					if($var["id"]==$line["pealik"]) echo $var["eesnimi"]," ",$var["perenimi"];		 
				}
		  ?>
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>N&auml;dal</td>
    <td><? echo $line["nadal_nmbr"]; ?></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Hooaeg</td>
    <td><? echo $line["hooaeg_nmbr"]; ?></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Algus:</td>
    <td><? echo $line["algus"]; ?></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>L&otilde;pp:</td>
    <td><? echo $line["lopp"]; ?></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		    
    <td background="image/sinine.gif" class="menu" width="100%">K&uuml;lastatavad 
      koolid ...</td>
  	</tr>
</table>
        
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="menu"> 
    <td > 
Kooli nimi    </td>
    <td width="32%" >Kontakt</td>
    <td width="37%" >Telefon</td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="3" width="31%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
       <?
$query2="SELECT id,oid2 FROM reis_kool WHERE oid1=".$reisid;
$result2=mysql_query($query2);
		while($tulem=mysql_fetch_array($result2)){
					$q="SELECT nimi, kontakt1, tel1, email1, aadress, markused FROM kool WHERE id=".$tulem["oid2"];
					$r=mysql_query($q);
					$t=mysql_fetch_array($r);
					?>
  <tr class="fields"> 
    <td > 
      <?
					echo $t["nimi"];
					?>
    </td>
    <td width="32%" ><? echo $t["kontakt1"];?></td>
    <td width="37%" ><? echo $t["tel1"];?></td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="3" width="31%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr class="fields"> 
    <td >&nbsp; </td>
    <td colspan="2" width="32%" ><? echo $t["markused"];?></td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="3" width="31%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
 <?
					}


?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		    
    <td background="image/sinine.gif" class="menu" width="100%">Teelised ...</td>
  	</tr>
</table>
        
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="menu"> 
    <td > Nimi</td>
    <td width="32%" >Telefon</td>
    <td width="37%" >e-mail</td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="3" width="31%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
       <?
$query2="SELECT id,oid2 FROM reis_isik WHERE oid1=".$reisid;
$result2=mysql_query($query2);
		while($tulem=mysql_fetch_array($result2)){
					$q="SELECT perenimi, eesnimi, mobla, email1 FROM isik WHERE id=".$tulem["oid2"];
					$r=mysql_query($q);
					$t=mysql_fetch_array($r);
					?>
  <tr class="fields"> 
    <td > 
      <?
					echo $t["eesnimi"], " ", $t["perenimi"];
					?>
    </td>
    <td width="32%" ><? echo $t["mobla"];?></td>
    <td width="37%" ><? echo $t["email1"];?></td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="3" width="31%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <?
					}


?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		    
    <td background="image/sinine.gif" class="menu" width="100%">Reisi kirjeldus</td>
  	</tr>
</table>
<table class="fields" width="100%" border="0">
  <tr>
     <td width="100%"><div align="center">
        <textarea name="reisikiri" cols="105" rows="80" class="fields"><? echo $line["reisikiri"]; ?> </textarea>
      </div></td>
  </tr>
  <tr>
</table>


