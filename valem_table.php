<link href="scat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ahaa.js"></script>
<script>
function muuda_liik(valem_id)
{
	var mylist=document.getElementById("on_pohivara_" + valem_id).value;
//	document.getElementById("favorite").value=exp_id + " ja " + mylist;
	  
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
	
	xmlhttp.open("GET","valem_table_asp.php?valemid="+valem_id+"&liik="+mylist,true);
	xmlhttp.send();	//mylist.options[mylist.selectedIndex].text;

}
</script>
<?	include("globals.php");
	$action=$_GET["action"];
	$sel=$_GET["sel"];
	$ord=$_GET["ord"];
	if($ord==NULL) {$ord="ID";} 
	if($ord=="lupdate") {$ord = $ord." DESC";}	
	
	if($action=="del"){
		$vid=$_GET["vid"];
		$q="DELETE FROM valem WHERE id=".$vid;
		$r=mysql_query($q);
	}
	
	$query="SELECT * FROM valem ORDER BY ".$ord;
//	echo $query;
	$result=mysql_query($query);
	$liik=array(0,1);
//	echo $liik[1];
?><table width="100%" border="0" cellspacing="0" cellpadding="0">	
  <tr background="image/sinine.gif"> 
          <td colspan="6" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr class="menu"> 
    	<td align="center" bgcolor="#FFFF66" class="menu"><a href="index.php?page=valem_table&ord=nimi_est">Nimi</a></td>

        <td align="center" bgcolor="#FFFF66"  >tex</td>
        <td align="center" bgcolor="#FFFF66"  >põhivara?</td>
		<td width="10%" align="center" valign="middle" bgcolor="#FFFF66" >image</td>
		<td width="10%" align="center" valign="middle" bgcolor="#FFFF66" ><a href="index.php?page=valem_table&ord=lupdate">lupdate</a></td>

    	<td width="10%" nowrap bgcolor="#FFFF66" >&nbsp;</td>
        </tr>

<?	while($line=mysql_fetch_array($result)){
?>

        <tr background="image/sinine.gif"> 
          <td colspan="6" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr <? if($line["on_pohivara"]) {?>bgcolor="#99FF66"<? } ?>> 
    	<td align="center" class="menu"><a href="index.php?page=valem_disp&vid=<? echo $line["id"]; ?>" target="_blank"><? echo $line["nimi_est"]; ?></a></td>

        <td  width="45%"  class="navi"><? echo $line["tex"]; ?></td>
        <td  width="13%" align="center"  class="navi">
          
          <select id="on_pohivara_<? echo $line["id"];?>" onchange="muuda_liik('<? echo $line["id"];?>')"><?
for ($i = 0; $i < 2; $i++) 
{
	if($liik[$i]==$line["on_pohivara"]) { $sel="selected"; } else { $sel="";}
		echo "<option value=\"".$liik[$i]."\" ".$sel.">".$liik[$i]."</option>"; 
}?>

</select>
          </td>
		<td width="10%" align="center" valign="middle" class="navi"><img src="media/valem_pildid/<? echo $line["image"]; ?>" /><br />		  <? echo $line["image"]; ?></td>
		<td width="10%" valign="middle" class="navi"><? echo $line["lupdate"]; ?></td>

    	<td width="10%" nowrap class="smallbody"><? if($priv>=8) {?><a onclick='javascript:kysi("index.php?page=valem_table&action=del&vid=<? echo $line["id"]; ?>","Oled p&atilde;ris kindel, et soovid kustutada kirje <? echo $line["nimi"];?>?")' class="button2">x</a><? } ?></td>
        </tr>
      
<?
}
?></table>
