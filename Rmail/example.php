<?php
    /**
    * o------------------------------------------------------------------------------o
    * | This package is licensed under the Phpguru license. A quick summary is       |
    * | that for commercial use, there is a small one-time licensing fee to pay. For |
    * | registered charities and educational institutes there is a reduced license   |
    * | fee available. You can read more  at:                                        |
    * |                                                                              |
    * |                  http://www.phpguru.org/static/license.html                  |
    * o------------------------------------------------------------------------------o
    *
    * � Copyright 2008,2009 Richard Heyes
    */

    require_once('Rmail.php');
    
    $mail = new Rmail();

    /**
    * Set the from address of the email
    */
    $mail->setFrom('Kaidor <efs@fyysika.ee>');
    
    /**
    * Set the subject of the email
    */
    $mail->setSubject('Test email');
    
    /**
    * Set high priority for the email. This can also be:
    * high/normal/low/1/3/5
    */
    $mail->setPriority('high');

    /**
    * Set the text of the Email
    */
    $mail->setText('Sample text');
    
    /**
    * Set the HTML of the email. Any embedded images will be automatically found as long as you have added them
    * using addEmbeddedImage() as below.
    */
    $mail->setHTML('<link href="http://www.fyysika.ee/images/F.ico" rel="Shortcut Icon">
<html>

<head>
<title>EFS kuukiri: jaanuar 2010</title> <meta content="text/html; charset=windows-1257" http-equiv="Content-Type"> <style type="text/css">
<!--
.kiri_vaike {
font-family: Arial, Helvetica, sans-serif;
font-size: 11px;
color: rgb(51, 51, 51);
}
.kiri_pealkiri {
font-family: Arial, Helvetica, sans-serif;
font-size: 18px;
color: rgb(98, 100, 105);
}
.kiri {
font-family: Arial, Helvetica, sans-serif;
font-size: 12px;
font-weight: 400;
color: rgb(76, 76, 76);
margin-top: 10px;
}
.kiri_kuup {
font-family: Arial, Helvetica, sans-serif;
color: rgb(76, 76, 76);
font-size: 16px;
}
.style1 {
font-family: Arial, Helvetica, sans-serif;
font-size: 18px;
color: rgb(98, 100, 105);
text-align: center;
}
.style3 {
font-family: Arial, Helvetica, sans-serif;
font-size: 12px;
font-weight: 400;
color: rgb(76, 76, 76);
margin-top: 10px;
text-align: center;
}
.style4 {
text-align: center;
}
-->
</style>
<body bgcolor="#eeeeee" text="#000000">

<table align="center" bgcolor="#FFFFFF" border="0" cellpadding="3" 
cellspacing="0" width="656">
<tr>
<td bgcolor="#eeeeee" class="kiri_pealkiri" colspan="2"> <div align="center"> <span class="kiri_vaike">Kui sa ei n�e seda kirja korrektselt, siis kasuta oma veebisirvikut, selleks kliki <a href="http://www.fyysika.ee/doc/kuukiri_2010_jaan/">siia</a>. </span></div> </td> </tr> <tr> <td bgcolor="#FFFFFF" class="kiri_pealkiri" colspan="2"> <div align="right"> <img alt="banner" height="69" src="fyysika_banner.jpg" width="650"><br> </div> <div align="right"> </div> </td> </tr> <tr> <td bgcolor="#FFFFFF" class="kiri_kuup" width="394"> <span class="kiri_kuup">Eesti F��sika Seltsi kuukiri </span></td> <td bgcolor="#FFFFFF" class="kiri_kuup" width="250"> <div align="right"> <span class="kiri_kuup">jaanuar 2010</span></div> </td> </tr> <tr> <td bgcolor="#CCCCCC" class="kiri_pealkiri" colspan="2">Eess�na</td> </tr> <tr> <td bgcolor="#FFFFFF" class="kiri" colspan="2">Kohalikud uudised ja teated:
<ul>
<li>
<p class="kiri" style="margin-left: 15px; margin-right: 15px">T� F��sika Instituut koost��s T� rektoraadiga on l�bi kaalunud k�ik v�imalused Tartu �likooli F��sikumi v�ljaarendamiseks ning leidis, et k�ige sobivam FI asukoht on <strong>Viljandi mnt 42</strong> krunt. Maarjam�isa linnakus paiknemine on funktsionaalsust ja interdistsiplinaarsust arvestades F��sika Instituudile (FI) v�ga kasulik, sest linnakusse on koondunud enamus sidusvaldkondadest : keemia- ja materjaliteadus, biomeditsiin, keskkonnatehnoloogia.
<a href="http://www.fyysika.ee/uudised/?p=1367">Loe pikemalt.</a> </p> </li> <li> <p class="kiri" style="margin-left: 15px; margin-right: 15px"> <strong>Eesti F��sika Selts</strong> palub esitada <strong>EFS aastapreemia, aukirja, �li�pilaspreemia</strong> ja <strong>�pilaspreemia</strong> kandidaate.
    <a href="http://www.fyysika.ee/efs/autasud/" target="_blank">Preemiate statuudid on �leval EFS kodulehel. </a><br>
    <br>
<strong>Materjalide esitamise t�htaeg on 15. veebruar 2010.a. </strong>EFS 2010.a. �ldkogu toimub 22.03.2010.</p>
</li>
</ul>
<p align="right" class="kiri">
<a class="kiri" href="http://www.fyysika.ee/teated">Vaata ka FYYSIKA.EE kalendrit</a> </p> </td> </tr> <tr> <td bgcolor="#CCCCCC" class="kiri_pealkiri" colspan="2">Kalendrijutt</td> </tr> <tr> <td bgcolor="#FFFFFF" class="kiri" colspan="2"> <p class="kiri" style="margin-left: 15px; margin-right: 15px">Kirjastuse Elsevier arvutiv�rkude, -raudvara ja ?arhitektuuri alaseid artikleid publitseerivate teadusajakirjade seas hetkel k�rgeima impact factor?iga ajakirjas Microelectronic Engineering ilmus Indrek J�gi artikkel, [Microel. Eng. 87(2), 2010, 144-149] <br></p> <p class="style1" style="margin-right: 15px">Atomic layer deposition of high capacitance density Ta2O5-ZrO2 based dielectrics for metal-insulator-metal structures <br> 
<span class="kiri">Indrek J�gi, Kaupo Kukli, Mikko Ritala, Markku Leskel�, Jaan Aarik, Aleks Aidla ja Jun Lu </span></p> 
    <table cellspacing="1" style="width: 100%"> <tr> <td> <p class="kiri" style="margin-left: 15px; margin-right: 15px">T��s k�sitleti v�rdlevalt erinevatele aatomkihtsadestatud metalloksiididele ? HfO2, Ta2O5, ZrO2, Nb2O5 ja nende segukiledele v�i kistuktuuridele
(nanolaminaatidele) ? ehitatud metall-isolaator-metall (MIM) kondensaatorite dielektrilist k�itumist. HfO2 kui �sna k�rge suhtelise dielektrilise l�bitavusega (ca. 16-24) isolaatormaterjal on end t�estanud ja kaasaaegses protsessoritehnoloogias transistoride paisuoksiidina juba kasutusel.
v�ib T�nap�eva v�ljakutseks v�ib pidada vajadust see oksiid edaspidi asendada v�i kombineerida teiste, k�rgema dielektrilise konstandiga (ca. 25-50) materjalidega nii, et t�useks k�ll keskmine dielektriline l�bitavus, kuid v�iksemast keelutsoonist p�hjustatud lekkevool samas mitte dramaatiliselt. Isolaatormaterjalide kvaliteeti iseloomustav parameetriks on nn. Laengus�ilitustegur, mis h�lmab endas teatud kriitilise lekkevoolu v��rtusel m��detud pinge ja mahtuvuse. Varasemad uuringud olid n�idanud, et paksemate (kuni 100 nm) nanolaminaatide kasutamisel on v�imalik Ta2O5-ZrO2 laminaatide baasil saavutada
HfO2 oluliselt suurem laengus�ilitustegur. �sja avaldatud t�� k�igus sooritatud m��tmised n�itasid, et �hemate kilede korral j��b laengus�ilitustegur suure t�en�osusega ja �ldjuhul siiski alla HfO2 poolt kindlustatavatele.
Siiski, suhteliselt keeruka koostisega lamineeritud Ta2O5-ZrxNbyOz kihid v�istlesid edukalt ka HfO2-ga. T�� tulemused osundavad probleemidele uute dielektrikmaterjalide otsingutel ja t��tlusel ning annavad loodetavasti oma panuse �ldisesse teabesse ka arvutim�ludesse sobivate materjalide evaluatsiooni alal.<a href="http://www.fyysika.ee/doc/kuukiri_2010_jaan/MicroelectronEng2010_87_144.pdf"> Vaata ka artiklit</a>.
</p>
          <p class="kiri" style="margin-left: 15px; margin-right: 15px"><span class="kiri"><span lang="ET"><img height="190" src="Image2.gif" width="588" alt="Kile TEM ja C-V">
            </span></span><br>
            Joonisel:L�bilaskvuselektronmikroskoobi kujutis mol�bdeenelektroodile aatomkihtsadestatud dielektrikkihist (vasakpoolsel paneelil) ja voltfaradkarakteristikud ning dielektrilised kaod (D) m��detuna sarnasest kilest (parempoolsel paneelil). Kilede koostis sadestust�klite arvu j�rgi ning m��tesagedused on n�idatud paneelidel.<br>
          </p></td> </tr> </table> </td> </tr> <tr> <td bgcolor="#CCCCCC" class="kiri_pealkiri" colspan="2">Uudiseid maailmast</td> </tr> <tr> <td bgcolor="#FFFFFF" class="kiri" colspan="2"> <p class="kiri" style="margin-left: 30px; margin-right: 15px"><strong> <a href="http://www.fyysika.ee/uudised/?p=1349">Wi-Fi aitab l�bi seinte n�ha </a></strong><br>M�te l�bi seinte n�gemisest on ulmes�pru juba ammu paelunud, kuid t�nap�eval on sellest fantaasiast saanud reaalsus, mida agaralt uuritakse.&nbsp; Kaks Utah �likooli teadlast on katsega n�idanud, et niisuguseks j�lgimiseks ei ole kaugeltki vaja hirmkallist ja -salajast militaartehnoloogia viimast s�na. Veidi liialdades v�ib �elda, et &quot;lutikad&quot; on Wi-Fi seadmete kujul juba meie �mber paigutatud ja luuramiseks tuleb vaid nende signaali �igesti t�lgendada.&nbsp; <a href="http://www.fyysika.ee/uudised/?p=1349">Loe
edasi...</a><br>Allikas:
<a
href="http://arxiv.org/abs/0909.5417">http://arxiv.org/abs/0909.5417</a></p>
    <p class="kiri" style="margin-left: 30px; margin-right: 15px"><br>
    </p></td>
</tr><tr> <td bgcolor="#FFFFFF" class="kiri" colspan="2" style="height: 20px"> <p class="kiri" style="margin-left: 30px; margin-right: 15px"><strong> <a href="http://uwnews.org/article.asp?articleID=54791">Washingtoni
�likooli
uurimus heidab valgust k��busgalaktikate kujunemisele</a> </strong><br> </p> </td> </tr><tr> <td> <p class="kiri" style="margin-left: 30px; margin-right: 15px">P�rast miljonite superarvutite simulatsiooni tundide on Washingtoni �likooli astronoomi Fabio Governato juhitud t��grupp t�en�oliselt leidnud lahenduse anomaaliale, mis on seniajani kimbutanud �le 20 aasta tagasi avaldatud k�lma tume aine teooriat.
1984.aastal kolme USA f��siku poolt avaldatud teooria suudab ��rmiselt edukalt seletada, miks galaktikad ning t�heparved ei paikne t�nap�evases univerumis mitte �htlaselt vaid pigem k�rgstruktuurina. Selle kohaselt kujunes universumi struktuur j�rk-j�rguliselt ? v�iksed osakesed p�rkusid ning �hinesid �ksteisega j�rjest suuremateks gravitatsioonilise vastastikm�ju t�ttu. Teooria suutis h�mmastavalt h�sti seletada kus, kui palju ja millal galaktikad kujunesid, ent sellel oli �ks puudus ? see ei suutnud seletada k��busgalaktikate olemasolu.
Selle asemel ennustas viimane, et suurtes galaktikates peaks olema tunduvalt rohkem t�hti ning tume ainet. Fabio Covernato, aga viis rahvuslikes superarvutuskeskustes l�bi uued, paremate algandmetega arvutisimulatsioonid, mis v�tsid arvesse, et kus ja kuidas t�htede kujunemine galaktikas t�pselt aset leidis ja j�reldas, et... <a href="http://www.fyysika.ee/uudised/?p=1379">loe edasi.</a>
<br>Allikas: <a
href="http://uwnews.org/article.asp?articleID=54791">Washingtoni
�likooli pressiteade 13.jaan.2010</a></p> </td> <td class="style4"> <img alt="Suurem��tmeline kosmiline struktuur" height="226" 
margin-right:25px="" src="cen_scdm_32mpc1-300x300.jpg" width="226"><p class="style3" style="width: 222px"> Suurem��tmelise kosmilise struktuuri kujunemist kirjeldava simulatsiooni l�pptulemus v�ttes aluseks k�lma tume aine teooria. Allikas: NASA </p> </td> </tr>
<tr>
<td bgcolor="#CCCCCC" class="kiri_pealkiri" colspan="2">Pikemad artiklid meilt ja mujalt</td> </tr> <tr> <td bgcolor="#FFFFFF" class="kiri" colspan="2" style="height: 20px"> <p class="kiri" style="margin-left: 30px; margin-right: 15px"><strong> <a href="http://www.fyysika.ee/teadus/eksoplaneedid/">Michael R. Meyer: Kuidas planeedid tekivad?</a> </strong><br> 
  </p> </td> </tr>  <tr> <td class="kiri"> <p class="kiri" style="margin-left: 30px; margin-right: 15px">K�ik, kes on kunagi kooki k�psetanud ja k�psetuspulbri asemel   s��gisoodat kasutanud, teavad kui t�htis on omada �iged koostisained. Sama   reegel peab paika ka planeetide tekkimise puhul. Planeedid koosnevad osakestest,   mis on noore t�he �mber p��rlevas kosmilise tolmu kettas omavahel kokku   sulandunud - kui t�ht p��rleva gaasi- ja tolmupilve gravitatsioonilise kollapsi   tagaj�rjel tekkis, j�i see materjal lihtsalt �le. Seet�ttu peaks kettas, kus   planeedid tekivad, olema algselt sama gaasi ja tolmu masside suhe kui   t�htedevahelises aines ehk 100 : 1. Loogiliselt v�ttes peaks ka ketta   elemendiline koostis olema sama mis t�hel ning peegeldama selle galaktikaosa   algseid tingimusi.</p>
    <p class="kiri" style="margin-left: 30px; margin-right: 15px"><a href="http://www.fyysika.ee/teadus/eksoplaneedid/">Loe edasi ... </a></p>    
    <p class="kiri" style="margin-left: 30px; margin-right: 15px">&nbsp;</p> </td> <td valign="top" class="style4"><img src="clip_image002_0000.gif" alt="planeedid" width="226" height="182">
  <p class="style3" style="width: 222px">Teema variatsioonid</p> </td> </tr> <tr> <td bgcolor="#CCCCCC" class="pealkiri" colspan="2"> <span class="kiri_pealkiri">BLOGI - november 2009</span> </td> </tr> <tr> <td class="kiri" colspan="2" style="padding-left: 30px; padding-right: 
15px">
<br><strong>23.01.2010:</strong>&nbsp; Eesti GLOBE koolide suvelaager 2010.
aastal toimub 4-p�evase ekspeditsioonina 2.-5. augustil J�neda M�isa Turismikeskuses
(http://www.janedaturism.ee/) J�nedal. T�psemat infot laagri kohta anname edaspidi laagri l�henemisel. <br><br><strong>19.01.2010:</strong> Delfis ilmus lugu &quot;<a href="http://www.delfi.ee/news/paevauudised/arvamus/article.php?id=28585227" 
target="_blank">J�ri
Saar: Meedia toetagu teaduslikku maailmapilti</a>&quot;. FYYSIKA.EE ohkab ja �hineb. Kui sellest probleemistikust midagi positiivset otsida, siis v�iks ju �elda, et pimedate maailmas on n�gijatel hea elada.&nbsp; Aga see on v�ike lohutus, kui �hel p�eval vihased rahvamassid k�ik teadlased n�idadeks v�i valestim�tlejateks tembeldavad ning tuleriidale ajavad.<br><br>
<strong>18.01.2010: </strong>Britid arutlesid teaduse ja meedia tuleviku �le ja avaldasid uurimuse <a href="http://interactive.bis.gov.uk/scienceandsociety/site/wp-content/uploads/2010/01/Science-and-the-Media-Securing-the-Future.pdf" 
target="_blank">
Science and the Media - Securing the Future</a>, mille on allkirjutanud Lord Drayson (�hendkuningriigi teadusminister). Dokumendi koostas ekspertr�hm, mida juhtis Fiona Fox , Science Media Centre
juht.<br><br><strong>15.01.2010:
<a href="http://www.fyysika.ee/uudised/?p=1365">Valitsus kinnitas uued p�hikooli ja g�mnaasiumi riiklikud �ppekavad </a><br></strong>Valitsus kinnitas
14.01.2009 istungil haridus- ja teadusministri esitatud uued p�hikooli ning g�mnaasiumi riiklikud �ppekavad, millele �leminek algab 2011. aasta s�gisel.
Uute f��sika g�mnaasiumi ja p�hikooli �ppekavade kallal on tublisti vaeva n�htud ja tegijate lootus on, et uus kava on sai parem kui vana. Aga m��rava t�htsusega on loomulikult j�rgnev periood, kus uus �ppekava peab saama sisu �pikutena, laborit��dena, t��vihikutena ja e-�ppe materjalidena. <br>
<br><strong>12.01.2010:
<a href="http://www.fyysika.ee/uudised/?p=1360">Eesti teaduse infrastruktuuride
teekaart</a><br></strong>Haridus- ja Teadusministeerium on koost��s Eesti Teaduste Akadeemiaga k�ivitanud Eesti teaduse infrastruktuuride teekaardi koostamise. Eesti ja maailma teaduse arengusuundumustest l�htuvalt kaardistatakse olemasolevate teaduse infrastruktuuride kaasajastamisvajadusi ning initsiatiive uute infrastruktuuride loomiseks. Teekaartiplaanitakse t�iendata regulaarselt
3-5 aasta tagant.<br><br><strong>07.01.2010:<a
href="http://www.fyysika.ee/omad/F��sik%20peab%20musta%20augu%20hirmu%20asjatuks" 
target="_blank">Tartu
PM:&nbsp; F��sik peab musta augu hirmu asjatuks</a></strong>
<br> </td> </tr> <tr> <td bgcolor="#CCCCCC" class="kiri_pealkiri" colspan="2">Vastsed videod, demoeksperimendid, �piobjektid</td> </tr> <tr> <td class="kiri" colspan="2"> <table border="0" width="100%"> <tr> <td class="style3" valign="top" width="25%"> <a href="http://www.fyysika.ee/opik/index.php?tase=asi&amp;idex=1238&amp;idse=8525"><img src="1238.JPG" width="150" height="120" border="0"></a><br>
Vesiniku aatomi mudel klassikalises ja kvantteoorias</td> <td class="style3" valign="top" width="25%"> <a href="http://www.fyysika.ee/opik/index.php?tase=asi&amp;idex=1239&amp;idse=8526"><img src="1239.JPG" width="150" height="120" border="0"></a><br>
Kuidas t��tab laser</td>
<td class="style3" valign="top" width="25%"> <a href="http://www.fyysika.ee/opik/index.php?tase=asi&amp;idex=1234&amp;idse=8524"><img src="1234.JPG" width="150" height="120" border="0"></a><br>
P�ikeses�steemi mudel</td>
<td class="style3" valign="top" width="25%"><a href="http://www.fyysika.ee/opik/index.php?tase=asi&idex=1252&idse=8532"><img src="1252.JPG" width="150" height="120" border="0"></a>Kumerl��tse fookuskauguse s�ltuvus l��tse pindade kumerusest</td>
</tr><tr> <td class="style3" valign="top" width="25%"> <a href="http://www.fyysika.ee/opik/index.php?tase=asi&idex=1253&idse=8533"><img src="1253.JPG" width="150" height="120" border="0"></a><br>
N�gusl��ts: kiirte hajumine</td> <td class="style3" valign="top" width="25%"> <a href="http://www.fyysika.ee/opik/index.php?tase=asi&idex=1254&idse=8542"><img src="1254.JPG" width="150" height="120" border="0"></a><br>
�he pilu difraktsioon (erinevate ava laiustega)</td>
<td class="style3" valign="top" width="25%"> <a href="http://www.fyysika.ee/opik/index.php?tase=asi&idex=1255&idse=8543"><img src="1255.JPG" width="150" height="120" border="0"></a><br>
Newtoni r�ngad: tutvustus, peegeldunud valgus</td>
<td class="style3" valign="top" width="25%"><a href="http://www.fyysika.ee/opik/index.php?tase=asi&idex=1256&idse=8541"><img src="1256.JPG" width="150" height="120" border="0"></a>Newtoni r�ngad: l�biv valgus</td>
</tr>
</table>
</td>
</tr>
<tr>
<td bgcolor="#CCCCCC" class="kiri_pealkiri" 
colspan="2">Terminoloogiauuendused</td>
</tr>
<tr>
<td class="kiri" colspan="2" style="padding-left: 30px; padding-right: 
15px">
Pidevalt uueneva inglise-eesti-inglise f��sika s�naraamatu leiad siit <a href="http://www.fyysika.ee/sonaraamat">www.fyysika.ee/sonaraamat</a>. J�rgnevates kuukirjades hakkame Seltsi v�rsketest s�naraamatu t�iendustest ka kuukirja kaudu informeerima. 
</td>
</tr>
<tr>
<td colspan="2">
<table border="0" width="100%">
<tr>
<td bgcolor="#CCCCCC" class="kiri_pealkiri">Meelespea!</td>
</tr>
<tr>
<td class="kiri" style="padding-left: 30px; padding-right: 15px"> Kui Teil on liikmemaks juhtumisi veel tasumata, siis seda on v�imalik ka teha panga�lekandega 1120073071, Swedpank. Liikmemaksu suurused on 200 kr. ja pension�ridele/�ppuritele 30 kr. Tasumisel m�rkige kindlasti selgitusse �ra, et tegemist on liikmemaksuga. </td> </tr> </table> </td> </tr> <tr> <td bgcolor="#eeeeee" class="kiri" colspan="2"> <div align="center"> Kirjuta meile efs@fyysika.ee. Kui te ei soovi enam seda veebiajakirja saada, siis saada palun sellekohane e-mail. <br>Meie postiaadress: EFS, Riia 142, 51014 Tartu. </div> </td> </tr> </table>

</body>
</head>

</html>

');
    
    /**
    * Set the delivery receipt of the email. This should be an email address that the receipt should be sent to.
    * You are NOT guaranteed to receive this receipt - it is dependent on the receiver.
    */
    $mail->setReceipt('kaidor@fi.tartu.ee');
    
    /**
    * Add an embedded image. The path is the file path to the image.
    */
    $mail->addEmbeddedImage(new fileEmbeddedImage('background.gif'));
    
    /**
    * Add an attachment to the email.
    */
    $mail->addAttachment(new fileAttachment('example.zip'));

    /**
    * Send the email. Pass the method an array of recipients.
    */
    $address = 'kaido@fyysika.ee';
    $result  = $mail->send(array($address));
?>

Email has been sent to <?=$address?>. Result: <? var_dump($result)?>