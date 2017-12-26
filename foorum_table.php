<link href="scat.css" rel="stylesheet" type="text/css" />

	
<?php
// Initialize some variables (why?)
$priv = 2;
$action = isset($_GET['action']) ? $_GET['action'] : NULL;
$sel = isset($_GET['sel']) ? $_GET['sel'] : NULL;
$veeb = isset($_GET['veeb']) ? $_GET['veeb'] : NULL; // parameeter käseb allpool konverteerida teatud sorts pilte veebiformaati
?>
<br>	
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
	<td colspan="7"><?
		include 'globals.php';
		include("textlog_class.php");
	
?></td>
  </tr>

<tr> 
	<td width="3%" align="center" valign="top" background="image/sinine.gif" class="menu">
		<div align="center"><img src="image/motik_expdemo.gif" width="19" height="25" border="0"></div>
	</td>
	<td width="30%" valign="middle" background="image/sinine.gif" class="menu">
		<img src="image/spacer.gif" width="8" height="8">
		Üldised teated, info reiside ja busside kohta.
	</td>
	<td width="3%" background="image/sinine.gif" class="menu">&nbsp;</td>
	<td colspan="4" background="image/sinine.gif" class="menu">
		Eksperimentide arenduste logi...</td>
  </tr>
<tr> 
	<td colspan="2" valign="top"> 
<?php
	$tmp = array('date', 'body', 'valislink');
	log2("foorum_alog",(isset($_GET["foorum_alogopen"])?0:5),0,$_SESSION["mysession"]["login"],implode(",",$tmp));
?>
	</td>
	<td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0">
   <tr>
     <td colspan="2" background="image/sinine.gif" class="options">Nimi</td>
     <td background="image/sinine.gif" class="options">Foorum/Arendus</td>
   </tr>
<?
// vanad asjad üles:

/*		$query_exp1="SELECT * FROM exparendus ORDER BY id DESC LIMIT 90";
		$result_exp1=mysql_query($query_exp1);
		while($line_exp1=mysql_fetch_array($result_exp1))
		{
			$query_exp2="UPDATE exp set staatus_id=1 WHERE id=".$line_exp1["oid"]." LIMIT 1";
			//echo $query_exp2;
		$result_exp2=mysql_query($query_exp2);
		}
*/


	$query="SELECT * FROM exp WHERE staatus_id=1 ORDER BY nimi_est";
	$result=mysql_query($query);
	
	while($line=mysql_fetch_array($result))
	{
		$query_exp="SELECT * FROM exparendus WHERE oid=".$line["id"]." ORDER BY id DESC LIMIT 15";
		$result_exp=mysql_query($query_exp);
		$line_exp=mysql_fetch_array($result_exp);
		//echo $query_exp;
?> 
    <tr>
    <td width="35%" valign="top" class="options"><a href="http://www.fyysika.ee/omad/index.php?page=exp_disp&expid=<? 	echo $line["id"];?>" target="_blank">
      <? 	echo $line["nimi_est"];?></a>
<?php
	$query2="SELECT eesnimi,perenimi FROM isik WHERE id=".$line_exp["user_id"];
	$result2=mysql_query($query2);
	// HACK: this is a quick hack to get rid of an warning when the query does not succeed.
	// More thought is necessary about what to do when it fails.
	$line2= $result2 ? mysql_fetch_array($result2) : NULL;
?>
    <br />    <br />
     </td>
    <td width="10%" align="center" valign="top" class="options"><? if($line["veeb_pilt_url"]) {?>
      <a href="<? echo urldecode($line["veeb_pilt_url_s"]); ?>"><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" width="40" border="0" /></a>
      <? } ?></td>
    <td width="55%" valign="top" class="options">
	
	<? 
	
	if($line_exp)
	{
	echo $line_exp["date"]; ?> ( <? echo $line2["eesnimi"];?> <? echo $line2["perenimi"];?> ) <br>      <? echo $line_exp["body"];
	
	} 
	?></td>
  </tr><tr>
									<td colspan="3" background="image/sinine.gif"><img height="1" width="1" src="image/sinine.gif" /></td>
			  </tr>
<?
	
	}
	
	
	 ?>
 </table></td>
</tr>

</table>

</p>
