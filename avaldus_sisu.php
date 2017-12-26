<?
		include("connect.php");
		include("authsys.php");	
		include("globals.php");
		if($loginform==1) { echo "Juurdepääs keelatud!";}
		else {	
	  $id=$_GET["id"];	
		?>
<link href="scat.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.back {
	background-color: #FFFFFF;
	border: 2px none #CCCCCC;
}
.style1 {color: #FF0000}

-->

</style>

<script>
function aken(){
window.open('about:blank','uploader','width=450,height=20,top=100,toolbar=no');
return true;
}

function ending(){
	window.opener.location.reload();
	window.close();
}

function ehee(){
		self.opener.ending();
		window.close();
}
</script>
<? 

//	echo $dom1." ".$dom2;

//vastavalt seose id-le leian tabelist seose kaks otsa
	$query="SELECT * FROM avaldus WHERE id=".$id;
	$result=mysql_query($query);
	$line=mysql_fetch_array($result); 
//echo $query;	
?>
<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>>
<? if($tehtud!=1) {?><table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr> 
    <td width="119" background="image/sinine.gif" class="menu" >V&auml;li </td>
    <td background="image/sinine.gif" class="menu">Sisu</td>
  </tr>
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
   </tr>
    <tr>
     <td colspan="1" valign="top" class="options" >Nimi</td>
     <td class="pealkiri" >	<? echo $line["eesnimi"]," ",$line["perenimi"] ;?></td>
   </tr>
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
</table>


         <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td width="5%" bgcolor="#FFFF00"><img src="../registreerimine/images/spacer.gif" width="20" height="10" /><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td width="40%" align="left" valign="top" class="options" ><div align="left" class="smallnews">Millistesse koolidesse oled võimeline minema-sõitma pärast koolipäeva lõppu lisakoolituseks?</div></td>
             <td width="55%" align="right" class="options" ><div align="left"><? echo $line["logistika1"]; ?></div></td>
           </tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td width="5%" bgcolor="#FFFF00"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td width="40%" align="left" valign="top" class="options" ><div align="left" class="smallnews">Kas nendest kohtadest on sul võimalik ka kella 19-20 paiku elukohta tagasi pääseda?</div></td>
             <td width="55%" align="right" class="options" ><div align="left"><? echo $line["logistika2"]; ?></div></td>
           </tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td width="5%" bgcolor="#FFFF00"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td width="40%" align="left" valign="top" class="options" ><div align="left" class="smallnews">Mis kellani tohib koolitus kesta, et pääseksid nimetatud paikadest koju? </div></td>
             <td width="55%" align="right" class="options" ><div align="left"><? echo $line["logistika3"]; ?></div></td>
           </tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td width="5%" bgcolor="#FFFF00"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td width="40%" align="left" valign="top" class="options" ><div align="left" class="smallnews">Kas vajaksid transporti tagasi elukohta pärast koolituse lõppu? </div></td>
             <td width="55%" align="right" class="options" ><div align="left"><? echo $line["logistika4"]; ?></div></td>
           </tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td width="5%" bgcolor="#00FF00" ><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">F&Uuml;&Uuml;SIKA &otilde;petaja nimi</td>
             <td width="55%" align="right" class="options" > <div align="left"><? echo $line["f1"]; ?> </div></td></tr>
           <tr >
             <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#00FF00"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">F&uuml;&uuml;sikatundide arv n&auml;dalas</td>
             <td width="55%" align="right" class="options" > <div align="left"><? echo $line["f2"]; ?> </div></td></tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#00FF00"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">F&uuml;&uuml;sikatundide arv n&auml;dalas</td>
             <td width="55%" align="right" class="options" > <div align="left"><? echo $line["f3"]; ?> </div></td></tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#00FF00"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">Mitu iseseisvat füüsikapraktikumi oled koolis läbi teinud viimase poole aasta jooksul?</td>
             <td width="55%" align="right" class="options" > <div align="left"><? echo $line["f4"]; ?> </div></td></tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#00FF00"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">Kui on, loetle viimase poole aasta  iseseisvate eksperimentide teemad kui suudad</td>
             <td width="55%" align="right" class="options" ><div align="left"><? echo $line["f5"]; ?></div></td>
           </tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#00FF00"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">Kas õpetaja näitab demonstratsioonkatseid ja kui tihti</td>
             <td width="55%" align="right" class="options" ><div align="left"><? echo $line["f6"]; ?></div></td>
           </tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#00FF00"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%"> Loetle viimase poole aasta demonstratsioonkatsete teemad kui suudad</td>
             <td width="55%" align="right" class="options" ><div align="left"><? echo $line["f7"]; ?></div></td>
           </tr>
           <tr >
             <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td width="5%" bgcolor="#0000FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">KEEMIA &otilde;petaja nimi</td>
             <td width="55%" align="right" class="options" >
               <div align="left"><? echo $line["k1"]; ?>                   </div></td></tr>
           <tr >
             <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#0000FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">Keemiatundide arv n&auml;dalas</td>
             <td width="55%" align="right" class="options" > <div align="left"><? echo $line["k2"]; ?> </div></td></tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#0000FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">Keemiatundide arv n&auml;dalas</td>
             <td width="55%" align="right" class="options" > <div align="left"><? echo $line["k3"]; ?> </div></td></tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#0000FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">Mitu iseseisvat füüsikapraktikumi oled koolis läbi teinud viimase poole aasta jooksul?</td>
             <td width="55%" align="right" class="options" >
                 <div align="left"><? echo $line["k4"]; ?></div></td></tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#0000FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">Kui on, loetle viimase poole aasta  iseseisvate eksperimentide teemad kui suudad</td>
             <td width="55%" align="right" class="options" ><div align="left"><? echo $line["k5"]; ?></div></td>
           </tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#0000FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">Kas õpetaja näitab demonstratsioonkatseid ja kui tihti</td>
             <td width="55%" align="right" class="options" ><div align="left"><? echo $line["k6"]; ?></div></td>
           </tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#0000FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%"> Loetle viimase poole aasta demonstratsioonkatsete teemad kui suudad</td>
             <td width="55%" align="right" class="options" ><div align="left"><? echo $line["k7"]; ?></div></td>
           </tr>
           <tr >
             <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td width="5%" bgcolor="#00FFFF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">BIOLOOGIA &otilde;petaja nimi</td>
             <td width="55%" align="right" class="options" >
                 <div align="left"><? echo $line["b1"]; ?></div></td></tr>
           <tr >
             <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#00FFFF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">Bioloogiatundide arv n&auml;dalas</td>
             <td width="55%" align="right" class="options" >
                 <div align="left"><? echo $line["b2"]; ?></div></td></tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#00FFFF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">Mitu bioloogia praktilist tööd oled teinud viimase poolaasta jooksul?</td>
             <td width="55%" align="right" class="options" >
                 <div align="left"><? echo $line["b3"]; ?></div></td></tr>
           <tr bgcolor="#E68A00">
             <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td bgcolor="#00FFFF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">Kui tehakse, loetle teemad kui suudad</td>
             <td width="55%" align="right" class="options" ><div align="left"><? echo $line["b4"]; ?></div></td>
           </tr>
           <tr >
             <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
           <tr>
             <td width="5%" bgcolor="#FF00FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
             <td class="options" width="40%">Millise aine koolitustel soovid osaleda: füüsika, keemia, bioloogia</td>
             <td width="55%" align="right" class="options" > <div align="left"><? echo $line["m1"]; ?> </div></td></tr>
           <tr >
             <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
           </tr>
  <td bgcolor="#FF00FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
      <td class="options" width="40%">Kirjuta m&otilde;ne s&otilde;naga miks soovid koolitusel osaleda?</td>
    <td width="55%" align="right" class="options" > <div align="left"><? echo $line["m2"]; ?> </div></td></tr>
  <tr bgcolor="#E68A00">
    <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td bgcolor="#FF00FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
    <td class="options" width="40%">Viimaste veerandite f&uuml;&uuml;sika hinded</td>
    <td width="55%" align="right" class="options" ><div align="left"><? echo $line["m3"]; ?></div></td>
  </tr>
  <tr bgcolor="#E68A00">
    <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td bgcolor="#FF00FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
    <td class="options" width="40%">Viimaste veerandite keemia hinded</td>
    <td width="55%" align="right" class="options" ><div align="left"><? echo $line["m4"]; ?></div></td>
  </tr>
  <tr bgcolor="#E68A00">
    <td colspan="3" bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td bgcolor="#FF00FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
    <td class="options" width="40%">Viimaste veerandite bioloogia hind</td>
    <td width="55%" align="right" class="options" ><div align="left"><? echo $line["m5"]; ?></div></td>
  </tr>
  <tr >
    <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td bgcolor="#FF00FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
    <td class="options" width="40%">Nimeta t&auml;iskasvanuid kes saaksid sind soovitada, anna  soovitajate kontaktid, eriala ja ametikoht</td>
    <td width="55%" align="right" class="options" ><div align="left"><? echo $line["m6"]; ?></div></td>
  </tr>
  <tr >
    <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td bgcolor="#FF00FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
    <td class="options" width="40%">Kui oled osalenud ol&uuml;mpiaadide piirkonna, v&otilde;i  vabariigi voorudes, ainev&otilde;istlustel siis m&auml;rgi v&otilde;istluse nimetus, toimumiskuu  ja aasta ning vanuser&uuml;hm, v&otilde;id lisada ka tulemuse</td>
    <td width="55%" align="right" class="options" ><div align="left"><? echo $line["m7"]; ?></div></td>
  </tr>
  <tr >
    <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td bgcolor="#FF00FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
    <td class="options" width="40%">Kui osaled huvikoolide, ringide t&ouml;&ouml;s palun loetle</td>
    <td width="55%" align="right" class="options" ><div align="left"><? echo $line["m8"]; ?></div></td>
  </tr>
  <tr >
    <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td bgcolor="#FF00FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
    <td class="options" width="40%">Kas osaled T&Uuml; Teaduskooli kursustel, kui siis  millistel</td>
    <td width="55%" align="right" class="options" ><div align="left"><? echo $line["m9"]; ?></div></td>
  </tr>
  <tr >
    <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td bgcolor="#FF00FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
    <td class="options" width="40%">Sinu hobid, huvialad</td>
    <td width="55%" align="right" class="options" ><div align="left"><? echo $line["m10"]; ?></div></td>
  </tr>
  <tr >
    <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td bgcolor="#FF00FF"><img src="../registreerimine/images/spacer.gif" width="20" height="10"><img src="../registreerimine/images/spacer.gif" width="10" height="10"></td>
    <td class="options" width="40%">Kui oled iseseisvalt teostanud m&otilde;ne huvitava f&uuml;&uuml;sika-  v&otilde;i keemiakatse, m&otilde;elnud v&auml;lja f&uuml;&uuml;sika- v&otilde;i keemia &uuml;lesande, teostanud m&otilde;ne  uurimust&ouml;&ouml;. Palun saada see v&otilde;i link sellele. (link, video, &uuml;lesanne, joonis  jne.)</td>
    <td width="55%" align="right" class="options" ><div align="left"><? echo $line["m11"]; ?></div></td>
  </tr>
  <tr >
    <td colspan="3"  bgcolor="#E68A00"><img src="../registreerimine/images/sinine.gif" width="1" height="1"></td>
  </tr>
         </table>
         </p>
         <? 
} 
}
?>
