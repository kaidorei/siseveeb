<br> 
<?	$action=$_GET["action"];
	$sel=$_GET["sel"];
	if($action=="del"){
		$expid=$_GET["fid"];
		$tables=array('firma_lingid','firma_isikud');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$fid;
			$r=mysql_query($q);
			}
			$q="DELETE FROM firma WHERE id=".$fid;
			$r=mysql_query($q);
	}
	
// kui on tehtud valik tegevusala j'rgi .. 
	if($sel!=NULL) 
	{
		$str1 = " AND tegevusala_id =".$sel;
	}
	else
	{	
		$str1='';
	}

			
	$query="SELECT * FROM firma WHERE nimi LIKE '%".$_POST["search_str"]."%'".$str1." AND gpid_firma=6 ORDER BY nimi";
	$result=mysql_query($query);
	?>NEED, KES MÜÜVAD KATSEVAHENDEID:<?
	while($line=mysql_fetch_array($result)){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
    	<td width="5%"><img src="image/spacer.gif" width="30" height="10"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></td>

        <td  width="70%" class="menu" nowrap><a href="index.php?page=firma_disp&fid=<? echo $line["id"]; ?>"><? echo $line["nimi"]; ?></a></td>

		<td  width="13%" class="menu_punane" nowrap><? if($line["naita_veebis"]==1) {?>
		  <a href="<? echo $line["www"];?>">WWW</a>		  <? } ?></td>
		<td width="5%" valign="middle"><? if($priv>=2) {?><img  align="middle" src="image/index_39.gif"><? } ?></td>

    	<td width="7%" nowrap class="smallbody"><? if($priv>=2) {?><a href="index.php?page=firma_table&action=del&fid=<? echo $line["id"]; ?>">kustuta</a><? } ?></td>
        </tr>
      </table>
     
<?
}?> KÕIK:<?
	$query="SELECT nimi,id, naita_veebis FROM firma WHERE nimi LIKE '%".$_POST["search_str"]."%'".$str1." ORDER BY nimi";
	$result=mysql_query($query);
	while($line=mysql_fetch_array($result)){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
    	<td width="5%"><img src="image/spacer.gif" width="30" height="10"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></td>

        <td  width="70%" class="menu" nowrap><a href="index.php?page=firma_disp&fid=<? echo $line["id"]; ?>"><? echo $line["nimi"]; ?></a></td>

		<td  width="13%" class="menu_punane" nowrap><? if($line["naita_veebis"]==1) {?>veebis<? } ?></td>
		<td width="5%" valign="middle"><? if($priv>=2) {?><img  align="middle" src="image/index_39.gif"><? } ?></td>

    	<td width="7%" nowrap class="smallbody"><? if($priv>=2) {?><a href="index.php?page=firma_table&action=del&fid=<? echo $line["id"]; ?>">kustuta</a><? } ?></td>
        </tr>
      </table>
<?
}
?>
<table><td width="65%" bordercolor="#CCCCCC" > <div align="left"><a class="menu" href="index.php?page=firma_nimekiri"><br>
        Tr&uuml;kiversioon</a></div></td>
</table>