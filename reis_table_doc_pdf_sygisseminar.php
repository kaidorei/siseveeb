<?
include("connect.php");
require('kas_on_lubatud_siseveebi.php');
include("globals.php");


// Require the class
require_once dirname(__FILE__) . '/h2p/HTML_ToPDF.php';
require_once dirname(__FILE__) . '/h2p/PDFEncryptor.php';
// Create a unique filename for the resulting PDF
$linkToPDF = tempnam(dirname(__FILE__), 'PDF-');
// Remove the temporary file it creates
//unlink($linkToPDFFull);
// Give it an extension
//$linkToPDFFull .= '.pdf';
$linkToPDF .= '.pdf';
// Make it web accessible
$linkToPDF = basename($linkToPDF);
$defaultDomain = 'www.fyysika.ee/omad';







$reisid=$_GET["reisid"];
//$reisid=765;

if (!$reisid) {
    die("mis on reisi nimi ...");
}
else
{
echo $reisid;
}


// Kes kohal olid ...
		$query01="SELECT * FROM reis_isik WHERE oid1=".$reisid." ORDER BY id";
		$result01=mysql_query($query01);
		while($line01=mysql_fetch_array($result01))
		{
			
			$line_rida=array();
			$query02="SELECT * FROM isik WHERE id=".$line01['oid2'];
			$result02=mysql_query($query02);
			$line02=mysql_fetch_array($result02);		
			$query00="SELECT * FROM isik_kool WHERE oid1=".$line01['oid2'];
			$result00=mysql_query($query00);
//			echo $query00;
			while($line00=mysql_fetch_array($result00)) // st üks inimene võib olla mitmest koolist ...
			{
				$query03="SELECT * FROM kool WHERE id=".$line00['oid2']."";
//				echo $query03;
				$result03=mysql_query($query03);
				$line03=mysql_fetch_array($result03); 
				$linkToPDFFull = "pdfs/".$reisid."/toend_sygisseminar_".urlencode($line02['perenimi'])."_".urlencode($line03['nimi']).".pdf";
				
ob_start();
			
				
				?>
				<html>
				<head>
  				<title>EFS2009</title>
				<style type="text/css">
				
				
				  div.noprint {
					display: none;
				  }
				  h6 {
					font-style: italic;
					font-weight: bold;
					font-size: 14pt;
					font-family: Courier;
					color: blue;
				  }
				  h1 {
					font-weight: bold;
					font-size: 24pt;
					font-family: Georgia;
				  }
				  body {
					font-size: 14pt;
					font-family: Georgia;
}				  /** Change the paper size, orientation, and margins */
				  @page {
					size: 8.5in 14in;
					orientation: portrait;
				  }
				  /** This is a bit redundant, but its works ;) */
				  /** odd pages */
				  @page: right {
					margin-right: 1.0cm;
					margin-left: 1.0cm;
					margin-top: 1.0cm;
					margin-bottom: 1.0cm;
				  }
				  /** even pages */
				  @page: left {
					margin-right: 1.0cm;
					margin-left: 1.0cm;
					margin-top: 1.0cm;
					margin-bottom: 1.0cm;
				  }
				  </style>
				</head>
				<body>
				<table align="center" width="100%" border="0">
				  <tr>
					<td colspan="2"><div align="center" ><img src="http://www.fyysika.ee/omad/image/EFSkirjapea.jpg" alt="pea" width="650" height="89" /></div></td>
				  </tr>
				  <tr>
					<td width="23%" height="51"><span ><em><br />
						<strong><? echo $line03['nimi']; ?></strong><br />
					  
					<? echo $line03['aadress']; ?></em></span></td>
					<td width="77%" valign="bottom"><div align="right" >12. novembril.2009</div></td>
				  </tr>
				  <tr>
					<td height="38" colspan="2"><div align="center" >
					  <h1>&nbsp; </h1>
					  <h1><br>
					    T&otilde;end</h1>
					  <p>&nbsp;</p>
					  </div></td>
				  </tr>
				  <tr>
					<td colspan="2"><p align="justify" class="h6"><body>K&auml;esolevaga  kinnitame, et teie kooli f&uuml;&uuml;sika&otilde;petaja, <strong><? echo $line02['eesnimi'];?> <? echo $line02['perenimi']; ?></strong>, osales Voore Puhkekeskuses 6.-7.novembril toimunud &uuml;leriigilisel  f&uuml;&uuml;sika&otilde;petajate s&uuml;gisseminaril ning l&auml;bis 16 tunni mahus koolitust. </p>
					  <h2 align="justify" >P&auml;evakava</h2>
					  <p><strong>Reede, 6.november</strong><br>
					    14.00 EFS tegevuse tutvustus (Kaido Reivelt)&nbsp;<br />
  14.20 F&uuml;&uuml;sikahariduse maastik Eestis, olukord ja perspektiivid (Henn Voolaid, Karin Laansalu-Veskioja, Kaido Reivelt)<br />
  15.30 Virtuaal&otilde;pe ja 21.sajandi kool - m&uuml;&uuml;did ja tegelikkus (Kaido Reivelt, Taavi Adamberg)<br />
  16.00  Kuidas tegeleda f&uuml;&uuml;sika-andekate lastega - plaanid, praktika ja eksperimendid&nbsp;(Eero Uustalu, Kaido Reivelt)<br />
  19.00&nbsp; F&uuml;&uuml;sika&otilde;petajate v&otilde;rgustiku arendamisest, kus me oleme ja mida oleks vaja teha, ettekanne ja diskussioon, vestlusringid, seltskondlik tegevus (Kaido Reivelt, Riina Leet)</p>
					  <p>&nbsp;</p>
					  <p><strong>Laup&auml;ev, 7.november</strong><br>
					    9.30Uute p&otilde;hikooli ja g&uuml;mnaasiumi f&uuml;&uuml;sika &otilde;ppekava koostamise l&auml;hte&uuml;lesanne (Jaak J&otilde;gi, Riina Leet, Kalev Tarkpea), 2009.a. l&auml;bi viidud k&uuml;sitluse tulemustest (Jaan Paaver)&nbsp;<br />
  9.45 Uus p&otilde;hikooli &otilde;ppekava - tutvustus ja diskussioon (Jaak J&otilde;gi, Riina Leet)<br />
  10.45 P&otilde;hikooli &otilde;ppekava eksperimendid (Koit Timpmann)&nbsp;<br />
  12.00 Uus g&uuml;mnaasiumi &otilde;ppekava - tutvustus ja diskussioon (Kalev Tarkpea)<br />
  13.00 T&ouml;&ouml; r&uuml;hmades<br />
  14.00 Kokkuv&otilde;tted&nbsp;</p>
				    </td>
				  </tr>
				  <tr>
					<td colspan="2"><p >Lugupidamisega,<br />
					  Kaido Reivelt <br />
					  EFS juhatuse esimees<br />
					  T&Uuml; F&uuml;&uuml;sika Instituudi &otilde;ppedirektor <br />
					  kaido@fyysika.ee<br>
					  <img src="http://www.fyysika.ee/omad/image/image004.jpg" /></p>
					  <p>
					    
				        <img src="http://www.fyysika.ee/omad/image/Programmi_logo.jpg" alt="logo" width="400" height="82" align="right" /></p></td>
				  </tr>
				</table>

</body>
</html>
				
				
				
				
				<?
			?>
			




<?php

// Send the class our HTML and the defaultDomain for images, css, etc.
$pdf =& new HTML_ToPDF(ob_get_contents(), $defaultDomain);
// We won't be sending out the HTML to the user
ob_end_clean();
echo $linkToPDFFull,"<br>";
$pdf->setDefaultPath('/pdfs/'.$reisid.'/');
// Could turn on debugging to see what exactly is happening
// (commands being run, images being grabbed, etc.)
// $pdf->setDebug(true);
// Convert the file
$result = $pdf->convert();
// Check if the result was an error
if (is_a($result, 'HTML_ToPDFException')) {
    die($result->getMessage());
}
else {
    // Move the generated PDF to the web accessible file
    copy($result, $linkToPDFFull);
    unlink($result);
    // Set up encryption
    $encryptor =& new PDFEncryptor($linkToPDFFull);
    // Set paths
    $encryptor->setJavaPath('/usr/lib/j2se/1.4/bin/java');
    $encryptor->setITextPath(dirname(__FILE__) . '/../lib/itext-1.3.jar');
    // Set meta-data
    $encryptor->setAuthor('Kaido Reivelt');
    $encryptor->setKeywords('EFS tunnistus');
    $encryptor->setSubject('Osalemise kohta');
    $encryptor->setTitle('EFS tunnistus');
    // Set permissions
    $encryptor->setAllowPrinting(false);
    $encryptor->setAllowModifyContents(false);
    $encryptor->setAllowDegradedPrinting(true);
    $encryptor->setAllowCopy(true);
    // Set password
    $encryptor->setUserPassword('foobar');
    $encryptor->setOwnerPassword('barfoo');
    $result = $encryptor->encrypt();
    if (is_a($result, 'PDFEncryptorException')) {
//        die($result->getMessage());
    }
}

}
}
$count++;

// ------------- peagrupi exponaat -----------
?>

