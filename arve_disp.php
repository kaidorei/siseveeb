
<?
	require_once('invoice/invoice.php');

/*	$example_invoice = new Invoice('809', '19. mai 2011', '02. juuni 2011');
	
	$example_invoice->setSchool('EBS Gümnaasium', 'Lauteri 3, 10114 Tallinn');
	$example_invoice->setPayer('EBS Education OÜ', 'A. Lauteri 3, 10114 Tallinn, Eesti');
	
	$example_invoice->addItem('Teadusbussi etendused', 2, 100);
	$example_invoice->addItem('Muud teenused', 5, 10);
	
	$example_invoice->setVerbalSum('kakssada viiskümmend eurot');
	
	$example_invoice->output();
*/


	$eh=$_GET["action"];
	$kool_id=$_GET["kool_id"];
	$reis_id=$_GET["reis_id"];
	$aid=$_GET["aid"];
echo $_GET["Submit"];
	
	if($eh=="new"){
		$isik_id=$login_id;
		// on juba sellisele reisile ja sellisele koolile arve?
		if($kool_id&&$reis_id)
			$query="SELECT id FROM arve WHERE kool_id=".$kool_id." AND reis_id=".$reis_id;
		else
			$query="SELECT id FROM arve WHERE kool_id=1000000";
	//	echo $query;
		$result=mysql_query($query);
		if(!$line=mysql_fetch_array($result))
			{	
		// küsime mis on maksimaalne arve number andmebaasis ...
			$query6="SELECT MAX(nmbr) FROM arve";
			$result6=mysql_query($query6);
			$line6=mysql_fetch_array($result6);
			$max_nmbr = $line6[0] +1;
			$query="INSERT INTO arve (id,nmbr,kool_id,maksetahtaeg,isik_id,eng, summa, mis_tehtud, date, reis_id) VALUES ('','".$max_nmbr."','".$kool_id."','".date("Y-m-d", mktime (0,0,0,date("m"),date("d")+14,date("Y")))."','".$isik_id."','".$eng."','".$summa."', 'Teadusbussi etendused', '".date("Y-m-d")."', '".$reis_id."')";
			$tmp=mysql_query($query);
	//		echo $query;
			$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
			$aid=$tmp["last_insert_id()"];
			}else{
			$ahhoi="Arve sellele reisile ja sellele koolile oli juba olemas...";
			$aid=$line["id"];
			}
			
	
	//		echo $toolid;
	
			// ------------------------------------------------
	} elseif($eh=="save"){
		$valjad=array("nmbr","kool_id", "arv", "summa", "arv_1", "summa_1", "maksetahtaeg","eng","mis_tehtud","mis_tehtud_1","date", "staatus", "summa_sonadega", "maksja_nimi","maksja_email", "maksja_aadress", "sularahas");
		foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
			}
		$query="UPDATE arve SET ".implode(",",$rida)." WHERE id=".$aid;
//		echo $query;	
		$result=mysql_query($query);
	}	

    $query="SELECT * FROM arve WHERE id=".$aid;
//	echo $query;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
	
	$query2="SELECT * FROM kool WHERE id=". $line["kool_id"];
	$result2=mysql_query($query2);
	$line_kool=mysql_fetch_array($result2);
//	echo $query2;
	
	$query3="SELECT eesnimi, perenimi FROM isik WHERE id=". $line["isik_id"];
	$result3=mysql_query($query3);
	$line_isik=mysql_fetch_array($result3);
 ?>
<link href="scat.css" rel="stylesheet" type="text/css" />
 
<br>
<form name="naitus" method="post" action="<? echo $PHP_SELF."?page=arve_disp&action=save&aid=".$aid; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
      <td width="100%" valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="5%"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="11%">Arve number </td>
            <td width="17%" class="navi" ><input name="nmbr" type="text" class="fields" value="<? echo $line["nmbr"]; ?>" size="10" >
                 
            <?php //echo" :", $ahhoi; ?>       </td>
            <td width="24%" align="right" class="menu" >Kool/asutus andmebaasist:</td>
            <td width="43%" class="navi" >
            
            
            <? 
			$query222="SELECT id,nimi,aadress FROM kool ORDER BY nimi;";
			$result222=mysql_query($query222);
			echo "<select  class=\"fields\" name=\"kool_id\">";
			echo "<option value=\"0\"></option>"; 
				while($var=mysql_fetch_array($result222)){
					if($var["id"]==$line["kool_id"]) { $sel="selected"; } else { $sel="";}
						echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["nimi"]."</option>"; 
				}
					echo "</select>";
		  ?>
            
            
            </td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="11%">Arve v&auml;ljastav isik </td>
            <td colspan="3"  class="fields"><? echo $line_isik["eesnimi"]; ?> <? echo $line_isik["perenimi"]; ?></td>
        </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="5%"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="15%">Kool/asutus -nimi </td>
            <td width="55%" align="center"  class="pealkiri"><? echo $line_kool["nimi"]; ?></td>
            <td width="25%"  class="menu"><a href="index.php?page=kool_disp&amp;fid=<? echo $line["kool_id"]; ?>" target="_blank">Muuda/t&auml;ienda</a></td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="5%"><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="15%">Kool/asutus - aadress </td>
            <td width="55%" align="center"  class="pealkiri"> <? echo $line_kool["aadress"]; ?></td>
            <td width="25%"  class="menu"><a href="index.php?page=kool_disp&amp;fid=<? echo $line["kool_id"]; ?>" target="_blank">Muuda/t&auml;ienda</a></td>
        </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="navi" width="17%">Maksja nimi (<span style="color: #FF0000">t&auml;ita, kui ei ole kool v&otilde;i kui maksja on erinev</span>) </td>
            <td width="79%" colspan="3" ><input name="maksja_nimi" type="text" class="fields" value="<? echo $line["maksja_nimi"];?>" size="45" /></td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
          <td width="17%" class="navi">Maksja aadress  (<span style="color: #FF0000">t&auml;ita, kui ei ole kool v&otilde;i kui maksja on erinev</span>) </td>
          <td width="79%" colspan="3" valign="middle"> <input name="maksja_aadress" type="text" class="fields" value="<? echo $line["maksja_aadress"];?>" size="45" > </td>
        </tr><tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="17%" class="navi">Maksja e-mail</td>
          <td colspan="3" ><input name="maksja_email" type="text" class="fields" value="<? echo $line["maksja_email"];?>" size="45" ></td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="17%">Kuup&auml;ev</td>
            <td width="79%" colspan="3" > <input name="date" type="text" class="fields" value="<? echo $line["date"];?>" size="45" >          </td>
        </tr>
       <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="17%">Makset&auml;htaeg</td>
          <td width="79%" ><input name="maksetahtaeg" type="text" class="fields" value="<? echo $line["maksetahtaeg"]; ?>" size="45" /> </td>
          <td width="79%" align="right" class="menu" >Sularahas?:</td>
          <td width="79%" ><input name="sularahas" type="text" class="fields" value="<? echo $line["sularahas"]; ?>" size="5" /></td>
        </tr>        
        <tr background="image/sinine.gif"> 
          <td colspan="5" class="menu" background="image/sinine.gif">Esimene rida arvel (kohustuslik)</td>
        </tr><tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="17%">Mille eest</td>
          <td width="79%" colspan="3" ><input name="mis_tehtud" type="text" class="fields" value="<? echo $line["mis_tehtud"]; ?>" size="45" ></td>
        </tr>

        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="17%">&Uuml;hikute arv</td>
          <td width="79%" colspan="3" > <input name="arv" type="text" class="fields" value="<? echo $line["arv"]; ?>" size="45" >          </td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="17%">&Uuml;hiku hind</td>
          <td width="79%" colspan="3" > <input name="summa" type="text" class="fields" value="<? echo $line["summa"]; ?>" size="45" >          </td>
        </tr><tr background="image/sinine.gif"> 
          <td colspan="5" class="menu" background="image/sinine.gif">Teine rida arvel (kui on)</td>
        </tr><tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="17%">Mille eest</td>
          <td width="79%" colspan="3" ><input name="mis_tehtud_1" type="text" class="fields" value="<? echo $line["mis_tehtud_1"]; ?>" size="45" ></td>
        </tr>

        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="17%">&Uuml;hikute arv</td>
          <td width="79%" colspan="3" > <input name="arv_1" type="text" class="fields" value="<? echo $line["arv_1"]; ?>" size="45" >          </td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="17%">&Uuml;hiku hind</td>
          <td width="79%" colspan="3" > <input name="summa_1" type="text" class="fields" value="<? echo $line["summa_1"]; ?>" size="45" >          </td>
        </tr><tr background="image/sinine.gif"> 
          <td colspan="5" class="menu" background="image/sinine.gif">Kokku:</td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="17%">Summa</td>
          <td width="79%" colspan="3" class="fields" > <? echo $line["summa"]*$line["arv"]+ $line["summa_1"]*$line["arv_1"]; ?></td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="4%"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="17%">Summa s&otilde;nadega            </td>
          <td width="79%" colspan="3" > <input name="summa_sonadega" type="text" class="fields" value="<? echo $line["summa_sonadega"]; ?>" size="45" >          </td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="17%">Staatus</td>
            <td width="79%" colspan="3" >             <? 
			$query2="SELECT id,nimi FROM arve_staatus ORDER BY id;";
			$result2=mysql_query($query2);
			echo "<select  class=\"fields\" name=\"staatus\">";
				while($var=mysql_fetch_array($result2)){
					if($var["id"]==$line["staatus"]) { $sel="selected"; } else { $sel="";}
						echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["nimi"]."</option>"; 
				}
					echo "</select>";
		  ?>          </td>
        </tr>
        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>
            <td class="menu" width="17%">Ingliskeelne?</td>
            <td width="79%" colspan="3" ><input name="eng" type="text" class="fields" value="<? echo $line["eng"];?>" size="45" ></td>
        </tr>
          <tr background="image/sinine.gif"> 
            <td width="4%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
          </tr>
           <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          	<td height="33"><img src="image/spacer.gif" width="20" height="40"><img src="image/spacer.gif" width="10" height="10"></td>
          	<td class="menu">
			<input class="button3" type="submit" name="Submit" value="Salvesta" />
			<!--<input class="button2" type="submit" name="Submit_loobu" value="Loobu" />-->
			</td>
          	<td class="menu">&nbsp;</td>
          	<td colspan="2" class="menu"><a class="menu" href="arve_pdf.php?aid=<? echo $aid; ?>" target="_blank">Tr&uuml;ki 
            asi v&auml;lja(pdf)</a></td>
          	
        </tr>
</table> 
</td>

<td width="0%"  valign="top"> 


</td>
</tr>
</table>
</form>
