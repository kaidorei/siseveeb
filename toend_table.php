<link href="scat.css" rel="stylesheet" type="text/css" />
<br> 
<?	$action=$_GET["action"];
	$ord=$_GET["ord"];
	$pw=$_GET["pw"];
	if($action=="del"){
		$aid=$_GET["tid"];
		$q="DELETE FROM toend WHERE id=".$tid;
		$r=mysql_query($q);
	}

?> <a href="cert.php" target="_blank">saatmine</a>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td class="menu">&nbsp;</td>
    <td colspan="2" class="menu"><div align="center">staatus</div></td>
    <td width="10%" nowrap class="menu"><div align="center"><a href="index.php?page=arve_table&ord=nmbr">nmbr</a></div></td>
    <td nowrap class="menu"><div align="center"><a href="index.php?page=arve_table&ord=kool_id">Kellele</a></div></td>
    <td width="18%" nowrap class="menu"><div align="center">&Uuml;ritus</div></td>
    <td width="11%" nowrap class="menu"><div align="center">Kuup&auml;ev</div></td>
    <td width="10%" nowrap class="menu"><div align="center">e-mail</div></td>
    <td valign="middle"><div align="center"></div></td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="10" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <?
	$query="SELECT * FROM toend ORDER BY id DESC LIMIT 250";
//	echo $query;
	$result=mysql_query($query);
//WHILE ALGAB--------------------------------------------------------------------------------------------------------------------------
	while($line=mysql_fetch_array($result)){
		// kui on tehtud valik saatude j�rele ...
		$state = 0;

	// Kui on valitud "sel", siis n�itame vaid neid koole, mis vastavad m��ratlusele ...

		 ?>
  <tr> 
    <td align="center" valign="middle" class="menu" width="4%"><div align="left"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"> 
    </div></td>
    <td align="center" valign="middle" class="menu" width="3%"> 
      <? 
			switch ($line["staatus"])
			{
			case 0: ?>
      <img border=0 alt="Arve on saatmata" src="image/rolleyes.gif" width=15 height=15 > 
      <? break;
			case 1: ?>
      <img border=0 alt="Arve on saadetud" src="image/motik_idee.gif" width=19 height=25 > 
      <? break;
			}
			$query3="SELECT eesnimi, perenimi, password, id FROM isik WHERE id=".$line["isik_id"];
			$result3=mysql_query($query3);
			$m=mysql_fetch_array($result3);
			?>    </td>
    <td align="center" valign="middle" class="menu" width="5%">&nbsp;</td>
    <td nowrap class="menu"><div align="center"> 
        <a href="index.php?page=arve_disp&aid=<? echo $line["id"]; ?>"> 
        <? echo $line["nmbr"]; ?>
        </a> 
     </div></td>
    <td  width="24%" class="menu"><div align="left"><a href="index.php?page=kool_disp&fid=<? echo $line["kool_id"]; ?>">
      <? 	
	
	
	$query2="SELECT nimi FROM kool WHERE id=". $line["kool_id"];
	$result2=mysql_query($query2);
	$line_kool=mysql_fetch_array($result2); echo $line_kool['nimi'];
?>
    </a></div></td>
    <td   class="menu"> <div align="left"><? echo $line["maksja_nimi"];?></div></td>
    <td   class="menu" nowrap> <div align="center"><? echo $line["date"];?></div></td>
    <td   class="menu" nowrap> <div align="center"> <? echo $line["maksetahtaeg"];?></div></td>
    <td width="3%" valign="middle"  class="smallbody"> 
      <? if($priv>=2) {?>      
      <a href="index.php?page=arve_table&action=del&aid=<? echo $line["id"]; ?>" class="menu_punane">x</a> 
      <? } ?>    </td>
  </tr>
  <?
		}// end of if
?>
</table><? echo $kassa;?>
