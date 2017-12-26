<?php
$starttime = microtime(true);
require_once 'header.php';
header('Content-Type: text/html; charset=utf-8');

// If the user is not logged in, display login form and quit

	if( isset($_GET['denied']) ) {
		$denied = '<tr><td colspan="2" class="error">Vale kasutajanimi/parool</td></tr>';
	} else {
		$denied = '';
	}
	$logintpl = new Template( file_get_contents('template/login.html') );
	$logintpl->setTag('QUERY_STRING', $_SERVER['QUERY_STRING']);
	exit( $logintpl->parse() );

}
/**
 * Included pages check if this constant is defined.
 */

define('SISEVEEB', true);
$template = new HTMLTemplate('template/main.html');
$template->setTag('USERNAME', $user['username']);
$template->setTag('NAME', $user['name']);
$template->setTag('DATE', date("d-m-Y"));

function create_menu_item($name, $link, $row, $minprivs, $support, $chk) {
	return array( 'name'  => $name,
	              'row'   => $row,
	              'privs' => $minprivs,
	             	'tugi'  => $support,
	              'chkd'  => $chk
	);

}
$menuitems = array(
	create_menu_item('AVALEHT', 'index.php', 2, 0, false, false),

);

// Legacy variables
$page = isset($_GET['page']) ? $_GET['page'] : 'foorum_table'; // Assume, that default is "foorum_table"
$tabel_string = isset($_GET['otsing']) ? $_GET['otsing'] : NULL;
$sel = isset($_GET['sel']) ? $_GET['sel'] : NULL;

$line = array(
	'privileegid' => $user['privs'],
	'eesnimi'     => $user['firstname'],
	'perenimi'    => $user['lastname']
);

$priv=$user['privs'];
$login_nimi=$user['name'];

ob_start();
//require_once 'menurows.php';
$menu = ob_get_clean();

ob_start();
require_once 'main.php';

$p = ob_get_clean();
$template->setTag('PAGE', $p);
// Debugging

	$d_html = '<div class="debugitem"><b>{N}:</b> {V}</div>';
	$dis .= '<div class="debugitem"><b>Generation time:</b> ' . (microtime(true)-$starttime) . ' seconds</div>';
	$dis .= '<div class="debugitem"><b>Real generation time:</b> {REAL_GEN_TIME} seconds</div>';
	$dis .= '<div class="debugitem"><b>Queries performed:</b> ' . $db->getQueryCounter() . '</div>';
	$dis .= '</div>';

	$err = $errorhandler->getHTMLErrors();
	$template->setTag('DEBUG', $dis.$err.$dbq);

} else {
}

// Output HTML
//echo $template->parse();