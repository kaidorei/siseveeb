<br>
<?
	$action=$_GET["action"];
	if($action=="del"){
		$pid=$_GET["pid"];
		$mediadirs=array("tehno_pildid");
		foreach($mediadirs as $tmp){
			$dd="media/".$tmp;
//			echo $dd;
			$q="SELECT url FROM ".$tmp." WHERE oid=".$pid;
//			echo $q;
			$r=mysql_query($q);
			while($line=mysql_fetch_array($r)){
				 unlink(urldecode($line["url"]));  
				}	
			}				
		$tables=array('tehno_lingid');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$pid;
			$r=mysql_query($q);
//			echo $q;
		}
	
		$tables=array('tehno_alog');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE logid=".$pid;
			$r=mysql_query($q);
		}
		$q="DELETE FROM tehno WHERE id=".$pid;
		$r=mysql_query($q);
	}
	$up1=$_GET["up1"];
	$up2=$_GET["up2"];
	
	if($up1!=NULL)
	{
	//muudan kolme sammuga nende kahe id
	$query1="SELECT oid1, oid2 FROM tehno_tehno WHERE id=".$up1;
	$result1=mysql_query($query1);
	$var1=mysql_fetch_array($result1);
	$query2="SELECT oid1, oid2 FROM tehno_tehno WHERE id=".$up2;
	$result2=mysql_query($query2);
	$var2=mysql_fetch_array($result2);
	
	$query1="UPDATE tehno_tehno SET oid1=".$var2["oid1"].", oid2=".$var2["oid2"]." WHERE id=".$up1;
	$result1=mysql_query($query1);
	$query2="UPDATE tehno_tehno SET oid1=".$var1["oid1"].", oid2=".$var1["oid2"]." WHERE id=".$up2;
	$result2=mysql_query($query2);
	}
	
	$query="SELECT id, oid1, oid2 FROM tehno_tehno ORDER BY id";
	$result=mysql_query($query);
//esimene tabeli rida annab kategooria nime ...	
	?><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif">          
  		<td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"><font size="-1" face="Arial, Helvetica, sans-serif"><strong><? echo $varq ?> </strong></font> 
 	<? //echo $query, "kaido"; ?> 
 		</td>
       	</tr>
		<?
		
		$id_prev=0;
		while($line=mysql_fetch_array($result)){
			?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
    <td colspan="7" height="1" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
	<?
	$query1="SELECT nimi_est FROM tehno WHERE id=".$line["oid1"];
	$result1=mysql_query($query1);
	$nimi1=mysql_fetch_array($result1);
	$query2="SELECT nimi_est FROM tehno WHERE id=".$line["oid2"];
	$result2=mysql_query($query2);
	$nimi2=mysql_fetch_array($result2);
	
	?>
  <tr> 
    <td width="2%" height="20" valign="top"><a href="index.php?page=tehno_table&up1=<? echo $id_prev; ?>&up2=<? echo $line["id"]; ?>"><img border=0 src="image/index_up.gif" width=19 height=19 alt=""></a></td>
    <td width="10%" class="navi" valign="top"><? echo $line["id"]; ?></td>
    <td  width="36%" valign="top" nowrap class="menu"><a href="index.php?page=tehno_disp&pid=<? echo $line["oid1"]; ?>"><? echo $nimi1[0];?></a>    </td>
    <td  width="3%" valign="top" nowrap class="menu">&lt;-&gt;</td>
    <td  width="40%" valign="top" nowrap class="menu"><a href="index.php?page=tehno_disp&pid=<? echo $line["oid2"]; ?>"> <? echo $nimi2[0];?></a>    </td>
    <td width="9%" nowrap class="smallbody"> 
      <? // if($priv>=2) {?>
      <a href="index.php?page=tehno_table&action=del&pid=<? echo $line["id"]; ?>">kustuta</a> 
      <? //} ?>    </td>
  </tr>
</table>
	
<?
	$id_prev = $line["id"];
	}	// ------------- peagrupi exponaat -----------


	$query="SELECT id, nimi_est FROM tehno ORDER BY nimi_est";
	$result=mysql_query($query);
//esimene tabeli rida annab kategooria nime ...	
	?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif">          
  		<td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"><font size="-1" face="Arial, Helvetica, sans-serif"><strong></strong></font> 
 		</td>
       	</tr>
		<?
		
		$id_prev=0;
		while($line=mysql_fetch_array($result)){
			?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
    <td colspan="6" height="1" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
    <td width="10" valign="top"><a href="index.php?page=tehno_table&up1=<? echo $id_prev; ?>&up2=<? echo $line["id"]; ?>"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""></a></td>
    <td width="30" class="navi" valign="top"><? echo $line["id"]; ?></td>
    <td  width="300" valign="top" nowrap class="menu"><a href="index.php?page=tehno_disp&pid=<? echo $line["id"]; ?>"><? echo $line["nimi_est"]?></a> 
    </td>
    <td  width="100" valign="top" nowrap class="menu"> 
    </td>
    <td width="30" nowrap class="smallbody"> 
      <? // if($priv>=2) {?>
      <div align="right"><a href="index.php?page=tehno_table&action=del&pid=<? echo $line["id"]; ?>">kustuta</a> 
        <? //} ?>
      </div></td>
  </tr>
</table>
	<?
	$id_prev = $line["id"];
	}	// ------------- peagrupi exponaat -----------
?>

