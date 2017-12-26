<?
	include("FCKeditor/fckeditor.php") ;
	$eh=$_GET["action"];
	if($eh=="new"){
		$tmp=mysql_query("INSERT INTO etendus (nimi_est, naita_veebis) VALUES (\"Nimetu\",\"0\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$etendusid=$tmp["last_insert_id()"];
//		echo $tootid;
		// ------------------------------------------------
	} elseif($eh=="save"){
		$valjad=array("nimi_est","nimi_eng","nimi_rus","naita_veebis", "veeb_pilt_url" , "veeb_pilt_url_s" ,"kirjeldus_est","kirjeldus_eng","kirjeldus_rus", "email_from", "email_replyto", "email_pealik");
		foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
		}
	if($eh=="save"){
		$query="UPDATE etendus SET ".implode(",",$rida)." WHERE id=".$etendusid;		}
//		echo $query;
		$result=mysql_query($query);
	}	
	
	$query="SELECT * FROM etendus WHERE id=".$etendusid;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?>
<link href="scat.css" rel="stylesheet" type="text/css" />
 <br>

<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=etendus_disp&action=save&etendusid=".$etendusid; ?>">
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
						  <td width="2%"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
							<td class="menu" width="8%">Kirjeldus</td>
					      <td width="90%" ><div align="center"><br />	
				            <?
$oFCKeditor = new FCKeditor('kirjeldus_est') ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->Value = $line["kirjeldus_est"];;
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '500' ;
$oFCKeditor->Create() ;
	?>
				          </div></td>
						</tr>
						<tr background="image/sinine.gif"> 
						  <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
					   </tr>
				 
						<tr background="image/sinine.gif"> 
						  <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
						</tr>
				</table>
</tr></td></table>

  <table width="100%">
    <tr>
      <td width="50%" valign="top"> 
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		    <td width="4%" background="image/sinine.gif"></td>
		    <td background="image/sinine.gif" class="menu" width="96%">Eksponaadid/Demod/T&ouml;&ouml;toad:</td>
  	</tr>
</table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr background="image/sinine.gif"> 
				<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
			</tr>
			<tr>
            	<td width="65%" ><?
											include("tabel_class_iid.php");
						tabel2("etendus_exp",$etendusid,$_SESSION["mysession"]["login"],1,1);
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
					<td width="65%" ><div align="center"><a href="index.php?page=etendus_kirjeldus&etendusid=<? echo $etendusid; ?>&aasta=<? echo $aastakene;?>" class="menu">N&auml;ita vahendeid jms </a></div></td>
					</tr>
				</table>
				
	</td>
    	
      <td width="50%" valign="top">
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
            <td background="image/sinine.gif"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td background="image/sinine.gif" class="menu" width="35%">P&auml;devad 
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

									tabel2("etendus_isik",$etendusid,$_SESSION["mysession"]["login"],1,1);
						?></td>
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
						tabel("etendus_pildid",$etendusid,$_SESSION["mysession"]["login"], 1);
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
						  <td width="65%" ><?
							tabel("etendus_doclist",$etendusid,$_SESSION["mysession"]["login"], 0);								
							?></td>
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
									lingid("etendus_lingid",$etendusid,$_SESSION["mysession"]["login"]);
						  ?>
							</td>
						  </tr>
				</table>
        <? include("etendus_lisad.php"); ?>
		<a href=<? echo urldecode($line["veeb_pilt_url_s"]); ?>  target=_blank><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" width="240" align="right" style="background-color: #CCCCCC"></a>
      </td>
  </tr>
</table>
<table width="100%">
<tr><td>
</form>









