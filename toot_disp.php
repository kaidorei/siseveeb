<?
	$eh=$_GET["action"];
	if($eh=="new"){
		$gpid=$_GET["gpid"];
		$tmp=mysql_query("INSERT INTO tootuba (nimi_est,gpid) VALUES (\"Nimetu\",\"1\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$tootid=$tmp["last_insert_id()"];
//		echo $tootid;
		// ------------------------------------------------
	} elseif($eh=="save"){
		$valjad=array("gpid","gpid_tootuba","nimi_est","nimi_eng","nimi_rus","sihtgrupp","naita_veebis", "veeb_pilt_url" , "veeb_pilt_url_s" ,"riikl_progr","kestus","hind","max_osav","hind_soit","hind_inim","hind_min","hind_soit_inim","hind_soit_min","tutvustus_est","tutvustus_eng","tutvustus_rus","juhend_est","juhend_rus","juhend_eng","inv_kaal","inv_diam");
		foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
		}
	if($eh=="save"){
		$query="UPDATE tootuba SET ".implode(",",$rida)." WHERE id=".$tootid;		}
//		echo $query;
		$result=mysql_query($query);
	}	
	$valjad=array("gpid","gpid_tootuba","nimi_est","nimi_eng","nimi_rus","sihtgrupp","naita_veebis","veeb_pilt_url","veeb_pilt_url_s","riikl_progr","kestus","hind","max_osav","hind_soit","hind_inim","hind_min","hind_soit_inim","hind_soit_min","tutvustus_est","tutvustus_eng","tutvustus_rus","juhend_est","juhend_rus","juhend_eng","inv_kaal","inv_diam","lupdate");
	$query="SELECT ".implode(",",$valjad)." FROM tootuba WHERE id=".$tootid;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?> <br>

<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=toot_disp&action=save&tootid=".$tootid; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
      <td width="60%" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr background="image/sinine.gif"> 
						  <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
						</tr>
						<tr> 
						  <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
						  <td class="menu" width="35%">Nimi EST</td>
						  <td width="65%" ><input name="nimi_est" type="text" class="fields" value="<? echo $line["nimi_est"]; ?>" size="100" > 
						  </td>
						</tr>
				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr background="image/sinine.gif"> 
						  <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
					   </tr>
						<tr> 
						  <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
							<td class="menu" width="35%">Tutvustus EST</td>
						  <td width="65%" ><textarea name="tutvustus_est" cols="100" rows="4" class="fields"><? echo $line["tutvustus_est"]; ?> </textarea>
						  </td>
						</tr>
						<tr background="image/sinine.gif"> 
						  <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
					   </tr>
				 
						<tr background="image/sinine.gif"> 
						  <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
						</tr>
						<tr> 
						  <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
							<td class="menu" width="35%">Juhend EST</td>
						  <td width="65%" > <textarea class="fields" name="juhend_est" rows="6" cols="100"><? echo $line["juhend_est"]; ?></textarea></td>
						</tr>
						<tr background="image/sinine.gif"> 
						  <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
						</tr>
				</table>
</tr></td></table>

  <table width="100%">
    <tr>
      <td width="60%" valign="top"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
          </tr>
          <tr > 
            <td background="image/sinine.gif"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td background="image/sinine.gif" class="menu" width="35%">Seonduvad 
              ...</td>
            <td width="65%" ></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr background="image/sinine.gif"> 
					<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
				  </tr>
				  <tr> 
					<td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
							<td class="menu" width="35%">PACS</td>
					<td width="65%" ><?
						include("tabel_class_iid.php");
								tabel2("pacs_tootuba",$tootid,$_SESSION["mysession"]["login"],2,1);
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
						<td class="menu" width="35%">Isikud</td>
						<td width="65%" ><?
									tabel2("tootuba_isik",$tootid,$_SESSION["mysession"]["login"],1,1);
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
							<td class="menu" width="35%">Asutused</td>
					<td width="65%" ><?
								tabel2("tootuba_firma",$tootid,$_SESSION["mysession"]["login"],1,1);
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
						tabel("tootuba_pildid",$tootid,$_SESSION["mysession"]["login"], 1);
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
							tabel("tootuba_docs",$tootid,$_SESSION["mysession"]["login"], 0);								
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
									lingid("tootuba_lingid",$tootid,$_SESSION["mysession"]["login"]);
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
					<? //if($priv==2) {?>
					<input class="button" type="submit" name="Submit" value="Salvesta">
					<? //} ?>
					</td>
					<td width="65%" >&nbsp; </td>
					</tr>
				</table>
				
	</td>
    	
      <td width="40%" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
       </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="55%">Sihtgrupp</td>
          <td width="45%" ><textarea name="sihtgrupp" cols="30" rows="1" class="fields"><? echo $line["sihtgrupp"]; ?> </textarea>
          </td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="55%">N&auml;ita veebis</td>
            <td width="45%" > <input class="fields" name="naita_veebis" type="text" value="<? echo $line["naita_veebis"]; ?>" ></td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="55%">Töötoa kestus (min)</td>
          <td width="45%" > <input class="fields" name="kestus" type="text" value="<? echo $line["kestus"]; ?>" > 
          </td>
        </tr>
</table>
 


<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="55%">Max. osavõtjate arv</td>
          <td width="45%" > <input class="fields" name="max_osav" type="text" value="<? echo $line["max_osav"]; ?>" > 
          </td>
        </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="55%">Inventari kaal (kg)</td>
          <td width="45%" > <input class="fields" name="inv_kaal" type="text" value="<? echo $line["inv_kaal"]; ?>" > 
          </td>
        </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="55%">Inventari diameeter (cm)</td>
          <td width="45%" > <input class="fields" name="inv_diam" type="text" value="<? echo $line["inv_diam"]; ?>" > 
          </td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="55%">Viimane uuendus</td>
            <td width="45%" > <input class="fields" name="update" type="text" value="<? 
		include("globals.php");
			echo timestamp2($line["lupdate"]); ?>" > </td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		    <td width="4%" background="image/sinine.gif"></td>
		    <td background="image/sinine.gif" class="menu" width="96%">Eksponaadid/Demod:</td>
  	</tr>
</table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr background="image/sinine.gif"> 
				<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
			</tr>
			<tr>
            	<td width="65%" ><?
						tabel2("tootuba_exp",$tootid,$_SESSION["mysession"]["login"],1,1);
			?>
            </td>
          </tr>
		  </table>
        <? include("toot_lisad.php"); ?>
		<a href=<? echo urldecode($line["veeb_pilt_url_s"]); ?>  target=_blank><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" width="240" align="right" style="background-color: #CCCCCC"></a>
      </td>
  </tr>
</table>
<table width="100%">
<tr><td>
</form>









