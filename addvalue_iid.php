<?

		include("connect.php");

		include("authsys.php");	

		include("globals.php");

		if($loginform==1) { echo "Juurdep��s keelatud!";}

		else {	

	  $oid=$_GET["oid"];	

	  $dom=$_GET["domain"];

	  $sel=$_GET["sel"];

	  $bookid=$_GET["bookid"];

	  echo $dom." oid=".$oid." ".$bookid;

// kutsete registreerimise v�rgi erijuht

	  $etendus_id=$_GET["etendus_id"];

	$dom1=substr($dom,0,strpos($dom,"_"));

	$dom2=substr($dom,strpos($dom,"_")+1,strlen($dom));

echo "dom1=",$dom1." dom2=".$dom2." ";



	  $tehtud=0;	

		if($_GET["act"]=="upi"){	

			echo "uuendan ... ";

			$var=$_POST;

			if($dom1 == "raamatX" && $bookid) 

			{

				$query="INSERT INTO ".$dom." (oid1,oid2,book_id) VALUES (\"".$oid."\",\"".$_POST["entity"]."\",\"".$bookid."\")";

				echo $query;	

			}

			else

			{

			switch($sel)

			{

				case '1': $query="INSERT INTO ".$dom." (oid1,oid2) VALUES (\"".$oid."\",\"".$_POST["entity"]."\")";

				break;

	

				case '2': $query="INSERT INTO ".$dom." (oid1,oid2) VALUES (\"".$_POST["entity"]."\",\"".$oid."\")";

				break;

			}

			}

			echo $query."<br>";

			$result=mysql_query($query);

			$tehtud=1;

// s�time kooli kutsumist m�rkiva v�lja korda, nullist �heks ...

			//echo "etendus_id=",$etendus_id;

			if($dom=="kutse_kool" and $etendus_id)

			{

				$query_kutse="UPDATE kool SET kutse_".$etendus_id."=1 WHERE id=".$_POST["entity"];

				//echo $query_kutse;

				$result_kutse=mysql_query($query_kutse);

			}

		}

		?>

<link href="scat.css" rel="stylesheet" type="text/css">

<style type="text/css">

<!--

.back {

	background-color: #FFFFFF;

	border: 2px none #CCCCCC;

}



-->



</style>



<script>

function aken(){

window.open('about:blank','uploader','width=450,height=20,top=100,toolbar=no');

return true;

}



function ending(){

	window.opener.location.reload();

	window.close();

}



function ehee(){

		self.opener.ending();

		window.close();

}

</script>

<? 



//******************************************************************************

	switch ($dom1)

	{

	case "isik": $asi1="eesnimi,perenimi"; $order1="eesnimi";

		break;

	case "kool":

	case "firma": $asi1="nimi"; $order1="nimi";

		break;

	case "reis": $asi1="id, nimi, algus, lopp"; $order1="nimi";

		break;

	case "uudis": $asi1="title, urltitle"; $order1="title";

		break;

	default: $asi1="nimi_est"; $order1="nimi_est";

		break;

	}

	

	switch ($dom2)

	{

	case "isik": $asi2="eesnimi,perenimi"; $order2="eesnimi";

		break;

	case "kool":

	case "firma": $asi2="nimi"; $order2="nimi";

		break;

	case "reis": $asi2="id, nimi, algus, lopp"; $order2="nimi";

		break;

	case "uudis": $asi2="title, urltitle"; $order2="title";

		break;

	default: $asi2="nimi_est"; $order2="nimi_est";

		break;

	}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	

	switch ($sel)

	{

		case 1:$qu="SELECT id,".$asi2." FROM ".$dom2." ORDER BY ".$order2;

			break;

		case 2: $qu="SELECT id,".$asi1." FROM ".$dom1." ORDER BY ".$order1;

			break;

	}



	echo $qu;

	$result=mysql_query($qu);





?>

<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>><!--kui valmis, siis paneb ennast kinni-->

<? if($tehtud!=1) {?>

<table width="100%" border="0" cellspacing="1" cellpadding="0">

  <tr> 

    <td width="69" background="image/sinine.gif" class="menu" >V&auml;li </td>

    <td width="916" background="image/sinine.gif" class="menu">Sisu</td>

  </tr>

<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&oid=<? echo $oid; ?>&domain=<? echo $dom; ?>&sel=<? echo $sel; ?>&etendus_id=<? echo $etendus_id; ?>&bookid=<? echo $bookid; ?>" target="uploader" onSubmit="return aken();"> 

<tr background="image/sinine.gif"> 

    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>

   </tr><tr> 

    <td colspan="1" class="options" ><? 

	echo $dom;

	 ?><img src="image/spacer.gif" width="20" height="2"></td>

    <td colspan="1" class="options" >

	<? 

	echo "sel=",$sel," ";

	?> 

	<select name="entity">

      <? 

	switch ($sel)

	{

	case 1:

		while($t=mysql_fetch_array($result)){

										switch ($dom1)

										{

											case "isik": $asi3=$t["eesnimi"]." ".$t["perenimi"];

												break;

											case "firma": $asi3=$t["nimi"]; $idee1="fid";

												break;

											case "kool": $asi3=$t["nimi"]; $idee1="fid";

												break;

											case "exp": $asi3=$t["nimi_est"]; $idee1="expid";

												break;

											case "tootuba": $asi3=$t["nimi_est"]; $idee1="tootid";

												break;

											case "nupula": $asi3=$t["nimi_est"]; $idee1="nupid";

												break;

											case "knowhow": $asi3=$t["nimi_est"]; $idee1="kid";

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

															$asi3=$t["nimi"]." ".$reisiaeg;

															$idee1="reisid";

												break;

											case "uudis": $asi3=$t["title"]; $idee1="uid";

												break;

											default: $asi3=$t["nimi_est"]; $idee="pid";

											break;

										}

										

										switch ($dom2)

										{

											case "isik": $asi4=$t["eesnimi"]." ".$t["perenimi"];

												break;

											case "firma": $asi4=$t["nimi"]; $idee2="fid";

												break;

											case "kool": $asi4=$t["nimi"]; $idee2="fid";

												break;

											case "exp": $asi4=$t["nimi_est"]; $idee2="expid";

												break;

											case "valem": $asi4="id=".$t["id"]; $idee2="expid";

												break;

											case "tootuba": $asi4=$t["nimi_est"]; $idee2="tootid";

												break;

											case "nupula": $asi4=$t["nimi_est"]; $idee2="nupid";

												break;

											case "knowhow": $asi4=$t["nimi_est"]; $idee2="kid";

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

											case "uudis": $asi4=$t["title"]; $idee2="uid";

												break;

											default: $asi4=$t["nimi_est"]; $idee="pid";

											break;

										}



				echo "<option value=\"".$t["id"]."\">".$asi4."</option>";

				}

		 break;

	case 2:

		while($t=mysql_fetch_array($result)){

										switch ($dom1)

										{

											case "isik": $asi3=$t["eesnimi"]." ".$t["perenimi"];

												break;

											case "firma": $asi3=$t["nimi"]; $idee1="fid";

												break;

											case "kool": $asi3=$t["nimi"]; $idee1="fid";

												break;

											case "exp": $asi3=$t["nimi_est"]; $idee1="expid";

												break;

											case "tootuba": $asi3=$t["nimi_est"]; $idee1="tootid";

												break;

											case "nupula": $asi3=$t["nimi_est"]; $idee1="nupid";

												break;

											case "knowhow": $asi3=$t["nimi_est"]; $idee1="kid";

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

															$asi3=$t["nimi"]." ".$reisiaeg;

															$idee1="reisid";

												break;

											case "uudis": $asi3=$t["title"]; $idee1="pid";

												break;

											default: $asi3=$t["nimi_est"]; $idee1="pid";

											break;

										}

										

										switch ($dom2)

										{

											case "isik": $asi4=$t["eesnimi"]." ".$t["perenimi"]; $idee2="iid";

												break;

											case "firma": $asi4=$t["nimi"]; $idee2="fid";

												break;

											case "kool": $asi4=$t["nimi"]; $idee2="fid";

												break;

											case "exp": $asi4=$t["nimi_est"]; $idee2="expid"; echo "ihhii";

												break;

											case "tootuba": $asi4=$t["nimi_est"]; $idee2="tootid";

												break;

											case "nupula": $asi4=$t["nimi_est"]; $idee2="nupid";

												break;

											case "knowhow": $asi4=$t["nimi_est"]; $idee2="kid";

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

											case "uudis": $asi4=$t["title"]; $idee2="pid"; echo "ihhii_uudis";

												break;

											default: $asi4=$t["nimi_est"]; $idee2="pid";

											break;

										}

				echo "<option value=\"".$t["id"]."\">".$asi3."</option>";

				}

		 break;

	}

	echo "kpll";

//...................................................................................................................................	  



?></select></td>

  </tr>

<tr background="image/sinine.gif"> 

  <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

</tr>

  <tr align="left" > 

    <td colspan="2" class="menu" ><input type="submit"  class="button" value="Lisa" >

      <input type="button"  class="button" value="Katkesta" onClick="window.close();">       </td>

  </tr></form>

</table>

<? 

} 

}

?>

