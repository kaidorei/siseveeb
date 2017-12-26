<link href="scat.css" rel="stylesheet" type="text/css" />
<br>
<?
	$action=$_GET["action"];
	if($action=="del"){
		$kid=$_GET["kid"];
		$mediadirs=array("krono_pildid");
		foreach($mediadirs as $tmp){
			$dd="media/".$tmp;
//			echo $dd;
			$q="SELECT url FROM ".$tmp." WHERE oid=".$kid;
//			echo $q;
			$r=mysql_query($q);
			while($line=mysql_fetch_array($r)){
				 unlink(urldecode($line["url"]));  
				}	
			}				
		$tables=array('krono_lingid');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$kid;
			$r=mysql_query($q);
//			echo $q;
		}
		$q="DELETE FROM krono WHERE id=".$kid;
		$r=mysql_query($q);
	}

	$query="SELECT pealkiri,id, aeg, sisu, veeb_pilt_url FROM krono WHERE pealkiri LIKE '%".$_POST["search_str"]."%' ORDER BY aeg ASC";
	$result=mysql_query($query);
//esimene tabeli rida annab kategooria nime ...	
	?><a href="galerii_krono_thumbs.php?kid=510" target="_blank">Galerii</a>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">	 
 <?
		while($line=mysql_fetch_array($result)){
//		$pildinimi=urlencode(sprintf("media/krono_pildid/%s.jpg",$line["veeb_pilt_url"]));
//		$query_t="INSERT INTO krono_pildid (id, oid, url, nimi) VALUES (".$line["id"].", ".$line["id"].", \"".$pildinimi."\", \"pilt\")";
//		$result_t=mysql_query($query_t);
			?>
	        <tr background="images/sinine.gif"> 
          	<td colspan="5" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td width="4%" valign="top"><img src="image/spacer.gif" width="30" height="10"><a href="index.php?page=krono_disp&kid=<? echo $line["id"]; ?>"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""></a><img border=0 src="image/spacer.gif" width="10" height="10"></td>
	       <td  width="2%" valign="top" nowrap class="menu_punane"><? echo $line["aeg"]; ?></td>
	       <td  width="85%" valign="top" class="smallbody"><? echo $line["pealkiri"];?><? //echo $query_t;?></td>
	       <td width="4%" valign="top"><? if($priv>=2) {?><img  align="middle" src="image/index_39.gif"><? } ?></td>
		   <td width="5%" valign="top" nowrap class="smallbody"><? if($priv>=2) {?><a href="index.php?page=krono_table&action=del&kid=<? echo $line["id"]; ?>">kustuta</a><? } ?>		     </td>
	       </tr>
	<?
	
	
	}	
  ?>
     </table>

