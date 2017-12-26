<?php

//sleep( 1 );
// no term passed - just exit early with no response
if (empty($_GET['term'])) exit ;
$q = strtolower($_GET["term"]);
// remove slashes if they were magically added
if (get_magic_quotes_gpc()) $q = stripslashes($q);

require_once 'header.php';
$query ="SELECT * FROM nupula ORDER BY nimi_est" ;
//echo $query,"<br>";
$result = $db->query($query);


$items = array();

while($row = $result->fetch_assoc()) 
{
//	echo $row["nimi_est"],"<br>";
	$items[$row["probleem_est"]]= $row["id"];
//	$juurde = array($row["id"]=>$row["nimi_est"]);

//	array_merge($items, $juurde);
}
//print_r ($items);

$result = array();
foreach ($items as $key=>$value) {
//	echo $key,"<br>";
	if (strpos(strtolower($key), $q) !== false) {
		array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
	}
	if (count($result) > 11)
		break;
}

// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
echo json_encode($result);

?>