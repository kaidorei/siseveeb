<?
	include("globals.php");
	include("tabel_class_iid.php");
	include("tabel_class_oid.php");
	require_once 'header.php';
	
	$eh=$_GET["action"];
	$aid=$_GET["aid"];
	$bookid=$_GET["bookid"];
	$parent=$_GET["parent"];
	
	
	$klass_id=$_GET["klass_id"];
	$klass=$_GET["klass"];
	
	
	//muudest lehtedest lähtudes, exp nupula ja muud, ei ole bookid parameetrit küljes,
	//kui raamatut vaatama hakkad, see tuleb siis võtta.
	if(!$bookid)
	{
		$query_temp="SELECT book_id FROM raamatX WHERE id=".$aid;
	//	echo $query;
		$result_temp=mysql_query($query_temp);
		$line=mysql_fetch_array($result_temp); 
		$bookid=$line["book_id"];
//		echo "Ja raamatu id on: ",$bookid;
	}

	if($eh=="new"){
		$tmp=mysql_query("INSERT INTO raamatX (nimi_est,pid,book_id) VALUES (\"Nimetu\",'".$parent."','".$bookid."')");
		echo "INSERT INTO raamatX (nimi_est,pid,book_id) VALUES (\"Nimetu\",".$parent.",".$bookid.")";
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$aid=$tmp["last_insert_id()"];
		
//-------------------------------------------
		if($klass_id and $klass)
		{
			$query_insert="INSERT INTO ".$klass."_exp (oid1,oid2) VALUES (\"".$aid."\",\"".$expid."\")";
			echo $query_insert;
			$tmp=mysql_query($query_insert);
		}
//-------------------------------------------
		
		if($parent)
		{
			$query_seos= "INSERT INTO raamatX_raamatX (oid1,oid2,book_id) VALUES (".$parent.",".$aid.",".$bookid.") ";
			echo $query_seos;
			$tmp=mysql_query($query_seos);
		}
//		echo $aid;
		// ------------------------------------------------
	} elseif($eh=="save"){
		$valjad=array("nimi_est","nimi_show","tekst","naita_veebis", "kokkuv_est","tundide_arv");
		foreach($valjad as $var){
			$rida[$var]=$var."=\"".$db->real_escape_string($_POST[$var])."\"";
		}
	if($eh=="save" and $_POST["nimi_est"]){
		$query="UPDATE raamatX SET ".implode(",",$rida)." WHERE id=".$aid;		}
//		echo $query;
		$result=mysql_query($query);
	}	
	$query="SELECT * FROM raamatX WHERE id=".$aid;
//	echo $query;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?>
<meta charset="utf-8">
<link href="scat.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js"></script>

<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=aine_disp&bookid=".$bookid."&action=save&aid=".$aid; ?>">

<table width="100%" border="0" cellpadding="5">
  <tr>
    <td>
      <input name="nimi_est" type="text" class="pealkiri" value="<? echo $line["nimi_est"]; ?>" size="55" /></td>
    <td align="center"><span class="options">Näita pealkirja:
        <input name="nimi_show" type="text" class="field" value="<? echo $line["nimi_show"]; ?>" size="3" />
    </span></td>
    <td align="center"><input class="button" type="submit" name="Submit" value="Salvesta" /></td>
    </tr>
  <tr>
    <td align="left" valign="top"><textarea class="ckeditor" cols="120" name="tekst" rows="120"><? echo $line["tekst"];?></textarea>
      <?
				tabel2("raamatX_oskus",$aid,$_SESSION["mysession"]["login"],1,1,"Õpieesmärgid",$bookid);
	?></td>
    <td width="10%" colspan="2" valign="top"><table width="100%" border="0" cellpadding="5">
      <tr>
        <td colspan="2" background="image/sinine.gif" class="menu">M&auml;rkmed</td>
        </tr>
      <tr>
        <td colspan="2" align="left"><?
		include("textlog_class.php");
			$tmp=array("date","body");
			($priv==1) ? ($lisa=0) : ($lisa=1);			
		   log2("raamatXarendus",(isset($_GET["raamatXarendusopen"])?0:2),$aid,$_SESSION["mysession"]["login"],implode(",",$tmp), $lisa); ?></td>
        </tr> 
      <tr>
        <td colspan="2"><?
				tabel2("raamatX_pohivara",$aid,$_SESSION["mysession"]["login"],1,1,"Uued mõisted",$bookid);
				//echo $baas;
	?></td>
        </tr>
      <tr>
        <td colspan="2"><?
				tabel2("raamatX_exp",$aid,$_SESSION["mysession"]["login"],1,1,"Objektid:",$bookid);
				//echo $baas;
	?></td>
        </tr>
      <tr>
        <td colspan="2" class="fields"><?
				tabel2("raamatX_valem",$aid,$_SESSION["mysession"]["login"],1,1,"Valemid:",$bookid);
	?></td>
        </tr>
<?php /*?>      <tr>
        <td colspan="2" class="fields"><?
				tabel2("raamatX_nupula",$aid,$_SESSION["mysession"]["login"],1,1,"Kontrollülesanded",$bookid);
	?></td>
      </tr>
<?php */?>      <tr>
        <td colspan="2" class="fields"><?
				tabel2("raamatX_raamatX",$aid,$_SESSION["mysession"]["login"],2,1,"Kuulub:",$bookid);
	?></td>
      </tr>
      <tr>
        <td colspan="2" class="fields"><?
				tabel2("raamatX_raamatX",$aid,$_SESSION["mysession"]["login"],1,1,"Seotud teemad:",$bookid);
	?></td>
      </tr>
    </table></td>
  </tr>

 <tr>
         <td valign="top">&nbsp;</td>
         <td colspan="5">&nbsp;</td>
       </tr>
 
</table>

</form>






