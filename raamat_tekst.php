<head>
<script type="text/javascript"
  src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
</head>
<body>
<? 
include("connect.php");
include("globals.php");
$id=$_GET["id"];
$query=" SELECT * FROM `raamat` WHERE id=".$id;
//echo $query;
$result=mysql_query($query);
$line=mysql_fetch_array($result);
echo $line["nimi"], "<br>";

$query1=" SELECT * FROM raamat".$id." WHERE pid=0";
//echo $query1;
$result1=mysql_query($query1);
while($line1=mysql_fetch_array($result1))
{
echo "<h1>",$line1["nimi_est"],"</h1>";
$query2="SELECT * FROM raamat".$id."_raamat".$id." WHERE oid1=".$line1["id"]." ORDER BY order1";
$result2=mysql_query($query2);
while($line2=mysql_fetch_array($result2))
{
	$query3="SELECT * FROM raamat14 WHERE id=".$line2["oid2"];
	$result3=mysql_query($query3);
	$line3=mysql_fetch_array($result3);
	echo "<h2>",$line3["nimi_est"],"</h2>";
	$query4="SELECT * FROM raamat".$id."_raamat".$id." WHERE oid1=".$line2["oid2"]." ORDER BY order1";
	$result4=mysql_query($query4);
	while($line4=mysql_fetch_array($result4))
	{
		$query5="SELECT * FROM raamat14 WHERE id=".$line4["oid2"];
		$result5=mysql_query($query5);
		$line5=mysql_fetch_array($result5);
		echo "<h3>",$line5["nimi_est"],"</h3>";
		echo $line5["tekst"];
	}
}
?>
<? }

?>


</body>