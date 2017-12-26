<?

	include("FCKeditor/fckeditor.php") ;

	include("tabel_class_iid.php");

	include("tabel_class_oid.php");

	$eh=$_GET["action"];

	$etendusid=$_GET["etendusid"];

	

	if($eh=="new"){

		$tmp=mysql_query("INSERT INTO etendus (nimi_est, naita_veebis) VALUES (\"Nimetu\",\"0\")");

		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

		$etendusid=$tmp["last_insert_id()"];

//		echo $tootid;

		// ------------------------------------------------

	} elseif($eh=="save"){

		$valjad=array("nimi_est","nimi_eng","nimi_rus","naita_veebis", "veeb_pilt_url" , "veeb_pilt_url_s" ,"kirjeldus_est","email_from", "email_replyto","on_kutsed", "email_pealik", "video_player", "orig_URL", "video_url","sisu_est");

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





  

<table width="100%" border="0" cellpadding="5">

  <tr>

    <td width="6%" class="options">Nimi:      </td>

    <td width="70%" class="options"><input name="nimi_est" type="text" class="pealkiri" value="<? echo $line["nimi_est"]; ?>" size="65" /></td>

    <td width="7%" align="center" class="options">Kutsed:

      

</td>

    <td width="7%" align="center" class="options"><input name="on_kutsed" type="text" class="options" value="<? echo $line["on_kutsed"]; ?>" size="3" /></td>

    <td width="5%" align="center" class="options">Veebis:</td>

    <td width="5%" align="center" class="options"><input class="options" name="naita_veebis" type="text" value="<? echo $line["naita_veebis"]; ?>"  size="3"/></td>

    </tr>

  <tr>

    <td colspan="6" class="fields"><?

$oFCKeditor = new FCKeditor('kirjeldus_est') ;

$oFCKeditor->BasePath = 'FCKeditor/';

$oFCKeditor->Value = $line["kirjeldus_est"];;

$oFCKeditor->Width  = '100%' ;

$oFCKeditor->Height = '100' ;

$oFCKeditor->ToolbarSet = 'Basic';

$oFCKeditor->Create() ;

	

	



	?></td>

  </tr>

  <tr>

    <td colspan="2" align="center" valign="top"><?

$oFCKeditor = new FCKeditor('sisu_est') ;

$oFCKeditor->BasePath = 'FCKeditor/';

$oFCKeditor->Value = $line["sisu_est"];

$oFCKeditor->Width  = '100%' ;

$oFCKeditor->Height = '800' ;

$oFCKeditor->Create() ;

	

	



	?></td>

    <td colspan="4" valign="top"><table width="100%" border="0" cellpadding="5">

      <tr>

        <td><input class="button" type="submit" name="Submit" value="Salvesta" /></td>

        <td><a href="etendus_kirjeldus.php?etendusid=<? echo $etendusid;?>" target="_blank">VAATA!</a></td>

        </tr>

      <tr>

        <td colspan="2" class="fields">Objektid:</td>

        </tr>

      <tr>

        <td colspan="2"><?

				tabel2("etendus_exp",$etendusid,$_SESSION["mysession"]["login"],1,1,"asi");

				//echo $baas;

	?></td>

        </tr>

      <tr>

        <td colspan="2" class="fields"><a href="index.php?page=exp_disp&etendusid=<? echo $etendusid;?>&klass=<? echo $klass;?>&action=new&pw=<? echo $line["password"]; ?>" target="_blank">Tee siia uus Eksp obj.</a></td>

        <tr>

          <td colspan="2" class="fields">Pildid:</td>

          <tr>

            <td colspan="2" class="fields"><?

	//	echo $tootid;

		tabel("etendus_pildid",$etendusid,$_SESSION["mysession"]["login"], 1);								

		?></td>

          <tr>

            <td colspan="2" class="fields">&nbsp;</td>

          <tr>

            <td colspan="2" class="fields"><input class="fields" name="update" type="text" value="<? 

		include("globals.php");

			echo timestamp2($line["lupdate"]); ?>" ></td>

          </tr>

       <tr>

        <td colspan="2" class="fields">		<? if($line["veeb_pilt_url"]){?><a href=<? echo urldecode($line["veeb_pilt_url_s"]); ?>  target=_blank><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"></a><? }?></td>

        </tr>

    </table></td>

  </tr>

     <tr > 

		    <td colspan="2" background="image/sinine.gif" class="menu">KUTSED ... </td>

		    <td colspan="4" background="image/sinine.gif" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=masin_disp&action=new&etendus_id=<? echo $line["id"];?>&aasta=2013" target="_blank">Uus</a></td>

	      </tr>

			<tr>

            	<td colspan="6"><?

						include("tabel_class_iid_kutse.php");

						tabel_kutse("kutse_etendus",$etendusid,$_SESSION["mysession"]["login"],2,1);

			?>            </td>

          </tr>

        <tr>

        <td colspan="6" class="fields">Dokumendid</td>

      </tr>

  <tr>

    <td colspan="6">							<? 

	tabel("etendus_doclist",$etendusid,$_SESSION["mysession"]["login"], 0);				

	?>				

</td>

  </tr>

  <tr>

    <td colspan="6"><?	



									tabel2("etendus_isik",$etendusid,$_SESSION["mysession"]["login"],1,1);

						?></td>

  </tr>

  <tr>

    <td colspan="6"> <?

									include("link_class.php");

									lingid("etendus_lingid",$etendusid,$_SESSION["mysession"]["login"]);

						  ?></td>

  </tr>

  <tr>

    <td colspan="6"><table width="100%">

    <tr>

      <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif"> 

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

            <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Treiler URL </td>

            <td width="65%" > 

             <input class="fields" name="video_url" type="text" value="<? echo $line["video_url"]; ?>" size="40" >

            </td>

          </tr>

          <tr background="image/sinine.gif"> 

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

            <td width="3%"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="85%">Player App <br />

            <span class="style3">(1 - microsoft, 2 - YouTube, 3 - Krampf, 4 - Delfi)</span> </td>

            <td width="12%" > 

             <input class="fields" name="video_player" type="text" value="<? echo $line["video_player"]; ?>" size="5" >

            </td>

          </tr>

          <tr background="image/sinine.gif"> 

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

            <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%"> <a href="<? echo $line["orig_URL"]; ?>" target="_blank">Originaal  URL </a></td>

            <td width="65%" > 

             <input class="fields" name="orig_URL" type="text" value="<? echo $line["orig_URL"]; ?>" size="40" >

            </td>

          </tr>

					<tr background="image/sinine.gif"> 

					<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

					</tr>

					<tr> 

					<td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

					<td class="menu" width="35%">&nbsp;</td>

					<td width="65%" ></td>

					</tr>

				</table>

				

	</td>

    	

      <td width="50%" valign="top">&nbsp;</td>

  </tr>

</table></td>

  </tr>

  <tr>

    <td colspan="6"><div align="center"><a href="index.php?page=etendus_kirjeldus&etendusid=<? echo $etendusid; ?>&aasta=<? echo $aastakene;?>" target="_blank" class="menu">N&auml;ita vahendeid jms </a></div></td>

  </tr>

  <tr>

    <td colspan="6"><? include("etendus_lisad.php"); ?></td>

    </tr>

</table>

</form>



















