<?
	include("FCKeditor/fckeditor.php") ;
	include("globals.php") ;
	$eh=$_GET["action"];
	if($eh=="new"){
		$tmp=mysql_query("INSERT INTO chapter (nimi_est, naita_veebis) VALUES (\"Nimetu\",\"0\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$chid=$tmp["last_insert_id()"];
//		echo $tootid;
		// ------------------------------------------------
	} elseif($eh=="save"){
		$valjad=array("nimi_est","algus_est","lopp_est","naita_veebis", "veeb_pilt_url" , "veeb_pilt_url_s");
		foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
		}
	if($eh=="save"){
		$query="UPDATE chapter SET ".implode(",",$rida)." WHERE id=".$chid;		}
//		echo $query;


// salvestame seose andmed

	$result_tykid = sql_rida($userid,"SELECT * FROM chapter_exp WHERE oid1=".$chid."",1,0);
	while($line_tykid=mysql_fetch_array($result_tykid))
	{
		$result_update = sql_rida($userid,"UPDATE `fyysika_ee`.`chapter_exp` SET `order1` = '".$_POST["order1_".$line_tykid["id"]]."',`height1` = '".$_POST["height1_".$line_tykid["id"]]."',`width1` = '".$_POST["width1_".$line_tykid["id"]]."',`title1` = '".$_POST["title1_".$line_tykid["id"]]."',
`sisse1` = '".$_POST["sisse1_".$line_tykid["id"]]."',
`sisu1` = '".$_POST["sisu1_".$line_tykid["id"]]."',
`naita_veebis1` = '".$_POST["naita_veebis1_".$line_tykid["id"]]."' WHERE `chapter_exp`.`id` =".$line_tykid["id"]."",1,0);
	}
		$result=mysql_query($query);
	}	
	
	$query="SELECT * FROM chapter WHERE id=".$chid;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?>
<link href="scat.css" rel="stylesheet" type="text/css" />
 <br>

<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=chapter_disp&action=save&chid=".$chid; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
      <td width="60%" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr background="image/sinine.gif"> 
						  <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
						</tr>
						<tr> 
						  <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
						  <td class="menu" width="35%">Nimi EST</td>
						  <td width="16%" ><input name="nimi_est" type="text" class="fields" value="<? echo $line["nimi_est"]; ?>" size="80" > 
						  </td>
						  <td width="16%" ><input class="button" type="submit" name="Submit" value="Salvesta"></td>
						  <td width="33%" align="center" class="button2" ><a href="http://www.fyysika.ee/omad/chapter_naita.php?chid=<? echo $chid;?>" target="_blank">VAATA</a></td>
						</tr>
				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr background="image/sinine.gif"> 
						  <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
					   </tr>
						<tr> 
						  <td width="10%" valign="top" class="menu">Sissejuhatus</td>
						  <td colspan="4" valign="top" ><div align="center">
				            <?
$oFCKeditor = new FCKeditor('algus_est') ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->Value = $line["algus_est"];;
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '200' ;
$oFCKeditor->ToolbarSet = 'Basic';
$oFCKeditor->Create() ;
	?>
				          </div></td>
						</tr>
                        
                    <? 
					
$result_tykid = sql_rida($userid,"SELECT * FROM chapter_exp WHERE oid1=".$chid." ORDER BY order1",1,0);
	while($line_tykid=mysql_fetch_array($result_tykid))
	{
		$result_tykk = sql_val($userid,"SELECT * FROM exp WHERE id=".$line_tykid["oid2"]."",1,0);
					
					
					?><tr>
						 
						  <td valign="top"><span class="smallbody"><input name="title1_<? echo $line_tykid["id"]; ?>" type="text"  class="menu" value="<? echo $line_tykid["title1"]; ?>" size="10" ><br /><input name="order1_<? echo $line_tykid["id"]; ?>" type="text"  class="menu_punane" value="<? echo $line_tykid["order1"]; ?>" size="5" >
						  </span></td>
						  <td colspan="4" ><div align="center" class="smallbody"><?
$oFCKeditor = new FCKeditor("sisse1_".$line_tykid["id"]);
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->Value = $line_tykid["sisse1"];
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '100' ;
$oFCKeditor->ToolbarSet = 'Basic';
$oFCKeditor->Create() ;
	?>
					      </div></td>
						</tr><tr>
						 
						  <td rowspan="4"><span class="smallbody"></span>					      <a href="index.php?page=exp_disp&expid=<? echo $line_tykid["oid2"]; ?>&pw=<? echo $pw; ?>" class="smallbody"><u><? echo $result_tykk["nimi_est"];?></u>
      </a></td>
						  <td colspan="3" valign="top" class="smallbody" ><? echo $result_tykk["kirjeldus_est"];?>
				          <br /></td>
						  <td width="10%" rowspan="4" valign="top" ><? if($result_tykk["veeb_pilt_url"]){?><a href=<? echo urldecode($result_tykk["veeb_pilt_url_s"]); ?>  target=_blank><img src="<? echo urldecode($result_tykk["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"></a><? }?></td>
						</tr>
						<tr>
						  <td width="73%" rowspan="3" valign="top" class="smallbody" >* Nupula:
                            <? $result_nupud = sql_rida($userid,"SELECT * FROM exp_nupula WHERE oid1=".$line_tykid["oid2"]."",1,0);
	while($line_nupud=mysql_fetch_array($result_nupud))
	{
		$result_nupp = sql_val($userid,"SELECT * FROM nupula WHERE id=".$line_nupud["oid2"]."",1,0); ?>
                            <a href="index.php?page=nupula_disp&nid=<? echo $line_nupud["oid2"]; ?>"><? echo $result_nupp["nimi_est"];?></a>
                            <input <?php
			// kontrollime, kas on päevavideode nimekirjas
				   $var=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM exp_loeng WHERE pid=".$expid));
			 if ($var['0']>0)
			 	{
			 		echo "checked=","checked";
			  	}
				?> name="pane_paevaloeng" type="checkbox" value="1" />
                            <?	}?>
                            <br />
* Exp: <? $result_nupud = sql_rida($userid,"SELECT * FROM exp_exp WHERE oid1=".$line_tykid["oid2"]."",1,0);
	while($line_nupud=mysql_fetch_array($result_nupud))
	{
		$result_nupp = sql_val($userid,"SELECT * FROM exp WHERE id=".$line_nupud["oid2"]."",1,0); ?>
                            <a href="index.php?page=exp_disp&expid=<? echo $line_nupud["oid2"]; ?>"><? echo $result_nupp["nimi_est"];?></a>
                            <input <?php
			// kontrollime, kas on päevavideode nimekirjas
				   $var=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM exp_loeng WHERE pid=".$expid));
			 if ($var['0']>0)
			 	{
			 		echo "checked=","checked";
			  	}
				?> name="pane_paevaloeng" type="checkbox" value="1" />
                            <?	}?><br />
* Teadusuudis: <? $result_nupud = sql_rida($userid,"SELECT * FROM exp_nupula WHERE oid1=".$line_tykid["oid2"]."",1,0);
	while($line_nupud=mysql_fetch_array($result_nupud))
	{
		$result_nupp = sql_val($userid,"SELECT * FROM nupula WHERE id=".$line_nupud["oid2"]."",1,0); ?>
                            <a href="index.php?page=nupula_disp&nid=<? echo $line_nupud["oid2"]; ?>"><? echo $result_nupp["nimi_est"];?></a>
                            <input <?php
			// kontrollime, kas on päevavideode nimekirjas
				   $var=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM exp_loeng WHERE pid=".$expid));
			 if ($var['0']>0)
			 	{
			 		echo "checked=","checked";
			  	}
				?> name="pane_paevaloeng" type="checkbox" value="1" />
                            <?	}?><br />
* Ajalugu: <? $result_nupud = sql_rida($userid,"SELECT * FROM exp_nupula WHERE oid1=".$line_tykid["oid2"]."",1,0);
	while($line_nupud=mysql_fetch_array($result_nupud))
	{
		$result_nupp = sql_val($userid,"SELECT * FROM nupula WHERE id=".$line_nupud["oid2"]."",1,0); ?>
                            <a href="index.php?page=nupula_disp&nid=<? echo $line_nupud["oid2"]; ?>"><? echo $result_nupp["nimi_est"];?></a>
                            <input <?php
			// kontrollime, kas on päevavideode nimekirjas
				   $var=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM exp_loeng WHERE pid=".$expid));
			 if ($var['0']>0)
			 	{
			 		echo "checked=","checked";
			  	}
				?> name="pane_paevaloeng" type="checkbox" value="1" />
                            <?	}?></td>
						  <td width="3%" height="36" align="center" valign="middle" class="smallbody" >W:
						    
					      <br /></td>
						  <td width="4%" align="center" valign="middle" class="smallbody" ><input name="width1_<? echo $line_tykid["id"]; ?>" type="text"  class="menu_punane" value="<? echo $line_tykid["width1"]; ?>" size="5" /></td>
                  </tr>
						<tr>
						  <td align="center" valign="middle" class="smallbody" >H:</td>
						  <td width="4%" align="center" valign="middle" class="smallbody" ><input name="height1_<? echo $line_tykid["id"]; ?>" type="text"  class="menu_punane" value="<? echo $line_tykid["height1"]; ?>" size="5" /></td>
		          </tr>
						<tr>
						  <td align="center" valign="middle" class="smallbody" >Pilt k&uuml;ljele</td>
						  <td width="4%" align="center" valign="middle" class="smallbody" ><input <?php
			// kontrollime, kas on päevavideode nimekirjas
				   $var=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM exp_loeng WHERE pid=".$expid));
			 if ($var['0']>0)
			 	{
			 		echo "checked=","checked";
			  	}
				?> name="pane_paevaloeng" type="checkbox" value="1" /></td>
		          </tr>
						<tr>
						 
						  <td valign="top"><span class="smallbody">Text/layout<br />
						  </span></td>
						  <td colspan="4" ><div align="center" class="smallbody"><?
$oFCKeditor = new FCKeditor("sisu1_".$line_tykid["id"]) ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->Value = $line_tykid["sisu1"];
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '150' ;
$oFCKeditor->ToolbarSet = 'Basic';
$oFCKeditor->Create() ;
	?>
					      </div></td>
						</tr><? 		
						
						
	}
?>
						<tr> 
						  <td valign="top" class="menu">Kokkuv&otilde;te</td>
						  <td colspan="4" valign="top" ><div align="center">	
				            <?
$oFCKeditor = new FCKeditor('lopp_est') ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->Value = $line["lopp_est"];
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '200' ;
$oFCKeditor->ToolbarSet = 'Basic';
$oFCKeditor->Create() ;
	?>
				          </div></td>
						</tr>
						<tr background="image/sinine.gif"> 
						  <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
					   </tr>
				 
						<tr background="image/sinine.gif"> 
						  <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
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
						tabel2("chapter_exp",$chid,$_SESSION["mysession"]["login"],1,1);
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
					<td width="65%" ></td>
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

									tabel2("chapter_isik",$chid,$_SESSION["mysession"]["login"],1,1);
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
						tabel("chapter_pildid",$chid,$_SESSION["mysession"]["login"], 1);
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
							tabel("chapter_doclist",$chid,$_SESSION["mysession"]["login"], 0);								
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
									lingid("chapter_lingid",$chid,$_SESSION["mysession"]["login"]);
						  ?>
							</td>
						  </tr>
				</table>
        <? include("chapter_lisad.php"); ?>
		<? if($line["veeb_pilt_url"]){?><a href=<? echo urldecode($line["veeb_pilt_url_s"]); ?>  target=_blank><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"></a><? }?>
      </td>
  </tr>
</table>
<table width="100%">
<tr><td>
</form>









