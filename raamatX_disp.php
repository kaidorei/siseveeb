<script>

function muuda_order(domain,field,element,seos_id)

{

	var mylist=document.getElementById(element).value;

//	document.getElementById("favorite").value=seos_id + " ja " + mylist;



	var xmlhttp;



	if (window.XMLHttpRequest)

	  {// code for IE7+, Firefox, Chrome, Opera, Safari

	  xmlhttp=new XMLHttpRequest();

	  }

	else

	  {// code for IE6, IE5

	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

	  }





//	xmlhttp.open("POST","demo_post.asp",true);

//	xmlhttp.send();



	xmlhttp.onreadystatechange=function()

	  {

	  if (xmlhttp.readyState==4 && xmlhttp.status==200)

		{

		document.getElementById("favorite").value=xmlhttp.responseText;

		}



	  }



	xmlhttp.open("GET","test_table_asp_order.php?domain="+domain+"&seosid="+seos_id+"&field="+field+"&order="+mylist,true);

	xmlhttp.send();	//mylist.options[mylist.selectedIndex].text;



}



</script>

<?

	include("globals.php");

	include("tabel_class_iid.php");

	include("tabel_class_oid.php");

	$aid=$_GET["aid"];

	if($aid)

	{

	$query="SELECT pid FROM raamatX WHERE id=".$aid;

//	echo $query;

    $result=mysql_query($query);

	$line=mysql_fetch_array($result);

	$pid=$line["pid"];
	$query_exp="SELECT id FROM exp WHERE raamatX_id=".$aid;
	$result_exp=mysql_query($query_exp);
	$line_exp=mysql_fetch_array($result_exp);
	$expid = $line_exp["id"];



	}

	if($pid==NULL){$pid=$_GET["pid"];};

	if($pid==NULL){$pid=2;};



	$query_liik="SELECT * FROM `raamatX_grupid_demo` WHERE id=".$pid;

	$result_liik=mysql_query($query_liik);

	$liik=mysql_fetch_array($result_liik);

	$tykid_liik_string=$liik["valjad_form"];

	$on_nahtav=$liik["valjad_form"].",".$liik["valjad_olulised"];

	//echo $on_nahtav;









	$eh=$_GET["action"];
	$sel=$_GET["sel"];
	$bookid=$_GET["bookid"];
	$klass_id=$_GET["klass_id"];
	$klass=$_GET["klass"];
	if(!$lang=$_GET["lang"]) $lang='est';
	if($keelevalik=$_POST["keelevalik"]) $lang=$keelevalik;

	//echo "asd",$keelevalik;
	//muudest lehtedest lähtudes, exp nupula ja muud, ei ole bookid parameetrit küljes,
	//kui raamatut vaatama hakkad, see tuleb siis võtta.

	if(!$bookid)

	{
		$query_temp="SELECT book_id FROM raamatX WHERE id=".$aid;
	//	echo $query;

		$result_temp=mysql_query($query_temp);

		$line=mysql_fetch_array($result_temp);

		$bookid=$line["book_id"];

//		echo "Ja raamatu id on: ",$bookid;

	}



	if($eh=="new"){

		$tmp=mysql_query("INSERT INTO raamatX (nimi_est,pid,book_id) VALUES (\"Nimetu\",'".$pid."','".$bookid."')");

		echo "INSERT INTO raamatX (nimi_est,pid,book_id) VALUES (\"Nimetu\",".$pid.",".$bookid.")";

		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

		$aid=$tmp["last_insert_id()"];





///-------------------------------------------

		if($klass_id and $klass)

		{

			if($sel==2)

			{

				$query_insert="INSERT INTO raamatX_".$klass." (oid1,oid2,book_id,sort_order) VALUES (\"".$aid."\",\"".$klass_id."\",\"".$bookid."\",\"".$aid."\")";

			}

			else

			{

				$query_insert="INSERT INTO ".$klass."_raamatX (oid1,oid2,book_id,sort_order) VALUES (\"".$klass_id."\",\"".$aid."\",\"".$bookid."\",\"".$aid."\")";

			}

			echo $query_insert;

			$tmp=mysql_query($query_insert);

		}

/*?>//-------------------------------------------<?php



		if($parent)

		{

			$query_seos= "INSERT INTO raamatX_raamatX (oid1,oid2,book_id,sort_order) VALUES (".$parent.",".$aid.",".$bookid.",".$aid.") ";

			echo $query_seos;

			$tmp=mysql_query($query_seos);

		}

//		echo $aid;

		// ------------------------------------------------?>
<?php */
	} elseif($eh=="save"){

		$tykid_liik=explode(",", $tykid_liik_string);

		//$valjad=array("nimi_est","nimi_show","tekst_est","naita_veebis", "kokkuv_est","tundide_arv");

/*		foreach($valjad as $var){

			$rida[$var]=$var."=\"".$db->real_escape_string($_POST[$var])."\"";

		}

*/	//echo $tykid_liik_string;

	foreach($tykid_liik as $var)

		{

			$rida[$var]=$var."='".$db->real_escape_string($_POST[$var])."'";

		}



	if($eh=="save" and $_POST["nimi_est"]){

		$query="UPDATE raamatX SET ".implode(",",$rida)." WHERE id=".$aid;		}

		//echo $query;

		$result=mysql_query($query);



		$query="SELECT * FROM raamatX WHERE id=".$aid;

		$result=mysql_query($query);

		$line=mysql_fetch_array($result);


//kommentaar


	if($_POST["open_exp"]==1)

	{

		$query2r="SELECT * FROM `raamatX_exp` WHERE oid1=".$aid." and naita_veebis=1 order by sort_order";

		//echo $query2r."<br>";

		$result2r=mysql_query($query2r);

		$count1=1;

		$lisatekst="";

		while($line2r=mysql_fetch_array($result2r))

		{

			$query32r="SELECT nimi_est FROM `exp` WHERE id=".$line2r["oid2"]." ";

			//echo $query32r."<br>";

			$result32r=mysql_query($query32r);

			$line32r=mysql_fetch_array($result32r);

			if($line2r["naita_veebis"]==1)

			{

			//echo $line["open_meta"];
				switch ($line["open_meta"])

				{

					case 0:
					$q33 = "UPDATE raamatX_exp SET title_est= '',meta_est= '' WHERE  id ='".$line2r["id"]."' LIMIT 1";

					//echo $q33;

					$r33=mysql_query($q33);

					break;



					case 1:

/*					$q33 = "UPDATE raamatX_exp SET sort_order='".$count1."' WHERE  id ='".$line2r["id"]."' LIMIT 1";

					//echo $q33;

					$r33=mysql_query($q33);

*/					break;

					case 2:
					$q33 = "UPDATE raamatX_exp SET title_est= '".$line32r["nimi_est"]."' , meta_est='".$count1.". ' WHERE  id ='".$line2r["id"]."' LIMIT 1";
					//echo $q33;
					$r33=mysql_query($q33);
					break;

					case 3:
					$q34 = "UPDATE raamatX_exp SET title_est= '".$line32r["nimi_est"]."' WHERE  id ='".$line2r["id"]."' LIMIT 1";					//echo $q34;

					$r34=mysql_query($q34);

					break;



					default: break;

				}

			}



		//echo $line2["veeb_pilt_url"]."<br>";

			if(!strpos($_POST["tekst_est"],$line2r["oid2"]))

			{

				$lisatekst = $lisatekst."<p>[£[".$line2r["oid2"]."]£]</p>";

			}

			$count1++;

		}

		if(strlen($lisatekst)>3)

		{

			$tekst= $_POST["tekst_est"]."".$lisatekst;

			$q22= "UPDATE raamatX set tekst_est = '".$tekst."' WHERE id = $aid LIMIT 1";

//			echo $q22;

			$r22=mysql_query($q22);

		}

	}
	// kas vastav exp objekt on olemas?
		$query_pid="SELECT * FROM raamatX WHERE id=".$aid;
		$result_pid=mysql_query($query_pid);
		$line_pid=mysql_fetch_array($result_pid);
		if(1) //$line_pid["pid"]==2
		{
			$query_exp="SELECT id,kirjeldus_est, veeb_pilt_url FROM exp WHERE raamatX_id=".$aid;
			$result_exp=mysql_query($query_exp);
			if($line_exp=mysql_fetch_array($result_exp))
			{
			//echo $line_exp["id"];
				$expid = $line_exp["id"];
			}
			else

			{

				echo "Vastavat exp objekti ei ole olemas ... teeme ...";

				$query_uusexp= "INSERT INTO exp (nimi_est,raamatX_id,gpid_demo,naita_veebis_est) VALUES ('".$line_pid["nimi_est"]."',".$aid.",43,1)";

				//echo $query_uusexp;

    			$result_uusexp=mysql_query($query_uusexp);

			}

// Kui on raamatu alajaotus, siis kirjutame exp objektile raamatu pildi



			if($line_pid["book_id"])
			{
//				echo "alajaotus";

				$query2="SELECT * FROM `raamat` WHERE id=".$line_pid["book_id"]."";

				$result2=mysql_query($query2);

				$line2=mysql_fetch_array($result2);

				//echo "sdf".$line2["veeb_pilt_url"]."<br>";

				if($line2["veeb_pilt_url"] and $expid and !$line_exp["veeb_pilt_url"])

				{

					$query22="UPDATE `fyysika_ee`.`exp` SET veeb_pilt_url='".$db->real_escape_string($line2["veeb_pilt_url"])."' WHERE id=".$expid." LIMIT 1";

					echo $query22,"<br><br>";

					$result22=mysql_query($query22);

				}

			}

			else //kui on seatud väli uuenda_pilt, siis panen vastava id-ga pildi pöidlapildi ptk objekti pöidlapildiks

			{

				if($_POST["update_image"])

				{

					$query25="SELECT * FROM `exp` WHERE id=".$_POST["update_image"]."";

					$result25=mysql_query($query25);

					$line25=mysql_fetch_array($result25);



					$query2x="UPDATE `fyysika_ee`.`exp` SET veeb_pilt_url='".$db->real_escape_string($line25["veeb_pilt_url"])."' , veeb_pilt_url_s='".$db->real_escape_string($line25["veeb_pilt_url_s"])."' WHERE id=".$expid." LIMIT 1";

					echo 	$query2x;

					$result2x=mysql_query($query2x);

				}

				else

				{
					//echo "VIGA";
				}
			}
// ... ning nikerdame annotatsiooniks tekstikatke ...
		$jupp=(substr($line_pid["tekst_est"],0,300));
		$pattern = '/\[\{\[\d+\]\}\]/';
		$replacement = '';
		$annot = preg_replace($pattern, $replacement, $jupp);
		$pattern = '/\[\@\[\d+\,\d+\]\@\]/';
		$annot = preg_replace($pattern, $replacement, $annot);
		$query23="UPDATE `fyysika_ee`.`exp` SET kirjeldus_est='".$db->real_escape_string($annot)."' WHERE id=".$expid." LIMIT 1";
			//echo $query23,"<br><br>";
		}
		$result23=mysql_query($query23);

// muudame exp objekti nime ...
		$query24="UPDATE `fyysika_ee`.`exp` SET nimi_est='".$db->real_escape_string($line_pid["nimi_est"])."' , nimi_eng='".$db->real_escape_string($line_pid["nimi_eng"])."' WHERE id=".$expid." LIMIT 1";
		$result24=mysql_query($query24);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Kontrollime üle raamatX_exp seosed. Kui mõne puhul book_id väärtus ei vasta raamatX.book_id, siis muudame.

	$query_f="SELECT * FROM `raamatX_exp` WHERE oid1=".$aid." order by sort_order";
	//echo $query_f."<br>";
	$result_f=mysql_query($query_f);
	$count1=1;
	while($line_f=mysql_fetch_array($result_f))
	{
		if ($line_f["book_id"]!=$line_pid["book_id"])
		{
			$query_f1="UPDATE `raamatX_exp` SET book_id=".$line_pid["book_id"]." WHERE id=".$line_f["id"];
			echo $query_f1;
			$result_f1=mysql_query($query_f1);
		}

	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// uuenda lemmad
		file_get_contents('http://opik.fyysika.ee/json.php/exp/updateLemmad?id='.$expid);
	}

	$query="SELECT * FROM raamatX WHERE id=".$aid;

//	echo $query;

    $result=mysql_query($query);

	$line=mysql_fetch_array($result);



	$pid=$line["pid"];



?>

<meta charset="utf-8">

<link href="scat.css" rel="stylesheet" type="text/css" />

<script src="ckeditor/ckeditor.js"></script>



<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=raamatX_disp&bookid=".$bookid."&action=save&aid=".$aid; ?>">



<table width="100%" border="0" cellpadding="5">

  <tr>

    <td colspan="2"><table width="100%" border="0">

      <tr>

        <td><input name="nimi_est" type="text" class="pealkiri" value="<? echo $line["nimi_est"]; ?>" size="55" /><input name="nimi_eng" type="text" class="pealkiri" value="<? echo $line["nimi_eng"]; ?>" size="55" />
          <? if($expid) {?>

          <a class="navi" href="<? echo $PHP_SELF."?page=exp_disp&expid=".$expid; ?>">exp</a> <? }?>
  	  <?
      $languages=array("est","eng","rus");
	//		  echo"hoi",$languages[0];

	  ?>
        <select name="keelevalik" id="keelevalik">
          <?
for ($i = 0; $i <= 2; $i++)

{
	if($languages[$i]==$lang) { $sel="selected"; } else { $sel="";}


		echo "<option value=\"".$languages[$i]."\" ".$sel.">".$languages[$i]."</option>";

}?>          </select></td>

        <td width="1%"><a href="http://opik.fyysika.ee/index.php/book/section/<? echo $aid;?>" target="_blank" class="menu_punane"><img src="image/icon_eopik.png" alt="eopikus" height="30" border="0" /></a></td>

        <td width="8%"><input class="button" type="submit" name="Submit" value="Salvesta" /></td>

      </tr>

    </table></td>

    </tr>



  <tr>

    <td align="left" valign="top">



<?

if(strpos($on_nahtav,"tekst_est"))

{



?>

<textarea class="ckeditor" cols="120" name="tekst_est" rows="120"><? echo $line["tekst_est"];?></textarea>
<textarea class="ckeditor" cols="120" name="tekst_eng" rows="120"><? echo $line["tekst_eng"];?></textarea>





<? }?>



     <?







tabel2("raamatX_oskus",$aid,$_SESSION["mysession"]["login"],1,1,"P&otilde;hivara",$bookid);

	?>



<?

if(strpos($on_nahtav,"meetod_est"))

{



?>



<span class="options">TUND (Õppemeetodid/ praktilised tööd ja IKT kasutamine/ hindamine/ õppekeskkond, näitlikustamine): </span>

<textarea class="ckeditor" cols="120" name="meetod_est" rows="50"><? echo $line["meetod_est"];?></textarea>



 <? }?>





    </td>

    <td width="10" rowspan="2" valign="top"><table width="100%" border="0">

  <tr>

    <td colspan="3"><input type="text" id="favorite" size="40" /></td>

    </tr>

  <tr>

    <td class="options">Raamatu id:</td>

    <td colspan="2">      <input name="book_id" type="text" class="field" value="<? echo $line["book_id"]; ?>" size="7" />
</td>

    </tr>
  <tr>
    <td><span class="options">Näita&nbsp;pealkirja: </span></td>
    <td><span class="options">
      <input name="nimi_show" type="text" class="field" value="<? echo $line["nimi_show"]; ?>" size="3" />
    </span></td>
    <td width="22%" valign="middle">&nbsp;</td>
  </tr>

  <?

if(strpos($on_nahtav,"open_exp"))

{



?>

  <tr>

    <td width="68%"><span class="options">Ava&nbsp;objektid:</span></td>

    <td width="10%"><input align="middle" name="open_exp" type="text" class="field" value="<? echo $line["open_exp"]; ?>" size="3" /></td>

    <td><span class="navi">

      <select class="fields" id="open_meta_<? echo $line["id"];?>" name="open_meta" onChange="muuda_order('raamatX','open_meta','open_meta_<? echo $line["id"];?>','<? echo $line["id"];?>')">

        <?

for ($i = 0; $i < 4; $i++)

{

	switch($i)

	{

		case 0: $txt="Custom";break;

		case 1: $txt="[n].";break;

		case 2: $txt="[n].nimi";break;

		case 3: $txt="nimi";break;

	}

	if($i==$line["open_meta"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$i."\" ".$sel.">".$txt."</option>";

}



?>

        </select>

      </span></td>

  </tr>

  <tr>

    <td class="options">Uuenda pisipilt (sisesta ID)</td>

    <td colspan="2"><input name="update_image" type="text" class="field" value="" size="8" /></td>

    </tr>

  <? }?>

 <?

if(strpos($on_nahtav,"tundide_arv"))

{



?>

  <tr>

    <td colspan="2"><span class="menu_punane">Tunde:</span></td>

    <td><input align="middle" name="tundide_arv" type="text" class="menu_punane" value="<? echo $line["tundide_arv"]; ?>" size="2" /></td>

  </tr>

  <? }?>

</table>

<table width="100%" border="0" cellpadding="5">



      <?php /*?><tr>

        <td colspan="2"><?

				tabel2("raamatX_pohivara",$aid,$_SESSION["mysession"]["login"],1,1,"Uued mõisted",$bookid);

				//echo $baas;

	?></td>

        </tr><?php */?>

      <tr>

        <td colspan="2"><?

				tabel2("raamatX_exp",$aid,$_SESSION["mysession"]["login"],1,1,"Objektid:",$bookid);

				//echo $baas;

	?></td>

        </tr>

<?php /*?>      <tr>

        <td colspan="2" class="fields"><?

				tabel2("raamatX_valem",$aid,$_SESSION["mysession"]["login"],1,1,"Valemid:",$bookid);

	?></td>

        </tr>

<?php */?>  <?php /*?>      <tr>

        <td colspan="2" class="fields"><?

				tabel2("raamatX_nupula",$aid,$_SESSION["mysession"]["login"],1,1,"Kontrollülesanded",$bookid);

	?></td>

      </tr>

<?php */?>      <tr>

    <td colspan="2" class="fields"><?

				tabel2("raamatX_raamatX",$aid,$_SESSION["mysession"]["login"],2,1,"Kuulub:",$bookid);

	?></td>

    </tr>

      <tr>

        <td colspan="2" class="fields"><?

				tabel2("raamatX_raamatX",$aid,$_SESSION["mysession"]["login"],1,1,"Seotud teemad:",$bookid);

	?></td>

        </tr>

      <tr>

        <td colspan="2" class="navi"><?

		echo $query24,"<br><br>";

?></td>

      </tr><tr>

        <td colspan="2" background="image/sinine.gif" class="menu">M&auml;rkmed</td>

        </tr>
<tr>

        <td colspan="2" align="left"><?

		include("textlog_class.php");

			$tmp=array("date","body");

			($priv==1) ? ($lisa=0) : ($lisa=1);

		   log2("raamatXarendus",(isset($_GET["raamatXarendusopen"])?0:2),$aid,$_SESSION["mysession"]["login"],implode(",",$tmp), $lisa); ?></td>

        </tr>
      </table></td>

  </tr>

  <tr>

    <td align="left" valign="top"></td>

  </tr>



 <tr>

         <td valign="top">&nbsp;</td>

         <td colspan="4">&nbsp;</td>

    </tr>



</table>



</form>
