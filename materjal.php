<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "kaido", "biefeldt")
     	or die("Could not connect");
    // print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><link href="scat.css" rel="stylesheet" type="text/css" />
<br>
<?
	$query="SELECT * FROM raamat16 WHERE pid>0";
	$result=mysql_query($query);
//	echo $query;
//esimene tabeli rida annab kategooria nime ...	
	?>

			
<table width="100%" border="0" cellspacing="0" cellpadding="0">		<?
$count=1;
$count_uus=200;
		while($line=mysql_fetch_array($result)){
			
		// vaatame, kas selline inimene on juba olemas
		
			
			
		$query_r="SELECT * FROM mdl_role_assignments WHERE userid=".$line_m["userid"]." AND contextid=".$context_id;
		$result_r=mysql_query($query_r);
		$line_r=mysql_fetch_array($result_r);
		if (1) // õpilased=5
		{
			?>
	        <tr background="image/sinine.gif"> 
          	<td colspan="10" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td width="4%" class="navi"><? echo $count,".";?></td>
	       <td  width="18%" class="fields_left" nowrap><?
		   $line_isik=mysql_fetch_array($result_isik);
		    echo $line["nimi_est"]; ?></td>
           <td  width="16%" class="navi" nowrap><? echo $line_ryhmad["name"]; ?></td>
           <td  width="16%" class="menu" nowrap align="left">
</td>
           <td  width="16%" class="menu" nowrap align="left"><?  echo $line_u["email"]; ?></td>
           
           
          
		   <td width="14%" nowrap class="smallbody"><? 
		   
		   
		$query_k="SELECT * FROM mdl_user_info_data WHERE fieldid=38 AND userid=".$line_m["userid"];
		$result_k=mysql_query($query_k);
		$line_k=mysql_fetch_array($result_k);
		   echo $line_k["data"]?></td><td width="8%" nowrap class="smallbody"> 
		   
		   
</td>
		   <td width="8%" nowrap class="smallbody"><? if ($line_o[0]>1) {echo "+".$count_tunnistus; $count_tunnistus++;}?></td>
	       </tr>
	<? 
// lisa uus tegelane tõendite andmebaasi

		$query_t="INSERT INTO raamat16_raamat16 (`oid1`, `oid2`, `order1`) VALUES (1, '".$line["id"]."', '".$count."')";
//mysql_query($query_t);		
//		echo $query_t,"; "; 
		
// uued alajaotused: sissejuhatus, koostis, omadused, saamine;

$query1="INSERT INTO `fyysika_ee`.`raamat16` (`id`, `pid`, `tykk`, `nimi_est`, `tekst`, `veeb_pilt_url`, `veeb_pilt_url_s`, `naita_veebis`, `jarjest`) VALUES (".$count_uus.", '0', '', 'Sissejuhatus', '', '', '', '', '".$count_uus."')";
//mysql_query($query1);		

$query_t="INSERT INTO raamat16_raamat16 (`oid1`, `oid2`, `order1`) VALUES (".$line["id"].", '".$count_uus."', '".$count."')";
//mysql_query($query_t);		
	$count_uus++;
	
	
$query2="INSERT INTO `fyysika_ee`.`raamat16` (`id`, `pid`, `tykk`, `nimi_est`, `tekst`, `veeb_pilt_url`, `veeb_pilt_url_s`, `naita_veebis`, `jarjest`) VALUES (".$count_uus.", '0', '', 'Koostis/Struktuur', '', '', '', '', '".$count_uus."')";
//mysql_query($query2);		
		
$query_t="INSERT INTO raamat16_raamat16 (`oid1`, `oid2`, `order1`) VALUES (".$line["id"].", '".$count_uus."', '".$count."')";
//mysql_query($query_t);		
	$count_uus++;
	
	
$query3="INSERT INTO `fyysika_ee`.`raamat16` (`id`, `pid`, `tykk`, `nimi_est`, `tekst`, `veeb_pilt_url`, `veeb_pilt_url_s`, `naita_veebis`, `jarjest`) VALUES (".$count_uus.", '0', '', 'Omadused', '', '', '', '', '".$count_uus."')";
//mysql_query($query3);		
		
$query_t="INSERT INTO raamat16_raamat16 (`oid1`, `oid2`, `order1`) VALUES (".$line["id"].", '".$count_uus."', '".$count."')";
//mysql_query($query_t);		
	$count_uus++;
	
	
$query4="INSERT INTO `fyysika_ee`.`raamat16` (`id`, `pid`, `tykk`, `nimi_est`, `tekst`, `veeb_pilt_url`, `veeb_pilt_url_s`, `naita_veebis`, `jarjest`) VALUES (".$count_uus.", '0', '', 'Saamine', '', '', '', '', '".$count_uus."')";		
//mysql_query($query4);		
$query_t="INSERT INTO raamat16_raamat16 (`oid1`, `oid2`, `order1`) VALUES (".$line["id"].", '".$count_uus."', '".$count."')";
//mysql_query($query_t);		
	$count_uus++;


	$count++;
	}
		}	// ------------- peagrupi exponaat -----------
?>
</table>
