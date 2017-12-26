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
			$url="media/exp_docs/".$newid."_".$realname;
			copy($_FILES["userfile"]["tmp_name"],$url);
			$query="INSERT INTO exp".$oid."_tulemused (akt_url, koguja_algus, koguja_lopp, kool_id, isik_id, koguja_O3, koguja_NH3, koguja_SO2, koguja_NO2) VALUES (\"".urlencode($url)."\",\"".$_POST["koguja_algus"]."\",\"".$_POST["koguja_lopp"]."\",\"".$_POST["kool_id"]."\", \"".$_POST["isik_id"]."\", \"".$_POST["koguja_O3"]."\", \"".$_POST["koguja_NH3"]."\", \"".$_POST["koguja_SO2"]."\", \"".$_POST["koguja_NO2"]."\")";
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
		<td class="options">Akt</td>
		<td class="options">
	<input name="userfile" size="45" type="file" class="button">
	<br>
	<span class="menu_punane"><strong>NB faili nimi ei tohi sisaldada t&uuml;hikuid ja t&auml;pit&auml;hti.</strong></span></td>  
</tr>
<tr background="image/sinine.gif"> 
	<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
<tr > 
    <td colspan="1" class="options" >M. algus 0000-00-00 00:00:00</td>
    <td colspan="1" class="options" > 
      <input name="koguja_algus" type="text" class="button" size="45"></td>
</tr><tr > 
    <td colspan="1" class="options" >M. l&otilde;pp 0000-00-00 00:00:00</td>
    <td colspan="1" class="options" > 
      <input name="koguja_lopp" type="text" class="button" size="45"></td>
</tr><tr > 
    <td colspan="1" class="options" >Kool</td>
    <td colspan="1" class="options" ><?
    
				$query2="SELECT * FROM kool_pacs WHERE oid2=".$pid." ORDER BY order1";
				echo $query2;
				$result2=mysql_query($query2);
				echo "<select  class=\"fields\" name=\"kool_id\">";
						echo "<option value=\"0\"></option>"; 
				while($var=mysql_fetch_array($result2)){
					
					$query0="SELECT nimi FROM kool WHERE id=".$var["oid1"]."";
					$result0=mysql_query($query0);
					$var0=mysql_fetch_array($result0);
					echo "<option value=\"".$var["oid1"]."\" ".$sel.">".$var0["nimi"]."</option>"; 
				}
					echo "</select>";
	
	
	
	?></td>
</tr><tr > 
    <td colspan="1" class="options" >Isik</td>
    <td colspan="1" class="options" > <? echo "isiku nimi, kes andmed sisestab";?></td>
</tr><tr > 
    <td colspan="1" class="options" >O3</td>
    <td colspan="1" class="options" > 
      <input name="koguja_O3" type="text" class="button" size="45" ></td>
</tr><tr > 
    <td colspan="1" class="options" >NH3</td>
    <td colspan="1" class="options" > 
      <input name="koguja_NH3" type="text" class="button" size="45" ></td>
</tr><tr > 
    <td colspan="1" class="options" >SO2</td>
    <td colspan="1" class="options" > 
      <input name="koguja_SO2" type="text" class="button" size="45" ></td>
</tr><tr > 
    <td colspan="1" class="options" >NO2</td>
    <td colspan="1" class="options" > 
      <input name="koguja_NO2" type="text" class="button" size="45" ></td>
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