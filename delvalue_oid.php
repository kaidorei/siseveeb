<?
	include("connect.php");
	include("authsys.php");	

	if($loginform==1) { echo "Sorry. Permission denied!";}
	else {

	  $oid=$_GET["oid"];	
	  $dom=$_GET["domain"];
	  $aid=$_GET["aid"];
	  
	  $query="SELECT nimi FROM ".$dom." WHERE id=".$aid;
	echo $query;
	  $result=mysql_query($query);
      $line=mysql_fetch_array($result); 
	  echo "<p class=\"Pealkiri\">Objekti nimi : ".$line["nimi"]."</p>";
	  $tehtud=0;	
		if($_GET["act"]=="upi"){	
		echo "oota ... ";
				$query="SELECT url FROM ".$dom." WHERE id=".$_GET["aid"];
				echo $query;
			    $result=mysql_query($query);
     			$line=mysql_fetch_array($result); 	
				unlink(urldecode($line["url"]));
				$query="DELETE FROM ".$dom." WHERE id=".$_GET["aid"];
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
window.open('about:blank','uploader','width=520,height=200,top=100,toolbar=no');
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
<? if($tehtud!=1) {?>
<table width="100%" border="0" cellspacing="1" cellpadding="0">

  <tr> 
    <td width="50" background="image/sinine.gif" class="menu" >V&auml;li</td>
    <td width="80%" background="image/sinine.gif" class="menu">Sisu</td>
  </tr>
  <tr>
  <td class="options"> <?  echo $dom; ?> </td><td class="options">
  <form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&oid=<? echo $oid; ?>&aid=<? echo $_GET["aid"]; ?>&domain=<? echo $dom; ?>" target="uploader" onSubmit="return aken();">

    <? 
	$query="SELECT nimi FROM ".$dom." WHERE id=".$_GET["oid"];
	  $result=mysql_query($query);
      $line=mysql_fetch_array($result); 
	  echo $line["nimi"];
	 ?></td></tr>
    <tr background="image/sinine.gif"> 
      <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
    </tr></tr></tr>
     <tr align="left" > 
      <td colspan="2" class="menu" ><input type="submit" name="suva1" class="button" value="Kustutada" > 
        <input type="button" name="suva12" class="button" value="Katkesta" onClick="ending();"> 
      </td> </form>
    </tr>
</table>

<? } 

}

?>