<?php
// Configuration
require_once 'config.php';

// Creating and registering the error handler
require_once 'include/errorhandler.php';
$errorhandler = new ErrorHandler();
set_error_handler( array($errorhandler, 'handlerCallback') );
error_reporting( E_ALL & ~E_NOTICE );

// Including other libraries
require_once 'include/functions.php';
require_once 'include/sessionmanager.php';
require_once 'include/database.php';

// Establish database connection
if( MYSQL_LOGGING && !defined('NO_MYSQL_LOGGING') ) {
	$db = new Database($config['db']['host'], $config['db']['username'],  $config['db']['password'], $config['db']['database']);
} else {
	$db = new Database($config['db']['host'], $config['db']['username'],  $config['db']['password'], $config['db']['database'], false);
	//$db = new mysqli($config['db']['host'], $config['db']['username'],  $config['db']['password'], $config['db']['database']);
}

if($db->connect_error) {
	$error = 'Database connect error (' . $db->connect_errno . ') ' . $db->connect_error . "\n";
	file_put_contents('error.log', date('r') . ': ' . $error);

	echo 'ERROR: Database unavailable.' . "\n";
	if(DEBUG) echo $error;
	exit();
}

// Set encoding
$db->set_charset('utf8');
mb_internal_encoding('UTF-8');

// Start session and authenticate user
$sm = new SessionManager( $db, 'sv_session', $config['cookie'] );

// Validate the user session
if( $uid = $sm->validateSession($db) ) {
	define('AUTH_USER', true);

	$user = array();
	$query = "SELECT id,username,eesnimi,perenimi,privileegid,on_tugiisik FROM isik WHERE id={$uid}";
	if( ! ($result = $db->query($query)) ) {
		trigger_error($db->error, E_USER_ERROR);
		trigger_error('Related query: ' . $query, E_USER_NOTICE);

	}

	if( $result->num_rows == 1 ) {
		$row = $result->fetch_assoc();

		$user['uid'] = $row['id'];
		$user['username'] = $row['username'];
		$user['privs'] = (int)$row['privileegid'];

		$user['firstname'] = trim($row['eesnimi']);
		$user['lastname']  = trim($row['perenimi']);
		$user['name'] = $user['firstname'] . ' ' . $user['lastname'];

		// Register admin
		if($user['privs'] == 10) {
			define('AUTH_ADMIN', true);
		} else {
			define('AUTH_ADMIN', false);
		}
	} else {
		die("BAD SESSION");
	}

	$result->close();
} else {
	define('AUTH_USER', false);
	define('AUTH_ADMIN', false);
}

// Log session information
if( AUTH_USER ) {
	$db->setSessionVariable('session', $sm->sessionData($db));
	$db->setSessionVariable('user', $user);
	$db->setSessionVariable('username', $user['username']);
	$db->setSessionVariable('userid', $user['uid']);
	$loginform = 0;
} else {
	$db->setSessionVariable('session', false);
	$db->setSessionVariable('user',    false);
}

// Initiating legacy stuff
/* Connecting, selecting database
mysql_connect($config['db']['host'], $config['db']['username'],  $config['db']['password'])
        or die("Could not connect");
mysql_select_db($config['db']['database']) or die("Could not select database");
mysql_set_charset('utf8');*/

$uri = basename($PHP_SELF);
$stamp = md5(srand(5));

// Legacy logout
if(isset($_GET['bye'])) {
	session_start();
	$sm->destroySession( $db );

	$_SESSION = array();
	setcookie( session_name(), '', time()-3600 );
	session_destroy();

	header('Location: index.php');
	exit();
}

// Legacy variables
if( AUTH_USER && isset($user) ) {
	$login = $user['username'];
	$loginform = 0;

	// Session start and management (legacy session management)
	session_start();
	if( !isset($_SESSION['mysession']) ) {
				$_SESSION['mysession'] = array (
			"login" => $user['username'],
			"passwd" => '???',
			"ID" => session_id(),
			"valid" => 1
		);
	}
	if( !isset($_SESSION['count']) ) {
		$_SESSION['count'] = 1;
	}
} else {
	$loginform = 1;
}
