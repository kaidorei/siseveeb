<style type="text/css">
<!--
.style2 {color: #FF0000}
-->
</style>
<?
include("connect.php");
include("authsys.php");	
include("globals.php");

$valjad=array("aine","raamat6","raamat1","raamat13");
foreach($valjad as $var){

$n2ita_querysid = FALSE;
@$klass=$var;
if (isset($var)) {
	$is_aine = ($var === "aine");
	$is_pacs = ($var === "pacs");
	$is_tehno = ($var === "tehno");
	if ($is_aine) {$tasemeid = 3; $raamatunimi="Koolipuu";}
	if ($is_pacs) $tasemeid = 3;
	if ($is_tehno) $tasemeid = 3;
	if (!$is_aine && !$is_pacs && !$is_tehno) {
//		echo $baas;
			$temp = explode("raamat",$var);
			$raamatunumber = $temp[1];
			$query_0="SELECT * FROM raamat WHERE id=".$raamatunumber;
			$result_0=mysql_query($query_0);
			$temp2=mysql_fetch_array($result_0);
			$tasemeid=$temp2["tasemeid"];
			$raamatunimi=$temp2["nimi"];
	}
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#FF0000" >
	<? echo $raamatunimi;?></td>
  </tr>
</table>
<?

switch ($klass)
{
	case "teadus": $baas="pacs"; break;
	case "tehno": $baas="tehno"; break;
	case "kool": $baas="aine"; break;
	default:  $baas=$klass; break;
}

//echo "tasemeid", $tasemeid;

$query="SELECT nimi_est,id,naita_veebis FROM ".$baas." WHERE pid=0 ORDER BY id";

if ($n2ita_querysid) echo $query."query";
$result=mysql_query($query);

while($line=mysql_fetch_array($result))
{
$openasi=1;	
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#FFFF00" >
	<a href="index.php?page=exp_tree&op=<? echo implode(",",$tmp);?>&klass=<? echo $klass;?>"></a>
	<? echo $line["nimi_est"]; //siin on esimene aste ?> 
    - <? echo $line["naita_veebis"] ;?></td>
  </tr>
</table>

							
<?

// Laotame lahti alamgrupi nr 1
		if ($openasi) {
				$query12="SELECT oid2, naita_veebis1 FROM ".$baas."_".$baas." WHERE oid1=".$line["id"]." ORDER BY id";
				if ($n2ita_querysid) echo $query12."query12";
				$result12=mysql_query($query12);
				
////////////////////////////////////////////////////////////////////////////////				
// siia kohta tuleb järjestamine pacs tabeli kirje jarjest järgi ...
//Alamasja loop algab siit
				
				while($agrupp=mysql_fetch_array($result12)){ //tähtis while tsükkel
					$openasi_alamg=1;
							
						$query13="SELECT id, nimi_est FROM ".$baas." WHERE id=".$agrupp["oid2"];
				 		if ($n2ita_querysid) echo $query13."query13";
						$result13=mysql_query($query13);

						$agrupp_nimi=mysql_fetch_array($result13);
						?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr> 
   		<td nowrap <? if ($tasemeid==3){?>bgcolor="#00FF00" <? }else{ ?>bgcolor="#CCCCCC" <? }?>><a href="index.php?page=aine_disp&pid=<? echo $agrupp["oid2"]; ?>&klass=<? echo $klass;?>"  class="ekraan_link"><? echo $agrupp_nimi["nimi_est"];  ?></a> - <? echo $agrupp["naita_veebis1"];?></td> 
   		<? //see tekitab pluss märgi või miinusmärgi sinna ette koos lingiga ?>
   	  <? if ($tasemeid == 2) { ?>		
<td class=\"menu\" ><? } ?>
  	</tr>
</table>



<?

// Laotame lahti alamgrupi nr 2
		if ($openasi_alamg){					
				$query21="SELECT oid2, naita_veebis1, id FROM ".$baas."_".$baas." WHERE oid1=".$agrupp["oid2"]." ORDER BY id";
				if ($n2ita_querysid) echo $query21."query21".$agrupp["oid2"];
				$result21=mysql_query($query21);
				//Alamasja loop algab siit
				if ($n2ita_querysid) var_dump($agrupp2=mysql_fetch_array($result21));
				while($agrupp2=mysql_fetch_array($result21)){
					$openasi_alamg2=1;
					if ($n2ita_querysid) var_dump ($agrupp2." ");

						$query22="SELECT id, nimi_est, naita_veebis FROM ".$baas." WHERE id=".$agrupp2["oid2"];
						if ($n2ita_querysid) echo "<p>t".$query22."query22"."t<p>";
						$result22=mysql_query($query22);
						$agrupp2_nimi=mysql_fetch_array($result22)
						?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr> 
    <td nowrap bgcolor="#CCCCCC" ><a href="index.php?page=aine_disp&pid=<? echo $agrupp2["oid2"]; ?>&klass=<? echo $klass;?>" class="ekraan_link"><? echo $agrupp2_nimi["nimi_est"];  ?></a> - <? echo $agrupp2["naita_veebis1"];?></td>
    </tr>
</table>

<? 
// Laotame lahti alamgrupi 2 eksponaadid ...
					if ($openasi_alamg2)
					{					
						$query34="SELECT id, order1, oid2, title1, sisse1, sisu1, naita_veebis1 FROM ".$baas."_exp WHERE oid1=".$agrupp2["oid2"]." ORDER BY order1";
						if ($n2ita_querysid) echo $query34."query34 rrt".$exp_seos;
						$id_prev=0;
						
						$result34=mysql_query($query34);
						if($result34 == NULL) {}
						while($exp_seos=mysql_fetch_array($result34))
						{
						//echo "<pre>";
						
						//var_dump($exp_seos);
						//echo "</pre>";
						//echo "<p>";
							$query35="SELECT id,nimi_est, video_url, video_url_suur, veeb_pilt_url FROM exp WHERE id=".$exp_seos["oid2"];
							if ($n2ita_querysid) echo $query35."query35"."<p>";
							$result35=mysql_query($query35);
							if ($n2ita_querysid) echo "<p>as".$query35;
							if ($result35 == TRUE) $exponaat_nimi=mysql_fetch_array($result35);
							//if ($result35 == FALSE)
							//echo "<p>";
							//
							
									?>
							
<?

						$id_prev=$exp_seos["id"];


						} // end of alamgrupid 2 eksponaat
					}	// end of if
 			}// end of while alamgrupp 2 nimi
} // end of if alamgrupi 2  nimi





// Laotame lahti alamgrupi 1 eksponaadid ...
		if ($openasi_alamg){					
			$query24="SELECT oid2,id, order1, title1, sisse1, sisu1, naita_veebis1 FROM ".$baas."_exp WHERE oid1=".$agrupp["oid2"]." ORDER BY order1";
			if ($n2ita_querysid) echo $query24."query24"."<p>";
			$result24=mysql_query($query24);
			while($exponaat=mysql_fetch_array($result24))
			{
				$query25="SELECT nimi_est, id, video_url, video_url_suur, veeb_pilt_url FROM exp WHERE id=".$exponaat["oid2"];
				if ($n2ita_querysid) echo $query25."query25"."<p>";
				$result25=mysql_query($query25);
				$exponaat_nimi=mysql_fetch_array($result25);
					if ($n2ita_querysid) echo "<p><pre>cvbn";
					//echo $query35;
					if ($n2ita_querysid) var_dump($exponaat_nimi);
					if ($n2ita_querysid) echo "</pre>";
									?>
<? if ($tasemeid == 2) {} ?> 

<?
		}	// end of if
	} // end of alamgrupid eksponaat
} // end of alamgrupi nimi

	} // ----------------- peagrupp avatud ---------		
}

			}//foreach


// Määratlemata ...
?>