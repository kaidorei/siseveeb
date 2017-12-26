<?  function tabel4($domain,$oid,$login, $pid){
					$d=$domain;	
		   			   	$query2="SELECT * FROM exp".$oid."_tulemused ORDER BY id";
//						echo $query2;
				        $result2=mysql_query($query2);
		   			   	$query3="SELECT * FROM exp WHERE id=".$oid."";
//						echo $query3;
				        $result3=mysql_query($query3);
						$tulem3=mysql_fetch_array($result3)
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
    <td width="143" class="fields"><a href= <? echo urldecode($tulem["akt_url"]); ?> target=_blank ><? echo $tulem5["nimi"]; ?>  </a> </td>
    <td class="fields"><? echo $tulem["koguja_algus"]; ?>-<? echo $tulem["koguja_lopp"]; ?></td>
    <? ////......................................................................................................................................
//			if ($line[0]["privileegid"]==2){

				?>

    <td width="41" ><input name="button" type="button" class="button3" onclick="window.open('addvalue_tid_mod.php?domain=<? echo $d; ?>&oid=<? echo $oid; ?>&id=<? echo $tulem["id"]; ?>&act=mod','File_upload','toolbar=0,width=640,height=470,status=yes')" value="mod" /></td>
    <td width="22" ><div align="right"> 
        <input width="10" type="button" class="button2" value="x" onClick="window.open('delvalue_tid.php?domain=exp<? echo $oid; ?>_tulemused&oid=<? echo $tulem["id"]; ?>','Delete','toolbar=0,width=440,height=320,status=yes')" >
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
 									
						  			<input type="button" name="suva1" class="button" value="upload" onClick="window.open('addvalue_tid<? echo $oid;?>.php?domain=exp<? echo $oid; ?>_tulemused&oid=<? echo $oid; ?>&pid=<? echo $pid; ?>','File_upload','toolbar=0,width=540,height=480,status=yes')">
						  </td></tr></table>
					<? } ?>

					