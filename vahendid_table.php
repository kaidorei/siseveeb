<link href="scat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ahaa.js"></script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<?	
	include("globals.php");
	require_once 'header.php';

	$action=$_GET["action"];
	$sel=$_GET["sel"];
	$projekt=$_GET["projekt"];
//	echo $projekt;
	$ord=$_GET["ord"];
	if($ord==NULL) $ord="nimi_est";
	if($action=="del"){
		$vid=$_GET["vid"];
		$tables=array('vahendid_lingid');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$vid;
			$r=mysql_query($q);
			}
			$q="DELETE FROM vahendid WHERE id=".$vid;
			$r=mysql_query($q);
	}
	
// kui on tehtud valik tegevusala j'rgi .. 
	switch($projekt)
	{
		case "teadusbuss": $str1 = " AND on_tb = 1"; break;
		case "globe": $str1 = " AND on_globe = 1"; break;
		case "opikojad": $str1 = " AND on_opikojad = 1"; break;
		case "tooriist": $str1 = " AND on_tooriist = 1"; break;
		case "keemia": $str1 = " AND on_keemia = 1"; break;
		case "koik": $str1 = ""; break;
		default: break;
	}
	 
	$query="SELECT * FROM vahendid WHERE nimi_est LIKE '%".$_POST["search_str"]."%'".$str1." ORDER BY ".$ord;
	$result=mysql_query($query);
//	echo $query;
?>


<?
			if($projekt)
			{ ?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
    	<td width="2%">&nbsp;</td>
    	<td width="3%">&nbsp;</td>

        <td width="33">  </td>  <td align="center" valign="middle" class="menu" width="3%"> 
     </td>
<td width="0%"><a href="index.php?page=vahendid_table&ord=nimi_est&sel=<? echo $sel?>  " class="menu">Nimi</a></td>
        <td  width="65%" nowrap class="menu"><a href="index.php?page=vahendid_table&ord=kood&sel=<? echo $sel?>">Kood</a></td>
        <td  width="1%" nowrap class="menu">Kogus(vana s&uuml;st)</td>
        <td  width="2%" nowrap class="menu">Kogus</td>
        <td  width="6%" nowrap class="menu">Laos</td>

		<td  width="6%" nowrap class="menu style1"></td>
		<td width="5%" valign="middle"></td>

    	<td width="7%" nowrap class="smallbody"></td>
        </tr>
<?	while($line=mysql_fetch_array($result)){ ?>
        <tr background="image/sinine.gif"> 
          <td colspan="12" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
    	<td width="2%"><?php if ($line["on_tooriist"]!=1) {?><img border=0 src="image/index_41.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"><?php }else{  ?><img src="image/tools.jpg" alt="tööriist" /><?php }?></td>

        <td width="3%" bordercolor="1"><?php if ($line["netipood_url"]!="ise") {?><img border=0 src="image/spacer.gif" width="10" height="10"><?php }else{  ?><img src="image/copyright_symbol_v.jpg" alt="tööriist" width="20" height="20" /><?php }?></td>
        <td align="center" valign="middle" class="menu" width="3%"> 
      <? 
	switch ($line["staatus_id"])
	{
	case 1: ?>
<img src="image/spacer.gif" width="23" height="10">      <? break;
	case 2: ?>
<img border=0 alt="Osta, on müügis" src="image/motik_osta.gif" width=33 height=15 >      <? break;
	case 3: ?>
      <img border=0 alt="reg" src="image/motik_rikkis.gif" width=23 height=15 ><? break;
	}
	?>
    </td>
<td width="0%"></td>
        <td  width="4%" class="menu" nowrap><a href="index.php?page=vahendid_disp&vid=<? echo $line["id"]; ?>"><? echo $line["nimi_est"]; ?></a></td>

		<td  width="3%" nowrap class="menu style1"><? echo $line["kood"]; ?></td>
		<td  width="1%" nowrap class="ekraan_link" align="center"><? echo $line["kogus"]; ?></td>
		<td  width="2%" nowrap class="ekraan_link" align="center">&nbsp;</td>
		<td  width="6%" nowrap class="menu_punane" align="center"><? 	 
		$lineee=sql_val($login_id, "SELECT sum(mitu) FROM kool_vahendid WHERE oid2=".$line["id"], 0, 0);
		echo $line["kogus"] - $lineee[0];
?></td>
		<td width="5%" valign="middle"><? if($line["veeb_pilt_url"]) {?><a href=<? echo urldecode($line["veeb_pilt_url_s"]); ?> target=_blank><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" width="80" border="0" /></a><? } else { ?><img src="../images/spacer.gif"  width="40"/><? }?></td>

    	<td width="7%" nowrap class="smallbody"><? if($priv>=2) {?>
		
<a onclick='javascript:kysi("index.php?page=vahendid_table&action=del&ord=<? echo $ord; ?>&vid=<? echo $line["id"]; ?>","Oled päris kindel, et soovid selle kirje kustutada?")' class="button2">x</a>
		
		
		<? } ?></td>
        </tr>
<?
}
?>      </table>

<p>
  <? } else {?>

</p>
<p class="options">Vali &uuml;lemisest men&uuml;&uuml;ribast
  
projekt, k&otilde;igi vahendite n&auml;itamine v&otilde;i otsi vahendeid nime j&auml;rgi.</p>
<p class="options"><input type="button" class="button3" value="LOE RIBAKOOD" onClick="window.open('setribakood.php','Delete','toolbar=0,width=600,height=480,status=no')" ></p>
<? }

//phpinfo();