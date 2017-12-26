<?  function tabel2($domain,$oid,$login,$sel,$lisa,$pealkiri){

		?>

<link href="scat.css" rel="stylesheet" type="text/css" >

<script>

function muuda_show(seos_id)

{

	var is_checked=1;

	var mylist=document.getElementById("seos_" + seos_id).checked;

	document.getElementById("favorite").value=is_checked + "ja" + seos_id + " ja " + mylist;



	var xmlhttp;



	if (window.XMLHttpRequest)

	  {// code for IE7+, Firefox, Chrome, Opera, Safari

	  xmlhttp=new XMLHttpRequest();

	  }

	else

	  {// code for IE6, IE5

	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

	  }





//	xmlhttp.open("POST","demo_post.asp",true);

//	xmlhttp.send();



	xmlhttp.onreadystatechange=function()

	  {

	  if (xmlhttp.readyState==4 && xmlhttp.status==200)

		{

		document.getElementById("favorite").value=xmlhttp.responseText;

		}



	  }

	if(mylist==true)

	{

		is_checked=1;

	}

	else

	{

		is_checked=0;

	}

	xmlhttp.open("GET","test_table_asp.php?seosid="+seos_id+"&show="+is_checked,true);

	xmlhttp.send();	//mylist.options[mylist.selectedIndex].text;



}





function muuda_order(domain,field,element,seos_id)

{

	var mylist=document.getElementById(element).value;

//	document.getElementById("favorite").value=seos_id + " ja " + mylist;



	var xmlhttp;



	if (window.XMLHttpRequest)

	  {// code for IE7+, Firefox, Chrome, Opera, Safari

	  xmlhttp=new XMLHttpRequest();

	  }

	else

	  {// code for IE6, IE5

	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

	  }





//	xmlhttp.open("POST","demo_post.asp",true);

//	xmlhttp.send();



	xmlhttp.onreadystatechange=function()

	  {

	  if (xmlhttp.readyState==4 && xmlhttp.status==200)

		{

		document.getElementById("favorite").value=xmlhttp.responseText;

		}



	  }



	xmlhttp.open("GET","test_table_asp_order.php?domain="+domain+"&seosid="+seos_id+"&field="+field+"&order="+mylist,true);

	xmlhttp.send();	//mylist.options[mylist.selectedIndex].text;



}



</script>

		<?


// dom1 ja dom2 on meil siis dom1_dom2 - seoste esimene ja teine pool. Eraldame:

		$dom1=substr($domain,0,strpos($domain,"_"));

		$dom2=substr($domain,strpos($domain,"_")+1,strlen($domain));

		$count=1;

		$temp=array();





// k�sime k�igi sobiliku dom1 v�i dom2-ga seoste kohta ...

		switch ($sel)

		{

			case 1:

				$query2="SELECT * FROM ".$domain." WHERE oid1=".$oid." ORDER BY sort_order";

				$list_dom = $dom2;

				$list_oid = "oid2";

				$tyvi_dom = $dom1;

				break;

			case 2:

				$query2="SELECT * FROM ".$domain." WHERE oid2=".$oid." ORDER BY sort_order";

				$list_dom = $dom1;

				$list_oid = "oid1";

				$tyvi_dom = $dom2;

				break;

		}

//echo $query2;

// tahan raamatX tabelist saada k�tte book_id v�lja

		$qq="SELECT * FROM ".$tyvi_dom." WHERE id=".$oid;
		$rr=mysql_query($qq);
		$tt=mysql_fetch_array($rr);
		$book_id= $tt["book_id"];
//		echo $qq;



		//echo $query2;

		$result2=mysql_query($query2);

// ... ja k�ime need l�bi ...

//echo "hu";
if($result2)
{
	while($tulem=mysql_fetch_array($result2))

	{

		$qu="SELECT * FROM ".$list_dom." WHERE id=".$tulem[$list_oid];

		//echo $qu;



		$r=mysql_query($qu);

		$t=mysql_fetch_array($r);

		$my_oid2=$tulem[$list_oid]; // et saaks �ige kooli poole tormelda

 		switch ($list_dom)

		{

			case "isik": $asi4=$t["eesnimi"]." ".$t["perenimi"]; $idee2="iid"; $email1=$t["email1"];

				break;

			case "avaldus": $asi4=$t["eesnimi"]." ".$t["perenimi"]; $idee2="iid"; $email1=$t["email1"];

				break;

			case "firma": $asi4=$t["nimi"]; $idee2="fid";

				break;

			case "kool": $asi4=$t["nimi"]; $idee2="fid"; $email1=$t["email1"];

				break;

			case "etendus": $asi4=$t["nimi_est"]; $idee2="etendusid";

				break;

			case "pohivara": $asi4=$t["nimi_est"]; $idee2="poid";

				break;

			case "kutse": $asi4=$t["nimi"]; $idee2="fid"; $email1=$t["email1"];

				break;

			case "exp": $asi4=$t["nimi_est"]; $idee2="expid";

				break;

			case "tootuba": $asi4=$t["nimi_est"]; $idee2="tootid";

				break;

			case "valem": $asi4=$t["nimi_est"]; $idee2="vid";

				break;

			case "oskus": $asi4=$t["id"]; $idee2="osid";

				break;

			case "nupula": $asi4=$t["nimi_est"]; $idee2="nid";

				break;

			case "knowhow": $asi4=$t["nimi_est"]; $idee2="kid";

				break;

			case "etendus": $asi4=$t["nimi_est"]; $idee2="etendusid";

				break;

			case "reis": 	$algus=$t{'algus'};

							$kuu=substr($algus,5,2);

							$paeva=substr($algus,8,2);

							$kuua = kuud($kuu, $keel);

							$lopp=$t{'lopp'};

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

							$asi4=$t["nimi"]." ".$reisiaeg; $idee2="reisid";

				break;

			 case "vahendid":

						 if($dom1=='kool')

							{



			 				$algus=$tulem['date_algus'];

							$kuu=substr($algus,5,2);

							$paeva=substr($algus,8,2);

							$kuua = kuud($kuu, $keel);

							$aastaa=substr($algus,0,4);

							$lopp=$tulem['date_lopp'];

							$aastal=substr($lopp,0,4);

							$kuu=substr($lopp,5,2);

							$paevl=substr($lopp,8,2);

							$kuul = kuud($kuu, $keel);

							if($kuua == $kuul&&$paeva!=$paevl&&$aastaa==$aastal)

								$a_algus=$paeva.". - ".$paevl.". ".$kuul.' '.$aasta;

							if($kuua == $kuul&&$paeva==$paevl&&$aastaa==$aastal)

								$a_algus=$paeva.'. '.$kuua.' '.$aasta;

							if($kuua != $kuul&&$paeva!=$paevl&&$aastaa==$aastal)

								$a_algus=$paeva.". ".$kuua.' - '.$paevl.". ".$kuul.' '.$aasta;

							if($aastaa!=$aastal)

								$a_algus=$paeva.". ".$kuua.". ".$aastaa." - ".$paevl.". ".$kuul." ".$aastal;

							$vah=" (".$a_algus."), ".$tulem['mitu']."t�kki";

							$asi4=$t["nimi_est"]." ".$vah;//." ".$reisiaeg."asdf";

							$idee2="vid";

							}

							else

							{

							$asi4=$t["nimi_est"];//." ".$reisiaeg."asdf";

							$idee2="vid";

							}

				break;

			case "uudis": $asi4=$t["title"]; $idee2="pid";

				break;

			default: $asi4=$t["nimi_est"]; $idee2="pid";

			break;

		}

//echo $asi4;

//nimede j�rgi sorteerimiseks teen sellise maatriksi

if($list_dom!="nupula" AND $list_dom!="exp")

{

		$nimi = $asi4;

		$temp[$nimi]["nimi"] = $nimi;

		$temp[$nimi]["gpid_demo"] = $t["gpid_demo"];

		$temp[$nimi]["valem_id"] = $t["valem_id"];

		$temp[$nimi]["raamatX_id"] = $t["raamatX_id"];

		$temp[$nimi]["oid_nimi"] = $idee2;

		$temp[$nimi]["oid"] = $tulem[$list_oid];

		$temp[$nimi]["link"] = $link;

		$temp[$nimi]["dom"] = $list_dom;

		$temp[$nimi]["email1"] = $email1;

		$temp[$nimi]["domain"] = $domain;

		$temp[$nimi]["id"] = $tulem["id"];

		$temp[$nimi]["order1"] = $tulem["order1"];

		$temp[$nimi]["order2"] = $tulem["order2"];

		$temp[$nimi]["meta"] = $tulem["meta"];

		$temp[$nimi]["title1"] = $tulem["title1"];

		$temp[$nimi]["title2"] = $tulem["title2"];

		$temp[$nimi]["sisu1"] = $tulem["sisu1"];

		$temp[$nimi]["sisu2"] = $tulem["sisu2"];

		$temp[$nimi]["naita_veebis1"] = $tulem["naita_veebis1"];

		$temp[$nimi]["naita_veebis2"] = $tulem["naita_veebis2"];

		$temp[$nimi]["sel"] = $sel;

		//echo $tulem["title1"];

}

else

{

		$nimi = $tulem[$list_oid];

		$temp[$nimi]["nimi"] = $nimi;

		$temp[$nimi]["gpid_demo"] = $t["gpid_demo"];

		$temp[$nimi]["valem_id"] = $t["valem_id"];

		$temp[$nimi]["raamatX_id"] = $t["raamatX_id"];

		$temp[$nimi]["oid_nimi"] = $idee2;

		$temp[$nimi]["oid"] = $tulem[$list_oid];

		$temp[$nimi]["link"] = $link;

		$temp[$nimi]["dom"] = $list_dom;

		$temp[$nimi]["email1"] = $email1;

		$temp[$nimi]["domain"] = $domain;

		$temp[$nimi]["id"] = $tulem["id"];

		$temp[$nimi]["sort_order"] = $tulem["sort_order"];
		$temp[$nimi]["meta"] = $tulem["meta"];
		$temp[$nimi]["title_est"] = $tulem["title_est"];
		$temp[$nimi]["naita_veebis"] = $tulem["naita_veebis"];

		$temp[$nimi]["sel"] = $sel;

}

	$count++;

}
} //END if valid search


//sorteerin, va juhul, kui teen testi korda ...

if($list_dom!="nupula" AND $list_dom!="exp")

{

//sorteerin ...

array_multisort($temp, SORT_ASC,SORT_REGULAR);

}





$count=1;

$emailirida='';

//kirjutan tabeli ...

?>

<table width="100%" border="0" cellspacing="1" cellpadding="0">

		<tr>

		  <td colspan="5" background="images/sinine.gif" class="menu"><? echo $pealkiri;?>

	     <!--<input type="text" id="favorite" size="20" />--></td>

		<td align="right" valign="middle" background="images/sinine.gif" class="menu" width="7%" ><input type="button" name="suva2" class="button" value="Otsi ja lisa" onclick="window.open('addvalue_iid_asp.php?domain=<? echo $domain;?>&amp;oid=<? echo $oid;?>&amp;sel=<? echo $sel;?>&amp;otsing=<? echo $list_dom;?>&amp;vali=<?

		  switch($list_dom)

		  	{

				case "nupula": 	echo "probleem_est"; 		break;

				case "valem": 	echo "nimi_est"; 		break;

				case "isik": 	echo "perenimi"; 		break;

				case "kool": 	echo "nimi"; 		break;

				default: 		echo "nimi_est"; 	break;

			}



		  ?>','File_upload','toolbar=0,width=1200,height=680,status=yes');" /></td>

		<td width="13%" colspan="3" align="right" valign="middle" background="images/sinine.gif" class="menu" ><?



if(strstr($tyvi_dom,"raamat") or strstr($tyvi_dom,"exp") or strstr($tyvi_dom,"nupula") or strstr($tyvi_dom,"test"))

{ ?>

          <a href="index.php?page=<? echo $list_dom;?>_disp&<?

		  switch($tyvi_dom)

		  	{

				case "test": 	echo "tid"; 		break;

				default: 		echo "klass_id"; 	break;

			}



		  ?>=<? echo $oid;?>&bookid=<? echo $book_id;?>&pid=2&klass=<? echo $tyvi_dom;?>&sel=<? echo $sel;?>&action=new" target="_blank" class="options">Loo&nbsp;uus!</a>

          <?

}

		?></td>

		</tr></table>

        <table width="100%">

<?

foreach ($temp as $asi)

{

//Loen objektide kohta andmed ...

		$qu2="SELECT * FROM ".$list_dom." WHERE id=".$asi["oid"];

		$re2 = mysql_query($qu2);

		$kirje = mysql_fetch_array($re2);

		$my_oid2=$tulem["oid2"]; // et saaks �ige kooli poole tormelda

//		echo $dom1;



				?>



<tr>

<?

//Erisus - kui on raamatu peat�kid, siis peab suunama aine_disp lehele:

$disp_link = $list_dom."_disp";

$klass_string="";

if(strstr($list_dom,"raamat"))

{

	$disp_link = "raamatX_disp";

	$asi["oid_nimi"] = "aid";

	$klass_string="&klass=".$list_dom;

}

?>

				<td width="3%" valign="top" class="fields"><? echo $count.".";







				?>

</td>

				<td width="9%" valign="top" class="fields"><?

				switch($list_dom)

				{

				case "exp":

				{

					$query_gp="SELECT * from exp_grupid_demo WHERE id=".$kirje["gpid_demo"];

					//echo $query_gp;

				$result_gp=mysql_query("SELECT * from exp_grupid_demo WHERE id=".$kirje["gpid_demo"]);

				$line_gp=mysql_fetch_array($result_gp);

				//echo $line_gp["ico_url_v"];

				?>

				  <img width="30" src="<? echo $line_gp["ico_url_v"];?>" alt=""/><?

				  break;

				}

				case "nupula":

				{ ?>

				<input align="middle" id="seos_<? echo $asi["id"];?>" type="checkbox" onclick="muuda_show('<? echo $asi["id"];?>')" <? if ($asi["naita_veebis1"]) {?>checked="checked" <? }?>/>

				<?

				break;

				}

				default:

				{

					break;

				}

				}?></td>

				<td width="10%" valign="top" class="fields"><?



				if($domain=="test_nupula" or $domain=="exp_exp") {?><select id="list_order_<? echo $asi["id"];?>" onchange="muuda_order('<? echo $domain;?>','sort_order','list_order_<? echo $asi["id"];?>','<? echo $asi["id"];?>')"><?

for ($i = 1; $i <= 50; $i++)

{

	if($i==$asi["sort_order"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$i."\" ".$sel.">".$i."</option>";

}?>



</select><select id="asi_show_<? echo $asi["id"];?>" onchange="muuda_order('<? echo $domain;?>','naita_veebis','asi_show_<? echo $asi["id"];?>','<? echo $asi["id"];?>')"><?

for ($i = 0; $i <= 2; $i++)

{

	if($i==$asi["naita_veebis"]) { $sel="selected"; } else { $sel="";}

	switch($i)

	{

		case 0: $txt = "off"; break;

		case 1: $txt = "on"; break;

		case 2: $txt = "komm"; break;

	}

		echo "<option value=\"".$i."\" ".$sel.">".$txt."</option>";

}?>



</select><? }





?></td>

				<td width="90%" valign="top" class="fields">

			    <?



		$kirje_displ_plain="";







if($tyvi_dom=="raamatX")

{

		switch ($list_dom)

		{

			case "isik": $kirje_displ = $kirje["eesnimi"]." ".$kirje["perenimi"]; break;

			case "avaldus": $kirje_displ =$kirje["eesnimi"]." ".$t["perenimi"]; $idee2="iid"; $email1=$t["email1"];

				break;

			case "firma": $kirje_displ=$kirje["nimi"]; $idee2="fid";

				break;

			case "kool": $kirje_displ=$kirje["nimi"]; $idee2="fid"; $email1=$t["email1"];

				break;

			case "exp": $kirje_displ=$kirje["nimi_est"]; $kirje_displ_plain=""; $idee2="expid";

			//if($exp_pikk){$kirje_displ_plain=$kirje["kirjeldus_est"];}

				break;

			case "tootuba": $kirje_displ=$kirje["nimi_est"]; $idee2="tootid";

				break;

			case "valem": $kirje_displ=$kirje["nimi_est"]; $idee2="vid";

				break;

			case "nupula": $kirje_displ=$kirje["nimi_est"]; $kirje_displ_plain=$kirje["nimi_est"]." (".$kirje["liik"].")"; $idee2="nid";

			break;

			case "oskus": $kirje_displ=$kirje["id"]; $kirje_displ_plain=$kirje["oskus_est"]; $idee2="osid";

				break;

			case "uudis": $kirje_displ=$kirje["title"]; break;

			default: $kirje_displ = $kirje["nimi_est"];	break;

		}

}





if($tyvi_dom=="exp") // See, mis ilmub exp objekti all, vastusevariandid

{

		switch ($list_dom)

		{

			case "isik": $kirje_displ = $kirje["eesnimi"]." ".$kirje["perenimi"]; break;

			case "avaldus": $kirje_displ =$kirje["eesnimi"]." ".$t["perenimi"]; $idee2="iid"; $email1=$t["email1"];

				break;

			case "firma": $kirje_displ=$kirje["nimi"]; $idee2="fid";

				break;

			case "kool": $kirje_displ=$kirje["nimi"]; $idee2="fid"; $email1=$t["email1"];

				break;

			case "exp": $kirje_displ=$kirje["nimi_est"]; $kirje_displ_plain=$kirje["kirjeldus_est"]."".$kirje["seletus_est"]."".$kirje["probleem_est"]; $idee2="expid";  $kirje_displ_lahend = $kirje["seletus_est"];

			//if($exp_pikk){$kirje_displ_plain=$kirje["kirjeldus_est"];}

				break;

			case "tootuba": $kirje_displ=$kirje["nimi_est"]; $idee2="tootid";

				break;

			case "valem": $kirje_displ=$kirje["nimi_est"]; $idee2="vid";

				break;

			case "nupula": $kirje_displ=$kirje["nimi_est"]; $kirje_displ_plain=$kirje["probleem_est"]." (".$kirje["liik"].")"; $idee2="nid";

			break;

			case "oskus": $kirje_displ=$kirje["id"]; $kirje_displ_plain=$kirje["oskus_est"]; $idee2="osid";

				break;

			case "uudis": $kirje_displ=$kirje["title"]; break;

			case "vahendid":

				if(!$asi["title_est"])// see v�rk, et kui on seoses info sees, siis n�idatakse seda

					{

						$kirje_displ=$kirje["nimi_est"];

					}

					else

					{

						$kirje_displ=$asi["title_est"];

					}





			break;

			default: $kirje_displ = $kirje["nimi_est"];	break;

		}

}

else

{

		switch ($list_dom)

		{

			case "isik": $kirje_displ = $kirje["eesnimi"]." ".$kirje["perenimi"]; break;

			case "avaldus": $kirje_displ =$kirje["eesnimi"]." ".$t["perenimi"]; $idee2="iid"; $email1=$t["email1"];

				break;

			case "firma": $kirje_displ=$kirje["nimi"]; $idee2="fid";

				break;

			case "kool": $kirje_displ=$kirje["nimi"]; $idee2="fid"; $email1=$t["email1"];

				break;

			case "kutse": $kirje_displ=$kirje["nimi"]; $idee2="fid"; $email1=$t["email1"];

				break;

			case "exp": $kirje_displ=$kirje["nimi_est"]; /*$kirje_displ_plain=$kirje["probleem_est"]." "*/; $idee2="expid";

			//if($exp_pikk){$kirje_displ_plain=$kirje["kirjeldus_est"];}

				break;

			case "oskus": $kirje_displ=$kirje["id"]; $kirje_displ_plain=$kirje["oskus_est"]; $idee2="osid";

				break;

			case "knowhow": $kirje_displ=$kirje["nimi_est"]; $idee2="kid";

				break;

			case "etendus": $kirje_displ=$kirje["nimi_est"]; $idee2="etendusid";

				break;

			case "reis": 	$algus=$kirje{'algus'};

							$kuu=substr($algus,5,2);

							$paeva=substr($algus,8,2);

							$kuua = kuud($kuu, $keel);

							$lopp=$kirje{'lopp'};

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

							$kirje_displ=$kirje["nimi"]." ".$reisiaeg; $idee2="reisid";

				break;

			 case "vahendid":

						 if($dom1=='kool')

							{



			 				$algus=$tulem['date_algus'];

							$kuu=substr($algus,5,2);

							$paeva=substr($algus,8,2);

							$kuua = kuud($kuu, $keel);

							$aastaa=substr($algus,0,4);

							$lopp=$tulem['date_lopp'];

							$aastal=substr($lopp,0,4);

							$kuu=substr($lopp,5,2);

							$paevl=substr($lopp,8,2);

							$kuul = kuud($kuu, $keel);

							if($kuua == $kuul&&$paeva!=$paevl&&$aastaa==$aastal)

								$a_algus=$paeva.". - ".$paevl.". ".$kuul.' '.$aasta;

							if($kuua == $kuul&&$paeva==$paevl&&$aastaa==$aastal)

								$a_algus=$paeva.'. '.$kuua.' '.$aasta;

							if($kuua != $kuul&&$paeva!=$paevl&&$aastaa==$aastal)

								$a_algus=$paeva.". ".$kuua.' - '.$paevl.". ".$kuul.' '.$aasta;

							if($aastaa!=$aastal)

								$a_algus=$paeva.". ".$kuua.". ".$aastaa." - ".$paevl.". ".$kuul." ".$aastal;

							$vah=" (".$a_algus."), ".$tulem['mitu']."t�kki";

							$kirje_displ=$kirje["nimi_est"]." ".$vah;//." ".$reisiaeg."asdf";

							}

							else

							{

							if(!$kirje["title1"])

								{

									$kirje_displ="tadaa".$kirje["nimi_est"];

								}

								else

								{

									$kirje_displ=$kirje["title1"];

								}

							}



				break;

			case "uudis": $kirje_displ=$kirje["title"]; break;

			default: $kirje_displ = $kirje["nimi_est"];	break;

		}

}

				?>



                <?

				if($line_gp["id"]!=43 AND $line_gp["id"]!=42)

				{?><a href="index.php?page=<? echo $disp_link;?>&<? echo $asi["oid_nimi"];?>=<? echo $asi["oid"];?><? echo $klass_string;?>" target=_blank><? echo $kirje_displ; ?></a><?

				}

				else

				{ ?>

					<a href="index.php?page=raamatX_disp&aid=<? echo $asi["raamatX_id"];?>" target=_blank><? echo $kirje_displ; ?></a>

					<? echo "(rX)";

				} ?><?

				// siin on see loogika, et kuvatakse objekti enda infot, kui ei ole seosega m��ratud midagi spetsiifilist. Ehk siis seose info on �lem ja asendab objekti enda info.

					if($line_gp["id"]!=43)

					{

						if($asi["title1"])

						{

							echo $asi["title1"];

						}

						else

						{

							echo " ",strip_tags(substr($kirje_displ_plain,0,250))," ...";

						}

					}

					else

					{

						$query_rx="SELECT * FROM raamatX WHERE id=".$asi["raamatX_id"];

						//echo $query_rx;

						$result_rx=mysql_query($query_rx);

						$tulem_rx=mysql_fetch_array($result_rx);

						echo " ",strip_tags(substr($tulem_rx["tekst"],0,250))." ...";

					}

				//if($asi["meta1"]==2){echo $kirje_displ_lahend;}



				echo "(".$asi["oid"].")"; if($asi["valem_id"]>0) {echo "(".$asi["valem_id"].")";}



		if($t1["gpid_demo"]==34)

		{echo $kirje["tekst"];}



		if($list_dom=="raamat15") // igasugu �petajav�rgid. Peaksid t��tama siis, kui pid=2

		{

			echo "<br><strong>Uued m&otilde;isted:</strong>";

			$query_op="SELECT * FROM ".$list_dom."_pohivara WHERE oid1=".$asi["oid"];

//					echo $query_op;

			$result_op=mysql_query($query_op);

			while($tulem_op=mysql_fetch_array($result_op))

			{

			$query_op1="SELECT * FROM pohivara WHERE id=".$tulem_op["oid2"];

			$result_op1=mysql_query($query_op1);

			$tulem_op1=mysql_fetch_array($result_op1);

			echo ", ".$tulem_op1["nimi_est"];

			}





			echo "<br> <strong>&Otilde;piv&auml;ljundid</strong>";

			$query_os="SELECT * FROM ".$list_dom."_oskus WHERE oid1=".$asi["oid"];

//					echo $query_op;

			$result_os=mysql_query($query_os);

			?><ul><?

			while($tulem_os=mysql_fetch_array($result_os))

			{

			$query_os1="SELECT * FROM oskus WHERE id=".$tulem_os["oid2"];

//					echo $query_os1;

			$result_os1=mysql_query($query_os1);

			$tulem_os1=mysql_fetch_array($result_os1);

			echo "<li>".$tulem_os1["oskus_est"]."</li>";

			}

			?></ul><?

		}

				?>

                </td><?



	$qu1="SELECT * FROM ".$tyvi_dom." WHERE id=".$oid;

	$r1=mysql_query($qu1);

	$t1=mysql_fetch_array($r1);



//echo "sdf",$t1["gpid_demo"];







				if($domain=="exp_exp" && ($t1["gpid_demo"]==32 or $t1["gpid_demo"]==20 or $t1["gpid_demo"]==40 or $t1["gpid_demo"]==29)) {?>

				<td width="2%" valign="top" class="fields"><select id="list_oige_<? echo $asi["id"]; ?>" onchange="muuda_order('<? echo $domain;?>','meta','list_oige_<? echo $asi["id"];?>','<? echo $asi["id"];?>')"><?

for ($i = 0; $i <= 6; $i++)

{

	switch ($i)

	{

		case 0: $tekst="Vale"; break;

		case 1: $tekst="&Otilde;ige"; break;

		case 2: $tekst="Lahendus"; break;

		case 3: $tekst="lvalem"; break;

		case 4: $tekst="Sisend"; break;

		case 5: $tekst="Vahe"; break;

		case 6: $tekst="Vastus"; break;

	}

	if($i==$asi["meta"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$i."\" ".$sel.">".$tekst."</option>";

}?>



</select></td><? }?>



	<td width="12%" align="center" valign="top" class="navi"><?



		switch ($list_dom)

		{

			case "kool": ?><span class="button4">  <a href="index.php?page=arve_disp&action=new&kool_id=<? echo $kirje["id"];?>&reis_id=<? echo $oid;?>">A</a>&nbsp;</span><?

				break;

			case "exp":



				switch ($kirje["gpid_demo"])

				{	case 1:

					case 4:

					case 5:

					case 7:

					$link_obj = "https://www.youtube.com/v/".$kirje["id_youtube"];

					$objekt = urldecode($kirje["veeb_pilt_url"]);

					break;



					case 31:

					$link_obj = "https://www.youtube.com/v/".$kirje["id_youtube"];

					$objekt = "media/valem_pildid/".$kirje["veeb_pilt_url"];

					break;



					default:

					$link_obj = urldecode($kirje["veeb_pilt_url_s"]);

					$objekt = urldecode($kirje["veeb_pilt_url"]);

					break;



				}

				?>

            <? if($objekt)

				{?><a href="<? echo $link_obj;?>" target="_blank"><img src="<? echo $objekt; ?>" width="50"/></a>

                 <?

				}

			else

                {?>

                     <!--<img src="http://www.fyysika.ee/omad/image/noimage.jpg" width="50"/>-->



               <? }?>

<? 				break;









			case "valem":

			case "isik":

			case "avaldus":

			case "firma":

			case "kutse":

			case "tootuba":

			case "nupula":

			case "etendus":

			case "reis":

			case "vahendid":

			case "uudis": echo "(".$kirje["id"].")";	 break;

			case "raamatX": echo "".$asi["naita_veebis1"]." ".$asi["naita_veebis2"]."";

			break;

			default:

				echo "(".$kirje["id"].")";

				break;

		}













				 if($dom2=="kool"&&$sel==1){?>

<input type="button" class="button3" value="fkb" onClick="window.open('addvalue_iid_groupid.php?domain=<? echo $asi["domain"];?>&koolid=<? echo $asi["oid"];?>&reisid=<? echo $oid;?>','Delete','toolbar=0,scrollbars=1,width=650,height=350,status=yes');" ><? } ?></td>











<td width="0%" valign="top">

  <span class="navi">

  <input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=<? echo $asi["domain"];?>&id=<? echo $asi["id"]?>&sel=<? echo $asi["sel"]?>','Delete','toolbar=0,width=1200,height=1250,status=yes');" >

  </span></td>



	<? if($dom2=="raamatX"&&$sel==1){?>

	<td width="1%" valign="top"> <input type="button" class="button3" value="i" onClick="window.open('addvalue_objektid.php?domain=<? echo $asi["domain"];?>&id_from=<? echo $asi["oid"]?>&id_to=<? echo $oid; ?>&sel=<? echo $asi["sel"]?>','Delete','toolbar=0,width=700,height=850,status=yes');" ></td>



	  <? }?>
		<? if($dom2=="raamatX"&&$sel==1){?>

		<td width="1%" valign="top"> <input type="button" class="button3" value="c" onClick="window.open('addvalue_kopeeri.php?domain=<? echo $asi["domain"];?>&id_from=<? echo $asi["oid"]?>&id_to=<? echo $oid; ?>&sel=<? echo $asi["sel"]?>','Delete','toolbar=0,width=700,height=850,status=yes,scrollbars=yes');" ></td>



		  <? }?>

<td width="1%" valign="top"><input type="button" class="button2" value="x" onclick="window.open('delvalue_iid.php?domain=<? echo $asi["domain"];?>&id=<? echo $asi["id"]?>','Delete','toolbar=0,width=420,height=200,status=yes');" /></td>

				</tr>



				<?

				$count++;

				$emailirida=sprintf("%s %s;",$emailirida, $asi["email1"]);

				$emailirida2=sprintf("%s %s; ",$emailirida2, $asi["email1"]);

				}



			  ?><tr background="images/sinine.gif"><td colspan="10" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td></tr><?

			  if($lisa == 1)

			  {



			  ?> </table><table width="100%"><tr align="left" >

			      <td colspan="5" class="menu" ><input type="button" name="suva1" class="button" value="Lisa olemasolevatest" onclick="window.open('addvalue_iid.php?domain=<? echo $domain;?>&oid=<? echo $oid;?>&sel=<? echo $sel;?>','File_upload','toolbar=0,width=660,height=580,status=yes');" >

			        <?

if($domain=="exp_exp")

{

?><input type="button" name="suva1" class="button" value="Kaamera" onClick="window.open('camera/index.php?domain=<? echo $domain; ?>&oid=<? echo $oid; ?>','File_upload','toolbar=0,width=340,height=670,status=yes')"><? }?></td>

				  <td colspan="4" align="right" class="menu" ><? if($list_dom == "isik" or $list_dom == "kool") {?><a href="mailto:<? echo $emailirida;?>"><img src="image/EmailIcon.jpg" alt="email" width="18" height="20" border="0" /></a><? }?></td>

				</tr>



<?

			  }



?></table>

<? //echo $emailirida2;



	}

?>
