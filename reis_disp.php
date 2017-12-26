<?

	$eh=$_GET["action"];

	$veeb=$_GET["veeb"];

	$reisid=$_GET["reisid"];

	$aastakene=$_GET["aasta"];

	$nadal=$_GET["nadal"];

	$algus=$_GET["algus"];

	$lopp=$_GET["lopp"];

	$imgdir="../pildid/Image/Teadusbuss/";

	include("tabel_class_iid.php");

	include("globals.php");

	include("FCKeditor/fckeditor.php") ;

//	echo "halloo";

//*******************************************

function list_dir($dirname)

{

	static $result_array=array();  

	$handle=opendir($dirname);

	while ($file = readdir($handle))

	{

		if($file=='.'||$file=='..')

			continue;

		if(is_dir($dirname.$file))

//			list_dir($dirname.$file.'\\'); 

//		else

			$result_array[]=$file;

	}	

	closedir($handle);

	return $result_array;



}

//*******************************************





	if($eh=="new"){

		$gpid=$_GET["gpid"];

			

		switch($aastakene){

		case "2005": $hooaeg_nmbr = 1; break;

		case "2006": $hooaeg_nmbr = 2; break;

		case "2007": $hooaeg_nmbr = 3; break;

		case "2008": $hooaeg_nmbr = 4; break;

		case "2009": $hooaeg_nmbr = 5; break;

		case "2010": $hooaeg_nmbr = 6; break;

		case "2011": $hooaeg_nmbr = 7; break;

		case "2012": $hooaeg_nmbr = 8; break;

		case "2013": $hooaeg_nmbr = 9; break;

		case "2014": $hooaeg_nmbr = 10; break;

		case "2015": $hooaeg_nmbr = 11; break;
		case "2016": $hooaeg_nmbr = 12; break;
		case "2017": $hooaeg_nmbr = 13; break;

		default: $hooaeg_nmbr = 13; break;

		}

		$query_new = "INSERT INTO reis (nimi, hooaeg_nmbr, nadal_nmbr, algus, lopp) VALUES (\"Nimetu\",\"".$hooaeg_nmbr."\",\"".$nadal."\",\"".$algus."\",\"".$lopp."\")";

		//echo $query_new;

		$tmp=mysql_query($query_new);

		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

		$reisid=$tmp["last_insert_id()"];

		//echo "</br>Uue reisi id= ",$reisid;

		// ------------------------------------------------

	} elseif($eh=="save"  && $_POST["nimi"]){

		

		$valjad=array("nimi","algus","lopp", "reg_lopp", "reisikiri","juhtus","hooaeg_nmbr", "kyl_arv", "et_arv","nadal_nmbr", "naita_veeb", "pealik","rahad","tyyp", "link", "on_teade",  "on_kaart", "galerii", "sisu", "toend");

		

		if ($_POST["tyyp"]==3) //õpikodade valik

		{

			$valjad=array("nimi","algus","lopp", "reg_lopp", "reisikiri","juhtus","hooaeg_nmbr", "kyl_arv", "et_arv","nadal_nmbr", "naita_veeb", "pealik","rahad","tyyp", "link", "on_teade",  "on_kaart", "galerii", "sisu","id_m","id_m_context","id_m_item_min","id_m_item_max", "toend");

		}

		foreach($valjad as $var){

			$rida[$var]=$var."='".$_POST[$var]."'";

			}

//		$query="UPDATE reis SET ".implode(",",$rida)." WHERE id=".$reisid;	

		sql_rida($login_id, "UPDATE reis SET ".implode(",",$rida)." WHERE id=".$reisid, 1, 0);

		

	// kui chekbox on kontrollitud, muudetakse pildikataloogi nimi vastavaks reisi toimumise ajale ja nimele

	if ($_POST["setpath"]==1)

	{	

		$dirname=sprintf("%s-%s",$_POST["algus"],$reisid);

		$query="UPDATE reis SET galerii='".$dirname."' WHERE id=".$reisid." LIMIT 1";

		echo $query;

		$result=rename("/export/serv/fyysika.ee/pildid/Image/Teadusbuss/".$_POST["galerii"]."/", "/export/serv/fyysika.ee/pildid/Image/Teadusbuss/".$dirname);

		echo "/export/serv/fyysika.ee/pildid/Image/Teadusbuss/".$dirname."/";

		$result=mysql_query($query);

	}

	}	



    $query="SELECT * FROM reis WHERE id=".$reisid;

//	echo $query;

    $result=mysql_query($query);

	$line=mysql_fetch_array($result); 

 ?>

<style type="text/css">

<!--

.style1 {color: #FF0000}

.style2 {color: #000000}

.style4 {color: #FF0000; font-weight: bold; }

-->

</style>

 

<link href="scat.css" rel="stylesheet" type="text/css" />

<br>

<form name="naitus" method="post" action="<? echo $PHP_SELF."?page=reis_disp&action=save&reisid=".$reisid."&aasta=".$aastakene; ?>">

<table width="100%" border="0" cellpadding="0" cellspacing="2">

  <tr>

      <td width="65%" valign="top">



<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif"> 

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Nimi*</td>

            <td width="65%" ><input name="nimi" type="text" class="fields" value="<? echo $line["nimi"]; ?>" size="45" > 

          </td>

        </tr>

        <tr background="image/sinine.gif"> 

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td width="35%" valign="top" class="style4">KAVA/KAVAD</td>

            <td width="65%" >              <?

				tabel2("etendus_reis",$reisid,$_SESSION["mysession"]["login"],2,1,NULL,NULL);

	?>

</td>

        </tr>

        <tr background="image/sinine.gif"> 

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Reisi PEALIK</td>

          <td width="65%" >             <? 

			$query2="SELECT id,eesnimi, perenimi FROM isik WHERE in_buss=1 ORDER BY eesnimi;";

			$result2=mysql_query($query2);

			echo "<select  class=\"fields\" name=\"pealik\">";

				while($var=mysql_fetch_array($result2)){

					if($var["id"]==$line["pealik"]) { $sel="selected"; } else { $sel="";}

						echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["eesnimi"]." ".$var["perenimi"]."</option>"; 

				}

					echo "</select>";

		  ?>

 

          </td>

        </tr>

</table>



        <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif"> 

            <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

            <td width="4%"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="37%">N&auml;dal (<font color="#FF0000">vajalik!</font>)</td>

            <td width="5%" ><span class="menu">

              <input name="nadal_nmbr" type="text" class="fields" value="<? echo $line["nadal_nmbr"]; ?>" size="5" />

            </span></td>

            <td width="47%" class="menu" ><img src="image/spacer.gif" width="10" height="10">Hooaeg (2016=12) </td>

            <td width="7%" ><input name="hooaeg_nmbr" type="text" class="fields" value="<? echo $line["hooaeg_nmbr"]; ?>" size="5" ></td>

          </tr>

        </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif"> 

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Algus</td>

            <td width="65%" > <input name="algus" type="text" class="fields" value="<? echo $line["algus"]; ?>" size="45" ></td>

        </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif"> 

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">L&otilde;pp</td>

          <td width="65%" > <input name="lopp" type="text" class="fields" value="<? echo $line["lopp"]; ?>" size="45" > 

          </td>

        </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif"> 

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Etenduste arv</td>

          <td width="65%" > <input name="et_arv" type="text" class="fields" value="<? echo $line["et_arv"]; ?>" size="45" > 

          </td>

        </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif"> 

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Publiku arv</td>

          <td width="65%" > <input name="kyl_arv" type="text" class="fields" value="<? echo $line["kyl_arv"]; ?>" size="45" > 

          </td>

        </tr>

</table>





<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif"> 

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Reisi kirjeldus omadele <span class="style1"><br />

            ja mida on kokku lepitud </span></td>

            <td width="65%" ><textarea name="reisikiri" cols="45" rows="8" class="fields"><? echo $line["reisikiri"]; ?> </textarea></td>

        </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif"> 

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Avalik reisikiri/annotatsioon</td>

            <td width="65%" ><textarea name="juhtus" cols="45" rows="8" class="fields"><? echo $line["juhtus"]; ?> </textarea>

          </td>

        </tr>

</table>



        <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif"> 

            <td width="100%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

        </table>



<? include("tabel_class_oid.php");?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif"> 

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Tekstid, dokumendid (failide nimed &auml;rgu 

              sisaldagu t&uuml;hikuid)</td>

          <td width="65%" >

            <? tabel("reis_docs",$reisid,$_SESSION["mysession"]["login"], 0,"");?>

          </td>

        </tr>

</table>





<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif"> 

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Fotod/Pildid</td>



          <td width="65%" >



            <? if($veeb == "tee") // kui parameeter veeb on määratud, pannakse vastav parameeter tabelis 2-ks ja konverteeritakse pildid

				tabel("reis_pildid",$reisid,$_SESSION["mysession"]["login"], 2);

				else

				tabel("reis_pildid",$reisid,$_SESSION["mysession"]["login"], 1,"");

?>

          </td>

        </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif"> 

          <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          <td width="4%"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="33%"><? if($line["galerii"]) {?>

              <a href="galerii.php?domain=reis&id=<? echo $reisid;?>" target="_blank">

              <? } ?>

              Galerii

              <? {?>

              </a>

            <? }?> <? if($line["galerii"]) {?>

              <a href="galerii_pub.php?domain=reis&id=<? echo $reisid;?>" target="_blank">

              <? } ?>pub<? {?>

              </a>

            <? }?></td>



            <td width="55%" >

			<SELECT class="fields" name="galerii">

            <?

	print "<OPTION value='' ".$sel.">pole pilte</OPTION>";

	$lst=list_dir($imgdir);

	foreach($lst as $img){

		if($line["galerii"]==$img) { $sel="selected";} else { $sel="";}

		print "<OPTION value='$img' ".$sel.">".$img."</OPTION>";

//		echo $img;

	}



 ?>

          </SELECT>		<? //echo $gal,"kaid", $line["algus"]; ?></td>

            <td class="fields" width="8%" align="right" >Set<input type="checkbox" name="setpath" value="1" /></td>

			<!--siin peaks olema võimalus, et vajutad ning kataloogi nimi muudetakse ära reisi nimeks koos sobilike liidendustega ning muudetakse ka vastav andmebaasi kirje ja lehekülg loetakse uuesti üles-->

        </tr>

              <? if($line["galerii"]) {?>

        <tr> 

          <td width="4%"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="33%">&nbsp;</td>



            <td width="55%" ><span class="menu">

              <a href="galerii_thumbs.php?id=<? echo $reisid;?>&domain=reis&count=-1"  target="_blank">

              tee pisipildid

              </a>

             </span></td>

            <td class="fields" width="8%" align="right" >&nbsp;</td>

			<!--siin peaks olema võimalus, et vajutad ning kataloogi nimi muudetakse ära reisi nimeks koos sobilike liidendustega ning muudetakse ka vastav andmebaasi kirje ja lehekülg loetakse uuesti üles-->

        </tr>

             <? }?>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif"> 

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

          	<td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

          	<td class="menu" width="35%"> 

              <input class="button2" type="submit" name="Submit" value="Salvesta">

            </td>

            <td width="65%" bordercolor="#CCCCCC" > <div align="left"><a class="menu" href="index.php?page=reis_kirjeldus&reisid=<? echo $reisid; ?>&aasta=<? echo $aastakene;?>">Koosta 

                reisikirjeldus</a></div></td>

        </tr>

       <tr> 

          <td colspan="3"><? 

		 	$ridasid=250;

$oFCKeditor = new FCKeditor('toend') ;

$oFCKeditor->BasePath = 'FCKeditor/';

$oFCKeditor->Value = $line["toend"];

$oFCKeditor->Width  = '100%' ;

$oFCKeditor->Height = $ridasid ;

$oFCKeditor->ToolbarSet = 'Basic' ;

$oFCKeditor->Create() ;

	?>          </td>

          </tr>

       <tr>

         <td colspan="3" align="right"><input type="button" name="suva2" class="button" value="Loo t&otilde;endid" onclick="window.open('addvalue_toendid.php?reisid=<? echo $reisid;?>','File_upload','toolbar=0,width=660,height=580,status=yes');" /></td>

       </tr>

</table> 

</td>



<td  valign="top"> 

 <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif"> 

            <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td colspan="2" align="center" class="menu"><input class="button2" type="submit" name="Submit" value="Salvesta"></td>

          </tr>

          <tr> 

             <td class="menu" width="70%">N&auml;ita veebis (0 - ei, 1 - jah) </td>

             <td width="30%" > <input name="naita_veeb" type="text" class="fields_left" value="<? echo $line["naita_veeb"]; ?>" size="5" >            </td>

          </tr>

         <tr background="image/sinine.gif"> 

            <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

             

            <td class="menu" width="70%">Makstud? (0 - ei, 1 - ok, kui palju) </td>

            <td  > <input name="rahad" type="text" class="fields_left" value="<? echo $line["rahad"]; ?>" size="5" >            </td>

          </tr>

         <tr background="image/sinine.gif"> 

            <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

             

            <td class="menu" width="70%">On teade (0 - ei, 1 - jah) </td>

            <td  ><input name="on_teade" type="text" class="fields_left" value="<? echo $line["on_teade"]; ?>" size="5" /></td>

          </tr>

         <tr background="image/sinine.gif"> 

            <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

             

            <td class="menu" width="70%">N&auml;ita veebis kaarti (0 - ei, 1 - jah) </td>

            <td  ><input name="on_kaart" type="text" class="fields_left" value="<? echo $line["on_kaart"]; ?>" size="5" /></td>

          </tr>

 

        <tr background="image/sinine.gif"> 

            <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

             

            <td colspan="2" class="menu">

              <select name="tyyp" id="select" class="fields_left">

              <option value="1" <? if($line["tyyp"]==1) { echo "selected"; }?>>Teadusbussi reis</option>

             <option value="2" <? if($line["tyyp"]==2) { echo "selected"; }?>>Koolitus</option>

             <option value="3" <? if($line["tyyp"]==3) { echo "selected"; }?>>Õpikojad</option>

             <option value="4" <? if($line["tyyp"]==4) { echo "selected"; }?>>Muu</option>

              </select></td>

          </tr>         <tr background="image/sinine.gif"> 

            <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">



         <tr background="image/sinine.gif"> 

            <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

             

            <td width="35%" class="menu">V&auml;lislink<span class="style1"><span class="style2"></span> </span></td>

            <td width="65%" align="right"  ><input name="link" type="text" class="fields_left" value="<? echo $line["link"]; ?>" size="20" /></td>

          </tr>

          

    <? if ($line["tyyp"]==3) { ?>



         <tr background="image/sinine.gif"> 

            <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

          <tr>

            <td width="35%" class="menu">Moodle ID</td>

            <td align="right"  ><input name="id_m" type="text" class="fields" value="<? echo $line["id_m"]; ?>" size="20" /></td>

          </tr>

          <tr>

            <td class="menu">Moodle c_id</td>

            <td align="right"  ><input name="id_m_context" type="text" class="fields" value="<? echo $line["id_m_context"]; ?>" size="20" /></td>

          </tr>

          <tr>

            <td class="menu">Moodle item_id_min</td>

            <td align="right"  ><input name="id_m_item_min" type="text" class="fields" value="<? echo $line["id_m_item_min"]; ?>" size="20" /></td>

          </tr>

          <tr>

            <td class="menu">Moodle item_id_max</td>

            <td align="right"  ><input name="id_m_item_max" type="text" class="fields" value="<? echo $line["id_m_item_max"]; ?>" size="20" /></td>

          </tr>

            <? } ?>



</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">



         <tr background="image/sinine.gif"> 

            <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

             

            <td width="35%" class="menu_punane">Reg. deadline</td>

            <td width="65%" align="right"  >&nbsp;</td>

          </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="image/sinine.gif"> 

		<td colspan="2"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td width="4%" background="image/sinine.gif"></td>

		    <td background="image/sinine.gif" class="menu" width="96%">K&uuml;lastatavad 

              koolid ...</td>

  	</tr>

</table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">

			<tr background="image/sinine.gif"> 

				<td background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

			</tr>

			<tr>

            	<td width="100%" ><?

//						include("textlog_naitus_class.php");

						

						tabel2("reis_kool",$reisid,$_SESSION["mysession"]["login"],1,1,NULL,NULL);

			?>

            </td>

          </tr>

	    </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="image/sinine.gif"> 

		    <td height="3" colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td width="4%" background="image/sinine.gif"></td>

		    <td background="image/sinine.gif" class="menu" width="96%">Teelised 

              ... (ehk siis esinejad/kaasa s&otilde;itjad)</td>

  	</tr>

</table>





        <table width="100%" border="0" cellspacing="0" cellpadding="0">

			<tr background="image/sinine.gif"> 

				<td background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

			</tr>

			<tr>

            	<td width="100%"><?

						tabel2("reis_isik",$reisid,$_SESSION["mysession"]["login"],1,1,NULL,NULL);

			?></td>

          </tr>

  	<tr background="image/sinine.gif"> 

		    <td height="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>

	</tr>

			<tr>

		    <td background="image/sinine.gif" class="menu"> &nbsp;&nbsp;&nbsp;&nbsp;<span class="style4">KORRALDAMISE FOORUM </span></td>

		  </tr>

			<tr>

			  <td><?

	include("textlog_class.php");

	$tmp=array("date","body");

	log2("reis_alog",(isset($_GET["foorum_alogopen"])?0:5),$reisid,$_SESSION["mysession"]["login"],implode(",",$tmp));	?>

		      <input name="reg_lopp" type="text" class="fields_left" value="<? echo $line["reg_lopp"]; ?>" size="20" /></td>

		  </tr>

			<tr>

			  <td align="right" ><?

			  

			  

// Teen pildi lahti ...			  

			  	$url_t="image/eesti_r".$reisid.".jpg";

				$url = "image/eesti_v.jpg"; // name/location of original image.

				

				$src_img = ImageCreateFromJPEG($url); // make 'connection' to image

				

				$quality = 100; //quality of the .jpg

				$src_width = imagesx($src_img); // width original image

				$src_height = imagesy($src_img); // height original image

				

				$dest_img = imagecreatetruecolor($src_width,$src_height); 

				imagecopyresampled($dest_img, $src_img, 0, 0, 0 ,0, $src_width, $src_height, $src_width, $src_height); 



				// allocate some solors

				$white    = imagecolorallocate($dest_img, 0xFF, 0xFF, 0xFF);

				$gray     = imagecolorallocate($dest_img, 0xC0, 0xC0, 0xC0);

				$darkgray = imagecolorallocate($dest_img, 0x90, 0x90, 0x90);

				$navy     = imagecolorallocate($dest_img, 0x00, 0x00, 0x80);

				$darknavy = imagecolorallocate($dest_img, 0x00, 0x00, 0x50);

				$red      = imagecolorallocate($dest_img, 0xFF, 0x00, 0x00);

				$darkred  = imagecolorallocate($dest_img, 0x90, 0x00, 0x00);

				

				

			$queryk="SELECT oid2 FROM reis_kool WHERE oid1=".$reisid;

			$resultk=mysql_query($queryk);

			while($linek=mysql_fetch_array($resultk))

			{

//				echo $linek["oid2"],"oa";

				$resultkoo=mysql_query("SELECT PK, LK FROM kool WHERE id=".$linek["oid2"]."");

				$linekoo=mysql_fetch_array($resultkoo);

//				echo $linekoo["PK"],"   ";

			  	$x=($linekoo["PK"]-373877)*($src_width/(745237-373877));

			  	$y=$src_height - ($linekoo["LK"]-6345722)*($src_height/(6648619-6345722));

//				echo $x," ",$y;

				imagefilledarc($dest_img, $x, $y, 10, 10, 0, 360, $red, IMG_ARC_PIE);

				imageellipse($dest_img, $x, $y, 10, 10, $white);

			}				  



			imagejpeg($dest_img, $url_t, $quality); 

			imagedestroy($src_img); 

			imagedestroy($dest_img);

			  

			  

			  

			   ?><a class="ekraan_link" href="http://www.regio.ee/?op=body&amp;id=24&amp;marker=|||symbol_circle_anim" target="_blank"><img src="<? echo $url_t;?>" /></a></td>

		  </tr>

			<tr>

			  <td class="ekraan_link" align="right" ><div align="left">Kaardil on k&uuml;lastatavad koolid t&auml;histatud punaste ringidena. Kui oled m&otilde;ne kooli lisanud, siis vajuta &quot;Refresh&quot;. </div></td>

		  </tr>

	    </table>





</td>

</tr>

</table>

<table width="100%">

<tr><td>

 <?

// include("reis_lisad.php"); ?>

</td></tr>

</table>

</form>

