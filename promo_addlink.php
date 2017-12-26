<?

		include("connect.php");

		include("authsys.php");	

		if($loginform==1) { echo "Juurdepääs keelatud!";}

		else {	

	  $oid=$_GET["oid"];	

	  $dom=$_GET["domain"];

	  $tehtud=0;	

		if($_GET["act"]=="upi"){	

		echo "uuendan ... ";

		$var=$_POST;

				$query="INSERT INTO ".$dom." (kirjeldus,email) VALUES (\"".$_POST["kirjeldus"]."\",\"".$_POST["email"]."\")";

//				echo $query;

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

<? if($tehtud!=1) {?><table width="100%" border="0" cellspacing="1" cellpadding="0">

  <tr> 

    <td width="50" background="image/sinine.gif" class="menu" >V&auml;li</td>

    <td background="image/sinine.gif" class="menu">Sisu</td>

  </tr>

<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&oid=<? echo $oid; ?>&domain=<? echo $dom; ?>" target="uploader" onSubmit="return aken();"> 

<tr background="image/sinine.gif"> 

    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>

   </tr><tr> 

    <td colspan="1" class="options" >kirjeldus</td>

    <td colspan="1" class="options" ><input name="kirjeldus" class="options" type="text" size="100">

      </td>

  </tr>

<tr background="image/sinine.gif"> 

    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>

   </tr>

      <tr> 

    <td colspan="1" class="options" >e-mail</td>

    <td colspan="1" class="options" > <input name="email" class="options" type="text" size="100">

    </td>

  </tr>

  </tr> <tr background="image/sinine.gif"> 

    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>

  <tr align="left" > 

    <td colspan="2" class="menu" ><input type="submit"  class="button" value="Lisa" >

      <input type="button"  class="button" value="Katkesta" onClick="window.close();">

       </td>

  </tr></form>

</table>



<? 

} 

}

?>