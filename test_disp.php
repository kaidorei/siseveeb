<?
	
	include("FCKeditor/fckeditor.php") ;
	include("tabel_class_oid.php");
	include("tabel_class_iid.php");
	require_once 'header.php';
	$eh=$_GET["action"];
	$tid=$_GET["tid"];
	$klass=$_GET["klass"];
	$bookid=$_GET["bookid"];
	
	if($eh=="new"){
		$tmp=mysql_query("INSERT INTO test (nimi_est) VALUES (\"Nimetu\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$tid=$tmp["last_insert_id()"];
		
		if($aid and $klass)
		{
			//echo "teeme kohe seose vastava ainevärgiga<br>";
			$query_insert="INSERT INTO ".$klass."_test (oid1,oid2) VALUES (\"".$aid."\",\"".$tid."\")";
			echo $query_insert;
			$tmp=mysql_query($query_insert);
				
		}
// uus süsteem - raanatX

		if($aid and $bookid)
		{
			//echo "teeme kohe seose vastava ainevärgiga<br>";
			$query_insert="INSERT INTO raamatX_test (oid1,oid2,book_id) VALUES (\"".$aid."\",\"".$tid."\",\"".$bookid."\")";
			echo $query_insert;
			$tmp=mysql_query($query_insert);
				
		}
//		echo $pid;
		// ------------------------------------------------
	} elseif($eh=="save" and $_POST["nimi_est"]){
		$tid=$_GET["tid"];
		$valjad=array("nimi_est","juhend_est");

		foreach($valjad as $var){
			$rida[$var]=$var."='".$db->real_escape_string($_POST[$var])."'";
		$query="UPDATE test SET ".implode(",",$rida)." WHERE id=".$tid;		}
		$result=mysql_query($query);
	echo $query;
		}
//	$query="SELECT ".implode(",",$valjad)." FROM pacs WHERE id=".$pid;
	$query="SELECT * FROM test WHERE id=".$tid;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?>
<script src="ckeditor/ckeditor.js"></script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
 <link href="scat.css" rel="stylesheet" type="text/css" />


<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=test_disp&action=save&tid=".$tid; ?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="2">
    <tr>
      <td width="100%" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="8" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="6%" class="menu">Nimi</td>
          <td width="69%" align="left" >
            <input name="nimi_est" type="text" class="fields" value="<? echo $line["nimi_est"]; ?>" size="40" >          
          </td>
          <td width="14%" align="left" ><span class="navi"><? echo $line["lupdate"]; ?></span></td>
          <td align="center"  ><input class="button" type="Submit" value="Värskenda&nbsp;tabel" onclick="javascript:location.href='<? echo $PHP_SELF."?page=test_disp&tid=".$tid; ?>" /></td>
          <td width="2%" align="left" ><input class="button" type="submit" name="Submit" value="Salvesta" /></td>
          <td width="0%" align="left" ><input class="button" type="Submit" value="Trükiversioon" onclick="javascript:location.href='test_print.php&tid=<? echo $tid; ?>"></td>
          <td width="1%" align="left" ><input class="button" type="Submit" value="Õpetaja trükiversioon" onclick="javascript:location.href='test_print.php&tid=<? echo $tid; ?>"></td>
          <td width="2%" align="left" ><input class="button" type="Submit" value="e-test" onclick="javascript:location.href='test_print.php&tid=<? echo $tid; ?>"></td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td width="100%" colspan="8" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        </table>
<table cellpadding="0" width="100%" border="0" cellspacing="0" >
          <tr> 
          <td width="24%" ><?
				tabel2("test_nupula",$tid,$_SESSION["mysession"]["login"],1,1,"&Uuml;lesanded:");
	?></td>
          </tr>
         <tr> 
          <td ><?
				tabel2("raamatX_test",$tid,$_SESSION["mysession"]["login"],2,1,"Seotud teemad:");
	?></td>
          </tr>
 <? if (1)
 {?> <? }?>
<? if (1)
 {?>
        <tr>
          <td class="menu">Instruktsioonid</td>
          </tr>
        <tr>
          <td align="center" class="menu"><textarea class="fields_left" name="juhend_est" cols="80" rows="18"><? echo $line["juhend_est"]; ?></textarea></td>
        </tr>
        <tr> 
          <td align="center" class="menu">&nbsp;</td>
        </tr>
 <? }?>       
</table>
	  </td></tr>
  </table>
</form>









