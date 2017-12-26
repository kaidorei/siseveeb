<script src="ckeditor/ckeditor.js"></script>
<script type="text/x-mathjax-config">

    // <![CDATA[

    MathJax.Hub.Config({
        TeX: {extensions: ["AMSmath.js", "AMSsymbols.js"]},
        extensions: ["tex2jax.js"],
        jax: ["input/TeX", "output/HTML-CSS"],
        showProcessingMessages : false,
        messageStyle : "none" ,
        showMathMenu: false ,
        tex2jax: {
            processEnvironments: true,
			inlineMath: [ ['$','$'], ['\\(','\\)'] ],
            displayMath: [ ['$$','$$'], ["\\[","\\]"] ],
            preview : "none",
            processEscapes: true
        },
        "HTML-CSS": { linebreaks: { automatic:true, width: "latex-container"} }
    });
    // ]]>
</script>
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?
	//require_once 'header.php';
 	require_once("globals.php");
  require_once('format_exp.php');
	//include("FCKeditor/fckeditor.php") ;
	include("tabel_class_oid.php");
	include("tabel_class_param.php");
	include("tabel_class_iid.php");
//	include("setkokkuest.php");
	mb_internal_encoding('UTF-8');
	$eh=trim((string)@$_GET["action"]);
	$expid=(int)@$_GET["expid"];
	$klass_id=(int)@$_GET["klass_id"];
	$etendusid=(int)@$_GET["etendusid"];
	$klass=trim((string)@$_GET["klass"]);
	$bookid=(int)@$_GET["bookid"];
	$showRefreshButton = false;
	$webImageRefresh = "exp_valem_disp.php";

	if($expid)
	{
		$query="SELECT * FROM exp WHERE id=".$expid;
		$result=mysql_query($query);
		$line=mysql_fetch_array($result);
		$gpid_demo=$line["gpid_demo"];
		$slideshow_id=$line["slideshow_id"];
	}
	else
	{
		$gpid_demo=9;
	}

if((int)@$_POST["gpid_demo"])
{
  	$gpid_demo = (int)@$_POST["gpid_demo"];
}
	$query_liik="SELECT * FROM `exp_grupid_demo` WHERE id=".$gpid_demo;
//			echo $query_liik;
//			$result_liik = $db->query($query_liik);
//			$liik = $result_liik->fetch_row();
	$result_liik=mysql_query($query_liik);
	$liik=mysql_fetch_array($result_liik);
	$tykid_liik_string=$liik["valjad_form"];
	$on_nahtav=$liik["valjad_form"].",".$liik["valjad_olulised"];
//echo $on_nahtav;

	if($eh=="lugu")
	{
			$gpid=(int)@$_GET["gpid"];
			if($gpid)
			{
				$query_b="SELECT * FROM exp WHERE id=".$expid;
				$result_b=mysql_query($query_b);
				$line_b=mysql_fetch_array($result_b);
				if($gpid==6) // kui tehaks uus tegum
				{
				$tmp=mysql_query("INSERT INTO exp (nimi_est,gpid_demo) VALUES ('".$line_b["nimi_est"]."','".$gpid."')");
				$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
				$expid_uus=$tmp["last_insert_id()"];
	// Teen seose uue objekti ja algobjekti vahel

				$tmp1=mysql_query("INSERT INTO exp_exp (oid1,oid2) VALUES ('".$expid_uus."','".$expid."')");
				}
				if($gpid==43) // kui tehaks uus ptk (lugu)
				{



				$tmp=mysql_query("INSERT INTO exp (nimi_est,gpid_demo,veeb_pilt_url) VALUES ('".$line_b["nimi_est"]."','".$gpid."','".$line_b["veeb_pilt_url"]."')");

				$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

				$expid_uus=$tmp["last_insert_id()"];



	// Teen uue raamatX objekti

				$lugu = "<p>[{[".$expid."]}]</p>".$line_b["kirjeldus_est"]." ".$line_b["seletus_est"];

				$tmp=mysql_query("INSERT INTO raamatX (nimi_est,tekst_est,pid) VALUES ('".$line_b["nimi_est"]."','".$lugu."',2)");

				$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

				$raamatX_uus=$tmp["last_insert_id()"];

	// Panen algobjekti raamatX objekti külge
				$tmp=mysql_query("UPDATE exp SET raamatX_id= ".$raamatX_uus." WHERE id =".$expid_uus." LIMIT 1");
	// Panen algobjekti raamatX.tekst sisse
				$tmp1=mysql_query("INSERT INTO raamatX_exp (oid1,oid2,lupdate) VALUES ('".$raamatX_uus."','".$expid."','2000-01-01 07:07:07')");
echo "ohhoo";
				}

				if($gpid==32) // kui tehaks uus kontrollküsimus, valikvastustega

				{



				$tmp=mysql_query("INSERT INTO exp (nimi_est,gpid_demo,veeb_pilt_url) VALUES ('".$line_b["nimi_est"]."','".$gpid."','".$line_b["veeb_pilt_url"]."')");

				$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

				$expid_uus=$tmp["last_insert_id()"];



// Lisan eelmise objekti pildi selle uue külge. Fail jääb ühiseks. Aga et faile tegelikult ei kustutata ega muudeta, siis sellega ei ole midagi valesti. Pöidlapildid genereeritakse objektidele erinevad.

				$query_pilt="SELECT * FROM `exp_pildid` WHERE oid=".$expid." ORDER BY id desc" ;

				$result_pilt=mysql_query($query_pilt);

				$pilt=mysql_fetch_array($result_pilt);

				$query_insert="INSERT INTO exp_pildid (oid,nimi,url,veeb_pilt_url,veeb_pilt_url_s) VALUES ('".$expid_uus."','".$pilt["nimi"]."','".$pilt["url"]."','".$pilt["veeb_pilt_url"]."','".$pilt["veeb_pilt_url_s"]."')";

				echo $query_insert;

				$tmp=mysql_query($query_insert);

				$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

				}

			}

			$expid=$expid_uus;

	}



	if($eh=="new")

	{

			if($klass=="exp")

			{$slave=1;}

			else

			{$slave=0;}

			$tmp=mysql_query("INSERT INTO exp (nimi_est,gpid_demo,on_slave) VALUES (\"Nimetu\",\"9\",\"".$slave."\")");

			$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

			$expid=$tmp["last_insert_id()"];

			mysql_query("UPDATE exp SET jarjest=id WHERE id=".$expid."");



		if($klass_id and $klass)

		{

//			echo "teeme kohe seose vastava ainev�rgiga<br>";

			$query_insert="INSERT INTO ".$klass."_exp (oid1,oid2) VALUES (\"".$klass_id."\",\"".$expid."\")";

			echo $query_insert;

			$tmp=mysql_query($query_insert);



		}
// raamatX s�steem
		elseif($klass_id and $bookid)
		{

//			echo "teeme kohe seose vastava ainev�rgiga<br>";

			$query_insert="INSERT INTO raamatX_exp (oid1,oid2,book_id,lupdate) VALUES (\"".$klass_id."\",\"".$expid."\",\"".$bookid."\",\"2000-01-01 06:06:06\")";

			//echo $query_insert;

			$tmp=mysql_query($query_insert);



		}





		if($etendusid)

		{

//			echo "teeme kohe seose vastava etedusega<br>";

			$query_insert="INSERT INTO etendus_exp (oid1,oid2) VALUES (\"".$etendusid."\",\"".$expid."\")";

//			echo $query_insert;

			$tmp=mysql_query($query_insert);



		}

//			echo "tulemus",$expid;

		// ------------------------------------------------

	} elseif($eh=="save" and $_POST["nimi_est"])
	{
			$tykid_liik=explode(",", $tykid_liik_string);
/*			$valjad=array("gpid_demo","nimi_est","nimi_eng","nimi_rus","naita_veebis","kola_est","staatus_id", "galerii", "in_buss","on_tootuba", "on_slave", "video_toot", "oht_tuli", "oht_elekter", "oht_plahvatus", "oht_myrk", "id_youtube","ext_url","id_uudis","id_3D");
*/
			foreach($tykid_liik as $var)
			{
				$rida[$var]=$var."='".$db->real_escape_string($_POST[$var])."'";
			}
//				echo $_POST["nimi_est"];
				if($eh=="save" && $_POST["nimi_est"])
				{
						$query="UPDATE exp SET ".implode(",",$rida)." WHERE id=".$expid;
						//echo $query;
						$result=mysql_query($query);
// uuenda lemmad
						file_get_contents('http://opik.fyysika.ee/json.php/exp/updateLemmad?id='.$expid);
// uuenda väljad
            make_exp($expid,$gpid_demo,$db);
				}

//////////////////////////////////////////////////////////////////////////////////////////
// Uuendame versiooni kuupäeva, kui nõutud checkboxiga

if($_POST["uusversioon"])
{
	$query_versioon="update exp set viimane_uuendus=now() where id=".$expid." LIMIT 1";
	$result_versioon=mysql_query($query_versioon);
	echo $query_versioon;
}
if($_POST["vanaversioon"])
{
	$query_versioon="update exp set viimane_uuendus='' where id=".$expid." LIMIT 1";
	$result_versioon=mysql_query($query_versioon);
	echo $query_versioon;
}
if($_POST["kustutapilt"])
{
	$query_versioon="update exp set veeb_pilt_url='' where id=".$expid." LIMIT 1";
	$result_versioon=mysql_query($query_versioon);
	echo $query_versioon;
}



/////////////////////////////////////////////////////////////////////////////////////////7
// Korrastame tegumi sammude metaandmeid



			if($gpid_demo == 6)

			{

			if($_POST["all_on"]) // kui vastav väli on märgitud, siis teen kõik on seisu

			{

				$queryte="UPDATE `exp_exp` SET naita_veebis=1 WHERE oid1=".$line["id"]."";

				$resultte=mysql_query($queryte);

			}

			// kui sort_order on määramata, siis võrdsustan selle id-ga, saan esialgse järjestuse.

			$queryte1="UPDATE `exp_exp` SET sort_order=id WHERE oid1=".$line["id"]." and sort_order<1";

			//echo $queryte1;

			$resultte1=mysql_query($queryte1);

			$queryte2="SELECT * FROM `exp_exp` WHERE oid1=".$line["id"]." order by sort_order";

			//echo $queryte2;

			$resultte2=mysql_query($queryte2);

			$count_count=1;

			while($linete2=mysql_fetch_array($resultte2))

			{

				$queryte3="UPDATE `exp_exp` SET sort_order=".$count_count." WHERE id=".$linete2["id"]."";

				//echo $queryte3;

				$resultte3=mysql_query($queryte3);

				$count_count++;

			}

			}


	}


///////////////////////////////////////////////////////////////////////////////////////////////////////
// Kui on miskipärast kasutaja 0 objekt, siis tee kasutaja Reivelt objektiks.

	$query="SELECT * FROM exp WHERE id=".$expid;

//	echo $query."<br>";

    $result=mysql_query($query);

	$line=mysql_fetch_array($result);

	if($line["owner_user_id"]==0)

	{
			$query_user="SELECT * FROM isik WHERE username='".$login."'";
			//echo $query_user;
			$result_user = mysql_query($query_user);
			$line_user=mysql_fetch_row($result_user);
			//echo "sdf".$line_user[1];
			$query_link="UPDATE exp set owner_user_id=".$line_user[1]." WHERE id=".$expid."";
			//echo $query_link,"<br><br>";
			$result_link=mysql_query($query_link);
	}

////////////////////////////////////////////////////////////////////////////////////////////////////
// raamatX süsteem - kas on olemas ja kui parameetrid vastavad, siis tee, kui veel ei ole


// kontrolli, kas vastav raamatX objekt on ka päriselt olemas
	if($line["raamatX_id"])

	{


		$queryr="SELECT * FROM raamatX WHERE id=".$line["raamatX_id"];

		$resultr=mysql_query($queryr);

		if(!$liner=mysql_fetch_array($resultr))

		{

			$line["raamatX_id"]=NULL;

//			echo $queryr."<br>";

		};



	}

// Kui ei ole, aga kui peaks, siis teeme, raamatX objekti

	if(!$line["raamatX_id"])

	{
	   if($line["on_slave"]==0 && !in_array($line["gpid_demo"],array(1,15,9,5,4,14,36,8,38)))

			{



			echo "teen puuduva raamatX objekti ...";

			$query_insert="INSERT INTO raamatX (nimi_est,pid,book_id) VALUES ('".$line["nimi_est"]."','2','')";

			$tmp=mysql_query($query_insert);

			$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

			$raamatX_id=$tmp["last_insert_id()"];

			$query_link="UPDATE exp set raamatX_id=".$raamatX_id." WHERE id=".$line["id"]."";

			//echo $query_insert, $query_link,"<br><br>";

			$result_link=mysql_query($query_link);

			$line["raamatX_id"] = $raamatX_id;

			}
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////
// kui on esitlus, aga ei ole esitluse objekti
	if($line["gpid_demo"]==37 && !$line["ext_id"])

	{
			echo "teen puuduva raamatX objekti ...";
			$query_insert="INSERT INTO book_slideshow (user_id,title) VALUES (25,'".$line["nimi_est"]."')";
			$tmp=mysql_query($query_insert);
			$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
			$ext_id=$tmp["last_insert_id()"];
			$query_link="UPDATE exp set ext_id=".$ext_id." WHERE id=".$line["id"]."";
			echo $query_insert, $query_link,"<br><br>";
			$result_link=mysql_query($query_link);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////
// Kui on termin, aga vastavad dictterm objekti ei ole, siis tuleks teha

// kontrolli, kas vastav dictterm objekt on ka päriselt olemas
	if($line["ext_id"] and $line["gpid_demo"]==38)

	{


		$queryr="SELECT * FROM dictterm WHERE id=".$line["ext_id"];

		$resultr=mysql_query($queryr);

		if(!$liner=mysql_fetch_array($resultr))

		{

			$line["ext_id"]=NULL;

			echo $queryr."<br>";

		};



	}

// Kui ei ole, aga kui peaks, siis teeme, raamatX objekti

	if(!$line["ext_id"] and $line["gpid_demo"]==38)

	{

			echo "teen puuduva dictterm objekti ...";

			$query_insert="INSERT INTO dictterm (kirje,allikas) VALUES ('".$line["nimi_est"]."','kasutaja')";

			$tmp=mysql_query($query_insert);

			$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));

			$dictterm_id=$tmp["last_insert_id()"];

			$query_link="UPDATE exp set ext_id=".$dictterm_id." WHERE id=".$line["id"]."";

			//echo $query_insert, $query_link,"<br><br>";

			$result_link=mysql_query($query_link);

			$line["ext_id"] = $dictterm_id;
	}



//////////////////////////////////////////////////////////////////////////////////////////////////////
 ?>

 <link href="scat.css" rel="stylesheet" type="text/css" />

 <form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=exp_disp&action=save&expid=".$expid; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td valign="top" width="90%">



    <table width="100%" border="0">



  <tr>

    <td width="1%"><span class="menu"><?
	switch ($line["gpid_demo"])

			{

				case 20:
				case 21:
				case 32: echo "Probleem (est)"; break;

				default: echo "Nimi(est)"; break;

			}
?></span></td>

    <td colspan="2" class="pealkiri">

      <?

/*if(strpos($on_nahtav,"nimi_est"))

{

*/?>

<?
	switch ($line["gpid_demo"])

			{

				case 20:
				case 21:
				case 32: ?><textarea class="ckeditor" cols="120" name="nimi_est" rows="20"><? echo $line["nimi_est"];?></textarea><? break;
				default: ?> <input name="nimi_est" type="text" class="pealkiri" value="<? echo $line["nimi_est"]; ?>" size="50" /><? break;

			}
?>

       <? /*} else {



echo $line["nimi_est"];

  }*/?></td>

    </tr>



<?

if(strpos($on_nahtav,"kirjeldus_est"))

{

?>

  <tr>

    <td colspan="2"><span class="menu">

      <?



			switch ($line["gpid_demo"])

			{

				case 6: echo "Sissejuhatus"; break;

				case 2: echo "Annotatsioon"; break;

				case 43: echo "Annotatsioon"; break;

				default: echo "Sissejuhatus/annotatsioon"; break;

			}

			?>

    </span></td>

    <td width="1%"><input type="button" class="button3" value="m" onclick="window.open('exp_kirj_mod.php?id=<? echo $expid; ?>&isik_id=<? echo $login_id;?>&isik_nimi=<? echo $login_nimi;?>&vali=kirjeldus_est&sel=1','Delete','toolbar=0, scrollbars=1,width=820,height=800,status=yes');" /></td>

  </tr>



  <tr>

    <td colspan="3"><span class="fields"><? echo $line["kirjeldus_est"]; ?></span></td>

    </tr>

<? }?>





<?

if(strpos($on_nahtav,"link"))

{

?>

  <tr>

    <td align="center"  class="options">Link:</td>

    <td colspan="2"><input name="link" id="link"  type="text" class="pealkiri" value="<? echo $line["link"]; ?>" size="45" /></td>

  </tr>

 <? }?>


<?

if(strpos($on_nahtav,"exp_vahendid"))

{

?>

  <tr>

    <td colspan="3"><?

				tabel2("exp_vahendid",$expid,$_SESSION["mysession"]["login"],1,1,"Vahendid");

	?></td>

    </tr>



<? }?>



<?

if(strpos($on_nahtav,"exp_exp"))

{

?>

    <tr>

    <td class="options">Set all &quot;on&quot;:</td>

    <td width="99%" class="options">

      <input name="all_on" type="text" class="options" value="0" size="2" />

   </td>

    <td>&nbsp;</td>

  </tr>





  <tr>

    <td colspan="3"><span class="menu">

      <?



	 switch ($line["gpid_demo"])

	{

		case 2: $text_out="Kontrollk&uuml;simused?"; break;





		case 15:$text_out="Kuhu kuulub:"; break;

		case 6:$text_out="Tegum"; break;

		case 34:
		case 20:

		case 21:

		case 22:

		case 23:

		case 24:

		case 25:

		case 26:

		case 27:

		case 28:

		case 32:

		case 40:

		case 29: $text_out="Vastusevariandid/lahendus"; break;
		case 38: $text_out="Siia peaks ilmuma mõisted"; break;
		case 42: $text_out="Siia peaks ilmuma terminid"; break;

		case 30: $text_out="Alam&uuml;lesanded"; break;

		case 37: $text_out="K&uuml;simused ja seonduv"; break;

		case 31: $text_out="Muutujad ja parameetrid"; break;

		case 39: $text_out="Valemid kus esineb"; break;

		default: $text_out="exp_exp"; break;

	}

	if($line["gpid_demo"]==15)

	{

				tabel2("exp_exp",$expid,$_SESSION["mysession"]["login"],2,1,$text_out);

	}

	else

	{

				tabel2("exp_exp",$expid,$_SESSION["mysession"]["login"],1,1,$text_out);

	}





	?>

    </span></td>

    </tr>

<? }?>

<?

if(strpos($on_nahtav,"exp2exp"))

{

?>





  <tr>

    <td colspan="3"><span class="menu">

      <?



	 switch ($line["gpid_demo"])

	{

		case 2: $text_out="Kontrollk&uuml;simused?"; break;





		case 35: $text_out="Tegumid, kus kasutuses"; break;

		case 6: $text_out="Tegum"; break;

		case 20:

		case 21:

		case 22:

		case 23:

		case 24:

		case 25:

		case 26:

		case 27:

		case 28:

		case 32:

		case 29: $text_out="Vastusevariandid"; break;

		case 30: $text_out="Alam&uuml;lesanded"; break;

		case 37: $text_out="K&uuml;simused ja seonduv"; break;

		case 31: $text_out="Muutujad ja parameetrid"; break;

		case 39: $text_out="Valemid kus esineb"; break;

		default: $text_out="exp_exp"; break;

	}

				tabel2("exp_exp",$expid,@$_SESSION["mysession"]["login"],2,1,$text_out, $bookid);

	?>

    </span></td>

    </tr>

<? }?>

<?

if(strpos($on_nahtav,"seletus_est"))

{

?>

  <tr>

    <td colspan="2"><span class="menu">

      <?



			switch ($line["gpid_demo"])

			{

				case 6: echo "Uurimisk&uuml;simus"; break;

				case 2: echo "Simulatsioon"; break;

				case 9: echo "Pikem tekst"; break;

				case 15: echo "Tekst/vastusevariant"; break;

				default: echo "Selgitused"; break;

			}

			?>

    </span></td>

    <td><input type="button" class="button3" value="m" onclick="window.open('exp_kirj_mod.php?id=<? echo $expid; ?>&isik_id=<? echo $login_id;?>&isik_nimi=<? echo $login_nimi;?>&vali=seletus_est&sel=1','Delete','toolbar=0, scrollbars=1,width=720,height=750,status=yes');" /></td>

  </tr>

  <tr>

    <td colspan="3"><span class="fields"><? echo $line["seletus_est"]; ?></span></td>

    </tr>

<? }?>

<?

if(strpos($on_nahtav,"vihje_est"))

{

?>

  <tr>

    <td colspan="2"><span class="menu">

      <?



			switch ($line["gpid_demo"])

			{

				case 6: echo "Uurimisk&uuml;simus"; break;

				case 2: echo "Simulatsioon"; break;

				case 9: echo "SEE TEKST MIS N&Auml;IDATAKSE"; break;

				case 15: echo "Tekst/vastusevariant"; break;

				default: echo "Vihje"; break;

			}

			?>

    </span></td>

    <td><input type="button" class="button3" value="m" onclick="window.open('exp_kirj_mod.php?id=<? echo $expid; ?>&isik_id=<? echo $login_id;?>&isik_nimi=<? echo $login_nimi;?>&vali=vihje_est&sel=1','Delete','toolbar=0, scrollbars=1,width=720,height=750,status=yes');" /></td>

  </tr>

  <tr>

    <td colspan="3"><span class="fields"><? echo $line["vihje_est"]; ?></span></td>

    </tr>

<? }?>

<?

if(strpos($on_nahtav,"vastus_est"))

{

?>

  <tr>

    <td class="menu">Vastus (&otilde;ige/vale):      </td>

    <td colspan="2" align="right"><input class="fields" name="vastus_est" type="text" value="<? echo $line["vastus_est"]; ?>" size="20" /></td>

    </tr>

<? }?>



<?

if(strpos($on_nahtav,"misvalesti_est"))

{

?>

  <tr>

    <td colspan="2"><span class="menu">

      <?



			switch ($line["gpid_demo"])

			{

				case 6: echo "T&ouml;&ouml; k&auml;ik (NB tuleb &uuml;le kanda eraldi sammudeks)"; break;

				case 2: echo "Selgitused ja juhised simulatsiooni kasutamiseks"; break;

				default: echo "Rikked"; break;

			}

?>

    </span></td>

    <td><input type="button" class="button3" value="m" onclick="window.open('exp_kirj_mod.php?id=<? echo $expid; ?>&isik_id=<? echo $login_id;?>&isik_nimi=<? echo $login_nimi;?>&vali=misvalesti_est&sel=1','Delete','toolbar=0, scrollbars=1,width=720,height=750,status=yes');" /></td>

  </tr>

  <tr>

    <td colspan="3"><span class="fields"><? echo $line["misvalesti_est"]; ?></span></td>

    </tr>

<? }?>

<?

if(strpos($on_nahtav,"ohud_est"))

{

?>

  <tr>

    <td colspan="2"><span class="menu">

      <?

  			switch ($line["gpid_demo"])

			{

				case 6: echo "Tulemuste anal&uuml;&uuml;s ja j&auml;reldused"; break;

				case 2: echo "copyright"; break;

				default: echo "Ohud"; break;

			}

?>

    </span></td>

    <td><input type="button" class="button3" value="m" onclick="window.open('exp_kirj_mod.php?id=<? echo $expid; ?>&isik_id=<? echo $login_id;?>&isik_nimi=<? echo $login_nimi;?>&vali=ohud_est&sel=1','Delete','toolbar=0, scrollbars=1,width=720,height=750,status=yes');" /></td>

  </tr>

  <tr>

    <td colspan="3"><span class="fields"><? echo $line["ohud_est"]; ?></span></td>

    </tr>

<? }?>

<?

if(strpos($on_nahtav,"exp_kasutusjuhend"))

{

?>

  <tr>

    <td colspan="3"><? tabel("exp_kasutusjuhend",$expid,$_SESSION["mysession"]["login"], 0,"Failid");?></td>

    </tr>

<? }?>

<?



if(strpos($on_nahtav,"tex"))

{

	$showRefreshButton = true;

?>

  <tr>

    <td align="center"  class="options">tex:</td>

    <td colspan="2"><input name="tex" id="tex"  type="text" class="pealkiri" value="<? echo $line["tex"]; ?>" size="45" /></td>

  </tr>

  <tr>

    <td align="center" class="options">MathJax:</td>

    <td colspan="2" align="center" id="mathjax_preview">$$<? echo $line["tex"]; ?>$$</td>

  </tr>

  <tr>

    <td align="center" class="options">Image:</td>

    <?php

    $img = $line['image'];

    if($gpid_demo == 31) $img = "/omad/media/valem_pildid/" . $line['veeb_pilt_url'];

    ?>

    <td colspan="2" align="center"><img src="<? echo $img;?>" id="original_image_item" data-real-url="<?php echo $img;?>" /></td>

  </tr>

<? }?>

 <?

if(strpos($on_nahtav,"tex_html"))

{

	$showRefreshButton = true;

?>

 <tr>

    <td align="center" class="options">tex2html:</td>

    <td colspan="2"><textarea name="tex_html" id="tex_html" rows="2" cols="40"><? echo $line["tex_html"]; ?></textarea></td>

    </tr>

<? }?>

 <?

if(strpos($on_nahtav,"script"))

{

	$showRefreshButton = true;

?>

 <tr>

    <td align="center" class="options">script:</td>

    <td colspan="2"><textarea name="script" id="script" rows="25" cols="40"><? echo $line["script"]; ?></textarea></td>

    </tr>

<? }?>

<?



if($showRefreshButton )

{

?>

<tr>

	<td colspan="2">

		<input type="button" name="refresh" value="Värskenda eelvaateid" id="preview_refresh" />

	</td>

</tr>





<?php

}



if(strpos($on_nahtav,"raamatX_exp"))

{

?>  <tr>

    <td colspan="3"><?



	switch ($line["gpid_demo"]) // sellised asjad tuleb panna exp_gpid tabeli p�hjal

	{

		case 2: $text_out="Teemad,kus simulatsiooni kasutatakse"; break;

		case 9: $text_out="Teemad,kus pilti kasutatakse"; break;

		case 8: $text_out="Teemad,kus mudelit kasutatakse"; break;

		case 20:

		case 21:

		case 22:

		case 23:

		case 24:

		case 25:

		case 26:

		case 27:

		case 28:

		case 29:

		case 30:

		case 40:

		case 34:

		case 32: $text_out="Teemad, kus kasutuses (varem Lahendusk&auml;ik)"; break;
		case 38: $text_out="Sõnaraamatud, kus on sees"; break;
		case 42: $text_out="Mõisted peaksid olema raamatute küljes vaid läbi terminite"; break;

		case 43: $text_out="Teemad, kus objekti kasutatakse"; break;

		default: $text_out="raamatX_exp"; break;

	}

	tabel2("raamatX_exp",$expid,@$_SESSION["mysession"]["login"],2,1,$text_out, $bookid);

	?></td>

    </tr>

<? }?>

<?

if(strpos($on_nahtav,"exp_uudis"))

{

?>

  <tr>

    <td colspan="3"><?

					tabel2("exp_uudis",$expid,$_SESSION["mysession"]["login"],1,1,"Seonduvad uudised");

	?></td>

    </tr>

 <? }?>

<?

if(strpos($on_nahtav,"etendus_exp"))

{

?>

 <tr>

    <td colspan="3"><?

					tabel2("etendus_exp",$expid,$_SESSION["mysession"]["login"],2,1,"Seonduvad etendused");

	?></td>

    </tr>

 <? }?>

<?

if(strpos($on_nahtav,"kool_exp"))

{

?>

  <tr>

    <td colspan="3"><?

					tabel2("kool_exp",$expid,$_SESSION["mysession"]["login"],2,1,"Seosed koolidega");

	?></td>

    </tr>

 <? }?>




  <tr>

    <td class="options" colspan="3">



    <?


			$query11="SELECT * FROM raamatX WHERE id=".$line["raamatX_id"];

			$result11=mysql_query($query11);

			$line11=mysql_fetch_array($result11);

			if($line["raamatX_id"])

			{
			?>

			<a class="navi" href="<? echo $PHP_SELF."?page=raamatX_disp&aid=".$line["raamatX_id"]; ?>">MUUDA raamatX</a>
	<?
			}

			else

			{

				echo "V&auml;li raamatX_id ei ole määratud!";

			}

			echo $line11["tekst_est"];



	if($line["ext_id"] and $line["gpid_demo"]==35)

	{			?>
	<a class="navi" href="<? echo $PHP_SELF."?page=vahendid_disp&vid=".$line["ext_id"]; ?>">MUUDA vahendit</a>
<?
	}
	if($line["ext_id"] and $line["gpid_demo"]==38)

	{			?>
	<a class="navi" href="<? echo $PHP_SELF."?page=pohivara_disp&poid=".$line["ext_id"]; ?>">MUUDA terminit</a>
<?
	}
	if($line["ext_id"] and $line["gpid_demo"]==51)

	{			?>
	<a class="navi" href="<? echo $PHP_SELF."?page=kool_disp&fid=".$line["ext_id"]; ?>">MUUDA kooli</a>
<?
	}
	if($line["ext_id"] and $line["gpid_demo"]==53)

	{			?>
	<a class="navi" href="<? echo $PHP_SELF."?page=isik_disp&iid=".$line["ext_id"]; ?>">MUUDA isikut</a>
<?
	}

	?>
    <span class="menu"><span class="navi"><? echo $line["video_url"];?></span></span>
	<? if ($line["gpid_demo"]) {?> <span class="fields"><? //echo $line["kirjeldus_est"]; ?></span><? }?>
    </td>
    </tr>
    </table>
   </td>

    <td width="5%" rowspan="4" align="right" valign="top">
    <table width="100%" border="0">

  <tr>

    <td width="53%"><input class="button" type="submit" name="Submit2" value="Salvesta" /></td>

    <td width="16%" align="center" valign="middle"><a href="http://opik.fyysika.ee/index.php/exp/display/<? echo $expid;?>" target="_blank" class="menu_punane"><img src="image/icon_eopik.png" alt="eopikus" height="30" border="0" /></a></td>

    <td width="9%" align="center" valign="middle"><?php /*?><a href="exp_print.php?domain=exp&id=<? echo $line["id"];?>" class="menu_punane" target="_blank"><img src="image/ico_exp_15_v.png" alt="print" width="30" height="30" border="0" /></a><?php */?></td>

    <td width="13%" align="center" valign="middle"><a href="http://opik3.fi.tartu.ee/index.php/book/section/<? echo $line["raamatX_id"];?>" target="_blank" class="menu_punane"><img src="image/icon_doc.jpg" alt="eopikus" height="30" border="0" /></a><?php /*?><a href="media/exp_docs/Eksperiment<? echo $line["id"];?>.docx"><img src="image/icon_doc.jpg" alt="doc" height="30" border="0" /></a><?php */?></td>

    <td width="9%" align="center" valign="middle" class="navi"><a href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://opik.fyysika.ee/index.php/exp/display/<? echo $expid;?>;" target="_blank">QR</a></td>

  </tr>

  <tr>

    <td align="left"><?

if(strpos($on_nahtav,"rank"))

{

?>

<input class="menu_punane" name="rank" type="text" value="<? echo $line["rank"]; ?>" size="10" /><?


}?></td>
    <td align="left">&nbsp;</td>
    <td align="left"><input type="checkbox" name="kustutapilt" id="checkbox"></span></td>
    <td align="center">    <span class="navi">  v:
      <input type="checkbox" name="vanaversioon" id="checkbox"></span>
</td>
    <td align="center"><span class="navi">
      u:
      <input type="checkbox" name="uusversioon" id="checkbox">
    </span></td>

    </tr>
  <tr>
    <td colspan="5" align="left"><?

		$resultTempNotUSed = @include("textlog_class.php");

//		include("textlog_naitus_class.php");

			$tmp=array("date","body");

			(@$priv==1) ? ($lisa=0) : ($lisa=1);

			if(function_exists("log2"))

		   		log2("exparendus",(isset($_GET["exparendusopen"])?0:2),$expid,$_SESSION["mysession"]["login"],implode(",",$tmp), $lisa); ?></td>
  </tr>

    <?



// uute laienduste tegemine, kui on lihtobjekt, st kui exp_gpid_demo.autoadd=1

	$query_l="SELECT * FROM `exp_grupid_demo` WHERE id=".$line["gpid_demo"];

	$result_l=mysql_query($query_l);

	$l=mysql_fetch_array($result_l);



	if($l["autoadd"] == 1)

	{?>

  <tr>

    <td align="left"><a href="index.php?page=exp_disp&expid=<? echo $expid;?>&gpid=43&action=lugu" target="_blank" class="options">Tee lugu!</a> </td>

    <td colspan="2" align="left"><a href="index.php?page=exp_disp&expid=<? echo $expid;?>&gpid=6&action=lugu" target="_blank" class="options">Tee tegum!</a></td>

    <td colspan="2" align="left"><a href="index.php?page=exp_disp&expid=<? echo $expid;?>&gpid=32&action=lugu" target="_blank" class="options">Tee KK!</a></td>

    </tr>



 <? }



if(strpos($on_nahtav,"veeb_pilt_url"))

{

?>

  <tr>

    <td colspan="5"><?

	if($gpid_demo!=31)

	{

		if ($line["veeb_pilt_url"]) {?><a href=<? echo urldecode($line["veeb_pilt_url_s"]); ?> target=_blank><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" style="background-color: #CCCCCC" /></a><? } else {?>

              <img src="image/noimage.jpg" width="90" height="98" />              <? }

	}

?>

</td>

  </tr>

<? }?>





  <tr>

    <td colspan="5" align="left">TÜÜP:<?

		 $gpid2=$line["gpid_demo"];//}

//				echo $line["gpid_tootuba"], $gpid2;

				$query2="SELECT id,nimi FROM exp_grupid_demo ORDER BY id";

				$result2=mysql_query($query2);

				echo "<select  class=\"fields\" name=\"gpid_demo\">";

				while($var=mysql_fetch_array($result2)){

					if($var["id"]==$gpid2) { $sel="selected"; } else { $sel="";}

						echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["nimi"]."</option>";

				}

					echo "</select>";

		  ?></td>

    </tr>

 <?

if(strpos($on_nahtav,"staatus_id"))

{

?>



  <tr>

    <td colspan="5" align="left"><?

		  	$query2="SELECT nimi,id FROM exp_staatus";

				    $result2=mysql_query($query2);

					echo "<select  class=\"fields\" name=\"staatus_id\">";

					while($var=mysql_fetch_array($result2)){

									if($var["id"]==$line["staatus_id"]) { $sel="selected"; } else { $sel="";}

         							echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["nimi"]."</option>";

					}

					echo "</select>";

		  ?> </td>

  </tr>

  <? }



if(strpos($on_nahtav,"naita_veebis_est"))

{

?>



  <tr>

    <td colspan="4" align="left" class="options">Näitan eesti keeles:</td>
    <td align="left"><select class="fields" id="list_show_<? echo $line["id"];?>" name="naita_veebis_est">
      <?

for ($i = 0; $i < 2; $i++)

{

	switch($i)

	{

		case 0: $txt="OFF";break;

		case 1: $txt="ON";break;

	}

	if($i==$line["naita_veebis_est"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$i."\" ".$sel.">".$txt."</option>";

}



?>
    </select></td>

  </tr>
  <tr>

    <td colspan="4" align="left" class="options">Näitan inglise keeles:</td>
    <td align="left"><select class="fields" id="list_show_<? echo $line["id"];?>_eng" name="naita_veebis_eng">
      <?

for ($i = 0; $i < 2; $i++)

{

	switch($i)

	{

		case 0: $txt="OFF";break;

		case 1: $txt="ON";break;

	}

	if($i==$line["naita_veebis_eng"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$i."\" ".$sel.">".$txt."</option>";

}



?>
    </select></td>

  </tr>
  <tr>

    <td colspan="4" align="left" class="options">Näitan vene keeles:</td>
    <td align="left"><select class="fields" id="list_show_<? echo $line["id"];?>_rus" name="naita_veebis_rus">
      <?

for ($i = 0; $i < 2; $i++)

{

	switch($i)

	{

		case 0: $txt="OFF";break;

		case 1: $txt="ON";break;

	}

	if($i==$line["naita_veebis_rus"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$i."\" ".$sel.">".$txt."</option>";

}



?>
    </select></td>

  </tr>

  <? }

if(strpos($on_nahtav,"on_slave"))

{

?>



  <tr>

    <td colspan="5" align="left">

    <select class="fields" name="on_slave"><?

for ($i = 0; $i < 2; $i++)

{

	switch($i)

	{

		case 0: $txt="Master";break;

		case 1: $txt="Slave";break;

	}

	if($i==$line["on_slave"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$i."\" ".$sel.">".$txt."</option>";

}



?>



  </select></td>

  </tr>

  <? }

 ?> <tr>
    <td colspan="5"><?

		 $gpid3=$line["creativecommons"];//}

//				echo $line["gpid_tootuba"], $gpid2;

				$query3="SELECT id,nimi_lyhike FROM exp_grupid_cc ORDER BY id";

				$result3=mysql_query($query3);

				echo "<select  class=\"fields\" name=\"creativecommons\">";

				while($var=mysql_fetch_array($result3)){

					if($var["id"]==$gpid3) { $sel="selected"; } else { $sel="";}

						echo "<option value=\"".$var["id"]."\" ".$sel.">".$var["nimi_lyhike"]."</option>";

				}

					echo "</select>";

		  ?></td>
  </tr>
<?

if(strpos($on_nahtav,"time_tegemine"))

{

?>



  <tr>

    <td colspan="2" align="left" class="fields"> &nbsp;Aeg: </td>

    <td colspan="3" align="left"><input class="fields" name="time_tegemine" type="text" value="<? echo $line["time_tegemine"]; ?>" size="15" /></td>

    </tr>

  <? }



if(strpos($on_nahtav,"on_pohivara"))

{

?>



  <tr>

    <td colspan="5" align="left"><select name="on_pohivara" id="select" class="fields_left">

              <option value="0" <? if($line["on_pohivara"]==0) { echo "selected"; }?>>Ei ole p&otilde;hivara</option>

             <option value="1" <? if($line["on_pohivara"]==1) { echo "selected"; }?>>P&otilde;hivara</option>



              </select>

  <? }

if(strpos($on_nahtav,"raskus"))

{

?>

  <tr>

    <td colspan="5"><span class="menu">Raskusaste</span></td>

  </tr>

  <tr>

    <td colspan="5"><select name="raskus" id="select" class="fields_left">

              <option value="1" <? if($line["raskus"]==1) { echo "selected"; }?>>faktiteadmised</option>

             <option value="2" <? if($line["raskus"]==2) { echo "selected"; }?>>oskab rakendada</option>

             <option value="3" <? if($line["raskus"]==3) { echo "selected"; }?>>kõrgem tase</option>



              </select></td>

  </tr>

  <? }?>



<?

if(strpos($on_nahtav,"exp_pildid"))

{

?>

   <tr>

    <td colspan="5"><? tabel("exp_pildid",$expid,$_SESSION["mysession"]["login"], 1,"Pildid");?></td>

  </tr>

<? }?>

<?

if(strpos($on_nahtav,"exp_param"))

{

?>

   <tr>

    <td colspan="5"><? tabel_param("exp_param",$expid,$_SESSION["mysession"]["login"], 1,"Parameetrid");?></td>

  </tr>

<? }?>

<?

if(strpos($on_nahtav,"ext_id"))

{

?>
  <tr>
    <td class="navi"><a href="http://www.youtube.com/v/<? echo $line["ext_id"]; ?>" target="_blank">YTID</a><? echo " (", $line["time_duration"],")";?></td>
    <td colspan="4"><input class="fields" name="ext_id" type="text" value="<? echo $line["ext_id"]; ?>" size="10" /></td>

  </tr>

<? }?>

<?




if(strpos($on_nahtav,"ext_url"))

{

?>

  <tr>

    <td class="navi"><a href="http://et.wikipedia.org/wiki/<? echo $line["ext_url"]; ?>">Wiki EST</a></td>

    <td colspan="4"><span class="navi">

      <input class="fields" name="ext_url" type="text" value="<? echo $line["ext_url"]; ?>" size="20" />

    </span></td>

  </tr>

  <tr>

    <td class="navi"><a href="http://en.wikipedia.org/wiki/<? echo $line["ext_url_eng"]; ?>">Wiki ENG</a></td>

    <td colspan="4"><span class="navi">

      <input class="fields" name="ext_url_eng" type="text" value="<? echo $line["ext_url_eng"]; ?>" size="20" />

    </span></td>

  </tr>

<? }?>

<?

if(strpos($on_nahtav,"id_uudis"))

{

?>

  <tr>

    <td class="navi"><a href="http://www.fyysika.ee/uudised/?p=<? echo $line["id_uudis"]?>">NewsID</a></td>

    <td colspan="4"><input class="fields" name="id_uudis" type="text" value="<? echo $line["id_uudis"]; ?>" size="10" /></td>

  </tr>

<? }?>

<?

if(strpos($on_nahtav,"aine_exp"))

{

?>

  <tr>

    <td colspan="5"><span class="navi">

      <?

				tabel2("aine_exp",$expid,$_SESSION["mysession"]["login"],2,1,"Seosed &otilde;ppekavaga");

	?>

    </span></td>

  </tr>

<? }?>

<?

if(strpos($on_nahtav,"exp_pohivara"))

{

?>

  <tr>

    <td colspan="5"><span class="navi">

      <?

				tabel2("exp_pohivara",$expid,$_SESSION["mysession"]["login"],1,1,"V&otilde;tmes&otilde;nad");

	?>

    </span></td>

  </tr>

<? }?>


<tr>
    <td colspan="5" class="navi">Omanik: <? echo  $line["owner_user_id"];?> Algupära: <? echo  $line["origin_id"];?></td>
  </tr>
<?
if(strpos($on_nahtav,"exp_isik"))

{

?>

  <tr>

    <td colspan="5"><?

					tabel2("exp_isik",$expid,$_SESSION["mysession"]["login"],1,1,"Autorid jt");

	?></td>

  </tr>

<? }?>

<?

if(strpos($on_nahtav,"exp_kool"))

{

?>

  <tr>

    <td colspan="5"><?

					tabel2("exp_kool",$expid,$_SESSION["mysession"]["login"],1,1,"Asutused ja projektid");

	?></td>

  </tr>

<? }?>

<?

if(strpos($on_nahtav,"copyright"))

{

?>

  <tr>

    <td colspan="5"><span class="menu">Copyright</span></td>

  </tr>

  <tr>

    <td colspan="5" align="center"><textarea cols="25" rows="3" class="fields" name="copyright" type="text" value="" ><? echo $line["copyright"]; ?></textarea></td>

  </tr>

<? }?>

<?

if(strpos($on_nahtav,"exp_nupula"))

{

?>

  <tr>

    <td colspan="5"><?

					tabel2("exp_nupula",$expid,$_SESSION["mysession"]["login"],1,1,"Nupula");

	?></td>

  </tr>

<? }?>

  <tr>

    <td colspan="5"><input class="fields" name="update" type="text" value="<?

	echo timestamp2($line["lupdate"]); ?>" /></td>

  </tr>
  <tr>

    <td colspan="5" align="center" class="menu">Versioon: <? echo timestamp2($line["viimane_uuendus"]); ?></td>

  </tr>
  <?


?>


<?

if(strpos($on_nahtav,"in_buss"))

{

?>

  <tr>

    <td><span class="menu">Demo_rate</span></td>

    <td colspan="4"><input class="fields" name="in_buss" size="5" type="text" value="<? echo $line["in_buss"]; ?>" /></td>

  </tr>

 <? }?>

<?

if(strpos($on_nahtav,"oht_tuli"))

{

?>

 <tr>

    <td class="menu">Tuleohtlik?</td>

    <td colspan="4"><input class="fields" align="right" name="oht_tuli" size="2" type="text" value="<? echo $line["oht_tuli"]; ?>" /></td>

  </tr>

 <? }?>

<?

if(strpos($on_nahtav,"oht_plahvatus"))

{

?>

  <tr>

    <td class="menu">Plahvatab?</td>

    <td colspan="4"><input class="fields" name="oht_plahvatus" size="2" type="text" value="<? echo $line["oht_plahvatus"]; ?>" /></td>

  </tr>

 <? }?>

<?

if(strpos($on_nahtav,"oht_myrk"))

{

?>

  <tr>

    <td class="menu">M&uuml;rgine?</td>

    <td colspan="4"><input class="fields" name="oht_myrk" size="2" type="text" value="<? echo $line["oht_myrk"]; ?>" /></td>

  </tr>

  <? }?>

<?

if(strpos($on_nahtav,"oht_elekter"))

{

?>

 <tr>

    <td class="menu">Elekter?</td>

    <td colspan="4"><input class="fields" name="oht_elekter" size="2" type="text" value="<? echo $line["oht_elekter"]; ?>" /></td>

  </tr>

 <? }?>

</table>

</td>

  </tr>









   </table>





</form>

<?php



if($showRefreshButton)

{

	?>

	<hr>

	Eelvaated:<br>



	<div style="display: block; border: 1px solid black; padding: 0em 2em 2em 2em;">

		<strong>Pilt:</strong> <br><img src="" alt="Veebipilt" name="image" id="web_image"/>



	</div>







	<!--<div style="display: block; border: 1px solid black; padding: 0em 2em 2em 2em;">

		<strong>script:</strong><br>

		<div style="display: block;" id="script_preview">



	</div>-->



<script type="text/javascript" src="media/latex2html5.min.js"></script>

<script type="text/JavaScript">



function refreshPreviewImage(generateImg)

{

	$("#mathjax_preview").html("$$" + $("#tex").val() + "$$");

	MathJax.Hub.Queue(["Typeset",MathJax.Hub,"mathjax_preview"]);



	$("#script_preview").html("$$" + $("#script").val() + "$$");

	MathJax.Hub.Queue(["Typeset",MathJax.Hub,"script_preview"]);



	var milliseconds = new Date().getTime();

	$('#web_image').attr('src', "<?php echo $webImageRefresh; ?>?expid=<?php echo $expid; ?>&generate="+generateImg+"&equation=" + encodeURIComponent(btoa($("#tex").val())) +"&t=" + (milliseconds + "") );



	// latex2html preview



	 var TEX = new LaTeX2HTML5.TeX({

         tagName: 'section',

         className: 'latex-container',

         latex: $("#tex_html").val()

     });

     TEX.render();

     $("#tex_html_preview").html(TEX.$el);
//encodeURIComponent($("#tex").val())
     $('#original_image_item').attr('src', "<?php echo $webImageRefresh; ?>?expid=<?php echo $expid; ?>&generate="+generateImg+"&equation=" + encodeURIComponent(btoa($("#tex").val())) +"&t=" + (milliseconds + "") );

/*
     var originalImage=$("#original_image_item");

     if(originalImage !== null && originalImage.length > 0) {

         var url = originalImage.attr("data-real-url");

         if(url !== undefined && url !== null)

         	originalImage[0].src = url + "?t=" + new Date().getTime();

      	 }
*/


}





$(document).ready(function()

{

	$("#preview_refresh").click(function(e){

		if(!(e === undefined) && !(e===null)){	 (e.preventDefault) ? e.preventDefault() : e.returnValue = false; }

		refreshPreviewImage("0");

	});



	refreshPreviewImage("<?php echo ($eh=="save" && isset($_POST["tex"]) ? '1':'0'); ?>");

});

</script>



	<?php

}



?>
