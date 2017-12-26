<link href="scat.css" rel="stylesheet" type="text/css" />
<head>
<STYLE TYPE='text/css'>
P.pagebreakhere {page-break-before: always}
</STYLE>
</head>

<style type="text/css">
<!--
.style1 {font-family: Georgia, "Times New Roman", Times, serif}
-->
</style>
<br>
<?
include("connect.php");

//require('kas_on_lubatud_siseveebi.php');


include("globals.php");


		$aine_op="globe"; 

		$query01="SELECT * FROM isik ORDER BY eesnimi ";
		$result01=mysql_query($query01);
		$count=0;
		$line_rida=array();
		
		
		while($count<15)
		{	$line01=mysql_fetch_array($result01);
			$query00="SELECT * FROM isik_kool WHERE oid1=".$line01['id']." AND sisu2='".$aine_op."'";
			//echo $query00;

			$result00=mysql_query($query00);
			if($line00=mysql_fetch_array($result00))
			{
				$line_rida[$count]['id']=$line01['id'];
				$line_rida[$count]['eesnimi']=$line01['eesnimi'];
				$line_rida[$count]['perenimi']=$line01['perenimi'];
				$line_rida[$count]['email1']=$line01['email1'];
				$line_rida[$count]['email2']=$line01['email2'];
				$count++;
			}

		}
		$count=0;
		while($line=$line_rida[$count]){ // 	&& $count<3
//			echo $line['id'];

		   
			$query02="SELECT * FROM isik_kool WHERE oid1=".$line_rida[$count]['id'];
//				echo $query02;
			$result02=mysql_query($query02);
		
		
			while($line02=mysql_fetch_array($result02))
			{

//				echo $line["mobla"];
//				echo $line["eesnimi"];
//				echo $line["perenimi"];
//				echo $line["email1"]; 



				$query03="SELECT * FROM kool WHERE id=".$line02['oid2']."";
//				echo $query03;
				$result03=mysql_query($query03);
				$line03=mysql_fetch_array($result03); ?>
<table align="center" width="700" border="0">
  <tr>
    <td><div align="center" class="style1">
      <div align="left"><img src="image/EFSlogo.jpg" width="130" /></div>
    </div></td>
    <td><div align="right"><img src="image/GLOBElogo.JPG" width="130" /></div></td>
  </tr>
  <tr>
    <td width="23%" height="51"><span class="style1"><em><br />
        <strong><? echo $line03['nimi']; ?></strong><br />
      
    <? echo $line03['aadress']; ?></em></span></td>
    <td width="77%" valign="bottom"><div align="right" class="style1">8. novembril.2009</div></td>
  </tr>
  <tr>
    <td height="38" colspan="2"><div align="center" class="style1">
      <h1><br />
        KUTSE<br />
      </h1>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><p align="justify" class="style1"><br />
      <br />
      K&auml;esolevaga  teatame, et &otilde;petaja <strong><? echo $line_rida[$count]['eesnimi'];?> <? echo $line_rida[$count]['perenimi']; ?></strong> on kutsutud  osalema Tartus  13.-14. novembril toimuvale &uuml;leriigilisele  GLOBE &otilde;petajate seminarile.</p>
      <p align="justify" class="style1"> Alustame reedel, 13. novembril kell 16.00 ja  l&otilde;petame laup&auml;eval, 14. novembril kell 16.00.</p>
      <p align="justify" class="style1"> P&auml;evakavas:</p>
      <ul type="disc" class="style1">
  <li>GLOBE koolitus keskkonnam&otilde;&otilde;tmiste l&auml;biviimiseks. </li>
  <li>&Uuml;ldhuvitavad loengud T&Uuml; Loodus- ja Tehnoloogiateaduskonna teaduritelt ja &otilde;ppej&otilde;ududelt .</li>
  <li>Arutelu GLOBE tegevustest 2010. aastal.</li>
  </ul>
<p align="left" class="style1">T&auml;psema kava leiate aadressilt   <a href="http://www.globe.ee/globe/seminar2009/">http://www.globe.ee/globe/seminar2009/</a> Osalejad saavad koolitust ja vastava t&otilde;endi 16 tunni ulatuses.</p>
<p align="justify" class="style1"> <br />
  Konverentsil osalemine on &otilde;petajatele  tasuta. Registreerimiseks saatke palun vastavasisuline kiri Kari K&uuml;tile (karli.kutt).</p>
<p align="justify" class="style1">&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2"><span class="style1"><img src="image/image004.jpg" width="108" height="74" /><img src="image/kaksiklogo_innove.JPG" width="250" align="right" /><br />
      Lugupidamisega,<br />
      Kaido Reivelt (5143349) <br />
      GLOBE Eesti koordinaator<br />
      kaido@globe.ee<br />
      <br />
      Karli K&uuml;tt (karli@globe.ee), EFS projektijuht, 
      karli.kutt@gmail.com</span></td>
  </tr>
</table>

<P CLASS="pagebreakhere">.</p>

			<? 
			}
	$count++;
	}
	
	
		// ------------- peagrupi exponaat -----------
?>
