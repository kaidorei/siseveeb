



<?php 

// Väljastab JSON (?) tabeli, kus sees andmed, mis lähevad objektide tabelisse.

// dom1 ja dom2 on meil siis dom1_dom2 - seoste esimene ja teine pool. Eraldame: 		

		require_once 'header.php';

		if (empty($_GET['domain'])) exit ;
		if (empty($_GET['oid'])) exit ;
		$domain = $_GET["domain"];

		$list_dom = $_GET["list"];

		$oid = $_GET["oid"];		

		$order = $_GET["order"]; 	// millise parameetri järgi korrastatud tabeli me väljastame



		$dom1=substr($domain,0,strpos($domain,"_"));

		$dom2=substr($domain,strpos($domain,"_")+1,strlen($domain));



// küsime kõigi sobiliku dom1 või dom2-ga seoste kohta ...

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

//		echo $query2;

		$result2 = $db->query($query2);

// ... ja käime need läbi ...		



		while($tulem = $result2->fetch_assoc()) 

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

				default: $asi4=$t["nimi_est"]; $idee2="pid";

				break;

			}

	//echo $asi4;

	//nimede järgi sorteerimiseks teen sellise maatriksi

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
$temp="tore on";

// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions

echo json_encode($temp);

?>

