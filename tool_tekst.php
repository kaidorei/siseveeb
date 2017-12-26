<? 

include("connect.php");
//include("authsys.php");	
//include ("auth.php"); 
include("globals.php");
$toolid=$_GET["toolid"];
$valjad=array("nmbr", "algus", "lopp", "isik_id","tegevus", "summa","staatus","allkiri");
$query="SELECT ".implode(",",$valjad)." FROM tooleht WHERE id=".$toolid;
$result=mysql_query($query);
$line=mysql_fetch_array($result); 

$query2="SELECT id,eesnimi, perenimi, isikukood, adr_kodu, a_num, sammas FROM isik WHERE id=".$line["isik_id"]." ORDER BY eesnimi;";
$result2=mysql_query($query2);
$var2=mysql_fetch_array($result2);

$query3="SELECT id,nimi,mille_eest FROM tooleht_liik WHERE id=".$line["tegevus"];
$result3=mysql_query($query3);
$var3=mysql_fetch_array($result3);

?><div align="center"> 
  <table width="622" border="0">
    <tr> 
      <td colspan="3"><div align="center"><img src="image/EFSkirjapea.jpg" width="636" height="81"></div></td>
    </tr>
    <tr> 
      <td colspan="3"><div align="center"> 
          <p><strong><br>
            T&Ouml;&Ouml;ETTEV&Otilde;TULEPING nr. <? echo $line["nmbr"];?> </strong></p>
        </div>
        <p align="justify"><strong>Eesti F&uuml;&uuml;sika Selts</strong> (edaspidi 
          nimetatud Tellija), asukohaga T&auml;he 4, Tartu linn, keda esindab 
          p&otilde;hikirja alusel juhatuse liige<strong> Arvo Kikas</strong> ja 
          <strong><? echo $var2["eesnimi"]," ",$var2["perenimi"]; ?></strong> 
          (edaspidi nimetatud T&ouml;&ouml;ettev&otilde;tja), isikukood <strong><? echo $var2["isikukood"];?></strong>, 
          elukoht <? echo $var2["adr_kodu"];?>, leppisid kokku allj&auml;rgnevas:</p>
        <p align="justify">1.T&ouml;&ouml;ettev&otilde;tja kohustub teostama allj&auml;rgneva 
          sisuga tellimust&ouml;&ouml;:<br>
          <strong><? echo $var3["mille_eest"];?></strong><br>
          T&ouml;&ouml;ettev&otilde;tja teostab k&auml;esoleva lepingu punktis 
          1 nimetatud t&ouml;&ouml; ajavahemikus <strong><? echo kuup($line["algus"]);?></strong> 
          kuni <strong><? echo kuup($line["lopp"]);?></strong>. T&ouml;&ouml;ettev&otilde;tja 
          poolt Tellijale k&auml;esoleva lepingu punktis 1 nimetatud t&ouml;&ouml; 
          &uuml;leandmise l&otilde;ppt&auml;htaeg on <strong><? echo kuup($line["lopp"]);?></strong>.<br>
          2.Tellija kohustub tasuma punktis 1 nimetatud tellimust&ouml;&ouml; 
          eest kokku <strong><?
		  	if($var2["sammas"]==1) $k=0.974; else $k=0.994;
			$temp =  ($line["summa"]/77)*23;
			$temp1=round(($temp+$line["summa"])/$k,0);
		 	echo $temp1;		  
		  ?> kr</strong>, millest arvestatakse 
          maha &uuml;ksikisiku tulumaks jt. kohustuslikud maksud Eesti Vabariigi 
          seadusandluses s&auml;testatud korras.<br>
          3.K&auml;esoleva lepingu punktis 1 nimetatud t&ouml;&ouml; tasustamine 
          toimub hiljemalt <strong><?
  
			$kuu=substr($line["lopp"],5,2);
			$paev=substr($line["lopp"],8,2);
			$aasta=substr($line["lopp"],0,4);
			$all = date("Y-m-d", mktime (0,0,0,$kuu+1 ,$paev,$aasta));
		  echo kuup($all);
		  
		  
		  ?></strong> . Tasu 
          kantakse t&ouml;&ouml;ettev&otilde;tja arvelduskontole nr. <strong><? echo $var2["a_num"];?></strong>.<br>
          4.Tellija kohustub arvestama ja maksma k&auml;esoleva lepingu alusel 
          teostatud t&ouml;&ouml; eest saadult tasult sotsiaalmaksu EV sotsiaalmaksuseaduses 
          s&auml;testatud alusel.<br>
          5.Tellija poolt annab t&ouml;&ouml; teostamiseks vajalikku informatsiooni, 
          kontrollib t&ouml;&ouml; n&otilde;uetele vastavust ning v&otilde;tab 
          t&ouml;&ouml; vastu<strong> Kaido Reivelt</strong>.<br>
          6.Juhul, kui t&ouml;&ouml; vastuv&otilde;tmisel on Tellijal pretensioone 
          kokkulepitud t&ouml;&ouml; suhtes, m&auml;&auml;rab Tellija T&ouml;&ouml;ettev&otilde;tjale 
          t&auml;htaja puuduste k&otilde;rvaldamiseks. Kui T&ouml;&ouml;ettev&otilde;tja 
          ei k&otilde;rvalda puudusi nimetatud t&auml;htajaks, on tellijal &otilde;igus 
          alandada &uuml;hepoolselt k&auml;esoleva lepingu punktis 3 kokku lepitud 
          tasu.<br>
          7.T&ouml;&ouml;ettev&otilde;tja on kohustatud rakendama k&otilde;ik 
          abin&otilde;ud Tellija poolt talle lepingu t&auml;itmiseks usaldatud 
          varade s&auml;ilimise ja legaalse kasutamise tagamiseks ning kohustub 
          h&uuml;vitama Tellijale tekitatud kahju seadusandlusega s&auml;testatud 
          korras.<br>
          8.Tellijal on &otilde;igus l&otilde;petada k&auml;esolev leping m&otilde;juvatel 
          p&otilde;hjustel igal ajal, tasudes T&ouml;&ouml;ettev&otilde;tjale 
          n&otilde;uetekohaselt teostatud t&ouml;&ouml;de eest.<br>
          9.K&auml;esoleva lepingu t&auml;itmisel tekkinud vaidlused lahendatakse 
          l&auml;bir&auml;&auml;kimiste teel. Kokkuleppe mittesaavutamisel lahendatakse 
          vaidlused Eesti Vabariigi seadusandlusega s&auml;testatud korras.<br>
          10.K&auml;esoleva lepingu muudatused j&otilde;ustuvad peale nende allakirjutamist 
          m&otilde;lema poole poolt allakirjutamise momendist v&otilde;i poolte 
          poolt kirjalikult m&auml;&auml;ratud t&auml;htajal.<br>
          11.Kumbki poolt ei tohi k&auml;esolevast lepingust tulenevaid &otilde;igusi 
          ja kohustusi &uuml;le anda kolmandatele isikutele ilma teise poole n&otilde;usolekuta.<br>
          12.K&auml;esolev leping on koostatud kahes identses, v&otilde;rdset 
          juriidilist j&otilde;udu omavas eksemplaris, millest &uuml;ks antakse 
          T&ouml;&ouml;ettev&otilde;tjale ja teine Tellijale.<br>
          13.K&auml;esolev leping j&otilde;ustub <strong><? echo kuup($line["algus"]);?></strong> 
          ja kehtib kuni lepingupooled on t&auml;itnud oma lepinguj&auml;rgsed 
          kohustused.</p></td>
    </tr>
    <tr> 
      <td width="309" valign="top"> <p align="justify">&nbsp;</p>
        <p align="justify">TELLIJA <br>
          Eesti F&uuml;&uuml;sika Selts<br>
          Reg. Nr. 80046424<br>
          <br>
          <br>
          Arvo Kikas<br>
          EFS juhatuse liige</p></td>
      <td width="196" valign="top"><p>&nbsp;</p>
        <p>T&Ouml;&Ouml;ETTEV&Otilde;TJA<br>
          <br>
          <br>
          <br>
          <br>
          <? echo $var2["eesnimi"]," ",$var2["perenimi"]; ?> </p></td>
      <td width="123" valign="top"><p>&nbsp;</p>
        <? echo kuup($line["allkiri"]);?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp; </p>
</div>
