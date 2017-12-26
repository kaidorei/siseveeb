<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
    <?
include("connect.php");
include("globals.php");

$query="SELECT eesnimi, perenimi, email1 FROM isik WHERE in_efs=1 ORDER BY eesnimi";
//echo $query;
$result=mysql_query($query);
while($line=mysql_fetch_array($result)){
	
    
 if($line["email1"]) echo $line["email1"]," ",$line["eesnimi"]," ",$line["perenimi"],"<br>";    
 
 } ?>
</body>