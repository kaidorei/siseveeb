<?

	include("globals.php");

	include("tabel_class_iid.php");

	include("tabel_class_sit.php");

	include("tabel_class_iid_opetaja.php");

	$eh=$_GET["action"];

	$fid=$_GET["fid"];

	if($eh=="new"){

		// kui me saabume kutsete leheküljelt, siis selle id kaudu saab andmebaasist vastavad värgid

		$kutse_id=$_GET["kutse_id"];

		$etendus_id=$_GET["etendus_id"];

		$query_kutse="SELECT * FROM kutse WHERE id='".$kutse_id."'";

		// et ei satuks olematule tabelireale ...

		if (!$etendus_id) $etendus_id=0;

//		echo $query;

		$result_kutse=mysql_query($query_kutse);

		$line_kutse=mysql_fetch_array($result_kutse); 

		

		if ($line_kutse["aadress"]) $koolinimi=$line_kutse["nimi"]; else $koolinimi="Nimetu";

		

		$query_new="INSERT INTO kool (nimi, aadress, email1, kontakt1, tel1, markused, kutse_".$etendus_id.", date) VALUES ('".$koolinimi."', '".$line_kutse["aadress"]."', '".$line_kutse["email1"]."', '".$line_kutse["kontakt1"]."', '".$line_kutse["tel1"]."', '".$line_kutse["markused"]."','1', '".date("Y-m-d")."')";

//		echo $query_new;

		$tmp=mysql_query($query_new);

		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

		$fid=$tmp["last_insert_id()"];

		

		// NB kohe peaks tegema ka vastava kutse_kool tabeli kirje ...

		if($etendus_id)

		{

			$query_seos="INSERT INTO kutse_kool (oid1, oid2) VALUES ('".$kutse_id."', '".$fid."')";

			$result_seos=mysql_query($query_seos);

		}

	

		

?>

<link href="scat.css" rel="stylesheet" type="text/css" />

<style type="text/css">

<!--

.style1 {color: #FF0000}

-->

</style>

<!--<table width="100%" border="0">

  <tr>

    <td class="fields"><? //echo "Salvesta! fid = ", $fid; ?></td>

  </tr>

</table>--><?

		// ------------------------------------------------

		} elseif($eh=="save" and $_POST["nimi"]){

		  $valjad=array("nimi","kontakt1","kontakt2","tel1","tel2","email1","email2","aadress","maakond","markused","amet1", "amet2", "tyyp","PK", "LK", "kutse_1", "kutse_2", "kutse_3", "kutse_4", "kutse_5", "kutse_7","on_globe","kontakt3", "tel3", "email3", "amet3", "veeb", "yldine_email", "on_tugikool","o_arv","ty_partnerkool","WG_LA","WG_LO");

			foreach($valjad as $var){

			$rida[$var]=$var."='".$_POST[$var]."'";

			}

			$query="UPDATE kool SET ".implode(",",$rida)." WHERE id=".$fid." LIMIT 1";

//			echo $query;

			sql_rida($login_id, $query, 1, 0);





	// kui chekbox on kontrollitud, muudetakse pildikataloogi nimi vastavaks reisi toimumise ajale ja nimele

	if ($_POST["setasi"]==1)

	{	

		$yldkool=$_POST["yldkool"];

		// võtan andmed "yldkoolid" andmebaasist

		$query="SELECT nimi,  PK, LK, kooli_tyyp FROM yldkoolid WHERE nimi='".$yldkool."'";

//		echo $query;

		$result=mysql_query($query);

		$linek=mysql_fetch_array($result); 

		sql_rida($login_id, "UPDATE kool SET nimi='".$linek["nimi"]."', PK='".$linek["PK"]."', LK='".$linek["LK"]."', kooli_tyyp='".$linek["kooli_tyyp"]."' WHERE id=".$fid, 1, 0);

	}

	}	



	 $line=sql_val($login_id, "SELECT * FROM kool WHERE id=".$fid, 0, 0);

 ?> 

<br>



<form name="kool" method="post" action="<? echo $PHP_SELF."?page=kool_disp&action=save&fid=".$fid;?> ">

  <table width="670" border="0">

    <tr>

      <td valign="top"><table width="420" border="0" cellpadding="0" cellspacing="2">

          <tr>

      <td width="100%" valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="images/sinine.gif"> 

            <td width="95%" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

          </tr>

        </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="images/sinine.gif"> 

		<td colspan="3"  bgcolor="#FF9900"><img src="images/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td background="images/sinine.gif"></td>

		    <td background="images/sinine.gif" class="menu" width="55%">Andmed 

              kooli kohta ...</td>

		<td width="45%" ></td>

  	</tr>

</table>

              <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr background="images/sinine.gif"> 

            <td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

                  <td width="4%"><img src="images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu">Kooli nimi</td>

            <td align="left" ><input name="nimi" type="text" class="fields" value="<? echo $line["nimi"]; ?>" size="50" >            </td>

          </tr>

<? if ($line["PK"] < 1000 ) {?>        <tr> 

                  <td><img src="images/spacer.gif" width="20" height="10"></td>

                  <td width="14%" class="menu"><em>S&uuml;nkro </em></td>

                  <td width="10%" align="right" class="menu"><em>Set</em>

                  <input type="checkbox" name="setasi" value="1" /></td>

                  <td align="left" width="72%" > 

              <? 

			$query2="SELECT nimi FROM yldkoolid ORDER BY nimi;";

			$result2=mysql_query($query2);?>

              <select  class="fields" name="yldkool">

                <?

				print "<OPTION value='' ".$sel.">pole teada</OPTION>";

				while($var=mysql_fetch_array($result2)){

					if($var["nimi"]==$line["nimi"]) { $sel="selected"; } else { $sel="";}

						echo "<option value=\"".$var["nimi"]."\" ".$sel.">".$var["nimi"]."</option>"; 

				}

		  ?>

              </select></td>

                </tr>

	<? } else {?>

	       <tr> 

                  <td><img src="images/spacer.gif" width="20" height="10"></td>

                  <td width="14%" class="menu">&nbsp;</td>

                  <td width="10%" align="right" class="menu">&nbsp;</td>

                  <td align="left" width="72%" > 

	

	                <a class="ekraan_link" href="http://www.regio.ee/?op=body&amp;id=24&amp;marker=<? echo $line["PK"]; ?>|<? echo $line["LK"]; ?>|<? echo $line["nimi"]; ?>|symbol_circle_anim" target="_blank">Näita Regio kaardil </a></td>

                </tr>

	<? }?>

          <tr> 

                  <td><img src="images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu">Kooli aadress</td>

            <td align="left" ><input name="aadress" type="text" class="fields" value="<? echo $line["aadress"]; ?>" size="50" /></td>

          </tr>

          <tr> 

                  <td><img src="images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu">Pikkuskraad</td>

            <td align="left" ><input name="PK" type="text" class="fields" value="<? echo $line["PK"]; ?>" size="50" /></td>

          </tr>

            <tr> 

                  <td><img src="images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu">Laiuskraad</td>

            <td align="left" ><input name="LK" type="text" class="fields" value="<? echo $line["LK"]; ?>" size="50" /></td>

          </tr>

          <tr> 

                  <td><img src="images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu">Pikkuskraad</td>

            <td align="left" ><input name="WG_LA" type="text" class="fields" value="<? echo $line["WG_LA"]; ?>" size="50" /></td>

          </tr>

            <tr> 

                  <td><img src="images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu">Laiuskraad</td>

            <td align="left" ><input name="WG_LO" type="text" class="fields" value="<? echo $line["WG_LO"]; ?>" size="50" /></td>

          </tr>

          <tr> 

                  <td><img src="images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu"><a href="<? echo $line["veeb"]; ?>" target="_blank">Veeb</a></td>

            <td align="left" ><input name="veeb" type="text" class="fields" value="<? echo $line["veeb"]; ?>" size="50" /></td>

          </tr>

         <tr> 

                  <td><img src="images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu">&Uuml;ldine e-mail </td>

            <td align="left" ><input name="yldine_email" type="text" class="fields" value="<? echo $line["yldine_email"]; ?>" size="50" /></td>

          </tr>

        <tr> 

                  <td><img src="images/spacer.gif" width="20" height="10"></td>

                  <td colspan="2" class="menu">Maakond/Linn</td>

            <td align="left" > 

              <? 

			$query2="SELECT id,nimi FROM maakonnad ORDER BY nimi;";

			$result2=mysql_query($query2);

			echo "<select  class=\"fields\" name=\"maakond\">";

				while($var=mysql_fetch_array($result2)){

					if($var["id"]==$line["maakond"]) { $sel="selected"; } else { $sel="";}

						echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["nimi"]."</option>"; 

				}

					echo "</select>";

		  ?>              </td>

          </tr>

        </table>

	          <div align="right"></div>

              <table width="100%" border="0" cellpadding="0" cellspacing="0">

  		<tr>

            <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

      	</tr>

		</table>





<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="images/sinine.gif"> 

		<td colspan="3"  bgcolor="#FF9900"><img src="images/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td background="images/sinine.gif"></td>

		    <td background="images/sinine.gif" class="menu" width="55%">Andmed 

              kontaktisiku kohta ...</td>

		<td width="45%" ></td>

  	</tr>

</table>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="images/sinine.gif"> 

          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

                  <td width="4%"><img src="images/spacer.gif" width="20" height="10"></td>

             

            <td class="menu" width="30%">Nimi</td>

          <td align="right" width="66%" > <input name="kontakt1" type="text" class="fields" value="<? echo $line["kontakt1"]; ?>" size="50" > 

          </td>

        </tr>

      </table>

       <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="images/sinine.gif"> 

          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

                  <td width="4%"><img src="images/spacer.gif" width="20" height="10"></td>

             

                  <td class="menu" width="30%">Amet</td>

          <td align="right" width="66%" > <input name="amet1" type="text" class="fields" value="<? echo $line["amet1"]; ?>" size="50" > 

          </td>

        </tr>

      </table>

             <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr background="images/sinine.gif"> 

                  <td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

                </tr>

                <tr> 

                  <td width="4%"><img src="images/spacer.gif" width="20" height="10"></td>

                  <td class="menu" width="15%">e-mail</td>

                  <td class="button3" > <div align="center"><a href="mailto:<? echo $line["email1"]; ?>">saada:</a></div></td>

                  <td align="right" width="66%" > <input name="email1" type="text" class="fields" value="<? echo $line["email1"]; ?>" size="50" ></td>

                </tr>

              </table>

     <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="images/sinine.gif"> 

          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

                  <td width="4%"><img src="images/spacer.gif" width="20" height="10"></td>

             

            <td class="menu" width="32%">telefonid</td>

                  <td align="right" width="64%" > <input name="tel1" type="text" class="fields" value="<? echo $line["tel1"]; ?>" size="50" ></td>

        </tr>

      </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="images/sinine.gif"> 

		<td colspan="3"  bgcolor="#FF9900"><img src="images/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td background="images/sinine.gif"></td>

		          <td background="images/sinine.gif" class="menu" width="55%">Kooli DIREKTORI andmed ...</td>

		<td width="45%" ></td>

  	</tr>

</table>

     <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr> 

                  <td width="4%"><img src="images/spacer.gif" width="20" height="10"></td>

             

            <td class="menu"><?

						tabel_opetaja("isik_kool",$fid,$_SESSION["mysession"]["login"],2,1,"direktor");

			?>      </td>

          </tr>

      </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="images/sinine.gif"> 

		<td colspan="3"  bgcolor="#FF9900"><img src="images/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td background="images/sinine.gif"></td>

		          <td background="images/sinine.gif" class="menu" width="55%">GLOBE 

                    &otilde;petajad ...</td>

		          <td width="45%" align="right"  class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&action=new&kool_id=<? echo $line["id"];?>&aine=globe" target="_blank">Uus</a></td>

  	</tr>

</table>

     <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="images/sinine.gif"> 

          <td colspan="2" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

                  <td width="4%"><img src="images/spacer.gif" width="20" height="10"></td>

             

            <td class="menu"><?

						tabel_opetaja("isik_kool",$fid,$_SESSION["mysession"]["login"],2,1,"globe");

			?>  </td>

          </tr>

      </table>

 

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="images/sinine.gif"> 

		<td colspan="3"  bgcolor="#FF9900"><img src="images/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td width="0%" background="images/sinine.gif"></td>

		    <td background="images/sinine.gif" class="menu" width="61%">M&auml;rkused, 

              kommentaarid ja erisoovid ...</td>

		<td width="39%" ></td>

  	</tr>

</table>

     <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="images/sinine.gif"> 

          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

        </tr>

       </table>

       <table width="100%" border="0" cellspacing="0" cellpadding="0">

         <tr background="images/sinine.gif"> 

            <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

                  <td width="4%"><img src="images/spacer.gif" width="20" height="10"></td>

            <td class="menu" width="29%"><p align="left">Kutsuja m&auml;rkused 

                ja lisasoovid</p>              </td>

                  <td align="right" width="67%" ><textarea cols="45" rows="9" class="fields" name="markused" type="text" value="" ><? echo $line["markused"]; ?> </textarea></td>

           </tr>

        </table>

  



<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="images/sinine.gif"> 

		<td colspan="3"  bgcolor="#FF9900"><img src="images/sinine.gif" width="1" height="2"></td>

	</tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="images/sinine.gif"> 

          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

                  <td><img src="images/spacer.gif" width="20" height="10"></td>

          <td class="menu" width="35%">



		  	<input class="button" type="submit" name="Submit" value="Salvesta">

            </td>

            <td width="65%" ><p align="right">&nbsp;</p>

              </td>

        </tr>

		</table>

</br>

<br />

<br />

<br />

<table width="100%" border="0">

 	<tr > 

		    <td colspan="2" background="images/sinine.gif" class="menu">GLOBE mõõtekohad ... </td>

	      </tr>

        <tr> 

                  <td width="20"><img src="images/spacer.gif" width="20" height="10"></td>

          <td width="386" class="menu"><p align="left"><?

						

						tabel6("kool_sites",$fid,$_SESSION["mysession"]["login"],1,1);

			?>            </p></td>

            </tr>

      </table><table width="100%" border="0">

 	<tr > 

		    <td colspan="2" background="images/sinine.gif" class="menu">Koolile v&auml;lja laenatud vahendid ... </td>

	      </tr>

        <tr> 

                  <td width="20"><img src="images/spacer.gif" width="20" height="10"></td>

          <td width="386" class="menu"><p align="left"><?

						

						tabel2("kool_vahendid",$fid,$_SESSION["mysession"]["login"],1,1,'');

			?>            </p></td>

            </tr>

      </table><table width="100%" border="0">

 	<tr > 

		    <td colspan="2" background="images/sinine.gif" class="menu">V&otilde;rgustiku teised koolid  ... </td>

	      </tr>

        <tr> 

                  <td width="20"><img src="images/spacer.gif" width="20" height="10"></td>

          <td width="386" class="menu"><p align="left"><?

						tabel2("kool_kool",$fid,$_SESSION["mysession"]["login"],1,1,'');

			?>            </p></td>

            </tr>

      </table> </td>

	  



</table></td>

      <td width="195" valign="top">

<table width="250" border="0">

               <? 

		  ?>

          <tr>

                 <td colspan="2" align="center" class="menu"><input class="button" type="submit" name="Submit" value="Salvesta"></td>

          </tr>

          <tr> 

            <td width="177" class="menu">Esmane registreerimine</td>

            <td width="63" align="right" class="fields"><? echo $line["date"]; ?>            </td>

          </tr>

           <tr> 

            <td class="menu">On kool</span></td>

            <td align="right" class="fields">

            <select name="tyyp" id="select" class="fields_left">

              <option value="0" <? if($line["tyyp"]==0) { echo "selected"; }?>>Muu asutus</option>

             <option value="1" <? if($line["tyyp"]==1) { echo "selected"; }?>>Põhikool ja gümnaasium</option>

             <option value="2" <? if($line["tyyp"]==2) { echo "selected"; }?>>Põhikool</option>

             <option value="3" <? if($line["tyyp"]==3) { echo "selected"; }?>>Puhas gümnaasium</option>

             <option value="4" <? if($line["tyyp"]==4) { echo "selected"; }?>>Algkool</option>

             <option value="5" <? if($line["tyyp"]==5) { echo "selected"; }?>>Erivajadustega lapsed</option>

             <option value="10" <? if($line["tyyp"]==10) { echo "selected"; }?>>Kool suletud</option>

              </select>

              <div align="right"></div></td>

          </tr>

           <tr> 

            <td class="menu">GLOBE kool  <span class="menu_punane">(1-on, 0-mitte)</span>  </td>

            <td align="right" class="fields"><input name="on_globe" type="text"  class="fields" value="<? echo $line["on_globe"]; ?>" size="5" >

              <div align="right"></div></td>

          </tr>

           <tr> 

            <td class="menu">TÜ partnerkool  <span class="menu_punane">(1-on, 0-mitte)</span>  </td>

            <td align="right" class="fields"><input name="ty_partnerkool" type="text"  class="fields" value="<? echo $line["ty_partnerkool"]; ?>" size="5" >

              <div align="right"></div></td>

          </tr>

          <tr> 

            <td class="menu">Kutse GLOBE <span class="menu_punane">(1-on, 0-mitte)</span>  </td>

            <td align="right" class="fields"><input name="kutse_7" type="text"  class="fields" value="<? echo $line["kutse_7"]; ?>" size="5" >

              </td>

          </tr>

          <tr>

            <td class="menu">Õpilasi koolis</td>

            <td align="right" class="fields"><input name="o_arv" type="text"  class="fields" value="<? echo $line["o_arv"]; ?>" size="5" ></td>

          </tr>

        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="images/sinine.gif"> 

		<td colspan="2" bgcolor="#FF9900"><img src="images/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td background="images/sinine.gif" class="menu">KUTSED ... </td>

		    <td background="images/sinine.gif" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=masin_disp&action=new&kool_id=<? echo $line["id"];?>&aasta=2013" target="_blank">Uus</a></td>

	      </tr>

          <tr background="images/sinine.gif"> 

				<td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

		  </tr>

			<tr>

            	<td colspan="2"><?

						include("tabel_class_iid_kutse.php");

						tabel_kutse("kutse_kool",$fid,$_SESSION["mysession"]["login"],2,1);

			?>            </td>

          </tr>

          <tr background="images/sinine.gif"> 

		<td colspan="2" bgcolor="#FF9900"><img src="images/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td colspan="2" background="images/sinine.gif" class="menu">Missugusel 

            reisil on k&uuml;lastatud ... </td>

	      </tr>

          <tr background="images/sinine.gif"> 

				<td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

		  </tr>

			<tr>

            	<td colspan="2"><?

						tabel2("reis_kool",$fid,$_SESSION["mysession"]["login"],2,1,'');

			?>            </td>

          </tr>

          <tr background="images/sinine.gif"> 

		<td colspan="2" bgcolor="#FF9900"><img src="images/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td background="images/sinine.gif" class="menu">F&uuml;&uuml;sika&otilde;petaja ... </td>

	        <td align="center" background="images/sinine.gif" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&action=new&kool_id=<? echo $line["id"];?>&aine=fyysika" target="_blank">Uus</a></td>

  	</tr>

          <tr background="images/sinine.gif"> 

				<td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

		  </tr>><?

						

			?>  

			<tr>

            	<td colspan="2"><?

						tabel_opetaja("isik_kool",$fid,$_SESSION["mysession"]["login"],2,1,"fyysika");

			?>            </td>

          </tr      

  	><tr > 

		    <td background="images/sinine.gif" class="menu">Keemia&otilde;petaja ... </td>

	        <td align="center" background="images/sinine.gif" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&action=new&kool_id=<? echo $line["id"];?>&aine=keemia" target="_blank">Uus</a></td>

  	</tr>

          <tr background="images/sinine.gif"> 

				<td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

		  </tr>

			<tr>

            	<td colspan="2"><?

						tabel_opetaja("isik_kool",$fid,$_SESSION["mysession"]["login"],2,1,"keemia");

			?>            </td>

          </tr><tr > 

		    <td background="images/sinine.gif" class="menu">Bioloogia&otilde;petaja ... </td>

	        <td align="center" background="images/sinine.gif" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&action=new&kool_id=<? echo $line["id"];?>&aine=bioloogia" target="_blank">Uus</a></td>

  	</tr>

          <tr background="images/sinine.gif"> 

				<td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

		  </tr>

			<tr>

            	<td colspan="2"><?

						tabel_opetaja("isik_kool",$fid,$_SESSION["mysession"]["login"],2,1,"bioloogia");

			?>            </td>

          </tr><tr > 

		    <td background="images/sinine.gif" class="menu">Geograafia&otilde;petaja ... </td>

	        <td align="center" background="images/sinine.gif" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&action=new&kool_id=<? echo $line["id"];?>&aine=geograafia" target="_blank">Uus</a></td>

  	</tr>

          <tr background="images/sinine.gif"> 

				<td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>

		  </tr>

			<tr>

            	<td colspan="2"><?

						tabel_opetaja("isik_kool",$fid,$_SESSION["mysession"]["login"],2,1,"geograafia");

			?>            </td>

          </tr>

			<tr>

			  <td colspan="2" >

		      <?

			  	$url_t="image/eesti_v".$line["id"].".jpg";

				$url = "image/eesti_v.jpg"; // name/location of original image.

				

				$src_img = ImageCreateFromJPEG($url); // make 'connection' to image

				

				$quality = 100; //quality of the .jpg

				$src_width = imagesx($src_img); // width original image

				$src_height = imagesy($src_img); // height original image

				

			  	$x=($line["PK"]-373877)*($src_width/(745237-373877));

			  	$y=$src_height - ($line["LK"]-6345722)*($src_height/(6648619-6345722));

//				echo $x," ",$y;

								

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



				imagefilledarc($dest_img, $x, $y, 10, 10, 0, 360, $red, IMG_ARC_PIE);

				imageellipse($dest_img, $x, $y, 10, 10, $white);

				imagejpeg($dest_img, $url_t, $quality); 

				imagedestroy($src_img); 

				imagedestroy($dest_img);



if ($url_t) {?> <p><a class="ekraan_link" href="http://www.regio.ee/?op=body&amp;id=24&amp;marker=<? echo $line["PK"]; ?>|<? echo $line["LK"]; ?>|<? echo $line["nimi"]; ?>|symbol_circle_anim" target="_blank"><img src="<? echo $url_t;?>" /></a></p><? }?></td>

		  </tr>

			<tr>

			  <td colspan="2" class="ekraan_link" >Punane ring t&auml;histab kooli asukohta (kui koordinaadid on olemas) </td>

		  </tr>

	    </table>

      </td>

    </tr>

  </table>

  













</form>



