<link href="scat.css" rel="stylesheet" type="text/css" />
<br>
<?
	include("connect.php");
	include("globals.php");
	echo "tere";
?>

 
<? 
// loeme reisid selle muutujaga üle


	$query="SELECT nimi,id, sisu FROM reis";
	$result=mysql_query($query);
 	while($line=mysql_fetch_array($result))
	{
	$query1="INSERT INTO  `fyysika_ee`.`etendus_reis` (`id` ,`oid1` ,`oid2` ,`title1` ,`title2` ,`sisse1` ,`sisse2` ,`sisu1` ,`sisu2`)VALUES (NULL ,  '".$line['sisu']."',  '".$line['id']."',  '',  '',  '',  '',  '',  '')";
	echo $query1;
	$result1=mysql_query($query1);
	
	}

?>
