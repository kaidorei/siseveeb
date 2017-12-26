<? 	
	mb_internal_encoding('UTF-8');
	$action=$_GET["action"];
	$klass=$_GET["klass"];
	$bookid=$_GET["bookid"];
	$aid=$_GET["aid"];
	$kat=$_GET["kat"];
	$count=1;
	
	$tykid_kat=explode(",", $kat);
	for($ii = 1; $ii < sizeof($tykid_vv); ++$ii)
	{
		
	}
	// kui on tehtud valik demolisuse j'rgi .. 
	if($kat!=NULL) 
	{
		if(!strstr($kat,'2'))
		{
			$str2 = " gpid_demo IN (".$kat.")";
		}
		// kui on simulatsioonid
		else
		{
			$str2 = " ((gpid_demo IN (".$kat.")) OR (CHAR_LENGTH(tex1)>0))";
		}
	}
	else
	{	
		$str2='';
	}

$str2 = " gpid_demo IN (".$kat.")";
	
include("connect.php");
include("globals.php");


$query="SELECT * FROM exp WHERE naita_veebis=1 AND ".$str2." ORDER BY nimi_est";
//echo $query;
$result=mysql_query($query);
?>

<table width="100%">


<?

	while($line=mysql_fetch_array($result))
	{

		if($bookid)
		{
	
			// Kas raamatus ka midagi sees on?
					$query_33="SELECT * FROM raamatX_exp WHERE oid2=".$line["id"]." AND book_id=".$bookid;
					//echo $query_33;
					$result_33=mysql_query($query_33);
					if(mysql_fetch_array($result_33))
					{
						$on = 1;
					}
					else
					{
						$on = 0;
					}
			//		echo $count[0];
	
		}
		else
		{
			
							$on=1;	
		}

if($on==1)

{
?>


<tr>
   <td width="1%" valign="top" >
     
     
     <? echo $count;?>.</td>
   <td width="85%" valign="top" >
     <? 
	 
	switch ($line["gpid_demo"]) 
	
	{
	  case 20:
	  case 23:
	  case 24:
	  case 25:
	  case 27:
	  case 29:
	  case 30:
	  case 32:
	  echo 	$line["probleem_est"]." (valikvastustega k&uuml;simus)"; 
	  break;
	  case 40:
	  echo 	$line["probleem_est"]." (arvutus&uuml;lesanne)"; 
	  break;
	  case 34:
	  case 21:
	  echo 	$line["probleem_est"]." (probleem&uuml;lesanne)"; 
	  break;
	  default: echo "<strong>Nimi:</strong>". $line["nimi_est"];
	  if($line["copyright"] AND $line["copyright"]!="FYYSIKA.EE") echo " (".$line["copyright"].")";	
	  break;
	}
	 
	
	if($line["gpid_demo"]==31)
{
?>

<p align="center">
<img src="media/valem_pildid/<? echo $line["image"];?>" />
</p>	
<?
}


	if($line["time_youtube"]>0){?>
     <br />
     <strong>Pikkus:</strong> <? echo $line["time_youtube"];}
     if($line["gpid_demo"]==6){?>
     <br />
     <strong>Eeldatav l&auml;biviimise aeg:</strong> <? echo $line["time_tegemine"];}?> <br />
      <? 
	 
	 if($line["kirjeldus_est"])
	 {
		 ?> <strong>Annotatsioon:</strong> <?
	 echo $line["kirjeldus_est"];?><br />
     <? }?>
<? 
	switch($line["gpid_demo"])
	{
		case 37: ?><a href="http://opik.fyysika.ee/index.php/slide/run/<? echo $line["slideshow_id"];?>" target="_blank">Link &otilde;piobjektile</a><?		
		break;
		case 40:
		?>     
    <a href="http://www.fyysika.ee/omad/exp_print.php?domain=exp&id=<? echo $line["id"];?>" target="_blank">Lahendus</a>&nbsp;<?
		break;
		case 21: 
		break;
		case 20: // igasugused kontrollküsimused
		case 23: 
		case 24: 
		case 25: 
		case 27: 
		case 29: 
		case 30: 
		case 32: 
		case 13:?><a href="http://opik.fyysika.ee/index.php/exp/display/<? echo $line["id"];?>" target="_blank">Link &otilde;piobjektile</a><?	
		break;
		default: ?>     
    <a href="http://www.fyysika.ee/omad/exp_print.php?domain=exp&id=<? echo $line["id"];?>" target="_blank">Link &otilde;piobjektile</a>&nbsp;<? 
		break;
	}
		
	if ($line["gpid_demo"]==37 or $line["gpid_demo"]==6) 
	{ ?>
		<a href="http://www.fyysika.ee/omad/media/exp_docs/EksperimentETAG<? echo $line["id"];?>.docx">doc</a> <?
	}
	if ($line["gpid_demo"]==5 or $line["gpid_demo"]==7 or $line["gpid_demo"]==1) 
	{ 
	?><a href="http://www.fyysika.ee/omad/media/exp_videod/<? echo $line["id"];?>.mp4">Lae alla</a>
    
    <? } ?>
    </td>
    <td width="138" ><? if ($line["veeb_pilt_url"]) {?><a href="https://www.youtube.com/v/<? echo $line["id_youtube"]; ?>" target=_blank><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" width="100" style="background-color: #CCCCCC" /></a><? } ?>
    
    
    </td>
  </tr>



	
	
<?	$count++;
}
}

	?></table>


