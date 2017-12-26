<?php
// PDF invoices

// We have to make sure that no unnecessary errors are printed
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("connect.php");
require_once 'header.php';
require_once 'invoice/invoice.php';
require_once 'globals.php';

//if(!AUTH_USER) die;

$aid = $_GET['aid'];

$query = "SELECT * FROM arve WHERE id={$aid}";
if($result = $db->query($query)) {
	$row = $result->fetch_array();
} else {
	trigger_error('MySQL error: ' . $db->error, E_USER_ERROR);
}
$line = $row; 

// Get school information
$query = "SELECT * FROM kool WHERE id={$line['kool_id']}";
if($result = $db->query($query)) {
	$row = $result->fetch_array();
} else {
	trigger_error('MySQL error: ' . $db->error, E_USER_ERROR);
}
$line_kool = $row;

//  == Variables ==
$invoice_number = $line['nmbr'];

// Date
$lopp = $line['date'];
$aasta = substr($lopp,0,4);
$kuu = substr($lopp,5,2);
$paevl = substr($lopp,8,2);
$kuul = utf_months($kuu);
$date = $paevl . '. ' . $kuul . ' ' . $aasta;

// Deadline
$deadline_isset = false;
if($line['maksetahtaeg']) 
{
	$deadline_isset = true;
	$lopp=$line['maksetahtaeg'];
	$aasta=substr($lopp,0,4);
	$kuu=substr($lopp,5,2);
	$paevl=substr($lopp,8,2);
	$kuul = utf_months($kuu);

	$deadline = $paevl . '. ' . $kuul . ' ' . $aasta; 

}

// Payer
$payer_isset = false; 
if($line['maksja_nimi']) {
	$payer_isset = true;
	$payer_name = $line['maksja_nimi'];
	$payer_address = $line['maksja_aadress'];
}

// School
$school_isset = false; 
if($line_kool['nimi']) {
	$school_isset = true;
	$school_name = $line_kool['nimi'];
	$school_address = $line_kool['aadress'];
}

// Item
$item_desc  = $line['mis_tehtud'];
$item_price = $line['summa'];
$item_count = $line['arv'];

// Second item
$item2 = false;
if(mb_strlen(trim($line['mis_tehtud_1'])) > 0) {
	$item2 = true;
	$item2_desc  = $line['mis_tehtud_1'];
	$item2_price = $line['summa_1'];
	$item2_count = $line['arv_1'];
}

$verbal_sum = $line['summa_sonadega'];


// == PDF generation ==
if($deadline_isset) {
	$invoice = new Invoice($invoice_number, $date, $deadline);
} else {
	$invoice = new Invoice($invoice_number, $date);
}

if($school_isset) {
	$invoice->setSchool($school_name, $school_address);
}

if($payer_isset) {
	$invoice->setPayer($payer_name, $payer_address);
}

$invoice->addItem($item_desc, $item_count, $item_price);
if($item2) $invoice->addItem($item2_desc, $item2_count, $item2_price);

$invoice->setVerbalSum($verbal_sum);

$invoice->output();
