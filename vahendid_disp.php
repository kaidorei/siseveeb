<?
	include("tabel_class_iid.php");
	$eh=$_GET["action"];
	$vid=$_GET["vid"];
	$expid=$_GET["klass_id"];
	if($eh=="new"){
		$tmp=mysql_query("INSERT INTO vahendid (nimi_est) VALUES (\"Nimetu\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$vid=$tmp["last_insert_id()"];
		
		
		if($expid)
		{
//			echo "teeme kohe seose vastava etedusega<br>";
			$query_insert="INSERT INTO exp_vahendid (oid1,oid2) VALUES (\"".$expid."\",\"".$vid."\")";
//			echo $query_insert;
			$tmp=mysql_query($query_insert);
				
		}

		
		
		
		// ------------------------------------------------
		} elseif($eh=="save"  && $_POST["nimi_est"]){
		  $valjad=array("nimi_est","kood","staatus_id","kirjeldus_est","asukoht","kogus", "netipood_url", "on_tooriist", "on_globe", "on_tb", "on_opikojad", "hankimine","naita_veebis","kommentaarid");
			foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
			}
			$query="UPDATE vahendid SET ".implode(",",$rida)." WHERE id=".$vid;
//		echo $query;
			$result=mysql_query($query);
			
			
			
			
	// kas vastav exp objekt on olemas?	
		$query_pid="SELECT * FROM vahendid WHERE id=".$vid;
		$result_pid=mysql_query($query_pid);
		$line_pid=mysql_fetch_array($result_pid);

		$query_exp="SELECT * FROM exp WHERE vahend_id=".$vid;
		$result_exp=mysql_query($query_exp);
		if($line_exp=mysql_fetch_array($result_exp))
		{
			//echo $line_exp["id"];
			$expid = $line_exp["id"];
		}
		else
		{
			echo "Vastavat exp objekti ei ole olemas ... teeme ...";
			$query_uusexp= "INSERT INTO exp (nimi_est,vahend_id,gpid_demo,naita_veebis) VALUES ('".$line_pid["nimi_est"]."',".$vid.",35,1)";
			//echo $query_uusexp;
			$result_uusexp=mysql_query($query_uusexp);
		}
		
		
		
// Uunendame exp objekti vahendi pildi ja annotatsiooni

		$query2="SELECT * FROM `vahendid` WHERE id=".$vid."";
		$result2=mysql_query($query2);
		$line2=mysql_fetch_array($result2);
		//echo $line2["veeb_pilt_url"]."<br>";
		if($expid)
		{
			$query22="UPDATE `fyysika_ee`.`exp` SET veeb_pilt_url='".$db->real_escape_string($line2["veeb_pilt_url"])."' , kirjeldus_est = '".$db->real_escape_string($line2["kirjeldus_est"])."' WHERE id=".$expid." LIMIT 2";
			
			echo $query22,"<br><br>";
			$result22=mysql_query($query22);
		}
			
		
// muudame exp objekti nime ...
		$result23=mysql_query($query23);
		$query24="UPDATE `fyysika_ee`.`exp` SET nimi_est='".$db->real_escape_string($line_pid["nimi_est"])."' WHERE id=".$expid." LIMIT 1";
		$result24=mysql_query($query24);
		
			
			
			
			
			
			
			
			
			
	}	
    $query="SELECT * FROM vahendid WHERE id=".$vid;
//	echo $query;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
 ?>
<style type="text/css">
<!--
.style2 {color: #FF0000;
font-size: 36px;}
.style3 {color: #FF0000}
-->
</style>
 <link href="scat.css" rel="stylesheet" type="text/css" />
<br>

<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=vahendid_disp&action=save&vid=".$vid; ?>">
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
          <td width="65%" ><input name="nimi_est" type="text" class="fields" value="<? echo $line["nimi_est"]; ?>" size="45" > 
          </td>
        </tr>
</table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Annotatsioon</td>
            <td width="65%" > <textarea cols="55" rows="5" class="fields" name="kirjeldus_est" type="text" value="" ><? echo $line["kirjeldus_est"]; ?> </textarea>
           </td>
          </tr>
         <tr> 
            <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="35%">Kommentaar</td>
            <td width="65%" > <textarea cols="55" rows="5" class="fields" name="kommentaarid" type="text" value="" ><? echo $line["kommentaarid"]; ?> </textarea>
           </td>
          </tr>
        </table>
<?

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		<td background="image/sinine.gif"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
		    <td background="image/sinine.gif" class="menu" width="35%">Seonduvad 
              ... </td>
		<td width="65%" ></td>
  	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
	<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
	<td width="5%"><img src="image/spacer.gif" width="20" height="10"></td>
	        <td class="menu" width="36%">... eksperimendid/t&ouml;&ouml;toad </td>
	        <td width="59%" ><?
		include("globals.php");
				tabel2("exp_vahendid",$vid,$_SESSION["mysession"]["login"],2,1,"Eksemplarid");
	?>
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
	<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
	<tr > 
		    <td background="image/sinine.gif" class="menu">&nbsp;</td>
	        <td background="image/sinine.gif" class="menu">Kui on, siis missugusele koolile/asutusele v&auml;lja laenutatud .... </td>
	</tr>
        <tr> 
                  <td width="29"><img src="../registreerimine/images/spacer.gif" width="20" height="10"></td>
          <td width="882" class="menu"><p align="left"><?
						tabel2("kool_vahendid",$vid,$_SESSION["mysession"]["login"],2,1,"Koolides");
			?>            </p></td>
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
		tabel("vahendid_pildid",$vid,$_SESSION["mysession"]["login"], 1,"Pildid");								
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
		  			include("link_class.php");
					lingid("vahendid_lingid",$vid,$_SESSION["mysession"]["login"]);
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
          <td class="menu" width="35%">Kuidas hankida?<span class="style3"></span></td>
          <td width="65%" ><textarea cols="55" rows="5" class="fields" name="hankimine" type="text" value="" ><? echo $line["hankimine"]; ?> </textarea></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="35%">Netipood (URL) <br />
            <span class="style3">(kirjuta &quot;ise&quot;, kui asi on ise tehtud) </span>http://</td>
          <td width="65%" ><input name="netipood_url" type="text" class="fields" value="<? echo $line["netipood_url"]; ?>" size="45" > 
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
          <td width="65%" >&nbsp; </td>
        </tr>
      </table> </td>
	  

<td width="250" valign="top"> 
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><? if($expid) {?>
          <a class="navi" href="<? echo $PHP_SELF."?page=exp_disp&expid=".$expid; ?>">exp</a> <? }?><input class="button" type="submit" name="Submit" value="Salvesta"></td>
          </tr>       <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>

        <tr> 
            <td class="menu"><img src="image/spacer.gif" width="2" height="10">Vahendi KOOD (ID)</td>
            <td width="45%" align="right" > <input name="kood" type="text" class="style2" value="<? echo $line["id"]; ?>" size="3" align="right" > 
            </td>
        </tr>
      </table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td width="55%" bgcolor="#FF6633" class="menu">KOGUS (vana süsteem)</td>
            <td width="45%" bgcolor="#FF0000" > <input name="kogus" type="text" class="fields" value="<? echo $line["kogus"]; ?>" size="20" > 
          </td>
        </tr>
      </table><table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		<td background="image/sinine.gif" class="menu"><img src="image/spacer.gif" width="1" height="13">Eksemplarid ...</td>
	      </tr>
        	<tr> 
		<td colspan="2"><?
		include("tabel_class_tykid.php");
	//	echo $tootid;
		tabel_tykid($vid,$_SESSION["mysession"]["login"], 1);								
		?>		  </td>
		</tr>

</table>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">Näita veebis</td>
            <td width="45%" > <input name="naita_veebis" type="text" class="fields" value="<? echo $line["naita_veebis"]; ?>" size="20" > 
          </td>
        </tr>
      </table>
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td width="1%"><img src="image/spacer.gif" width="2" height="10"></td>
            <td width="87%" valign="middle" bgcolor="#FFFF99" class="menu">GLOBE <span class="style3">(0/1)</span>
            </td>
            <td width="12%" valign="middle" bgcolor="#FFFF99" > <div align="center">
              <input name="on_globe" type="text" class="fields" value="<? echo $line["on_globe"]; ?>" size="5" > 
              </div></td>
        </tr>
        <tr> 
            <td width="1%"><img src="image/spacer.gif" width="2" height="10"></td>
            <td width="87%" valign="middle" bgcolor="#FFFF99" class="menu">Teadusbuss <span class="style3">(0/1)</span>
            </td>
            <td width="12%" valign="middle" bgcolor="#FFFF99" > <div align="center">
              <input name="on_tb" type="text" class="fields" value="<? echo $line["on_tb"]; ?>" size="5" > 
              </div></td>
        </tr>
        <tr> 
            <td width="1%"><img src="image/spacer.gif" width="2" height="10"></td>
            <td width="87%" valign="middle" bgcolor="#FFFF99" class="menu">&Otilde;pikojad <span class="style3">(0/1)</span>
            </td>
            <td width="12%" valign="middle" bgcolor="#FFFF99" > <div align="center">
              <input name="on_opikojad" type="text" class="fields" value="<? echo $line["on_opikojad"]; ?>" size="5" > 
              </div></td>
        </tr>
       <tr> 
            <td width="1%"><img src="image/spacer.gif" width="2" height="10"></td>
            <td width="87%" valign="middle" bgcolor="#FFFF99" class="menu">Keemia  <span class="style3">(0/1)</span>
            </td>
            <td width="12%" valign="middle" bgcolor="#FFFF99" > <div align="center">
              <input name="on_keemia" type="text" class="fields" value="<? echo $line["on_keemia"]; ?>" size="5" > 
              </div></td>
        </tr>
        <tr> 
            <td width="1%"><img src="image/spacer.gif" width="2" height="10"></td>
            <td width="87%" valign="middle" bgcolor="#FFFF99" class="menu">T&ouml;&ouml;riist/vahend <span class="style3">(0/1)</span>
            </td>
            <td width="12%" valign="middle" bgcolor="#FFFF99" > <div align="center">
              <input name="on_tooriist" type="text" class="fields" value="<? echo $line["on_tooriist"]; ?>" size="5" > 
              </div></td>
        </tr>
      </table>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		    <td background="image/sinine.gif"></td>
		    <td background="image/sinine.gif" class="menu" width="55%">netikuller.ee</td>
		    <td width="45%" ></td>
  	</tr>
</table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">Kaal</td>
            <td width="45%" > <input name="kaal" type="text" class="fields" value="<? echo $line["kaal"]; ?>" size="20" > 
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">Hind (USD) </td>
            <td width="45%" > <input name="hind" type="text" class="fields" value="<? echo $line["hind"]; ?>" size="20" > 
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">Transa US </td>
            <td width="45%" > <input name="hind_transa" type="text" class="fields" value="<? echo $line["hind_transa"]; ?>" size="20" > 
          </td>
        </tr>
      </table>




		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="2" height="10"></td>
            <td class="menu" width="55%">Viimane uuendus</td>
            <td width="45%" > <input name="update" type="text" class="fields" value="<? 
			echo timestamp2($line["lupdate"]); ?>" size="20" > 
            </td>
          </tr>
        </table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr background="image/sinine.gif"> 
            <td colspan="3"><? include("vahendid_lisad.php"); ?><img src="image/sinine.gif" width="1" height="1">   <? if ($line["veeb_pilt_url"]) {?>     <a href=<? echo urldecode($line["veeb_pilt_url_s"]); ?> target=_blank><img border="0" src="<? echo urldecode($line["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"></a><? } ?></td>
          </tr>
        </table>
		
</td>		
</table>






</td>
 </tr>
</table></form><table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr background="image/sinine.gif"> 
            <td colspan="4"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
          </tr>
         <tr background="image/sinine.gif"> 
            <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td width="3%"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td width="10%" valign="middle" class="menu">Kirjeldus</td>
            <td width="85%" align="right" class="fields style1" >&nbsp;</td>
            <td width="2%" valign="top" >        <input type="button" class="button3" value="m" onClick="window.open('vahend_kirj_mod.php?id=<? echo $vid; ?>&vali=kirjeldus_est&sel=1','Delete','toolbar=0, scrollbars=1,width=820,height=800,status=yes');" ></td>
          </tr>
         <tr background="image/sinine.gif"> 
            <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td width="3%"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td width="10%" valign="top" class="menu">&nbsp;</td>
            <td width="85%" class="fields" ><? echo $line["kirjeldus_est"]; ?></td>
            <td width="2%" valign="top" >&nbsp;</td>
          </tr>
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td width="10%" valign="top" class="menu">Kasutusjuhend</td>
            <td width="85%" align="right"  class="fields">&nbsp;</td>
             <td width="2%" valign="top" >     
               <input type="button" class="button3" value="m" onClick="window.open('vahend_kirj_mod.php?id=<? echo $vid; ?>&vali=juhend_est&sel=1','Delete','toolbar=0, scrollbars=1,width=820,height=800,status=yes');" ></td>
         </tr>
          <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          <tr> 
            <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td width="10%" valign="top" class="menu">&nbsp;</td>
            <td width="85%"  class="fields"><? echo $line["juhend_est"]; ?></td>
            <td width="2%" valign="top" >&nbsp;</td>
         </tr>
         <tr background="image/sinine.gif"> 
            <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
          
         

        </table>
