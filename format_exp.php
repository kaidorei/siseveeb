<?

require_once 'header.php';
mb_internal_encoding('UTF-8');
include("connect.php");
require_once("globals.php");

function make_exp($expid,$kat,$db)
{
echo "*";

//$line_temp["id"]=$_GET["id"];
$query_temp="SELECT * FROM exp WHERE id = ".$expid." LIMIT 1";
//echo $query_temp."<br>";
//	echo $query;
$result_temp=mysql_query($query_temp);
$line_temp=mysql_fetch_array($result_temp);


// Kui ei ole raamatX objekti, aga kui peaks, siis teeme, raamatX objekti
	if(!$line_temp["raamatX_id"])
	{
			echo "teen puuduva raamatX objekti ...";
			$query_insert="INSERT INTO raamatX (nimi_est,pid,book_id) VALUES ('".$line_temp["nimi_est"]."','2','')";
			$tmp=mysql_query($query_insert);
			$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
			$raamatX_id=$tmp["last_insert_id()"];
			$query_link="UPDATE exp set raamatX_id=".$raamatX_id." WHERE id=".$line_temp["id"]."";
			//echo $query_insert, $query_link,"<br><br>";
			$result_link=mysql_query($query_link);
			$line_temp["raamatX_id"] = $raamatX_id;
	}


//$gpid_demo=$line_temp["gpid_demo"];

//echo $gpid_demo;
//echo "sdf ",$gpid_demo;
// Väljundi kirjutamine väljale kokku_est - see on selle õpiobjekti kontekstist sõltumatu väljanägemine

		$mudel="";

		switch($line_temp["gpid_demo"])

		{

			case 2: //simulatsioon
				$mudel=$line_temp["seletus_est"]."";
				$valjund = 	$mudel;
				$valjund_print = $mudel;
			break;

			case 1: // videod
			case 4:
			case 5:
			case 7:
				$mudel="<iframe align=\"middle\" width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/".$line_temp["id_youtube"]."\" frameborder=\"0\" allowfullscreen></iframe><br>";
				$valjund = 	$mudel;
				$valjund_print = $mudel;
			break;

///////////////////// laboritöö - pannakse järjekorda tegumi sammude välisvaated.
			case 6:
			// Puhastame raamatX_exp kirjetest ...
				if($line_temp["raamatX_id"])

				{
					$query_e="DELETE FROM raamatX_exp where oid1=".$line_temp["raamatX_id"];
					$result_e=mysql_query($query_e);
				}
				else
				{
					echo "<br>raamatX_id on määramata ... <br>";
				}

				echo $query_e."<br><br>";

				// Loeme eksperimendivahendid kokku:

				$query_vahh="SELECT * FROM exp_exp WHERE oid1=".$line_temp["id"]." AND naita_veebis=1 order by sort_order";
				//echo $query_vahh;
				$result_vahh=mysql_query($query_vahh);
//				$sammud=$sammud."<p>";
				$count_vahh=1;
				$vahendid="<p>";

				while($line_vahh=mysql_fetch_array($result_vahh))
				{
				$query_exp="SELECT * FROM exp WHERE id=".$line_vahh["oid2"]." LIMIT 1";
				$result_exp=mysql_query($query_exp);
				$line_exp=mysql_fetch_array($result_exp);
				if($line_exp["gpid_demo"]==35)

				{
					if(!$line_vahh["title_est"])
					{
						$query_ee = "UPDATE exp_exp set title_est = '".$db->real_escape_string($line_exp["nimi_est"])."' WHERE id = ".$line_vahh["id"]." LIMIT 1";
						echo $query_ee;
						$result_ee=mysql_query($query_ee);
					}

					echo $query_exp."<br><br>";
					$vahend = strip_tags($line_vahh["title_est"],'<sub></sub><sup></sup>');
					$vahendid=$vahendid."".$count_vahh.". ".$vahend."</br>";
					$count_vahh++;
				}
				}
				$vahendid=$vahendid."</p>";

				echo "VAHENDIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIID".$vahendid."<br>";
				$sammud=$line_temp["kirjeldus_est"];

				if(strlen($vahendid)>10)
				{
					$sammud=$sammud."<p><b>Vahendid:</b></p>".$vahendid;
				}

				$query_vahh="SELECT * FROM exp_exp WHERE oid1=".$line_temp["id"]." AND naita_veebis=1 order by sort_order";
				//echo $query_vahh;
				$result_vahh=mysql_query($query_vahh);
//				$sammud=$sammud."<p>";
				$count_row=0;
				$count_juhis=1;
				$sammud=$sammud."<p><b>Protseduur:</b></p>";

				while($line_vahh=mysql_fetch_array($result_vahh))
				{
				$query_exp="SELECT * FROM exp WHERE id=".$line_vahh["oid2"]." LIMIT 1";
				echo $query_exp."<br><br>";
				$result_exp=mysql_query($query_exp);
				$line_exp=mysql_fetch_array($result_exp);
				switch($line_exp["gpid_demo"])
				{
					case 15:
					$vahe = strip_tags($line_exp["kirjeldus_est"],'<sub></sub><sup></sup>');
					if(1) //vahet ei ole, kas pildid on või mitte, näitame teksti
					{
					if(!$line_vahh["meta"])
					{
						$sammud=$sammud."<p>".$count_juhis.". ".$vahe."</p>";
						$count_juhis++;
					}
					else
					{
						$sammud=$sammud."<p><b>".$line_vahh["meta"]." </b> ".$vahe."</p>";
						$count_juhis++;
					}
					}
					else
					{
						$sammud=$sammud."<p>[[".$line_vahh["oid2"]."]]</p>";
					}
					break;
					case 9:
					$sammud=$sammud."<p>[{[".$line_vahh["oid2"]."]}]</p>";
					break;
					case 35:
					break;

					default: $sammud=$sammud."<p>[[".$line_vahh["oid2"]."]]</p>";
					break;
				}
				}
				$valjund = 	$sammud;

				$valjund_print = $sammud;
			break;
/////////////////////////////
			case 30: // SEERIAÜLESANNE
			case 37: // SEERIAÜLESANNE
				// Puhastame raamatX_exp kirjetest ...
				if($line_temp["raamatX_id"])
				{
					$query_e="DELETE FROM raamatX_exp where oid1=".$line_temp["raamatX_id"];
					$result_e=mysql_query($query_e);
				}
				else
				{
					echo "<br>raamatX_id on määramata ... <br>";
				}
				echo $query_e."<br><br>";
				//$sammud=$line_temp["probleem_est"];
				$query_vahh="SELECT * FROM exp_exp WHERE oid1=".$line_temp["id"]." AND naita_veebis=1 order by sort_order";
				$result_vahh=mysql_query($query_vahh);
				$sammud = strip_tags($line_temp["probleem_est"],'<sub></sub><sup></sup>');
				$count_row=0;
				$count_juhis=1;

				while($line_vahh=mysql_fetch_array($result_vahh))

				{

				// teeme uued kirjed raamatX_exp tabelisse
				$query_exp="SELECT * FROM exp WHERE id=".$line_vahh["oid2"]." LIMIT 1";
				echo $query_exp."<br><br>";
				$result_exp=mysql_query($query_exp);
				$line_exp=mysql_fetch_array($result_exp);
				switch($line_exp["gpid_demo"])
				{
					case 15:
					$vahe = strip_tags($line_exp["seletus_est"],'<sub></sub><sup></sup>');
					if(!$line_vahh["meta"])
					{
					$sammud=$sammud."<p>".$count_juhis.". ".$vahe."</p>";
					$count_juhis++;
					}
					else
					{
					$sammud=$sammud."<p><b>".$line_vahh["meta"]." </b> ".$vahe."</p>";
					$count_juhis++;
					}
					break;

					case 9:
					$sammud=$sammud."<p>[{[".$line_vahh["oid2"]."]}]</p>";
					break;

					case 35:
					break;

					default: $sammud=$sammud."<p>[[".$line_vahh["oid2"]."]]</p>";
					break;
				}
				}
				$valjund = 	$sammud;
				$valjund_print = $sammud;
			break;
////////////////////////////////////////////
			case 8: // 3D
				$mudel="<iframe align=\"middle\" width=\"640\" height=\"480\" frameborder=\"0\" allowFullScreen webkitallowfullscreen mozallowfullscreen src=\"https://sketchfab.com/models/".$line_temp["id_3D"]."/embed?ui_infos=0\"></iframe><br>";
				$valjund = 	$mudel;
				$valjund_print = $mudel;
			break;
//////////////////////////////////////////////////
			case 9: //pilt
			break;

 			case 15: //tekst

			if($line_temp["seletus_est"]==0)

			{

				$valjund = 	$line_temp["seletus_est"];

			//asendan valemid ...

				$tykid_uus = NULL;

				$tykid_vv=explode("@{", $valjund);

				$tykid_uus=$tykid_vv[0];

				for($ii = 1; $ii < sizeof($tykid_vv); ++$ii)

				{

					$tykid_vv2=explode("}@", $tykid_vv[$ii]);

					//echo $tykid_vv2[0]," ";

					$query_valem="SELECT * FROM valem WHERE id=". $tykid_vv2[0]." LIMIT 1";

					$result_valem=mysql_query($query_valem);

					$line_valem=mysql_fetch_array($result_valem);

					//echo $line_valem["tex"];

					//echo preg_replace('#\@\{(.*)\}\@#', 'kaido',$tykid_vv[$ii]);





					$tykid_uus= $tykid_uus."<table width=\"100%\" border=\"0\" cellpadding=\"0\"><tr><td width=\"99%\" valign=\"middle\">";

					$tykid_uus= $tykid_uus."<img src=\"http://www.fyysika.ee/omad/media/valem_pildid/".$line_valem["image"]."\"> </td><td align=\"right\" valign=\"middle\">".$line_valem["nimi"]."</td></tr></table>";

					$tykid_uus= $tykid_uus."".$tykid_vv2[1];

				}

			//asendan exp asjad ...

				$tykid_uus_2 = NULL;

				$tykid_vv=explode("[{[", $tykid_uus);

				$tykid_uus_2=$tykid_vv[0];

				for($ii = 1; $ii < sizeof($tykid_vv); ++$ii)

				{

					$tykid_vv2=explode("]}]", $tykid_vv[$ii]);

					//echo $tykid_vv2[0]," ";

					$query_pilt="SELECT * FROM exp WHERE id=". $tykid_vv2[0]." LIMIT 1";

					$result_pilt=mysql_query($query_pilt);

					$line_pilt=mysql_fetch_array($result_pilt);

					//echo $line_valem["tex"];

					//echo preg_replace('#\@\{(.*)\}\@#', 'kaido',$tykid_vv[$ii]);





					$tykid_uus_2= $tykid_uus_2."<table align=\"right\" width=\"40\" border=\"0\" cellpadding=\"0\"><tr><td width=\"99%\" valign=\"middle\">";

					$tykid_uus_2= $tykid_uus_2."<img src=\"http://www.fyysika.ee/omad/".urldecode($line_pilt["veeb_pilt_url"])."\"> </td><td align=\"right\" valign=\"middle\"></td></tr></table>";

					$tykid_uus_2= $tykid_uus_2."".$tykid_vv2[1];

				}



			//asendan pildid asjad ...

				$tykid_uus_3 = NULL;

				$tykid_vv=explode("[img]", $tykid_uus);

				$tykid_uus_3=$tykid_vv[0];

				$img_id=NULL;

				$img_align=NULL;

				$img_width=NULL;

				$img_height=NULL;



				for($ii = 1; $ii < sizeof($tykid_vv); ++$ii)

				{

					$tykid_vv3=explode("[/img]", $tykid_vv[$ii]);

					//echo $tykid_vv2[0]," ";



// Eraldame välja align, laius, kõrgus

					$tykid_vv4=explode(",", $tykid_vv3[0]);

					$img_id=$tykid_vv4[0];

					$img_align=$tykid_vv4[1];

					$img_width=$tykid_vv4[2];

					$img_height=$tykid_vv4[3];





					$query_pilt="SELECT * FROM exp_pildid WHERE id=".$img_id." LIMIT 1";

					//echo $query_pilt;

					$result_pilt=mysql_query($query_pilt);

					$line_pilt=mysql_fetch_array($result_pilt);

					//echo $line_valem["tex"];

					//echo preg_replace('#\@\{(.*)\}\@#', 'kaido',$tykid_vv[$ii]);





					$tykid_uus_3= $tykid_uus_3."<table cellpadding=\"5\" align=\"".$img_align."\" width=\"40\" border=\"0\" cellpadding=\"0\"><tr><td width=\"10%\" valign=\"left\">";



// hädavariant igasugu gif'ide jms, kuna veebipildi tegemise aken ei oska nende failidega midagi mõistlikku peale hakata. Kui ei ole veebipilti, siis kasutan originaali.



					if($line_pilt["veeb_pilt_url_s"])

					{

					$img_file=$line_pilt["veeb_pilt_url_s"];

					}

					else

					{

					$img_file=$line_pilt["url"];

					}

					$tykid_uus_3= $tykid_uus_3."<img src=\"http://www.fyysika.ee/omad/".urldecode($img_file)."\" width=\"".$img_width."\" height=\"".$img_height."\"> </td><td align=\"left\" valign=\"middle\"></td></tr></table>";

					$tykid_uus_3= $tykid_uus_3."".$tykid_vv3[1];

				}

				$valjund = 	$tykid_uus_3;

			}

			else

			{

				$valjund = "";

			}

			break;
///////////////////////////////////////////////////////////7
			case 31: // valemivärk
/*				$query_liik="SELECT * FROM `exp_grupid_demo` WHERE id=".$line_temp["gpid_demo"];
				$result_liik=mysql_query($query_liik);
				$liik=mysql_fetch_array($result_liik);
				$mudel="<table align=\"center\" cellpadding=\"5\" width=\"100%\" border=\"0\">
  <tr>
    <td align=\"left\" width=\"100%\">".$line_temp["nimi_est"]."</td>
  </tr> <tr>
    <td align=\"center\" width=\"100%\"><img alt=\"".$line_temp["nimi_est"]."\" style=\"border-width:0\" src=\"media/valem_pildid/".urldecode($line_temp["image"])."\" /></td>
  </tr>
</table>
";
				$valjund = 	$mudel;
				$valjund_print = $mudel;
	*/
			break;
////////////////////////////////////////////////////////////////////////////////////
			case 20: // igasugused kontrollküsimused, va probleemülesanne
			case 23:
			case 24:
			case 25:
			case 27:
			case 29:
			case 30:
			case 32:

			// Otsin väga ümber nurga viisil pilte - üle objektide while, kontrollitakse, kas mõni on pilt
							$query_vahh="SELECT * FROM exp_exp WHERE oid1=".$line_temp["id"]." AND naita_veebis=1 order by sort_order";

							//echo $query_vahh;
							$result_vahh=mysql_query($query_vahh);
							$count_juhis=1;
							$mudel="";
							while($line_vahh=mysql_fetch_array($result_vahh))
							{
							$query_exp="SELECT * FROM exp WHERE id=".$line_vahh["oid2"]." LIMIT 1";
							//echo $query_exp."<br><br>";
							$result_exp=mysql_query($query_exp);
							$line_exp=mysql_fetch_array($result_exp);

			// kui alamobjektiks on pilt, siis pane see kõige algusesse. Ehk siis üks ülesanne-üks pilt piirang.
							switch($line_exp["gpid_demo"])
							{
								case 9:
								$mudel=$mudel."<p>[{[".$line_vahh["oid2"]."]}]</p>";
								break;
								default:
								break;
							}
							}




				$mudel=$mudel."".$line_temp["nimi_est"];
				$valjund = 	$mudel;
				$valjund_print = $mudel;
			break;


////////////////////////////////////////////////////////////
// Lahendusega ülesanded

			case 21:
			case 34:
			case 40:
				$query_liik="SELECT * FROM `exp_grupid_demo` WHERE id=".$line_temp["gpid_demo"];
				$result_liik=mysql_query($query_liik);
				$liik=mysql_fetch_array($result_liik);

// Otsin väga ümber nurga viisil pilte - üle objektide while, kontrollitakse, kas mõni on pilt
				$query_vahh="SELECT * FROM exp_exp WHERE oid1=".$line_temp["id"]." AND naita_veebis=1 order by sort_order";

				//echo $query_vahh;
				$result_vahh=mysql_query($query_vahh);
				$count_juhis=1;
				$mudel="";
				while($line_vahh=mysql_fetch_array($result_vahh))
				{
				$query_exp="SELECT * FROM exp WHERE id=".$line_vahh["oid2"]." LIMIT 1";
				//echo $query_exp."<br><br>";
				$result_exp=mysql_query($query_exp);
				$line_exp=mysql_fetch_array($result_exp);

// kui alamobjektiks on pilt, siis pane see kõige algusesse. Ehk siis üks ülesanne-üks pilt piirang.
				switch($line_exp["gpid_demo"])
				{
					case 9:
					$mudel=$mudel."<p>[{[".$line_vahh["oid2"]."]}]</p>";
					break;
					default:
					break;
				}
				}
// Otsin väga ümber nurga viisil lahendust - üle objektide while, kontrollitakse, kas mõni on gpid_demo = 43
//				$mudel=$mudel."<p>".strip_tags($line_temp["probleem_est"],'<sub></sub><sup></sup>')."</p>";
				$mudel=$mudel."".$line_temp["nimi_est"];
				$query_vahh="SELECT * FROM exp_exp WHERE oid1=".$line_temp["id"]." AND naita_veebis=1 order by sort_order";
				//echo $query_vahh;
				$result_vahh=mysql_query($query_vahh);
//				$sammud=$sammud."<p>";
				$count_row=0;
				while($line_vahh=mysql_fetch_array($result_vahh))
				{
				$query_exp="SELECT * FROM exp WHERE id=".$line_vahh["oid2"]." LIMIT 1";
				//echo $query_exp."<br><br>";
				$result_exp=mysql_query($query_exp);
				$line_exp=mysql_fetch_array($result_exp);
				switch($line_exp["gpid_demo"])
				{
					case 43:
								$mudel=$mudel."<p><strong><em>".$line_exp["nimi_est"]."</em></strong></p>";
								$query_rx="SELECT * FROM raamatX WHERE id=".$line_exp["raamatX_id"]." LIMIT 1";
								echo $query_rx."<br><br>";
								$result_rx=mysql_query($query_rx);
								$line_rx=mysql_fetch_array($result_rx);
								if($line_rx["tekst_est"])
								{
									$mudel=$mudel."".$line_rx["tekst_est"]."";
								}
					break;
					default:
					break;
				}
				}
				$valjund = 	$mudel;
				$valjund_print = $mudel;
			break;
///////////////////////////////////////////////////////////////////////////////////////////////
			case 35: // katsevahendite loend
				$query_vahh="SELECT * FROM exp_vahendid WHERE oid1=".$line_temp["id"];
				$result_vahh=mysql_query($query_vahh);
				$count_row=0;
				$katsevahendid="<table width=\"100%\">";
				$katsevahendid=$katsevahendid."<tr><td><strong>Katsevahendid ja materjalid</strong></tr></td> ";
				while($line_vahh=mysql_fetch_array($result_vahh))
				{
					//echo $line_vahh["oid2"];
					$query_vahh1="SELECT * FROM vahendid WHERE id=".$line_vahh["oid2"];
					$result_vahh1=mysql_query($query_vahh1);
					$line_vahh1=mysql_fetch_array($result_vahh1);
					$katsevahendid=$katsevahendid."<tr><td>";
					if($line_vahh["title_est"])
					{
					$katsevahendid=$katsevahendid."".$line_vahh["title_est"]."";
					}
					else
					{
					$katsevahendid=$katsevahendid."".$line_vahh1["nimi_est"]."";
					}
					$katsevahendid=$katsevahendid."</td></tr>";
					$count_row++;
				}
				$katsevahendid=$katsevahendid."</table>";
				$valjund = 	$katsevahendid;
				$valjund_print = $katsevahendid;
			break;

			//////KOOLID//////////////////////////////////////////////////
			// panen kirjete põhjal kokku põhiinfo
						case 51:
						$query_temp="SELECT * FROM kool WHERE id = '".$line_temp["ext_id"]."'";
						echo $query_temp."<br>";
						//	echo $query;
						if($result = $db->query($query_temp)) {
							$row = $result->fetch_row();
						//	echo ' (' . $row[0] . ')';
						} else {
							trigger_error('MySQL error: ' . $db->error, E_USER_WARNING);
							trigger_error('Related query: ' . $query, E_USER_NOTICE);
						}
						$valjund = 	"Aadress";
					break;
			//////ISIK//////////////////////////////////////////////////
			// panen kirjete põhjal kokku põhiinfo
						case 53:
						$query_temp="SELECT * FROM isik WHERE id = '".$line_temp["ext_id"]."'";
						echo $query_temp."<br>";
							echo $query;
						if($result = $db->query($query_temp)) {
							$row = $result->fetch_row();
						//	echo ' (' . $row[0] . ')';
						} else {
							trigger_error('MySQL error: ' . $db->error, E_USER_WARNING);
							trigger_error('Related query: ' . $query, E_USER_NOTICE);
						}
						$valjund = 	"Aadress";
						echo $valjund;
					break;
	}

//////////////////////////////////////////////////////////////////////////////77
if($valjund)
{
$query1414="UPDATE raamatX SET tekst_est='".$db->real_escape_string($valjund)."' WHERE id=".$line_temp["raamatX_id"];
$result1414=mysql_query($query1414);
}
 //echo    $line_temp["id"],"nimi: ", $line_temp["nimi_est"];
 ?><a href="exp_print.php?domain=exp&id=<? echo $line_temp["id"];?>" class="menu_punane" target="_blank"><img src="image/ico_exp_15_v.png" alt="print" width="30" height="30" border="0" /></a><?
 //echo   "<br>".$query1414."<br><br>";
}



?>
