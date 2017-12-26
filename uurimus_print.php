<? 
include("connect.php");
include("globals.php");

//echo $_POST["submit_value"];

$eh=$_GET["action"];
$id=$_GET["id"];
$domain=$_GET["domain"];
?>
<html>
<link href="scat.css" rel="stylesheet" type="text/css">
<head>
 <title>Uurimistööde konkurss 2014</title>
</head>

<body>
<? 	

$result_exp=mysql_query("SELECT * FROM uurimus WHERE konk_aasta=2014 ORDER BY klass DESC, nimi_est" );


		while($line_exp=mysql_fetch_array($result_exp)){
			
			
switch ($line_exp["klass"])
{
	case 1: $klass="5-7"; break;
	case 2: $klass="8-9"; break;
	case 3: $klass="10-12"; break;
}
			
			echo "<h2>",$line_exp["nimi_est"],"</h2>";
			echo "Autor(id): ",$line_exp["autorid"],"<br>";
			echo "Kool: ",$line_exp["koolid"],"<br>";
			echo "Juhendaja(d): ",$line_exp["juhendajad"],"<br>";
			echo "Vanuser&uuml;hm: ",$klass," klass <br>Saavutatud koht: ",$line_exp["konk_koht"],"<br>";
			echo $line_exp["annot_est"];
			}
			

	 ?>
<?

?> 
             
</body>
</html>
<?
?>