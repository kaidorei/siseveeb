<br> 
<?	$action=$_GET["action"];
	$sel=$_GET["sel"];
	$ord=$_GET["ord"];
	$pw=$_GET["pw"];
	if($action=="del"){
		$toolid=$_GET["toolid"];
		$q="DELETE FROM tooleht WHERE id=".$toolid;
		$r=mysql_query($q);
	}
	
// kui ei ole tehtud valikut staatuse  järgi .. 
	if($sel==NULL) $sel=0;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td class="menu">&nbsp;</td>
    <td colspan="2" class="menu"><div align="center">staatus</div></td>
    <td width="9%" nowrap class="menu"><div align="center"><a href="index.php?page=kool_table&ord=nimi&sel=<? echo $sel?>">nmbr</a></div></td>
    <td nowrap class="menu"><div align="center"><a href="index.php?page=kool_table&ord=maakond&sel=<? echo $sel?>">isik</a></div></td>
    <td nowrap class="menu"><div align="center">algus</div></td>
    <td nowrap class="menu"><div align="center">l&otilde;pp</div></td>
    <td nowrap class="menu"><div align="center">mille eest</div></td>
    <td nowrap class="menu"><div align="center">summa</div></td>
    <td valign="middle"><div align="center"></div></td>
    <td nowrap class="smallbody"><div align="center"></div></td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="11" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <?
	$query="SELECT nmbr,id, algus, lopp, tegevus,summa, isik_id,staatus FROM tooleht WHERE nmbr LIKE '%".$_POST["search_str"]."%'".$str1." ORDER BY nmbr";
//	echo $query;
	$result=mysql_query($query);
//WHILE ALGAB--------------------------------------------------------------------------------------------------------------------------
	while($line=mysql_fetch_array($result)){
		// kui on tehtud valik saatude järele ...
		$state = 0;

	// Kui on valitud "sel", siis näitame vaid neid koole, mis vastavad määratlusele ...

		if($sel==0||$state==$sel)
		{
		 ?>
  <tr> 
    <td align="center" valign="middle" class="menu" width="3%"><div align="left"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"> 
      </div></td>
    <td align="center" valign="middle" class="menu" width="2%"> 
      <? 
			switch ($line["staatus"])
			{
			case 0: ?>
      <img border=0 alt="Leping allkirjastamata, raha saamata" src="image/rolleyes.gif" width=15 height=15 > 
      <? break;
			case 1: ?>
      <img border=0 alt="Leping allkirjastamata, raha käes" src="image/motik_idee.gif" width=19 height=25 > 
      <? break;
			case 2: ?>
      <img border=0 alt="Leping allkirjastatud, raha saamata" src="image/mad.gif" width=15 height=15 > 
      <? break;
			case 3: ?>
      <img border=0 alt="Leping allkirjastatud, raha kaes" src="image/motik_osta.gif" width=33 height=15 > 
      <? break;
			}
			$query3="SELECT eesnimi, perenimi, password, id FROM isik WHERE id=".$line["isik_id"];
			$result3=mysql_query($query3);
			$m=mysql_fetch_array($result3);
			?>
    </td>
    <td align="center" valign="middle" class="menu" width="4%">&nbsp;</td>
    <td nowrap class="menu"><div align="center"> 
        <? if($pw==$m["password"] or $priv>=2) {?>
        <a href="index.php?page=tool_disp&toolid=<? echo $line["id"]; ?>"> 
        <? }?>
        <? echo $line["nmbr"]; ?>
        <? if($pw==$m["password"] or $priv>=2) {?>
        </a> 
        <? }?>
      </div></td>
    <td  width="23%" class="menu" nowrap> 
      <?
			
			 ?>
      <div align="center"><a href="index.php?page=isik_disp&iid=<? echo $m["id"]; ?>&pw=<? echo $pw;?>&liik=<? echo $liik;?>"><? echo $m["eesnimi"], " ", $m["perenimi"];?></a></div></td>
    <td   class="menu" nowrap> <div align="center"><? echo $line["algus"];?></div></td>
    <td   class="menu" nowrap> <div align="center"><? echo $line["lopp"];?></div></td>
    <?
			$query3="SELECT nimi FROM tooleht_liik WHERE id=".$line["tegevus"];
			$result3=mysql_query($query3);
			$m=mysql_fetch_array($result3);
			?>
    <td   class="menu" nowrap> <div align="center"> <? echo $m["nimi"];?></div></td>
    <td   class="menu" nowrap>
      <div align="center"><? echo $line["summa"];?></div></td>
    <td width="4%" valign="middle"  class="smallbody"> 
<? if($priv>=2) {?>      
      <a href="index.php?page=tool_table&action=del&toolid=<? echo $line["id"]; ?>">kustuta</a> 
      <? } ?>
    </td>
    <td width="10%" align="right" nowrap class="smallbody"> 
      <? // if($priv>=2)
			  {
			  ?>
      <img  align="middle" src="image/index_39.gif"> 
      <? } ?>
    </td>
  </tr>
  <?
		}// end of if
}
?>
</table>
