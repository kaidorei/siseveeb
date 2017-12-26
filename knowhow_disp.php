<?
	$eh=$_GET["action"];
	$kid=$_GET["kid"];
	if($eh=="new"){
		$tmp=mysql_query("INSERT INTO knowhow (nimi) VALUES (\"Nimetu\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$kid=$tmp["last_insert_id()"];

		// ------------------------------------------------

		} elseif($eh=="save"){
		    $valjad=array("nimi","markused","kirjeldus");
			foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
		}
		$query="UPDATE knowhow SET ".implode(",",$rida)." WHERE id=".$kid;		
		$result=mysql_query($query);
	}	

	$valjad=array("nimi","markused","kirjeldus","lupdate");
    $query="SELECT ".implode(",",$valjad)." FROM knowhow WHERE id=".$kid;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 

	
 ?> <br>
<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=knowhow_disp&action=save&kid=".$kid; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
      <td width="60%" valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="35%">Nimi</td>
          <td width="65%" ><input class="fields" name="nimi" type="text" value="<? echo $line["nimi"]; ?>" > 
          </td>
        </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="images/sinine.gif"> 
            <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Kirjeldus</td>
            <td width="65%" >
			<textarea name="huvid" cols="45" rows="5" class="fields"><? echo $line["kirjeldus"]; ?>  </textarea>
			</td>
          </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="images/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="images/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		<td background="images/sinine.gif"><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
		    <td background="images/sinine.gif" class="menu" width="35%">Seonduvad 
              ...</td>
		<td width="65%" ></td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="images/sinine.gif"> 
	<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
	<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
	        <td class="menu" width="35%">PACS</td>
	<td width="65%" ><?
		include("tabel_class_iid.php");
				tabel2("pacs_knowhow",$kid,$_SESSION["mysession"]["login"],2,1);
	?>
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="images/sinine.gif"> 
		<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	</tr>
  	<tr> 
		<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
		    <td class="menu" width="35%">Uudised/Kronoloogia</td>
		<td width="65%" ><?
					tabel2("uudis_knowhow",$kid,$_SESSION["mysession"]["login"],2,1);
		?>
		</td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="images/sinine.gif"> 
	<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
	<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
	        <td class="menu" width="35%">Asutused</td>
	<td width="65%" ><?
				tabel2("firma_knowhow",$kid,$_SESSION["mysession"]["login"],2,1);
	?>
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="images/sinine.gif"> 
	<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
	<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
	        <td class="menu" width="35%">Inimesed</td>
	<td width="65%" ><?
				tabel2("knowhow_isik",$kid,$_SESSION["mysession"]["login"],1,1);
	?>
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="images/sinine.gif"> 
	<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
	<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
	        <td class="menu" width="35%">Seadmed/Exponaadid</td>
	<td width="65%" ><?
				tabel2("exp_knowhow",$kid,$_SESSION["mysession"]["login"],2,1);
	?>
	</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="images/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="images/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		<td background="images/sinine.gif"><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
		    <td background="images/sinine.gif" class="menu" width="35%">Failid ...</td>
		<td width="65%" ></td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr background="images/sinine.gif"> 
		<td colspan="3"  background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	</tr>
	<tr> 
		<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
		<td class="menu" width="35%">Joonised/Fotod</td>
		<td width="65%" >
		<?
		include("tabel_class_oid.php");
	//	echo $tootid;
		tabel("knowhow_pildid",$kid,$_SESSION["mysession"]["login"], 1);								
		?>
		</td>
	</tr>
</table>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Tekstid/Dokumendid</td>
          <td width="65%" >
            <?
			tabel("knowhow_docs",$kid,$_SESSION["mysession"]["login"], 0);								
			?>
          </td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="images/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="images/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		<td background="images/sinine.gif"><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
		    <td background="images/sinine.gif" class="menu" width="35%">WWW ...</td>
		<td width="65%" ></td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="images/sinine.gif"> 
            <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Seonduvad lingid</td>
            <td width="65%" > 
              <?
		  			include("link_class.php");
					lingid("knowhow_lingid",$kid,$_SESSION["mysession"]["login"]);
		  ?>
            </td>
          </tr>
</table>


        <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="images/sinine.gif"> 

          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>

          	<td class="menu" width="35%">
		  	<? if($priv>=2) {?>
		  	<input class="button" type="submit" name="Submit" value="Salvesta">
 			<? } ?>
            </td>

          <td width="65%" >&nbsp; </td>

        </tr>

      </table> </td>

      <td width="250" valign="top"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="images/sinine.gif"> 
            <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="images/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Uuendatud</td>
            <td width="65%" > <input class="fields" name="update" type="text" value="<? 
			include("globals.php");
			echo timestamp2($line["lupdate"]); ?>" > 

            </td>
         </tr>
</table>
      </td>

  </tr>

</table></form>









