<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<p><br>
  <?
	$priv=2;
	$action=$_GET["action"];
	$sel=$_GET["sel"];
	$veeb=$_GET["veeb"]; // parameeter k'eseb allpool konverteerida teatud sorts pilte veebiformaati
	$query="SELECT nimi,id FROM firma WHERE nimi LIKE '%".$_POST["search_str"]."%'".$str1." ORDER BY nimi";
	$result=mysql_query($query);
	while($line=mysql_fetch_array($result)){
?>
  <span class="style1">NB! NEED TEATED L&Auml;HEVAD OTSE F&Uuml;&Uuml;SIKAPORTAALI </span></p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="6%" align="center" valign="top" background="image/sinine.gif" class="menu">
      <div align="left"><img src="image/motik_expdemo.gif" width="19" height="25"></div></td>
    <td width="94%" valign="middle" background="image/sinine.gif" class="menu"><img src="image/spacer.gif" width="8" height="8">Teated:</td>
  </tr>
  <tr> 
    <td colspan="2" valign="top"> 
      <?
	include("globals.php");
	include("textlog_class.php");
	$tmp=array("date","body");
	log2("foorum_alog",(isset($_GET["foorum_alogopen"])?0:5),0,$_SESSION["mysession"]["login"],implode(",",$tmp));	?>
    </td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif"> 
          <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
    	<td><img src="image/spacer.gif" width="30" height="10"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></td>

        <td  width="100%" class="menu" nowrap><a href="index.php?page=firma_disp&fid=<? echo $line["id"]; ?>"><? echo $line["nimi"]; ?></a></td>

		<td valign="middle"><? if($priv>=2) {?><img  align="middle" src="image/index_39.gif"><? } ?></td>

    	<td nowrap class="smallbody"><? if($priv>=2) {?><a href="index.php?page=firma_table&action=del&fid=<? echo $line["id"]; ?>">kustuta</a><? } ?></td>

        </tr>
      </table>
