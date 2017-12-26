<?

require_once 'header.php';
mb_internal_encoding('UTF-8');
include("connect.php");
// Ühtlustan raamatute struktuuri:
// Igal pid=1 alajaotusel on alajaotused Kokkuvõte, Kontrollküsimused ja Lisamaterjalid
// Kõik gpid_demo = 32 ja 20 objektid kontrollküsimuste alla
function make_raamatX_1($raamatXid,$book_id,$db)
{
//echo "+";
//$line_temp["id"]=$_GET["id"];
//Kohustuslikud alajaotused, mille olemasolu kontrollime
$alajaotused = array(1,2,3);
$alajaotused_nimed = array("","Kokkuvõte","Kontrollküsimused","Lisamaterjalid");
foreach($alajaotused AS $jaotis)
{
$query_temp="SELECT id,nimi_est, tekst_est FROM raamatX WHERE id IN (SELECT oid2 AS raamatX_id FROM raamatX_raamatX WHERE oid1 = '".$raamatXid."' AND book_id='".$book_id."') AND type = '".$jaotis."'";
//echo $query_temp."<br>";
//	echo $query;
if($result = $db->query($query_temp)) {
	$row = $result->fetch_row();
//	echo ' (' . $row[0] . ')';
} else {
	trigger_error('MySQL error: ' . $db->error, E_USER_WARNING);
	trigger_error('Related query: ' . $query, E_USER_NOTICE);
}

// Kui ei ole raamatX objekti, aga kui peaks, siis teeme, raamatX objekti
	if(!$row["0"])
	{
			//Lisamaterjalide alajaotise pealkirja ei näitame
			$show = $jaotis==3 ? 0 : 1;

			// Teeme raamatX objekti
			$query_insert="INSERT INTO raamatX (nimi_est,pid,book_id,nimi_show,type) VALUES ('".$alajaotused_nimed[$jaotis]."','2','".$book_id."','".$show."',$jaotis)";
//			echo $query_insert;
			$result = $db->query($query_insert);
			$tmp = $db->query("SELECT MAX(id) FROM raamatX");
			$last_id = $tmp->fetch_row();
			$raamatX_id = $last_id[0];
			$query_link="INSERT INTO raamatX_raamatX (oid1,oid2,book_id,sort_order) VALUES ('".$raamatXid."','".$raamatX_id."','".$book_id."','".$raamatX_id."')";
	//		echo $query_link,"<br><br>";
			$result = $db->query($query_link);

			//Vastav exp objekti
			$query_insert="INSERT INTO exp (nimi_est,raamatX_id,gpid_demo) VALUES ('".$alajaotused_nimed[$jaotis]."','".$raamatX_id."','43')";
	//		echo $query_insert;
			$result = $db->query($query_insert);
	}
}

//Kontrollime, et kõik kontrollküsimused on õige alajaotuse all, vajadusel korrigeerime
// Kontrollküsimuste alajaotus:
$query_temp="SELECT id,nimi_est FROM raamatX WHERE id IN (SELECT oid2 FROM raamatX_raamatX WHERE oid1 = '".$raamatXid."' AND book_id='".$book_id."') AND type = '2'";
if($result = $db->query($query_temp)) {
	$row = $result->fetch_row();
//  echo ' (' . $row[0] . ')';
}


// kontrollküsimuste exp objektid, mis on seotud kõigi selle pid=1 objekti alajaotustega
$query_exp = "SELECT id FROM exp WHERE id IN (SELECT oid2 AS raamatX_id FROM raamatX_exp WHERE oid1 IN (SELECT oid2 FROM raamatX_raamatX WHERE oid1 = '".$raamatXid."') AND book_id='".$book_id."' AND naita_veebis=0) AND gpid_demo IN (32,20,21)";
//echo $query_exp;

if($result = $db->query($query_exp)) {
	while($row1 = $result->fetch_row())
	{
		$query_exp1 = "UPDATE raamatX_exp SET oid1 = '".$row[0]."' WHERE oid2 = ".$row1[0]." AND oid1 IN (SELECT oid2 FROM raamatX_raamatX WHERE oid1 = '".$raamatXid."')";
//		echo $query_exp1."<br>";
		//$result2 = $db->query($query_exp1);
}
//	echo ' (' . $row[0] . ')';
}

//Kontrollime, et raamatX pöidlapilt oleks paigas


}



?>
