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
					<td colspan="2"><p align="justify" class="h6"><body>K&auml;esolevaga  kinnitame, et teie kooli &otilde;petaja, <strong><? echo $line02['eesnimi'];?> <? echo $line02['perenimi']; ?></strong>, osales Tartus 13.-14.novembril toimunud &uuml;leriigilisel  GLOBE &otilde;petajate seminaril ning l&auml;bis 16 tunni mahus koolitust. </p>
					  <h2>Programm</h2>
					  <table border="0" cellspacing="0" cellpadding="0" width="100%">
					    <tbody><tr><td colspan="3"><strong>Reede, 13. november</strong></td>
					    </tr><tr><td width="88"><p align="left"><strong>aeg</strong></p></td><td width="324"><p align="left"><strong>&nbsp;</strong></p></td><td width="116"><p align="left"><strong>koht</strong></p></td></tr><tr><td width="88"><p align="left">16.00-16.45</p></td><td width="324"><p align="left">GLOBE programm</p></td><td width="116"><p align="left">Tähe 4-410</p></td></tr><tr><td width="88"><p align="left">16.45-17.45</p></td><td width="324"><p align="left">atmosfäärimõõtmiste koolitus</p></td><td width="116"><p align="left">Tähe 4-410</p></td></tr><tr><td width="88"><p align="left">17.45-17.55</p></td><td width="324"><p align="left">kohvipaus</p></td><td width="116"><p align="left">Tähe 4-410</p></td></tr><tr><td width="88"><p align="left">17.55- 18.45</p></td><td width="324"><p align="left">arvutikoolitus- andmeedastus</p></td><td width="116"><p align="left">Tähe 4-145</p></td></tr><tr><td colspan="3"><br /><strong>Laupäev, 14. november</strong></td></tr><tr><td width="88"><strong>aeg</strong> </td><td width="324"><p align="center"><strong>&nbsp;</strong></p></td><td width="116"><p align="left"><strong>koht</strong></p></td></tr><tr><td valign="top" width="88"><p align="left">8.45-9.00</p></td><td width="324"><p align="left">hommikukohv</p></td><td width="116"><p align="left">Tähe 4-160</p></td></tr><tr><td valign="top" width="88"><p align="left">9.00-10.00</p></td><td width="324"><p align="left">Arno Kanal- Eesti mullad ja protsessid muldades</p></td><td width="116"><p align="left">Tähe 4-160</p></td></tr><tr><td valign="top" width="88"><p align="left">10.00-11.00</p></td><td width="324"><p align="left">Karin Kipper- Ravimijäägid keskkonnas</p></td><td width="116"><p align="left">Tähe 4-160</p></td></tr><tr><td valign="top" width="88"><p align="left">11.00-11.15</p></td><td width="324"><p align="left">kohvipaus</p></td><td width="116"><p align="left">Tähe 4-160</p></td></tr><tr><td valign="top" width="88"><p align="left">11.15- 12.15</p></td><td width="324"><p align="left">Jaak Jaagus- Kliimamuutused Arktikas</p></td><td width="116"><p align="left">Tähe 4-160</p></td></tr><tr><td valign="top" width="88"><p align="left">12.15-13.30</p></td><td width="324"><p align="left">Tõnu Oja- Globaalökoloogiast</p></td><td width="116"><p align="left">Tähe 4-160</p></td></tr><tr><td valign="top" width="88"><p align="left">13.30-14.00</p></td><td width="324"><p align="left">lõuna</p></td><td width="116"><p align="left">Tähe kohvik</p></td></tr><tr><td valign="top" width="88"><p align="left">14.00-15.00</p></td><td width="324"><p align="left">Ülo Mander- Geograafia üldised arengud ja probleemid kaasajal</p></td><td width="116"><p align="left">Tähe 4-160</p></td></tr><tr><td valign="top" width="88"><p align="left">15.00-16.00</p></td><td width="324"><p align="left">arutelu GLOBE tulevastelst tegemistest</p></td><td width="116"><p align="left">Tähe 4-160</p></td></tr></tbody></table>
					  </p>
				    </td>
				  </tr>
				  <tr>
					<td colspan="2"><p >Lugupidamisega,<br />
					  Kaido Reivelt <br />
					  EFS juhatuse esimees<br />
					  GLOBE Eesti koordinaator <br />
					  kaido@fyysika.ee<br>
					  <img src="http://www.fyysika.ee/omad/image/image004.jpg" /></p>
					  </td>
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

