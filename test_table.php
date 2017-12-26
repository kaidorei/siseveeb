<link href="scat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ahaa.js"></script>
<?
	$action=$_GET["action"];
	$tid=$_GET["tid"];
	if($action=="del"){
		$q="DELETE FROM test WHERE id=".$tid;
		$r=mysql_query($q);
	}

	$query="SELECT * FROM test WHERE nimi_est LIKE '%".$_POST["search_str"]."%' ORDER BY nimi_est ASC";
	$result=mysql_query($query);
//esimene tabeli rida annab kategooria nime ...	
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">	 
 <?
		while($line=mysql_fetch_array($result)){
			?>
	        <tr background="images/sinine.gif"> 
          	<td colspan="5" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td width="4%"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></td>
	       <td  width="5%" class="navi" nowrap><? echo $line["algallikas"]; ?><img src="image/spacer.gif" alt="ss" width="5" height="1" /></td>
	       <td  width="82%" class="menu" nowrap><a href="index.php?page=test_disp&tid=<? echo $line["id"]; ?>" target="_blank"><? echo $line["nimi_est"];?></a></td>
	       <td width="4%" valign="middle"><? if($line["naita_veebis"]==1) {?><img src="image/motik_exp.gif" alt="tanane" /> <? } else {?><img  align="middle" src="image/index_39.gif"><? } ?></td>
		   <td width="5%" nowrap class="smallbody"><? if($priv>=2) {?><a onclick='javascript:kysi("index.php?page=test_table&action=del&tid=<? echo $line["id"]; ?>","Oled p&atilde;ris kindel, et soovid kustutada kirje <? echo $line["nimi_est"];?>?")' class="button2">x</a><? } ?>		     </td>
	       </tr>
	<?
	
	
	}	
  ?>
     </table>

