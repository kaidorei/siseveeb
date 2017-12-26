<?php

// Make sure it's a cronjob/CLI

if( php_sapi_name() != 'cli' ) die('Forbidden for ' . php_sapi_name());



// Configuration

// Note: in order to be enabled: SPAM = LIVE = true, DEBUG_MAILS = false

/**

 * if true, send out all emails (but to real persons only if LIVE is also true

 * and DEBUG_MAILS is false)

 */

define('SPAM',         true);

/** if true, sends out emails to real persons */

define('LIVE',         true);

/**

 * if true, overrides 'LIVE' and sends mail to $DEBUG_MAIL_TO instead of the

 * real recipients (if SPAM is true, sends one mail per original recipient;

 * if SPAM is false, sends out a single email).

 */

define('DEBUG_MAILS', false);

/** if true, sends out the summary email */

define('SUMMARY',      true);

/** if true, prints out mails, summary etc. */

define('VERBOSE',      true);

/** if true, ignores LOCK_FILE locking */

define('IGNORE_LOCK', true);

/** if true, sends out a pseudoevent instead */

define('PSEUDOEVENT', false);



/* 

 * Comma separated list of courseid's (in mdl_event)

 * 12 - Füüsika õpikoda - gümnaasium

 * 13 - Keemia õpikoda

 * 14 - Füüsika õpikoda - põhikool

 * 15 - Bioloogia õpikoda

 * */

//$EVENT_COURSE_IDS = '12,13,14,15';

//$EVENT_COURSE_IDS = '13,15';

//$EVENT_COURSE_IDS = '17,18,19,20';

$EVENT_COURSE_IDS = '29,30,31,32';



$DEBUG_SUMMARY_TO   = array();

$DEBUG_SUMMARY_TO[] = 'opikojad@fyysika.ee';

//$DEBUG_SUMMARY_TO[] = 'morten.piibeleht+phpspam@gmail.com';

$DEBUG_SUMMARY_TO[] = 'kaido.reivelt+phpspam@gmail.com';

//$DEBUG_SUMMARY_TO[] = 'mariinkarp+phpspam@gmail.com';



$DEBUG_MAILS_TO   = array();

//$DEBUG_MAILS_TO[] = 'morten.piibeleht+phpspam@gmail.com';

$DEBUG_MAILS_TO[] = 'kaido.reivelt+phpspam@gmail.com';

//$DEBUG_MAILS_TO[] = 'mariinkarp+phpspam@gmail.com';



define('MAILS_FROM', 'Kaido Reivelt <opikojad@fyysika.ee>');



define('CHARSET_HEADER', 'UTF-8');

define('CHARSET_BODY', 'UTF-8');



define('LOCK_FILE', 'memoskript.lock');



// Set PHP directives

ini_set('html_errors', 0); // We want textual error reporting

chdir(dirname(__FILE__)); // Working directory



// Dependencies

require_once 'config.php';

require_once 'database.php';



require_once 'Rmail.php';

require_once 'RFC822.php';



if(VERBOSE) header('Content-Type: text/plain; charset=utf-8');



$db = new Database($config['db']['host'], $config['db']['username'],  $config['db']['password'], 'fyysika_nina', 'fyysika_nina');



$db->set_charset('utf8');

mb_internal_encoding('UTF-8');



define('SEC_IN_DAY', 60*60*24);



function weekday_est_adessive($wd) {

	switch($wd) {

		case 1: return 'esmaspäeval'; break;

		case 2: return 'teisipäeval'; break;

		case 3: return 'kolmapäeval'; break;

		case 4: return 'neljapäeval'; break;

		case 5: return 'reedel'; break;

		case 6: return 'laupäeval'; break;

		case 7: return 'pühapäeval'; break;

		default: return 'Error: $wd=' . $wd; break;

	}

}



function month_est_adessive($m) {

	switch($m) {

		case  1: return 'jaanuaril'; break;

		case  2: return 'veebruaril'; break;

		case  3: return 'märtsil'; break;

		case  4: return 'aprillil'; break;

		case  5: return 'mail'; break;

		case  6: return 'juunil'; break;

		case  7: return 'juulil'; break;

		case  8: return 'augustil'; break;

		case  9: return 'septembril'; break;

		case 10: return 'oktoobril'; break;

		case 11: return 'novembril'; break;

		case 12: return 'detsembril'; break;

		default: return 'Error: $m=' . $m; break;

	}

}



function encode_header($str) {

	return mb_encode_mimeheader($str, 'UTF-8', 'B', "\n");

}



function reduce_ts($ts, $tz_s = 'Europe/Tallinn') {

	if($tz_s) {

		$tz = new DateTimeZone($tz_s);

		$tz_offset = $tz->getOffset(new DateTime('@'.$ts, $tz));

		return $ts - (($ts+$tz_offset)%SEC_IN_DAY);

	} else {

		return $ts - ($ts%SEC_IN_DAY);

	}

}



function day_shift($days, $relative) {

	$relative = reduce_ts($relative);

	

	return array('s' => $relative + $days*SEC_IN_DAY,

	             'e' => $relative + ($days+1)*SEC_IN_DAY-1

	);

}



function html2plain($raw) {

	$raw = preg_replace('/<br>|<br \/>|<br\/>/u', "\n", $raw);

	$raw = preg_replace('/<.*>/uU', '', $raw);

	

	return $raw ;

}



function get_members( $groupid ) {

	global $db;

	$ret = array();

	

	$query = "SELECT userid,mdl_user.email,mdl_user.firstname,mdl_user.lastname FROM mdl_groups_members JOIN mdl_user WHERE mdl_groups_members.groupid={$groupid} AND mdl_user.id=mdl_groups_members.userid";

	$result = $db->query($query);

	while( $row = $result->fetch_assoc() ) {

		$ret[] = $row;

	}

	

	return $ret;

}



function get_events( $s, $e ) {

	global $db, $EVENT_COURSE_IDS;

	$ret = array();



	$result = $db->query("SELECT id,name,timestart,groupid,description FROM mdl_event WHERE timestart BETWEEN {$s} AND {$e} AND courseid IN (" . $EVENT_COURSE_IDS . ")");

	while( $row = $result->fetch_assoc() ) {

		$row['people'] = get_members( $row['groupid'] );

		$row['description'] = html2plain($row['description']);

		

		$ret[] = $row;

	}

	

	return $ret;

}



function parse_events($es) {

	$body = '';

	

	foreach($es as $e) {

		$body .= $e['name'] . "\n";

		$body .= 'Start: ' . date('r', $e['timestart']) . "\n";

		

		$body .= 'Description: ';

		$body .= $e['description'];

		$body .= "\n";

		

		$body .= 'People: ';

		$body .= join(', ', array_map(function($a) {return $a['firstname'].' '.$a['lastname'].' <'.$a['email'].'>';}, $e['people']));

		$body .= "\n\n";

	}

	$body .= "\n";

	

	return $body;

}



// Day relative to the notification

$time = time();



// for logs

if(VERBOSE) {

	echo '====================================================================================================' . "\n";

	echo 'Log started: ' . date('r') . "\n\n";

}



// Check for a lock or lock the file

if( file_exists(LOCK_FILE) && file_get_contents(LOCK_FILE) == reduce_ts($time) && !IGNORE_LOCK ) {

	$mail = new Rmail();

	$mail->setHeadCharset(CHARSET_HEADER);

	$mail->setTextCharset(CHARSET_BODY);

	$mail->setFrom(MAILS_FROM);

	$mail->setSubject( encode_header('ERROR: Õpikodade meeldetuletus') );

	$mail->setText( 'Script already ran today!' . "\n" . __FILE__ );

	if(SUMMARY) $r = $mail->send($DEBUG_SUMMARY_TO); // only notify if summary is enabled

	die('Script already ran today!' . "\n");

} else {

	file_put_contents(LOCK_FILE, reduce_ts($time));

}



// Time intervals

$sh_2 = day_shift(2, $time);

$sh_7 = day_shift(7, $time);



// Lists of events

$events_2 = get_events($sh_2['s'], $sh_2['e']);

$events_7 = get_events($sh_7['s'], $sh_7['e']);



$body  = 'Today: ' . date('r') . '.' . "\n";

$body .= 'Events relative to: ' . date('r', $time) . "\n\n\n";

$body .= '2 Day notifications'."\n";

$body .= 'From ' . date('r', $sh_2['s']) . ' to ' . date('r', $sh_2['e']) . "\n\n";

$body .= parse_events($events_2);

$body .= '7 Day notifications'."\n";

$body .= 'From ' . date('r', $sh_7['s']) . ' to ' . date('r', $sh_7['e']) . "\n\n";

$body .= parse_events($events_7);



// Actual email

$mail_counter = 0;



function mail_event($e, $days) {

	global $DEBUG_MAILS_TO, $mail_counter;

	

	$subject = $e['name'];

	

	$body  = 'Tere,' . "\n";

	$body .= "\n";

	$body .= $e['name'] . ' toimub ' . weekday_est_adessive(date('N',$e['timestart'])) . ', ' . date('j', $e['timestart']) . '. ' . month_est_adessive(date('n', $e['timestart'])) . '.' . "\n";

	$body .= $e['description'] . "\n";

	$body .= 'Algus: ' . date('H:i', $e['timestart']) . '.' . "\n";

	$body .= "\n";

	$body .= 'Parimat,' . "\n";

	$body .= 'Kaido Reivelt' . "\n";

	

	// Actual email

	$mail = new Rmail();

	$mail->setHeadCharset(CHARSET_HEADER);

	$mail->setTextCharset(CHARSET_BODY);

	$mail->setFrom(MAILS_FROM);

	$mail->setSubject( encode_header($subject) );

	$mail->setText( $body );

	

	$m  = '=============================================================' . "\n";

	$m .= 'From: '    . MAILS_FROM . "\n";

	$m .= 'Subject: ' . $subject . "\n";

	$m .= '-------------------------------------------------------------' . "\n";

	$m .= $body . "\n";

	$m .= '-------------------------------------------------------------' . "\n";

	

	if(SPAM) {

		foreach( $e['people'] as $p ) {

			$to = $p['email'];

			

			$r = '<$r declared on line ' . __LINE__ . '>';

			if( Mail_RFC822::isValidInetAddress($to) ) {

				if(DEBUG_MAILS) {

					
					$r  = $mail->send($DEBUG_MAILS_TO)  ? 'success' : 'fail';

					$r .= ' (debug)';

					

					$mail_counter++;

				} else if(LIVE) {

					// These lines actually send out the email!

					$r = $mail->send(array($to)) ? 'success' : 'fail';

					//$r = 'LIVE MAIL DISABLED!' . "\n" . 'Line: ' . __LINE__;

					

					$mail_counter++;

				} else {

					$r = 'disabled';

				}

			} else {

				$r = 'bad email (' . $to . ') for ' . $p['firstname'] . ' ' . $p['lastname'];

			}

			

			$m .= 'Result: ' . $r . '; To: ' . $to . "\n";

		}

	} else if(DEBUG_MAILS) {

		$r  = $mail->send($DEBUG_MAILS_TO)  ? 'success' : 'fail';

		$m .= 'Result: ' . $r . '; Single debug email.' . "\n";

		

		$mail_counter++;

	} else {

		$m .= 'Sending mails disabled.' . "\n";

	}

	

	return $m . "\n";

}



if(PSEUDOEVENT) {

	// Event:  id, name, timestart, groupid, people

	// People: userid, email, firstname, lastname

	$body .= 'Emailing a pseudoevent' . PHP_EOL;

	$body .= PHP_EOL;



	$event = array('id'=>213, 'name'=>'Proovisündmus', 'timestart'=>413624511, 'groupid'=>123);

	$event['people'] = array(

		array('userid'=>0, 'email'=>'morten.piibeleht+phpspam@gmail.com', 'firstname'=>'Morten', 'lastname'=>'Piibeleht'),

		array('userid'=>1, 'email'=>'mortenpi@ut.ee', 'firstname'=>'Morten', 'lastname'=>'Piibeleht@ut.ee'),

		array('userid'=>2, 'email'=>'morten@fyysika.eu', 'firstname'=>'Morten', 'lastname'=>'Piibeleht@fyysika.eu'),

		array('userid'=>5, 'email'=>'kaido.reivelt+phpspam@gmail.com', 'firstname'=>'Kaido', 'lastname'=>'Reivelt'),

		array('userid'=>6, 'email'=>'kaido@fyysika.ee', 'firstname'=>'Kaido', 'lastname'=>'Reivel@fyysika.ee'),

		array('userid'=>0, 'email'=>'morten.piibeleht+phpspam@gmail.com', 'firstname'=>'Morten', 'lastname'=>'Piibeleht-2')

	);

	$body .= mail_event($event, 0);

} else {

	// Send out event notifications

	foreach($events_2 as $e) {

		$body .= mail_event($e, 2);

	}

	foreach($events_7 as $e) {

		$body .= mail_event($e, 7);

	}

}





$body .= '=============================================================' . "\n";

$body .= 'Emails sent: ' . $mail_counter . "\n";



// Output the summary

if(VERBOSE) echo $body;



// Summary email

if(SUMMARY) {

	$mail = new Rmail();

	$mail->setHeadCharset(CHARSET_HEADER);

	$mail->setTextCharset(CHARSET_BODY);

	$mail->setFrom(MAILS_FROM);

	$mail->setSubject( encode_header( 'SUMMARY: õpikojad (' . date('r') . '; ' . __FILE__ . ')' ) );

	$mail->setText( $body );

	

	$r = $mail->send($DEBUG_SUMMARY_TO);

	

	if(VERBOSE) echo 'Summary email: ' . ($r?'sent':'failed') . "\n\n";

} else {

	if(VERBOSE) echo 'Summary email: disabled' . "\n\n";

}

