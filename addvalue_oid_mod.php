<?

include("connect.php");

include("authsys.php");	

if($loginform==1){

	echo "Juurdepääs keelatud!";}

else {

	$oid=$_GET["oid"];	

	$dom=$_GET["domain"];

	$id=$_GET["id"];



	$tehtud=0;	

	if($_GET["act"]=="upi"){	

		echo "updating ... ";

		$query="UPDATE ".$dom." SET nimi='".$_POST["nimi"]."', oid='".$oid."', url='".$_POST["file"]."', ord='".$_POST["ord"]."', naita_veebis='".$_POST["naita_veebis"]."', allikas='".$_POST["allikas"]."', copyright='".$_POST["copyright"]."', allkiri_est='".$_POST["allkiri_est"]."', allkiri_eng='".$_POST["allkiri_eng"]."', allkiri_rus='".$_POST["allkiri_rus"]."' WHERE id=".$id."";

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

window.open('about:blank','uploader','width=820,height=200,top=100,toolbar=no');

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

<? 

    $query="SELECT * FROM ".$dom." WHERE id=".$id;

//	echo $query;

    $result=mysql_query($query);

	$line=mysql_fetch_array($result); 





	$str = urldecode($line["url"]);

	$arr = split( '[.]',$str, 2);

	if($arr[1] == "jpg" || $arr[1] == "JPG"){

		$arr1 = split( '[/]',$arr[0], 3);

		$url="../../omad/media/".$domain."/".$arr1[2].".".$arr[1];

	}





?>

<? if($tehtud!=1) {?>

<table width="100%" border="0" cellspacing="1" cellpadding="0">

  <form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&oid=<? echo $oid; ?>&domain=<? echo $dom; ?>&id=<? echo $id; ?>" target="uploader" onSubmit="return aken();">

  	<tr> 

    	<td width="156" background="image/sinine.gif" class="menu" >V&auml;li</td>

    	<td width="391" background="image/sinine.gif" class="menu">Sisu</td>

  	</tr>

	<tr>

		<td class="options"> <?  echo $dom; ?></td>

		<td class="options"> <input name="file" type="text" class="button" size="45" value="<? echo $line["url"]?>"> </td>  

	</tr>

	<tr background="image/sinine.gif"> 

		<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

	</tr>

	<tr > 

		<td colspan="1" class="options" >pealkiri</td>

		<td colspan="1" class="options" > 

		  <input name="nimi" type="text" class="button" size="45" value="<? echo $line["nimi"]?>"></td>

	</tr>

	<tr background="image/sinine.gif"> 

		<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

	</tr>

	<tr > 

		<td colspan="1" class="options" >allikas (URL v&otilde;i tekstiline viide)</td>

		<td colspan="1" class="options" > 

		  <input name="allikas" type="text" class="button" size="45" value="<? echo $line["allikas"]?>"></td>

	</tr>

	<tr > 

		<td colspan="1" class="options" >copyright (kui on teada)</td>

		<td colspan="1" class="options" > 

		  <input name="copyright" type="text" class="button" size="45" value="<? echo $line["copyright"]?>"></td>

	</tr>

	<tr > 

		

      <td colspan="1" class="options" >n&auml;ita veebis</td>

		<td colspan="1" class="options" > 

		  <input name="naita_veebis" type="text" class="button" size="45" value="<? echo $line["naita_veebis"]?>"></td>

	</tr>

	<tr > 

		

      <td colspan="1" class="options" >j&auml;rjekord</td>

		<td colspan="1" class="options" > 

		  <input name="ord" type="text" class="button" size="45" value="<? echo $line["ord"]?>"></td>

	</tr>

	<tr background="image/sinine.gif"> 

		<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

	</tr>

	<tr > 

		<td colspan="1" class="options" >allkiri EST</td>

		<td colspan="1" class="options" > 

		  <textarea name="allkiri_est" cols="49" rows="6" class="fields"><? echo $line["allkiri_est"]?></textarea>

        				<!--<img src="<? echo $str;?>" height="77">--></td>

	</tr>

	<tr background="image/sinine.gif"> 

		<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

	</tr>

	<tr > 

		<td colspan="1" class="options" >allkiri ENG</td>

		<td colspan="1" class="options" > 

		  <textarea name="allkiri_eng" cols="49" rows="3" class="fields"><? echo $line["allkiri_eng"]?></textarea></td>

	</tr>

	<tr background="image/sinine.gif"> 

		<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

	</tr>

	<tr > 

		<td colspan="1" class="options" >allkiri RUS</td>

		<td colspan="1" class="options" > 

		  <textarea name="allkiri_rus" cols="49" rows="3" class="fields"><? echo $line["allkiri_rus"]?></textarea></td>

	</tr>

	<tr background="image/sinine.gif"> 

		<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

	</tr>

	<tr background="image/sinine.gif"> 

		<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

	</tr>

	<tr align="left" > 

		<td colspan="2" class="menu" >

		<input type="submit" name="suva1" class="button" value="Muuda" >

		<input type="button" name="suva12" class="button" value="Katkesta" onClick="window.close();"> 

		</td>

	</tr>

</form>

</table>

<? } 

}

?>