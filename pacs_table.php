<br>
<?
	$action=$_GET["action"];
	if($action=="del"){
		$pid=$_GET["pid"];
		$mediadirs=array("pacs_pildid");
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
		$tables=array('pacs_lingid');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$pid;
			$r=mysql_query($q);
//			echo $q;
		}
	
		$tables=array('pacs_alog');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE logid=".$pid;
			$r=mysql_query($q);
		}
		$q="DELETE FROM pacs WHERE id=".$pid;
		$r=mysql_query($q);
	}
	

	$query="SELECT id, nimi_est FROM pacs ORDER BY nimi_est";
	$result=mysql_query($query);
//esimene tabeli rida annab kategooria nime ...	
	?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?
		
		$id_prev=0;
		while($line=mysql_fetch_array($result)){
			?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
    <td colspan="6" height="1" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
    <td width="10" valign="top"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""></td>
    <td width="30" class="navi" valign="top"><? echo $line["id"]; ?></td>
    <td  width="300" valign="top" nowrap class="menu"><a href="index.php?page=pacs_disp&pid=<? echo $line["id"]; ?>"><? echo $line["nimi_est"]?></a> 
    </td>
    <td  width="100" valign="top" nowrap class="menu"> 
    </td>
    <td width="30" nowrap class="smallbody"> 
      <? // if($priv>=2) {?>
      <div align="right"><a href="index.php?page=pacs_table&action=del&pid=<? echo $line["id"]; ?>">kustuta</a> 
        <? //} ?>
      </div></td>
  </tr>
</table>
	<?
	$id_prev = $line["id"];
	}	// ------------- peagrupi exponaat -----------
?>

