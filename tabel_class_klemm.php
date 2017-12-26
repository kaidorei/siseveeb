<?  function tabel_klemm($domain,$oid,$login, $weeb,$pealkiri){
					$d=$domain;	
		   			   	$query2="SELECT * FROM ".$d." WHERE oid=".$oid." ORDER BY ord";
//						echo $query2;
				        $result2=mysql_query($query2);
						$query="SELECT privileegid FROM isik WHERE username='".$login."'"; 
						$result = mysql_query($query);
						$line=mysql_fetch_row($result);
						
					switch ($d)
					{
						case 'exp_pildid': 		$vert=175; 		$hor=200; 	break;
						case 'isik_pildid': 	$vert=150; 		$hor=120; 	break;	
						case 'uudis_pildid': 	$vert=160; 		$hor=160; 	break;	
						case 'krono_pildid': 	$vert=100; 		$hor=100; 	break;	
						case 'vahendid_pildid': $vert=150; 		$hor=200; 	break;	
						case 'etendus_pildid': $vert=250; 		$hor=120; 	break;	
						case 'exparendus_pildid': $vert=150; 		$hor=200; 	break;	
						default: 				$vert=150; 		$hor=120; 	break;					
					}
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
    <td width="17" class="fields"><? echo $tulem["id"]; ?></td>
    <td width="235" class="fields"><a href= <? echo urldecode($tulem["url"]); ?> target=_blank ><? echo $tulem["nimi"]; ?></a>,&copy;</td>
    <td width="17" class="fields"><? if ($tulem["veeb_pilt_url"]) {?><a href=<? echo urldecode($tulem["veeb_pilt_url_s"]); ?> target=_blank><img src="<? echo urldecode($tulem["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" style="background-color: #CCCCCC" / width="50"></a><? } else {?>
              <img src="image/noimage.jpg" width="50" />              <? }?></td>
    <? ////......................................................................................................................................
//			if ($line[0]["privileegid"]==2){

				if($weeb == 1 || $weeb == 2)
					{ ?>

    <td width="46" ><input type="button" class="button3" value="www" onClick="window.open('setveebpic_oid.php?domain=<? echo $d; ?>&oid=<? echo $oid; ?>&id_pilt=<? echo $tulem["id"]; ?>&vert=<? echo $vert; ?>&hor=<? echo $hor; ?>','Delete','toolbar=0,width=600,height=480,status=no')" ></td>
    <? } ?>
    <td width="27" ><input name="button" type="button" class="button3" onclick="window.open('addvalue_oid_mod.php?domain=<? echo $d; ?>&oid=<? echo $oid; ?>&id=<? echo $tulem["id"]; ?>&act=mod','File_upload','toolbar=0,width=640,height=470,status=yes')" value="m" /></td>
    <td width="22" ><div align="right"> 
        <input width="10" type="button" class="button2" value="x" onClick="window.open('delvalue_oid.php?domain=<? echo $d; ?>&oid=<? echo $oid; ?>&aid=<? echo $tulem["id"]; ?>','Delete','toolbar=0,width=440,height=320,status=yes')" >
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
      <? //if ($line[0]["privileegid"]!=0)
		//				   			{ ?>
      <!--<input type="button" name="suva1" class="button" value="vali olemasolevatest" onClick="window.open('addvalue_ref.php?domain=<? echo $d; ?>&oid=<? echo $oid; ?>','File_upload','toolbar=0,width=540,height=580,status=yes')"><img src="image/spacer.gif" width="20" height="10">-->
									
						  			<input type="button" name="suva1" class="button" value="uus" onClick="window.open('addvalue_klemm.php?domain=<? echo $d; ?>&oid=<? echo $oid; ?>','File_upload','toolbar=0,width=540,height=380,status=yes')">
								<? //} ?>
						  </td></tr></table>
					<? } ?>

					