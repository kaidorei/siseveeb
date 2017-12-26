<?
		include("FCKeditor/fckeditor.php") ;
		include("connect.php");
		include("authsys.php");	
		include("globals.php");
		if($loginform==1) { echo "Juurdepääs keelatud!";}
		else {	
	  $id=$_GET["id"];	
	  $order1=$_GET["order1"];	
	  $order2=$_GET["order2"];	
	  $dom=$_GET["domain"];
	  $sel=$_GET["sel"];
	  $naita_veebis=$_GET["naita_veebis"];
	  $tehtud=0;	
		if($_GET["act"]=="upi"){	
			echo "uuendan ... ";
			$var=$_POST;
			switch($sel)
			{
				case '1': $query="UPDATE ".$dom." SET oid1='".$_POST["oid1"]."', oid2='".$_POST["oid2"]."', order1='".$_POST["order1"]."', order2='".$_POST["order2"]."', title1='".$_POST["seos_title"]."', sisse1='".$_POST["seos_sisse"]."', sisu1='".$_POST["seos_sisu"]."', naita_veebis1='".$_POST["naita_veebis"]."' WHERE id=".$id;
				break;
	
				case '2': $query="UPDATE ".$dom." SET oid1='".$_POST["oid1"]."', oid2='".$_POST["oid2"]."', order1='".$_POST["order1"]."', order2='".$_POST["order2"]."', title2='".$_POST["seos_title"]."', sisse2='".$_POST["seos_sisse"]."', sisu2='".$_POST["seos_sisu"]."', naita_veebis2='".$_POST["naita_veebis"]."' WHERE id=".$id;
				break;
			}
			echo $query;
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
window.open('about:blank','uploader','width=550,height=20,top=100,toolbar=no');
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

//	echo $dom1." ".$dom2;

//vastavalt seose id-le leian tabelist seose kaks otsa
	$query="SELECT order1, order2, oid1,oid2 FROM ".$dom." WHERE id=".$id;
	$result=mysql_query($query);
	$line=mysql_fetch_array($result); 
//			echo $query;
	
//vastavalt parameetrile sel leian tabelist seosele vastava pealkirja, annotatsiooni ja jutu	
	switch($sel)
	{
		case '1': $query_text="SELECT title1, sisse1, sisu1, naita_veebis1 FROM ".$dom." WHERE id=".$id;
		break;
		case '2': $query_text="SELECT title2, sisse2, sisu2, naita_veebis2 FROM ".$dom." WHERE id=".$id;
		break;
	}
	
	// ET NAITA_VEEBIS2 TÖÖTAKS
	
	$result_text=mysql_query($query_text);
	$line_text=mysql_fetch_array($result_text); 
	switch($sel)
	{
		case '1': 	$title=$line_text["title1"]; $sisse=$line_text["sisse1"]; $sisu=$line_text["sisu1"]; $naita_veebis=$line_text["naita_veebis1"]; break; 
		case '2': 	$title=$line_text["title2"]; $sisse=$line_text["sisse2"]; $sisu=$line_text["sisu2"]; $naita_veebis=$line_text["naita_veebis2"]; break;
	}

// alljärgnevas leitakse kasutaja kindlustunde tõstmiseks seosetabeli oid idele vastavad nimed.
	$dom1=substr($dom,0,strpos($dom,"_"));
	$dom2=substr($dom,strpos($dom,"_")+1,strlen($dom));
	
	switch ($dom1)
	{
	case "isik": $asi1="eesnimi,perenimi"; $order="eesnimi";
		break;
	case "kool":
	case "firma": $asi1="nimi"; $order="nimi";
		break;
	case "reis": $asi1="id, nimi, algus, lopp"; $order="nimi";
		break;
	case "uudised": $asi1="title, urltitle"; $order="title";
		break;
	default: $asi1="nimi_est"; $order="nimi_est";
		break;
	}
	
	switch ($dom2)
	{
	case "isik": $asi2="eesnimi,perenimi"; $order="eesnimi";
		break;
	case "kool":
	case "firma": $asi2="nimi"; $order="nimi";
		break;
	case "reis": $asi2="id, nimi, algus, lopp"; $order="nimi";
		break;
	case "uudised": $asi2="title, urltitle"; $order="title";
		break;
	default: $asi2="nimi_est"; $order="nimi_est";
		break;
	}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	echo $dom1, " ", $dom2, " ", $dom;
	
	$query1="SELECT id, ".$asi1." FROM ".$dom1." WHERE id=".$line["oid1"];
	$query2="SELECT id, ".$asi2." FROM ".$dom2." WHERE id=".$line["oid2"];

	$result1=mysql_query($query1);
	$line1=mysql_fetch_array($result1); 
	$result2=mysql_query($query2);
	$line2=mysql_fetch_array($result2); 

//	echo $query1;

?>
<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>>
<? if($tehtud!=1) {?><table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr> 
    <td width="69" background="image/sinine.gif" class="menu" >V&auml;li <? echo $sel;?></td>
    <td colspan="3" background="image/sinine.gif" class="menu">Sisu</td>
  </tr>
<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&id=<? echo $id; ?>&domain=<? echo $dom; ?>&sel=<? echo $sel; ?>" target="uploader" onSubmit="return aken();"> 
<tr background="image/sinine.gif"> 
    <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
   </tr>    <tr>
     <td colspan="1" valign="top" class="options" >seose id</td>
     <td class="options" ><img src="../images/spacer.gif" alt="s" width="30" height="1">order1: 
       <input name="order1" type="text"  class="menu_punane" value="<? echo $line["order1"]; ?>" size="5" >
&lt;-&gt;order2
<input name="order2" type="text"  class="menu_punane" value="<? echo $line["order2"]; ?>" size="5" >
:       </td>
     <td class="options" ></td>
     <td class="options" ><label></label></td>
    </tr>
<tr background="image/sinine.gif"> 
    <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
<tr> 
    <td colspan="1" class="options" ><? 
	echo $dom;
	 ?><img src="image/spacer.gif" width="20" height="2"></td>
    <td width="866" colspan="1" class="options" ><?
	switch($sel)
	{
		case '1': 	echo $line1[$asi1]," -> ",$line2[$asi2];
		break;
		case '2': echo $line2[$asi2]," -> ",$line1[$asi1];
		break;
	}
	

	$query1_p="SELECT id,".$asi1." FROM ".$dom1." ORDER BY ".$order;
	$query2_p="SELECT id,".$asi2." FROM ".$dom2." ORDER BY ".$order;
	$result1_p=mysql_query($query1_p);
	$result2_p=mysql_query($query2_p);

	?>
        <br>
      <select class="options" name="oid1">
        <? 
		while($t=mysql_fetch_array($result1_p)){
				switch ($dom1)
				{
					case "isik": $asi3=$t["eesnimi"]." ".$t["perenimi"]; $idee1="iid";
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
					default: $asi3=$t["nimi_est"]; $idee="pid";
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
					case "exp": $asi4=$t["nimi_est"]; $idee2="expid";
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
					case "uudis": $asi4=$t["title"]; $idee2="pid";
						break;
					default: $asi4=$t["nimi_est"]; $idee="pid";
					break;
				}
				if($t["id"]==$line["oid1"]) { $sel="selected"; } else { $sel="";}
				echo "<option value=\"".$t["id"]."\" ".$sel.">".$asi4."</option>";
		}
//...................................................................................................................................	  

?></select><->
  <select class="options" name="oid2">
    <? 
		while($t=mysql_fetch_array($result2_p)){
				switch ($dom1)
				{
					case "isik": $asi3=$t["eesnimi"]." ".$t["perenimi"]; $idee1="iid";
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
					default: $asi3=$t["nimi_est"]; $idee="pid";
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
					case "exp": $asi4=$t["nimi_est"]; $idee2="expid";
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
					case "uudis": $asi4=$t["title"]; $idee2="pid";
						break;
					default: $asi4=$t["nimi_est"]; $idee="pid";
					break;
				}

				if($t["id"]==$line["oid2"]) { $sel="selected"; } else { $sel="";}
				echo "<option value=\"".$t["id"]."\" ".$sel.">".$asi4."</option>";
		}
//...................................................................................................................................	  

?></select></td><td width="98" align="center" class="options" ><div align="left"><strong>N&auml;ita veebis: </strong> </div></td>
    <td width="66" align="center" class="options" >
      <input class="fields" name="naita_veebis" width="5" type="text" value="<? echo $naita_veebis;?>" >    </td>
   </tr>
<tr background="image/sinine.gif"> 
    <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
    <tr>
     <td colspan="1" valign="top" class="options" >Pealkiri</td>
     <td class="options" ><textarea cols="125" rows="1" class="fields" name="seos_title" type="text" value="" ><? echo $title;?> </textarea></td>
     <td class="options" ><strong>Tee koopia </strong></td>
     <td class="options" ><label>
       <input type="checkbox" name="checkbox" value="checkbox">
     </label></td>
    </tr>
<tr background="image/sinine.gif"> 
    <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
   <tr>
     <td colspan="1" valign="top" class="options" >Annotatsioon</td>
     <td class="options" ><span class="options">
	<?
$oFCKeditor = new FCKeditor('seos_sisse') ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->Value = $sisse;
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '200' ;
$oFCKeditor->Create() ;
	?></td>
     <td class="options" ><strong>Isotroopseks</strong></td>
     <td class="options" ><label>
       <input type="checkbox" name="checkbox2" value="checkbox">
     </label></td>
   </tr>
<tr background="image/sinine.gif"> 
    <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr>
     <td colspan="1" valign="top" class="options" >Sisu</td>
     <td class="options" ><span class="options">
	<?
$oFCKeditor = new FCKeditor('seos_sisu') ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->Value = $sisu;
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '400' ;
$oFCKeditor->Create() ;
	?></td>
     <td class="options" >&nbsp;</td>
     <td class="options" >&nbsp;</td>
  </tr>
<tr background="image/sinine.gif"> 
    <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr align="left" > 
    <td colspan="4" class="menu" ><input type="submit"  class="button" value="Salvesta" >
      <input type="button"  class="button" value="Katkesta" onClick="window.close();">       </td>
  </tr></form>
</table>
<? 
} 
}
?>
