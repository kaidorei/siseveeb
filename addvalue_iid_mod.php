<?
		require_once 'header.php';

		if($loginform==1) { echo "Juurdepääs keelatud!";}

		else {


	  $id=$_GET["id"];
	  $sort_order=$_GET["sort_order"];
	  $dom=$_GET["domain"];
	  $meta=$_GET["meta"];
	  $sel=$_GET["sel"];
	  $naita_veebis=$_GET["naita_veebis"];
	  $tehtud=0;
	  $asi1="nimi_est";
	  $asi2="nimi_est";

		if($dom=="exp_exp")
		{
			$meta_txt="meta";
		}
		else
		{
			$meta_txt="meta_est";
		}

		if($_GET["act"]=="upi"){

		echo "uuendan ... ";
		$var=$_POST;
	  	$id=$_GET["id"];
		$dom2=substr($dom,strpos($dom,"_")+1,strlen($dom));
if($dom=="exp_exp")
{
		$query="UPDATE ".$dom." SET sort_order='".$db->real_escape_string($_POST["sort_order"])."', title_est='".$db->real_escape_string($_POST["seos_title"])."', ".$meta_txt."='".$db->real_escape_string($_POST["meta"])."', naita_veebis='".$db->real_escape_string($_POST["naita_veebis"])."' WHERE id=".$id;
}
else
{
		$query="UPDATE ".$dom." SET sort_order='".$db->real_escape_string($_POST["sort_order"])."', title_est='".$db->real_escape_string($_POST["seos_title"])."', ".$meta_txt."='".$db->real_escape_string($_POST["meta"])."', book_id='".$db->real_escape_string($_POST["book_id"])."', naita_veebis='".$db->real_escape_string($_POST["naita_veebis"])."' WHERE id=".$id;
}

		echo $query;

		$result=mysql_query($query);

		$tehtud=1;

		}

		?>

<link href="scat.css" rel="stylesheet" type="text/css">
<script>

function aken(){

window.open('about:blank','uploader','width=550, height=220,top=100,toolbar=no');

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
<script src="ckeditor/ckeditor.js"></script>

<?



//	echo $dom1." ".$dom2;



//vastavalt seose id-le leian tabelist seose kaks otsa

	$query="SELECT * FROM ".$dom." WHERE id=".$id;

	$result=mysql_query($query);

	$line=mysql_fetch_array($result);

//			echo $query;



	// ET NAITA_VEEBIS2 T��TAKS



	$query_text="SELECT * FROM ".$dom." WHERE id=".$id;
	$result_text=mysql_query($query_text);
	$line_text=mysql_fetch_array($result_text);
	$title_est=$line_text["title_est"];
	$naita_veebis=$line_text["naita_veebis"];


// allj�rgnevas leitakse kasutaja kindlustunde t�stmiseks seosetabeli oid idele vastavad nimed.

	$dom1=substr($dom,0,strpos($dom,"_"));

	$dom2=substr($dom,strpos($dom,"_")+1,strlen($dom));

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	$query1="SELECT * FROM ".$dom1." WHERE id=".$line["oid1"];

	$query2="SELECT * FROM ".$dom2." WHERE id=".$line["oid2"];

	//echo $query1;
	$result1=mysql_query($query1);

	$line1=mysql_fetch_array($result1);

	$result2=mysql_query($query2);

	$line2=mysql_fetch_array($result2);



//	echo $query1;



?>

<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>>

<? if($tehtud!=1) {?><table width="80%" border="0" cellspacing="1" cellpadding="0">

  <tr>

    <td colspan="2" background="image/sinine.gif" class="menu" >V&auml;li </td>

    <td colspan="5" background="image/sinine.gif" class="menu"><span class="options">

      <?

//	echo $dom;

	echo $line1[$asi1];

	 ?>

    </span><span class="options">

      &lt;-&gt;<?

//	echo $dom;

	echo $line2[$asi2];

	 ?>

    </span></td>

  </tr>

<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&id=<? echo $id; ?>&domain=<? echo $dom; ?>&sel=<? echo $sel; ?>" target="uploader" onSubmit="return aken();">

<tr background="image/sinine.gif">

    <td colspan="7" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>
<tr>

    <td width="67" align="right" class="options" >J&auml;rjekord:</td>

    <td width="54" align="center" class="options" ><input name="sort_order" type="text"  class="ekraan_link" value="<? echo $line["sort_order"]; ?>" size="10" ></td>

    <td width="30" align="right" valign="middle" class="options" >Viide:</td>
    <td width="260" valign="middle" class="options" ><input name="meta" type="text"  class="menu_punane" value="<? echo $line[$meta_txt]; ?>" size="10" ></td>
    <td width="66" align="right" valign="middle" class="options" >book_id: </td>
    <td width="327" valign="middle" class="options" ><input name="book_id" type="text"  class="menu_punane" value="<? echo $line["book_id"]; ?>" size="10" ></td>

    <td width="47" valign="middle" class="options" >N&auml;ita &otilde;pikus
      <input name="naita_veebis" type="text" class="fields" value="<? echo $line["naita_veebis"]; ?>" size="2" ></td>

    </tr>

<tr background="image/sinine.gif">

    <td colspan="7" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>

    <tr>

     <td colspan="2" valign="top" class="options" >Pildiallkiri/Before</td>

     <td colspan="5" align="center" class="options" ><textarea class="ckeditor" cols="50" name="seos_title" rows="5"><? echo $title_est; ?></textarea></td>

    </tr>

<tr background="image/sinine.gif">

    <td colspan="7" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>




 <?php /*?> <tr>

     <td colspan="2" valign="top" class="options" >After</td>

     <td colspan="2" align="center" class="options" ><?

$oFCKeditor = new FCKeditor('seos_sisu1') ;

$oFCKeditor->BasePath = 'FCKeditor/';

$oFCKeditor->Value = $sisu1;

$oFCKeditor->Width  = '600' ;

$oFCKeditor->Height = '300' ;

$oFCKeditor->Create() ;

	?></td>

    </tr>

<?php */?>

  <tr align="left" >

    <td colspan="7" class="menu" ><input type="submit"  class="button" value="Salvesta" >

      <input type="button"  class="button" value="Katkesta" onClick="window.close();">       </td>

  </tr></form>

</table>

<?

}

}

?>
