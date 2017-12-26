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

require('kas_on_lubatud_siseveebi.php');


include("globals.php");


		$aine_op="fyysika"; 

		$query01="SELECT * FROM isik ORDER BY eesnimi ";
		$result01=mysql_query($query01);
		$count=0;
		$line_rida=array();
		
		
		while($line01=mysql_fetch_array($result01))
		{
			$query00="SELECT * FROM isik_kool WHERE oid1=".$line01['id']." AND sisu2='".$aine_op."'";

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
<table align="center" width="51%" border="0">
  <tr>
    <td colspan="2"><div align="center" class="style1"><img src="image/EFSkirjapea.jpg" alt="pea" width="650" height="89" /></div></td>
  </tr>
  <tr>
    <td width="23%" height="51"><span class="style1"><em><br />
        <strong><? echo $line03['nimi']; ?></strong><br />
      
    <? echo $line03['aadress']; ?></em></span></td>
    <td width="77%" valign="bottom"><div align="right" class="style1">12. oktoobril.2009</div></td>
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
      K&auml;esolevaga  teatame, et teie kooli f&uuml;&uuml;sika&otilde;petaja, <strong><? echo $line_rida[$count]['eesnimi'];?> <? echo $line_rida[$count]['perenimi']; ?></strong>, on kutsutud  osalema Voore Puhkekeskuses 6.-7.novembril toimuvale &uuml;leriigilisele  f&uuml;&uuml;sika&otilde;petajate s&uuml;gisseminarile.</p>
      <p align="justify" class="style1"> Alustame reedel, 6. novembril kell 14.00 ja  l&otilde;petame laup&auml;eval, 7.novembril kell 16.30.</p>
      <p align="justify" class="style1"> P&auml;evakavas:</p>
      <ul type="disc" class="style1">
  <li>Uus       g&uuml;mnaasiumi f&uuml;&uuml;sika ainekava.</li>
  <li>Uue       g&uuml;mnaasiumide f&uuml;&uuml;sika ainekava katsevahendite komplekt.</li>
  <li>F&uuml;&uuml;sika&otilde;petajate       v&otilde;rgustiku arendamisest.</li>
  <li>E-&otilde;pe,       virtuaal&otilde;pe, f&uuml;&uuml;sika&otilde;petajatele m&otilde;eldud internetikeskkonna arenguplaani       arutelu.</li>
</ul>
<p align="justify" class="style1">Toimuvad loengud, demonstratsioonid ja arutelud. Iga osaleja saab t&otilde;endi 16 koolitustunni l&auml;bimise kohta.</p>
<p align="justify" class="style1"> <br />
  Konverentsil osalemine on f&uuml;&uuml;sika&otilde;petajale  tasuta. Registreerimiseks saatke palun vastavasisuline kiri Eesti F&uuml;&uuml;sika  Seltsi f&uuml;&uuml;sika&otilde;petajate osakonna esinaisele Riina Leet&rsquo;ile  (riina_l@pshg.edu.ee). Kaugemalt tulijatele oleme valmis kompenseerima  s&otilde;idukulusid osas, mis &uuml;let<span class="style1">ab 400 krooni.</span></p>
<p align="justify" class="style1">Osalejaid ootame kuni 110. S&uuml;gisseminarilt v&auml;ljaj&auml;&auml;nuile korraldame soovi korral  &uuml;hep&auml;evase kordusseminari Tartus.</p></td>
  </tr>
  <tr>
    <td colspan="2"><span class="style1"><br />
      Lugupidamisega,<img src="image/Programmi_logo.jpg" alt="logo" width="400" height="82" align="right" /><br />
      Kaido Reivelt <br />
      EFS juhatuse esimees<br />
      kaido@fyysika.ee<br />
      <img width="108" height="74" src="image/spacer.gif" /><br />
      <br />
      Riina Leet, EFS f&uuml;&uuml;sika&otilde;petajate osakonna esinaine, riina_l@pshg.edu.ee</span></td>
  </tr>
</table>

<P CLASS="pagebreakhere">.</p>

			<? 
			}
	$count++;
	}
	
	
		// ------------- peagrupi exponaat -----------
?>

