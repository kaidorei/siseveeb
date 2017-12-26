<?
		include("FCKeditor/fckeditor.php") ;
	$uid=$_GET["uid"];
	$eh=$_GET["action"];
	if($eh=="new"){
		$gpid=$_GET["gpid"];
		$tmp=mysql_query("INSERT INTO uudis (title,show_page) VALUES (\"Nimetu\",\"0\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$uid=$tmp["last_insert_id()"];
//		echo $pid;
		// ------------------------------------------------
	} elseif($eh=="save"  && $_POST["title"]){
		$valjad=array("title","body", "show_page", "liik", "sisu","urltitle", "eesti_asi", "ext_link");
		foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
		}
	if($eh=="save"  && $_POST["title"]){
		$query="UPDATE uudis SET ".implode(",",$rida)." WHERE id=".$uid;		}
		$result=mysql_query($query);
	}	
	$valjad=array("title, body");
//	$query="SELECT ".implode(",",$valjad)." FROM pacs WHERE id=".$pid;
	$query="SELECT * FROM uudis WHERE id=".$uid;
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

<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=uudis_disp&action=save&uid=".$uid; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
      <td width="65%" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="2%"><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="21%">Pealkiri*</td>
          <td width="68%" ><div align="center">
            <input name="title" type="text" class="fields" value="<? echo $line["title"]; ?>" size="105" >          
          </div></td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="9" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="2%"><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="25%">Liik<br /> 
            (<span class="style1">tekst-1, pilt-2, lugu-3 </span>) :</td>
          <td width="20%" >
            
              <div align="left">
                <input name="liik" type="text" class="fields" value="<? echo $line["liik"]; ?>" size="2" >
            </div></td>
          <td width="27%" class="menu" >Sisu<span class="style1"><br /> 
            (Teadus-1, Tehnol-2)</span>:</td>
          <td width="10%" >                <input name="sisu" type="text" class="fields" value="<? echo $line["sisu"]; ?>" size="2" ></td>
          <td width="1%"  class="menu">&nbsp;</td>
          <td class="menu" width="12%" >N&auml;ita&nbsp;veebis<br />
            (<span class="style1">Jah-1, Ei-0</span>):            </td>
          <td width="3%" align="right" ><input class="fields" name="show_page" type="text" value="<? echo $line["show_page"]; ?>" size="2" /></td>
        </tr>
        <tr background="images/sinine.gif"> 
          <td colspan="9" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="2%"><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="25%"><div align="left">aeg <br />
            (<span class="style1">yyyy-dd-kk</span>):</div></td>
          <td width="20%" >
            
              <div align="left">
                <input class="fields" name="urltitle" type="text" value="<? echo $line["urltitle"]; ?>" size="20" />
            </div></td>
          <td width="27%" class="menu" >Ext_link: </td>
          <td width="10%" ><input class="fields" name="ext_link" type="text" value="<? echo $line["ext_link"]; ?>" size="20" /></td>
          <td width="1%"  class="menu">&nbsp;</td>
          <td class="menu" width="12%" >Eesti Asi?<br /> 
            (<span class="style1">Jah-1, Ei-0</span>):</td>
          <td width="3%" align="right" ><input class="fields" name="eesti_asi" type="text" value="<? echo $line["eesti_asi"]; ?>" size="2" /></td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="2%"><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
          <td width="3%" valign="top" class="menu">Uudis</td>
          <td width="95%" >	<?
		 	if($line["liik"]==2) $ridasid=200; else $ridasid=600;
$oFCKeditor = new FCKeditor('body') ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->Value = $line["body"];
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = $ridasid ;
$oFCKeditor->Create() ;
	?>          </td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr background="images/sinine.gif"> 
		<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	</tr>
	<tr> 
		<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
		<td class="menu" width="35%">... fotod/pildid</td>
		<td width="65%" >
		<?
		include("tabel_class_oid.php");
	//	echo $tootid;
		tabel("uudis_pildid",$uid,$_SESSION["mysession"]["login"], 1);								
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
            <td width="65%" >
            <?
			tabel("uudis_doc",$uid,$_SESSION["mysession"]["login"], 0);								
			?>          </td>
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
	<td class="menu" width="35%">... ainepuu teemad </td>
	<td width="65%" ><?
		include("tabel_class_iid.php");
				tabel2("uudis_aine",$uid,$_SESSION["mysession"]["login"],1,1);
	?>	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="images/sinine.gif"> 
		<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	</tr>
  	<tr> 
		<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
		<td class="menu" width="35%">... teadusteemad </td>
		<td width="65%" ><?
					tabel2("pacs_uudis",$uid,$_SESSION["mysession"]["login"],2,1);
		?>		</td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="images/sinine.gif"> 
	<td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
	<td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
	        <td class="menu" width="35%">... asutused </td>
	        <td width="65%" ><?
				tabel2("firma_uudis",$uid,$_SESSION["mysession"]["login"],2,1);
	?>	</td>
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
				tabel2("exp_uudis",$uid,$_SESSION["mysession"]["login"],2,1);
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
	        <td class="menu" width="35%">... isikud </td>
	        <td width="65%" ><?
				tabel2("isik_uudis",$uid,$_SESSION["mysession"]["login"],2,1);
	?>	</td>
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
					lingid("uudis_lingid",$uid,$_SESSION["mysession"]["login"]);
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
        
          <? include("uudis_lisad.php"); ?>
		  
		  <? if ($line["veeb_pilt_url_s"]) {?>
		  <img src="<? echo urldecode($line["veeb_pilt_url_s"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" align="left" style="background-color: #CCCCCC" /><? } ?>
       <? if ($line["veeb_pilt_url_s"]) {?>
       <img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC" />       <? } ?></td>
</table>
</form>









