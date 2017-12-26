<?
require_once 'header.php';
$ribakood = intval($_GET['ribakood']);

$query ="SELECT * FROM vahendidtykid WHERE serial=".$ribakood;
$result = $db->query($query);


?>
<link href="scat.css" rel="stylesheet" type="text/css" />
 <table width="100%" border="0">
  <tr>
    <td bgcolor="#FFFFCC" class="navi">Isendid</td>
    <td bgcolor="#FFFFCC" class="navi">Nimi</td>
    <td bgcolor="#FFFFCC">&nbsp;</td>
  </tr>
  <tr>
    <td width="43%" valign="top" class="options"><? 
	
	if($row = $result->fetch_assoc()) {echo $row["id"]; } else {echo "Ribakood ".$ribakood." - ei ole sellist kirjet.";}?></td>
    <td width="47%" valign="top" class="options"><? 
	
	if($row = $result->fetch_assoc()) 
	{
		
		$query_1 ="SELECT * FROM vahendid WHERE id=".$row["id"];
		$result_1 = $db->query($query_1);
		$row_vahend = $result_1->fetch_assoc();	
		echo $row_vahend["nimi_est"]; 
		
	} 
?></td>
    <td width="10%"><? if ($row["veeb_pilt_url"]) {?>  <img border="0" src="<? echo urldecode($row["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"><? } ?></td>
  </tr>
</table>
