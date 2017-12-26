<link href="scat.css" rel="stylesheet" type="text/css" />
<div align="justify"><br> 
  <?
function et_tasu($num){ 
			switch($num)
				{
				case "0":
					$kuu=0;
					break;
				case "1":
					$kuu=1300;
					break;
				case "2":
					$kuu=1500;
					break;
				case "3":
					$kuu=750+2*550;
					break;
				case "4":
					$kuu=750+3*550;
					break;
				case "5":
					$kuu=750+4*550;
					break;
				default: 
					$kuu=0;
					break;
				}
   return($kuu); 
}
	$etendusi=$_POST["fshow"]+$_POST["kshow"]+$_POST["rshow"]+$_POST["mshow"]+$_POST["vshow"];

	$kokku=$_POST["km"]*3*2+et_tasu($_POST["fshow"])+et_tasu($_POST["kshow"])+et_tasu($_POST["rshow"])+et_tasu($_POST["vshow"])+et_tasu($_POST["mshow"])+$_POST["kover"]+$_POST["aover"];
 ?>   
  <span class="smallbody">Selle tabeli kaudu saab teada, mis üks Teadusbussi väljasõit tegelikult maksab. Seda ei kasutata koolidega suhtlemisel. Aga kui mõni firma tahab meid oma üritusele või kui meid kutsuvad omasugused &quot;projektiinimesed&quot;, siis siit saab teada ligikaudse hinna. Kusjuures ka selle rehkenduse järgi toodame pigem miinust, nii et ümmardada tuleks üles.</span><br>
  
</div>
<form name="firma" method="post" action="<? echo $PHP_SELF;?>?page=job_table ">
  
<table width="600" border="0" align="center" cellpadding="0" cellspacing="2"> 
  <tr>
      <td width="65%" valign="top">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td ><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="34%"><p class="navi"><em><font size="-1">Hinnakalkulaator</font></em></p>            </td>
            <td class="navi" ><div align="center"><strong><em>Kogus</em></strong></div></td>
          <td class="menu" width="30%"><p align="center" class="navi"><em><font size="-1">EEK</font></em></p>            </td>
        </tr>
  	<tr background="../registreerimine/images/sinine.gif"> 
		<td colspan="4"  bgcolor="#FF9900"><img src="../registreerimine/images/sinine.gif" width="1" height="2"></td>
	</tr>
   	<tr > 
		    <td background="../registreerimine/images/sinine.gif"></td>
		    <td colspan="3" background="../registreerimine/images/sinine.gif" class="menu" width="34%">Geograafia ...</td>
  	</tr>
        <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="34%">Minu kilomeetrit Tartust? (3 EEK/km) </td>
            <td align="right" width="31%" ><input name="km" type="text" class="fields" id="km" value="<? if($_POST["km"]) echo $_POST["km"]; else echo "0";?>" size="8" >          </td>
            <td width="30%" align="right" class="smallbody" ><? echo $_POST["km"]*3*2;?></td>
        </tr>
  		<tr>
            <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
      	</tr>
  	<tr background="../registreerimine/images/sinine.gif"> 
		<td colspan="4"  bgcolor="#FF9900"><img src="../registreerimine/images/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		    <td background="../registreerimine/images/sinine.gif"></td>
		    <td colspan="2" background="../registreerimine/images/sinine.gif" class="menu">Etendused (max viis etendust)  ...</td>
		    <td background="../registreerimine/images/sinine.gif"><span class="ekspon">
		      <? if($etendusi>5) echo "Üle viie etenduse kokku: ",$etendusi;?>
		    </span></td>
	      </tr>
        <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             
            <td class="menu" width="34%">Füüsikateater</td>
            <td align="right" width="31%" > <input align="right" name="fshow" type="text" class="fields" id="fshow" value="<? if($_POST["fshow"]) echo $_POST["fshow"]; else echo "0";?>" size="8" >          </td>
            <td width="30%" align="right" class="smallbody" ><?php echo et_tasu($_POST["fshow"]); ?></td>
        </tr>
        <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             
            <td class="menu" width="34%">Keemiateater</td>
            <td align="right" width="31%" > <input name="kshow" type="text" class="fields" id="kshow" value="<? if($_POST["kshow"]) echo $_POST["kshow"]; else echo "0";?>" size="8" >          </td>
            <td width="30%" align="right" class="smallbody" ><?php echo et_tasu($_POST["kshow"]); ?></td>
        </tr>
        <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td width="5%"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             
            <td class="menu" width="34%">Robootika</td>
            <td align="right" width="31%" > <input name="rshow" type="text" class="fields" value="<? if($_POST["rshow"]) echo $_POST["rshow"]; else echo "0";?>" size="8" >          </td>
            <td width="30%" align="right" class="smallbody" ><?php echo et_tasu($_POST["rshow"]); ?></td>
        </tr>
        <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             
            <td class="menu" width="34%">Valgus</td>
            <td align="right" width="31%" ><input name="vshow" type="text" class="fields" id="vshow" value="<? if($_POST["vshow"]) echo $_POST["vshow"]; else echo "0";?>" size="8" >          </td>
            <td width="30%" align="right" class="smallbody" ><?php echo et_tasu($_POST["vshow"]); ?></td>
        </tr>
        <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             
            <td class="menu" width="34%">Materjalid</td>
            <td align="right" width="31%" ><input name="mshow" type="text" class="fields" id="mshow" value="<? if($_POST["mshow"]) echo $_POST["mshow"]; else echo "0";?>" size="8" >          </td>
            <td width="30%" align="right" class="smallbody" ><?php echo et_tasu($_POST["mshow"]); ?></td>
        </tr>
        <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>

  	<tr > 
		    <td background="../registreerimine/images/sinine.gif"></td>
		    <td colspan="3" background="../registreerimine/images/sinine.gif" class="menu">Üldkulud ...</td>
 	</tr>
        <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             
            <td class="menu" width="34%">Korraldamine</td>
            <td align="right" width="31%" > <input name="kover" type="text" class="fields" id="kover" value="<? if($_POST["kover"]) echo $_POST["kover"]; else echo "100";?>" size="8" >          </td>
            <td width="30%" align="right" class="smallbody" ><?php echo $_POST["kover"]; ?></td>
        </tr>
        <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
            <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             
            <td class="menu" width="34%">Amortisatsioon</td>
            <td align="right" width="31%" ><input name="aover" type="text" class="fields" id="aover" value="<? if($_POST["aover"]) echo $_POST["aover"]; else echo "250";?>" size="8" ></td>
            <td width="30%" align="right" class="smallbody" ><?php echo $_POST["aover"]; ?></td>
        </tr>
        <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>
         <tr background="../registreerimine/images/sinine.gif"> 
          <td colspan="4" background="../registreerimine/images/sinine.gif"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
          <td class="menu" width="34%">

		  	<input class="button" type="submit" name="Submit" value="Rehkenda">            </td>
          <td width="31%" class="pealkiri" ><div align="right">KOKKU: </div></td>
          <td width="30%" class="menu" >
            <div align="right" class="pealkiri"><? echo $kokku;?></div></td>
        </tr>
      </table> </td>
	  

</table>






</td>
 </tr>
</table></form>
