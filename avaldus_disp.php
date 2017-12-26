<?
	$eh=$_GET["action"];
	$kid=$_GET["kid"];
	if($eh=="new"){
		$tmp=mysql_query("INSERT INTO avaldus (nimi, date) VALUES (\"Kes kutsub?\", \"".date("Y-m-d")."\")");
//		echo $tmp, "arve";
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$kid=$tmp["last_insert_id()"];
		
?>
<link href="scat.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<?
		// ------------------------------------------------
		} elseif($eh=="save"){
		  $valjad=array("nimi","aadress", "kontakt1", "tel1","email1","maksab","soov_kuup", "markused", "etendus_id");
			foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
			}
			$query="UPDATE avaldus SET ".implode(",",$rida)." WHERE id=".$kid." LIMIT 1";
//				echo "SAVE           ", $query;		
			//$result=mysql_query($query);





	}	
    $query="SELECT * FROM avaldus WHERE id=".$kid;
//	echo $query;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
 ?> 
<br>

<form name="kool" method="post" action="<? echo $PHP_SELF."?page=masin_disp&action=save&etendus_id=100&kid=".$kid;?> ">
  <table width="670" border="0">
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
      <td width="100%" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="../registreerimine/images/sinine.gif"> 
            <td width="95%" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
          </tr>
        </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="../registreerimine/images/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="../registreerimine/images/sinine.gif" width="1" height="2"></td>
	</tr>
 </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="../registreerimine/images/sinine.gif"> 
		<td colspan="2"  bgcolor="#FF9900"><img src="../registreerimine/images/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		    <td background="../registreerimine/images/sinine.gif"></td>
		    <td background="../registreerimine/images/sinine.gif" class="pealkiri"><p>NINATARKADE PROJEKTI AVALDUS, kui seda on mingil p&otilde;hjusel ise teha vaja ... </p>
		      <p>NB EI T&Ouml;&Ouml;TA HETKEL </p></td>
		</tr>
</table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr background="../registreerimine/images/sinine.gif"> 
            <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
                  <td width="4%"><img src="../registreerimine/images/spacer.gif" width="20" height="10"></td>
            <td colspan="2" class="menu">Kooli nimi</td>
            <td width="54%" align="left" ><input name="nimi" type="text" class="fields" value="<? echo $line["nimi"]; ?>" size="50" >            </td>
          </tr>
<? if ($line["PK"] < 1000 ) {?>        
	<? } else {?>
	       
	<? }?>
          <tr> 
                  <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"></td>
            <td colspan="2" class="menu">Kooli aadress </td>
            <td align="left" > <input name="aadress" type="text" class="fields" value="<? echo $line["aadress"]; ?>" size="50" >            </td>
          </tr>
          <tr> 
                  <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"></td>
            <td colspan="2" class="menu">Kontaktisik</td>
            <td align="left" ><input name="kontakt1" type="text" class="fields" value="<? echo $line["kontakt1"]; ?>" size="50" /></td>
          </tr>
            <tr> 
                  <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"></td>
            <td colspan="2" class="menu">Telefon</td>
            <td align="left" ><input name="tel12" type="text" class="fields" value="<? echo $line["tel1"]; ?>" size="50" /></td>
            </tr>
          <tr> 
                  <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"></td>
            <td colspan="2" class="menu">e-mail</td>
            <td align="left" ><input name="email1" type="text" class="fields" value="<? echo $line["email1"]; ?>" size="50" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2" class="menu">Missugune etendus? </td>
            <td align="left" ><? 
			$query2="SELECT id,nimi_est FROM etendus ORDER BY id;";
			$result2=mysql_query($query2);
			echo "<select  class=\"fields\" name=\"etendus_id\">";
				while($var=mysql_fetch_array($result2)){
					if($var["id"]==$line["etendus_id"]) { $sel="selected"; } else { $sel="";}
						echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["nimi_est"]."</option>"; 
				}
					echo "</select>";
		  ?> </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2" class="menu">Maksab?</td>
            <td align="left" ><input name="maksab" type="text" class="fields" value="<? echo $line["maksab"]; ?>" size="50" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2" class="menu">Soovitav kuup&auml;ev <span class="fields">(aaaa-kk-pp) </span></td>
            <td align="left" ><input name="soov_kuup" type="text" class="fields" value="<? echo $line["soov_kuup"]; ?>" size="50" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2" class="menu">M&auml;rkused</td>
            <td align="left" ><textarea cols="45" rows="9" class="fields" name="textarea" type="text" value="" ><? echo $line["markused"]; ?> </textarea></td>
          </tr>
        </table>
             <table width="100%" border="0" cellpadding="0" cellspacing="0">
  		<tr>
            <td colspan="3" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
      	</tr>
		</table>


  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="3" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
                  <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"></td>
          <td class="menu" width="35%">

		  	<input class="button" type="submit" name="Submit" value="Salvesta">            </td>
            <td width="65%" ><p align="right">&nbsp;</p>              </td>
        </tr>
      </table> </td>
</table></td>
    </tr>
  </table>
  






</form>

