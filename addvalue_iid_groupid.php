<?
		include("connect.php");
		include("authsys.php");	
		include("globals.php");
		if($loginform==1) { echo "Juurdepääs keelatud!";}
		else {	
	  $dom=$_GET["domain"];	
	  $reisid=$_GET["reisid"];	
	  $koolid=$_GET["koolid"];	

	  $tehtud=0;	
		if($_GET["act"]=="upi")
		{	
			echo "uuendan ... ";
			$var=$_POST;
			$query="UPDATE ".$dom." SET groupid='".$_POST["entity"]."' WHERE oid1=".$reisid." AND oid2='".$koolid."'";
			echo $query;
			$result=mysql_query($query);
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
echo "Õpikodade rühmadele moodle'i id-de vastavusse seadmine.";
?>
<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>><!--kui valmis, siis paneb ennast kinni-->
<? if($tehtud!=1) {?>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr> 
    <td width="140" background="image/sinine.gif" class="menu" >V&auml;li </td>
    <td width="618" background="image/sinine.gif" class="menu">Sisu</td>
  </tr>
<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&reisid=<? echo $reisid; ?>&domain=<? echo $dom; ?>&koolid=<? echo $koolid; ?>" target="uploader" onSubmit="return aken();"> 
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
   </tr><tr> 
    <td colspan="1" class="options" >R&uuml;hmad Moodle's<img src="image/spacer.gif" width="20" height="2"></td>
    <td colspan="1" class="options" >
<? 	$query2="SELECT * FROM reis_kool WHERE oid1='".$reisid."' AND oid2='".$koolid."'";
	echo $query2;
	$result2=mysql_query($query2);
	$t2=mysql_fetch_array($result2);
	echo "selline id: ",$t2["groupid"];

?>	<select name="entity">
      <? 
	
		
	$query1="SELECT * FROM moodle_nina.mdl_groups ORDER BY courseid";
	//echo $query1;
	$result1=mysql_query($query1);
	echo "<option value=\"0\"> pole </option>";
	while($t=mysql_fetch_array($result1)){
		
		
			$query3="SELECT * FROM moodle_nina.mdl_course WHERE id='".$t["courseid"]."'";
//			echo $query2;
			$result3=mysql_query($query3);
			$t3=mysql_fetch_array($result3);
		
		
		
				if($t["id"]==$t2["groupid"]) { $sel="selected"; } else { $sel="";}
				echo "<option value=\"".$t["id"]."\" ".$sel.">".$t3["fullname"]." ".$t["name"]."</option>";
				}
//...................................................................................................................................	  

?></select></td>
  </tr>
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
   <tr align="left" > 
    <td colspan="2" class="menu" ><input type="submit"  class="button" value="Salvesta" >
      <input type="button"  class="button" value="Katkesta" onClick="window.close();">       </td>
  </tr></form>
</table>
<? 
} 
}
?>
