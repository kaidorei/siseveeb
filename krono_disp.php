<?
		include("FCKeditor/fckeditor.php") ;
	$eh=$_GET["action"];
	$kid=$_GET["kid"];
	if($eh=="new"){
		$tmp=mysql_query("INSERT INTO krono (pealkiri,aasta) VALUES (\"Nimetu\",\"0000\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$nid=$tmp["last_insert_id()"];
//		echo $pid;
		// ------------------------------------------------
	} elseif($eh=="save"){
		$valjad=array("pealkiri","sisu", "aeg","aeg_lopp", "naita_veebis");
		foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
		$query="UPDATE krono SET ".implode(",",$rida)." WHERE id=".$kid;		}
		$result=mysql_query($query);
//	echo $query;
		}
	$query="SELECT * FROM krono WHERE id=".$kid;
	echo $query;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
 <link href="scat.css" rel="stylesheet" type="text/css" />
<br>

<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=krono_disp&action=save&kid=".$kid; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
      <td width="65%" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="3%"><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="19%">Pealkiri</td>
          <td width="78%" ><div align="center">
			<textarea name="pealkiri" cols="105" rows="8" class="fields"><? echo $line["pealkiri"]; ?>  </textarea>
          </div></td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="5" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="9%" height="20"><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="18%">Aasta(algus):</td>
          <td width="27%" ><input class="ekraan_link" name="aeg" type="text" value="<? echo $line["aeg"]; ?>" size="6" /></td>
          <td width="23%" ><p class="menu">(l&otilde;pp)</p>            </td>
          <td width="23%" ><input class="ekraan_link" name="aeg_lopp" type="text" value="<? echo $line["aeg_lopp"]; ?>" size="6" /></td>
          </tr>
        <tr background="images/sinine.gif"> 
          <td colspan="5" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="9%" height="20"><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="18%">&nbsp;</td>
          <td width="27%" class="fields" >&nbsp;</td>
          <td width="23%" ><p class="menu">N&auml;ita&nbsp;veebis</p>            </td>
          <td width="23%" ><input class="fields" name="naita_veebis" type="text" value="<? echo $line["naita_veebis"]; ?>" size="2" /></td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="2%"><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
          <td width="11%" class="menu">Pikem seletus </td>
          <td width="87%" >	<?
		 	$ridasid=200;
$oFCKeditor = new FCKeditor('sisu') ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->Value = $line["sisu"];
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = $ridasid ;
$oFCKeditor->Create() ;
	?>          </td>
        </tr>
        <tr background="images/sinine.gif"> 
          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr background="images/sinine.gif"> 
		<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	</tr>
	<tr> 
		<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
		<td class="menu" width="35%">... fotod/pildid		  </td>
		<td width="65%" >
		<?
		include("tabel_class_oid.php");
	//	echo $tootid;
		tabel("krono_pildid",$kid,$_SESSION["mysession"]["login"], 1);								
		?>		</td>
	</tr>
</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">... doc </td>
            <td width="65%" >           <?
			tabel("krono_docs",$kid,$_SESSION["mysession"]["login"], 0);								
			?>   </td>
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
	<td class="menu" width="35%">... ained </td>
	<td width="65%" ><?
		include("tabel_class_iid.php");
				tabel2("aine_krono",$kid,$_SESSION["mysession"]["login"],2,1);
	?>	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="images/sinine.gif"> 
		<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	</tr>
  	<tr> 
		<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
		<td class="menu" width="35%">... f&uuml;&uuml;sika harud </td>
		<td width="65%" ><?
					tabel2("pacs_krono",$kid,$_SESSION["mysession"]["login"],2,1);
		?>		</td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="images/sinine.gif"> 
	<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
	<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
	        <td class="menu" width="35%">... exp/demo </td>
	        <td width="65%" ><?
				tabel2("exp_krono",$kid,$_SESSION["mysession"]["login"],2,1);
	?>	</td>
  </tr>
  	<tr background="images/sinine.gif"> 
		<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	</tr>
</table>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="images/sinine.gif"> 
            <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%"> ... lingid </td>
            <td width="65%" > 
              <?
		  			include("link_class.php");
					lingid("krono_lingid",$kid,$_SESSION["mysession"]["login"]);
		  ?>            </td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr background="images/sinine.gif"> 
	<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	</tr>
	<tr> 
	<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"><span class="menu">Viimane uuendus: </span>
	  <input class="fields" name="update" type="text" value="<? 
		include("globals.php");
			echo timestamp2($line["lupdate"]); ?>" /></td>
	<td class="menu" width="35%">
	<? if($priv>=2) {?>
	<input class="button" type="submit" name="Submit" value="Salvesta">
	<? } ?>	</td>
	</tr>
</table>	  </td></tr><tr>
<? //................................................................................................................................. ?>
      <td width="100%" align="center" valign="top">
        
          <? include("krono_lisad.php"); ?>
		  
		  <? if ($line["veeb_pilt_url_s"]) {?>
		  <img src="<? echo urldecode($line["veeb_pilt_url_s"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" align="left" style="background-color: #CCCCCC" /><? } ?>
       <? if ($line["veeb_pilt_url_s"]) {?>
       <img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC" />       <? } ?></td>
</table>
</form>









