<?
@mysql_query("SELECT id FROM fyysika") or require('connect.php');
session_start();  
$login = $_SESSION['mysession']['login'];
$passwd = $_SESSION['mysession']['passwd'];
if (isset($login) and isset($passwd)){
	
	//$query="SELECT username FROM isik WHERE password='".md5($passwd)."' AND username='$login'";
	$query="SELECT username FROM isik WHERE username='{$login}'";
	$result = mysql_query($query);
	//if ($result == FALSE) header('Location: http://www.fyysika.ee/omad');
	if (mysql_num_rows($result)>0){ 
		//$login_true = true;
	} 
}    
else header('Location: http://www.fyysika.ee/omad');
?>
