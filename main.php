<?php if(!defined('SISEVEEB')) header('Location: index.php'); ?>

<?php

$klass = $_GET['klass'];
$aastakene = $_GET['aasta'];
$action = $_GET['action'];
$liik = $_GET['liik'];
$etendus_id = $_GET['etendus_id'];

// peaks individualiseerima

if(!$etendus_id) $etendus_id=1;
if(!$aastakene) $aastakene="2017";
if(strlen($page) < 1) $page="foorum_table";

switch($dom){

	case 'exp':
		echo '<a href="index.php?page=exp_tree&klass=kool&op=3,4">&Otilde;piobjektid, erinevates jaotustes</a>';
		$query = "SELECT count(*) FROM exp";
		if($result = $db->query($query)) {
			$row = $result->fetch_row();
			echo ' (' . $row[0] . ')';
		} else {
			trigger_error('MySQL error: ' . $db->error, E_USER_WARNING);
			trigger_error('Related query: ' . $query, E_USER_NOTICE);
		}
		break;
	}


		require_once $page . '.php';

?>
