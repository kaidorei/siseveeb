<link href="scat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ahaa.js"></script>
<br>
<?
	$action=$_GET["action"];
	$liik=$_GET["liik"];
	$efs=$_GET["efs"];
	$count=1;
	$count_vahe=1;
	
//************************************************************************************
/*function juhuslik_parool() {
    $uus_parool = "";
    $pikkus = 4;
    $rida = 
"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    mt_srand((double)microtime()*1000000);

    for ($i=1; $i <= $pikkus; $i++) {
        $uus_parool .= substr($rida, mt_rand(0,strlen($rida)-1), 1);
    }

    return $uus_parool;
}
*/
//echo juhuslik_parool();
//************************************************************************************	

	
	
	if($action=="del"){
		$iid=$_GET["iid"];
		$pw=$_GET["pw"];
		$mediadirs=array("isik_pildid");
		foreach($mediadirs as $tmp){
			$dd="media/".$tmp;
			//echo $dd;
			$q="SELECT url FROM ".$tmp." WHERE oid=".$iid;
			$r=mysql_query($q);
			while($line=mysql_fetch_array($r)){
				 unlink(urldecode($line["url"]));  
				}	
			}				
		$tables=array('isik_lingid');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$iid;
			$r=mysql_query($q);
		}
	
		$tables=array('isik_alog');
		foreach($tables as $name){
			$q="DELETE FROM ".$name." WHERE oid=".$iid;
			$r=mysql_query($q);
		}
		$q="DELETE FROM isik WHERE id=".$iid;
//		echo $q;
		$r=mysql_query($q);
	}



$emailirida='';
//echo $emailirida;	
$query21="SELECT email1, on_reisijuht FROM isik WHERE on_reisijuht=1";
$result21=mysql_query($query21);

while($line21=mysql_fetch_array($result21)){
$emailirida=sprintf("%s %s;",$emailirida, $line21["email1"]);
}


$query="";
//echo "liik",$liik;
switch($liik)
{
	case 1: //teadusbussi rahvas		
		$query="SELECT * FROM isik WHERE eesnimi LIKE '%".$_POST["search_str"]."%' AND in_buss=1 ORDER BY eesnimi ";
		$varq = "Teadusbussi rahvas";
		break;
		
	case 2: //EFS
		$query="SELECT * FROM isik WHERE eesnimi LIKE '%".$_POST["search_str"]."%' AND in_efs=1 ORDER BY eesnimi ";
		$varq = "EFS liikmed";
		break;
		
	case 3: //FI
		$query="SELECT * FROM isik WHERE eesnimi LIKE '%".$_POST["search_str"]."%' AND on_fi=1 ORDER BY eesnimi ";
		$varq = "FI rahvas";
		break;
		
	case 4: //füüsikaõpetajad
		$varq = "Füüsikaõpetajad";
		$query="opetajad";
		break;
	
	case 5: //GLOBE õpetajad
		$varq = "GLOBE õpetajad";
		$query="globe";
	break;
	case 6: //Keemia õpetajad
		$varq = "Keemia õpetajad";
		$query="keemia";
	break;
	case 7: //GLOBE õpetajad
		$varq = "Bioloogia õpetajad";
		$query="bioloogia";
	break;
	case 8: //GLOBE õpetajad
		$varq = "Geograafia õpetajad";
		$query="geograafia";
	break;
	case 9: //Ninatargad
		$query="SELECT * FROM isik WHERE on_nublu=1 ORDER BY eesnimi ";
		$varq = "Ninatargad";
	break;
	
	case 100: //kõik
		$query="SELECT * FROM isik WHERE eesnimi LIKE '%".$_POST["search_str"]."%' ORDER BY eesnimi ";
		$varq = "Kogu rahvas";
		break;
	
		
	default:
	$varq = "vali ülemisest reast tarvilik huvigrupp";
	
}
//echo $query;

	// kui on vaikimisi k6ik valitud, 						
	/*
	else{
	// leiame id-le vastava kategoorianime andmebaasist ...
		if(!$_POST["kategooria_id"] == 0 and $_POST["knowhow_id"] == 0){
			$query="SELECT eesnimi,perenimi,id,kategooria_id,kategooria_id1, on_reisijuht FROM isik WHERE kategooria_id =".$_POST["kategooria_id"]. " OR kategooria_id1 =".$_POST["kategooria_id"];
			$queryq="SELECT nimi FROM isik_kategooria WHERE id=".$_POST["kategooria_id"];
			$resultq=mysql_query($queryq);
			$varq1 = mysql_result($resultq, 0);
			}
		if(!$_POST["knowhow_id"] == 0 and $_POST["kategooria_id"] == 0){
			$query="SELECT eesnimi,perenimi,id,kategooria_id,kategooria_id1, on_reisijuht FROM isik WHERE knowhow_id =".$_POST["knowhow_id"]. " OR knowhow_id1 =".$_POST["knowhow_id"];
			$queryq="SELECT nimi FROM knowhow WHERE id=".$_POST["knowhow_id"];
			$resultq=mysql_query($queryq);
			$varq2 = mysql_result($resultq, 0);
			}
		if(!$_POST["knowhow_id"] == 0 and !$_POST["kategooria_id"] == 0){			
			$query="SELECT eesnimi,perenimi,id,kategooria_id,kategooria_id1, on_reisijuht FROM isik WHERE (knowhow_id =".$_POST["knowhow_id"]. " OR knowhow_id1 =".$_POST["knowhow_id"].") AND  (kategooria_id =".$_POST["kategooria_id"]. " OR kategooria_id1 =".$_POST["kategooria_id"].")";

			$queryq="SELECT nimi FROM isik_kategooria WHERE id=".$_POST["kategooria_id"];
			$resultq=mysql_query($queryq);
			$varq1 = mysql_result($resultq, 0);

			$queryq="SELECT nimi FROM knowhow WHERE id=".$_POST["knowhow_id"];
			$resultq=mysql_query($queryq);
			$varq2 = mysql_result($resultq, 0);
			}
		$varq=$varq1 ." : ". $varq2;
//		echo $query;
	}*/
if ($query)	

{




	$result=mysql_query($query);
//	echo $query;
//esimene tabeli rida annab kategooria nime ...	
	?><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="image/sinine.gif">          
  		<td width="40%" background="image/sinine.gif" class="pealkiri"><img src="image/sinine.gif" width="1" height="1"><font size="-1" face="Arial, Helvetica, sans-serif"><strong><? echo $varq ?></strong></font></td>
       	<td width="40%" background="image/sinine.gif" class="menu"><?  if ($priv>=5) {?><a href="http://www.fyysika.ee/omad/isik_table_maksud.php">&nbsp;liikmemaksud</a>, <a href="http://www.fyysika.ee/omad/isik_table_EFSaadress.php">aadressilipikud</a>, <a href="http://www.fyysika.ee/omad/isik_table_listi.php">L</a>      	  <? }?></td>
       	<td width="17%" valign="middle"background="image/sinine.gif"  class=""><div align="right" class="menu">Kiri&nbsp;k&otilde;igile&nbsp;reisijuhtidele: </div></td>
        <td width="3%" valign="middle"background="image/sinine.gif"  class=""><div align="right" class="menu"><a href="mailto:<? echo $emailirida;?>"><img border="0" src="image/EmailIcon.jpg" alt="email reisijuhtidele" width="18" height="20" /></a></div></td>
        </tr></table>

<?
			if($liik<4 || $liik==9 || $liik==100 )
			{ ?>
			
			
<table width="100%" border="0" cellspacing="0" cellpadding="0">		<?

		while($line=mysql_fetch_array($result)){
		
			
			if($line["password"]==md5("vanker"))
			{
//			echo "ha-haaa!";
			//	$ch = $line["perenimi"];
				//$ch = strtolower($ch);
		//		$userna = strtolower($line["eesnimi"])."".$ch{0};
	//			$pa = strtolower("vanker");
//				echo $ch{0};
//				$queryy="UPDATE isik SET username='".$userna."',password=MD5('".$pa."') WHERE perenimi='".$line["perenimi"]."' AND eesnimi='".$line["eesnimi"]."'";
//			echo $queryy;
//			$resulti=mysql_query($queryy);
//			echo $resulti;
				
			}
			?>
	        <tr background="image/sinine.gif"> 
          	<td colspan="9" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td width="2%" class="navi"><? echo $count,".";?><img border=0 src="image/spacer.gif" width="10" height="10"></td>
	       <td width="8%" class="navi"><?php if ($line["on_reisijuht"]) {?><img src="image/biggrin.gif" border="0" alt="reisijuht" width="15" height="15" /><? 
}else{?><? }?><img border=0 src="image/spacer.gif" width="10" height="10"></td>
	       <td  width="29%" class="menu" nowrap><a href="index.php?page=isik_disp&iid=<? echo $line["id"]; ?>&liik=<? echo $liik;?>"><? echo $line["eesnimi"]." ".$line["perenimi"]; ?></a></td>
           <td  width="4%" class="navi" nowrap><? if ($line["email1"]) { ?><a href="mailto:<? echo $line["email1"]; ?>" class="navi" ><? echo $line["email1"]; ?></a><? } ?></td>
           <td  width="5%" class="menu" nowrap align="center"><? echo $line["mobla"]; ?></td>
           <td  width="1%" class="navi" nowrap> <? if($line["b_kat"]){?>
             B             <? }?> </td>
           <td  width="1%" class="menu" nowrap><a href="skype:<? echo $line["skype"]; ?>?chat"><?php if ($line["skype"]) {?><img src='http://mystatus.skype.com/mediumicon/<? echo $line["skype"]; ?>' style="border: none;" alt="Proovi helistada!" /></a><?php }?>
<!--see va pildi küsimine Skype'ist annab exploreris ühe tulemuse, Mozillas teise, õige  ...--></td>
           <td width="1%" valign="middle"> <img width="50" border="0" src="<? echo urldecode($line["veeb_pilt_url"]); ?>" alt="x" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC">    </td>
		   <td width="1%" nowrap class="smallbody"><? if($priv>=2) {?><a onclick='javascript:kysi("index.php?page=isik_table&action=del&iid=<? echo $line["id"]; ?>&liik=<? echo $liik; ?>","Oled päris kindel, et soovid selle isiku kustutada?")' class="button2">x</a><? } ?></td>
	       </tr>
	<?
	$count++;
	}	// ------------- peagrupi exponaat -----------
?>
</table>
<? }

else

{ 		switch($liik)
		{
			case 4: $aine_op="fyysika"; break;
			case 5: $aine_op="globe"; break;
			case 6: $aine_op="keemia"; break;
			case 7: $aine_op="bioloogia"; break;
			case 8: $aine_op="geograafia"; break;
			default: $aine_op="fyysika"; break;
		}
		
		//if($liik==5) $aine_op="globe"; else  $aine_op="fyysika"; 

		$query01="SELECT * FROM isik ORDER BY eesnimi ";
		$result01=mysql_query($query01);
		$count=0;
		$line_rida=array();
		
		
		while($line01=mysql_fetch_array($result01))
		{
			$query00="SELECT * FROM isik_kool WHERE oid1=".$line01['id']." AND sisu2='".$aine_op."'";
			$result00=mysql_query($query00);
			if($line00=mysql_fetch_array($result00))
			{
				$line_rida[$count]['id']=$line01['id'];
				$line_rida[$count]['eesnimi']=$line01['eesnimi'];
				$line_rida[$count]['perenimi']=$line01['perenimi'];
				$line_rida[$count]['email1']=$line01['email1'];
				$line_rida[$count]['email2']=$line01['email2'];
				$line_rida[$count]['in_efs']=$line01['in_efs'];
//				echo $line01['eesnimi'];
//				echo "tykk",$line_rida[$count]['eesnimi'];			
				$count++;
			}
		}

//echo "tykk",$line_rida[44]['eesnimi'];
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">		<?
		
		$count=0; $olemas=0;
		while($line=$line_rida[$count]){
		// Vaatame, kas tegelane on käinud kohal olulistel üritustel:
		switch($aine_op)
		{
			case "fyysika": 
	//			echo "SELECT * FROM reis_isik WHERE oid1=765 AND oid2='".$line_rida[$count]["id"]."'";
				// 765 on sügisseminar
				if($line00=mysql_fetch_array(mysql_query("SELECT * FROM reis_isik WHERE oid1=765 AND oid2='".$line_rida[$count]["id"]."'")))
				{
//				echo "olemas", $line_rida[$count]["perenimi"];
					$olemas=1;
				}
				else
				{
					$olemas=0;
				}
			
			break;
			case "globe": 
			
			
			break;		
		}
		
		
		
			
			?>
	        <tr background="image/sinine.gif"> 
          	<td colspan="9" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td width="1%" valign="top" class="navi"><? echo $count,".";?></td>
		   <td width="1%" valign="top" class="navi"><? if ($line["in_efs"]) {?>
		     <span class="button3">+</span>
		     <? } else { ?>
		     <span class="button2">-</span><? }?></td>
	       <td  width="34%" valign="top" nowrap class="menu"><a href="index.php?page=isik_disp&iid=<? echo $line["id"]; ?>&pw=<? echo $pw;?>&liik=<? echo $liik;?>" <? if($olemas==1) echo "class=\"ekraan_link\""; else echo "class=\"menu\""; ?>><? echo $line["eesnimi"]." ".$line["perenimi"]; ?></a></td>
           <td  width="4%" valign="top" nowrap class="menu"><? if ($line["email1"]) { ?><a href="mailto:<? echo $line["email1"]; ?>"><? echo $line["email1"]; ?></a><? } ?></td>
           <td  width="17%" align="center" valign="top" nowrap class="menu"><? echo $line["mobla"]; ?></td>
           <td  width="28%" valign="top" nowrap class="navi"><? 
		   
		   
		   
			$query02="SELECT * FROM isik_kool WHERE oid1=".$line["id"];
			$result02=mysql_query($query02);
		
		
			while($line02=mysql_fetch_array($result02))
			{
				$query03="SELECT * FROM kool WHERE id=".$line02['oid2']."";
				$result03=mysql_query($query03);
				$line03=mysql_fetch_array($result03); ?>
				<a href="http://www.fyysika.ee/omad/index.php?page=kool_disp&amp;fid=<? echo $line03['id'];?>"><? echo $line03['nimi'];?> </a>-<? echo $line02['sisu2'];?><br/><? }
	   
		   
		   
		   
		   
		   ?></td>
           
           <!--<td width="4%" valign="middle"> <img width="50" border="0" src="<? //echo urldecode($line["veeb_pilt_url"]); ?>" alt="x" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC">    </td>-->
		   <td width="6%" valign="top" nowrap class="smallbody"><? if($priv>=2) {?><a href="index.php?page=isik_table&action=del&iid=<? echo $line["id"]; ?>&liik=<? echo $liik; ?>" class="button2">x</a><? } ?></td>
	       </tr>
	<?
	if ($line["email1"]) { $emailirida_op=sprintf("%s %s;",$emailirida_op, str_replace("%20", "", ($line["email1"])));}
//echo  str_replace("%20", "", ($line["email1"]));

	if ($count_vahe>100) { $emailirida_op=sprintf("%s </br></br>",$emailirida_op); $count_vahe=1;}
	$count++;
	$count_vahe++;
	}	// ------------- peagrupi exponaat -----------
?>
<tr><td colspan="7"><div align="right"><? if($priv>=9) { ?> <a href="mailto:<? echo $emailirida_op;?>"><img border="0" src="image/EmailIcon.jpg" alt="email" width="18" height="20" /></a><?   }?></div><? //echo $emailirida_op;?></td></tr>
</table>

<? }



} else 
{
?>
<span class="menu_punane">Vali ülemisest ribast sihtrühm ...</span>
<?
}?>
