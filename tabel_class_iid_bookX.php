<?  function tabel2($domain,$oid,$bookid,$login,$sel,$lisa,$pealkiri){
		?>
<link href="scat.css" rel="stylesheet" type="text/css" >
		<?
// dom1 ja dom2 on meil siis dom1_dom2 - seoste esimene ja teine pool. Eraldame: 		
		$dom1=substr($domain,0,strpos($domain,"_"));
		$dom2=substr($domain,strpos($domain,"_")+1,strlen($domain));
		$count=1;
		$temp=array();
// küsime kõigi sobiliku dom1 või dom2-ga seoste kohta ...
		switch ($sel)
		{
			case 1:	
				$query2="SELECT * FROM ".$domain." WHERE oid1=".$oid." AND book_id=".$bookid;
				$list_dom = $dom2;
				$list_oid = "oid2";
				$tyvi_dom = $dom1;
				break;
			case 2:	
				$query2="SELECT * FROM ".$domain." WHERE oid2=".$oid." AND book_id=".$bookid;
				$list_dom = $dom1;
				$list_oid = "oid1";
				$tyvi_dom = $dom2;
				break;
		}
	//	echo $query2;
		$result2=mysql_query($query2);
// ... ja käime need läbi ...		

	while($tulem=mysql_fetch_array($result2))
	{
		$qu="SELECT * FROM ".$list_dom." WHERE id=".$tulem[$list_oid];
//		echo $qu;

		$r=mysql_query($qu);
		$t=mysql_fetch_array($r);
		$my_oid2=$tulem[$list_oid]; // et saaks õige kooli poole tormelda
 
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
			case "valem": $asi4=$t["id"]; $idee2="vid";
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
							$vah=" (".$a_algus."), ".$tulem['mitu']."tükki";
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
//sorteerima ...
		$nimi = $asi4;
		$temp[$nimi]["nimi"] = $nimi;
		$temp[$nimi]["oid_nimi"] = $idee2;
		$temp[$nimi]["oid"] = $tulem[$list_oid];
		$temp[$nimi]["link"] = $link;
		$temp[$nimi]["dom"] = $list_dom;
		$temp[$nimi]["email1"] = $email1;
		$temp[$nimi]["domain"] = $domain;
		$temp[$nimi]["id"] = $tulem["id"];
		$temp[$nimi]["sel"] = $sel;

	$count++;
}				
				
//sorteerin ...	  
array_multisort($temp, SORT_ASC,SORT_REGULAR); 
$count=1;
$emailirida='';
//kirjutan tabeli ...
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
		<tr>
		  <td colspan="2" background="images/sinine.gif" class="menu"><? echo $pealkiri;?></td>
		<td colspan="4" align="right" valign="middle" background="images/sinine.gif" class="menu" ><?
        
if(strstr($tyvi_dom,"raamat") or strstr($tyvi_dom,"exp"))
{ ?>
		  <a href="index.php?page=<? echo $list_dom;?>_disp&<? if ($tyvi_dom=="exp") {echo "expid";}else{echo "aid";}?>=<? echo $oid;?>&klass=<? echo $tyvi_dom;?>&bookid=<? echo $bookid;?>&action=new" target="_blank" class="options">Loo uus!</a>    <?
}
		?> </td>
		</tr>
<?
foreach ($temp as $asi)
{
//Loen objektide kohta andmed ...
		$qu2="SELECT * FROM ".$list_dom." WHERE id=".$asi["oid"];
		$re2 = mysql_query($qu2);
		$kirje = mysql_fetch_array($re2);
		$my_oid2=$tulem["oid2"]; // et saaks õige kooli poole tormelda
//		echo $dom1;
				
				?>
				
<tr>
<?
//Erisus - kui on raamatu peatükid, siis peab suunama aine_disp lehele:
$disp_link = $list_dom."_disp";
$klass_string="";
if(strstr($list_dom,"raamat"))
{
	$disp_link = "aine2_disp";
	$asi["oid_nimi"] = "aid";
	$klass_string="&klass=".$list_dom;
}
?>
				<td width="4%" valign="top" class="fields"><? 
				
				if($list_dom=="exp")
				{
					$query_gp="SELECT * from exp_grupid_demo WHERE id=".$kirje["gpid_demo"];
					//echo $query_gp;
				$result_gp=mysql_query("SELECT * from exp_grupid_demo WHERE id=".$kirje["gpid_demo"]);
				$line_gp=mysql_fetch_array($result_gp);
				//echo $line_gp["ico_url_v"];
				?><img src="<? echo $line_gp["ico_url_v"];?>" alt=""/><? 		
				}
				else
				{
					echo $count.".";
				}
				
				?>
			    </td>
				<td width="61%" valign="top" class="fields">
			    <? 
				
		$kirje_displ_plain="";		
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
			case "exp": $kirje_displ=$kirje["nimi_est"]; $idee2="expid";
			//if($exp_pikk){$kirje_displ_plain=$kirje["kirjeldus_est"];}
				break;
			case "tootuba": $kirje_displ=$kirje["nimi_est"]; $idee2="tootid";
				break;
			case "valem": $kirje_displ=$kirje["id"]; $idee2="vid";
				break;
			case "nupula": $kirje_displ=$kirje["nimi_est"]; $kirje_displ_plain=$kirje["probleem_est"]." (".$kirje["liik"].")"; $idee2="nid";
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
							$vah=" (".$a_algus."), ".$tulem['mitu']."tükki";
							$kirje_displ=$kirje["nimi_est"]." ".$vah;//." ".$reisiaeg."asdf";
							}
							else
							{
							$kirje_displ=$kirje["nimi_est"];//." ".$reisiaeg."asdf";
							}
				break;
			case "uudis": $kirje_displ=$kirje["title"]; break;
			case "raamat15": $kirje_displ = $kirje["nimi_est"];	break;
			default: $kirje_displ = $kirje["nimi_est"];	break;
		}
				
// .............................. UUS ALGUS ....				
		//echo "<br>(Debug: ".$kirje_displ;		
				
				
// NÄIDAKU ÜLESANNETE TEKSTE ... SELLEKS TULEB ALLJÄRGNEV KÄIMA SAADA.				
				?>
          
                <a href="index.php?page=<? echo $disp_link;?>&<? echo $asi["oid_nimi"];?>=<? echo $asi["oid"];?><? echo $klass_string;?>" target=_blank><? echo $kirje_displ; ?></a><? echo " ",$kirje_displ_plain; echo "(".$asi["oid"].")";
				if($list_dom=="raamat15")
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
                </td>

	<td width="1%" valign="top" class="navi"><?
				
		switch ($list_dom)
		{
			case "kool": ?><span class="button4">  <a href="index.php?page=arve_disp&action=new&kool_id=<? echo $kirje["id"];?>&reis_id=<? echo $oid;?>">A</a>&nbsp;</span><? 
				break;
			case "exp":
			
				switch ($kirje["gpid_demo"])
				{	case 1:
					case 4:
					case 5:
					case 7: $link_obj = "https://www.youtube.com/v/".$kirje["id_youtube"];
					break;
					default: $link_obj = urldecode($kirje["veeb_pilt_url_s"]);
				}
				?>
            <? if($kirje["veeb_pilt_url"])
				{?>
               <a href="<? echo $link_obj;?>" target="_blank"><img src="<? echo urldecode($kirje["veeb_pilt_url"]); ?>" width="50"/></a>
                 <?
				}
			else 
                {?>
                     <img src="http://www.fyysika.ee/omad/image/noimage.jpg" width="50"/>
					 
               <? }?>  
<? 				break;




			case "valem": 
			 if($kirje["image"])
				{?>
                <a href="<? echo "media/valem_pildid/".$kirje["image"];?>" target="_blank"><img src="<? echo "media/valem_pildid/".$kirje["image"];?>" width="50"/></a>
                <?
				}
			else 
                {?>
                     <img src="http://www.fyysika.ee/omad/image/noimage.jpg" width="50"/>	
					 
               <? }
			  break;
               
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
			default: 
				echo "(".$kirje["id"].")";	 
				break;
		}
				
				
				
				
				
				
				 if($dom2=="kool"&&$sel==1){?><input type="button" class="button3" value="fkb" onClick="window.open('addvalue_iid_groupid.php?domain=<? echo $asi["domain"];?>&koolid=<? echo $asi["oid"];?>&reisid=<? echo $oid;?>','Delete','toolbar=0,scrollbars=1,width=650,height=350,status=yes');" ><? } ?></td>
<td width="2%" valign="top">
  <span class="navi">
  <input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=<? echo $asi["domain"];?>&id=<? echo $asi["id"]?>&sel=<? echo $asi["sel"]?>','Delete','toolbar=0,width=700,height=850,status=yes');" >
  </span></td>
<td width="2%" valign="top"><input type="button" class="button2" value="x" onclick="window.open('delvalue_iid.php?domain=<? echo $asi["domain"];?>&id=<? echo $asi["id"]?>','Delete','toolbar=0,width=420,height=200,status=yes');" /></td>
				</tr>
				
				<?
				$count++;
				$emailirida=sprintf("%s %s;",$emailirida, $asi["email1"]);
				$emailirida2=sprintf("%s %s; ",$emailirida2, $asi["email1"]);
				}

			  ?><tr background="images/sinine.gif"><td colspan="6" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td></tr><?
			  if($lisa == 1)
			  {
			  
			  ?> <tr align="left" >
			      <td colspan="2" class="menu" ><input type="button" name="suva1" class="button" value="Lisa olemasolevatest" onclick="window.open('addvalue_iid.php?domain=<? echo $domain;?>&oid=<? echo $oid;?>&sel=<? echo $sel;?>&bookid=<? echo $bookid;?>','File_upload','toolbar=0,width=660,height=580,status=yes');" >
			        <?

?></td>
				  <td colspan="4" align="right" class="menu" ><? if($list_dom == "isik" or $list_dom == "kool") {?><a href="mailto:<? echo $emailirida;?>"><img src="image/EmailIcon.jpg" alt="email" width="18" height="20" border="0" /></a><? }?></td>
				</tr>

<?
			  }
			 
?></table>
<? //echo $emailirida2;
			  
	}
?>
















 