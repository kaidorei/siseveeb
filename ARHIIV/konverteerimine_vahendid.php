<? 	
	$kat="3,6";
	$count=1;
	$id_0=14500;
	
	$tykid_kat=explode(",", $kat);
	for($ii = 1; $ii < sizeof($tykid_vv); ++$ii)
	{
		
	}
	// kui on tehtud valik demolisuse j'rgi .. 
	if($kat!=NULL) 
	{
		$str2 = " gpid_demo IN (".$kat.")";
	}
	else
	{	
		$str2='';
	}

//require_once 'header.php';
	
include("connect.php");
include("globals.php");


$query="SELECT * FROM exp WHERE on_slave=0 AND ".$str2." ORDER BY nimi_est";
//echo $query;
$result=mysql_query($query);
?>

<table width="100%">


<?

	while($line=mysql_fetch_array($result))
	{
?>


<tr>
   <td width="1%" valign="top" >
     
     
     <? echo $count;?>.</td>
   <td width="85%" valign="top" ><strong>Nimi:</strong>
     <? 
	echo $line["nimi_est"];	?>
	
	
     <br />
     
     <?
	 // tee uus vahendite exp
	 $id_uus= $id_0+$count;
	 $query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `gpid_demo`, `naita_veebis`, `slideshow_id`, `on_slave`, `on_pohivara`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `tex`, `tex_html`, `tex1`, `misvalesti_est`, `ohud_est`, `kokku_est`, `kokkuprint_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `time_youtube`, `id_uudis`, `id_3D`, `ext_url`, `ext_url_eng`, `video_player`, `orig_URL`, `sell_it`, `copyright`)
	  VALUES 
	  (".$id_uus.", '35', '1', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', NULL, NULL, '".$line["nimi_est"]."_vahendid', NULL, NULL, 'kir', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '0', CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '', '', '1', '', '', '')";

echo $query1,"<br><br>";

//$result1=mysql_query($query1);
//Seoste kopeerimine?

$query4 = "INSERT INTO `fyysika_ee`.`exp_exp` (`id`, `oid1`, `oid2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`, `order1`, `order2`, `meta1`)

VALUES

(NULL, '".$line["id"]."', '".$id_uus."', '".$line["id"]."_".$id_uus."', '', '', '', '', '', '1', '1', '', '0','0');";
//echo $query4." <br><br>";


//$result4=mysql_query($query4);



$query_vv="UPDATE exp_vahendid SET oid1=".$id_uus." WHERE oid1=".$line["id"];
//$result_vv=mysql_query($query_vv);

echo "<br>",$query_vv;
     
	$query_v="SELECT * FROM exp_vahendid WHERE oid1=". $line["id"]."";
	//echo $query;
	$result_v=mysql_query($query_v);

	while($line_v=mysql_fetch_array($result_v))
	{
		echo "olemas<br>";
	}
	 
	 
	 
	 
	 ?>
     
     
     
     
     </td>
    <td width="138" >
    
    
    </td>
  </tr>



	
	
<?	
$count++;
}

	?></table>


