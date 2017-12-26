<?
	include("FCKeditor/fckeditor.php") ;
	include("tabel_class_iid.php");
	include("tabel_class_tid.php");
	$eh=$_GET["action"];
	$pid=$_GET["pid"];
	if($eh=="new"){
		$gpid=$_GET["gpid"];
		$tmp=mysql_query("INSERT INTO pacs (nimi_est,pid) VALUES (\"Nimetu\",1)");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$pid=$tmp["last_insert_id()"];
		echo "uus objekt: ",$pid;
		// ------------------------------------------------
	}
	if($eh=="save"  && $_POST["nimi_est"]){
		$valjad=array("nimi_est","nimi_rus", "nimi_eng", "kirjeldus_est","kirjeldus_rus", "kirjeldus_eng","text_est","text_rus", "text_eng","naita_veebis","toimumise_aeg","jarjest","tase_z");
		foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
		$query="UPDATE pacs SET ".implode(",",$rida)." WHERE id=".$pid;		}
//		echo $query;
		$result=mysql_query($query);
	}	
//	$query="SELECT ".implode(",",$valjad)." FROM pacs WHERE id=".$pid;
	$query="SELECT * FROM pacs WHERE id=".$pid;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?>
<link href="scat.css" rel="stylesheet" type="text/css" />
 <form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=pacs_disp&action=save&pid=".$pid; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
      <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="35%">Nimi EST*</td>
          <td width="65%" ><input name="nimi_est" type="text" class="fields" value="<? echo $line["nimi_est"]; ?>" size="45" >          </td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="35%">Millal toimub</td>
          <td width="65%" ><input name="toimumise_aeg" type="text" class="fields" value="<? echo $line["toimumise_aeg"]; ?>" size="45" >          </td>
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
					tabel2("pacs_uudis",$pid,$_SESSION["mysession"]["login"],1,1);
		?>		</td>
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
					lingid("pacs_lingid",$pid,$_SESSION["mysession"]["login"]);
		  ?>            </td>
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
	<? //} ?>	</td>
	</tr>
</table>		</td>
<? //................................................................................................................................. ?>
      <td width="250" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="2" height="10"><img src="image/spacer.gif" width="2" height="10"></td>
            <td colspan="2" class="menu"><div align="center">
              <input class="button" type="submit" name="Submit2" value="Salvesta" />
            </div></td>
          </tr>
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
        <? include("pacs_lisad.php"); ?>
<a href=<? echo urldecode($line["veeb_pilt_url_s"]); ?>  target=_blank><? if ($line["veeb_pilt_url"]) {?><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"></a> <? }?>     </td>
  </tr>
</table>
<table width="100%">
<tr><td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr > 
		<td background="image/sinine.gif"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
		    <td background="image/sinine.gif" class="menu" width="55%">Tulemused ...</td>
		<td width="65%" ></td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		<td ><? 
	$query_asi="SELECT * FROM pacs_exp WHERE oid1=".$pid." ORDER BY id";
//	echo $query_asi;
	$result_asi=mysql_query($query_asi);
	while($line_asi=mysql_fetch_array($result_asi))
	{
		$query_asi1="SELECT * FROM exp WHERE id=".$line_asi["oid2"]."";
//		echo $query_asi1;
		$result_asi1=mysql_query($query_asi1);
		$line_asi1=mysql_fetch_array($result_asi1); 
		
		tabel4("exp".$line_asi1["id"]."_tulemused",$line_asi1["id"],$_SESSION["mysession"]["login"],$pid);
//		echo $line_asi1["nimi_est"];
	}
		
		
		
		
		
?></td>
	      </tr>
</table>
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
          <td width="2%"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="14%">Annotatsioon?</td>
          <td width="84%" ><textarea name="kirjeldus_est" cols="100" rows="5" class="fields"><? echo $line["kirjeldus_est"]; ?> </textarea>          </td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
       </tr>
         <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td align="center" colspan="3"><?
		 	if($line["liik"]==2) $ridasid=200; else $ridasid=600;
$oFCKeditor = new FCKeditor('text_est') ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->Value = $line["text_est"];
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = $ridasid ;
$oFCKeditor->Create() ;
	?></td>
          </tr>
        <tr background="image/sinine.gif"> 
          <td height="2" colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
</table>
</td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
		<td class="menu" width="35%">Isikud</td>
		<td width="65%" ><?
					tabel2("pacs_isik",$pid,$_SESSION["mysession"]["login"],1,1);
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
	        <td class="menu" width="35%">Osalevad koolid</td>
	<td width="65%" ><?
				tabel2("kool_pacs",$pid,$_SESSION["mysession"]["login"],2,1);
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
	        <td class="menu" width="35%">Tehnoloogiad</td>
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
	        <td class="menu" width="35%">Eksperimendid/Demod</td>
	<td width="65%" ><?
				tabel2("pacs_exp",$pid,$_SESSION["mysession"]["login"],1,1);
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
				tabel2("pacs_nupula",$pid,$_SESSION["mysession"]["login"],1,1);
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
		tabel("pacs_pildid",$pid,$_SESSION["mysession"]["login"], 1);								
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
			tabel("pacs_docs",$pid,$_SESSION["mysession"]["login"], 0);								
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
		    <td background="image/sinine.gif" class="menu" width="35%">Seosed teiste teadusteemadega...</td>
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
				tabel2("pacs_pacs",$pid,$_SESSION["mysession"]["login"],2,1);
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
				tabel2("pacs_pacs",$pid,$_SESSION["mysession"]["login"],1,1);
	?>
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
	<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
</table>

</td></tr>
</table>
</form>









