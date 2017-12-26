<br>

<?
	$action=$_GET["action"];
// kui on vaja kustutada, siis ...
	if($action=="del"){
		$chid=$_GET["chid"];
		$mediadirs=array("_pildid","chapter_docs");
		
// kustutame failid ...
		foreach($mediadirs as $tmp){
			$dd="media/".$tmp;
			$q="SELECT url FROM ".$tmp." WHERE oid=".$chid;
//			echo $q;
			$r=mysql_query($q);
			while($line=mysql_fetch_array($r)){
				 unlink(urldecode($line["url"]));  
				}	
		}				
// kustutame kirjed toetavates tabelites ...
		$tables=array('chapter_pildid','chapter_docs');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$chid;
			$r=mysql_query($q);
		}
// kustutame kirje tabelis chapter ...
		$q="DELETE FROM chapter WHERE id=".$chid;
		$r=mysql_query($q);
	}
	
	
	$query="SELECT * FROM chapter WHERE nimi_est LIKE '%".$_POST["search_str"]."%'";
	$result=mysql_query($query);
	while($line=mysql_fetch_array($result)){
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr background="image/sinine.gif"> 
			<td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
			</tr>
			<tr> 
			<td><img src="image/spacer.gif" width="30" height="10"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></td>
			 <td  width="100%" class="menu" nowrap><a href="index.php?page=chapter_disp&chid=<? echo $line["id"]; ?>"><? echo $line["nimi_est"]; ?></a></td>
			 <td align="right" valign="middle" class="smallbody"><? if($priv>=5) {?><a href="index.php?page=chapter_table&action=del&chid=<? echo $line["id"]; ?>">kustuta</a><? } ?></td>
			</tr><tr> 
			<td colspan="2" class="navi"><? echo $line["kirjeldus_est"]; ?></td>
			 <td valign="top" class="smallbody"> <? if($line["veeb_pilt_url"]){?><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" border="0" alt="Veebipilt puudub" name="veeb_pilt_url"  align="right" style="background-color: #CCCCCC"><? }?></td>
			</tr>
		</table>
		<?
		}	// ------------- peagrupi exponaat -----------
		?>

