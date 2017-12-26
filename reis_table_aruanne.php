				<link href="scat.css" rel="stylesheet" type="text/css" />

<?
	$aastakene=$_GET["aasta"];
	$action=$_GET["action"];
	if(!$aastakene) $aastakene="2014";
//	echo $aastakene;
	include("connect.php");
	include("globals.php");
	?>
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

}
// loeme reisid selle muutujaga üle

$reisi_nmbr=0;

?>  
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
   
    <td width="82%" >
  <? 
// otsime reie, mis sellele nädalale määratud
	$query="SELECT nimi,id, pealik, algus, lopp, galerii, sisu, rahad FROM reis WHERE nimi LIKE '%".$_POST["search_str"]."%' AND nadal_nmbr=".$i." AND hooaeg_nmbr=".$hooaeg." ORDER BY algus";
//	echo $query;
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
     <p> 
  <a href="index.php?page=reis_disp&reisid=<? echo $line["id"]; ?>&aasta=<? echo $aastakene;?>"><? echo $line["nimi"];?></a>
    (<?
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
		   ?>)
    (<?
	$query99="SELECT oid2 FROM reis_kool WHERE oid1=".$line["id"];
 	$result99=mysql_query($query99);
	while($line99=mysql_fetch_array($result99))
	{
	$query37="SELECT nimi FROM kool WHERE id=".$line99["oid2"];
 	$result37=mysql_query($query37);
	$line=mysql_fetch_array($result37);
	echo $line["nimi"];
	?>
    
    <?
	
	}
?>		  
    
    )  <? echo $reisiaeg;?>
<?
	}

?>	</td>
  </tr>
<tr background="image/sinine.gif"> 
    <td colspan="8" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>

  <? } ?>


  