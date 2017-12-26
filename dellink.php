<?

		include("connect.php");

		include("authsys.php");	

		if($loginform==1) { echo "Sry. Permission denied!";}

		else {

      $rid=$_GET["rid"];	

	  $dom=$_GET["domain"];	

	  $tehtud=0;	

		if($_GET["act"]=="upi"){	

		echo "oota ... ";

				$query="DELETE FROM ".$dom." WHERE id=".$rid;

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

window.open('about:blank','uploader','width=320,height=20,top=100,toolbar=no');

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

  </tr><tr>

  <td class="options"> <?  echo $dom; ?> </td><td class="options">

  <form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&rid=<? echo $rid; ?>&domain=<? echo $dom; ?>" target="uploader" onSubmit="return aken();">

    <? 

			$query="SELECT pealkiri FROM ".$dom." WHERE id=".$rid;

		    $result=mysql_query($query);

            $line=mysql_fetch_array($result); 

	  		echo $line["pealkiri"];

		

	  

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