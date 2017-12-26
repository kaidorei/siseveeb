<?php

	include("link_class.php");

	include("tabel_class_iid.php");

	include("tabel_class_iid_opetaja.php");
	require_once("globals.php");
  require_once('format_exp.php');
	include("tabel_class_oid.php");
	require_once('format_isik.php');
	$eh=$_GET["action"];
	$iid=$_GET["iid"];
	$kool_id=$_GET["kool_id"];
	$avaldus_id=$_GET["avaldus_id"];
//	echo $_POST['username'];
//	echo $login_id;
//	$rida=0;
	if($eh=="new"){

//		$gpid=$_GET["gpid"];

		$query_new="INSERT INTO isik (perenimi,eesnimi,in_buss) VALUES (\"Nimetu\",\"Nimetu\", \"0\")";
		$tmp=mysql_query($query_new);
			$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
			$iid=$tmp["last_insert_id()"];
		//echo $query_new, " iid=",$iid;
		if($kool_id) // kui keegi tegeleb uue f��sika�petaja sisestamisega

		{

		$query_seos="INSERT INTO isik_kool (oid1,oid2,sisu2) VALUES (".$iid.",".$kool_id.",'".$_GET["aine"]."')";

		$tmp=mysql_query($query_seos);

		echo $query_seos;

		}

		if($avaldus_id) // kui keegi tegeleb uue ninatarga sisestamisega

		{
		$query_seos="INSERT INTO avaldus_isik (oid1,oid2) VALUES (".$avaldus_id.",".$iid.")";
		$tmp=mysql_query($query_seos);
		echo $query_seos;
		$line_isik=array(); // kanname t�htsamad andmed avalduse juurest isiku juurde
		$query_isik="SELECT * FROM avaldus WHERE id=".$avaldus_id;
		echo $query_isik;
		$result_isik=mysql_query($query_isik);
		$line_isik=mysql_fetch_array($result_isik);
		$query_u="UPDATE isik SET eesnimi='".$line_isik["eesnimi"]."', perenimi='".$line_isik["perenimi"]."', teaduskraad='".$line_isik["teaduskraad"]."', mobla='".$line_isik["mobla"]."', email1='".$line_isik["email1"]."', adr_kodu='".$line_isik["adr_kodu"]."', on_nublu=1 WHERE id=".$iid." LIMIT 1";
		echo $query_u;
		$result_u=mysql_query($query_u);
		}

		$eh="";

		// ------------------------------------------------

	} elseif($eh=="save" && $_POST["perenimi"]){

		$valjad=array("perenimi","eesnimi","username","a_num","isikukood","amet_est","amet_eng","amet_rus","mobla","skype","tel_too","tel_kodu","adr_too1","adr_too2","adr_kodu","email1","email2","huvid","in_veeb","in_buss","r_alg","b_kat","markused", "on_reisijuht", "on_tugiisik", "on_nublu","on_fi", "maks2005", "maks2006", "maks2007", "maks2008", "maks2009", "maks2010", "maks2011", "maks2012","maks2013","maks2014","maks2015", "on_meedia","privileegid");

//..........................................
// võtame ja kontrollime võimalikud uued paroolid

		if ((strlen($_POST['parool1'])==0) or (strlen($_POST['parool2'])==0))

		{

			$sisu=NULL;

		}

		else

		{

			if ($_POST['parool1']!=$_POST['parool2'])

			{

				$sisu = "Üritasid parooli vahetada, aga kaks sisestust erinesid. Proovi veel!";

			}

			else

			{

				$sisu = "Sinu siseveebi parool on vahetatud. <br>Probleemidega p��rdu kaidor@fi.tartu.ee";

				$query="SELECT id,eesnimi,perenimi FROM isik WHERE id='".$iid."'";

				$result=mysql_query($query);

				$line=mysql_fetch_array($result);

				$query="UPDATE isik SET password=MD5('".$_POST['parool1']."') WHERE eesnimi='".$line["eesnimi"]."' AND perenimi='".$line["perenimi"]."' LIMIT 1";

				if (!mysql_query($query))

				{

					$sisu = "Miskit viga on juhtunud. <br>Küsi kaidor@fi.tartu.ee";

				}

			}

		}

// võtame ja kontrollime, kas EFS liikmelisus on muutunud

		if (strlen($_POST['in_efs'])==0)
		{
			$sisu=NULL;
//			echo "efs samaks";
		}
		else

		{

			echo "efs muutub";

				$sisu = "Tegelase EFS liikmelisus on muutunud";

				$query="SELECT id,eesnimi,perenimi FROM isik WHERE id='".$iid."'";

				$result=mysql_query($query);

				$line=mysql_fetch_array($result);

				$query="UPDATE isik SET in_efs_date='".$_POST['in_efs_date']."', in_efs='".$_POST['in_efs']."' WHERE id='".$iid."' LIMIT 1";



				if (!mysql_query($query))

				{

					$sisu = "Miskit viga on juhtunud. <br>Küsi kaidor@fi.tartu.ee";

				}

		}

//...............................
		foreach($valjad as $var){
////////////////////////////////////////////////////////
			$rida[$var]=$var."='".$_POST[$var]."'";
////////////////////////////////////////////////////////
			}

//

		$asid=implode(",",$rida);

		$query="UPDATE isik SET ".$asid." WHERE id=".$iid." LIMIT 1";

		//echo $query;

		$result=mysql_query($query);



		$q = "UPDATE isik SET uiq='".md5("algus".$iid.$_POST['eesnimi'].$_POST['perenimi']."lopp")." ' WHERE id=".$iid." LIMIT 1";

		mysql_query($q);






//	echo "tulemus on: ", $result;

// Kohendame vastava exp ja raamatX kirje.
make_isik($iid);

	}



//  print_r($_POST);

//  print_r($query);



/*	$valjad=array("perenimi", "password","eesnimi","username","a_num","isikukood","veeb_pilt_url","veeb_pilt_url_s","amet_est","amet_eng","amet_rus","skype","mobla","tel_too","tel_kodu","adr_too1","adr_too2","adr_kodu","email1","email2","huvid","markused","in_veeb","in_buss","r_alg","b_kat","lupdate", "on_reisijuht");

*/

	$line=array();

    $query="SELECT * FROM isik WHERE id=".$iid;

    $result=mysql_query($query);

	$line=mysql_fetch_array($result);

//		echo $query;

//		echo $result;
	$query0="SELECT * FROM exp WHERE ext_id=".$iid." AND gpid_demo = 53 LIMIT 1";
	//echo $query."<br>";
	$result0=mysql_query($query0);
	$line0=mysql_fetch_array($result0);
	$expid = $line0["id"];



 ?>

<style type="text/css">

<!--

.style1 {color: #D4D0C8}

-->

</style>



<link href="scat.css" rel="stylesheet" type="text/css" />

<br>

<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=isik_disp&action=save&iid=".$iid."&liik=".$liik."&pw=".$pw; ?>">

<table width="100%" border="0" cellpadding=" 0" cellspacing="2">

  	<tr>

      <td width="60%" valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif">

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr background="image/sinine.gif">

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr>

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Eesnimi</td>

            <td width="65%" ><input class="fields" name="eesnimi" type="text" value="<? echo $line["eesnimi"]; ?> "></td>

        </tr>

</table>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif">

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr>

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Perenimi*</td>

            <td width="65%" > <input class="fields" name="perenimi" type="text" value="<? echo $line["perenimi"]; ?>" >

          </td>

        </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Amet</td>

            <td width="65%" > <input class="fields" name="amet_est" type="text" value="<? echo $line["amet_est"]; ?>" >

            </td>

          </tr>

</table>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">L&uuml;hike CV</td>

            <td width="65%" >

			<textarea name="huvid" cols="45" rows="5" class="fields"><? echo $line["huvid"]; ?>  </textarea>

			</td>

          </tr>

</table>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Kes ma olen</td>

            <td width="65%" >

			<textarea name="markused" cols="45" rows="5" class="fields"><? echo $line["markused"]; ?>  </textarea>

			</td>

          </tr>

</table>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="image/sinine.gif">

		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr >

		<td background="image/sinine.gif"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

		    <td background="image/sinine.gif" class="menu" width="35%">Seonduvad ...</td>

		    <td width="65%" ></td>

  	</tr>

          <tr>

            <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">... etendused, kuhu kvalifitseerub </td>

            <td width="65%" >

              <?

				tabel2("etendus_isik",$iid,$_SESSION["mysession"]["login"],2,1,"Etendused");

	?>            </td>

          </tr>

 	<tr background="image/sinine.gif">

		<td colspan="3"  background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

	</tr>

         <tr>

            <td rowspan="6"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td width="35%" valign="top" class="menu">... koolid, kus &otilde;petab F&Uuml;&Uuml;SIKAT</td>

            <td width="65%" >

              <?



				tabel_opetaja("isik_kool",$iid,$_SESSION["mysession"]["login"],1,1,"fyysika");

	?>            </td>

          </tr>

         <tr>

           <td width="35%" valign="top" class="menu">... koolid, kus &otilde;petab KEEMIAT </td>

           <td ><? tabel_opetaja("isik_kool",$iid,$_SESSION["mysession"]["login"],1,1,"keemia");?></td>

         </tr>

         <tr>

           <td width="35%" valign="top" class="menu">... koolid, kus &otilde;petab BIOLOOGIAT </td>

           <td ><? tabel_opetaja("isik_kool",$iid,$_SESSION["mysession"]["login"],1,1,"bioloogia");?></td>

         </tr>

         <tr>

           <td width="35%" valign="top" class="menu">... koolid, kus &otilde;petab GEOGRAAFIAT </td>

           <td ><? tabel_opetaja("isik_kool",$iid,$_SESSION["mysession"]["login"],1,1,"geograafia");?></td>

         </tr>

         <tr>

           <td width="35%" valign="top" class="menu">... koolid, kus on GLOBE &otilde;petaja</td>

           <td ><? tabel_opetaja("isik_kool",$iid,$_SESSION["mysession"]["login"],1,1,"globe");?></td>

         </tr>

         <tr>

           <td valign="top" class="menu">... koolid, kus on DIREKTOR </td>

           <td ><?





		   				tabel_opetaja("isik_kool",$iid,$_SESSION["mysession"]["login"],1,1,"direktor");

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

		<td class="menu" width="35%">Fotod</td>

		<td width="65%" >

		<?

	//	echo $id;

		tabel("isik_pildid",$iid,$_SESSION["mysession"]["login"], 1,"Fotod");

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

			tabel("isik_docs",$iid,$_SESSION["mysession"]["login"], 0,"Dokumendid");

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

					lingid("isik_lingid",$iid,$_SESSION["mysession"]["login"]);

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

				<input class="button" type="submit" name="Submit" value="Salvesta">

        	</td>



          <td width="65%" >&nbsp; </td>



        </tr>



      </table> </td>



<td valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="image/sinine.gif">

		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr >

  	  <td background="image/sinine.gif"></td>

  	  <td class="menu"><input class="button" type="submit" name="Submit2" value="Salvesta" /><? if($expid) {?>

          <a class="navi" href="<? echo $PHP_SELF."?page=exp_disp&expid=".$expid; ?>">exp</a> <? }?> </td>

  	  <td class="menu"><input class="fields" name="privileegid" type="text" value="<? echo $line["privileegid"]; ?>" size="3" /></td>

  	  </tr>

  	<tr >

		    <td width="0%" background="image/sinine.gif"></td>

		    <td background="image/sinine.gif" class="menu" width="91%">Kontakt&amp;Co</td>

		<td width="9%" ></td>

  	</tr>

</table>

	    <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

            <td width="100%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

        </table>

 <? if ($pw==$line["password"] or $priv=='2') {?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Isikukood</td>

            <td width="65%" > <input class="fields" name="isikukood" type="text" value="<? echo $line["isikukood"]; ?>" >

            </td>

          </tr>

	</table>

<? }?>

	    <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%"> a/a number </td>

            <td width="65%" > <input class="fields" name="a_num" type="text" value="<? echo $line["a_num"]; ?>" >

            </td>

          </tr>

	</table>



        <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

            <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td width="2%"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="34%">Skype</td>

            <td width="54%" > <input class="fields" name="skype" type="text" value="<? echo $line["skype"]; ?>" >

           </td>

            <td class="menu" width="10%" >			<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>

			<a href="skype:<? echo $line["skype"]; ?>?call"><?php if ($line["skype"]) {?><img src="http://mystatus.skype.com/mediumicon/<? echo $line["skype"]; ?>" style="border: none;" alt="Proovi helistada!" /></a><?php }?>

 </td>

          </tr>

        </table>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td><img src="image/spacer.gif" width="10" height="10"></td>

           <td class="menu" width="35%">Mobiiltelefon</td>

            <td width="65%" > <input class="fields" name="mobla" type="text" value="<? echo $line["mobla"]; ?>" >

            </td>

          </tr>

</table>

 <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Tel. t&ouml;&ouml;</td>

            <td width="65%" > <input class="fields" name="tel_too" type="text" value="<? echo $line["tel_too"]; ?>" >

           </td>

         </tr>

</table>



        <table width="100%" border="0" cellspacing="0" cellpadding="0">



          <tr background="image/sinine.gif">



            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>



          </tr>



          <tr>



            <td><img src="image/spacer.gif" width="10" height="10"></td>



            <td class="menu" width="35%">Tel. kodu</td>



            <td width="65%" ><input class="fields" name="tel_kodu" type="text" value="<? echo $line["tel_kodu"]; ?>" >

            </td>



          </tr>



        </table>

       <table width="100%" border="0" cellspacing="0" cellpadding="0">



          <tr background="image/sinine.gif">



            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1">

            </td>



          </tr>



          <tr>



            <td><img src="image/spacer.gif" width="10" height="10"></td>



            <td class="menu" width="35%">Aadress t&ouml;&ouml;l</td>



            <td width="65%" > <input class="fields" name="adr_too1" type="text" value="<? echo $line["adr_too1"]; ?>" ></td>



          </tr>



        </table>







        <table width="100%" border="0" cellspacing="0" cellpadding="0">



          <tr background="image/sinine.gif">



            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>



          </tr>



          <tr>



            <td><img src="image/spacer.gif" width="10" height="10"></td>



            <td class="menu" width="35%">Aadress t&ouml;&ouml;l 2</td>



            <td width="65%" > <input class="fields" name="adr_too2" type="text" value="<? echo $line["adr_too2"]; ?>" ></td>



          </tr>



        </table>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Aadress kodu</td>

            <td width="65%" > <input class="fields" name="adr_kodu" type="text" value="<? echo $line["adr_kodu"]; ?>" >

            </td>

          </tr>

</table>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">E-mail 1</td>

            <td width="54%" > <input class="fields" name="email1" type="text" value="<? echo $line["email1"]; ?>" > </td>

            <td class="button3" width="30" align="center" nowrap> <a href="mailto:<? echo $line["email1"]; ?>">saada</a>

			</td>

          </tr>

 </table>



        <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">E-mail 2</td>

            <td width="54%" > <input class="fields" name="email2" type="text" value="<? echo $line["email2"]; ?>" > </td>

            <td class="button3" width="30" align="center" nowrap> <a href="mailto:<? echo $line["email2"]; ?>">saada</a>

            </td>

          </tr>

        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="330">Teadusbussis?</td>

            <td width="90" align="right" > <input class="fields" name="in_buss" type="text" value="<? echo $line["in_buss"]; ?>"  size="10"> </td>

          </tr>

         <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="330">Reisijuht?</td>

            <td width="90" align="right" > <input class="fields" name="on_reisijuht" type="text" value="<? echo $line["on_reisijuht"]; ?>"  size="10"> </td>

          </tr>

         <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="330">Tugiisiik?</td>

            <td width="90" align="right" > <input class="fields" name="on_tugiisik" type="text" value="<? echo $line["on_tugiisik"]; ?>"  size="10"> </td>

          </tr>

         <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="330">meedia?</td>

            <td width="90" align="right" > <input class="fields" name="on_meedia" type="text" value="<? echo $line["on_meedia"]; ?>"  size="10"> </td>

          </tr>

         <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

        <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="330">Nublu?</td>

            <td width="90" align="right" > <input class="fields" name="on_nublu" type="text" value="<? echo $line["on_nublu"]; ?>"  size="10"> </td>

          </tr>

           <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

           <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="330">EFS liige? </td>

            <td width="90" align="right" class="fields"> <?  if ($priv>=5) {?>

<input  class="fields" name="in_efs" type="text" value="<? echo $line["in_efs"]; ?>"  size="10"> <? }else{ echo $line["in_efs"]; }?></td>

          </tr>

           <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="330">?mis ajast?  </td>

            <td width="90" align="right" class="fields"> <?  if ($priv>=5) {?>

<input  class="fields" name="in_efs_date" type="text" value="<? echo $line["in_efs_date"]; ?>"  size="10"> <? }else{ echo $line["in_efs_date"]; }?></td>

          </tr>

           <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

         <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="330">F&uuml;&uuml;sika Instituutis?</td>

            <td width="90" align="right" > <input class="fields" name="on_fi" type="text" value="<? echo $line["on_fi"]; ?>"  size="10"> </td>

          </tr>

           <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

        <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="330">N&auml;ita veebis</td>

            <td width="90" align="right" > <input class="fields" name="in_veeb" type="text" value="<? echo $line["in_veeb"]; ?>"  size="10"></td>

          </tr>

            <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

		  <?  if ($priv>1) {?>

        <tr background="image/sinine.gif">

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

 		  <? }?>

       <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu_punane" width="330">On B-kategooria load? (<strong>1=on</strong>)<span class="style1"> </span></td>

            <td width="90" align="right" > <input class="fields" name="b_kat" type="text" value="<? echo $line["b_kat"]; ?>"  size="10"></td>

          </tr>

             <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

         <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td width="330" bgcolor="#FFFF00" class="menu">Siseveebi <strong class="menu">kasutajanimi <span class="style1"></span></strong></td>

            <td width="90" align="right" ><input class="fields" name="username" type="text" value="<? if($line["username"]) echo $line["username"]; else echo mt_rand(1478613278

, 9999999999); ?>" size="15" /></td>

         </tr>

             <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

		  <? if ($login_id==$line["id"] || $priv>=2) {?>

        <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td width="330" bgcolor="#FFFF00" class="menu"><font color="#000066">Parooli

              vahetuseks uus <strong>parool</strong> esimest korda</font></td>

            <td width="90" > <div align="right">

              <input class="fields" name="parool1" type="password" value="<? echo $_POST['parool1'];?>"  size="15" >

            </div></td>

          </tr>

             <tr background="image/sinine.gif">

           <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

        <tr>

            <td width="13"><img src="image/spacer.gif" width="10" height="10"></td>

            <td width="330" bgcolor="#FFFF00" class="menu"><font color="#003399">Uus

              parool teist korda, siis vajuta Salvesta</font></td>

            <td width="90" > <div align="right">

              <input class="fields" name="parool2" type="password" value="<? echo $_POST['parool2'];?>"  size="15">

            </div></td>

          </tr>

		  <? }?>

      </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="image/sinine.gif">

            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr>

            <td><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Viimane uuendus</td>

            <td width="65%" > <input class="fields" name="update" type="text" value="<?

			echo timestamp2($line["lupdate"]); ?>" >

            </td>

          </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="image/sinine.gif">

		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr >

		    <td width="4%" background="image/sinine.gif"></td>

		    <td background="image/sinine.gif" class="menu" width="96%">Reisid,

              kus kaasas k&auml;inud... </td>

  	</tr>

</table>





        <table width="100%" border="0" cellspacing="0" cellpadding="0">

			<tr background="image/sinine.gif">

				<td background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

			</tr>

			<tr>

            	<td width="100%" ><?

						tabel2("reis_isik",$iid,$_SESSION["mysession"]["login"],2,1,"Reisid ...");

			?>

            </td>

          </tr>

	    </table>









        <table width="100%" border="0" cellspacing="0" cellpadding="0">

			<tr background="image/sinine.gif">

				<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

			</tr>

			<tr>

           	  <td width="65%" ><? if ($line["veeb_pilt_url"]) {?><a href=<?  echo urldecode($line["veeb_pilt_url_s"]); ?> target=_blank><img src="<?  echo urldecode($line["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" align="right" ></a><? } ?></td>

          </tr>

	    </table>





      </td>

</tr>

</table>

<?  if ($priv>=5) {?>

<table width="100%" border="0">

  <tr>

    <td colspan="11" background="image/sinine.gif" class="menu">EFS liikmemaksud</td>

    </tr>

  <tr>

    <td class="navi">2005</td>

    <td class="navi">2006</td>

    <td class="navi">2007</td>

    <td class="navi">2008</td>

    <td class="navi">2009</td>

    <td class="navi">2010</td>

    <td class="navi">2011</td>

    <td class="navi">2012</td>

    <td class="navi">2013</td>

    <td class="navi">2014</td>

    <td class="navi">2015</td>

  </tr>

  <tr>

    <td class="navi"><input class="fields" size="4" name="maks2005" type="text" value="<? echo $line["maks2005"]; ?> "></td>

    <td class="navi"><input name="maks2006" type="text" class="fields" value="<? echo $line["maks2006"]; ?> " size="4"></td>

    <td class="navi"><input name="maks2007" type="text" class="fields" value="<? echo $line["maks2007"]; ?> " size="4"></td>

    <td class="navi"><input name="maks2008" type="text" class="fields" value="<? echo $line["maks2008"]; ?> " size="4"></td>

    <td class="navi"><input name="maks2009" type="text" class="fields" value="<? echo $line["maks2009"]; ?> " size="4"></td>

    <td class="navi"><input name="maks2010" type="text" class="fields" value="<? echo $line["maks2010"]; ?> " size="4"></td>

    <td class="navi"><input name="maks2011" type="text" class="fields" value="<? echo $line["maks2011"]; ?> " size="4" /></td>

    <td class="navi"><input name="maks2012" type="text" class="fields" value="<? echo $line["maks2012"]; ?> " size="4" /></td>

    <td class="navi"><input name="maks2013" type="text" class="fields" value="<? echo $line["maks2013"]; ?> " size="4" /></td>

    <td class="navi"><input name="maks2014" type="text" class="fields" value="<? echo $line["maks2014"]; ?> " size="4" /></td>

    <td class="navi"><input name="maks2015" type="text" class="fields" value="<? echo $line["maks2015"]; ?> " size="4" /></td>

  </tr>

</table>

<? }?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td>&nbsp;</td>

  </tr>

</table>

</form>

        <? include("isik_lisad.php"); ?>



      </td>



  </tr>



</table>
