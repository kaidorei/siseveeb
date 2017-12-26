<br>
<?
	$action=$_GET["action"];
	if($action=="del"){
	$kid=$_GET["kid"];
			$mediadirs=array("knowhow_docs");
			foreach($mediadirs as $tmp){
			$dd="media/".$tmp;
			//echo $dd;
			$q="SELECT url FROM ".$tmp." WHERE expid=".$kid;
			$r=mysql_query($q);
			while($line=mysql_fetch_array($r)){
							 unlink(urldecode($line["url"]));  
					}	
				}				
			$tables=array('knowhow_firmad','knowhow_isikud');
			foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$kid;
			$r=mysql_query($q);
			}
			$tables=array('knowhow_docs');
			foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE expid=".$kid;
			$r=mysql_query($q);
			}
			$q="DELETE FROM knowhow WHERE id=".$kid;
			$r=mysql_query($q);
				
			}
					

	$query="SELECT nimi,id FROM knowhow WHERE nimi LIKE '%".$_POST["search_str"]."%'";
	$result=mysql_query($query);
		while($line=mysql_fetch_array($result)){
							
							?><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          
    <td><img src="images/spacer.gif" width="30" height="10"><img border=0 src="images/index_41.gif" width=19 height=19 alt=""><img border=0 src="images/spacer.gif" width="10" height="10"></td>
          <td  width="100%" class="menu" nowrap><a href="index.php?page=knowhow_disp&kid=<? echo $line["id"]; ?>"><? echo $line["nimi"]; ?></a></td><td valign="middle"><? if($priv>=2) {?><img  align="middle" src="images/index_39.gif"><? } ?></td>
    <td nowrap class="smallbody"><? if($priv>=2) {?><a href="index.php?page=knowhow_table&action=del&kid=<? echo $line["id"]; ?>">kustuta</a><? } ?></td>
        </tr>
      </table>
							
<?
							}	// ------------- peagrupi exponaat -----------
		
?>
