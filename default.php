<html>

<head>
<title>EFS: korraline veebileht</title>
<style type="text/css">
body {
	background-color: #777;
	background-position: top center;
	background-repeat: repeat-y;
	margin: 0;
	padding: 0;
}
a img {
	border: none;
}
table.main {
	background-color: #fff;
}
td.permission p a {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: 400;
	color: #333;
}
td.header {
	background-color: #fff;
	padding: 0 0 2px;
}
td.header h1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 35px;
	font-weight: 700;
	color: #fff;
	display: inline;
	margin: 0 0 0 10px;
	padding: 0;
}
td.date {
	padding: 8px 0;
}
td.date p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: 400;
	color: #666;
	text-align: right;
	margin: 0;
	padding: 0;
}
td.sidebar ul {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: 400;
	color: #4c4c4c;
	margin: 10px 10px 10px 24px;
}
td.sidebar ul li a {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: 400;
	color: #F90;
	text-decoration: none;
	padding-right: 5px;
}
td.sidebar p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: 400;
	color: #4c4c4c;
	padding-top: 0;
	padding-bottom: 0;
	margin: 10px 0 0;
}
td.sidebar img {
	margin: 0px 0px 10px 0;
}
td.sidebar h4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 15px;
	font-weight: 400;
	color: #333;
	margin: 14px 0 0;
	padding: 0;
}
td.sidetitle p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight: 400;
	line-height: 40px;
	color: #626469;
	margin: 0;
	padding: 0 0 0 5px;
}
td.mainbar h2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight: 400;
	color: #626469;
	line-height: 26px;
	margin: 0;
	padding: 0 5px;
}
td.mainbar h3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: 400;
	color: #626469;
	margin: 0;
	padding: 5px 0 0;
}
td.mainbar p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: 400;
	color: #4c4c4c;
	margin: 10px 0 0;
	padding: 0 5px 0 5px;
}
td.mainbar p.more {
	padding: 0 0 10px;
}
td.mainbar img {
	margin: 10px 4px 4px 4px;
}
td.mainbar ul {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: 400;
	color: #000;
	margin: 10px 0 10px 24px;
	padding: 0;
}
p, a {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: 400;
	color: #D2D2D2;
	margin: 0;
	padding: 0;
}
td.permission, td.footer {
	padding: 10px 0;
}
td.permission p, td.footer p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: 400;
	color: #333;
	margin: 0;
	padding: 0;
}
td.sidebar p a, td.mainbar p a, td.mainbar li a {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: 400;
	color: #F90;
	text-decoration: none;
}
td.mainbar h2 a {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight: 400;
	color: #626469;
	text-decoration: none;
}
.style1 {
	text-align: center;
}
.style2 {
	text-decoration: underline;
}
</style>
</head>




<body>
<? include("connect.php");
//require('kas_on_lubatud_siseveebi.php');
include("globals.php");

$query_lugu=" SELECT * FROM uudis WHERE show_page=1 AND liik=3 ORDER BY lupdate DESC LIMIT 1 ";
echo $query_lugu;
$result_lugu=mysql_query($query_lugu);
$line_lugu=mysql_fetch_array($result_lugu);
echo $result_lugu; 



$query_lugu=" SELECT * FROM uudis WHERE show_page=1 AND liik=3 ORDER BY lupdate DESC LIMIT 1 ";
echo $query_lugu;
$result_lugu=mysql_query($query_lugu);
$line_lugu=mysql_fetch_array($result_lugu);
echo $result_lugu; 

$query=" SELECT * FROM `arve` ORDER BY nmbr DESC LIMIT 20 ";
$result=mysql_query($query);


$line=mysql_fetch_array($result);
echo $line['id'];





?>

<table cellpadding="0" cellspacing="20" width="100%">
	<tr>
		<td align="center" valign="top">
		<table border="0" cellpadding="0" cellspacing="0" class="main" style="background-color: #fff;" width="580">
			<tr>
				<td align="center" class="permission" style="padding=top: 10px; padding-bottom: 10px; padding-right: 0; padding-left: 0;">
				<p style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: 400; color: #333; padding-left: 0;">
				Kui sa ei näe seda kirja korrektselt, siis kasuta oma veebisirvikut, 
				selleks kliki siia.</p>
				</td>
			</tr>
			<tr>
				<td class="header" height="90" align="center" style="background-color: #fff; padding-top: 0; padding-bottom: 4px; padding-right: 0; padding-left: 0;" valign="bottom">
				<img alt="Oxford Instruments" height="85" src="EFS-2.gif" width="503">
				</td>
			</tr>
			<tr>
				<td align="center">
				<table cellpadding="0" cellspacing="0" width="530">
					<tr>
						<td class="date" style="padding-top: 8px; padding-bottom: 8px; padding-right: 0; padding-left: 0;">
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 400; color: #666; text-align: right; margin-top: 0; margin-bottom: 0; margin-right: 0; margin-left: 0; padding-top: 0; padding-bottom: 0; padding-right: 0; padding-left: 0;">
						Oktoober, 2009</p>
						</td>
					</tr>
					<tr align="left" rowspan="3" valign="top">
						<td align="left" class="mainbar" valign="top" width="550">
						<table bgcolor="#E7E7E7" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td>
								<h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight: 400; color: #626467; line-height: 26px; margin-top: 0; margin-bottom: 0; margin-right: 0; margin-left: 0; padding-top: 0; padding-bottom: 0; padding-right: 5px; padding-left: 5px;">
								<a name="9DB852B04C452497" style="margin-top: 0; margin-bottom: 0; margin-right: 0; margin-left: 0; padding-top: 0; padding-bottom: 0; padding-right: 0; padding-left: 0; font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight: 400; color: #626469;">								</a>Eesti Füüsika Seltsi -veebiajakiri</h2>								</td>
							</tr>
							<tr>
							  <td bgcolor="#FFFFFF">EFS juhatuse tervitused ja sõnadelugemised </td>
						  </tr>
							<tr>
							  <td>Nädala lugu </td>
						  </tr>
						</table>
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 400; color: #4c4c4c; margin-top: 10px; margin-bottom: 0; margin-right: 0; margin-left: 0; padding-top: 0; padding-bottom: 0;padding-right:5px;padding-left:5px;"><? echo $line_lugu["title"]; ?></p>
						<table bgcolor="#E7E7E7" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td>
								<h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight: 400; color: #626469; line-height: 26px; margin-top: 0; margin-bottom: 0; margin-right: 0; margin-left: 0; padding-top: 0; padding-bottom: 0;padding-right:5px;padding-left:5px;">
								Tulevad sündmused</h2>
								</td>
							</tr>
						</table>
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 400; color: #4c4c4c; margin-top: 10px; margin-bottom: 0;padding-right:5px;padding-left:5px;">kjhkj</p>
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 400; color: #4c4c4c">
						Kaido sinu etteaste, et siia saada tulevaste sündmuste ajakava.</p>
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 400; color: #4c4c4c; margin-top: 10px;">
						1 sündmus on Lumelinna ehitus - 22 oktoobril 2009.a.</p>
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 400; color: #4c4c4c; margin-top: 10px;">
						2 sündmus on võidukihutamine -23 detsembril FI ümber</p>
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 400; color: #4c4c4c; margin-top: 10px;">
						1 sündmus</p>
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 400; color: #4c4c4c; margin-top: 10px;">
						1 sündmus</p>
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 400; color: #4c4c4c; margin-top: 10px;">
						1 sündmus</p>
&nbsp;</td>
					</tr>
				</table>
				<table cellpadding="0" cellspacing="0" width="530">
					<tr>
						<td colspan="3" width="100%">lk</td>
					</tr>
					<tr align="left" rowspan="3" valign="top">
						<td align="left" class="mainbar" valign="top" width="270">
						<table bgcolor="#E7E7E7" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td>
								<h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight: 400; color: #626469; line-height: 26px; margin-top: 0; margin-bottom: 0; margin-right: 0; margin-left: 0; padding-top: 0; padding-bottom: 0;padding-right:5px;padding-left:5px;">
								Meelespea</h2>
								</td>
							</tr>
						</table>
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 400; color: #4c4c4c; margin-top: 10px; margin-bottom: 0; margin-right: 0; margin-left: 0; padding-top: 0; padding-bottom: 0;padding-right:5px;padding-left:5px;">Palume, härrased ja prouad, lahkesti oma liikmemaks kõigil ära maksta, 
						sest masu tingimustes peame vastasel juhul poe kinni panema. 
						Liikmemaksu saad tasuda Swedpbank xxxx. Selgitusse oma eesnimi 
						ja perenimi</p>
						</td>
						<td align="left" class="mainbar" valign="top" width="10">
						</td>
						<td align="left" class="mainbar" valign="top" width="270">
						<table bgcolor="E7E7E7" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td>
								<h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight: 400; color: #626469; line-height: 26px; margin-top: 0; margin-bottom: 0; margin-right: 0; margin-left: 0; padding-top: 0; padding-bottom: 0;padding-right:5px;padding-left:5px;">
								Soovid astuda EFS liikmeks</h2>
								</td>
							</tr>
						</table>
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: 400; color: #4c4c4c; margin-top: 10px; margin-bottom: 0; margin-right: 0;padding-right:5px;padding-left:5px;">Selleks, täida <span class="style2">avaldus siin</span>, trüki see 
						välja, allkirjasta ja saada meile. Kanna liikmemaks xxEEK&nbsp; 
						Swedbank xxxxx ja Selgitusse kirjuta eesnimi, perenimi ja 
						avalduse nr.(leiad avalduse päisest). Liikme staatusest 
						anname meiliga teada.</p>
						</td>
					</tr>
					<tr>
					</tr>
					<tr>
						<td colspan="3" width="100%">plah</td>
					</tr>
					<tr>
						<td colspan="3" width="100%">Talv ja libedus tuleb kõigile 
						ootamatult, eriti ohusatud on autoomanikud!</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td align="center" class="footer" style="padding-top: 10px; padding-bottom: 10px; padding-right: 0; padding-left: 0;">
				<p>Kirjuta meile EFS at ut ee </p>
				<p>Kui te ei soovi enam seda veebiajakirja saada, siis saada meil 
				siia.</p>
				<p>Meie aadress: EFS, Tähe 4, Tartu.</p>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</body>

</html>
