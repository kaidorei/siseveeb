<?  function tabel_tykid($oid,$login, $weeb){
	$d="vahendidtykid";	
	$query2="SELECT * FROM ".$d." WHERE oid=".$oid." ORDER BY id";
	$result2=mysql_query($query2);
	$query="SELECT privileegid FROM isik WHERE username='".$login."'"; 
	echo $query2;
	$result = mysql_query($query);
	$line=mysql_fetch_row($result);
	
	$vert=150; 		$hor=120;
						?>
<link href="scat.css" rel="stylesheet" type="text/css" />

						
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  	<tr>	
  		<td background="image/sinine.gif" class="menu">T&nbsp;Kood</td>
  		<td width="28" background="image/sinine.gif" class="menu" >Kood</td>
		<td width="481" background="image/sinine.gif" class="menu" >Koht</td>
		<td width="42" background="image/sinine.gif" class="menu" >ok?</td>
		<td width="29" background="image/sinine.gif" class="menu" ></td>
		<td width="27" background="image/sinine.gif" class="menu" ></td>
	</tr> 
  <?
		while($tulem=mysql_fetch_array($result2)){
		?>
  <tr> 
    <td width="38" class="fields"><? echo $tulem["serial"]; ?></td>
    <td width="28" align="center" class="fields"><? echo $tulem["oid"]; ?></td>
    <td width="481" class="fields"><?  echo $tulem["asukoht"]; ?></td>
    <td width="42" class="fields"><? echo $tulem["staatus_id"];?>
    
    
    <?	/*	  	$query2="SELECT nimi,id FROM vahendid_staatus";
				    $result2=mysql_query($query2);
					echo "<select  class=\"fields\" name=\"staatus_id\">";
					while($var=mysql_fetch_array($result2)){
									if($var["id"]==$line["staatus_id"]) { $sel="selected"; } else { $sel="";}
         							echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["nimi"]."</option>"; 
					}
					echo "</select>";*/
		  ?>
    
    
    
    </td>
   <td ><input name="button" type="button" class="button3" onclick="window.open('addvalue_tabeltykid.php?domain=<? echo $d; ?>&oid=<? echo $oid; ?>&id=<? echo $tulem["id"]; ?>&act=mod','File_upload','toolbar=0,width=640,height=470,status=yes')" value="m" /></td>
   <td ><input width="10" type="button" class="button2" value="x" onclick="window.open('delvalue_oid.php?domain=<? echo $d; ?>&oid=<? echo $oid; ?>&aid=<? echo $tulem["id"]; ?>','Delete','toolbar=0,width=440,height=320,status=yes')" /></td>
     <? //} ?>
  </tr>
  <? } ?>
</table>
<table width="102%" border="0" cellspacing="1" cellpadding="0">	
						  <tr background="image/sinine.gif"><td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        				  </tr>
						  
						  <tr align="left" >
						  
    <td colspan="5" class="menu" >
      <? //if ($line[0]["privileegid"]!=0)
		//				   			{ ?>
      <!--<input type="button" name="suva1" class="button" value="vali olemasolevatest" onClick="window.open('addvalue_ref.php?domain=<? echo $d; ?>&oid=<? echo $oid; ?>','File_upload','toolbar=0,width=540,height=580,status=yes')"><img src="image/spacer.gif" width="20" height="10">-->
									
						  			<input type="button" name="suva1" class="button" value="Lisa" onClick="window.open('addvalue_tabeltykid.php?domain=<? echo $d; ?>&oid=<? echo $oid; ?>','File_upload','toolbar=0,width=540,height=380,status=yes')">
								<? //} ?>
						  </td></tr></table>
					<? } ?>

