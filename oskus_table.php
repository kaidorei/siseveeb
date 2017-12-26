<link href="scat.css" rel="stylesheet" type="text/css" />

<? 	
	mb_internal_encoding('UTF-8');
	$action=$_GET["action"];
	$klass=$_GET["klass"];
	$sel=$_GET["sel"];
	$osid=$_GET["osid"];
	$kat=$_GET["kat"];
	$veeb=$_GET["veeb"]; // parameeter k'eseb allpool konverteerida teatud sorts pilte veebiformaati
	$ord=$_GET["ord"];
	if($ord==NULL) {$ord="nimi";} 
	if($ord=="lupdate") {$ord = $ord." DESC";}	

?>
<?
//SQL rida ...
//mysql_query("UPDATE exp SET jarjest=jarjest-380;");


	if($action=="del")
	{
		$q="DELETE FROM oskus WHERE id=".$osid;
		$r=mysql_query($q);
	}

// otsing stringi jarele ...
		$str='';
	
	$query="SELECT * FROM oskus WHERE nimi_est LIKE '%".$_POST["search_str"]."%'".$str." ORDER BY id";

	
//	echo $query;
	$result=mysql_query($query);
	include("globals.php");

?><table width="100%" border="0">
  <tr>
    <td width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="13%" align="center">&nbsp;</td>
    <td width="80%" align="center" class="navi"> <img src="image/spacer.gif" width="10" height="5"><span class="menu"><a href="index.php?page=exp_table&ord=nimi_est&kat=<? echo $kat;?>">Nimi</a></span></td>
    <?	$osid = $line["id"];
?>
    <td width="7%" colspan="2" align="center" valign="middle">&nbsp;</td>
    </tr>
  <?

	while($line=mysql_fetch_array($result))
	{
					?>
      
      <tr> 
        <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
      <tr> 
        <td colspan="2" class="navi"><? echo $line["oskus_est"];?> (<a href="index.php?page=oskus_disp&osid=<? echo $line["id"]; ?>" target="_blank">edit</a>)<? 
		
		
		
				$query_vahh="SELECT * FROM raamatX_oskus WHERE oid2=".$line["id"]."";
				//echo $query_vahh;
				$result_vahh=mysql_query($query_vahh);
				$count_row=0;
				while($line_vahh=mysql_fetch_array($result_vahh))
				{
					$query_vahh1="SELECT * FROM raamatX WHERE id=".$line_vahh["oid1"];
					$result_vahh1=mysql_query($query_vahh1);
					$line_vahh1=mysql_fetch_array($result_vahh1);
					echo $line_vahh1["nimi_est"]." ".$line_vahh1["pid"];
					if($line_vahh1["pid"]<2) echo "MIISSS";
				}
		
		
		
		?></td>
        <td valign="top" nowrap class="smallbody">&nbsp;<? if($priv>=2) {?>
          <div align="right"><a href="index.php?page=oskus_table&action=del&kat=<? echo $kat; ?>&osid=<? echo $line["id"]; ?>" class="menu_punane">x</a> 
          <?		
	$id_prev = $line["id"];
		 } ?></div></td>
        </tr>
  <?
}	
?>
</table></td>
  </tr>
</table>

 

