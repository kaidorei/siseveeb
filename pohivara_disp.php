

<?

	include("FCKeditor/fckeditor.php") ;
	include("tabel_class_iid.php");

	$eh=$_GET["action"];
	$poid=$_GET["poid"];

	if($eh=="new"){

		$tmp=mysql_query("INSERT INTO dictterm (nimi_est) VALUES (\"Nimetu\")");

		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

		$poid=$tmp["last_insert_id()"];

	} elseif($eh=="save"){

		$valjad=array("kirje");

		foreach($valjad as $var){

			$rida[$var]=$var."='".$_POST[$var]."'";

		}

	if($eh=="save"){

		$query="UPDATE dictterm SET ".implode(",",$rida)." WHERE id=".$poid;		}

//		echo $query;

		$result=mysql_query($query);

	}	

	$query="SELECT * FROM dictterm WHERE id=".$poid;

//echo $query;

    $result=mysql_query($query);

	$line=mysql_fetch_array($result); 


	$query_r="SELECT * FROM exp WHERE ext_id=".$line["id"]." AND gpid_demo=38 ";

//echo $query;

    $result_r=mysql_query($query_r);

	$line_r=mysql_fetch_array($result_r);
	$expid= $line_r["id"];


?>

<link href="scat.css" rel="stylesheet" type="text/css" />

 <br>



<form name="valem" method="post" action="<? echo $PHP_SELF."?page=pohivara_disp&klass=".$baas."&action=save&poid=".$poid; ?>">



<table width="100%" border="0" cellpadding="5">

  <tr>
    
    <td align="left" class="menu">Kirje: 
      
      </td>
    
    <td width="69%" class="pealkiri"><input name="kirje" type="text" class="pealkiri" value="<? echo $line["kirje"]; ?>" size="65" /></td>
    
    <td width="9%" class="pealkiri"><? if($expid) {?>

          <a class="navi" href="<? echo $PHP_SELF."?page=exp_disp&expid=".$expid; ?>">exp</a> <? }?></td>
    
    <td width="15%" valign="top" ><input class="button" type="submit" name="Submit" value="Salvesta" /></td>
    
  </tr>
  <tr>
    <td colspan="2" align="left" class="menu"><span class="pealkiri">
      <?
    
    				tabel2("dictconcept_dictterm",$poid,$_SESSION["mysession"]["login"],2,1,"Seletused");

?>
    </span></td>
    <td class="pealkiri">&nbsp;</td>
    <td valign="top" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left" class="menu"><?
    
    				tabel2("exp_vahendid",$poid,$_SESSION["mysession"]["login"],1,1,"Sünonüümid");

?></td>
    <td class="pealkiri">&nbsp;</td>
    <td valign="top" >&nbsp;</td>
  </tr>

  <tr>
    
    <td width="7%" align="left" valign="top" class="navi">&nbsp;</td>
    
    <td colspan="3" align="center" valign="top">&nbsp;</td>
    
  </tr>

  </table>



</form>



















