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



$tid=$_GET["tid"];

$tootab=$_GET["tootab"];

$fkb=$_GET["fkb"];

//echo "tootab",$tootab;

//if(!$tootab) $count_mailer=0;

$count_mailer=$_GET["count_mailer"];

//echo $domain;

//$count_mailer=$_POST['count_mailer'];

//echo "Count mailer before:",$count_mailer,"<br>";

$count_mailer++;

//echo "Count mailer after:",$count_mailer,"<br>";



?>

<script>

function proovi_veel() {

  vorm = document.forms ['muugi'];

  vorm.submit();

}

</script>





<html>

<link href="../scat.css" rel="stylesheet" type="text/css" />

<body>



<?	

	$query="SELECT * FROM teade WHERE id=".$tid." LIMIT 1";

	//echo $query."<br>";

	$result=mysql_query($query);

	$line_o=mysql_fetch_array($result);

	//echo "Teate nimi:  ", $line_o["title"],"<br>"; 

	//echo "Teade:  ", $line_o["body"],"<br>"; 



if($fkb==1)

{

	$adressaadid=explode(';',$line_o["sent_to_n"]);	

	//echo "Adressaadid:  <br><br>"; 

//	$count_s=0;

	$query_to="SELECT * FROM moodle_nina.mdl_user WHERE id=".$adressaadid[$count_mailer]." LIMIT 1";

		//echo $query_to;

	$result_to=mysql_query($query_to);

	$line_to=mysql_fetch_array($result_to);

}

else

{

	$adressaadid=explode(';',$line_o["sent_to"]);	

	//echo "Adressaadid: ".$line_o["sent_to"]." Ja parajasti tegeletakse".$adressaadid[$count_mailer]."<br>"; 

//	$count_s=0;
	if($adressaadid[$count_mailer])
	{
		$query_to="SELECT eesnimi, perenimi, email1 FROM isik WHERE id=".$adressaadid[$count_mailer]." LIMIT 1";
	
		//echo $query_to;
	
		$result_to=mysql_query($query_to);
	
		$line_to=mysql_fetch_array($result_to);
	}

}



if(!$adressaadid[$count_mailer]) {$j2tka=0; } else {$j2tka=1;}





	require_once('Rmail.php');

//	echo "Kirja sisu id: ",$HTTP_GET_VARS["tid"];    

    $mail = new Rmail();



    /**

    * Set the from address of the email

    */

    $mail->setFrom('Kaido Reivelt <kaido@fyysika.ee>');

    

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

	$body_text_asendustega = str_replace("[[eesnimi]]", trim($line_to["eesnimi"]), $line_o["body_text"]);

	$body_text_asendustega = str_replace("[[perenimi]]", trim($line_to["perenimi"]), $body_asendustega);

    $mail->setText($body_text_asendustega);

    

    /**

    * Set the HTML of the email. Any embedded images will be automatically found as long as you have added them

    * using addEmbeddedImage() as below.

    */



	$body_asendustega = str_replace("[[eesnimi]]", trim($line_to["eesnimi"]), $line_o["body"]);

	$body_asendustega = str_replace("[[perenimi]]", trim($line_to["perenimi"]), $body_asendustega);

    $mail->setHTML($body_asendustega);

    

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

	if($line_o["personal"]==1)

	{

		$address = 'kaido.reivelt@gmail.com';
		//echo "PERSONAL".$address;

	}

	else

	{

		if($fkb==1)

		{

			$address = $line_to["email"];

		}

		else

		 {

			$address = $line_to["email1"];

		 }

	}   //echo "sd".$line_to["email"]; 

	   	$mail->setCc('kaidor@fi.tartu.ee');

//		$mail->setBcc('barney@example.com');

	$result_mail  = $mail->send(array($address));

	?>

<form name="muugi" action="../Rmail/efs_mail.php?count_mailer=<? echo $count_mailer;?>&tootab=1&tid=<? echo $tid;?>&fkb=<? echo $fkb;?>">

  <table border="0" width="100%" style="padding: 0px; margin: 0px">

      <tr>

        <td colspan="4" class="menu" ><div align="left"><? echo "Teate nimi:  ", $line_o["title"];

 ?>

        </div></td>

        <td class="menu_punane" ><?  echo " On proov = ",$line_o["personal"];?></td>

        <td class="menu_punane" width="233">

		<? if($j2tka){



 echo "Adressaat: ",$adressaadid[$count_mailer]; } else {echo "VALMIS!";}

 ?></td>

      </tr>

      <tr>

        <td colspan="5" class="navi"><div align="left"><? echo $line_to["email1"];?> (<? echo $line_to["eesnimi"]," ",$line_to["perenimi"];?>)</div></td>

        <td style="width: 7em; text-align: right">&nbsp;</td>

      </tr>

      <tr>

        <td colspan="6" class="navi" ><? 	echo "Adressaadid:  ", $line_o["sent_to"]; 

?></td>

      </tr>

      <tr>

<? //echo "id=", $id;?>

        <td width="176" style="width: 7em; text-align: right">  <span class="menu">Objekti id:</span></td>



        <td width="176" style="width: 7em; text-align: left"><input type="text" name="tid" class="fields" value="<? echo $tid;?>" size="8"></td>

        <td width="58" class="menu_punane" style="width: 7em; text-align: right">Mitmes:        </td>

        <td width="59" align="left" style="width: 7em; "><input type="text" name="count_mailer" class="fields" value="<? echo $count_mailer;?>" size="6"></td>

        <td width="176" style="width: 7em; text-align: right"><input type="text" name="domain" class="fields" value="<? echo $domain;?>" size="6"><input type="text" name="fkb" class="fields" value="<? echo $fkb;?>" size="2"></td>

        <td style="width: 7em; text-align: right"><input type="submit" class="button" value="start"></td>

      </tr>

     <tr>

        <td colspan="5" class="navi"><div align="left">	Email has been sent to: <? echo $address;?>. Result: <? var_dump($result_mail)?>. Adressaat: <? echo " ".$line_to["email"]; ?><br><br>

</div></td>

        <td style="width: 7em; text-align: right">&nbsp;</td>

      </tr>

  </table>

</form>

	<script>

<? 

if ($j2tka) echo "proovi_veel()";?>

</script>



<?// usleep(20);?>

	

</body>