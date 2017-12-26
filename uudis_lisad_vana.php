<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td background="images/index_48.gif">&nbsp; </td>
</tr>
<?php
if ($_SERVER['SERVER_ADDR']=='127.0.0.1')
	{$tee="/home/janno/public_html/font/";} else {$tee="/ee/ahhaa/www/html/font/";}

$t6lge=array("õ" => "&otilde;", "ä" => "&auml;", "ö" => "&ouml;", "ü" => "&uuml;", "Õ" => "&Otilde;", "Ä" => "&Auml;", "Ö" => "&Ouml;", "Ü" => "&Uuml;");

if ($_GET['teema']=="Uudis")
	{//Teeme kontrolli uudisele ja sobivusel sisestame selle
		if ((strlen($_POST['pealkiri'])==0) or (strlen($_POST['sisu'])==0))
		{ 
			$uudis='vigane';
		}
		else
		{
			if ($_POST['keel']=='eesti')
			{ 
				$table='newsEST';
			} else
			{
				$table='newsENG';
			}
//asendame t2pilised ja reamurdmised:
		$upk = strtr($_POST['pealkiri'], $t6lge); //t2pilised pealkirjast
		$us = strtr($_POST['sisu'], $t6lge); //t2pilised sisust
		$us=str_replace("\r\n",'<br>',$us); //Miks mitte strtr abil? Ei tea enam...
		$paring='insert into '.$table." (Kuupaev,Pealkiri,Uudis) values (CURDATE(),'".$upk."','".$us."')";
		if (!mysql_query($paring))
		{
			$uudis='vigane';}
		}
	}

if ($_GET['teema']=='Viide')
	{//Teeme kontrolli viitele ja sobivusel sisestame selle
		if ((strlen($_POST['allikas'])==0) or (strlen($_POST['pealkiri'])==0) or ($_POST['aadress']=="http://") or ($_POST['aeg']=="aaaa-kk-pp"))
		{	
			$viide='vigane';
		}
		else
		{
			$table='artiklid';
			//asendame t2pilised:
			$vpk = strtr($_POST['pealkiri'], $t6lge); //t2pilised pealkirjast
			$va = strtr($_POST['allikas'], $t6lge); //t2pilised ajakirja nimest
			$paring="insert into ".$table." (kuupaev,ajaleht,pealkiri,url) values
			('".$_POST['aeg']."', '".$va."', '".$vpk."', '".$_POST['aadress']."')";
			if (!mysql_query($paring)) {$viide='vigane';}
		}
	}

if (($uudis=='vigane') or (strlen($_GET['teema'])==0) or ($viide=='vigane'))
	{
// teen tabeli ...
	?>
<tr> 
    <td background="images/sinine.gif" class="menu"><img src="images/spacer.gif" width="10" height="10">Uudiste lisamine AHHAA veebi (palun kontrolli, et brauserist valitud <font color="#DD0000"> Character Coding</font> oleks <font color="#DD0000">ISO-8859-15</font>): </td>
</tr>
<tr background="images/sinine.gif"> 
	 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
</tr>
<? if($uudis=='vigane') {?>
			<tr>			  
    			<td class="menu" width="20%" bgcolor="#FFFF00" align="center"> <font color="#FF0000"> Ära jäta tühje lahtreid!</td>
			</tr>
<? }
?>
<tr> 
    <td>
<center>
<form action="?page=uudis_disp&id=lisamine&teema=Uudis" method="POST">
	<table width="100%" border="0" cellpadding="0" cellspacing="2">
		<tr>
		<td valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr background="images/sinine.gif"> 
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
				<tr> 
				  <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
				  <td class="menu" width="20%">Vali uudise keel:</td>
				  <td class="menu" width="40%" > Eesti keeles <input type=radio name=keel value=eesti <?
						if (($_POST['keel']=="eesti") or (strlen($_POST['teema'])==0)) 
						{
							echo(' checked');
						};
				   ?>
				   >
				  </td>
				  <td class="menu" width="40%" > Inglise keeles <input type=radio name=keel value=inglise <?								  
						if (($_POST['keel']=="inglise") and ($_GET['id'])=='Uudis') 
						{
							echo(' checked');
						};
				  ?> 
				  > 
				  </td>
				</tr>
				<tr>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
				
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
				  <td class="menu" width="20%">Pealkiri:</td>
				  <td class="menu" width="80%" > <textarea rows=3 cols=100 class="fields" name=pealkiri><? echo $_POST['pealkiri'];?></textarea>  </td>
				<tr>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
				<tr> 
				  <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
				  <td class="menu" width="20%">Sisu:</td>
				  <td class="menu" width="80%" > <textarea rows=11 cols=100 class="fields" name=sisu><? echo $_POST['pealkiri'];?></textarea></td>
				</tr>
				<tr>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
				<tr> 
				  <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
				  <td class="menu" width="20%"><input class="button" type=submit name=saada value="Saadan &auml;ra"></td>
				  <td class="menu" width="80%" ><input class="button" type=reset name=tyhjenda value="T&uuml;hjenda lahtrid"></td>
				</tr>
				<tr>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
		</table>
		
	</table>
</form>
<tr> 
    <td background="images/sinine.gif" class="menu"><img src="images/spacer.gif" width="10" height="10">Artikli viite lisamine AHHAA veebi:</td>
</tr>
<? if($viide=='vigane') {?>
			<tr>			  
    			<td class="menu" width="20%" bgcolor="#FFFF00" align="center"> <font color="#FF0000"> Ära jäta tühje lahtreid!</td>
			</tr>
<? }
?>

<form action="?page=uudis_disp&id=lisamine&teema=Viide" method="POST">
	<table width="100%" border="0" cellpadding="0" cellspacing="2">
		<tr>
		<td valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr background="images/sinine.gif"> 
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
				
				<tr> 
				  <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
				  <td class="menu" width="20%">Ajaleht:</td>
				  <td class="menu" width="80%" > <textarea rows=1 cols=100 class="fields" name=allikas><? echo $_POST['allikas'];?></textarea>  </td>
				<tr>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
				<tr> 
				  <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
				  <td class="menu" width="20%">Artikli pealkiri:</td>
				  <td class="menu" width="80%" > <textarea rows=1 cols=100 class="fields" name=pealkiri><? echo $_POST['pealkiri'];?></textarea></td>
				</tr>
				<tr>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
				  <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
				  <td class="menu" width="20%">Aadress:</td>
				  <td class="menu" width="80%" > <textarea rows=1 cols=100 class="fields" name=aadress><?
				  		if (isset($_POST['aadress'])) 
						{
							echo($_POST['aadress']);
						} else 
						{
							echo("http://");
						}
				?></textarea></td>
				</tr>
				<tr>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
				  <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
				  <td class="menu" width="20%">Kuupäev:</td>
				  <td class="menu" width="80%" > <textarea rows=1 cols=100 class="fields" name=aeg><?
				  		if (isset($_POST['aeg']))
						{
							echo($_POST['aeg']);
						}
						else
						{
							echo("aaaa-kk-pp");
						}
				?></textarea></td>
				</tr>
				<tr>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
				<tr> 
				  <td><img src="images/spacer.gif" width="20" height="10"><img src="images/spacer.gif" width="10" height="10"></td>
				  <td class="menu" width="20%"><input class="button" type=submit name=saada value="Saadan &auml;ra"></td>
				  <td class="menu" width="80%" ><input class="button" type=reset name=tyhjenda value="T&uuml;hjenda lahtrid"></td>
				</tr>
				<tr>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
				</tr>
		</table>
		
	</table>
</form>
<tr> 
    <td background="images/sinine.gif" class="menu"><img src="images/spacer.gif" width="10" height="10">AHHAA veebi kasutamise statistika: </td>
</tr>
<tr> 
    <td>
	<form action="?page=uudis_disp&teema=statistika" method="post">
	Alates
	<select name="algusaasta" size=1 style="background-color:#BBDDFF;color:#000000;">
	<?php
	
	$praegune_aasta=date("Y");
	$praegune_kuu=date("n");
	$max=0; $y=1;
	
	for ($i=$praegune_aasta;$i>=1998;$i--)
			{echo('<option >'.$i."</option>/n");}
	?>
	</select>
	&nbsp;aastast&nbsp;
	<select name="aastaid" style="background-color:#BBDDFF;color:#000000;">
	<option>1</option><option>2</option><option>3</option>
	</select>
	&nbsp;aastat.
	
	<input type=submit name=saada value="Vaatan" style="background-color:#BBDDFF;color:#000000;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type=submit name=saada value="Viimase 13 kuu statistika" style="background-color:#BBDDFF;color:#000000;">
	</form>

<?
	}
?>
</td>
</tr>

	<?
if ($uudis!=='vigane' and $_GET['teema']=='Uudis')
	{	
	?>
	<tr> 
		<td background="images/sinine.gif" class="menu"><img src="images/spacer.gif" width="10" height="10">Uudiste lisamine AHHAA veebi (palun kontrolli, et brauserist valitud <font color="#DD0000"> Character Coding</font> oleks <font color="#DD0000">ISO-8859-15</font>): </td>
	</tr>
	<tr background="images/sinine.gif"> 
		 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	</tr>
	<tr>
    <td class="menu" width="100%" bgcolor="#FFFF00" align="center"> <font color="#FF0000"> <? echo $_GET['teema'];?> on edukalt sisestatud! (järgmise sisestamiseks vajuta WWW)</td>
	</tr>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><a href="http://www.ahhaa.ee/?leht=2&id=0" class="menu">Eestikeelsete uudiste leht</a>&nbsp;&nbsp;</td>
		<td align="right"><a href="http://www.ahhaa.ee/?leht=32&id=0" class="menu" align="center">Inglisekeelsete uudiste leht</a>&nbsp;&nbsp;</td>
	</table>
	</tr>
<?php }

if ($viide!=='vigane' and $_GET['teema']=='Viide')
	{	
	?>
	<tr> 
		<td background="images/sinine.gif" class="menu"><img src="images/spacer.gif" width="10" height="10">Artikli viite lisamine AHHAA veebi:</td>
	</tr>
	<tr background="images/sinine.gif"> 
		 <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	</tr>
	<tr>
    <td class="menu" width="100%" bgcolor="#FFFF00" align="center"> <font color="#FF0000"> <? echo $_GET['teema'];?> on edukalt sisestatud! (järgmise sisestamiseks vajuta WWW)</td>
	</tr>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center"><a href="http://www.ahhaa.ee/?leht=23" class="menu" >Artiklite lehek&uuml;lg</a></td>
	</table>
	</tr>
<?php }

if ((strlen($_GET['teema'])==10))
	{	
?>

<br clear=all>
<?php
if ($_POST['saada'] == "Vaatan")
	{
	//Kui kasutaja tahab vaadata tulevikustatistikat, siis keelan selle
	if (($_POST['algusaasta'] + $_POST['aastaid']) - 1 > $praegune_aasta)
		{$_POST['aastaid']=$praegune_aasta-$_POST['algusaasta']+1;}

	//Loeme massiivi perioodi iga kuu kylastatavuse
	for ($x=$_POST['algusaasta']; $x<$_POST['algusaasta'] + $_POST['aastaid']; $x++)
		{
		$content=file('../sadistika/'.$x);
		for ($z=1;$z<13;$z++)
			{
			$nimed[$y]=$z."-".$x;
			$koik_kuud[$y]=trim($content[$z-1]);
			if ($koik_kuud[$y] > $max) {$max = $koik_kuud[$y];}
			$y++;
			}
		}
	}
	else
	{
	//Loeme massiivi perioodi iga kuu kylastatavuse
	$content=file('../sadistika/'.($praegune_aasta-1));
	for ($x=$praegune_kuu-1;$x<=11;$x++)
		{
		$koik_kuud[$y]=trim($content[$x]);
		$nimed[$y]=($x+1)."-".($praegune_aasta-1);
		if ($koik_kuud[$y] > $max) {$max = $koik_kuud[$y];}
		$y++;
		}
	$content=file('../sadistika/'.$praegune_aasta);
	for ($x=0;$x<=$praegune_kuu-1;$x++)
		{
		$koik_kuud[$y]=trim($content[$x]);
		$nimed[$y]=($x+1)."-".($praegune_aasta);
		if ($koik_kuud[$y] > $max) {$max = $koik_kuud[$y];}
		$y++;
		}
	}

$max=($max{0}+1)*pow(10,strlen($max)-1);
$pilt_x=560; $pilt_y=300; $lisa_x=3; $lisa_y=3; $max_x=512; $max_y=256;
$tulpvahe=9; $tulplaius=30;
$vahemik=pow(10,strlen($max)-1);

$pilt = ImageCreate($pilt_x,$pilt_y);
define('SININE',ImageColorAllocate($pilt,0,0,255));define('PUNANE',ImageColorAllocate($pilt,255,0,0));
define('VALGE',ImageColorAllocate($pilt,255,255,255));define('MUST',ImageColorAllocate($pilt,0,0,0));
define('HALL',ImageColorAllocate($pilt,200,200,200));

ImageFill($pilt,0,0,HALL);
ImageLine ($pilt, $pilt_x-$lisa_x-$max_x-1, $lisa_y, $pilt_x-$lisa_x-$max_x-1, $lisa_y+$max_y,MUST);
ImageLine ($pilt, $pilt_x-$lisa_x-$max_x, $lisa_y+$max_y, $pilt_x-$lisa_x, $lisa_y+$max_y,MUST);

if ($_POST['saada'] == "Vaatan")
	{
	$tulpvahe=round($tulpvahe/$_POST['aastaid']);$tulplaius=round($tulplaius/$_POST['aastaid']);
	for ($i=1; $i<=12*$_POST['aastaid']; $i++)
		{
		$x1=$i*($tulplaius+$tulpvahe)-$tulplaius+$pilt_x-$lisa_x-$max_x;
		$x2=$i*($tulpvahe+$tulplaius)+$pilt_x-$lisa_x-$max_x;
		$y1=$max_y+$lisa_y-round($koik_kuud[$i]*$max_y/$max);
		$y2=$lisa_y+$max_y-1;
		imagefilledrectangle ($pilt, $x1, $y1, $x2, $y2, PUNANE);
		imagettftext ($pilt, 8, -90, $x2-round($tulplaius/2)-1, $y2+3, MUST, $tee.'arial.ttf', $nimed[$i]);
		}
	}
	else
	{
	for ($i=1; $i<=13; $i++)
		{
		$x1=$i*($tulplaius+$tulpvahe)-$tulplaius+$pilt_x-$lisa_x-$max_x;
		$x2=$i*($tulpvahe+$tulplaius)+$pilt_x-$lisa_x-$max_x;
		$y1=$max_y+$lisa_y-round($koik_kuud[$i]*$max_y/$max);
		$y2=$lisa_y+$max_y-1;
		imagefilledrectangle ($pilt, $x1,$y1,$x2,$y2, PUNANE);
		imagettftext ($pilt, 8, -90, $x2-round($tulplaius/2)-2, $y2+3, MUST, $tee.'arial.ttf', $nimed[$i]);
		}
	}


//Joonistame horisontaaltriibud ka peale
$style=array(SININE, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT);
ImageSetStyle($pilt, $style);
$y=$lisa_y+$max_y; $i=0;

imageline ($pilt, $pilt_x-$lisa_x-$max_x-4, $y, $pilt_x-$lisa_x-$max_x-1, $y,MUST);
imagettftext ($pilt, 8, 0, $pilt_x-$lisa_x-$max_x-13, $y+5, MUST, $tee.'arial.ttf', 0);

while (($y-round($vahemik*$max_y/$max))>$lisa_y)
	{
	$y=$y-round($vahemik*$max_y/$max);
	$i++;
	imageline ($pilt, $pilt_x-$lisa_x-$max_x, $y, $pilt_x-$lisa_x, $y,IMG_COLOR_STYLED);
	imageline ($pilt, $pilt_x-$lisa_x-$max_x-4, $y, $pilt_x-$lisa_x-$max_x-1, $y,MUST);
	imagettftext ($pilt, 8, 0, $pilt_x-$lisa_x-$max_x-8*strlen($vahemik*$i), $y+5, MUST, $tee.'arial.ttf', $vahemik*$i);
	}

ImagePng ($pilt,"../sadistika/graafik.png");
ImageDestroy($pilt);


?>


<tr>
	<td>
		<center><img src="../sadistika/graafik.png" border=1 alt="Klikkimisstatistika"></center>
	</td>
</tr>
<br clear=all>

<table border=1 bordercolor="#555588" cellpadding=2 cellspacing=0 align=center bgcolor="#EEEEEE">
	<tr align=center bgcolor="#DDDDDD"><td class="menu" bgcolor="#EEEEEE"></td><td>Jaan.</td><td>Veebr.</td><td>M&auml;rts</td><td>Aprill</td><td>Mai</td>
	<td>Juuni</td><td>Juuli</td><td>August</td><td>Sept.</td><td>Okt.</td><td>Nov.</td><td>Dets.</td><td>KOKKU</td></tr>
	<?php
	for ($x=1998;$x<=$praegune_aasta;$x++)
		{
		echo('<tr align=center><td bgcolor="#DDDDDD">'.$x.'</td>');
		$aasta=file('../sadistika/'.$x);
		$kokku_aastas=0;
		for ($y=0;$y<12;$y++)
			{echo("<td>".trim($aasta[$y])."</td>");
			$kokku_aastas=trim($aasta[$y])+$kokku_aastas;}
		echo("<td>$kokku_aastas</td></tr>\n");
		}
	?>
</table>
<br clear=all>
    </td>
</tr>
<? 
}?>
 
 
</table>

