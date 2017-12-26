<!DOCTYPE html>
<html lang="et"> 
<head>
  <meta charset="UTF-8" />
  <title>e-õpik</title>
  <link rel="stylesheet" type="text/css" href="http://rko.olunet.org/files/styles/article.css"/>
  <link rel="stylesheet" type="text/css" href="http://rko.olunet.org/files/styles/layout.css" />
  <script type="text/javascript" src="http://rko.olunet.org/files/js/jquery-1.6.min.js"></script>
  <script type="text/javascript" src="http://rko.olunet.org/files/js/jquery.scrollTo-1.4.2-min.js"></script>
  <script type="text/javascript" src="http://rko.olunet.org/files/js/jquery.touchwipe.1.1.1.js"></script>
  <script type="text/javascript" src="http://rko.olunet.org/files/js/jquery.mousewheel-3.0.4.pack.js"></script>
  <script type="text/javascript" src="http://rko.olunet.org/files/js/jquery.fancybox-1.3.4.pack.js"></script>
  <script type="text/javascript" src="http://rko.olunet.org/files/js/localstorage.js"></script>
  <script type="text/javascript" src="http://rko.olunet.org/files/js/functions.js"></script>
  <script type="text/javascript" src="http://rko.olunet.org/files/highslide/highslide-full.js"></script>
  <link rel="stylesheet" type="text/css" href="http://rko.olunet.org/files/highslide/highslide.css" />
<script type="text/javascript"
  src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>

</head>

</head>
<body>
<div id="pleaseWaitContainer">
  <div class="centered">Please Wait ...</div>
  <div id="pleaseWait"></div>
</div>
<div id="eo-left-event" class="end">
  <div id="eo-go-left"><div class='arrow'></div></div>
</div>
<div id="eo-right-event">
  <div id="eo-go-right"><div class='arrow'></div></div>
</div>
<div id="eo-top-panel">
    <div id="section-chooser"></div>
    <div id="eo-columncounter"></div>
</div>

<div id="eo-viewport">
  <article lang="et"> 

<? 
include("connect.php");
include("globals.php");
$id=$_GET["id"];
$query=" SELECT * FROM `raamat` WHERE id=".$id;
//echo $query;
$result=mysql_query($query);
$line=mysql_fetch_array($result);
echo "<header><h1>",$line["nimi"],"</h1></header>";

$query1=" SELECT * FROM raamat".$id." WHERE pid=0";
//echo $query1;
$result1=mysql_query($query1);
while($line1=mysql_fetch_array($result1))
{
echo "<header><h1>",$line1["nimi_est"],"</h1></header>";
$query2="SELECT * FROM raamat".$id."_raamat".$id." WHERE oid1=".$line1["id"]." ORDER BY order1";
$result2=mysql_query($query2);
while($line2=mysql_fetch_array($result2))
{
echo "<section>";
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
echo "</section>";
}

?>

  </article>
</div>
</body>
