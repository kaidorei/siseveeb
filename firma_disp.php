<?
	$eh=$_GET["action"];
	$fid=$_GET["fid"];
	if($eh=="new"){
		$tmp=mysql_query("INSERT INTO firma (nimi) VALUES (\"Nimetu\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$fid=$tmp["last_insert_id()"];
		// ------------------------------------------------
		} elseif($eh=="save"){
		  $valjad=array("nimi","gpid_firma","riik","kylastusi","kirjeldus_est","kirjeldus_eng","kirjeldus_rus","postiaadress","tel1","fax1","email1","www","knowhow_id","markused","naita_veebis","tooliseid");
			foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
			$query="UPDATE firma SET ".implode(",",$rida)." WHERE id=".$fid;
//			echo $query;
			$result=mysql_query($query);
			}
	}	
	$valjad=array("nimi","gpid_firma","riik","kylastusi","postiaadress","kirjeldus_est","kirjeldus_eng","kirjeldus_rus","tel1","fax1","email1","www","knowhow_id","markused","tooliseid","naita_veebis","lupdate");
    $query="SELECT ".implode(",",$valjad)." FROM firma WHERE id=".$fid;
//	echo $eh;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
 ?> <br>

<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=firma_disp&action=save&fid=".$fid; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
      <td width="65%" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="35%">Nimi</td>
          <td width="65%" ><input name="nimi" type="text" class="fields" value="<? echo $line["nimi"]; ?>" size="45" > 
          </td>
        </tr>
</table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  		<tr>
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
      	</tr>
		<tr>
          	<td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Asutuse kategooria</td>
            <td width="65%" > 
		<? 
		 $gpid2=$line["gpid_firma"];//}
//				echo $line["gpid_tootuba"], $gpid2;
				$query2="SELECT id,nimi FROM firma_grupid ORDER BY nimi";
				$result2=mysql_query($query2);
				echo "<select  class=\"fields\" name=\"gpid_firma\">";
				while($var=mysql_fetch_array($result2)){
					if($var["id"]==$gpid2) { $sel="selected"; } else { $sel="";}
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
            <td class="menu" width="35%">L&uuml;hikirjeldus EST</td>
            <td width="65%" > <textarea cols="55" rows="10" class="fields" name="kirjeldus_est" type="text" value="" ><? echo $line["kirjeldus_est"]; ?> </textarea>
           </td>
           </tr>
        </table>
<?
		include("tabel_class_iid.php");

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		<td background="image/sinine.gif"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
		    <td background="image/sinine.gif" class="menu" width="35%">Seonduvad 
              ... </td>
		<td width="65%" ></td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
	<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
	<td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
	        <td class="menu" width="35%">... f&uuml;&uuml;sika harud</td>
	<td width="65%" ><?
				tabel2("pacs_firma",$fid,$_SESSION["mysession"]["login"],2,1);
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
	        <td class="menu" width="35%"> ... tehnoloogiad</td>
	<td width="65%" ><?
				tabel2("tehno_firma",$fid,$_SESSION["mysession"]["login"],2,1);
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
		    <td class="menu" width="35%">... aineprogrammi punktid</td>
		<td width="65%" ><?
					tabel2("aine_firma",$fid,$_SESSION["mysession"]["login"],2,1);
		?>
		</td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		<td background="image/sinine.gif"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
		    <td background="image/sinine.gif" class="menu" width="35%">Seonduvad 
              ... </td>
		<td width="65%" ></td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
	<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
	<td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
	        <td class="menu" width="35%">... seadmed</td>
	<td width="65%" > Siia tulevad teed<?
				//tabel2("masin_firma",$fid,$_SESSION["mysession"]["login"],1,1);
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
	        <td class="menu" width="35%">... isikud</td>
	<td width="65%" ><?
				tabel2("firma_isik",$fid,$_SESSION["mysession"]["login"],1,1);
	?>
	</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		<td background="image/sinine.gif"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
		    <td background="image/sinine.gif" class="menu" width="35%">Failid ...</td>
		<td width="65%" ></td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr background="image/sinine.gif"> 
		<td colspan="3"  background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
	</tr>
	<tr> 
		<td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
		<td class="menu" width="35%">Joonised/Fotod</td>
		<td width="65%" >
		<?
		include("tabel_class_oid.php");
	//	echo $tootid;
		tabel("firma_pildid",$fid,$_SESSION["mysession"]["login"], 0);								
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
            <td class="menu" width="35%">Tekstid/Dokumendid</td>
          <td width="65%" >
            <?
			tabel("firma_doc",$fid,$_SESSION["mysession"]["login"], 0);								
			?>
          </td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		<td background="image/sinine.gif"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
		    <td background="image/sinine.gif" class="menu" width="35%">WWW ...</td>
		<td width="65%" ></td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Seonduvad lingid</td>
            <td width="65%" > 
              <?
		  			include("link_class.php");
					lingid("firma_lingid",$fid,$_SESSION["mysession"]["login"]);
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
          <td class="menu" width="35%">

			<? //if($priv>=2) {?>

		  	<input class="button" type="submit" name="Submit" value="Salvesta">

			<? //} ?>

            </td>
          <td width="65%" >&nbsp; </td>
        </tr>
      </table> </td>
	  

<td width="250" valign="top"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		    <td background="image/sinine.gif"></td>
		    <td background="image/sinine.gif" class="menu" width="55%">Kontakt ...</td>
		<td width="45%" ></td>
  	</tr>
</table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">L&uuml;hiaadress</td>
          <td width="45%" > <input name="riik" type="text" class="fields" value="<? echo $line["riik"]; ?>" size="20" > 
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">Postiaadress</td>
          <td width="45%" > <input name="postiaadress" type="text" class="fields" value="<? echo $line["postiaadress"]; ?>" size="20" > 
          </td>
        </tr>
      </table>



        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">Telefon</td>
            <td width="45%" > <input name="tel1" type="text" class="fields" value="<? echo $line["tel1"]; ?>" size="20" > 
            </td>
          </tr>
        </table>



        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">Fax</td>
            <td width="45%" > <input name="fax1" type="text" class="fields" value="<? echo $line["fax1"]; ?>" size="20" > 
            </td>
          </tr>
        </table>



        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
             
            <td class="menu" width="55%">E-mail</td>
            <td width="45%" > <input name="email1" type="text" class="fields" value="<? echo $line["email1"]; ?>" size="20" > 
            </td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%"><a href="<? echo $line["www"]; ?>" target="_blank">www kodu</a></td>
            <td width="45%" > <input name="www" type="text" class="fields" value="<? echo $line["www"]; ?>" size="20" > 
            </td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">T&ouml;&ouml;tajaid</td>
            <td width="45%" > <input name="tooliseid" type="text" class="fields" value="<? echo $line["tooliseid"]; ?>" size="20" > 
            </td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">N&auml;ita veebis</td>
            <td width="45%" > <input name="naita_veebis" type="text" class="fields" value="<? echo $line["naita_veebis"]; ?>" size="20" > 
            </td>
          </tr>
        </table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">Viimane uuendus</td>
            <td width="45%" > <input name="update" type="text" class="fields" value="<? 
			include("globals.php");
			echo timestamp2($line["lupdate"]); ?>" size="20" > 
            </td>
          </tr>
        </table>
		
</td>		
</table>






</td>
 </tr>
</table></form>
