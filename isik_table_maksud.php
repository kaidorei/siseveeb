<link href="scat.css" rel="stylesheet" type="text/css" />

<br>

<?

$count=1;

	

include("connect.php");



require('kas_on_lubatud_siseveebi.php');



include("globals.php");



		$query="SELECT * FROM isik WHERE in_efs=1 ORDER BY eesnimi ";

		$varq = "EFS liikmed";

	

	

	$result=mysql_query($query);

//	echo $query;

//esimene tabeli rida annab kategooria nime ...	

	?>

<span ><a href="http://www.fyysika.ee/omad" class="menu_punane">Tagasi siseveebi</a></span>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr background="image/sinine.gif">          

 		   <td width="2%" class="navi"></td>

	       <td  width="25%" class="menu" nowrap></td>

           <td  width="4%" class="menu" nowrap></td>

           <td  width="70" class="menu" nowrap align="center">2005<br />

             Maksnud: <? $value = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM  `isik` WHERE maks2005>0")); echo  $value[0];?><br />

             Kokku: <? $value = mysql_fetch_array(mysql_query("SELECT SUM( maks2005 ) FROM  `isik`")); echo  $value[0];?>kr </td>

           <td  width="70" class="menu" nowrap align="center">2006<br />

             Maksnud: <? $value = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM  `isik` WHERE maks2006>0")); echo  $value[0];?><br />

           Kokku: <? $value = mysql_fetch_array(mysql_query("SELECT SUM( maks2006 ) FROM  `isik`")); echo  $value[0];?>kr </td>

           <td  width="70" class="menu" nowrap align="center">2007<br />

             Maksnud: <? $value = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM  `isik` WHERE maks2007>0")); echo  $value[0];?><br />

           Kokku: <? $value = mysql_fetch_array(mysql_query("SELECT SUM( maks2007 ) FROM  `isik`")); echo  $value[0];?>kr </td>

           <td  width="70" class="menu" nowrap align="center">2008<br />

             Maksnud: <? $value = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM  `isik` WHERE maks2008>0")); echo  $value[0];?><br />

           Kokku: <? $value = mysql_fetch_array(mysql_query("SELECT SUM( maks2008 ) FROM  `isik`")); echo  $value[0];?>kr </td>

           <td  width="70" class="menu" nowrap align="center">2009<br />

             Maksnud: <? $value = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM  `isik` WHERE maks2009>0")); echo  $value[0];?><br />

           Kokku: <? $value = mysql_fetch_array(mysql_query("SELECT SUM( maks2009 ) FROM  `isik`")); echo  $value[0];?>kr </td>

           <td  width="35" class="menu" nowrap align="center">2010<br />

             Maksnud: <? $value = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM  `isik` WHERE maks2010>0")); echo  $value[0];?><br />

           Kokku: <? $value = mysql_fetch_array(mysql_query("SELECT SUM( maks2010 ) FROM  `isik`")); echo  $value[0];?>kr </td>

           <td  width="35" class="menu" nowrap align="center">2011<br />

             Maksnud: <? $value = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM  `isik` WHERE maks2011>0")); echo  $value[0];?><br />

           Kokku: <? $value = mysql_fetch_array(mysql_query("SELECT SUM( maks2011 ) FROM  `isik`")); echo  $value[0];?>EUR </td>

           <td  width="70" class="menu" nowrap align="center">2012<br />

             Maksnud: <? $value = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM  `isik` WHERE maks2012>0")); echo  $value[0];?><br />

           Kokku: <? $value = mysql_fetch_array(mysql_query("SELECT SUM( maks2012 ) FROM  `isik`")); echo  $value[0];?>EUR </td>

           <td  width="70" class="menu" nowrap align="center">2013<br />

             Maksnud: <? $value = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM  `isik` WHERE maks2013>0")); echo  $value[0];?><br />

           Kokku: <? $value = mysql_fetch_array(mysql_query("SELECT SUM( maks2013 ) FROM  `isik`")); echo  $value[0];?>EUR</td>

           <td  width="35" class="menu" nowrap align="center">2014<br />

             Maksnud: <? $value = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM  `isik` WHERE maks2014>0")); echo  $value[0];?><br />

           Kokku: <? $value = mysql_fetch_array(mysql_query("SELECT SUM( maks2014 ) FROM  `isik`")); echo  $value[0];?>EUR</td>

           <td  width="35" class="menu" nowrap align="center">2015<br />

             Maksnud: <? $value = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM  `isik` WHERE maks2015>0")); echo  $value[0];?><br />

           Kokku: <? $value = mysql_fetch_array(mysql_query("SELECT SUM( maks2015 ) FROM  `isik`")); echo  $value[0];?>EUR</td>

           <td  width="70" class="menu" nowrap align="center">2016<br />

             Maksnud: <? $value = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM  `isik` WHERE maks2016>0")); echo  $value[0];?><br />

           Kokku: <? $value = mysql_fetch_array(mysql_query("SELECT SUM( maks2016 ) FROM  `isik`")); echo  $value[0];?>EUR</td>

		   <td width="6%" nowrap class="smallbody">&nbsp;</td>

        </tr>		<?

		



		while($line=mysql_fetch_array($result)){

			?>
	       <tr> 

		   <td width="2%" class="navi"><? echo $count,".";?><img border=0 src="image/spacer.gif" width="10" height="10"></td>

	       <td  width="25%" class="menu" nowrap><a href="index.php?page=isik_disp&iid=<? echo $line["id"]; ?>&pw=<? echo $pw;?>&liik=<? echo $liik;?>" target="_blank"><? echo $line["eesnimi"]." ".$line["perenimi"]; ?></a></td>

           <td  width="4%" class="menu" nowrap><? if ($line["email1"]) { ?><? echo $line["email1"]; ?><? } ?></td>

           <td  align="center" nowrap class="navi"><? echo $line["maks2005"]; ?></td>

           <td  align="center" nowrap class="navi"><? echo $line["maks2006"]; ?></td>

           <td  align="center" nowrap class="navi"><? echo $line["maks2007"]; ?></td>

           <td  align="center" nowrap class="navi"><? echo $line["maks2008"]; ?></td>

           <td  align="center" nowrap class="navi"><? echo $line["maks2009"]; ?></td>

           <td align="center" nowrap  class="navi"><? echo $line["maks2010"]; ?></td>

           <td align="center" nowrap  class="navi"><? echo $line["maks2011"]; ?></td>

            <td align="center" nowrap  class="navi"><? echo $line["maks2012"]; ?></td>

           <td align="center" nowrap  class="navi"><? echo $line["maks2013"]; ?></td>

           <td align="center" nowrap  class="navi"><? echo $line["maks2014"]; ?></td>

            <td align="center" nowrap  class="navi"><? echo $line["maks2015"]; ?></td>

           <td  wclass="menu" nowrap align="center"><? echo $line["maks2016"]; ?></td>

           <td wvalign="middle"> <? echo urldecode($line["veeb_pilt_url"]); ?>    </td>

		   <td nowrap class="smallbody"><? if($priv>=2) {?><a href="index.php?page=isik_table&action=del&iid=<? echo $line["id"]; ?>&liik=<? echo $liik; ?>" class="button2">x</a><? } ?></td>

	       </tr>

	<?

	$count++;

	}	// ------------- peagrupi exponaat -----------

?>

</table>



