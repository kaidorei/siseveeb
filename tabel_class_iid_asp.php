<?require_once 'header.php';
// V�ljastab JSON (?) tabeli, kus sees andmed, mis l�hevad objektide tabelisse.
// dom1 ja dom2 on meil siis dom1_dom2 - seoste esimene ja teine pool. Eraldame:
		if (empty($_GET['domain'])) exit ;
		if (empty($_GET['oid'])) exit ;

		$domain = $_GET["domain"];
		$list_dom = $_GET["list"];
		$oid = $_GET["oid"];		
		$order = $_GET["order"]; 	// millise parameetri j�rgi korrastatud tabeli me v�ljastame

		$dom1=substr($domain,0,strpos($domain,"_"));
		$dom2=substr($domain,strpos($domain,"_")+1,strlen($domain));

// k�sime k�igi sobiliku dom1 v�i dom2-ga seoste kohta ...
		if($dom2==$list_dom) // see on juht, kus dom_list on oid1
		{
				$list_oid = "oid2";
				$tyvi_oid = "oid1";
				$tyvi_dom = $dom1;
		}
		else
		{		
				$list_oid = "oid1";
				$tyvi_oid = "oid2";
				$tyvi_dom = $dom2;
				break;
		}
		$query2="SELECT * FROM ".$domain." WHERE ".$tyvi_oid."=".$oid." ORDER BY naita_veebis1 DESC, order1";
		echo $query2;
		$result2 = $db->query($query2);
// ... ja k�ime need l�bi ...		

		while($tulem = $result2->fetch_assoc()) 
			{
			$qu="SELECT * FROM ".$list_dom." WHERE id=".$tulem[$list_oid];
			echo $qu;
	
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
	echo $asi4;
	//nimede j�rgi sorteerimiseks teen sellise maatriksi
			$nimi = $asi4;
			$temp[$nimi]["nimi"] = $nimi;
			$temp[$nimi]["oid_nimi"] = $idee2;
			$temp[$nimi]["oid"] = $tulem[$list_oid];
			$temp[$nimi]["link"] = $link;
			$temp[$nimi]["dom"] = $list_dom;
			$temp[$nimi]["email1"] = $email1;
			$temp[$nimi]["domain"] = $domain;
			$temp[$nimi]["id"] = $tulem["id"];
			$temp[$nimi]["order1"] = $tulem["order1"];
			$temp[$nimi]["order2"] = $tulem["order2"];
			$temp[$nimi]["naita_veebis1"] = $tulem["naita_veebis1"];
			$temp[$nimi]["sel"] = $sel;
	
		$count++;
}
				
//sorteerin, va juhul, kui teen testi korda ... 
if($list_dom!="nupula")
{				
//sorteerin ...	  
array_multisort($temp, SORT_ASC,SORT_REGULAR); 
}
// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
echo json_encode($temp);
?>
