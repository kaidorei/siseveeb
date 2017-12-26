<?
	$eh=$_GET["action"];
	if($eh=="new"){
		$gpid=$_GET["gpid"];
		$tmp=mysql_query("INSERT INTO tehno (nimi_est,pid) VALUES (\"Nimetu\",1)");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$pid=$tmp["last_insert_id()"];
//		echo $pid;
		// ------------------------------------------------
	} elseif($eh=="save"){
		$valjad=array("nimi_est","nimi_rus", "nimi_eng", "kirjeldus_est","kirjeldus_rus", "kirjeldus_eng","text_est","text_rus", "text_eng","naita_veebis","jarjest","tase_z");
		foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
		}
	if($eh=="save"){
		$query="UPDATE tehno SET ".implode(",",$rida)." WHERE id=".$pid;		}
//		echo $query;
		$result=mysql_query($query);
	}	
	$valjad=array("nimi_est","nimi_rus", "nimi_eng", "kirjeldus_est","kirjeldus_rus", "kirjeldus_eng","text_est","text_rus", "text_eng","naita_veebis","jarjest","tase_z");
//	$query="SELECT ".implode(",",$valjad)." FROM tehno WHERE id=".$pid;
	$query="SELECT * FROM tehno WHERE id=".$pid;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?> <br>

<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=tehno_disp&action=save&pid=".$pid; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
      <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="35%">Nimi EST</td>
          <td width="65%" ><input name="nimi_est" type="text" class="fields" value="<? echo $line["nimi_est"]; ?>" size="45" > 
          </td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="35%">Nimi ENG</td>
          <td width="65%" ><input name="nimi_eng" type="text" class="fields" value="<? echo $line["nimi_eng"]; ?>" size="45" > 
          </td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="35%">Nimi RUS</td>
          <td width="65%" ><input name="nimi_rus" type="text" class="fields" value="<? echo $line["nimi_rus"]; ?>" size="45" > 
          </td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="35%">Tase (z)</td>
          <td width="65%" ><input name="tase_z" type="text" class="fields" value="<? echo $line["tase_z"]; ?>" size="45" > 
          </td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		<td background="image/sinine.gif"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
		    <td background="image/sinine.gif" class="menu" width="35%">tehno ruumi seosed ...</td>
		<td width="65%" ></td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
	<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
	<td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
	        <td class="menu" width="35%">Kuhu kuulub</td>
	        <td width="65%" >
              <?
		include("tabel_class_iid.php");
				tabel2("tehno_tehno",$pid,$_SESSION["mysession"]["login"],2,1);
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
	        <td class="menu" width="35%">Siit l&auml;htuv alamhulk</td>
	<td width="65%" ><?
				tabel2("tehno_tehno",$pid,$_SESSION["mysession"]["login"],1,1);
	?>
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
	<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
</table>
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
		    <td class="menu" width="35%">Uudised/Kronoloogia</td>
		<td width="65%" ><?
					tabel2("tehno_uudised",$pid,$_SESSION["mysession"]["login"],1,1);
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
					tabel2("tehno_isik",$pid,$_SESSION["mysession"]["login"],1,1);
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
	        <td class="menu" width="35%">Asutused/Firmad</td>
	<td width="65%" ><?
				tabel2("tehno_firma",$pid,$_SESSION["mysession"]["login"],1,1);
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
	        <td class="menu" width="35%">Teadus</td>
	<td width="65%" ><?
				tabel2("pacs_tehno",$pid,$_SESSION["mysession"]["login"],1,1);
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
	        <td class="menu" width="35%">Seadmed</td>
	<td width="65%" >Siia tulevad teed</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
	<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
	<td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
	        <td class="menu" width="35%">Exponaadid/Demod</td>
	<td width="65%" ><?
				tabel2("tehno_exp",$pid,$_SESSION["mysession"]["login"],1,1);
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
	        <td class="menu" width="35%">T&ouml;&ouml;toad</td>
	<td width="65%" ><?
				tabel2("tehno_tootuba",$pid,$_SESSION["mysession"]["login"],1,1);
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
	        <td class="menu" width="35%">Nupula</td>
	<td width="65%" ><?
				tabel2("tehno_nupula",$pid,$_SESSION["mysession"]["login"],1,1);
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
		tabel("tehno_pildid",$pid,$_SESSION["mysession"]["login"], 1);								
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
			tabel("tehno_docs",$pid,$_SESSION["mysession"]["login"], 0);								
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
					lingid("tehno_lingid",$pid,$_SESSION["mysession"]["login"]);
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
	<? // if($priv>=2) {?>
	<input class="button" type="submit" name="Submit" value="Salvesta">
	<? //} ?>
	</td>
	</tr>
</table>
		</td>
<? //................................................................................................................................. ?>
      <td width="250" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="2" height="10"><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">N&auml;ita veebis</td>
            <td width="45%" > <input class="fields" name="naita_veebis" type="text" value="<? echo $line["naita_veebis"]; ?>" ></td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">Viimane uuendus</td>
            <td width="45%" > <input class="fields" name="update" type="text" value="<? 
		include("globals.php");
			echo timestamp2($line["lupdate"]); ?>" > </td>
          </tr>
</table>
        <? include("tehno_lisad.php"); ?>
		<a href=<? echo urldecode($line["veeb_pilt_url_s"]); ?>  target=_blank><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"></a>
      </td>
  </tr>
</table>
<table width="100%">
<tr><td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		<td background="image/sinine.gif"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
		    <td background="image/sinine.gif" class="menu" width="55%">Text ...</td>
		<td width="65%" ></td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
       </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="55%">Tutvustus EST</td>
          <td width="65%" ><textarea name="tutvustus_est" cols="100" rows="2" class="fields"><? echo $line["tutvustus_est"]; ?> </textarea>
          </td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
       </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Tutvustus ENG</td>
          <td width="65%" ><textarea name="tutvustus_eng" cols="100" rows="2" class="fields"><? echo $line["tutvustus_eng"]; ?> </textarea>
          </td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
       </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Tutvustus RUS</td>
          <td width="65%" ><textarea name="tutvustus_rus" cols="100" rows="2" class="fields"><? echo $line["tutvustus_rus"]; ?> </textarea>
          </td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Text EST</td>
          <td width="65%" > <textarea class="fields" name="juhend_est" rows="4" cols="100"><? echo $line["text_est"]; ?></textarea></td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Text ENG</td>
          <td width="65%" > <textarea class="fields" name="juhend_eng" rows="4" cols="100"><? echo $line["text_eng"]; ?></textarea></td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Text RUS</td>
          <td width="65%" > <textarea class="fields" name="juhend_rus" rows="4" cols="100"><? echo $line["text_rus"]; ?></textarea></td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
</table>
</td></tr>
</table>
</form>









