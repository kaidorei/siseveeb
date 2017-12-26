<?php
/**
 * @file
 * ..?
 */

require_once 'header.php';

$goto = 'index.php'; // Default redirect URL

if($_GET['a'] == 'login') {
	if( isset($_POST['username']) && isset($_POST['password']) ) {
		$query = "SELECT id FROM isik WHERE password='" . md5($_POST['password']) . "' AND username='" . $db->real_escape_string($_POST['username']) . "'";
		$result = $db->query($query);
		
		if( $result->num_rows == 1 ) {
			$row = $result->fetch_assoc();
			$sm->createSession( $db, $row['id'] );
			
			// Legacy
			session_start();
			//$_SESSION['mysession'] = array ("login" => $_POST['username'], "passwd" => $_POST['password'], "ID" => session_id(), "valid" => 1);
			$_SESSION['mysession'] = array ("login" => $_POST['username'], "passwd" => '???', "ID" => session_id(), "valid" => 1);
			$_SESSION['count'] = 1;
			
			if( isset($_POST['redirect']) && strlen($_POST['redirect']) > 0 ) {
				$goto = 'index.php?' . $_POST['redirect'];
			}
		} else {
			$goto = 'index.php?denied';
		}
		
		$result->close();
	}
} else if($_GET['a'] == 'logout' && AUTH_USER) {
	$sm->destroySession( $db );
	
	// Legacy
	session_start();
	$_SESSION = array();
	setcookie( session_name(), '', time()-3600 );
	session_destroy();
}

// Default exit
if( DEBUG ) {
	echo $errorhandler->getHtmlErrors();
	echo '<a href="' . $goto . '">To "' . $goto . '"!</a>';
} else {
	header('Location: ' . $goto);
	exit();
}
