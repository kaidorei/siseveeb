<?
include("connect.php");
include("authsys.php");	
if($loginform==1){
	echo "Juurdepääs keelatud!";}
else {
	$oid=$_GET["oid"];	
	$dom=$_GET["domain"];

	$tehtud=0;	
	if($_GET["act"]=="upi"){	
		echo "uploading ... ";
		if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
			$filename = $_FILES['userfile']['tmp_name'];
    		$realname = $_FILES['userfile']['name'];
			$query="SELECT id FROM ".$dom." ORDER BY id DESC LIMIT 1";
			$result=mysql_query($query);
			$line=mysql_fetch_array($result);
			$newid=$line["id"]+1;
			$url="media/".$dom."/".$newid."_".$realname;
			copy($_FILES["userfile"]["tmp_name"],$url);
			$query="INSERT INTO ".$dom." (nimi,url,oid,allkiri_est,allkiri_eng,allkiri_rus) VALUES (\"".$_POST["nimi"]."\",\"".urlencode($url)."\",\"".$oid."\",\"".$_POST["allkiri_est"]."\", \"".$_POST["allkiri_eng"]."\", \"".$_POST["allkiri_rus"]."\")";
		echo $query;
			$result=mysql_query($query);
   			$tehtud=1;
		} else {
		echo "Mingi jama juhtus :("; 
     	} 
	}
?>
<link href="scat.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.back {
	background-color: #FFFFFF;
	border: 2px none #CCCCCC;
}
-->
</style>
<script>

function aken(){
window.open('about:blank','uploader','width=420,height=20,top=100,toolbar=no');
return true;
}

function ending(){
	window.opener.location.reload();
	window.close();
}

function ehee(){
		self.opener.ending();
		window.close();
}

</script>
<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>>
<? if($tehtud!=1) {?><table width="100%" border="0" cellspacing="1" cellpadding="0">
  	<tr> 
    	<td width="50" background="image/sinine.gif" class="menu" >V&auml;li</td>
    	<td width="370" background="image/sinine.gif" class="menu">Sisu</td>
  	</tr>
	<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&oid=<? echo $oid; ?>&domain=<? echo $dom; ?>" target="uploader" onSubmit="return aken();">
	<tr>
		<td class="options"> <?  echo $dom; ?></td>
		<td class="options">
	<input name="userfile" size="45" type="file" class="button">
	<br>
	<span class="menu_punane"><strong>NB faili nimi ei tohi sisaldada t&uuml;hikuid ja t&auml;pit&auml;hti.</strong></span></td>  
</tr>
<tr background="image/sinine.gif"> 
	<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
<tr > 
    <td colspan="1" class="options" >Nimi</td>
    <td colspan="1" class="options" > 
      <input name="nimi" type="text" class="button" size="45" value="pilt"></td>
</tr>
<tr background="image/sinine.gif"> 
	<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
<tr > 
    <td colspan="1" class="options" >allkiri EST</td>
    <td colspan="1" class="options" > 
      <textarea name="allkiri_est" cols="49" rows="3" class="fields"></textarea></td>
</tr>
<tr background="image/sinine.gif"> 
	<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
<tr > 
    <td colspan="1" class="options" >allkiri ENG</td>
    <td colspan="1" class="options" > 
      <textarea name="allkiri_eng" cols="49" rows="3" class="fields"></textarea></td>
</tr>
<tr background="image/sinine.gif"> 
	<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
<tr > 
    <td colspan="1" class="options" >allkiri RUS</td>
    <td colspan="1" class="options" > 
      <textarea name="allkiri_rus" cols="49" rows="3" class="fields"></textarea></td>
</tr>
<tr background="image/sinine.gif"> 
	<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
<tr align="left" > 
    <td colspan="2" class="menu" >
	<input type="submit" name="suva1" class="button" value="Lisa" >
	<input type="button" name="suva12" class="button" value="Katkesta" onClick="window.close();"> 
    </td>
</tr>
</form>
</table>
<? } 
}
?>