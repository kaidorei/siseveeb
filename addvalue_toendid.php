<?
		include("connect.php");
		include("authsys.php");	
		include("globals.php");
		if($loginform==1) { echo "Juurdepääs keelatud!";}

		else {	

	  $reisid=$_GET["reisid"];
	  $tehtud=0;	
		if($_GET["act"]=="upi"){	
			echo "kannan sisse ... ";
			$var=$_POST;
			$query_lisa="INSERT INTO ".$dom." (oid1,oid2,title1,sisse1,sisu2) VALUES (\"".$oid."\",\"".$_POST["entity"]."\",\"".$title."\",\"".$sisse."\",\"".$aine."\")";
			echo $query_lisa;
			$result=sql_rida($login_id,$query_lisa, 1,1);
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
	$qu="SELECT * FROM reis WHERE id=".$reisid;
	echo $qu;
	$result=sql_rida($login_id,$qu, 0, 0);
	$t=mysql_fetch_array($result);
	
	?>

<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>><!--kui valmis, siis paneb ennast kinni-->
<? if($tehtud!=1) {?>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr> 
    <td width="69" background="image/sinine.gif" class="menu" >V&auml;li </td>
    <td width="916" background="image/sinine.gif" class="menu">Sisu</td>
  </tr>
<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&reisid=<? echo $reisid; ?>" target="uploader" onSubmit="return aken();"> 
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
   </tr><tr> 
    <td colspan="1" class="options" >Reis</td>
    <td colspan="1" class="options" ><? echo $t["nimi"];?></td>
  </tr>
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
    <tr>
     <td colspan="1" valign="top" class="options" >Isikud</td>
     <td colspan="1" class="options" ><?
     
	$qu1="SELECT * FROM reis_isik WHERE oid1=".$reisid;
	echo $qu1;
	$result1=sql_rida($login_id,$qu1, 0, 0);
	while($t=mysql_fetch_array($result))
	{
		
		
	}
?></td>
   </tr>
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
   <tr>
     <td colspan="1" valign="top" class="options" >Tekst</td>
     <td colspan="1" class="options" ><? echo $t["toend"];?></td>
   </tr>
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr align="left" > 
    <td colspan="2" class="menu" ><input type="submit"  class="button" value="Lisa" >
      <input type="button"  class="button" value="Katkesta" onClick="window.close();">       </td>
  </tr></form>
</table>
<? 
} 
}
?>
