<script src="ckeditor/ckeditor.js"></script>
<?
//		include("FCKeditor/fckeditor.php") ;
		include("connect.php");
		include("authsys.php");	
		require_once 'header.php';
//		include("globals.php");
		if($loginform==1) { echo "Juurdepääs keelatud!";}
		else {	
	  $id=$_GET["id"];	
	  $sel=$_GET["sel"];
	  $vali=$_GET["vali"];
	  $isik_id=$_GET["isik_id"];
	  $isik_nimi=$_GET["isik_nimi"];
	  
	  $nupp=$_POST["nupp"];
//	  echo "nupp=",$asi;
	  
		if($_GET["act"]=="upi"){	
			if($nupp=="Salvesta") // salvestan vaid juhul, kui vastavat nuppu vajutatakse, muidu mitte (katkesta)
			{
				echo "uuendan ... ";
				$var=$_POST;
				$query="UPDATE exp SET ".$vali."='".$db->real_escape_string($_POST[$vali])."' WHERE id=".$id;
				echo $query;
				$result=mysql_query($query);
			}
	
			// check out ...
			$tehtud=1;
		}
		?>
<meta charset="utf-8">
<link href="scat.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.back {
	background-color: #FFFFFF;
	border: 2px none #CCCCCC;
}
.style1 {color: #FF0000}

-->

</style>

<script>
function aken(){
window.open('about:blank','uploader','width=450,height=20,top=100,toolbar=no');
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
<? 

//	echo $dom1." ".$dom2;

//vastavalt seose id-le leian tabelist seose kaks otsa
	$query="SELECT nimi_est, ".$vali." FROM exp WHERE id=".$id;
	$result=mysql_query($query);
	$line=mysql_fetch_array($result); 
//echo $query;	
?>
<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>>
<? if($tehtud!=1) {?><table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr> 
    <td width="119" background="image/sinine.gif" class="menu" >V&auml;li <? echo $sel;?></td>
    <td colspan="2" background="image/sinine.gif" class="menu">Sisu</td>
    <td width="774" align="right" background="image/sinine.gif" class="menu"><span class="style1">T&ouml;&ouml; l&otilde;petamisel vajutage  &quot;Salvesta&quot; v&otilde;i &quot;Katkesta&quot;, vastasel korral j&auml;&auml;b v&auml;li teiste kasutajate jaoks lukku.</span></td>
  </tr>
<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&id=<? echo $id; ?>&vali=<? echo $vali; ?>&sel=<? echo $sel; ?>" target="uploader" onSubmit="return aken();"> 
<tr background="image/sinine.gif"> 
    <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
   </tr><tr background="image/sinine.gif"> 
    <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
    <tr>
     <td colspan="1" valign="top" class="options" >Pealkiri</td>
     <td colspan="3" class="options" >	<? echo $line["nimi_est"];?></td>
   </tr>
<tr background="image/sinine.gif"> 
    <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
   <tr>
     <td colspan="1" valign="top" class="options" ><? echo $vali;?></td>
     <td colspan="3" class="options" ><textarea class="ckeditor" cols="120" name="<? echo $vali;?>" rows="100"><? echo $line[$vali];?></textarea><?

	?></td>
<tr background="image/sinine.gif"> 
    <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr align="left" > 
    <td colspan="3" class="menu" ><input name="nupp" type="submit"  class="button" value="Salvesta" >
      <input name="nupp" type="submit"  class="button" value="Katkesta"></td>
    <td class="menu" ><div align="right"><span class="style1">T&ouml;&ouml; l&otilde;petamisel vajutage  &quot;Salvesta&quot;, vastasel korral j&auml;&auml;b t&ouml;&ouml; salvestamata.</span></div></td>
  </tr></form>
</table>
<? 
} 
}
?>
