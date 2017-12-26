<?php
header('Content-Type: text/html; charset=utf-8');
// PDF certificates

// We have to make sure that no unnecessary errors are printed
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once 'header.php';
require_once 'globals.php';
require_once 'Rmail/Rmail.php';
require_once 'Rmail/RFC822.php';
require_once 'invoice/cert.php';

if(!AUTH_USER) die;

function get_person($id) {
	global $db;
	$query = "SELECT * FROM isik WHERE id={$id}";
	if(!($result2 = $db->query($query))) {
		trigger_error('MySQL error: ' . $db->error, E_USER_ERROR);
	}
	if($result2->num_rows == 1) {
		$isik = $result2->fetch_assoc();
		$keys = array('eesnimi', 'perenimi', 'email1', 'email2');
		foreach($keys as $key) {
			$isik[$key] = trim($isik[$key]);
		}
		return $isik;
	} else {
		echo 'Bad person ID.';
		return null;
	}
}

function encode_header($str) {
	return mb_encode_mimeheader($str, 'UTF-8', 'B', "\n");
}

if(isset($_GET['generate'])) { // If a generation request is sent
	var_dump($_POST);
	foreach($_POST['pinfo'] as $p) {
		if(!isset($p['check'])) continue;
		$body = $_POST['body'];
		
		foreach($p as $k=>$v) {
			$body = str_replace('[['.$k.']]', $v, $body);
		}
		
		$stmt = $db->prepare('INSERT INTO sv_certificate (year, date, text) VALUES (?, ?, ?)');
		$stmt->bind_param('iss', $_POST['year'], $_POST['date'], $body);
		if(!$stmt->execute()) {echo 'Error: '.$stmt->error.'<br />'.PHP_EOL;}
		$stmt->close();
		
		$p['email'] = trim($p['email']);
		if(strlen($p['email']) > 0) {
			echo strlen($p['email']);
			$lastid = $db->query('SELECT @lastYear,@lastID')->fetch_assoc();
			
			$stmt = $db->prepare('INSERT INTO sv_certificate_email (certificate_year,certificate_id,email) VALUES (?,?,?)');
			$stmt->bind_param('iis', $lastid['@lastYear'], $lastid['@lastID'], $p['email']);
			if(!$stmt->execute()) {echo 'Error: '.$stmt->error.'<br />'.PHP_EOL;}
			$stmt->close();
		}
		
		echo $_POST['date'].': '.$body.'<br />'.PHP_EOL;
	}
	
} elseif(isset($_GET['sendmails'])) {
	foreach($_POST['emails'] as $email) {
		$mail = new Rmail();
		$mail->setHeadCharset('UTF-8');
		$mail->setTextCharset('UTF-8');
		$mail->setFrom($_POST['from']);
		$mail->setSubject(encode_header($_POST['subject']));
		$mail->setText($_POST['body']);
		$mail->addAttachment(new stringAttachment(
			generate_certificate(intval($email['year']), intval($email['id']))->output('cert.pdf', 'S'),
			'toend.pdf',
			'application/pdf'
		));
		
		$r = $mail->send(array($email['email']));
		$r = $mail->send(array('morten.piibeleht+phpspam@gmail.com'));
		
		$db->query('UPDATE sv_certificate_email SET sent=1 WHERE certificate_year='.intval($email['year']).' AND certificate_id='.intval($email['id']));
	}
} elseif(isset($_GET['reis'])) { // If trip ID is given, show a form for adding:
	$tid = intval($_GET['reis']);

	$query = "SELECT * FROM reis WHERE id={$tid}";
	if(!($result = $db->query($query))) {
		trigger_error('MySQL error: ' . $db->error, E_USER_ERROR);
	}
	
	if($result->num_rows == 1) {
		$reis = $result->fetch_assoc();
		
		$query = "SELECT * FROM reis_isik WHERE oid1={$tid}";
		if(!($result = $db->query($query))) {
			trigger_error('MySQL error: ' . $db->error, E_USER_ERROR);
		}
		
		echo '<form method="POST" action="?generate">'.PHP_EOL;
		echo '<h1>Genereeri tõendid reisile "'.$reis['nimi'].'" ('.$reis['id'].')</h1>'.PHP_EOL;
		echo '<textarea name="body" cols="30" rows="5">'.$reis['toend'].'</textarea>'.PHP_EOL;
		echo "<br>";
		echo 'Date of issue: <input type="text" name="date" value="'.date('Y-m-d').'" />'.PHP_EOL;
		echo 'Year: <input type="text" name="year" value="'.date('Y').'" />'.PHP_EOL;
		
		echo '<table border="1">'.PHP_EOL;
		echo '<tr><th>X</th><th>eesnimi</th><th>perenimi</th><th>email</th><th>email1</th><th>email2</th></tr>'.PHP_EOL;
		$rowid = 0;
		while($row = $result->fetch_assoc()) {
			$isik = get_person($row['oid2']);
			
			$email = $isik['email1'];
			
			echo '<tr>'.PHP_EOL;
			//echo '<td><input name="pinfo['.$rowid.'][check]" type="checkbox" checked="checked" /></td>'.PHP_EOL;
			echo '<td><input name="pinfo['.$rowid.'][check]" type="checkbox" checked="checked" /></td>'.PHP_EOL;
			echo '<td><input name="pinfo['.$rowid.'][eesnimi]" type="text" value="'.$isik['eesnimi'].'" /></td>'.PHP_EOL;
			echo '<td><input name="pinfo['.$rowid.'][perenimi]" type="text" value="'.$isik['perenimi'].'" /></td>'.PHP_EOL;
			echo '<td><input name="pinfo['.$rowid.'][email]" type="text" value="'.$email.'" /></td>'.PHP_EOL;
			echo '<td>'; var_dump($isik['email1']); echo '</td>'.PHP_EOL;
			echo '<td>'; var_dump($isik['email2']); echo '</td>'.PHP_EOL;
			echo '</tr>'.PHP_EOL;
			
			$rowid++;
		}
		echo '</table>'.PHP_EOL;
		echo '<input type="submit" value="Genereeri" />'.PHP_EOL;
		echo '</form>'.PHP_EOL;
	} else {
		echo 'Bad trip ID.';
	}
}

// Table of certificates
$query = "SELECT * FROM sv_certificate";
$result = $db->query($query);
if(!$result) {
	trigger_error('MySQL error: ' . $db->error, E_USER_ERROR);
}

echo '<h1>Tõendid</h1>'.PHP_EOL;
echo '<table border="1">'.PHP_EOL;
echo '<tr><th>CID</th><th>Issued</th><th>Body</th></tr>'.PHP_EOL;
while($row = $result->fetch_assoc()) {
	$cid_text = is_null($row['year'] != 0) ? strval($cert_id) : sprintf('%d-%02d', $row['year'], $row['id']);
	
	echo '<tr>';
	echo '<td><a href="cert_pdf.php?cid='.$cid_text.'" target="_blank">'.$cid_text.'</a></td>';
	echo '<td>'.$row['date'].'</td>';
	echo '<td>'.$row['text'].'</td>';

	echo '<td>';
	$result2 = $db->query('SELECT * FROM sv_certificate_email WHERE certificate_year='.$row['year'].' AND certificate_id='.$row['id']);
	if($result2->num_rows == 0) {
		echo ' --- ';
	} else {
		$first = true;
		while($row2 = $result2->fetch_assoc()) {
			echo ($first?'':'; ').$row2['email'];
			$first = false;
		}
	}
	echo '</td>';

	echo '</tr>'.PHP_EOL;
}
echo '</table>'.PHP_EOL;


echo '<form method="POST" action="?sendmails">'.PHP_EOL;
echo '<h1>Saada tõendid meilidena:</h1>'.PHP_EOL;
echo 'From: <input type="text" name="from" value="Kaido Reivelt <kaido@fyysika.ee>" />'.PHP_EOL;
echo 'Subject: <input type="text" name="subject" value="Tõend" >'.PHP_EOL;
echo 'Body: <textarea name="body">Saadame tõendi.</textarea>'.PHP_EOL;

echo '<table border="1">'.PHP_EOL;
echo '<tr><th>Tõend</th><th>email</th></tr>'.PHP_EOL;
$query = "SELECT * FROM sv_certificate_email WHERE sent=0";
if(!($result = $db->query($query))) {
	trigger_error('MySQL error: ' . $db->error, E_USER_ERROR);
}
$rowid=0;
while($row = $result->fetch_assoc()) {
	echo '<tr>';
	echo '<input type="hidden" name="emails['.$rowid.'][year]" value="'.$row['certificate_year'].'" />';
	echo '<input type="hidden" name="emails['.$rowid.'][id]" value="'.$row['certificate_id'].'" />';
	echo '<td>'.$row['certificate_year'].'-'.$row['certificate_id'].'</td>';
	echo '<td>'.$row['email'].'</td>';
	echo '</tr>';
	
	$rowid++;
}
echo '</table>'.PHP_EOL;

echo '<input type="submit" value="Saada" />'.PHP_EOL;
echo '</form>'.PHP_EOL;

?>
<h1>Lisa tõendid reisi põhjal:</h1>
<form method="GET">
Reisi ID: <input type="text" name="reis" />
<input type="submit" value="Hakka lisama" />
</form>
