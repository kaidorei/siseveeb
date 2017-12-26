<br>

<?
	$action=$_GET["action"];
// kui on vaja kustutada, siis ...
	if($action=="del"){
		$tootid=$_GET["tootid"];
		$mediadirs=array("tootuba_pildid","tootuba_docs");
		
// kustutame failid ...
		foreach($mediadirs as $tmp){
			$dd="media/".$tmp;
			$q="SELECT url FROM ".$tmp." WHERE oid=".$tootid;
//			echo $q;
			$r=mysql_query($q);
			while($line=mysql_fetch_array($r)){
				 unlink(urldecode($line["url"]));  
				}	
		}				
// kustutame kirjed toetavates tabelites ...
		$tables=array('tootuba_pildid','tootuba_docs');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE tootid=".$tootid;
			$r=mysql_query($q);
		}
// kustutame kirje tabelis tootuba ...
		$q="DELETE FROM tootuba WHERE id=".$tootid;
		$r=mysql_query($q);
	}
	
	
	$query="SELECT nimi_est,id FROM tootuba WHERE nimi_est LIKE '%".$_POST["search_str"]."%'";
	$result=mysql_query($query);
	while($line=mysql_fetch_array($result)){
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr background="image/sinine.gif"> 
			<td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
			</tr>
			<tr> 
			<td><img src="image/spacer.gif" width="30" height="10"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></td>
			 <td  width="100%" class="menu" nowrap><a href="index.php?page=toot_disp&tootid=<? echo $line["id"]; ?>"><? echo $line["nimi_est"]; ?></a></td>
			 <td valign="middle" class="smallbody"><? if($priv==2) {?><a href="index.php?page=toot_table&action=del&tootid=<? echo $line["id"]; ?>">kustuta</a><? } ?></td>
			<td nowrap>
			 <img  align="middle" src="image/index_39.gif"></td>
			</tr>
		</table>
		<?
		}	// ------------- peagrupi exponaat -----------
		?>

