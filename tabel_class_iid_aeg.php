<?  function tabel5($domain,$oid,$login,$sel,$lisa){
	switch ($sel)
	{
	case 1:	$query2="SELECT id,oid2 FROM ".$domain." WHERE oid1=".$oid;
		break;
	case 2:	$query2="SELECT id,oid1 FROM ".$domain." WHERE oid2=".$oid;
		break;
	}
// mittesümmeetrilisus, mis tuleneb juhust exp_exp, kus peaks lugema nii 
	
	
//	echo $query2;
	$result2=mysql_query($query2);
		?>
<link href="scat.css" rel="stylesheet" type="text/css" >
<table width="100%" border="0" cellspacing="1" cellpadding="0">
		<tr><td width="93%" background="images/sinine.gif" class="menu">Nimi</td>
		<td width="4%" align="center" valign="middle" background="images/sinine.gif" class="menu" >&nbsp;</td>
		<td width="3%" background="images/sinine.gif" class="menu" > </td>
		</tr>
		<?
		$dom1=substr($domain,0,strpos($domain,"_"));
		$dom2=substr($domain,strpos($domain,"_")+1,strlen($domain));
//******************************************************************************
	switch ($dom1)
	{
	case "isik": $asi1="eesnimi,perenimi,email1";
		break;
	case "kool": $asi1="nimi,email1";
		break;
	case "kutse": $asi1="nimi,email1";
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
	case "isik": $asi2="eesnimi,perenimi,email1";
		break;
	case "kool": $asi2="nimi,email1";
		break;
	case "kutse": $asi1="nimi,email1";
		break;
	case "reis": $asi2="id, nimi, algus, lopp";
		break;
	case "uudis": $asi2="title, urltitle";
		break;
	default: $asi2="nimi_est";
		break;
	}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
$count=1;
$temp=array();

	while($tulem=mysql_fetch_array($result2))
	{
		switch ($sel)
		{
		case 1:$qu="SELECT ".$asi2." FROM ".$dom2." WHERE id=".$tulem["oid2"];
			break;
		case 2: $qu="SELECT ".$asi1." FROM ".$dom1." WHERE id=".$tulem["oid1"];
			break;
		}

		
		$r=mysql_query($qu);
		$t=mysql_fetch_array($r);
		$my_oid2=$tulem["oid2"]; // et saaks õige kooli poole tormelda
		switch ($dom1)
		{
			case "isik": $asi3=$t["eesnimi"]." ".$t["perenimi"]; $idee1="iid"; $email1=$t["email1"];
				break;
			case "firma": $asi3=$t["nimi"]; $idee1="fid";
				break;
			case "vahendid": $asi3=$t["nimi_est"]; $idee1="vid";
				break;
			case "kool": $asi3=$t["nimi"]; $idee1="fid"; $email1=$t["email1"];
				break;
			case "kutse": $asi3=$t["nimi"]; $idee1="fid"; $email1=$t["email1"];
				break;
			case "exp": $asi3=$t["nimi_est"]; $idee1="expid";
				break;
			case "tootuba": $asi3=$t["nimi_est"]; $idee1="tootid";
				break;
			case "nupula": $asi3=$t["nimi_est"]; $idee1="nupid";
				break;
			case "knowhow": $asi3=$t["nimi_est"]; $idee1="kid";
				break;
			case "etendus": $asi3=$t["nimi_est"]; $idee1="etendusid";
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
			case "isik": $asi4=$t["eesnimi"]." ".$t["perenimi"]; $idee2="iid"; $email1=$t["email1"];
				break;
			case "firma": $asi4=$t["nimi"]; $idee2="fid";
				break;
			case "vahendid": $asi4=$t["nimi_est"]; $idee2="vid";
				break;
			case "kool": $asi4=$t["nimi"]; $idee2="fid"; $email1=$t["email1"];
				break;
			case "kutse": $asi4=$t["nimi"]; $idee2="fid"; $email1=$t["email1"];
				break;
			case "exp": $asi4=$t["nimi_est"]; $idee2="expid";
				break;
			case "tootuba": $asi4=$t["nimi_est"]; $idee2="tootid";
				break;
			case "nupula": $asi4=$t["nimi_est"]; $idee2="nupid";
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
			case "uudis": $asi4=$t["title"]; $idee2="pid";
				break;
			default: $asi4=$t["nimi_est"]; $idee2="pid";
			break;
		}


		switch ($sel)
		{
			case 1: 
				$nimi = $asi4;
				$temp[$nimi]["nimi"] = $nimi;
				$temp[$nimi]["oid_nimi"] = $idee2;
				$temp[$nimi]["oid"] = $tulem["oid2"];
				$temp[$nimi]["link"] = $link;
				$temp[$nimi]["dom"] = $dom2;
				$temp[$nimi]["email1"] = $email1;
				break;
				
			case 2:	
				$nimi = $asi3;
				$temp[$nimi]["nimi"] = $nimi;
				$temp[$nimi]["oid_nimi"] = $idee1;
				$temp[$nimi]["oid"] = $tulem["oid1"];
				$temp[$nimi]["link"] = $link;
				$temp[$nimi]["dom"] = $dom1;
				$temp[$nimi]["email1"] = $email1;
				break;
		}
		



		
		

	$query="SELECT privileegid FROM isik WHERE username='".$login."'"; 
	$result = mysql_query($query);
	$line=mysql_fetch_row($result);
 
	$temp[$nimi]["domain"] = $domain;
	$temp[$nimi]["id"] = $tulem["id"];
	$temp[$nimi]["sel"] = $sel;


	$count++;
}				
				

			  
			  
			  	array_multisort($temp, SORT_ASC,SORT_REGULAR); 
			  	$count=1;	$emailirida='';
			  	foreach ($temp as $asi)
			  	{
				
				?>
				
				<tr><td valign="middle" class="fields"><? echo $count;?>. <a href="index.php?page=<? echo $asi["link"], $asi["dom"];?>_disp&<? echo $asi["oid_nimi"];?>=<? echo $asi["oid"];?>" target=_blank><? echo $asi["nimi"]; ?></a></td>
				<td><? if($dom2=="kool"&&$sel==1){?><span class="button4">  <a href="index.php?page=arve_disp&action=new&kool_id=<? echo $asi["oid"];?>&reis_id=<? echo $oid;?>">A</a>&nbsp;</span>
				  <? }else{?> <input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=<? echo $asi["domain"];?>&id=<? echo $asi["id"]?>&sel=<? echo $asi["sel"]?>','Delete','toolbar=0,width=1020,height=850,status=yes');" ><? }?>				  </td>
				<td><input type="button" class="button2" value="x" onClick="window.open('delvalue_iid.php?domain=<? echo $asi["domain"];?>&id=<? echo $asi["id"]?>','Delete','toolbar=0,width=420,height=200,status=yes');" ></td>
				</tr>
				
				<?
				$count++;
				$emailirida=sprintf("%s %s;",$emailirida, $asi["email1"]);
				$emailirida2=sprintf("%s %s; ",$emailirida2, $asi["email1"]);
				}

			  ?><tr background="images/sinine.gif"><td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td></tr><?
			  if($lisa == 1)
			  {
			  
			  ?> <tr align="left" >
			      <td class="menu" ><input type="button" name="suva1" class="button" value="Lisa uus" onclick="window.open('addvalue_iid.php?domain=<? echo $domain;?>&oid=<? echo $oid;?>&sel=<? echo $sel;?>','File_upload','toolbar=0,width=660,height=580,status=yes');" >
			        <?

?></td>
				  <td colspan="2" align="right" class="menu" ><a href="mailto:<? echo $emailirida;?>"><img src="image/EmailIcon.jpg" alt="email" width="18" height="20" border="0" /></a></td>
				</tr>

<?
			  }
			 
			  
			  
			  
?></table>
<? //echo $emailirida2;
			  
	}
?>

<? 
//------------------------------------------------------------------------------------------------------------

 function tabel3($domain,$oid,$login,$lisa){
 
	$query2="SELECT * FROM ".$domain." WHERE oid1=".$oid." OR oid2=".$oid;
	$result2=mysql_query($query2);
		?>
<link href="scat.css" rel="stylesheet" type="text/css" >
<table width="100%" border="0" cellspacing="1" cellpadding="0">
		<tr><td width="93%" background="images/sinine.gif" class="menu">Nimi</td>
		<td width="4%" align="center" valign="middle" background="images/sinine.gif" class="menu" >&nbsp;</td>
		<td width="3%" background="images/sinine.gif" class="menu" > </td>
		</tr>
		<?


$count=1;
$temp=array();

	while($tulem=mysql_fetch_array($result2))
	{
		$qu="SELECT id, nimi_est FROM exp WHERE id=".$tulem["oid1"]." OR id=".$tulem["oid2"];
		$r=mysql_query($qu);
		while($t=mysql_fetch_array($r))
		{
			if($t["id"]!=$oid) //kui on sattunud iseenda id peale
			{
				$nimi=$t["nimi_est"];
				$idee1="expid";
				$temp[$nimi]["nimi"] = $nimi;
				$temp[$nimi]["oid_nimi"] = $idee1;
				if($t["id"]==$tulem["oid1"])
				{
					$temp[$nimi]["oid"] = $tulem["oid1"];
					$sel = 2;
				}
				else
				{
					$temp[$nimi]["oid"] = $tulem["oid2"];
					$sel = 1;
				}
				$temp[$nimi]["link"] = $link;
				$temp[$nimi]["dom"] = $dom1;
				$temp[$nimi]["email1"] = $email1;
				$temp[$nimi]["domain"] = $domain;
				$temp[$nimi]["id"] = $tulem["id"];
				$temp[$nimi]["sel"] = $sel;
			}
		}
	
		$count++;
	}				
				

			  
			  
			  	array_multisort($temp, SORT_ASC,SORT_REGULAR); 
			  	$count=1;	$emailirida='';
			  	foreach ($temp as $asi)
			  	{
				
				?>
				
				<tr><td valign="middle" class="fields"><? echo $count;?>. <a href="index.php?page=<? echo $asi["link"];?>exp_disp&<? echo $asi["oid_nimi"];?>=<? echo $asi["oid"];?>" target=_blank><? echo $asi["nimi"]; ?></a></td>
				<td><input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=exp_exp&id=<? echo $asi["id"]?>&sel=<? echo $sel;?>','Delete','toolbar=0,width=1020,height=800,status=yes');" >				  </td>
				<td><input type="button" class="button2" value="x" onClick="window.open('delvalue_iid.php?domain=exp_exp&id=<? echo $asi["id"]?>','Delete','toolbar=0,width=420,height=200,status=yes');" ></td>
				</tr>
				
				<?
				$count++;
				}

			  ?><tr background="images/sinine.gif"><td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td></tr><?
			  if($lisa == 1)
			  {
			  
			  ?> <tr align="left" >
			      <td class="menu" ><input type="button" name="suva1" class="button" value="Lisa uus" onclick="window.open('addvalue_iid.php?domain=<? echo $domain;?>&oid=<? echo $oid;?>&sel=<? echo $sel;?>','File_upload','toolbar=0,width=660,height=580,status=yes');" >
			        <?

?></td>
				  <td colspan="2" align="right" class="menu" ></td>
				</tr>

<?
			  }
			 
			  
			  
			  
?></table>
<?
			  
	}


?>