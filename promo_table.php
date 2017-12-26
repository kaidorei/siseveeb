<br>

<?
	$action=$_GET["action"];
// kui on vaja kustutada, siis ...
	if($action=="del"){
		$tid=$_GET["tid"];
		$mediadirs=array("_pildid","teade_docs");
		
// kustutame failid ...
		foreach($mediadirs as $tmp){
			$dd="media/".$tmp;
			$q="SELECT url FROM ".$tmp." WHERE oid=".$tid;
//			echo $q;
			$r=mysql_query($q);
			while($line=mysql_fetch_array($r)){
				 unlink(urldecode($line["url"]));  
				}	
		}				
// kustutame kirjed toetavates tabelites ...
		$tables=array('teade_pildid','teade_docs');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$tid;
			$r=mysql_query($q);
		}
// kustutame kirje tabelis teade ...
		$q="DELETE FROM teade WHERE id=".$tid;
		$r=mysql_query($q);
	}
	
	
	$query="SELECT date, id, title FROM teade WHERE title LIKE '%%' ORDER BY `teade`.`id` DESC LIMIT 0 , 20";
	//echo $query;
	$result=mysql_query($query);
	while($line=mysql_fetch_array($result)){
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr background="image/sinine.gif"> 
			<td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
			</tr>
			<tr> 
			<td valign="top"><img src="image/spacer.gif" width="30" height="10"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></td>
			 <td  width="100%" valign="top" nowrap class="menu"><a href="index.php?page=promo_disp&tid=<? echo $line["id"]; ?>"><? echo $line["title"]; ?></a></td>
			 <td valign="top" class="smallbody"><? if($priv>=2) {?><a href="index.php?page=promo_table&action=del&tid=<? echo $line["id"]; ?>">kustuta</a><? } ?></td>
			<td valign="top" nowrap>
			 <img  align="middle" src="image/index_39.gif"></td>
			</tr>
		</table>
		<?
		}	// ------------- peagrupi exponaat -----------
		?>

