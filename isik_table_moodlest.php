<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "kaido", "biefeldt")
     	or die("Could not connect");
    // print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><link href="scat.css" rel="stylesheet" type="text/css" />
<br>
<?
	$count=1;

$query="";
?>
<?
	$query="SELECT * FROM isik_opikojad";
	$result=mysql_query($query);
//	echo $query;
//esimene tabeli rida annab kategooria nime ...	
	?>

			
<table width="100%" border="0" cellspacing="0" cellpadding="0">		<?

		while($line=mysql_fetch_array($result)){
			
		// vaatame, kas selline inimene on juba olemas
		
		$query_isik="SELECT * FROM isik WHERE eesnimi LIKE '%".$line["eesnimi"]."%' AND perenimi LIKE '%".$line["perenimi"]."%' ORDER BY eesnimi";

//	echo $query;
	$result_isik=mysql_query($query_isik);	
			
			
			
		
			?>
	        <tr background="image/sinine.gif"> 
          	<td colspan="8" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td width="3%" class="navi"><? echo $count,".";?><img border=0 src="image/spacer.gif" width="10" height="10"></td>
	       <td  width="40%" class="menu" nowrap><?
		   $line_isik=mysql_fetch_array($result_isik);
		    echo $line["eesnimi"]." ".$line["perenimi"]; ?></td>
           <td  width="9%" class="navi" nowrap><? if ($line["email1"]) { ?><a href="mailto:<? echo $line["email1"]; ?>" class="navi" ><? echo $line["email1"]; ?></a><? } ?></td>
           <td  width="10%" class="menu" nowrap align="center"><? echo $line["mobla"]; ?></td>
           
           
          
		   <td width="9%" nowrap class="smallbody"><?  //echo "https://www.fi.tartu.ee/moodle/user/pix.php/".$line["id"]."/f1.jpg"; ?></td>
	       </tr>
	<?
// lisa uus tegelane

		   if ($line_isik)
		   {
			   echo "on küll";
			} 
			else 
		   {
$query_uus="INSERT INTO `fyysika_ee`.`isik` (`id`, `perenimi`, `eesnimi`, `username`, `password`, `privileegid`, `teaduskraad`, `diplom`, `diplom_aasta`, `veeb_pilt_url`, `veeb_pilt_url_s`, `a_num`, `isikukood`, `amet_est`, `amet_eng`, `amet_rus`, `mobla`, `skype`, `tel_too`, `tel_kodu`, `adr_too1`, `adr_too2`, `adr_kodu`, `email1`, `email2`, `in_buss`, `in_efs`, `in_efs_date`, `paberajakiri`, `eajakiri`, `on_fi`, `on_meedia`, `on_sk`, `on_ajak`, `on_ef`, `on_ut`, `on_promi`, `on_reisijuht`, `on_tugiisik`, `on_nublu`, `huvid`, `markused`, `tagasiside_vormist`, `lupdate`, `in_veeb`, `r_alg`, `maks2005`, `maks2006`, `maks2007`, `maks2008`, `maks2009`, `maks2010`, `maks2011`, `maks2012`, `b_kat`, `sammas`, `uiq`) VALUES (NULL, '".$line["perenimi"]."', '".$line["eesnimi"]."', '".$line["username"]."', '', '0', '', '', '', NULL, '', NULL, '0', '".$line["amet_est"]."', '', '', '".$line["mobla"]."', '".$line["skype"]."', NULL, NULL, NULL, NULL, NULL, '".$line["email1"]."', NULL, '0', '0', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', NULL, NULL, '', CURRENT_TIMESTAMP, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '')";	
//	$result_uus=mysql_query($query_uus);	
		}
	$count++;
	}	// ------------- peagrupi exponaat -----------
?>
</table>
