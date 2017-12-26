<?  function tabel6($domain,$fid,$login, $pid){
					$d=$domain;	
		   			   	$query2="SELECT * FROM ".$domain." WHERE kool_id=".$fid." ORDER BY id";
//						echo $query2;
				        $result2=mysql_query($query2);
						?>
						
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  	<tr>	
  		<td width="100%" background="image/sinine.gif" class="menu"><? echo $tulem3["nimi_est"];?></td>
		<td colspan=4 width="10%" background="image/sinine.gif" class="menu" ></td>
	</tr> 
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <?
		while($tulem=mysql_fetch_array($result2)){
				   		$query5="SELECT nimi FROM kool WHERE id=".$tulem["kool_id"]."";
//						echo $query3;
				        $result5=mysql_query($query5);
						$tulem5=mysql_fetch_array($result5)
?>
  <tr> 
    <td class="fields"><? echo $tulem["nimi"]; ?>  </td>
    <? ////......................................................................................................................................
//			if ($line[0]["privileegid"]==2){

				?>

    <td width="10" ><input name="button" type="button" class="button3" onclick="window.open('addvalue_sit.php?domain=<? echo $d; ?>&fid=<? echo $fid; ?>&sid=<? echo $tulem["id"]; ?>&act=mod','File_upload','toolbar=0,width=640,height=470,status=yes,scrollbars=yes,resizable=yes')" value="mod" /></td>
    <td width="22" ><div align="right"> 
        <input width="10" type="button" class="button2" value="x" onClick="window.open('delvalue_tid.php?domain=exp<? echo $fid; ?>_tulemused&oid=<? echo $tulem["id"]; ?>','Delete','toolbar=0,width=440,height=320,status=yes')" >
      </div></td>
    <? //} ?>
  </tr>
  <? } ?>
</table>
<table width="102%" border="0" cellspacing="1" cellpadding="0">	
						  <tr background="image/sinine.gif"><td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        				  </tr>
						  
						  <tr align="left" >
						  
    <td colspan="5" class="menu" >
 									
						  			<input type="button" name="suva1" class="button" value="Defineeri uus" onClick="window.open('addvalue_sit.php?domain=<? echo $domain; ?>&fid=<? echo $fid; ?>','File_upload','toolbar=0,width=540,height=480,status=yes,scrollbars=yes,resizable=yes')">
						  </td></tr></table>
					<? } ?>

					