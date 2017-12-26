<link href="scat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ahaa.js"></script>
<br>
<?
	$action=$_GET["action"];
	if($action=="del"){
		$uuid=$_GET["uuid"];
		$mediadirs=array("uurimus_pildid");
		$q="DELETE FROM uurimus WHERE id=".$uuid;
		$r=mysql_query($q);
	}

	$query="SELECT * FROM uurimus WHERE nimi_est LIKE '%".$_POST["search_str"]."%' ORDER BY konk_aasta DESC";
	$result=mysql_query($query);
//esimene tabeli rida annab kategooria nime ...	
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">	 
 <?
		while($line=mysql_fetch_array($result)){
			?>
	        <tr background="images/sinine.gif"> 
          	<td colspan="6" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td width="5%"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""></td>
	       
	       <td  width="88%" class="menu" ><a href="index.php?page=uurimus_disp&uuid=<? echo $line["id"]; ?>" target="_blank"><? echo $line["nimi_est"];?></a></td>
	       <td  width="4%" class="menu" nowrap><? echo $line["konk_aasta"];?></td>
		   <td width="3%" nowrap class="smallbody"><a onclick='javascript:kysi("index.php?page=uurimus_table&action=del&uuid=<? echo $line["id"]; ?>","Oled p&atilde;ris kindel, et soovid kustutada kirje <? echo $line["nimi_est"];?>?")' class="button2">x</a>		     </td>
	       </tr>
	<?
	
	
	}	
  ?>
     </table>

