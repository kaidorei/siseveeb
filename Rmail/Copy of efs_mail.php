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
    * © Copyright 2008,2009 Richard Heyes
    */

//kirja sisu andmebaasist:

//	include("./connect.php");
	require('../kas_on_lubatud_siseveebi.php');
//	include("./globals.php");
?>
<html>
<link href="scat.css" rel="stylesheet" type="text/css">
<body>

<?	
	$query="SELECT * FROM teade WHERE id=".$tid." LIMIT 1";
//	echo $query;
	$result=mysql_query($query);
	$line_o=mysql_fetch_array($result);
	echo "Teate nimi:  ", $line_o["title"],"<br><br>"; 
	echo "Teade:  ", $line_o["body"],"<br><br>"; 
	echo "Adressaadid:  ", $line_o["sent_to"],"<br><br>"; 
	

	require_once('Rmail.php');
//	echo "Kirja sisu id: ",$HTTP_GET_VARS["tid"];    
    $mail = new Rmail();

    /**
    * Set the from address of the email
    */
    $mail->setFrom('Eesti Füüsika Selts <efs@fyysika.ee>');
    
    /**
    * Set the subject of the email
    */
    $mail->setSubject($line_o["title"]);
    
    /**
    * Set high priority for the email. This can also be:
    * high/normal/low/1/3/5
    */
    $mail->setPriority('normal');

    /**
    * Set the text of the Email
    */
    $mail->setText('See siin on teksti, mida näevad tekstiinimesed ...');
    
    /**
    * Set the HTML of the email. Any embedded images will be automatically found as long as you have added them
    * using addEmbeddedImage() as below.
    */
    $mail->setHTML($line_o["body"]);
    
    /**
    * Set the delivery receipt of the email. This should be an email address that the receipt should be sent to.
    * You are NOT guaranteed to receive this receipt - it is dependent on the receiver.
    */
    //$mail->setReceipt('kaidor@fi.tartu.ee');
    
    /**
    * Add an embedded image. The path is the file path to the image.
    */
//    $mail->addEmbeddedImage(new fileEmbeddedImage('background.gif'));
    
    /**
    * Add an attachment to the email.
    */
//    $mail->addAttachment(new fileAttachment('example.zip'));

    /**
    * Send the email. Pass the method an array of recipients.
    */
	$adressaadid=explode(';',$line_o["sent_to"]);	
	echo "Adressaadid:  <br><br>"; 
	$count_s=0;
	while($adressaadid[$count_s])
	{
		$query_to="SELECT eesnimi, perenimi, email1 FROM isik WHERE id=".$adressaadid[$count_s]." LIMIT 1";
//		echo $query_to;
		$result_to=mysql_query($query_to);
		$line_to=mysql_fetch_array($result_to);
		$count_s++;
		echo $count_s,". ",$line_to["email1"],"<br>";
		$address = 'kaido@fyysika.ee';
//		$address = 'aile.tamm@ut.ee';
//	   	$mail->setCc('fred@example.com');
//		$mail->setBcc('barney@example.com');
		$result  = $mail->send(array($address));
	?>
	Email has been sent to <?=$address?>. Result: <? var_dump($result)?><br><br>
	<?
	}
?>



	
	
</body>