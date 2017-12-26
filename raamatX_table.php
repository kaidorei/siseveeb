<script type="text/javascript" src="ahaa.js"></script>
<?
	$action=$_GET["action"];
	$pid=$_GET["pid"];
	if(!$baas=$_GET["baas"]) $baas = "raamatX";
	if(!$pid=$_GET["pid"]) $pid = 2;
	
	if($action=="del"){
		$aid=$_GET["aid"];
			$q="UPDATE raamatX SET deleted=1 WHERE id=".$aid;
			$r=mysql_query($q);
	}
	
	$query="SELECT id,book_id,nimi_est FROM ".$baas." WHERE deleted=0  AND pid=".$pid." ORDER BY id";
//	echo $query;
	$result=mysql_query($query);
	?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif">          
  		<td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1">
 		</td>
       	</tr>
		<?
		
		while($line=mysql_fetch_array($result)){
			?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="image/sinine.gif"> 
    <td colspan="6" height="1" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
    <td width="10" valign="top"><img border=0 src="image/index_41.gif" width=19 height=19 alt=""></td>
    <td width="30" class="navi" valign="top"><? echo $line["id"]; ?></td>
    <td  width="300" valign="top" nowrap class="menu"><a href="index.php?page=raamatX_disp&aid=<? echo $line["id"]; ?>&klass=<? echo $baas;?>" target="_blank"><? echo $line["nimi_est"]?></a> <? if($pid==1){echo $line["tekst"];}?>
    </td>
    <td  width="100" valign="top" nowrap class="menu"> <? echo $line["book_id"]?>
    </td>
    <td width="30" nowrap class="smallbody"> 
      <?  if($priv>=9) {?>
      <div align="right"><a onclick='javascript:kysi("index.php?page=raamatX_table&action=del&aid=<? echo $line["id"]; ?>","Oled p&atilde;ris kindel, et soovid kustutada kirje <? echo $line["nimi_est"];?>?")' class="button2">x</a>  
        <? } ?>
      </div></td>
  </tr>
</table>
	<?
	$id_prev = $line["id"];
	}	// ------------- peagrupi exponaat -----------
?>

