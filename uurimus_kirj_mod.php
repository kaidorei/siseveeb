<?
		include("FCKeditor/fckeditor.php") ;
		include("connect.php");
		include("authsys.php");	
		require_once 'header.php';
//		include("globals.php");
		if($loginform==1) { echo "Juurdep��s keelatud!";}
		else {	
	  $id=$_GET["id"];	
	  $sel=$_GET["sel"];
	  $vali=$_GET["vali"];
	  $isik_id=$_GET["isik_id"];
	  $isik_nimi=$_GET["isik_nimi"];
	  
	  $nupp=$_POST["nupp"];
//	  echo "nupp=",$asi;
	  
/*	  // kontrollime kasutamise �le ...
		$query_c="SELECT ".$vali."_check from exp WHERE id='".$id."'";
		$result_c=mysql_query($query_c);
		$line_c=mysql_fetch_array($result_c);
	  	$tehtud=0;		
		if ($line_c[$vali."_check"]<1 or $line_c[$vali."_check"]==$isik_id) // teine valik on juhuks, kui eksinud kasutaja tagasi p��rdub ...
		{
	  // check out ...
		$query_c="UPDATE exp SET ".$vali."_check=".$isik_id." WHERE id='".$id."'";
		$result_c=mysql_query($query_c);
		
		}else{
		echo $isik_nimi," justkui t��tab selle teksti kallal. Oled Sa kindel?";
		}
*/
	  
		if($_GET["act"]=="upi"){	
			if($nupp=="Salvesta") // salvestan vaid juhul, kui vastavat nuppu vajutatakse, muidu mitte (katkesta)
			{
				echo "uuendan ... ";
				$var=$_POST;
				$query="UPDATE uurimus SET ".$vali."='".$db->real_escape_string($_POST[$vali])."' WHERE id=".$id;
				echo $query;
				$result=mysql_query($query);
			}
			
			// check out ...
//			$query_c="UPDATE exp SET ".$vali."_check='' WHERE id='".$id."'";
//			$result_c=mysql_query($query_c);
		
			$tehtud=1;
		}
		?>
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
	$query="SELECT nimi_est, ".$vali." FROM uurimus WHERE id=".$id;
	$result=mysql_query($query);
	$line=mysql_fetch_array($result); 
echo $query;	
?>
<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>>
<? if($tehtud!=1) {?><table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr> 
    <td width="119" background="image/sinine.gif" class="menu" >V&auml;li <? echo $sel;?></td>
    <td colspan="2" background="image/sinine.gif" class="menu">Sisu</td>
    <td width="774" align="right" background="image/sinine.gif" class="menu"></td>
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
     <td colspan="3" class="options" ><?
$oFCKeditor = new FCKeditor($vali) ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->Value = $line[$vali];
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '500' ;
$oFCKeditor->Create() ;
	?></td>
<tr background="image/sinine.gif"> 
    <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr align="left" > 
    <td colspan="3" class="menu" ><input name="nupp" type="submit"  class="button" value="Salvesta" >
      <input name="nupp" type="submit"  class="button" value="Katkesta"></td>
    <td class="menu" ></td>
  </tr></form>
</table>
<? 
} 
}
?>
