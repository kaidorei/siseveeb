<? 

include("connect.php");

include("globals.php");



//echo $_POST["submit_value"];	



$id=$_GET["id"];

$imgdir="media/temp/"; 

$imgdir_o="../media/temp/"; 

$imgdir_s="../media/temp/thumbs_s/"; 

$lst=list_dir($imgdir);

sort($lst);



$id_0=61000;

$id_pilt=10000;


foreach($lst as $img)

{

	echo $img,"<br>";

	

// Teeme objekti nime



$tykid_vv=explode(".", $img);

$pildiurl="media/exp_pildid/".$img;
$thumb="media/exp_pildid/".$id_0."_".$id_pilt.".jpg";
$thumb_s="media/exp_pildid/".$id_0."_".$id_pilt."s.jpg";

$tykid_v1=explode("_", $img);
$ptk=str_replace("h","",$tykid_v1[0]);


// Teeme uue exp objekti

$query1="INSERT INTO `fyysika_ee`.`exp` (`id`, `pid`, `raamatX_id`, `valem_id`, `gpid_demo`, `naita_veebis`, `slideshow_id`, `on_slave`, `on_pohivara`, `raskus`, `in_buss`, `on_tootuba`, `oht_tuli`, `oht_plahvatus`, `oht_myrk`, `oht_elekter`, `veeb_pilt_id`, `veeb_pilt_url`, `veeb_pilt_url_s`, `image`, `nimi_est`, `nimi_eng`, `nimi_rus`, `kirjeldus_est`, `kirjeldus_eng`, `kirjeldus_rus`, `probleem_est`, `seletus_est`, `seletus_eng`, `seletus_rus`, `vihje_est`, `vastus_est`, `lahendus_est`, `script`, `tex`, `tex_html`, `tex1`, `misvalesti_est`, `ohud_est`, `kokku_est`, `kokkuprint_est`, `hange_est`, `galerii`, `kola_est`, `staatus_id`, `lupdate`, `video_url`, `video_url_suur`, `video_toot`, `id_youtube`, `time_youtube`, `time_tegemine`, `id_uudis`, `id_3D`, `link`, `ext_url`, `ext_url_eng`, `video_player`, `orig_URL`, `sell_it`, `copyright`, `aeg`, `aeg_lopp`) 

VALUES 

('".$id_0."', '0', '".$line["id"]."', '', '9', '1', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '".urlencode($thumb)."', '".urlencode($thumb_s)."', '', '".$tykid_vv[0]."', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '0', CURRENT_TIMESTAMP, '', '', '', '', '', '', '', '', '', '', '', '1', '', '', 'halliday', '', '')";

echo $query1,"<br><br>";
//$result4=mysql_query($query1);
//$query33 = "update exp set veeb_pilt_url= '".urlencode($thumb)."' , veeb_pilt_url_s= '".urlencode($thumb_s)."' WHERE id=".$id_0;

//echo $query33,"<br><br>";

//$result4=mysql_query($query33);





//Pildiobjekt

$query2="INSERT INTO `fyysika_ee`.`exp_pildid` (`id`, `oid`, `ord`, `nimi`, `url`, `veeb_pilt_url`, `veeb_pilt_url_s`, `copyright`, `allikas`, `in_veeb`, `allkiri_est`, `allkiri_eng`, `allkiri_rus`, `naita_veebis`) VALUES (".$id_pilt.", '".$id_0."', '0', '".$tykid_vv[0]."', '".urlencode($pildiurl)."', '".urlencode($thumb)."', '".urlencode($thumb_s)."', 'halliday', 'halliday', '1', NULL, NULL, NULL, '1');";

echo $query2,"<br><br>";

//$result4=mysql_query($query2);

//---------------------------------------
// Seome õigesse kohta ... 

// millise objekti külge?

$queryx="SELECT * FROM `raamatX_raamatX` WHERE book_id=62 AND order1=".$ptk."";
$resultx=mysql_query($queryx);
$linex=mysql_fetch_array($resultx);
echo $queryx,"<br><br>";
echo $linex["oid2"],"<br><br>";
//--------------------------------------
$query22="INSERT INTO `fyysika_ee`.`raamatX_exp` (`oid1`, `oid2`) VALUES ('".$linex["oid2"]."', '".$id_0."');";

echo $query22,"<br><br>";

//$result42=mysql_query($query22);

	$id_0++;

	$id_pilt++;

}



?>

<html>

<link href="scat.css" rel="stylesheet" type="text/css">

<head>

 <title>galerii</title>

</head>



<body>



</body>

</html>

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