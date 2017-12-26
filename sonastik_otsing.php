<?php
//sleep( 1 );
// no term passed - just exit early with no response

if (empty($_GET['term'])) exit ;

$q = strtolower($_GET["term"]);
$d = $_GET["domain"];
$v = strtolower($_GET["vali"]);
$k = strtolower($_GET["keel"]);

// remove slashes if they were magically added
if (get_magic_quotes_gpc()) $q = stripslashes($q);

require_once 'header.php';

$query ="SELECT * FROM ".$d." WHERE deleted =0 ORDER BY ".$v ;

//echo $query,"<br>";

$result = $db->query($query);
$items = array();

while($row = $result->fetch_assoc()) 
{

	if (strpos(strtolower($row[$v]), $q) !== false) 
	{
//		$key=$key."(".$value.")";
		$query_v ="SELECT * FROM dict_concept_term WHERE oid2=".$row["id"]." ORDER BY id" ; //leiame mõiste
		$result_v = $db->query($query_v);
		$f=$result_v->fetch_assoc();
		
		$query_t= "SELECT dict_concept_term.oid1,dict_concept_term.oid2,dict_term.id, dict_term.kirje
		FROM dict_term
		INNER JOIN dict_concept_term
		ON dict_concept_term.oid2=dict_term.id WHERE dict_concept_term.oid1='".$f["oid1"]."' ";
		$result_t = $db->query($query_t);
		$out='';
		while($row_t = $result_t->fetch_assoc()) 
		{
			$out=$out."".$row_t["kirje"]." ";
		}

		array_push($items, array("value" => strip_tags($row[$v]),"id"=>$f["oid1"],"tolk"=>$out)); 
	}

	if (count($items) > 30)
		break;
}
// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions

echo json_encode($items);
?>