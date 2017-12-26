<link href="scat.css" rel="stylesheet" type="text/css" />
<br>
<? 
	$action=$_GET["action"];
	$klass=$_GET["klass"];
	$sel=$_GET["sel"];

?><script>
function muuda_liik(poid_id)
{
	var mylist=document.getElementById("list_liik_" + poid_id).value;
//	document.getElementById("favorite").value=poid_id + " ja " + mylist;
	  
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	
	
//	xmlhttp.open("POST","demo_post.asp",true);
//	xmlhttp.send();

	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("favorite").value=xmlhttp.responseText;
		}
		
	  }
	
	xmlhttp.open("GET","poid_table_asp.php?poid="+poid_id+"&liik="+mylist,true);
	xmlhttp.send();	//mylist.options[mylist.selectedIndex].text;

}
</script>
<?
//SQL rida ...
//mysql_query("UPDATE exp SET jarjest=jarjest-380;");


	if($action=="del")
	{
		$poid=$_GET["poid"];
		$mediadirs=array("poid_pildid","poid_doclist","poid_kasutusjuhend","poid_skeem");
		foreach($mediadirs as $tmp)
		{
			$dd="media/".$tmp;
			$q="SELECT url FROM ".$tmp." WHERE oid=".$poid;
//			echo $q;
			$r=mysql_query($q);
			while($line=mysql_fetch_array($r)){
				unlink(urldecode($line["url"]));  
				}	
		}				
		$tables=array('poid_lingid','poid_analoogid');
		
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$poid;
			$r=mysql_query($q);
		}

		$tables=array('poid_naitused','poid_jnaitused','exparendus','poid_doclist','poid_pildid','poid_kasutusjuhend','poid_mudel','poid_naitused','poid_skeem','poid_vestlus');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE poid=".$poid;
			$r=mysql_query($q);
		}

		$q="DELETE FROM pohivara WHERE id=".$poid;
		$r=mysql_query($q);
	}

// otsing stringi jarele ...
		$str='';
// kui on tehtud valik staatuse j'rgi .. 
	if($sel!=NULL) 
	{
		$str1 = " AND staatus_id =".$sel;
//	echo $str1;
	}
	else
	{	
		$str1='';
	}
// kui on tehtud valik demolisuse j'rgi .. 
	if($kat!=NULL) 
	{
		$str2 = " AND gpid_demo =".$kat;
	}
	else
	{	
		$str2='';
	}
	
	
	
	$query="SELECT * FROM pohivara WHERE nimi_est LIKE '%".$_POST["search_str"]."%'".$str." ".$str1." ".$str2." ORDER BY nimi_est";

	
	
//	echo $query;
	$result=mysql_query($query);
	include("globals.php");



?>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td align="center">&nbsp;</td>
  <td align="left" class="navi">&nbsp;</td>
  <td colspan="11" align="center" class="navi">õppekava</td>
  <td align="center" nowrap class="menu">&nbsp;</td>
  <td align="center" nowrap class="smallbody">&nbsp;</td>
</tr>
<tr> 
    <td width="3%" align="center">&nbsp;</td>
    <td width="40%" align="left" class="navi"> <img src="image/spacer.gif" width="10" height="5"><span class="menu">Sõna</span></td>
    <td width="1%" align="left" class="navi">pk_vl</td>
    <td width="1%" align="left" class="navi">pk_m</td>
    <td width="1%" align="left" class="navi">pk_e</td>
    <td width="1%" align="left" class="navi">pk_s</td>
    <td width="1%" align="left" class="navi">g1</td>
    <td width="1%" align="left" class="navi">g2</td>
    <td width="1%" align="left" class="navi">g3</td>
    <td width="1%" align="left" class="navi">g4</td>
    <td width="1%" align="left" class="navi">g5</td>
    <td width="0%" align="left" class="navi">gv1</td>
    <td width="1%" align="left" class="navi">gv2</td>
  <td width="17%" align="center" nowrap class="menu">P&otilde;hivara?</td>
	  <?
	$query1="SELECT kaanepilt_vaike,id FROM raamat WHERE naita_veebis=1 ORDER BY id ASC";
	$result1=mysql_query($query1);
	if ($result1 == TRUE){
		while($fetch=mysql_fetch_array($result1)) {
			if($fetch[1]==14) $op="&op=1,5,11,16,20,24,28,32"; else $op="";
			if($fetch[1]==15) $op="&op=1,2,3,4,7,10,17,22,26,31,36"; else $op="";
			echo "\n<td><a href=\"index.php?page=exp_tree",$op,"&klass=raamat".
			$fetch[1]."\"><img src=\"/koolitarkus/".$fetch[0]."\" height=\"39\" width=\"27\" hspace=\"1\" border=\"0\" /></a></td>";
		}
	}
		?>
    <td width="8%" align="center" nowrap class="smallbody">x</td>
  </tr><?

	while($line=mysql_fetch_array($result))
	{
			// loeme kokku vastava id/ga vestluste kirjed poid_vestlus andmebaasis ...
					$query="SELECT COUNT( * ) FROM exparendus WHERE oid=".$line["id"]." ";
					$result1=mysql_query($query);
					$count=mysql_fetch_array($result1);
			//		echo $count[0];
					?>
			
  <tr> 
    <td colspan="21" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
    <td width="3%"><a href="http://et.wikipedia.org/wiki/<? echo $line["nimi_est"];?>" target="_blank"><img src="image/Wikipedia-icon.png" alt="Wiki" width="15" height="15" border="0" /></a>    </td>
    <td width="40%" nowrap class="menu"><a href="index.php?page=pohivara_disp&poid=<? echo $line["id"]; ?>&pw=<? echo $pw; ?>" target="_blank"><? echo $line["nimi_est"];?> 
      </a></td>
    <td width="1%" nowrap class="menu"><? echo $line["11"];?></td>
    <td width="1%" nowrap class="menu"><? echo $line["10"];?></td>
    <td width="1%" nowrap class="menu"><? echo $line["9"];?></td>
    <td width="1%" nowrap class="menu"><? echo $line["8"];?></td>
    <td width="1%" nowrap class="menu"><? echo $line["7"];?></td>
    <td width="1%" nowrap class="menu"><? echo $line["6"];?></td>
    <td width="1%" nowrap class="menu"><? echo $line["5"];?></td>
    <td width="1%" nowrap class="menu"><? echo $line["4"];?></td>
    <td width="1%" nowrap class="menu"><? echo $line["3"];?></td>
    <td width="0%" nowrap class="menu"><? echo $line["2"];?></td>
    <td width="1%" nowrap class="menu"><? echo $line["1"];?></td>
    <td width="17%" align="center" nowrap class="menu"><select id="list_demo_rate" onchange="muuda_demo_rate()"><?
for ($i = 0; $i <= 5; $i++) 
{
	if($i==$line["in_buss"]) { $sel="selected"; } else { $sel="";}
		echo "<option value=\"".$i."\" ".$sel.">".$i."</option>"; 
}?>
      
      </select>
</td>
 
	  <?
	$query1="SELECT kaanepilt_vaike,id FROM raamat WHERE naita_veebis=1 ORDER BY id ASC";
	$result1=mysql_query($query1);
	if ($result1 == TRUE){
		while($fetch=mysql_fetch_array($result1)) {
			echo "\n<td></td>";
		}
	}
?>
     <td width="8%"  align="center"  class="navi">
	<? if($priv>=2) {?>
      <div align="right"><a href="index.php?page=pohivara_table&action=del&poid=<? echo $line["id"]; ?>" class="menu_punane">x</a> 
        <?		
	$id_prev = $line["id"];
		?> </div><? } ?>
      </td>
 </tr>
<?






$counter++;
}	// ------------- peagrupi exponaat -----------
?>
</table>

