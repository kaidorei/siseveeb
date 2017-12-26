<script src="ckeditor/ckeditor.js"></script>

<?

	include("tabel_class_iid.php");

	include("globals.php");

	$eh=$_GET["action"];

	$kid=$_GET["kid"];

	$kool_id=$_GET["kool_id"];

	$etendus_id=$_GET["etendus_id"];

	if($eh=="new"){

		$tmp=mysql_query("INSERT INTO kutse (nimi, date) VALUES (\"Kes kutsub?\", \"".date("Y-m-d")."\")");

//		echo $tmp, "uus kutse";

		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

		$kid=$tmp["last_insert_id()"];

		

		

		

		if($kool_id) // kui keegi tegeleb uue füüsikaõpetaja sisestamisega

		{

		$query_seos="INSERT INTO kutse_kool (oid1,oid2,sisu2) VALUES (".$kid.",".$kool_id.",'uus kutse')";

		$tmp=mysql_query($query_seos);

//		echo $query_seos;

		}

		if($etendus_id) // kui keegi tegeleb uue füüsikaõpetaja sisestamisega

		{

		$query_seos="INSERT INTO kutse_etendus (oid1,oid2,sisu2) VALUES (".$kid.",".$etendus_id.",'uus kutse')";

		$tmp=mysql_query($query_seos);

//		echo $query_seos;

		}



		

?>

<link href="scat.css" rel="stylesheet" type="text/css" />

<style type="text/css">

<!--

.style1 {color: #FF0000}

-->

</style>

<?

		// ------------------------------------------------

		} elseif($eh=="save"){

		  $valjad=array("nimi","aadress", "kontakt1", "tel1","email1","maksab","soov_kuup", "markused", "etendus_id");



		foreach($valjad as $var){

			$rida[$var]=$var."=\"".$db->real_escape_string($_POST[$var])."\"";

		}



			$query="UPDATE kutse SET ".implode(",",$rida)." WHERE id=".$kid." LIMIT 1";

//				echo "SAVE           ", $query;		

			$result=mysql_query($query);











	}	

    $query="SELECT * FROM kutse WHERE id=".$kid;

//	echo $query;

    $result=mysql_query($query);

	$line=mysql_fetch_array($result); 

 ?> 

<br>



<form name="kool" method="post" action="<? echo $PHP_SELF."?page=masin_disp&action=save&etendus_id=100&kid=".$kid;?> ">

  <table width="670" border="0">

    <tr>

      <td><table width="100%" border="0" cellpadding="0" cellspacing="2">

          <tr>

      <td width="100%" valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr background="/images/sinine.gif"> 

            <td width="95%" background="/images/sinine.gif"><img src="/images/sinine.gif" width="1" height="1"></td>

          </tr>

        </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="/images/sinine.gif"> 

		<td colspan="3"  bgcolor="#FF9900"><img src="/images/sinine.gif" width="1" height="2"></td>

	</tr>

 </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="/images/sinine.gif"> 

		<td colspan="2"  bgcolor="#FF9900"><img src="/images/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td background="/images/sinine.gif"></td>

		    <td background="/images/sinine.gif" class="pealkiri">Kutse sisestamine, kui seda on mingil p&otilde;hjusel ise teha vaja ... </td>

		</tr>

</table><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="/images/sinine.gif"> 

          <td colspan="4" background="/images/sinine.gif"><img src="/images/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr> 

                  <td width="3%" rowspan="2"><img src="/images/spacer.gif" width="20" height="10"></td>

          <td class="menu" width="36%">



		  	<input class="button" type="submit" name="Submit" value="Salvesta">            </td>

            <td width="1%" rowspan="2" ><p align="right">&nbsp;</p>              </td>

            <td width="60%" rowspan="2" ><table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="image/sinine.gif"> 

		<td colspan="2"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td width="4%" background="image/sinine.gif"></td>

		    <td background="image/sinine.gif" class="menu" width="96%">Etendused, mida on  kutsutud ...</td>

  	</tr>

</table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">

			<tr background="image/sinine.gif"> 

				<td background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

			</tr>

			<tr>

            	<td width="100%" ><?

//						include("textlog_naitus_class.php");

						

						tabel2("kutse_etendus",$kid,$_SESSION["mysession"]["login"],1,1,'');

			?>

            </td>

          </tr>

	    </table><table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr background="image/sinine.gif"> 

		<td colspan="2"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>

	</tr>

  	<tr > 

		    <td width="4%" background="image/sinine.gif"></td>

		    <td background="image/sinine.gif" class="menu" width="96%">Koolid, kes on  kutsunud ...</td>

  	</tr>

</table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">

			<tr background="image/sinine.gif"> 

				<td background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

			</tr>

			<tr>

            	<td width="100%" ><?

			

						tabel2("kutse_kool",$kid,$_SESSION["mysession"]["login"],1,1,'');

			?>

            </td>

          </tr>

	    </table></td>

        </tr>

        <tr>

          <td class="menu"><? 

			$query2="SELECT id,nimi_est FROM etendus ORDER BY id;";

			$result2=mysql_query($query2);

			echo "<select  class=\"fields\" name=\"etendus_id\">";

			echo "<option value=\"0\"></option>"; 

				while($var=mysql_fetch_array($result2)){

					if($var["id"]==$line["etendus_id"]) { $sel="selected"; } else { $sel="";}

						echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["nimi_est"]."</option>"; 

				}

					echo "</select>";

		  ?></td>

        </tr>

      </table>

              <table width="100%" border="0" cellspacing="0" cellpadding="0">

                          <tr>

            <td width="10%" class="menu">Kutse</td>

            <td width="90%" align="left" ><textarea class="ckeditor" cols="120" rows="50"  name="markused" type="text" value="" ><? echo $line["markused"]; ?> </textarea>

            

            </td>

          </tr>

     </table>

              <table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr background="/images/sinine.gif"> 

            <td colspan="4" background="/images/sinine.gif"><img src="/images/sinine.gif" width="1" height="1"></td>

          </tr>

          <tr> 

                  <td width="4%"><img src="/images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu">Kooli nimi</td>

            <td width="54%" align="left" ><input name="nimi" type="text" class="fields" value="<? echo $line["nimi"]; ?>" size="50" >            </td>

          </tr>

<? if ($line["PK"] < 1000 ) {?>        

	<? } else {?>

	       

	<? }?>

          <tr> 

                  <td><img src="/images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu">Kooli aadress </td>

            <td align="left" > <input name="aadress" type="text" class="fields" value="<? echo $line["aadress"]; ?>" size="50" >            </td>

          </tr>

          <tr> 

                  <td><img src="/images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu">Kontaktisik</td>

            <td align="left" ><input name="kontakt1" type="text" class="fields" value="<? echo $line["kontakt1"]; ?>" size="50" /></td>

          </tr>

            <tr> 

                  <td><img src="/images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu">Telefon</td>

            <td align="left" ><input name="tel12" type="text" class="fields" value="<? echo $line["tel1"]; ?>" size="50" /></td>

            </tr>

          <tr> 

                  <td><img src="/images/spacer.gif" width="20" height="10"></td>

            <td colspan="2" class="menu">e-mail</td>

            <td align="left" ><input name="email1" type="text" class="fields" value="<? echo $line["email1"]; ?>" size="50" /></td>

          </tr>

          <tr>

            <td>&nbsp;</td>

            <td colspan="2" class="menu">Missugune etendus? </td>

            <td align="left" >&nbsp;</td>

          </tr>

          <tr>

            <td>&nbsp;</td>

            <td colspan="2" class="menu">Maksab?</td>

            <td align="left" ><input name="maksab" type="text" class="fields" value="<? echo $line["maksab"]; ?>" size="50" /></td>

          </tr>

          <tr>

            <td>&nbsp;</td>

            <td colspan="2" class="menu">Soovitav kuup&auml;ev <span class="fields">(aaaa-kk-pp) </span></td>

            <td align="left" ><input name="soov_kuup" type="text" class="fields" value="<? echo $line["soov_kuup"]; ?>" size="50" /></td>

          </tr>

          </table>

             





  

 </td>

</table></td>

    </tr>

  </table>

  













</form>



