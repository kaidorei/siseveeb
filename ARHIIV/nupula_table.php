<link href="scat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ahaa.js"></script>
<?
	$action=$_GET["action"];
	$nid=$_GET["nid"];
	if($action=="del"){
		$pid=$_GET["nid"];
		$mediadirs=array("nupula_pildid");
		$q="DELETE FROM nupula WHERE id=".$nid;
		$r=mysql_query($q);
	}

	$query="SELECT * FROM nupula WHERE nimi_est LIKE '%".$_POST["search_str"]."%' ORDER BY algallikas ASC";
	$result=mysql_query($query);
//esimene tabeli rida annab kategooria nime ...	
$count=0;
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">	 
 <?
		while($line=mysql_fetch_array($result)){
			$count++;
			?>
	        <tr background="images/sinine.gif"> 
          	<td colspan="5" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td width="4%" valign="top" class="navi"><? echo $count;?>.</td>
	       <td  width="5%" valign="top" nowrap class="navi"><a href="index.php?page=nupula_disp&nid=<? echo $line["id"]; ?>"><? echo $line["id"]; ?></a></td>
	       <td  width="82%" valign="top" class="menu"><span class="options"><? echo $line["probleem_est"];?></span></td>
	       <td width="4%" valign="top"><? if($line["naita_veebis"]==1) {?><img src="image/motik_exp.gif" alt="tanane" /> <? } else {?><img  align="middle" src="image/index_39.gif"><? } ?></td>
		   <td width="5%" valign="top" nowrap class="smallbody"><a onclick='javascript:kysi("index.php?page=nupula_table&action=del&nid=<? echo $line["id"]; ?>","Oled p&atilde;ris kindel, et soovid kustutada kirje <? echo $line["nimi_est"];?>?")' class="button2">x</a>		      </td>
	       </tr>
	<?
	
	
	}	
  ?>
     </table>

