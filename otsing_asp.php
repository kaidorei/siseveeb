<?php
//sleep( 1 );
// no term passed - just exit early with no response

if (empty($_GET['term'])) exit ;
$q = strtolower($_GET["term"]);
$d = $_GET["domain"];
$v = strtolower($_GET["vali"]);
// remove slashes if they were magically added
if (get_magic_quotes_gpc()) $q = stripslashes($q);
require_once 'header.php';
if($d=="raamatX" or $d == "isik") //raamatX-dest peab näitama vaid neid, mis on õige taseme omad, st pid=2
{
	$query ="SELECT * FROM ".$d." ORDER BY ".$v ;
}
else
{
	$query ="SELECT * FROM ".$d." WHERE origin_id=0 ORDER BY ".$v ;
}

//echo $query,"<br>";
$result = $db->query($query);
$items = array();
$result1 = array();
while($row = $result->fetch_assoc())
{
//	echo $row["nimi_est"],"<br>";
	$items[$row[$v]]= $row["id"]." ".$row["gpid_demo"];
//	$juurde = array($row["id"]=>$row["nimi_est"]);
//	array_merge($items, $juurde);

if (strpos(strtolower($row[$v]), $q) !== false) {
	if($d == "isik")
	{
		$key=$row["eesnimi"]." ".$row["perenimi"]."(".$row["id"].")";
	}
	else
	{
		$key=$row["nimi_est"]."(".$row["id"].")";
	}
	array_push($result1, array("id"=>$row["id"], "label"=>$key, "value" => strip_tags($key)));
	//echo "HIT!";
}

if (count($result1) > 25)
	break;
}
//print_r ($items);

/*$result = array();
foreach ($items as $key=>$value) {
//	echo $key,"<br>";
	if (strpos(strtolower($key), $q) !== false) {
		$key=$key."(".$value.")";
		array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
	}

	if (count($result) > 25)
		break;
}*/



// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions

//echo json_encode($result);

//echo"<br>";

echo json_encode($result1);



?>
