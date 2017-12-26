<link href="scat.css" rel="stylesheet" type="text/css" />
<br>
<?
	$action=$_GET["action"];
	if($action=="del"){
		$pid=$_GET["uid"];
		$mediadirs=array("uudis_pildid");
		foreach($mediadirs as $tmp){
			$dd="media/".$tmp;
//			echo $dd;
			$q="SELECT url FROM ".$tmp." WHERE oid=".$uid;
//			echo $q;
			$r=mysql_query($q);
			while($line=mysql_fetch_array($r)){
				 unlink(urldecode($line["url"]));  
				}	
			}				
		$tables=array('uudis_lingid');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$uid;
			$r=mysql_query($q);
//			echo $q;
		}
		$q="DELETE FROM uudis WHERE id=".$uid;
		$r=mysql_query($q);
	}

	$query="SELECT title, show_page,id, veeb_pilt_url FROM uudis WHERE title LIKE '%".$_POST["search_str"]."%' AND liik=2 AND sisu=1 ORDER BY ID DESC";
	$result=mysql_query($query);
//esimene tabeli rida annab kategooria nime ...	
	?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">	 
 	       <tr> 
		   <td colspan="2" valign="middle"><img border=0 src="image/spacer.gif" width="10" height="20"><span class="menu_punane">Piltuudised: Teadus&amp;Loodus</span></td>
	       
	       <td valign="middle"></td>
		   <td nowrap class="smallbody">		     </td>
	       </tr>
	        <tr background="images/sinine.gif"> 
          	<td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td><img src="image/spacer.gif" width="30" height="10"><img border=0 src="image/spacer.gif" width="10" height="10"></td>
	       <td colspan="3"  width="100%" class="menu"><?
		

		while($line=mysql_fetch_array($result)){
			?>
	         <a href="index.php?page=uudis_disp&uid=<? echo $line["id"]; ?>"><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" border="0" width="70" height="70" alt="Veebipilt puudub" name="veeb_pilt_url" style="background-color: #CCCCCC" /></a>	<?
	
	
	}	
  ?>
</td>
	       </tr>
     </table>	<?
	$query="SELECT title,id, veeb_pilt_url FROM uudis WHERE title LIKE '%".$_POST["search_str"]."%' AND liik=2 AND sisu=2 ORDER BY ID DESC";
	$result=mysql_query($query);
//esimene tabeli rida annab kategooria nime ...	
	?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">	 
 	       <tr> 
		   <td colspan="2" valign="middle"><img border=0 src="image/spacer.gif" width="10" height="20"><span class="menu_punane">Piltuudised: Tehnoloogia </span></td>
	       
	       <td valign="middle"></td>
		   <td nowrap class="smallbody">		     </td>
	       </tr>
	        <tr background="images/sinine.gif"> 
          	<td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td><img src="image/spacer.gif" width="30" height="10"><img border=0 src="image/spacer.gif" width="10" height="10"></td>
	       <td colspan="3"  width="100%" class="menu"><?
		

		while($line=mysql_fetch_array($result)){
			?>
	         <a href="index.php?page=uudis_disp&uid=<? echo $line["id"]; ?>"><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" border="0" width="70" height="70" alt="Veebipilt puudub" name="veeb_pilt_url" style="background-color: #CCCCCC" /></a>	<?
	
	
	}	
  ?>
</td>
	       </tr>
     </table>	
	 
	 
		<? $query="SELECT title, show_page,id FROM uudis WHERE title LIKE '%".$_POST["search_str"]."%' AND liik=1 OR liik=3 ORDER BY lupdate DESC";
	$result=mysql_query($query);
//esimene tabeli rida annab kategooria nime ...	
	?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">	 
 	       <tr> 
		   <td colspan="3" valign="middle"><img border=0 src="image/spacer.gif" width="10" height="20"><span class="menu_punane">Teised uudised </span></td>
	       
	       <td width="7%" valign="middle"></td>
		   <td width="10%" nowrap class="smallbody">		     </td>
	       </tr>
<?
		

		while($line=mysql_fetch_array($result)){
/*			if(($line["kategooria_id"]==10 or $line["kategooria_id1"]=='10') and ($line["kategooria_id"]!=6 or $line["kategooria_id1"]!=6))
			{
				$ch = $line["perenimi"];
				$ch = strtolower($ch);
				$userna = strtolower($line["eesnimi"])."_".$ch{0};
				$pa = strtolower($line["eesnimi"])."5".$ch{0};
			}
*/			?>
	        <tr background="images/sinine.gif"> 
          	<td colspan="5" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td width="8%"><img src="image/spacer.gif" width="30" height="10"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></td>
	       <td  width="72%" class="menu" nowrap><a href="index.php?page=uudis_disp&uid=<? echo $line["id"]; ?>"><? echo $line["title"];?></a></td>
	       <td  width="3%" class="menu" nowrap><? echo $line["show_page"]; ?></td>
	       <td valign="middle"><? if($priv>=2) {?><img  align="middle" src="image/index_39.gif"><? } ?></td>
		   <td nowrap class="smallbody"><? if($priv>=2) {?><a href="index.php?page=uudis_table&action=del&uid=<? echo $line["id"]; ?>">kustuta</a><? } ?>		     </td>
	       </tr>
	<?
	
	
	}	
  ?>
     </table>

