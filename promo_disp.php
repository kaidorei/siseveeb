<?  
	//include("FCKeditor/fckeditor.php") ;
	include("globals.php") ;
	include("tabel_class_iid.php");
	$eh=$_GET["action"];
	$tid=$_GET["tid"];
	$count_all = 0;
	if($eh=="uuenda")
	{
//	echo "uuenda";
		$valjad=array("title","body","body_text","date","personal","sent_to","sent_to_n","valislink", "date_end");
		foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
		}
		$query="UPDATE teade SET ".implode(",",$rida)." WHERE id=".$tid;		
//		echo $query;
		$result=mysql_query($query);
		
	}
	if($eh=="new"){
	  $tmp=mysql_query("INSERT INTO teade (title, date) VALUES (\"Nimetu\",\"000-00-00\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$tid=$tmp["last_insert_id()"];
//		echo $tid;
		// ------------------------------------------------
	} elseif($eh=="save")
	{
	echo "salvesta";
//	echo $eh;

	// salvestame kogu lehe ...
// Loeme andmebaasist olemasoleva tabeli
	$result=mysql_query("SELECT * FROM isik WHERE on_meedia=1 ORDER BY id DESC" );
	while($line=mysql_fetch_array($result))
	{
//		echo $line["perenimi"],"<br>";
		if($_POST["on_meedia_".$line["id"]])
		{
			$query_update = "UPDATE `isik` SET `on_meedia` = '".$_POST["on_meedia_".$line["id"]]."', `on_ut` = '".$_POST["on_ut_".$line["id"]]."', `on_ajak` = '".$_POST["on_ajak_".$line["id"]]."', `on_sk` = '".$_POST["on_sk_".$line["id"]]."', `on_ef` = '".$_POST["on_ef_".$line["id"]]."', `on_promi` = '".$_POST["on_promi_".$line["id"]]."' WHERE `id` =".$line["id"]." LIMIT 1";
//			echo $query_update;
		$result_update=mysql_query($query_update);
		$line_update=mysql_fetch_array($result_update);
		}
		else
		{
			echo "jama!";
		}
	}
	
	
	
	
	
	}

?>
<link href="scat.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js"></script>
<? 
	$query="SELECT * FROM teade WHERE id='".$tid."' LIMIT 1";
//	echo $query;
	$result=mysql_query($query);
	$line_asi=mysql_fetch_array($result);


?><form name="uuenda" method="post" action="<? echo $PHP_SELF."?page=promo_disp&action=uuenda&tid=".$tid."&pw=".$pw; ?>">
  <table width="100%" border="0">
  <tr>
    <td colspan="7" class="pealkiri">Adressaadid:</td>
  </tr>
  <tr>
    <td width="11%"><input class="button" type="submit" name="Uuenda" value="Uuenda v&auml;ljad" /></td>
    <td width="15%" class="smallbody"><div align="right">Saadame testkirja iseendale?: </div></td>
    <td width="5%" class="smallbody">&nbsp;</td>
    <td width="10%" class="smallbody">&nbsp;</td>
    <td width="2%" class="smallbody"><div align="center"><span class="menu">
      <input name="personal" type="text" class="fields" value="<? echo $line_asi["personal"]; ?>" size="2" >
    </span></div></td>
    <td width="20%" class="smallbody"><? 	echo "(";
	if ($_POST["meedia"]) { echo "meedia ";}
	if ($_POST["ajak"]) { echo "ajak ";}
	if ($_POST["ut"]) { echo "ut ";}
	if ($_POST["promi"]) { echo "promi ";}
	if ($_POST["sk"]) { echo "sk ";}
	if ($_POST["fi"]) { echo "fi ";}
	if ($_POST["fyys"]) { echo "fyys ";}	
	if ($_POST["keem"]) { echo "keem ";}
	if ($_POST["bio"]) { echo "bio ";}
	if ($_POST["geo"]) { echo "geo ";}
	if ($_POST["ef"]) { echo "ef ";}
	if ($_POST["kool"]) { echo "kool ";}
	if ($_POST["nublu"]) { echo "nublu ";}
	if ($_POST["reis"]) { echo "reis ";}

	echo ")";
// Tekitame adressaatide nimekirja ...
	$count_mitu=0;
	$sent_to="";
	$sent_to_text="";
	$query_isik="SELECT * FROM isik ORDER BY id";
	$result_isik=mysql_query($query_isik);
	while($line_isik=mysql_fetch_array($result_isik))
	{
		$nimekirja=0;
		if ($_POST["meedia"]&&$line_isik["on_meedia"]) {$nimekirja=1;}
		if ($_POST["ajak"]&&$line_isik["on_ajak"]){$nimekirja=1;}
		if ($_POST["ef"]&&$line_isik["on_ef"]){$nimekirja=1;}
		if ($_POST["ty"]&&$line_isik["on_ut"]) {$nimekirja=1;}
		if ($_POST["efs"]&&$line_isik["in_efs"]) {$nimekirja=1;}
		if ($_POST["prom"]&&$line_isik["on_promi"]) {$nimekirja=1;}
		if ($_POST["sk"]&&$line_isik["on_sk"]) {$nimekirja=1;}
		if ($_POST["fi"]&&$line_isik["on_fi"]) {$nimekirja=1;}
		if ($_POST["nublu"]&&$line_isik["on_nublu"]) {$nimekirja=1;}
		if ($_POST["reis"])
		{
			// valime välja füüsika õpetajad
			$result001=mysql_query("SELECT oid2 from reis_isik where oid1 in (SELECT oid1 from reis_teade where oid2 = ".$tid.") AND oid2 = ".$line_isik['id']."");
			if($line001=mysql_fetch_array($result001))
				{
					$nimekirja=1;
					//echo $line_isik['id'];
				}
			}

			if ($_POST["fyys"])

			{

				// valime välja füüsika õpetajad
				$result00=mysql_query("SELECT * FROM isik_kool WHERE oid1=".$line_isik['id']." AND sisu2 LIKE '%fyysika%'");

				if($line00=mysql_fetch_array($result00))
				{
				// ok, kontrollime ka, kas isik on äkki juba end kirja pannud, siis teistkordselt teadet ei saada
					$result001=mysql_query("SELECT oid2 from reis_isik where oid1 in (SELECT oid1 from reis_teade where oid2 = ".$tid.") AND oid2 = ".$line_isik['id']."");
					if(!$line001=mysql_fetch_array($result001))
					{
						$nimekirja=1;
						//echo $count_all;
			//					$count_all++;
						//echo $line_isik['id'];
					}
				}
				}

		if ($_POST["keem"]) 
		{
			$result00=mysql_query("SELECT * FROM isik_kool WHERE oid1=".$line_isik['id']." AND sisu2='keemia'");
			if($line00=mysql_fetch_array($result00)){$nimekirja=1;}
		}
		if ($_POST["bio"]) 
		{
			$result00=mysql_query("SELECT * FROM isik_kool WHERE oid1=".$line_isik['id']." AND sisu2='bioloogia'");
			if($line00=mysql_fetch_array($result00)){$nimekirja=1;}
		}
		if ($_POST["geo"]) 
		{
			$result00=mysql_query("SELECT * FROM isik_kool WHERE oid1=".$line_isik['id']." AND sisu2='geograafia'");
			if($line00=mysql_fetch_array($result00)){$nimekirja=1;}
		}
		if ($_POST["kool"]) 
		{
			$result00=mysql_query("SELECT * FROM isik_kool WHERE oid1=".$line_isik['id']." AND sisu2='direktor'");
			if($line00=mysql_fetch_array($result00)){$nimekirja=1;}
		}
		
		if($nimekirja==1&&$line_isik["email1"])
		{
			$sent_to_text = $sent_to_text."; ".$line_isik["email1"] ; 
			if($count_mitu==0)
			{
				$sent_to = $line_isik["id"] ; 
			}
			else
			{
				$sent_to = $sent_to."; ".$line_isik["id"] ; 
			}
//			array_push($sent_to, $line_isik["id"]);
			$count_mitu++;
		}
		} 
		
		
		
if ($_POST["nublu2"]) 
{
// Tekitame adressaatide nimekirja õpikodade rahvast...
	$count_mitu_n=0;
	$sent_to_n="";
	$sent_to_text_n="";
	$query_nublud="SELECT * FROM moodle_nina.mdl_user ORDER BY id";
	$result_nublud=mysql_query($query_nublud);
	while($line_isik=mysql_fetch_array($result_nublud))
	{
		$nimekirja=1;
		if($nimekirja==1&&$line_isik["email"])
		{
			$sent_to_text_n = $sent_to_text_n."; ".$line_isik["email"] ; 
			if($count_mitu_n==0)
			{
				$sent_to_n = $line_isik["id"] ; 
			}
			else
			{
				$sent_to_n = $sent_to_n."; ".$line_isik["id"] ; 
			}
//			array_push($sent_to, $line_isik["id"]);
			$count_mitu_n++;
		}
		} 
}

/*if ($_POST["kool"])
{
	$result_koolid = sql_rida($userid,"SELECT kontakt2 FROM kool",1,1);
	while($line_koolid=mysql_fetch_array($result_koolid))
	{
		$sent_to = $sent_to."; ".$line_koolid["kontakt2"];
	}
	echo "koolid!!!1";	
}	
*/ 


?></td>
    <td width="37%"><div align="right">
      <input type="button" name="suva12" class="button" value="Saada kiri" onclick="window.open('Rmail/efs_mail.php?domain=<? echo $domain;?>&tid=<? echo $tid;?>&fkb=<? echo $_POST["nublu2"];?>','File_upload','toolbar=0, scrollbars=1, width=660,height=580,status=yes');" />
    </div></td>
  </tr>
  <tr>
    <td valign="top"><span class="navi"><strong>To</strong>:<br>
    <? echo "Adressaate: ", $count_mitu,"<br> &Otilde;pikodade rahvast: ",$count_mitu_n;?></span></td>
    <td colspan="5"><span class="navi">
	
      <textarea class="navi" name="sent_to" cols="75" rows="5"><? echo $sent_to;?></textarea>
    </span><td> <textarea class="navi" name="sent_to_n" cols="75" rows="5"><? echo $sent_to_n;?></textarea></td><td width="0%"></td>
    </tr>
  
  <tr>
    <td colspan="7" class="navi"><table width="100%" border="1">
  <tr>
    <td  class="menu"><div align="center">yldine</div></td>
    <td  class="menu">
      <div align="right">
        <input name="meedia" type="checkbox" id="meedia" value="checkbox" <? if ($_POST["meedia"]) { echo "checked=","\"checked\"";}?>/>
        </div></td>
    <td  class="menu"><div align="center">ajakirjani</div></td>
    <td  class="menu"><input name="ajak" type="checkbox" id="ajak" value="checkbox" <? if ($_POST["ajak"]) { echo "checked=","\"checked\"";}?>/></td>
    <td  class="menu"><div align="center">T&Uuml;&amp;teised</div></td>
    <td  class="menu"><input name="ut" type="checkbox" id="ty" value="checkbox" <? if ($_POST["ut"]) { echo "checked=","\"checked\"";}?>/></td>
    <td  class="menu"><div align="center">prominent</div></td>
    <td  class="menu"><input name="promi" type="checkbox" id="prom" value="checkbox" <? if ($_POST["promi"]) { echo "checked=","\"checked\"";}?>/></td>
    <td  class="menu"><div align="center">s&otilde;brad</div></td>
    <td  class="menu"><input name="sk" type="checkbox" id="sk" value="checkbox" <? if ($_POST["sk"]) { echo "checked=","\"checked\"";}?>/></td>
    <td  class="menu">Eesti F&uuml;&uuml;sika</td>
    <td  class="menu"><input name="ef" type="checkbox" id="ef" value="checkbox" <? if ($_POST["ef"]) { echo "checked=","\"checked\"";}?>/></td>
  </tr>
  <tr>
    <td colspan="2" valign="top" class="navi"><textarea class="navi" name="textarea" cols="20" rows="5"><? $query3="SELECT eesnimi FROM isik WHERE on_meedia=1 ORDER BY id DESC";
				        $result3=mysql_query($query3);
						while($t=mysql_fetch_array($result3)){ echo $t['eesnimi']," ",$t['perenimi'],"\r"; } ?></textarea>    </td>
    <td colspan="2" valign="top" class="navi"><textarea class="navi" name="textarea" cols="20" rows="5"><?  					
					   	$query3="SELECT * FROM isik WHERE on_ajak=1 ORDER BY id DESC";
				        $result3=mysql_query($query3);
						while($t=mysql_fetch_array($result3)){ echo $t['eesnimi']," ",$t['perenimi'],"\r"; }?></textarea></td>
    <td colspan="2" valign="top" class="navi"><textarea class="navi" name="textarea" cols="20" rows="5"><?  					
					   	$query3="SELECT * FROM isik WHERE on_ut=1 ORDER BY id DESC";
				        $result3=mysql_query($query3);
						while($t=mysql_fetch_array($result3)){echo $t['eesnimi']," ",$t['perenimi'],"\r"; }?></textarea></td>
    <td colspan="2" valign="top" class="navi"><textarea class="navi" name="textarea" cols="20" rows="5"><?  					
					   	$query3="SELECT * FROM isik WHERE on_promi=1 ORDER BY id DESC";
				        $result3=mysql_query($query3);
						while($t=mysql_fetch_array($result3)){echo $t['eesnimi']," ",$t['perenimi'],"\r"; }?></textarea></td>
    <td colspan="2" valign="top" class="navi"><textarea class="navi" name="textarea" cols="20" rows="5"><?  					
					   	$query3="SELECT * FROM isik WHERE on_sk=1 ORDER BY id DESC";
				        $result3=mysql_query($query3);
						while($t=mysql_fetch_array($result3)){ echo $t['eesnimi']," ",$t['perenimi'],"\r"; }?></textarea></td>
    <td colspan="2" valign="top" class="navi"><textarea class="navi" name="textarea2" cols="20" rows="5"><?  					
					   	$query3="SELECT * FROM isik WHERE on_ef=1 ORDER BY id DESC";
				        $result3=mysql_query($query3);
						while($t=mysql_fetch_array($result3)){ echo $t['eesnimi']," ",$t['perenimi'],"\r"; }?>
    </textarea></td>
  </tr>
  <tr>
    <td align="center" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=isik_table&amp;liik=9">õpikojad</a></td>
    <td class="menu"><input name="nublu" type="checkbox" id="nublu" value="checkbox" <? if ($_POST["nublu"]) { echo "checked=","\"checked\"";}?>/></td>
    <td class="menu" align="center">õpikojad2</td>
    <td class="menu"><input name="nublu2" type="checkbox" id="nublu2" value="1" <? if ($_POST["nublu2"]) { echo "checked=","\"checked\"";}?>/></td>
    <td class="menu" align="center">Reis</td>
    <td class="menu"><input name="reis" type="checkbox" id="reis" value="1" <? if ($_POST["reis"]) { echo "checked=","\"checked\"";}?></td>
    <td class="menu">&nbsp;</td>
    <td class="menu">&nbsp;</td>
    <td class="menu">&nbsp;</td>
    <td class="menu">&nbsp;</td>
    <td class="menu">&nbsp;</td>
    <td class="menu">&nbsp;</td>
  </tr>
  <tr>
    <td class="menu"><div align="center"><a href="http://www.fyysika.ee/omad/index.php?page=isik_table&liik=4" target="_blank">f&uuml;&uuml;sika&otilde;p.</a></div></td>
    <td class="menu"><input name="fyys" type="checkbox" id="fyys" value="checkbox" <? if ($_POST["fyys"]) { echo "checked=","\"checked\"";}?>/></td>
    <td class="menu"><div align="center"><a href="http://www.fyysika.ee/omad/index.php?page=isik_table&amp;liik=6" target="_blank">keemia&otilde;p.</a></div></td>
    <td class="menu"><input name="keem" type="checkbox" id="keem" value="checkbox" <? if ($_POST["keem"]) { echo "checked=","\"checked\"";}?>/></td>
    <td class="menu"><div align="center"><a href="http://www.fyysika.ee/omad/index.php?page=isik_table&amp;liik=7" target="_blank">bioloogia&otilde;p.</a></div></td>
    <td class="menu"><input name="bio" type="checkbox" id="bio" value="checkbox" <? if ($_POST["bio"]) { echo "checked=","\"checked\"";}?>/></td>
    <td class="menu"><div align="center"><a href="http://www.fyysika.ee/omad/index.php?page=isik_table&amp;liik=5" target="_blank">geograafia&otilde;p.</a></div></td>
    <td class="menu"><input name="geo" type="checkbox" id="geo" value="checkbox" <? if ($_POST["geo"]) { echo "checked=","\"checked\"";}?>/></td>
    <td class="menu"><div align="center"><a href="http://www.fyysika.ee/omad/index.php?page=isik_table&amp;liik=2" target="_blank">EFS</a></div></td>
    <td class="menu"><input name="efs" type="checkbox" id="efs" value="checkbox" <? if ($_POST["efs"]) { echo "checked=","\"checked\"";}?>/></td>
    <td class="menu">direktorid</td>
    <td class="menu"><input name="kool" type="checkbox" id="kool" value="checkbox" <? if ($_POST["kool"]) { echo "checked=","\"checked\"";}?>/></td>
  </tr>
  
</table></td>
  </tr>
  <tr>
    <td colspan="7" class="pealkiri">Teemarida:</td>
  </tr>
  <tr>
    <td colspan="7" class="pealkiri"><input name="title" type="text" class="fields" value="<? echo $line_asi["title"]; ?>" size="100" ></td>
  </tr>
  <tr>
    <td colspan="7" class="pealkiri">Tekstirida:</td>
  </tr>
  <tr>
    <td colspan="7" class="pealkiri"><textarea name="body_text" cols="90" rows="4"><? echo $line_asi["body_text"]; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="7" class="pealkiri">Saadetav kiri: </td>
  </tr>
  <tr>
    <td colspan="7" class="navi"><textarea class="ckeditor" cols="120" name="body" rows="120"><? echo $line_asi["body"];?></textarea>
</td>
  </tr>
</table>

</form>
<?
tabel2("reis_teade",$tid,$_SESSION["mysession"]["login"],2,1,"Millise sündmuse kohta? Kes on registreerunud, need teateid ei saa.");
?>
					    <form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=promo_disp&action=save&tid=".$tid."&pw=".$pw; ?>">
						<table width=800 border=\"0\" cellspacing=\"1\" cellpadding=\"0\">
						<tr>
						  <td width=494 background="images/sinine.gif" class="menu">Kirjedus</td>
						  <td width=571 background="images/sinine.gif" class="menu">e-mail</td>
						  <td width="20" background="images/sinine.gif" class="menu" ><div align="center">yld</div></td>
					      <td width=26 background="images/sinine.gif" class="menu" ><div align="center">ajak</div></td>
					      <td width=20 background="images/sinine.gif" class="menu" ><div align="center">ut&amp;teised</div></td>
					      <td width=42 background="images/sinine.gif" class="menu" ><div align="center">sobrad</div></td>
					      <td width=35 background="images/sinine.gif" class="menu" ><div align="center">promi</div></td>
					      <td width=35 background="images/sinine.gif" class="menu" ><div align="center">ef</div></td>
					      <td width=35 background="images/sinine.gif" class="menu" >&nbsp;</td>
						</tr> 
						<?					
					   	$query2="SELECT * FROM isik WHERE on_meedia=1 ORDER BY id DESC";
				        $result2=mysql_query($query2);
						$query="SELECT privileegid FROM isik WHERE username='".$login."'"; 
						$result = mysql_query($query);
						$line=mysql_fetch_row($result); 
						while($t=mysql_fetch_array($result2)){ ?>
						 								<tr>
<td class="fields"><? echo $t["eesnimi"]," ", $t["perenimi"]; ?></td>
									<td class="fields"><? echo $t["email1"]; ?></td>
									<? echo $expid; ?>
									 <td> 
									   <div align="center">
									     <input name="on_meedia_<? echo $t["id"]; ?>" type="text" class="fields" size="1" value="<? echo $t["on_meedia"]; ?>">
								       </div>
								       </div></td> 
									 <td ><div align="center">
									   <input name="on_ajak_<? echo $t["id"]; ?>"  type="text" class="fields" size="1" value="<? echo $t["on_ajak"]; ?>">
									   </div></td>
									 <td ><div align="center">
									   <input name="on_ut_<? echo $t["id"]; ?>" type="text" class="fields" size="1" value="<? echo $t["on_ut"]; ?>">
									   </div></td>
						             <td width="42" ><div align="center">
						               <input name="on_sk_<? echo $t["id"]; ?>" type="text" class="fields" size="1" value="<? echo $t["on_sk"]; ?>">
						               </div></td>
						             <td ><div align="center">
						               <input name="on_promi_<? echo $t["id"]; ?>" type="text" class="fields" size="1" value="<? echo $t["on_promi"]; ?>">
						               </div></td>
						             <td ><div align="center">
						               <input name="on_ef_<? echo $t["id"]; ?>" type="text" class="fields" size="1" value="<? echo $t["on_ef"]; ?>" />
						               </div></td>
						             <td >&nbsp;
									 	<input type="button" class="button2" value="x" onClick="window.open('promo_dellink.php?domain=isik&rid=<? echo $t["id"]; ?>','Delete','toolbar=0,width=420,height=200,status=yes')" ></td>
						</tr> 		
						  <tr background="images/sinine.gif"><td colspan="13" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        				  </tr><? } ?><tr align="left" >
						  <td class="menu" colspan="13" ><!--<input type="button" name="suva1" class="button" value="Lisa uus" onclick="window.open('promo_addlink.php?domain=isik','File_upload','toolbar=0,width=690,height=160,status=yes')" />	-->			<input class="button" type="submit" name="Submit" value="Salvesta"></td>
        				  </tr></table>
					    
                        </form>

