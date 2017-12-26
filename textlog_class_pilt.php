<? 
include("tabel_class_oid.php");
 
function log3($domain,$extent,$oid,$login,$fields){
			if($extent>0){
					$limit="LIMIT ".$extent;
			} else { $limit="";} ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td colspan="3" class="fields"> <?
			$query="SELECT * FROM ".$domain." WHERE oid=".$oid." ORDER BY id DESC ".$limit;
//			echo $query;
			$result=mysql_query($query);
			while($var=mysql_fetch_array($result)){ //$var=$line;
				//	print_r($var);
					$query2="SELECT eesnimi,perenimi FROM isik WHERE id=".$var["user_id"];
					$result2=mysql_query($query2);
					while($line2=mysql_fetch_array($result2)){ ?>
					<tr>
						<td colspan="3" class="smallbody" ><span class="navi"><? echo $var["date"]; ?> ( <? echo $line2["eesnimi"];?> <? echo $line2["perenimi"];?> )</span></td>
					</tr>
					<? } ?>
					<tr>
						<td colspan="3" class="smallbody"><strong><? echo $var["title"]; ?></strong></td>
					</tr>
					<tr>
					  <td width="63%" valign="top" class="smallbody"><? echo $var["body"]; ?></td>
			          <td width="30%" valign="top" class="smallbody"><? tabel($domain."_pildid",$var["id"],$_SESSION["mysession"]["login"], 1,1);?>&nbsp;</td>
			          <td width="7%" class="smallbody"><? if($var["veeb_pilt_url"]){?><a href=<? echo urldecode($var["veeb_pilt_url_s"]); ?> target=_blank><img src="<? echo urldecode($var["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" border="0" align="right" style="background-color: #CCCCCC"></a> <? }else{?><img src="image/spacer.gif" /><? }?></td>
			  </tr>
					<tr>
									<td colspan="3" background="image/sinine.gif"><img height="1" width="1" src="image/sinine.gif" /></td>
			  </tr>
				<? } ?>
</table>
			</br>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="100%" class="menu" align="right"><a href=" <? echo keyke($domain."open"); ?>"><? echo ((strpos(keyke($domain."open"),$domain."open")==0)?"lühidalt":"veel");?></a></td>
						<td><img src="image/index_41.gif" border="0"></td>
						<? $query="SELECT privileegid FROM isik WHERE username='".$login."'"; 
						$result = mysql_query($query);
						$line=mysql_fetch_row($result); ?>
						<td width="100%" class="menu" align="right"><a href="#" onClick="window.open('addvalue_textlog.php?domain=<? echo $domain;?>&user=<? echo $_SESSION["mysession"]["login"];?>&valjad=<? echo $fields; ?>&identify=oid&oid=<? echo $oid; ?>','Lisa','toolbar=0,width=620,height=550,status=yes')">lisa</a></td>
						<td><img src="image/index_36.gif" border="0"></td>
					</tr>
				</table>
<?	} ?>
