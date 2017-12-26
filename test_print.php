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
 <title>Tulem</title>
</head>

<body>
<? 	

$result_exp=mysql_query("SELECT * FROM exp WHERE id='".$id."'" );
$line_exp=mysql_fetch_array($result_exp);

	 ?><table width="700" border="0">
  <tr>
    <td><? echo $line_exp["kokku_est"]?></td>
  </tr>
</table>
<?

?> 
             
</body>
</html>
<?
?>