<?  function tabel_param($domain,$oid,$login, $weeb,$pealkiri){
	$d=$domain;	
	$query2="SELECT * FROM ".$d." WHERE oid=".$oid." ORDER BY id";
		//echo $query2;
	$result2=mysql_query($query2);
	$query="SELECT privileegid FROM isik WHERE username='".$login."'"; 
	$result = mysql_query($query);
	$line=mysql_fetch_row($result);
	?>
<link href="scat.css" rel="stylesheet" type="text/css" />

						
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  	<tr>	
  		<td width="100%" background="image/sinine.gif" class="menu"><? echo $pealkiri;?></td>
		<td width="10%" colspan=4 align="center" background="image/sinine.gif" class="navi" >&nbsp;</td>
	</tr> 
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <?
		while($tulem=mysql_fetch_array($result2)){
		?>
  <tr> 
    <td width="17" valign="top" class="fields"><? echo $tulem["id"]; ?></td>
    <td width="235" class="fields"><? echo $tulem["tahis"]." - ".$tulem["nimi"]."<br>Vaikimisi: ".$tulem["vaikev"]."&middot;10<sup>".$tulem["vaikev_aste"]."</sup><br>Min: ".$tulem["min_v"]."&middot;10<sup>".$tulem["min_v_aste"]."</sup><br>Max: ".$tulem["max_v"]."&middot;10<sup>".$tulem["max_v_aste"]."</sup><br>"; ?></td>
       <td width="27" valign="top" ><input name="button" type="button" class="button3" onclick="window.open('addvalue_param.php?oid=<? echo $oid; ?>&id=<? echo $tulem["id"]; ?>','File_upload','toolbar=0,width=640,height=470,status=yes')" value="m" /></td>
    <td width="22" valign="top" ><div align="right"> 
        <input width="10" type="button" class="button2" value="x" onClick="window.open('delvalue_param.php?&oid=<? echo $oid; ?>&id=<? echo $tulem["id"]; ?>','Delete','toolbar=0,width=440,height=320,status=yes')" >
      </div></td>
    <? //} ?>
  </tr>
  <? } ?>
  <tr>
    <td colspan="4" class="fields">&nbsp;<input type="button" name="suva1" class="button" value="uus" onClick="window.open('addvalue_param.php?act=new&oid=<? echo $oid; ?>','File_upload','toolbar=0,width=540,height=380,status=yes')">
	<? //} ?></td>
  </tr>
</table>

					<? } ?>

					