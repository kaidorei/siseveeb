<?  function tabel_kutse($domain,$oid,$login,$sel,$lisa){
	switch ($sel)
	{
	case 1:	$query2="SELECT id,oid2 FROM ".$domain." WHERE oid1=".$oid;
		break;
	case 2:	$query2="SELECT id,oid1 FROM ".$domain." WHERE oid2=".$oid;
		break;
	}
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

$count=1;
$temp=array();

	while($tulem=mysql_fetch_array($result2))
	{
		switch ($sel)
		{
		case 1:$qu="SELECT * FROM ".$dom2." WHERE id=".$tulem["oid2"];
			break;
		case 2: $qu="SELECT * FROM ".$dom1." WHERE id=".$tulem["oid1"];
			break;
		}

		
		$r=mysql_query($qu);
		$t=mysql_fetch_array($r);
		 
	$query="SELECT privileegid FROM isik WHERE username='".$login."'"; 
	$result = mysql_query($query);
	$line=mysql_fetch_row($result);
 
				?>
				
				<tr>
				  <td valign="middle" class="fields"><? echo $count;?>.  <span class="menu_punane"><? 	
switch ($t["etendus_id"])
	{
	case 1: echo "FÜÜSIKA etendus"; break;
	case 2: echo "KEEMIA etendus"; break;
	case 4: echo "ROBOOTIKA etendus"; break;
	case 5: echo "MATERJALIDE etendus"; break;
	case 3: echo "VALGUSE etendus"; break;
	default: echo "ID: ",$t["etendus_id"]; break;
	}
	
	 ?></span> (<? echo $t["date"];?>)</td>
				  <td><input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=<? echo $asi["domain"];?>&id=<? echo $asi["id"]?>&sel=<? echo $asi["sel"]?>','Delete','toolbar=0,width=1020,height=800,status=yes');" ></td>
				<td><input type="button" class="button2" value="x" onClick="window.open('delvalue_iid.php?domain=<? echo $domain;?>&id=<? echo $tulem["id"]?>','Delete','toolbar=0,width=420,height=200,status=yes');" ></td>
				</tr>
				<tr>
				  <td valign="middle" class="fields"><? echo $t["nimi"]; ?> (<? echo $t["aadress"]; ?>) </td>
				  <td colspan="2">&nbsp;</td>
  </tr>
				<tr>
				  <td colspan="3" valign="middle" class="fields">Kontakt: <a href="mailto:<? echo $t["email1"];?>"><? echo $t["kontakt1"]; ?></a>, tel: <? echo $t["tel1"]; ?></td>
  </tr>
				<tr>
				  <td colspan="3" valign="middle" class="fields">Kutse tekst: <? echo $t["markused"]; ?> <span class="ekraan_link"><? if($t["maksab"]==1) echo "(valmis maksma)"; else echo "(ei maksa)";?></span>				    </td>
  </tr>
				
				<?
				$count++;
				}

			  ?><tr background="images/sinine.gif"><td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td></tr><?
			  if($lisa == 1)
			  {
			  
			  ?> 

<?
			  }
			 
			  
			  
			  
?></table>
<?
			  
	}
?>