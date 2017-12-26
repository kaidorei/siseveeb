<?

	$eh=$_GET["action"];

	$veeb=$_GET["veeb"];

	$bookid=$_GET["bookid"];

	$summa=$_GET["summa"];

	require_once 'header.php';

	include("tabel_class_oid.php");





	if($eh=="new"){

		$query="INSERT INTO raamat (nimi_est,pid) VALUES ('nimetu','".$pid."')";

		$tmp=mysql_query($query);

//		echo $query;

		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

		$bookid=$tmp["last_insert_id()"];





		// ------------------------------------------------

	} elseif($eh=="save" && $_POST["nimi_est"]){

		$valjad=array("nimi_est", "autor_est", "copyright", "sisu","sisu_opetaja","sisu_metoodika","naita_veebis_est");

		foreach($valjad as $var){

			$rida[$var]=$var."='".$_POST[$var]."'";

			}

		$query="UPDATE raamat SET ".implode(",",$rida)." WHERE id=".$bookid;

//		echo $query;

		$result=mysql_query($query);

		$query24="UPDATE `fyysika_ee`.`raamat` SET sisu='".$db->real_escape_string($_POST["sisu"])."' WHERE id=".$bookid." LIMIT 1";
		$result24=mysql_query($query24);

	}



    $query="SELECT * FROM raamat WHERE id=".$bookid;

//	echo $query;

    $result=mysql_query($query);

	$line=mysql_fetch_array($result);

 ?>

<link href="scat.css" rel="stylesheet" type="text/css" />

<script src="ckeditor/ckeditor.js"></script>





<form name="naitus" method="post" action="<? echo $PHP_SELF."?page=raamat_disp&action=save&bookid=".$bookid; ?>">

<table width="100%" border="0" cellpadding="0" cellspacing="2">

  <tr>

      <td width="32%" valign="top">



<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif">

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr>

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Pealkiri</td>

          <td width="65%" ><input name="nimi_est" type="text" class="fields" value="<? echo $line["nimi_est"]; ?>" size="45" >

          </td>

        </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif">

          <td width="100%" colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        </table>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif">

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr>

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">Autorid</td>

            <td width="65%" > <input name="autor_est" type="text" class="fields" value="<? echo $line["autor_est"]; ?>" size="45" ></td>

        </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif">

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr>

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">copyright</td>

          <td width="65%" align="right" > <input name="copyright" type="text" class="fields" value="<? echo $line["copyright"]; ?>" size="45" >

          </td>

        </tr>

       <tr background="image/sinine.gif">

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr>

          <td><img src="image/spacer.gif" width="20" height="10"><img src="image/spacer.gif" width="10" height="10"></td>

            <td class="menu" width="35%">naita_veebis</td>

          <td width="65%" align="right" > <input name="naita_veebis_est" type="text" class="fields" value="<? echo $line["naita_veebis_est"]; ?>" size="45" >

          </td>

        </tr>

       <tr background="image/sinine.gif">

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr><tr>

        <td colspan="3"><? tabel("raamat_pildid",$bookid,$_SESSION["mysession"]["login"], 1,"Pildid");?></td>

      </tr>



</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif">

          <td width="100%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

 </table>









        <table width="100%" height="34" border="0" cellpadding="0" cellspacing="0">

          <tr background="image/sinine.gif">

          <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

        </tr>

        <tr>

          	<td height="33"><img src="image/spacer.gif" width="10" height="10"></td>

          	<td class="menu" width="35%"><input class="button2" type="submit" name="Submit" value="Salvesta"></td><td width="65%" bordercolor="#CCCCCC" >&nbsp;</td>

         </tr>

</table>

</td>

      <td width="33%" valign="top"><? if ($line["veeb_pilt_url"]) {?><a href=<? echo urldecode($line["veeb_pilt_url_s"]); ?> target=_blank><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" style="background-color: #CCCCCC" /></a><? } else {?>

              <img src="image/noimage.jpg" width="90" height="98" />              <? }?></td>



<td  valign="top">





</td>

</tr>

  <tr>

    <td colspan="2"><textarea name="sisu" class="ckeditor" cols="100" rows="15"><? echo $line["sisu"]; ?></textarea></td>

  </tr>

  <tr><td colspan="2"><textarea name="sisu_opetaja" class="ckeditor" cols="100" rows="15"><? echo $line["sisu_opetaja"]; ?></textarea></td></tr>

  <tr>

    <td colspan="2"><textarea name="sisu_metoodika" class="ckeditor" cols="100" rows="15"><? echo $line["sisu_metoodika"]; ?></textarea></td>

  </tr>



</table>

</form>
