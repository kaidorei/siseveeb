<table border="0" cellpadding="3" cellspacing="0" bordercolor="#FF0000" class="options">

  <tr> 

      <?



	$ar=array("arve_disp","arve_table","reis_disp","pacs_disp","tehno_table","isik_disp","job_table","foorum_table","exp_table","etendus_table","etendus_disp", "uudis_disp","uudis_table","exp_disp","raamatX_table","raamatX_disp", "aine_disp","test_table", "test_disp","exp_tree","expb_table","vahendid_table","vahendid_disp", "toot_table","isik_table","kool_table","koolt_table","koolt_disp","kool_disp","reis_table", "pacs_table","tool_table","firma_table","teadus_table", "nupula_table", "nupula_disp", "krono_disp", "krono_table", "masin_table", "masin_disp", "avaldus_table","avaldus_disp", "promo_table", "promo_disp", "chapter_table", "chapter_disp","valem_table","valem_disp","pohivara_table","pohivara_disp","raamat_table","raamat_disp","oskus_disp","oskus_table","toend_table","toend_disp","uurimus_table","uurimus_disp","raamat_tree");



	$dom=substr($page,0,strpos($page,"_"));

	$taga=substr($page,strpos($page,"_")+1,10);

	if(in_array($page,$ar)){







//echo "asi", $taga;





//if ($dom=="expb") {$dom="exp";}?>





      <td><input class="button" type="submit" name="Submit" value="Otsi :" >

    <td><input size="10"  class="button" type="textfield" name="search_str" value="<? 

	

	$search_str=$_POST["search_str"];

	echo $search_str;

	

	?>"></td>

 <td><? if($dom!="foorum"&&$dom!="reis"&&$dom!="job"&&$dom!="expb"&&$on_otsing!=1&&$dom!="arve"){?><input class="button" type="button" name="Submit3" value="Lisa" onClick="document.location.href='index.php?page=<? echo $dom."_disp&action=new"; ?>&aasta=<? echo $aastakene;?><? if($kat) {?>&kat=<? echo $kat; }?>'"><? }?><? if($dom=="arve"){?><input class="button" type="button" name="Submit3" value="Lisa" onClick="document.location.href='index.php?page=<? echo $dom."_disp&action=new"; ?>&aasta=<? echo $aastakene;?>'"><? }?></td>

<? 			if($dom=="vahendid"){



				?>

      <td class="navi" >N&Auml;ITA: </td>

      <td <? if(!$projekt) {?>bgcolor="#DDDDDD"<? }?>><a href="index.php?page=<? echo $dom."_table"; ?>&amp;projekt=koik">Kõik</a></td>

      <td <? if($projekt=="teadusbuss") {?>bgcolor="#DDDDDD"<? }?>><a href="index.php?page=<? echo $dom."_table"; ?>&amp;projekt=teadusbuss">Teadusbuss</a></td>

      <td <? if($projekt=="globe") {?>bgcolor="#DDDDDD"<? }?>><a href="index.php?page=<? echo $dom."_table"; ?>&amp;projekt=globe">Globe</a></td>

      <td <? if($projekt=="opikojad") {?>bgcolor="#DDDDDD"<? }?>><a href="index.php?page=<? echo $dom."_table"; ?>&amp;projekt=opikojad">&Otilde;pikojad</a></td>      

      <td <? if($projekt=="keemia") {?>bgcolor="#DDDDDD"<? }?>><a href="index.php?page=<? echo $dom."_table"; ?>&amp;projekt=keemia">Keemia</a></td>      

    <td <? if($projekt=="tooriist") {?>bgcolor="#DDDDDD"<? }?>><a href="index.php?page=<? echo $dom."_table"; ?>&amp;projekt=tooriist">T&ouml;&ouml;riistad/materjalid/tarvikud</a></td>

    <?		

}



				?>

      <?		

?>     <!-- <td class="navi" >Alamkat: </td>-->

      

      <td bgcolor="#DDDDDD"><? if($liigipilt){?><img height="35" border=0 alt="T&ouml;&ouml;tuba" src="<? echo $liigipilt; ?>" ><? }?><? if($raamatupilt){?><img height="35" border=0 alt="T&ouml;&ouml;tuba" src="<? echo $raamatupilt; ?>" ><? }?></td>

      <?		



			if($dom=="tool"&&$taga=="table"){?>

      <td valign="middle"><img border=0 alt="Leping allkirjastamata, raha saamata" src="image/motik_kavandam.gif" width=15 height=15 >      </td>			

      <td valign="middle">taotlus esitatud, <br>

      raha saamata</td>

<td>      

<img border=0 alt="Leping allkirjastamata, raha käes" src="image/motik_idee.gif" width=19 height=25 ></td>			

      <td valign="middle">allkirjastamata,<br>

        raha käes</td>

<td><img border=0 alt="Leping allkirjastatud, raha saamata" src="image/mad.gif" width=15 height=15 ></td>			

      <td valign="middle">allkirjastatud,<br>

        raha saamata</td>

<td><img border=0 alt="Leping allkirjastatud, raha kaes" src="image/motik_osta.gif" width=33 height=15 ></td>			

      <td valign="middle">      raha k&auml;es<br />

      (allkirjastatud)</td>

<?			}

			if($dom=="kool"){



						//loeme üle külastatud, külastamata ja ette võetud koolid koolid ...



						$query="SELECT id, nimi FROM kool WHERE tyyp=1";

						$result=mysql_query($query);

						$kaidud=0;

						$kaimata=0;

						$labir=0;

						while($line=mysql_fetch_array($result))

						{

							$query1="SELECT id,oid1 FROM reis_kool WHERE oid2=".$line["id"];

							$result1=mysql_query($query1);

							$line1=mysql_fetch_array($result1);		

							if($line1==NULL)

							{

							  $kaimata++;

							}

							else

								{

								// loeme üle koolid, kellega on juba läbirääkimistesse asutud, ehk siis need koolid, mis on kirjas kusagil reisil, mille

								// toimumisaeg on kusagil tulevikus ... teeme seda nädala ja hooaja numbri kaudu, muidu tekib segadus märkimata algusajaga reisidega.		

								$query2="SELECT nadal_nmbr, hooaeg_nmbr FROM reis WHERE id=".$line1["oid1"];

								$result2=mysql_query($query2);

								$line2=mysql_fetch_array($result2);

								

								switch ($line2['hooaeg_nmbr'])

								{

									case "1": $pa=27; $yea=2004; $pl=2; $yel=2005; $hooaeg=1; $nihe=14; break;

									case "2": $pa=26; $yea=2005; $pl=1; $yel=2006; $hooaeg=2; $nihe=0; break;

									case "3": $pa=25; $yea=2006; $pl=31; $yel=2007; $hooaeg=3; $nihe=0; break;

								}

									$aastaalgus  = date("Y-m-d", mktime (0,0,0,12  ,$pa+($line2["nadal_nmbr"]+1)*7,$yea));

												

									if($aastaalgus < date("Y-m-d")){ 

									  	$kaidud++;

										}else{ 

										$labir++;

										} 

							  

							}

						}

				?>

      <td valign="middle"><a href="index.php?page=<? echo $dom."_table"; ?>&sel=3" >Käidud KOOLE</a>: <? echo $kaidud;?></td>

       <td valign="middle"><a href="index.php?page=<? echo $dom."_table"; ?>&sel=2" ><img border=0 alt="On alustatud läbirääkimistega " src="image/motik_toos.gif" width=19 height=19 ></a></td>

      <td valign="middle"><a href="index.php?page=<? echo $dom."_table"; ?>&sel=5" ><img src="image/globe.gif" border="0" alt="globe" width="25" height="25" /></a></td>

      <td valign="middle"><a href="index.php?page=<? echo $dom."_table"; ?>&sel=10" ><img src="image/fkb.png" border="0" alt="globe"  /></a></td>

      <?		



			}

if ($dom=="expb"|| $dom=="exp" && $taga=="table") { ?>

      <?php /*?><td><input class="button" type="submit" name="Submit" value="Otsi YouTube ID :" ></td>

      <td><input size="10"  class="button" type="textfield" name="search_YTID"></td><?php */?>

      <?

			}

		

		if($dom == "reis")

		{

			?>

      <td><input class="button" type="button" name="Submit2" value="2005" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2005'"></td>

      <td><input class="button" type="button" name="Submit4" value="2006" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2006'"></td>

      <td><input class="button" type="button" name="Submit4" value="2007" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2007'"></td>

      <td><input class="button" type="button" name="Submit4" value="2008" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2008'"></td>

      <td><input class="button" type="button" name="Submit4" value="2009" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2009'"></td>

      <td><input class="button" type="button" name="Submit4" value="2010" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2010'"></td>

      <td><input class="button" type="button" name="Submit4" value="2011" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2011'"></td>

      <td><input class="button" type="button" name="Submit4" value="2012" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2012'"></td><td><input class="button" type="button" name="Submit4" value="2013" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2013'"></td>

      <td><input class="button" type="button" name="Submit4" value="2014" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2014'"></td><td><input class="button" type="button" name="Submit4" value="2015" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2015'"></td><td><input class="button" type="button" name="Submit4" value="2016" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2016'"></td><td><input class="button" type="button" name="Submit4" value="2017" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&aasta=2017'"></td>

      <?

		}

		if($dom == "masin")

		{?>

			<td><input class="button" type="button" name="Submit2" value="Töötlemata kutsed" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&all=0'"></td>

			<td>

            

            

            

<? 

			$query2="SELECT id,nimi_est FROM etendus WHERE on_kutsed=1 ORDER BY id;";

			$result2=mysql_query($query2);

			echo "<select id=\"myid\"  class=\"fields\" name=\"etendus_id\" onchange=\"document.location.href='index.php?page=".$dom."_table&etendus_id=' + this.value\">";

			echo "<option value=\"0\"></option>"; 

				while($var=mysql_fetch_array($result2)){

					if($var["id"]==$line["etendus_id"]) { $sel="selected"; } else { $sel="";}

						echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["nimi_est"]."</option>"; 

				}

					echo "</select>";

		  ?>            

            

            <script type="text/javascript">

  				document.getElementById('myid').value = "<?php echo $_GET['etendus_id'];?>";

			</script>

            

            

            </td>			

			<td><input class="button" type="button" name="Submit2" value="Näita kõiki" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&all=1'"></td>

		<? }

		if($dom == "isik")

		{

			?>

      <td><input class="button" type="button" name="Submit2" value="TB" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&liik=1'"></td>

      <td><input class="button" type="button" name="Submit3" value="EFS" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&liik=2'"></td>

      <td><input class="button" type="button" name="Submit4" value="FI" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&liik=3'"></td>

     <td><input class="button" type="button" name="Submit4" value="NU" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&liik=9'"></td>

     <td><input class="button" type="button" name="Submit44" value="GLOBEõp" onclick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&liik=5'" />     </td>

     <td><input class="button" type="button" name="Submit45" value="Füüsikaõp" onclick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&liik=4'" /></td>

     <td><input class="button" type="button" name="Submit4" value="KEEMIA&otilde;p" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&liik=6'"></td>

     <td><input class="button" type="button" name="Submit4" value="BIO&otilde;p" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&liik=7'"></td>

     <td><input class="button" type="button" name="Submit4" value="GEO&otilde;p" onClick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&liik=8'"></td>

      <td><input class="button" type="button" name="Submit43" value="K&otilde;ik" onclick="document.location.href='index.php?page=<? echo $dom."_table"; ?>&liik=100'" /></td>

      <?

		}

		if($dom == "masin" or $dom == "kool")

		{

			?>

      <?

		}

	}



	 if ($dom=="pohivara"){}		

	 

		?>

  </tr>

</table>























