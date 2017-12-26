<?
	$etendusid=$_GET["etendusid"];
	$aastakene=$_GET["aasta"];
	include("connect.php");
    $query="SELECT * FROM etendus WHERE id='".$etendusid."'";
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
 ?>
<link href="scat.css" rel="stylesheet" type="text/css" />

<table width="800" border="0" align="center">
  <tr>
    <td><table class="fields" width="100%" border="0">
  <tr> 
    <td width="3%" rowspan="2">&nbsp;</td>
    <td width="6%" rowspan="2">Nimi</td>
    <td width="91%" class="fields_big_b"><? echo $line["nimi_est"]; ?></td>
  </tr>
  <tr>
    <td><? echo $line["kirjeldus_est"]; ?></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
  </tr>
  	<tr > 
		    
    <td background="image/sinine.gif" class="menu" width="100%">Kirjeldus</td>
  	</tr>
</table>
<table class="fields" width="100%" border="0">
  <tr>
    <td width="100%"><? //echo $line["sisu_est"]; 
	
	
	
	
		$tykid = explode("[[", $line["sisu_est"]);
		for($i = 0; $i < sizeof($tykid); ++$i)
		{
			//echo sizeof($tykid)," tykki."; 
			$tykid_2 = explode("]]", $tykid[$i]);
			if (sizeof($tykid_2)>1) 
			{
				$query6="SELECT * FROM exp WHERE id=".$tykid_2[0];
				$result6=mysql_query($query6);
				$line6=mysql_fetch_array($result6);
				
				
			?>
            <table bgcolor="#FFFFCC" width="100%" border="0">
              <tr>
                <td width="87%" valign="top" class="pealkiri"><? echo $line6["nimi_est"];?></td>
                <td width="13%" rowspan="2"><img width="<? echo $pildi_laius;?>" src="http://www.fyysika.ee/omad/<? echo urldecode($line6["veeb_pilt_url"]); ?>"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            <?

			echo $tykid_2[1];
			}
			else
			
			echo $tykid_2[0];
				
		}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	?></td>
  </tr>
</table>





<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		    
    <td background="image/sinine.gif" class="menu" width="100%">Eksperimendid ...</td>
  	</tr>
</table>
        
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="menu"> 
    <td > 
Eksperimendi/t&ouml;&ouml;toa nimi   </td>
    <td width="32%" >&nbsp;</td>
    <td width="37%" >Pilt</td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="3" width="31%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
       <?
$query2="SELECT id,oid2 FROM etendus_exp WHERE oid1=".$etendusid;
echo $query2;
$result2=mysql_query($query2); $count=1;
		while($tulem=mysql_fetch_array($result2)){
					$q="SELECT nimi_est, veeb_pilt_url FROM exp WHERE id=".$tulem["oid2"];
					$r=mysql_query($q);
					$t=mysql_fetch_array($r);
					?>
  <tr class="fields"> 
    <td valign="top" > 
       <strong><?
					echo $count,". ",$t["nimi_est"];
					?>  </strong> </td>
    <td width="32%" >&nbsp;</td>
    <td width="37%" ><?php if($t["veeb_pilt_url"]) { ?><img src="<? echo urldecode($t["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" width="100" align="right" style="background-color: #CCCCCC"><?php }?></td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="3" width="31%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr class="fields"> 
    <td >&nbsp; </td>
    <td colspan="2" width="32%" >
	
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="menu"> 
    <td width="24%" bgcolor="#D9E9FE" > Vahendid: nimi</td>
    <td width="31%" bgcolor="#D9E9FE" >Asukoht</td>
    <td width="45%" bgcolor="#D9E9FE" >Pilt</td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
       <?
$query33="SELECT id,oid2 FROM exp_vahendid WHERE oid1=".$tulem["oid2"];
$result33=mysql_query($query33);
		while($tulem33=mysql_fetch_array($result33)){
					$q33="SELECT nimi_est, veeb_pilt_url, asukoht, kood FROM vahendid WHERE id=".$tulem33["oid2"];
					$r33=mysql_query($q33);
					$t33=mysql_fetch_array($r33);
					?>
  <tr class="fields"> 
    <td valign="top" ><a href="index.php?page=vahendid_disp&vid=<? echo $tulem33["oid2"]; ?>"><?
					echo $t33["nimi_est"];
					?></a></td>
    <td width="31%" valign="top" ><? echo $t33["asukoht"];?></td>
    <td width="45%" ><?php if($t33["veeb_pilt_url"]) { ?><img src="<? echo urldecode($t33["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" width="70" align="right" style="background-color: #CCCCCC"><?php }?></td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <?
					}


?>
</table>
	
	
	
	</td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="3" width="31%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
 <?
					$count++; }


?>
</table>







</td>
  </tr>
</table>





        



