<?
require_once 'header.php';
include("globals.php");
if($loginform==1) { echo "Sry. Permission denied!";}
else {
      $entity=$_GET["entity"];
      $id=$_GET["id"];
	  $dom=$_GET["domain"];
	  $sel=$_GET["sel"];
	  $tehtud=0;
		if($_GET["act"]=="upi"){
		echo "oota ... ";
				$query="DELETE FROM ".$dom." WHERE id=".$id;
				//echo $query;
				$result=mysql_query($query);
      			$tehtud=1;
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
window.open('about:blank','uploader','width=320,height=20,top=100,toolbar=no');
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
<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>>
<? if($tehtud!=1) {?>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&entity=<? echo $entity; ?>&id=<? echo $_GET["id"]; ?>&domain=<? echo $dom; ?>" target="uploader" onSubmit="return aken();">
  <tr>
    <td width="50" background="image/sinine.gif" class="menu" >V&auml;li</td>
    <td width="80%" background="image/sinine.gif" class="menu">Sisu</td>
  </tr>
  <tr>
  	<td class="options"> <?  echo $dom; ?> </td>
	<td class="options">
    <?
			$dom1=substr($dom,0,strpos($dom,"_"));
			$dom2=substr($dom,strpos($dom,"_")+1,strlen($dom));
			$query="SELECT oid1,oid2 FROM ".$dom." WHERE id=".$id;
			//echo $dom1;
			$result=mysql_query($query);
			$line=mysql_fetch_array($result);
// loeme vastavatest andmebaasidest vastavate kirjete nimed v�i misiganes iseloomulikud elemendid
			switch ($dom1)
			{

			case "isik": $asi1="eesnimi,perenimi";
				break;
			case "kool": $asi1="nimi";
				break;
			case "kutse": $asi1="nimi";
				break;
			case "reis": $asi1="id, nimi, algus, lopp";
				break;
			case "uudis": $asi1="title, urltitle";
				break;
			default: $asi1="nimi_est";
				break;
			}

			switch ($dom2)
			{
			case "isik": $asi2="eesnimi,perenimi";
			break;
			case "kool": $asi2="nimi";
			break;
			case "kutse": $asi2="nimi";
				break;
			case "reis": $asi2="id, nimi, algus, lopp";
				break;
			case "uudis": $asi2="title, urltitle";
				break;
			default: $asi2="nimi_est";

				break;

			}

			$query1="SELECT ".$asi2." FROM ".$dom2." WHERE id=".$line["oid2"];
			$query2="SELECT ".$asi1." FROM ".$dom1." WHERE id=".$line["oid1"];
			//echo $query1,"  ", $query2;
			$result1=mysql_query($query1);
			if($result1)
			{
				$t1=mysql_fetch_array($result1);
			}
			$result2=mysql_query($query2);
			if($result2)
			{
				$t2=mysql_fetch_array($result2);
			}
			switch ($dom1)
			{
				case "isik": $asi3=$t2["eesnimi"]." ".$t2["perenimi"]; $idee1="iid";

					break;

				case "firma": $asi3=$t2["nimi"]; $idee1="fid";

					break;

				case "kool": $asi3=$t2["nimi"]; $idee1="fid";

					break;

				case "kutse": $asi3=$t2["nimi"]; $idee1="fid";

					break;

				case "exp": $asi3=$t2["nimi_est"]; $idee1="expid";

					break;

				case "tootuba": $asi3=$t2["nimi_est"]; $idee1="tootid";

					break;

				case "nupula": $asi3=$t2["nimi_est"]; $idee1="nupid";

					break;

				case "knowhow": $asi3=$t2["nimi_est"]; $idee1="kid";

					break;

				case "reis": 	$algus=$t2{'algus'};

								$kuu=substr($algus,5,2);

								$paeva=substr($algus,8,2);

								$kuua = kuud($kuu, $keel);

								$lopp=$t2{'lopp'};

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

								$asi3=$t2["nimi"]." ".$reisiaeg;

								$idee1="reisid";

					break;

				case "uudis": $asi3=$t2["title"]; $idee1="pid";

					break;

				default: $asi3=$t2["nimi_est"]; $idee1="pid";

				break;

			}



			switch ($dom2)

			{

				case "isik": $asi4=$t1["eesnimi"]." ".$t1["perenimi"]; $idee2="iid";

					break;

				case "firma": $asi4=$t1["nimi"]; $idee2="fid";

					break;

				case "kool": $asi4=$t1["nimi"]; $idee2="fid";

					break;

				case "kutse": $asi4=$t1["nimi"]; $idee2="fid";

					break;

				case "exp": $asi4=$t1["nimi_est"]; $idee2="expid";

					break;

				case "tootuba": $asi4=$t1["nimi_est"]; $idee2="tootid";

					break;

				case "nupula": $asi4=$t1["nimi_est"]; $idee2="nupid";

					break;

				case "knowhow": $asi4=$t1["nimi_est"]; $idee2="kid";

					break;

				case "reis": 	$algus=$t1{'algus'};

								$kuu=substr($algus,5,2);

								$paeva=substr($algus,8,2);

								$kuua = kuud($kuu, $keel);

								$lopp=$t1{'lopp'};

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
									$asi4=$t1["nimi"]." ".$reisiaeg; $idee2="reisid";
					break;
				case "uudis": $asi4=$t12["title"]; $idee2="pid";
					break;
				default: $asi4=$t1["nimi_est"]; $idee2="pid";
				break;

			}
//  			echo $t1["eesnimi"], $asi4, $dom1, $dom2;
			if($domain=="uudis"){

				$link="http://www.fyysika.ee/uudised/";}
				else
				{$link="index.php?page=";}
			echo "Kustuta seos: </br></br>";
			echo $asi4." <-> ".$asi3."?" ;
	 ?></td>
	 </tr>
    <tr>
      <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
    </tr>
     <tr align="left" >
      <td colspan="2" class="menu" ><input type="submit" name="suva1" class="button" value="Kustutada" >
        <input type="button" name="suva12" class="button" value="Katkesta" onClick="ending();">
      </td>
    </tr>
 </form>
</table>
<? }
}
?>
