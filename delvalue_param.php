<?
	include("connect.php");
	include("authsys.php");	

	if($loginform==1) { echo "Sorry. Permission denied!";}
	else {

	  $oid=$_GET["oid"];	
	  $id=$_GET["id"];
	  
	  $query="SELECT nimi_est FROM exp WHERE id=".$oid;
//	echo $query;
	  $result=mysql_query($query);
      $line=mysql_fetch_array($result); 
	  echo "<p class=\"Pealkiri\">Parameeter valemist : ".$line["nimi_est"]."</p>";
	  $tehtud=0;	
		if($_GET["act"]=="upi"){	
		echo "oota ... ";
				$query="DELETE FROM exp_param WHERE id=".$id;
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
   <form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&oid=<? echo $oid; ?>&id=<? echo $_GET["id"]; ?>" target="uploader" onSubmit="return aken();">

    <? 
	$query="SELECT nimi FROM ".$dom." WHERE id=".$_GET["oid"];
	  $result=mysql_query($query);
      $line=mysql_fetch_array($result); 
	  echo $line["nimi"];
	 ?>
     <tr align="left" >
       <td class="options" >Parameeter</td>
       <td class="menu" ><? echo $id;?></td>
     <tr align="left" > 
      <td colspan="2" class="menu" ><input type="submit" name="suva1" class="button" value="Kustutada" > 
        <input type="button" name="suva12" class="button" value="Katkesta" onClick="ending();"> 
      </td> </form>
    </tr>
</table>

<? } 

}

?>