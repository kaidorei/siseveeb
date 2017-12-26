<?php
// PDF certificates

// We have to make sure that no unnecessary errors are printed
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once 'header.php';
require_once 'invoice/cert.php';
require_once 'globals.php';

if(!AUTH_USER) die;

$cid = explode('-', $_GET['cid']);
$certificate = (sizeof($cid) == 1) ? generate_certificate(0, intval($cid[0])) : generate_certificate(intval($cid[0]), intval($cid[1]));
$certificate->output('cert_'.$_GET['cid'].'.pdf', 'I');
