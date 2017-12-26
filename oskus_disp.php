<?
	$eh=$_GET["action"];
	$osid=$_GET["osid"];
	$klass=$_GET["klass"];
	$aid=$_GET["aid"];
	include("globals.php");
	include("tabel_class_iid.php");
	include("tabel_class_oid.php");
	
	if($eh=="new"){
		$query="INSERT INTO oskus (nimi_est) VALUES ('nimetu')";
		$tmp=mysql_query($query);
//		echo $query;
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$osid=$tmp["last_insert_id()"];

		if($osid and $klass)
		{
//			echo "teeme kohe seose vastava ainevärgiga<br>";
			$query_insert="INSERT INTO ".$klass."_oskus (oid1,oid2) VALUES (\"".$aid."\",\"".$osid."\")";
//			echo $query_insert;
			$tmp=mysql_query($query_insert);
				
		}

		// ------------------------------------------------
	} elseif($eh=="save" && $_POST["nimi_est"]){
		$valjad=array("nimi_est", "oskus_est");
		foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
			}
		$query="UPDATE oskus SET ".implode(",",$rida)." WHERE id=".$osid;
//		echo $query;	
		$result=mysql_query($query);
	}	

    $query="SELECT * FROM oskus WHERE id=".$osid;
//	echo $query;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
 ?> 
<script src="ckeditor/ckeditor.js"></script>
<form name="naitus" method="post" action="<? echo $PHP_SELF."?page=oskus_disp&action=save&osid=".$osid; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
      <td width="32%" valign="top">
        
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr background="image/sinine.gif"> 
      <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
      </tr>
    <tr> 
      <td class="menu">Nimi</td>
      <td width="32%" ><input name="nimi_est" type="text" class="pealkiri" value="<? echo $line["nimi_est"]; ?>" size="45" > 
      </td>
      <td width="33%" align="right" >              <? if($priv>=2) {?>      
              <input class="button2" type="submit" name="Submit" value="Salvesta">
            <? } ?>	 </td>
      </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr background="image/sinine.gif"> 
      <td width="100%" colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
      </tr>
    </table>
        
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr background="image/sinine.gif"> 
      <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
      </tr>
    <tr> 
      <td align="left" class="menu">Oskus</td>
      <td width="91%" align="center" > <textarea cols="50" name="oskus_est" rows="10"><? echo $line["oskus_est"];?></textarea></td>
      </tr>
    <tr>
      <td colspan="2" align="left" class="menu"><?
				tabel2("raamat15_oskus",$osid,$_SESSION["mysession"]["login"],2,1,"Õpieesmärgid - mis peaks tunni lõpuks klaar olema");
	?></td>
      </tr>
  </table>
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr background="image/sinine.gif"> 
      <td width="100%" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
      </tr>
  </table>
        
        
        
        
</td>
    </tr>
</table>
</form>
