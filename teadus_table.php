<br> 
<?	$action=$_GET["action"];
	$sel=$_GET["sel"];
	if($action=="del"){
		$expid=$_GET["tid"];
		$tables=array('teadus_lingid','teadus_isik');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$tid;
			$r=mysql_query($q);
			}
			$q="DELETE FROM tteema WHERE id=".$tid;
			$r=mysql_query($q);
	}
	
	
	$query="SELECT nimi_est,id FROM tteema WHERE nimi_est LIKE '%".$_POST["search_str"]."%'".$str1." ORDER BY nimi_est";
	
	$result=mysql_query($query);
	while($line=mysql_fetch_array($result)){
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1">Siia hakkavad kogunema teadusteemad ja andmed teemade t&auml;itjate kohta ... 
kas ETIS aitaks? </td>
        </tr>
        <tr> 
    	<td><img src="image/spacer.gif" width="30" height="10"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></td>

        <td  width="100%" class="menu" nowrap><a href="index.php?page=teadus_disp&tid=<? echo $line["id"]; ?>"><? echo $line["nimi_est"]; ?></a></td>

		<td valign="middle"><? if($priv>=2) {?><img  align="middle" src="image/index_39.gif"><? } ?></td>

    	<td nowrap class="smallbody"><? if($priv>=2) {?><a href="index.php?page=teadus_table&action=del&tid=<? echo $line["id"]; ?>">kustuta</a><? } ?></td>

        </tr>
      </table>
<?
}
?>
