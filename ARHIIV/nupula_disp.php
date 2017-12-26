<?
	
	include("FCKeditor/fckeditor.php") ;
	include("tabel_class_oid.php");
	include("tabel_class_iid.php");
	require_once 'header.php';
	$eh=$_GET["action"];
	$nid=$_GET["nid"];
	$tid=$_GET["tid"];
	$aid=$_GET["aid"];
	$klass=$_GET["klass"];
	$bookid=$_GET["bookid"];
	
	if($eh=="new"){
		$tmp=mysql_query("INSERT INTO nupula (nimi_est,probleem_est) VALUES (\"Nimetu\",\"Pole\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$nid=$tmp["last_insert_id()"];
		
		if($aid and $klass)
		{
			//echo "teeme kohe seose vastava ainevärgiga<br>";
			$query_insert="INSERT INTO ".$klass."_nupula (oid1,oid2) VALUES (\"".$aid."\",\"".$nid."\")";
			echo $query_insert;
			$tmp=mysql_query($query_insert);
				
		}
		if($tid and $klass)
		{
			//echo "teeme kohe seose vastava ainevärgiga<br>";
			$query_insert="INSERT INTO ".$klass."_nupula (oid1,oid2) VALUES (\"".$tid."\",\"".$nid."\")";
			echo $query_insert;
			$tmp=mysql_query($query_insert);
				
		}
// uus süsteem - raanatX

		if($aid and $bookid)
		{
			//echo "teeme kohe seose vastava ainevärgiga<br>";
			$query_insert="INSERT INTO raamatX_nupula (oid1,oid2,book_id) VALUES (\"".$aid."\",\"".$nid."\",\"".$bookid."\")";
			echo $query_insert;
			$tmp=mysql_query($query_insert);
				
		}
//		echo $pid;
		// ------------------------------------------------
	} elseif($eh=="save" and $_POST["nimi_est"]){
		$nid=$_GET["nid"];
		$valjad=array("nimi_est", "lahendus_est","naita_veebis", "algallikas", "script", "liik", "valik1", "valik2", "valik3", "valik4", "valik5", "valik6","pilt1", "pilt2", "pilt3", "pilt4", "pilt5", "pilt6", "komm1", "komm2", "komm3", "komm4", "komm5", "komm6", "vast1", "vast2", "vast3", "vast4", "vast5", "vast6","raskus","on_seeria");

		foreach($valjad as $var){
			$rida[$var]=$var."='".$db->real_escape_string($_POST[$var])."'";
		$query="UPDATE nupula SET ".implode(",",$rida)." WHERE id=".$nid;		}
		$result=mysql_query($query);
//	echo $query;
		}
//	$query="SELECT ".implode(",",$valjad)." FROM pacs WHERE id=".$pid;
	$query="SELECT * FROM nupula WHERE id=".$nid;
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


<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=nupula_disp&action=save&nid=".$nid; ?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="2">
    <tr>
      <td width="100%" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="5" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="6%" class="menu">Nimi: </td>
          <td width="69%" align="left" >
            <input name="nimi_est" type="text" class="fields" value="<? echo $line["nimi_est"]; ?>" size="40" >          
          </td>
          <td width="14%" align="left" ><span class="navi"><? echo $line["lupdate"]; ?></span>	</td>
          <td width="6%" align="left" ><input class="button" type="submit" name="Submit" value="Salvesta" /></td>
          <td width="5%" align="left" ><a href="http://opik3.fi.tartu.ee/index.php/question/getquestion/?id=<? echo $nid;?>;" class="menu_punane" target="_blank">Testi</a></td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="10" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="4%" nowrap="nowrap" class="menu">T&uuml;&uuml;p :</td>
          <td width="22%" ><select name="liik" id="select" class="fields_left">
              <option value="0" <? if($line["liik"]==0) { echo "selected"; }?>>valikvastus</option>
             <option value="1" <? if($line["liik"]==1) { echo "selected"; }?>>vali mitu</option>
             <option value="2" <? if($line["liik"]==2) { echo "selected"; }?>>vabavastus</option>
             <option value="3" <? if($line["liik"]==3) { echo "selected"; }?>>graafik</option>
             <option value="4" <? if($line["liik"]==4) { echo "selected"; }?>>seosed</option>
            <option value="5" <? if($line["liik"]==5) { echo "selected"; }?>>järjesta</option>
             <option value="6" <? if($line["liik"]==6) { echo "selected"; }?>>pildivalik</option>
             <option value="7" <? if($line["liik"]==7) { echo "selected"; }?>>asjad pildil</option>
             <option value="8" <? if($line["liik"]==8) { echo "selected"; }?>>valemivalik</option>
             <option value="9" <? if($line["liik"]==9) { echo "selected"; }?>>valikvastus pildiga</option>
            
             
              </select></td>
          <td width="11%" class="menu" >Seeria&uuml;lesanne</td>
          <td width="11%" class="menu" ><input class="fields" name="on_seeria" type="text" value="<? echo $line["on_seeria"]; ?>" size="2" /></td>
          <td width="10%" align="right" class="menu" >Raskusaste:</td>
          <td width="11%" class="menu" ><select name="raskus" id="select" class="fields_left">
              <option value="1" <? if($line["raskus"]==1) { echo "selected"; }?>>lihtne</option>
             <option value="2" <? if($line["raskus"]==2) { echo "selected"; }?>>nii ja naa</option>
             <option value="3" <? if($line["raskus"]==3) { echo "selected"; }?>>killer</option>
             
              </select></td>
          
          <td width="6%" align="right"  class="menu">viide:</td>
          <td width="10%" class="fields" ><input class="fields" name="algallikas" type="text" value="<? echo $line["algallikas"]; ?>" size="10" /></td>
          <td width="12%" align="right" class="menu" >Avalik:            </td>
          <td width="3%" align="right" ><input class="fields" name="naita_veebis" type="text" value="<? echo $line["naita_veebis"]; ?>" size="2" /></td>
        </tr>
</table>
<table cellpadding="0" width="100%" border="0" cellspacing="0" >
        <tr background="images/sinine.gif"> 
          <td colspan="2" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td colspan="2"><table width="100%" border="0" cellpadding="10">
            <tr>
              <td width="96%" bgcolor="#FFFF99" class="pealkiri"><? echo $line["probleem_est"];?></td>
              <td width="4%" valign="top"><input type="button" class="button3" value="m" onclick="window.open('nupula_kirj_mod.php?id=<? echo $nid; ?>&isik_id=<? echo $login_id;?>&isik_nimi=<? echo $login_nimi;?>&vali=probleem_est&sel=1','Delete','toolbar=0, scrollbars=1,width=820,height=800,status=yes');" /></td>
              </tr>
  </table>
</td>
          </tr>

 <tr> <td valign="top" rowspan="3">
  <? if ($line["on_seeria"]==0)
 {?>  
   <table width="96%" border="0" cellpadding="1">
     
     <tr>
       <td width="39%" colspan="2" class="menu">Vastusevariant</td>
       <td width="20%" class="menu">Pildi/valemi&nbsp;ID</td>
       <td width="31%" class="menu">Vihje</td>
       <td width="10%" class="menu">Õige?</td>
       </tr>
  <? for($i=1; $i<6;$i++) 
 {?>
     <tr>
       <td class="options" valign="top"><? echo $i; ?>.</td>
       <td valign="top"><textarea class="options" name="valik<? echo $i;?>" cols="45" rows="1"><? echo $line["valik".$i] ?></textarea></td>
       <td align="center" valign="top"><input class="options" name="pilt<? echo $i;?>" type="text" value="<? echo $line["pilt".$i] ?>" size="4" /></td>
       <td valign="top"><textarea class="options" name="komm<? echo $i;?>" cols="20" rows="1"><? echo $line["komm".$i] ?></textarea></td>
       <td align="center" valign="top"><input class="options" name="vast<? echo $i;?>" type="text" value="<? echo $line["vast".$i] ?>" size="3" /></td>
       </tr>
      <? }?>
     </table>
   <? 
 	}
  	else
	{
	
	 ?>
	 <table width="100%" border="0">
  <tr>
    <td valign="top"><?
				tabel2("nupula_nupula",$nid,$_SESSION["mysession"]["login"],1,1,"Seeriaülesanded:");
	?></td>
  </tr>
</table>

	 <?
	 
	}
 ?>
   </td>
   <td width="24%" valign="top"><?
		tabel("nupula_pildid",$nid,$_SESSION["mysession"]["login"], 1,"Pildid:");								
		?></td>
   <td width="0" rowspan="3"></tr>
 
 <tr>
   <td valign="top"><?
				tabel2("nupula_valem",$nid,$_SESSION["mysession"]["login"],1,1,"Valemid:");
	?></td>
 </tr>
<tr>
   <td valign="top"><?
				tabel2("raamatX_nupula",$nid,$_SESSION["mysession"]["login"],2,1,"Seotud teemad:");
	?></td>
 </tr> 
<? if (1)
 {?>
        <tr>
          <td colspan="2" class="menu">Lahendus</td>
          </tr>
        <tr>
          <td colspan="2" align="center" class="menu"><textarea class="fields_left" name="lahendus_est" cols="80" rows="18"><? echo $line["lahendus_est"]; ?></textarea></td>
          </tr>
        <tr>
          <td colspan="2" class="menu">Script </td>
          </tr>
        <tr> 
          <td colspan="2" align="center" class="menu"><textarea class="fields_left" name="script" cols="80" rows="18"><? echo $line["script"]; ?></textarea></td>
          </tr>
 <? }?>       
</table>
	  </td></tr>
  </table>
</form>









