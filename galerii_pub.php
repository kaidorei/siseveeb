<?php
include("connect.php");
include("globals.php");
	$suurelt=$_GET["suurelt"];
	$reisid=$_GET["id"];
$query="SELECT nimi, galerii FROM reis WHERE id=".$reisid;
//echo $query;
$result=mysql_query($query);
$line=mysql_fetch_array($result);
 
 
 
$imgdir="../pildid/Image/Teadusbuss/".$line["galerii"]."/thumbs/";

$lst=list_dir($imgdir);
sort($lst);
count($lst);
$result_pilt=mysql_query("SELECT * FROM pildid_allkirjad WHERE fail='".$img."'");
$line_pilt=mysql_fetch_array($result_pilt);

if(!$suurelt)
{ 



?>
<link href="http://www.fyysika.ee/omad/scat.css" rel="stylesheet" type="text/css" />

 <span class="suurpealkiri">Pildigalerii: <?php echo $line["nimi"]; ?></span>
 <table width="540" border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr bordercolor="#CCCCCC" bgcolor="#FFFFFF">
<?php 	
$count=1;
$count2=1;
foreach($lst as $img)
	{
?>    <td align="center"  width="100" valign="top" class="smallnews"> <a href="<? $PHP_SELF ?>?reisid=<? echo $reisid;?>&suurelt=<? echo $count2;?>"><img src="../pildid/Image/Teadusbuss/<? echo $line["galerii"],"/thumbs/", $img; ?>" border="0"></a> </td>
<?php $count++; $count2++; if($count==5){$count=1; echo "<tr></tr>";}}?></tr>
</table>
<?php }else{?><!--<font size="+3" face="Arial, Helvetica, sans-serif">{$galeriipildid[$suurelt].title} </font>--> 

<table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bordercolor="#CCCCCC" bgcolor="#FFFFFF"> 
    <td colspan="3" align="center" valign="top" > <p align="justify" class="suurpealkiri">Pildigalerii: <?php echo $line["nimi"]; ?></p></td>
  </tr>
  <tr bordercolor="#CCCCCC" bgcolor="#FFFFFF">
  <?php 
  if($suurelt < count($lst)) {$jargmine=$suurelt+1;} else {$jargmine=$suurelt;};
  $eelmine=$suurelt-1;
  
  ?>
    <td colspan="2" align="center" valign="top" ><div align="left"><a href="<? $PHP_SELF ?>?reisid=<? echo $reisid;?>&suurelt=<? echo  $eelmine;?>" class="smallnews">&lt;-eelmine</a></div></td>
    <td width="141" align="center" valign="top" ><div align="right"><?php if($suurelt < count($lst)) {?><a href="<? $PHP_SELF ?>?reisid=<? echo $reisid;?>&suurelt=<? echo $jargmine;?>" class="smallnews">j&auml;rgmine-&gt;</a><?php } else  { echo "lõpp...";}?></div></td>
  </tr>
  
  <tr>
    <td colspan="3" align="center" valign="top"><div align="justify"> 
        <p align="center"><img border="0" src="../pildid/Image/Teadusbuss/<? echo $line["galerii"],"/thumbs_s/", $lst[$suurelt-1]; ?>" alt="Veebipilt puudub" name="veeb_pilt_url" /></p>
        </div></td>
  </tr>
  <tr>
    <td width="21" align="center"><div align="left"><img src="../omad/image/copyright_symbol_v.jpg" alt="copy" width="20" height="20" border="0" /></div></td>
    <td width="368" align="center"><div align="left" class="options">&nbsp;FYYSIKA.EE</div></td>
    <td align="center" valign="top"><div align="right"><a href="<? $PHP_SELF ?>?reisid=<? echo $reisid;?>" class="smallnews">Albumi&nbsp;algusesse</a></div></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top"><!--<div align="left">
      <p class="smallnews">Loe edasi:</p>
      <p class="smallnews">Vaata eksperimente:  </p>
    </div>--></td>
  </tr>
</table>
<?php }
?>
<?

/********* FUNCTIONNS *****************************************/

function list_dir($dirname)
{
	static $result_array=array();  
	$handle=opendir($dirname);
//	echo  $handle;
	while ($file = readdir($handle))
	{
		if($file=='.'||$file=='..')
			continue;
		if(is_dir($dirname.$file))
			list_dir($dirname.$file.'\\'); 
		else
			$result_array[]=$file;
	}	
	closedir($handle);
	return $result_array;

}
?>