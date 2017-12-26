<link href="scat.css" rel="stylesheet" type="text/css" />

<br>

<?

//				$query="SELECT id,veeb_pilt_url_s FROM exp";

//				echo $query;

//				$result=mysql_query($query);

//			while($line=mysql_fetch_array($result)){

//				$str = urldecode($line["veeb_pilt_url"]);

//				$str1 = urldecode($line["veeb_pilt_url_s"]);

// lõikan maha faililaiendi ja kirjutan pildi kujul id.laiend kataloogi mis all näha ...

//				$arr = split( '[/]',$str, 3);

//				$arr1 = split( '[/]',$str1, 3);



//teeme veebifailid, ühe pisikese, teise suurema ...

//				$url="media/exp_pildid_veeb/".$arr[2];

//				$url_s="media/exp_pildid_veeb/".$arr1[2];

//				echo $arr[2];



// kirjutan andmebaasi vastava kirje ... pildi url/i

//if($arr1[2] != NULL)

//{				

//				$query1="UPDATE exp SET veeb_pilt_url='".urlencode($url)."' WHERE id=".$line["id"];

//				mysql_query($query1);

//				$query2="UPDATE exp SET veeb_pilt_url_s='".urlencode($url_s)."' WHERE id=".$line["id"];

//				mysql_query($query2);

//				echo $query2;

//}

//				} 







	$aastakene=$_GET["aasta"];

	$action=$_GET["action"];

	if(!$aastakene) $aastakene="2017";

//	echo $aastakene;

	include("globals.php");

	if($action=="del")

	{

		$reisid=$_GET["reisid"];

		$mediadirs=array("reis_pildid","reis_docs");

		foreach($mediadirs as $tmp)

		{

			$dd="media/".$tmp;

			$q="SELECT url FROM ".$tmp." WHERE oid=".$reisid;

//			echo $q;

			$r=mysql_query($q);

			while($line=mysql_fetch_array($r)){

				unlink(urldecode($line["url"]));  

				}	

		}				



		$tables=array('reis_doc','reis_fotod');

		foreach($tables as $name){

			$q="DELETE FROM ".$name." WHERE oid=".$reisid;

//			echo $q;

			$r=mysql_query($q);

		}



		$q="DELETE FROM reis WHERE id=".$reisid;

//			echo $q;

		$r=mysql_query($q);

// otsing stringi jarele ...

	} ?>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr> 

    <td class="pealkiri" colspan="8">N&Auml;DALAD JA REISID AASTAL <? echo $aastakene; ?><span class="navi">(<a href="http://www.fyysika.ee/omad/reis_table_aruanne.php">aruanne</a>)</span></td>

  </tr>

  <tr> 

    <td width="17%" class="menu">n&auml;dal, kuup&auml;evad</td>

    <td width="10%" class="menu">&nbsp;</td>

    <td width="39%" class="menu">nmbr, nimi</td>

    <td width="19%" class="menu">&nbsp;</td>

    <td width="5%" class="menu">pealik</td>

    <td width="1%" >&nbsp;</td>

    <td width="9%" >&nbsp;</td>

  </tr>

  <tr background="image/sinine.gif"> 

    <td colspan="8" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>

</table> 

<? 

switch ($aastakene)

{

	case "2005": $pa=27; $yea=2004; $pl=2; $yel=2005; $moa=12; $mol=1; $hooaeg=1; $nihe=6; break;

	case "2006": $pa=26; $yea=2005; $pl=1; $yel=2006; $moa=12; $mol=1; $hooaeg=2; $nihe=2; break;

	case "2007": $pa=25; $yea=2006; $pl=31; $yel=2006; $moa=12; $mol=12; $hooaeg=3; $nihe=0; break;

	case "2008": $pa=31; $yea=2007; $pl=6; $yel=2008; $moa=12; $mol=1; $hooaeg=4; $nihe=0; break;

	case "2009": $pa=29; $yea=2008; $pl=4; $yel=2009; $moa=12; $mol=1; $hooaeg=5; $nihe=0; break;

	case "2010": $pa=28; $yea=2009; $pl=4; $yel=2010; $moa=12; $mol=1; $hooaeg=6; $nihe=0; break;

	case "2011": $pa=27; $yea=2010; $pl=4; $yel=2011; $moa=12; $mol=1; $hooaeg=7; $nihe=0; break;

	case "2012": $pa=26; $yea=2011; $pl=2; $yel=2012; $moa=12; $mol=1; $hooaeg=8; $nihe=0; break;

	case "2013": $pa=24; $yea=2012; $pl=31; $yel=2012; $moa=12; $mol=12; $hooaeg=9; $nihe=0; break;

	case "2014": $pa=23; $yea=2013; $pl=30; $yel=2013; $moa=12; $mol=12; $hooaeg=10; $nihe=0; break;

	case "2015": $pa=22; $yea=2014; $pl=29; $yel=2014; $moa=12; $mol=12; $hooaeg=11; $nihe=0; break;

	case "2016": $pa=21; $yea=2015; $pl=28; $yel=2015; $moa=12; $mol=12; $hooaeg=12; $nihe=0; break;
	case "2017": $pa=26; $yea=2016; $pl=2; $yel=2017; $moa=12; $mol=1; $hooaeg=13; $nihe=0; break;

}

// loeme reisid selle muutujaga üle



$reisi_nmbr=0;



?>  

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<?



for ($i = 1 + $nihe; $i <= 52; $i++) {

if ($aastakene==2010&&i>8)

{

$aastaalgus  = date("Y-m-d", mktime (0,0,0,$moa  ,$pa+$i*7+1,$yea));

$aastalopp  = date("Y-m-d", mktime (0,0,0,$mol  ,$pl+$i*7,$yel));

}

else

{

$aastaalgus  = date("Y-m-d", mktime (0,0,0,$moa  ,$pa+$i*7,$yea));

$aastalopp  = date("Y-m-d", mktime (0,0,0,$mol  ,$pl+$i*7-1,$yel));

}

//echo $aastaalgus;
//echo $aastalopp;

$algus=$aastaalgus;

$kuu=substr($algus,5,2);

$kuua = kuud($kuu, $keel);	

$paeva=substr($algus,8,2);



		

$lopp=$aastalopp;

$aasta=substr($lopp,0,4);

$kuu=substr($lopp,5,2);

$paevl=substr($lopp,8,2);

$kuul = kuud($kuu, $keel);

if($kuua == $kuul)	

$algus_f=$paeva.".";

else		

$algus_f=$paeva.'. '.$kuua;

$lopp_f=$paevl.'. '.$kuul;//.' '.$aasta;

											





?>

  <tr> 

    <td width="1%" valign="top" class="menu"><? echo $i;?>.</td>

    <td width="0%" class="menu">&nbsp;</td>

    <td width="16%" valign="top" class="navi"><? echo $algus_f;?> - <? echo $lopp_f; ?>    </td>

    <td width="1%" class="menu" <? if ($aastaalgus <= date("Y-m-d")) {if($aastalopp>date("Y-m-d")){echo "bgcolor=\"#FF0000\"";} else {echo "bgcolor=\"#00FF00\"";} } else {echo "bgcolor=\"#FFFF00\"";}?> ><img src="image/spacer.gif" width="15" height="18"></td>

    <td width="82%" ><a href="index.php?page=reis_disp&action=new&aasta=<? echo $aastakene; ?>&nadal=<? echo $i;?>&algus=<? echo $aastaalgus; ?>&lopp=<? echo $aastalopp; ?>" class="button">Lisa siia reis</a>

  <? 

// otsime reie, mis sellele nädalale määratud

	$query="SELECT nimi,id, pealik, algus, lopp, galerii, sisu, rahad FROM reis WHERE nimi LIKE '%".$_POST["search_str"]."%' AND nadal_nmbr=".$i." AND hooaeg_nmbr=".$hooaeg." ORDER BY algus";

	//echo $query;

	$result=mysql_query($query);

 	while($line=mysql_fetch_array($result))

	{

//	echo $line["galerii"];

	

				$reisi_nmbr++;

				

				$algus=$line{'algus'};

				$kuu=substr($algus,5,2);

				$paeva=substr($algus,8,2);

				$kuua = kuud($kuu, $keel);			

				$lopp=$line{'lopp'};

				$aasta=substr($lopp,0,4);

				$kuu=substr($lopp,5,2);

				$paevl=substr($lopp,8,2);

				$kuul = kuud($kuu, $keel);

				if($kuua == $kuul&&$paeva!=$paevl)	

					$reisiaeg=$paeva.". - ".$paevl.". ".$kuul.' '.$aasta;

				if($kuua == $kuul&&$paeva==$paevl)

					$reisiaeg=$paeva.'. '.$kuua.' '.$aasta;

				if($kuua != $kuul&&$paeva!=$paevl)	

					$reisiaeg=$paeva.". ".$kuua.' - '.$paevl.". ".$kuul.' '.$aasta;



 ?>

      

      <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>           <td width="1%" rowspan="2"  valign="top" class="menu"><? if ($line["galerii"]) {?><a href="galerii.php?reisid=<? echo $line["id"];?>" target="_blank"><img  align="middle" border=0 src="image/index_41_1.gif" width=16 height=16 alt=""></a><? } else {?><img  align="middle" border=0 src="image/index_41.gif" width=16 height=16 alt=""><? } ?></td>

          <td width="0%" rowspan="2"  valign="top" class="menu_punane">            <?

	// vaatame, mis etendus plaanis on ...	

	

				$query99="SELECT * FROM etendus_reis WHERE oid2='".$line["id"]."'";

				$result99=mysql_query($query99);

				while($line99=mysql_fetch_array($result99))

				{



				$query99r="SELECT nimi_est_lyhike FROM etendus WHERE id='".$line99["oid1"]."'";

				$result99r=mysql_query($query99r);

				while($line99r=mysql_fetch_array($result99r))

				{

					 echo $line99r["nimi_est_lyhike"];

				}

		  		}

		   ?></td>

          <td width="49%"  align="center" valign="top" class="menu">

<div align="left"><? echo $reisi_nmbr;?>. reis, <a href="index.php?page=reis_disp&reisid=<? echo $line["id"]; ?>&aasta=<? echo $aastakene;?>"><? echo $line["nimi"];?></a><span class="options">(<? echo $line["rahad"];?>)</span></div>

</td>

          <td width="21%" rowspan="2"  align="left" valign="top" class="menu"><? echo $reisiaeg;?> </td>

          <td width="16%" rowspan="2" valign="top" nowrap   class="fields"> 

            <?

	$query3="SELECT eesnimi, perenimi FROM isik WHERE id=".$line["pealik"];

	$result3=mysql_query($query3);

	$m=mysql_fetch_array($result3);

	

	echo $m["eesnimi"]," ",$m["perenimi"]; ?>

          <td width="1%" rowspan="2" valign="top"  nowrap class="smallbody"> 

            <? if($priv>=2) {?>

            <a href="index.php?page=reis_table&action=del&reisid=<? echo $line["id"]; ?>&aasta=<? echo $aastakene;?>" class="menu_punane">x</a> 

            <? } ?>          </td>

         <td width="1%" rowspan="2"  valign="top"> 

            <img src="image/index_39.gif" width="16" height="16"  align="top">          </td>

        </tr>

        <tr>

          <td  align="center" valign="top" class="menu">

		  

            <div align="left">

              <?

	$query99="SELECT oid2 FROM reis_kool WHERE oid1=".$line["id"];

 	$result99=mysql_query($query99);

	while($line99=mysql_fetch_array($result99))

	{

	$query37="SELECT nimi FROM kool WHERE id=".$line99["oid2"];

 	$result37=mysql_query($query37);

	$line=mysql_fetch_array($result37);

	echo $line["nimi"];

	?>

              </br>

              <?

	

	}

?>		  

            </div></td>

        </tr>

      </table>

  <?

	}



?>	</td>

  </tr>

  <tr background="image/sinine.gif"> 

    <td colspan="8" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>

<? } ?>

</table>



<?



	$query="SELECT nimi,id, pealik, algus, lopp, nadal_nmbr FROM reis WHERE nimi LIKE '%".$_POST["search_str"]."%' AND nadal_nmbr=0 ORDER BY nimi";

	$result=mysql_query($query);

		?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr> 

    <td colspan="6" class="menu">&Uuml;LDHUVITAVAD &Uuml;RITUSED, PAIGUTAMATA REISID</td>

  </tr>

  <tr> 

    <td class="menu">&nbsp;</td>

    <td class="menu">n&auml;dal</td>

    <td class="menu">kuup&auml;evad</td>

    <td class="menu">nimi</td>

    <td >&nbsp;</td>

    <td >&nbsp;</td>

  </tr>

  <tr background="image/sinine.gif"> 

    <td colspan="6" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>

  <? 

 	while($line=mysql_fetch_array($result))

	{

			$algus=$line{'algus'};

			$kuu=substr($algus,5,2);

			$paeva=substr($algus,8,2);

			$kuua = kuud($kuu, $keel);			

			$lopp=$line{'lopp'};

			$aasta=substr($lopp,0,4);

			$kuu=substr($lopp,5,2);

			$paevl=substr($lopp,8,2);

			$kuul = kuud($kuu, $keel);

			if($kuua == $kuul&&$paeva!=$paevl)	

				$reisiaeg=$paeva.". - ".$paevl.". ".$kuul.' '.$aasta;

			if($kuua == $kuul&&$paeva==$paevl)

				$reisiaeg=$paeva.'. '.$kuua.' '.$aasta;

			if($kuua != $kuul&&$paeva!=$paevl)	

				$reisiaeg=$paeva.". ".$kuua.' - '.$paevl.". ".$kuul.' '.$aasta;



 ?>

  <tr> 

    <td width="7%" valign="middle" class="menu"><img src="image/spacer.gif" width="16" height="17"><img  align="middle" border=0 src="image/index_41.gif" width=19 height=19 alt=""></td>

    <td width="7%" align="center" valign="middle" class="menu"> <? echo $line["nadal_nmbr"];?>    </td>

    <td width="28%" align="center" valign="middle" class="navi"><div align="left"><? echo $reisiaeg;?> </div></td>

    <td  width="43%" class="fields" nowrap align="left"><a href="index.php?page=reis_disp&reisid=<? echo $line["id"]; ?>&aasta=<? echo $aastakene;?>"> 

      <? echo $line["nimi"];?></a></td>

    <td width="10%" nowrap class="smallbody"> 

      <div align="right">

        <? if($priv>=2) {?>

        <a href="index.php?page=reis_table&action=del&reisid=<? echo $line["id"]; ?>&aasta=<? echo $aastakene;?>">kustuta</a> 

        <? } ?>    

      </div></td>

    <td width="5%" valign="top"> 

      <? //if($priv>=2) {?>

      <img  align="middle" src="image/index_39.gif" > 

      <? //} ?>    </td>

  </tr>

  <?

	}



?>

</table>

