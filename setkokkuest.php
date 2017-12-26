<? 
require_once 'header.php';
//$expid=$_GET["id"];
$query_temp="SELECT * FROM exp WHERE id=".$expid;
//		echo $query_temp;

//	echo $query;
$result_temp=mysql_query($query_temp);
$line_temp=mysql_fetch_array($result_temp); 

//$gpid_demo=$line_temp["gpid_demo"];
//echo $gpid_demo;

//echo "sdf ",$gpid_demo;
///////////////////////////////////////////////////////////////////////////////////////////////////////						
// Väljundi kirjutamine väljale kokku_est - see on selle õpiobjekti kontekstist sõltumatu väljanägemine

		$mudel="";
		switch($line_temp["gpid_demo"])
		{
			case 2: //simulatsioon
				$mudel=$line_temp["seletus_est"]."<img src=\"http://ucukawu.havike.eenet.ee/wordpress/wp-content/uploads/2014/06/ETAg_TeaMe_EL-Sotsiaalfond_v.jpg\" class=\"header-image\" width=\"700\" height=\"133\" alt=\"\" /><br><span class=\"navi\"><a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/4.0/\"><img alt=\"Creative Commonsi litsents\" style=\"border-width:0\" src=\"https://i.creativecommons.org/l/by-sa/4.0/88x31.png\" /></a><br />See teos on litsentseeritud <a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/3.0/\">Creative Commonsi Autorile viitamine + Jagamine samadel tingimustel 3.0 Rahvusvaheline litsentsiga</a></span>";
				$valjund = 	$mudel;
				$valjund_print = $mudel;
			break;
			case 1: // videod
			case 4:
			case 5:
			case 7:
				$mudel="<iframe align=\"middle\" width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/".$line_temp["id_youtube"]."\" frameborder=\"0\" allowfullscreen></iframe><br><img src=\"http://ucukawu.havike.eenet.ee/wordpress/wp-content/uploads/2014/06/ETAg_TeaMe_EL-Sotsiaalfond_v.jpg\" class=\"header-image\" width=\"700\" height=\"133\" alt=\"\" /><br><span class=\"navi\"><a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/4.0/\"><img alt=\"Creative Commonsi litsents\" style=\"border-width:0\" src=\"https://i.creativecommons.org/l/by-sa/4.0/88x31.png\" /></a><br />See teos on litsentseeritud <a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/3.0/\">Creative Commonsi Autorile viitamine + Jagamine samadel tingimustel 3.0 Rahvusvaheline litsentsiga</a></span>";
				$valjund = 	$mudel;
				$valjund_print = $mudel;
			break;
			
			case 6: // laboritöö - pannakse järjekorda tegumi sammude välisvaated.
				$sammud="<p><strong><h1>".$line_temp["nimi_est"]."</h1></strong></p><p>".$line_temp["kirjeldus_est"]."</p> ";			       
				$query_vahh="SELECT * FROM exp_exp WHERE oid1=".$expid." order by order1";
				//echo $query_vahh;
				$result_vahh=mysql_query($query_vahh);
				$sammud=$sammud."<p>";
				$count_row=0;
				while($line_vahh=mysql_fetch_array($result_vahh))
				{
					//echo $line_vahh["oid2"];
					$query_vahh1="SELECT * FROM exp WHERE id=".$line_vahh["oid2"];
					$result_vahh1=mysql_query($query_vahh1);
					$line_vahh1=mysql_fetch_array($result_vahh1);
					if($line_vahh1["gpid_demo"]==9)
					{
						if(!$line_vahh["title1"])
						{
							$text_out = $line_vahh1["kirjeldus_est"];
							//echo $text_out;
						}
						else
						{
							$text_out = $line_vahh["title1"];
							//echo $text_out;
						}
						$sammud=$sammud."<table align=\"center\" cellpadding=\"5\" width=\"100%\" border=\"0\">
  <tr>
    <td width=\"5%\"><img alt=\"".$line_vahh1["nimi_est"]."\" style=\"border-width:0\" src=\"".urldecode($line_vahh1["veeb_pilt_url"])."\" /></td>
    <td valign=\"top\" width=\"95%\">".$text_out."</td>
  </tr>
</table>";
					}
					else
					{
						$sammud=$sammud."".$line_vahh1["kokku_est"];
					}
					$count_row++;
					//echo $count_row;
				}

				$sammud=$sammud."</p>";
				$sammud=$sammud."<img src=\"http://ucukawu.havike.eenet.ee/wordpress/wp-content/uploads/2014/06/ETAg_TeaMe_EL-Sotsiaalfond_v.jpg\" class=\"header-image\" width=\"700\" height=\"133\" alt=\"\" /><br><span class=\"navi\"><a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/4.0/\"><img alt=\"Creative Commonsi litsents\" style=\"border-width:0\" src=\"https://i.creativecommons.org/l/by-sa/4.0/88x31.png\" /></a><br />See teos on litsentseeritud <a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/3.0/\">Creative Commonsi Autorile viitamine + Jagamine samadel tingimustel 3.0 Rahvusvaheline litsentsiga</a></span>";	
				$valjund = 	$sammud;
				$valjund_print = $sammud;
			
			break;
			
			case 8: // 3D 
				$mudel="<iframe align=\"middle\" width=\"640\" height=\"480\" frameborder=\"0\" allowFullScreen webkitallowfullscreen mozallowfullscreen src=\"https://sketchfab.com/models/".$line_temp["id_3D"]."/embed?ui_infos=0\"></iframe><br><img src=\"http://ucukawu.havike.eenet.ee/wordpress/wp-content/uploads/2014/06/ETAg_TeaMe_EL-Sotsiaalfond_v.jpg\" class=\"header-image\" width=\"700\" height=\"133\" alt=\"\" /><br><span class=\"navi\"><a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/4.0/\"><img alt=\"Creative Commonsi litsents\" style=\"border-width:0\" src=\"https://i.creativecommons.org/l/by-sa/4.0/88x31.png\" /></a><br />See teos on litsentseeritud <a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/3.0/\">Creative Commonsi Autorile viitamine + Jagamine samadel tingimustel 3.0 Rahvusvaheline litsentsiga</a></span>";			
				$valjund = 	$mudel;
				$valjund_print = $mudel;
			break;
			
			case 9: //pilt
				$mudel="<table align=\"center\" cellpadding=\"5\" width=\"100%\" border=\"0\">
  <tr>
    <td width=\"5%\"><img alt=\"".$line_temp["nimi_est"]."\" style=\"border-width:0\" src=\"".urldecode($line_temp["veeb_pilt_url"])."\" /></td>
    <td valign=\"top\" width=\"95%\">".$line_temp["kirjeldus_est"]."</td>
  </tr>
</table>
";
				$valjund = 	$mudel;
				$valjund_print = $mudel;
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
			
			
			case 31: // valemivärk
				$query_liik="SELECT * FROM `exp_grupid_demo` WHERE id=".$line_temp["gpid_demo"];
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
				
			break;
					
			case 20: // igasugused kontrollküsimused
			case 21: 
			case 23: 
			case 24: 
			case 25: 
			case 27: 
			case 29: 
			case 30: 
			case 32: 
				$query_liik="SELECT * FROM `exp_grupid_demo` WHERE id=".$line_temp["gpid_demo"];
				$result_liik=mysql_query($query_liik);
				$liik=mysql_fetch_array($result_liik); 

			
				
				$mudel="<table align=\"center\" cellpadding=\"5\" width=\"100%\" border=\"0\">
  <tr>
    <td width=\"5%\"><img width=\"100\" alt=\"ikoon\" style=\"border-width:0\" src=\"".urldecode($liik["ico_url_v"])."\" /></td>
    <td valign=\"top\" width=\"95%\">".$mudel=$line_temp["probleem_est"]."</td>
  </tr>
</table>
";
				$valjund = 	$mudel;
				$valjund_print = $mudel;
			break;

			case 35: // katsevahendite loend

					       
				$query_vahh="SELECT * FROM exp_vahendid WHERE oid1=".$expid;
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
					if($line_vahh["title1"])
					{
					$katsevahendid=$katsevahendid."".$line_vahh["title1"]."";
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
			
			case 40:
				$query_vahh="SELECT * FROM exp_exp WHERE oid1=".$expid." AND meta1=2 order by order1";
				//echo $query_vahh;
				$result_vahh=mysql_query($query_vahh);
				$sammud=$sammud."<p>";
				$count_row=0;
				while($line_vahh=mysql_fetch_array($result_vahh))
				{
					
					$query_vahh1="SELECT seletus_est FROM exp WHERE id=".$line_vahh["oid2"];
					//echo $line_vahh["oid2"]."".$query_vahh1;
					$result_vahh1=mysql_query($query_vahh1);
					$line_vahh1=mysql_fetch_array($result_vahh1);
					$sammud=$sammud."".$line_vahh1["seletus_est"];
					$count_row++;
					//echo $line_vahh1["seletus_est"];
				}

				$sammud=$sammud."</p>";
				$valjund = 	$sammud;
				
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

				$valjund = $tykid_uus;
				$valjund_print = $tykid_uus;
//				echo $valjund;

			break;
			
		}
						
/*						

						if($_POST["gpid_demo"]>19)
						{
							$tykid_uus_3="<iframe src=\"http://opik3.fi.tartu.ee/index.php/question/getquestion/?id=765%3b\" width=\"720\" height=\"640\"></iframe>";
						}
*/






	
$query1414="UPDATE exp SET kokku_est='".$db->real_escape_string($valjund)."' WHERE id=".$expid;
//echo $query1414;
$result1414=mysql_query($query1414);
$query1415="UPDATE exp SET kokkuprint_est='".$db->real_escape_string($valjund_print)."' WHERE id=".$expid;
$result1415=mysql_query($query1415);
        
        
        
        
?>