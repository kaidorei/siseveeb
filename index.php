<?php
$starttime = microtime(true);
require_once 'header.php';require_once 'include/template.php';
header('Content-Type: text/html; charset=utf-8');

// If the user is not logged in, display login form and quitif( ! AUTH_USER ) {

	if( isset($_GET['denied']) ) {
		$denied = '<tr><td colspan="2" class="error">Vale kasutajanimi/parool</td></tr>';
	} else {
		$denied = '';
	}
	$logintpl = new Template( file_get_contents('template/login.html') );	$logintpl->setTag('DENIED', $denied);
	$logintpl->setTag('QUERY_STRING', $_SERVER['QUERY_STRING']);
	exit( $logintpl->parse() );

}
/** * Used to keep included scripts from accessed directly.
 * Included pages check if this constant is defined.
 */

define('SISEVEEB', true);
$template = new HTMLTemplate('template/main.html');$template->setTag('FORM_1_ACTION', $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
$template->setTag('USERNAME', $user['username']);
$template->setTag('NAME', $user['name']);
$template->setTag('DATE', date("d-m-Y"));

function create_menu_item($name, $link, $row, $minprivs, $support, $chk) {
	return array( 'name'  => $name,	              'link'  => $link,
	              'row'   => $row,
	              'privs' => $minprivs,
	             	'tugi'  => $support,
	              'chkd'  => $chk
	);

}
$menuitems = array(
	create_menu_item('AVALEHT', 'index.php', 2, 0, false, false),	create_menu_item('Eksp', '?page=exp_tree&klass=kool&op=3,4', 2, 0, false, false)

);

// Legacy variables
$page = isset($_GET['page']) ? $_GET['page'] : 'foorum_table'; // Assume, that default is "foorum_table"$dom = substr( $page, 0, strpos($page, '_') );
$tabel_string = isset($_GET['otsing']) ? $_GET['otsing'] : NULL;
$sel = isset($_GET['sel']) ? $_GET['sel'] : NULL;

$line = array(	'id'          => $user['uid'],
	'privileegid' => $user['privs'],
	'eesnimi'     => $user['firstname'],
	'perenimi'    => $user['lastname']
);

$priv=$user['privs'];$login_id=$user['uid'];
$login_nimi=$user['name'];

ob_start();
//require_once 'menurows.php';
$menu = ob_get_clean();$template->setTag('MENU', $menu);

ob_start();
require_once 'main.php';

$p = ob_get_clean();
$template->setTag('PAGE', $p);
// Debuggingif(DEBUG){ //|| AUTH_ADMIN ) { // debugimiseks tuleb teha ka muudatus config.php-s

	$d_html = '<div class="debugitem"><b>{N}:</b> {V}</div>';	$dis  = '<div id="debug"><div id="debugheader">Statistics</div>';;
	$dis .= '<div class="debugitem"><b>Generation time:</b> ' . (microtime(true)-$starttime) . ' seconds</div>';
	$dis .= '<div class="debugitem"><b>Real generation time:</b> {REAL_GEN_TIME} seconds</div>';
	$dis .= '<div class="debugitem"><b>Queries performed:</b> ' . $db->getQueryCounter() . '</div>';
	$dis .= '</div>';

	$err = $errorhandler->getHTMLErrors();	$dbq = $db->getHtmlQueries();
	$template->setTag('DEBUG', $dis.$err.$dbq);

} else {	$template->setTag('DEBUG', '');
}

// Output HTMLecho str_replace('{REAL_GEN_TIME}', microtime(true) - $starttime, $template->parse());
//echo $template->parse();
