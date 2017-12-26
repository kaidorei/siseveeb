<script type="text/javascript" src="ahaa.js"></script>

<?
	$action=$_GET["action"];
// kui on vaja kustutada, siis ...
	if($action=="del"){
		$etendusid=$_GET["etendusid"];
		$mediadirs=array("_pildid","etendus_docs");
		
// kustutame failid ...
		foreach($mediadirs as $tmp){
			$dd="media/".$tmp;
			$q="SELECT url FROM ".$tmp." WHERE oid=".$etendusid;
//			echo $q;
			$r=mysql_query($q);
			while($line=mysql_fetch_array($r)){
				 unlink(urldecode($line["url"]));  
				}	
		}				
// kustutame kirjed toetavates tabelites ...
		$tables=array('etendus_pildid','etendus_docs');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$etendusid;
			$r=mysql_query($q);
		}
// kustutame kirje tabelis etendus ...
		$q="DELETE FROM etendus WHERE id=".$etendusid;
		$r=mysql_query($q);
	}
	
	
	$query="SELECT * FROM etendus WHERE nimi_est LIKE '%".$_POST["search_str"]."%' ORDER BY nimi_est";
	$result=mysql_query($query);
	while($line=mysql_fetch_array($result)){
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr background="image/sinine.gif"> 
			<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
			</tr>
			<tr> 
			<td><img src="image/spacer.gif" width="30" height="10"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></td>
			 <td  width="100%" class="menu" nowrap><a href="index.php?page=etendus_disp&etendusid=<? echo $line["id"]; ?>" target="_blank"><? echo $line["nimi_est"]; ?></a></td>
			 <td align="right" valign="middle" class="smallbody"><? if($priv>=5) {?>
             
             <div align="right"><a onclick='javascript:kysi("index.php?page=etendus_table&action=del&etendusid=<? echo $line["id"]; ?>","Oled p&atilde;ris kindel, et soovid kustutada kirje <? echo $line["nimi_est"];?>?")' class="button2">x</a></div><? } ?> </td>
			</tr><tr> 
			<td colspan="2" class="navi"><? echo $line["kirjeldus_est"]; ?></td>
			 <td valign="top" class="smallbody"> <? if($line["veeb_pilt_url"]){?><img width="50" src="<? echo urldecode($line["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url"  align="right" style="background-color: #CCCCCC"><? }?></td>
			</tr>
		</table>
		<?
		}	// ------------- peagrupi exponaat -----------
		?>

