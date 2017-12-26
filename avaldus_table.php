<link href="scat.css" rel="stylesheet" type="text/css" />
<br>
<script type="text/javascript" src="../functions/js/ahaa.js"></script>

<?	
	$action=$_GET["action"];
	$sel=$_GET["sel"];
	//--------------------------peaks individualiseerima
	if (!$etendus_id) $etendus_id=1;
	//--------------------------
	$ord=$_GET["ord"];
	if($ord==NULL) $ord="maakond";
	if($action=="del"){
		$aid=$_GET["aid"];
		$q="DELETE FROM avaldus WHERE id= ".$aid." LIMIT 1";
		$r=mysql_query($q);
		$q="DELETE FROM avaldus_isik WHERE oid1= ".$aid."";
		$r=mysql_query($q);
	}
//***protseduur Regio tabeli ja localhosti tabeli andmevahetuseks************************************************
/*	$query_asi="SELECT nimi,id,PK,email1, maakond, date, tyyp FROM kool WHERE nimi LIKE '%".$_POST["search_str"]."%'".$str1." ORDER BY ".$ord;
	$result_asi=mysql_query($query_asi);
	while($line_asi=mysql_fetch_array($result_asi))
	{
		$query_asi1="SELECT nimi,  PK, LK, kooli_tyyp FROM yldkoolid WHERE nimi='".$line_asi["nimi"]."'";
//	echo $query_asi1;
		$result_asi1=mysql_query($query_asi1);
		$line_asi1=mysql_fetch_array($result_asi1); 
		if($line_asi1["nimi"])
		{
		$query="UPDATE kool SET PK='".$line_asi1["PK"]."', LK='".$line_asi1["LK"]."', kooli_tyyp='".$line_asi1["kooli_tyyp"]."' WHERE nimi='".$line_asi1["nimi"]."'";
			echo $line_asi1["nimi"];
		}
		$result=mysql_query($query);

		//	echo $query;
	}

*///********************************************************************************************	
// kui ei ole tehtud valikut staatuse  järgi .. 
	if($sel==NULL) $sel=0;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="10" class="pealkiri">Avaldused &otilde;pitubade programmis osalemiseks</td>
  </tr>
  <tr> 
    <td class="menu">&nbsp;</td>
    <td nowrap class="menu"><a href="index.php?page=kool_table&ord=nimi&sel=<? echo $sel?>">nimi</a></td>
    <td nowrap class="menu">&nbsp;</td>
    <td width="10%" nowrap class="menu"><div align="left">e-mail</div></td>
    <td nowrap class="menu"><div align="left">Klass</div></td>
    <td nowrap class="menu"><div align="center">M&auml;&auml;ra <br />
      isik </div></td>
    <td nowrap class="menu"><div align="center">M&auml;&auml;ra <br />
    tugikool </div></td>
    <td nowrap class="menu"><div align="center"><a href="index.php?page=kool_table&ord=date&sel=<? echo $sel?>"> reg.kuup</a></div></td>
    <td class="menu" valign="middle">&nbsp;</td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="11" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <?
	$query="SELECT * FROM avaldus WHERE eesnimi LIKE '%".$_POST["search_str"]."%'"." ORDER BY id";
//	echo $query;
	$result=mysql_query($query);
	$count=1;
//WHILE ALGAB--------------------------------------------------------------------------------------------------------------------------
	while($line=mysql_fetch_array($result)){

//		$q = "UPDATE avaldus SET uiq='".md5("algus".$line['eesnimi'].$line['perenimi']."lopp")."' WHERE id=".$line['id']." LIMIT 1";
//		mysql_query($q);


			// kui on tehtud valik saatude järele ...
			$state = 0;
			//... siis uurime, kas avaldus on juba  määratud ...
				$query1="SELECT * FROM avaldus_isik WHERE oid1=".$line["id"];
			//	echo $query1;
				$result1=mysql_query($query1);
				$line1=mysql_fetch_array($result1);		
				if($line1==NULL)
				{
					$state=1;
				} // end of 
				else
				{
					$state=2; 
				} // end of else
			$state_kool = 0;
			//... siis uurime, kas avaldus on juba  määratud ...
				$query23="SELECT * FROM isik_kool WHERE oid1=".$line1["oid2"];
			//	echo $query1;
				$result23=mysql_query($query23);
				$line23=mysql_fetch_array($result23);		
				if($line23==NULL)
				{
					$state_kool=1;
				} // end of 
				else
				{
					$state_kool=2; 
				} // end of else
// Näitame vaid määramata kutseid ...
if($state_kool==1)
{
 ?>
  <tr> 
    <td align="center" valign="middle" class="smallbody" width="1%"> 
      <? echo $count,". ";
	  
	  ?>    </td>
    <td width="23%" nowrap class="menu"><? echo $line["eesnimi"]," ",$line["perenimi"];
?><span class="navi"> <a href="http://www.fyysika.ee/ninatargad/opikojad?uiq=<? echo $line["uiq"];?>" target="_blank" class="navi">(uiq)</a></span> </td>
    <td width="7%" nowrap class="menu"><div align="center">
      <input name="button" type="button" class="button3" onclick="window.open('avaldus_sisu.php?id=<? echo $line["id"]; ?>','Delete','toolbar=0, scrollbars=1,width=820,height=800,status=yes');" value="Ankeet" />
    </div></td>
    <td nowrap class="menu"><a href="mailto:<? echo $line["email1"];?>"><? echo $line["email1"];
?></a></td>
    <td  width="4%" nowrap class="menu"> 
<? echo $line["teaduskraad"];
?> </td>
    <td  width="5%" nowrap class="navi">
	
	<? 
				$query09="SELECT * FROM `isik` WHERE `perenimi` LIKE CONVERT( _utf8 '%".$line["perenimi"]."%' USING latin1 ) COLLATE latin1_swedish_ci AND `eesnimi` LIKE CONVERT( _utf8 '%".$line["eesnimi"]."%' USING latin1 ) COLLATE latin1_swedish_ci LIMIT 0 , 30".$line["id"];
//				echo $query09;
				$result09=mysql_query($query09);
				$line09=mysql_fetch_array($result09);		
	echo $line09[0]['id'];
	if($line09)
	{
		if($state==1)
		{
			?>
			<input type="button" name="suva1" class="button" value="<? echo $line09["eesnimi"]," ",$line09["perenimi"];?>" onclick="window.open('addvalue_iid.php?domain=avaldus_isik&oid=<? echo $line["id"];?>&sel=1','File_upload','toolbar=0,width=660,height=580,status=yes');" ><?
		}
		else
		{
		?> <a href="<? echo $PHP_SELF."?page=isik_disp&iid=".$line1["oid2"]."&liik=".$liik."&pw=".$pw; ?>"><? echo $line09["eesnimi"]," ",$line09["perenimi"];?></a><? 
		}
	}
	else
	{
	
	?>
	
	<input class="button" type="button" name="Submit3" value="M&auml;&auml;ra isik" onClick="document.location.href='index.php?page=isik_disp&action=new&pw=<? echo $line["password"]; ?>&aasta=<? echo $aastakene;?>&avaldus_id=<? echo $line["id"]; ?>'">
	
	<?
	
	}
	
	?>	</td>
    <td  width="4%" nowrap class="navi"><? 
	if($state_kool==1)
	{
	if($state==2)
	{
	?><input type="button" name="suva1" class="button" value="M&auml;&auml;ra tugikool" onclick="window.open('addvalue_iid_tugikool.php?domain=isik_kool&oid=<? echo $line1["oid2"];?>&sel=1&etendus_id=<? echo $etendus_id;?>','File_upload','toolbar=0,width=660,height=580,status=yes');" >
	<? 
	}
	else
	{
	echo "<- Määra isik";
	}
	}
	else
	{
				$query33="SELECT id, nimi FROM kool WHERE id=".$line23["oid2"];
			//	echo $query33;
				$result33=mysql_query($query33);
				$line33=mysql_fetch_array($result33);		
?>
	
	<a href="<? echo $PHP_SELF."?page=kool_disp&fid=".$line23["oid2"]."&pw=".$pw; ?>"><? echo $line33["nimi"];?></a>
	<?
	}
	
?></td>
    <td  width="6%" class="menu" nowrap> <div align="center"><? echo $line["date"]; ?>
   </div></td>
    <td width="2%" valign="middle"  class="smallbody"> 
      <div align="center">
        <? if($priv>=2) {?>
		<a onclick='javascript:kysi("index.php?page=avaldus_table&action=del&aid=<? echo $line["id"]; ?>","Oled päris kindel, et soovid selle kontakti kustutada?")' class="button2">x</a>
		
		
        <? } ?>    
    </div></td>
  </tr>
<tr>
  <td colspan="11" class="smallbody"><strong>Kontakt  :</strong> Telefon: <? echo $line["mobla"];
?>, kodune aadress: <? echo $line["adr_kodu"];?>, kool: <? echo $line["kool"];?>, kooli kontakt: <? echo $line["adr_too1"];?>..</td>
</tr>  <? $count++;
	}
}
?>
</table>
