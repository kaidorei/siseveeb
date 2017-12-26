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

<style type="text/css">

<!--

.style2 {color: #FF0000}

-->

</style>

<link href="scat.css" rel="stylesheet" type="text/css" />

<br>

<?
require_once('format_picture.php');
require_once('format_exp.php');
require_once('format_raamatX_1.php');

$n2ita_querysid = FALSE;

@$bookid=$_GET["bookid"];
@$ava=$_GET["ava"];
@$open_string=$_GET["op"];

$jarjekord=1;

	$query_raamat="SELECT * FROM raamat WHERE id=".$bookid;

	$result_raamat=mysql_query($query_raamat);

	$line_raamat=mysql_fetch_array($result_raamat);

	//echo @$up1.@$up2;

	$var_gpid=array();

	$query_gpid="SELECT id,ico_url_v FROM exp_grupid_demo";

	$result_gpid=mysql_query($query_gpid);

	while($line_gpid=mysql_fetch_array($result_gpid))

	{

		$var_gpid[$line_gpid["id"]]=$line_gpid["ico_url_v"];

//		echo $line_gpid["ico_url_v"];

	}

?><input type="text" id="favorite" size="80" />

<table width="100%" border="0" cellspacing="0" cellpadding="3">

	        <tr>

  <td width="100%" class="pealkiri"><? echo $line_raamat["nimi"];?></td></tr>

</table>

<a href="http://www.fyysika.ee/omad/index.php?page=raamatX_disp&action=new&bookid=<? echo $bookid;?>&pid=0&parent=0" class="smallbody" target="_blank">Lisa&nbsp;peat&uuml;kk</a>

<?

$query_raamat="SELECT is_textbook FROM raamat WHERE id=".$bookid." ";
$result_raamat=mysql_query($query_raamat);
$line_raamat=mysql_fetch_array($result_raamat);




$query="SELECT * FROM raamatX WHERE pid=0 AND book_id=".$bookid." ORDER BY jarjest"; //AND id = 12929

//echo $query;



if ($n2ita_querysid) echo $query."query";

$result=mysql_query($query);



while($line=mysql_fetch_array($result))

{
		$jarjekord++;
		$open=explode(',',@$_GET["op"]);

		$openasi=0;

		if (in_array($line["id"],$open))

			{

				$openasi=1;

				//echo $line['id'];

			}

?>

<span class="navi"><? //echo @$agrupp2_nimi["naita_veebis"]."aha";?></span>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr><td colspan="7" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td></tr>

  <tr>

<?



	  	// kustutame v�i paneme selle id $open listi, v�ljundiks on $tmp mis pannakse edaspidises linkimisse

		//kui on avatud, siis paneme kinni, selleks kopeerime $open vektori va see id mis parajasti akuutne

		  $tmp=array();

		  	if($openasi){

			foreach($open as $val){

				if($val!=$line["id"]){

					array_push($tmp,$val);

					}

				}

			} else {

			//kui oli suletud siis paneme id vektori l�ppu ...

			if($open[0]!=0){$tmp=$open;}

			array_push($tmp,$line["id"]);

			}

?>

    <td width="4%" >

	<a href="index.php?page=raamat_tree&op=<? echo implode(",",$tmp);?>&bookid=<? echo $bookid;?>"><img border=0 src="image/index_<?  if($openasi or $ava==1){ echo "39";  } else { echo "36"; }?>.gif" width=19 height=19 alt=""></a></td>

    <td  width="79%" class="navi" nowrap><a href="index.php?page=raamatX_disp&aid=<? echo $line["id"]; ?>&bookid=<? echo $bookid;?>" class="ekraan_link" target="_blank">

	<? echo $line["nimi_est"]; //siin on esimene aste ?>

	</a> - <? echo $line["tundide_arv"] ;







// kas vastav exp objekt on olemas?

$queryd0="SELECT * FROM `exp` WHERE raamatX_id=".$line["id"]."";

$resultd0=mysql_query($queryd0);

$lined0=mysql_fetch_array($resultd0);



if($lined0["raamatX_id"])
{?>

          <a class="navi" href="<? echo $PHP_SELF."?page=exp_disp&expid=".$lined0["id"];  ?>" target="_blank">exp</a> <?
}
else
{
			echo "Vastavat exp objekti ei ole olemas ... teeme ...";
			$query_uusexp= "INSERT INTO exp (nimi_est,raamatX_id,gpid_demo,naita_veebis_est) VALUES ('".$line["nimi_est"]."',".$line["id"].",43,0)";

				//echo $query_uusexp;

    			$result_uusexp=mysql_query($query_uusexp);

}







	?></td>

   <td width="17%" valign="middle" > <a href="http://www.fyysika.ee/omad/index.php?page=raamatX_disp&action=new&bookid=<? echo $bookid;?>&pid=1&klass=raamatX&klass_id=<? echo $line["id"];?>" class="smallbody" target="_blank">Lisa&nbsp;alajaotus</a></td>

  </tr>

</table>





<?



// Laotame lahti alamgrupi nr 1

		if ($openasi or $ava==1) {

				$query12="SELECT * FROM raamatX_raamatX WHERE oid1=".$line["id"]." ORDER BY sort_order";

				if ($n2ita_querysid) echo $query12."query12";

				$result12=mysql_query($query12);



////////////////////////////////////////////////////////////////////////////////

// siia kohta tuleb j�rjestamine pacs tabeli kirje jarjest j�rgi ...





//echo "<pre>";

//var_dump( $query12."1 <p>seal	</p>1");

//var_dump( mysql_fetch_array($result12));

//echo "</pre>";



				//Alamasja loop algab siit



				while($agrupp=mysql_fetch_array($result12)){ //t�htis while ts�kkel
					$jarjekord++;
					/////////////////////////////////////////////////
					// j�rjekordade �htlustamine
					if($ava==1)

					{
						$query2211121="UPDATE raamatX_raamatX set sort_order=".$jarjekord." WHERE id = ".$agrupp["id"]." LIMIT 1";
						echo $query2211121;
						$result2211121=mysql_query($query2211121);
					}
					/////////////////////////////////////////////7
					$openasi_alamg=0;

					if (in_array($agrupp["oid2"],$open)){

						$openasi_alamg=1;

						}



						$query13="SELECT * FROM raamatX WHERE id=".$agrupp["oid2"];

				 		if ($n2ita_querysid) echo $query13."query13";

						$result13=mysql_query($query13);



						$agrupp_nimi=mysql_fetch_array($result13);

						?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr>

    	<td colspan="5" background="image/sinine.gif"><img src="image/valge.gif" width="55" height="1"></td>

  	</tr>

  	<tr>

      <? // j�llegi, avame v�i sulgeme alamr�hma

		  	  		  $tmp=array();

					  if($openasi_alamg){

						foreach($open as $val){

							if($val!=$agrupp["oid2"]) {

							array_push($tmp,$val);

								}

							}

						} else {

						if($open[0]!=0){$tmp=$open;}

						array_push($tmp,$agrupp["oid2"]);

						}

						?>

   		<td width="3%" nowrap><img src="image/spacer.gif" width="33" height="9"> <a href="index.php?page=raamat_tree&op=<? echo implode(",",$tmp);?>&bookid=<? echo $bookid;?>"><img border=0 src="image/index_<?  if($openasi_alamg or $ava==1){ echo "39";  } else { echo "36"; }?>.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></a></td> <? //see tekitab pluss m�rgi v�i miinusm�rgi sinna ette koos lingiga ?>
<?
if (in_array($agrupp_nimi["id"],$open)){
  // torgime esialgu vaid neid raamatuid, mis on õpikud
    if($line_raamat["is_textbook"]==1){
      //  echo "on õpik";
        make_raamatX_1($agrupp_nimi["id"],$bookid,$db);
      }
      }


?>
   	  <td width="27%" align="left" class="navi">Tund(t<? echo $agrupp_nimi["type"];?>): <a href="index.php?page=raamatX_disp&aid=<? echo $agrupp["oid2"]; ?>&bookid=<? echo $bookid;?>"  class="ekraan_link" target="_blank"><? echo $agrupp_nimi["nimi_est"];  ?></a> - <? echo "book_id: ",$agrupp["book_id"];


	// vajadusel korrigeerime book_id v�lja raamatX_raamatX tabelis

if($agrupp["book_id"]==0)

{

	$query2211121="UPDATE raamatX_raamatX set book_id=".$bookid." WHERE id = ".$agrupp["id"];

	//echo $query221112;

$result2211121=mysql_query($query2211121);

}




	  ?>

      <?



//	uurin, kas seal sees m�ni objekt ka on ...



	$query34="SELECT id, oid2 FROM raamatX_exp WHERE oid1=".$agrupp_nimi["id"];

//echo $query34;

	$result34=mysql_query($query34);

	if(!mysql_fetch_array($result34)){

// et kui on veel �ks tase, siis ei n�ita ...



				$query221="SELECT oid2, naita_veebis, id FROM raamatX_raamatX WHERE oid1=".$agrupp["oid2"];

				$result221=mysql_query($query221);

				if(!mysql_fetch_array($result221)){



	?><span class="style2">(T&uuml;hi)</span>      <? }}



// korrigeerime pid v�lja raamatX tabelis

$query2211="UPDATE raamatX set pid=1 WHERE id = ".$agrupp_nimi["id"];

//echo $query2211;

$result2211=mysql_query($query2211);











	?>

      <a href="http://www.fyysika.ee/omad/exp_table_wp.php?bookid=<? echo $bookid;?>&aid=<? echo $agrupp["oid2"]; ?>" target="_blank">cp</a><? echo " Nmbr: ".$agrupp["sort_order"]."(".$jarjekord.")";  ?>  <?





// kas vastav exp objekt on olemas?

$queryd1="SELECT * FROM `exp` WHERE raamatX_id=".$agrupp["oid2"]."";

$resultd1=mysql_query($queryd1);

$lined1=mysql_fetch_array($resultd1);



if($lined1["raamatX_id"]) {?>

          <a class="navi" href="<? echo $PHP_SELF."?page=exp_disp&expid=".$lined1["id"];  ?>" target="_blank">exp</a> <?

// Kontrollin, et raamatx objektile vastav exp objekt oleks teemaga seotud.
// Vajadusel korrigeerin

		$query22xx="SELECT * FROM raamatX_exp WHERE oid1=".$line["id"]." AND oid2= ".$lined1["id"];

		//echo $query22xx;

		$result22xx=mysql_query($query22xx);

		$exp_asi=mysql_fetch_array($result22xx);

		if(!$exp_asi["id"])

		{

			$query_expasi ="INSERT INTO `fyysika_ee`.`raamatX_exp` (`id`, `book_id`, `oid1`, `oid2`,`sort_order`,`naita_veebis`) VALUES (NULL, '".$bookid."', '".$line["id"]."', '".$lined1["id"]."','".$line["jarjest"]."', '1');";
			echo $query_expasi;
			$result_expasi=mysql_query($query_expasi);
		}
		  }
		  else
		  {
			echo "Vastavat exp objekti ei ole olemas ... teeme ...";
			$query_uusexp= "INSERT INTO exp (nimi_est,raamatX_id,gpid_demo,naita_veebis_est) VALUES ('".$agrupp_nimi["nimi_est"]."',".$agrupp_nimi["id"].",43,0)";
			//echo $query_uusexp;
    		$result_uusexp=mysql_query($query_uusexp);
			}









?></td>

   	  <td width="1%" align="left" class="navi">

   	    <input type="button" class="button3" value="m" onclick="window.open('addvalue_iid_mod.php?domain=raamatX_raamatX&id=<? echo $agrupp["id"];?>&sel=<? echo $asi["sel"];?>','Delete','toolbar=0,width=700,height=850,status=yes');" />

   	  </td>

<? if ($tasemeid == 2) { ?>		<td width="20%" class=\"menu\" ><input type="button" name="suva1" class="button" value="Lisa Exp/Demo" onClick="window.open('addvalue_iid.php?domain=raamatX_exp&oid=<? echo $agrupp["oid2"]; ?>&sel=1&bookid=<? echo $bookid;?>','File_upload','toolbar=0,width=630,height=450,status=yes');"><? } ?>

<td width="13%" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=raamatX_disp&action=new&bookid=<? echo $bookid;?>&pid=2&klass=raamatX&klass_id=<? echo $agrupp_nimi["id"];?>" class="smallbody" target="_blank">Lisa&nbsp;alajaotus</a>

</td>

  	</tr>

</table>







<?



// Laotame lahti alamgrupi nr 2

		if ($openasi_alamg or $ava==1){


		// asustame nimekirja alajaotustest, kuhu k�lge v�ib exp objekte kleepida


				$query210="SELECT * FROM raamatX_raamatX WHERE oid1=".$agrupp["oid2"]." ORDER BY sort_order";
				$result210=mysql_query($query210);
				$agrupp2_objekt_id=array();
				while($agrupp210=mysql_fetch_array($result210))
				{
					array_push($agrupp2_objekt_id,$agrupp210["oid2"]);
				}





				$query21="SELECT * FROM raamatX_raamatX WHERE oid1=".$agrupp["oid2"]." ORDER BY sort_order";
				if ($n2ita_querysid) echo $query21."query21".$agrupp["oid2"];
				$result21=mysql_query($query21);

				//Alamasja loop algab siit
				if ($n2ita_querysid) var_dump($agrupp2=mysql_fetch_array($result21));
				while($agrupp2=mysql_fetch_array($result21)){
					$jarjekord++;
					/////////////////////////////////////////////////
					if($ava==1)

					{
					// j�rjekordade �htlustamine
						$query2211121="UPDATE raamatX_raamatX set sort_order=".$jarjekord." WHERE id = ".$agrupp2["id"]." LIMIT 1";
						echo $query2211121;
						$result2211121=mysql_query($query2211121);
					}
					/////////////////////////////////////////////7


					$openasi_alamg2=0;

					if ($n2ita_querysid) var_dump ($agrupp2." ");

					if (in_array($agrupp2["oid2"],$open)){

						$openasi_alamg2=1;

						}



						$query22="SELECT * FROM raamatX WHERE id=".$agrupp2["oid2"];

						if ($n2ita_querysid) echo "<p>t".$query22."query22"."t<p>";

						$result22=mysql_query($query22);

						$agrupp2_nimi=mysql_fetch_array($result22);


					/////////////////////////////////////////////////
					if($ava==1)

					{
					// veebipiltide j�rele aitamine
					//				echo "alajaotus";

					$queryb="SELECT * FROM `raamat` WHERE id=".$bookid."";
					$resultb=mysql_query($queryb);
					$lineb=mysql_fetch_array($resultb);
					$queryb1="SELECT * FROM `exp` WHERE raamatX_id=".$agrupp2_nimi["id"]."";
					$resultb1=mysql_query($queryb1);
					$lineb1=mysql_fetch_array($resultb1);
					//echo "sdf".$line2["veeb_pilt_url"]."<br>";
					if($lineb["veeb_pilt_url"] and $lineb1["id"] and !$agrupp2_nimi["veeb_pilt_url"])
					{
						$query2v2="UPDATE `fyysika_ee`.`exp` SET veeb_pilt_url='".$lineb["veeb_pilt_url"]."' WHERE id=".$lineb1["id"]." LIMIT 1";
						echo $query2v2,"<br><br>";
						$result2v2=mysql_query($query2v2);
						}
					}
					/////////////////////////////////////////////7
						?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  	<tr>

    	<td colspan="7" background="image/sinine.gif"><img src="image/valge.gif" width="55" height="1"></td>

  	</tr>

  	<tr>

      <? // j�llegi, avame v�i sulgeme alamr�hma

		  	  		  $tmp=array();

					  if($openasi_alamg2){

						foreach($open as $val){

							if($val!=$agrupp2["oid2"]) {

							array_push($tmp,$val);

								}

							}

							} else {

							if($open[0]!=0){$tmp=$open;}

							array_push($tmp,$agrupp2["oid2"]);

						}





// korrigeerime pid v�lja raamatX tabelis

$query22111="UPDATE raamatX set pid=2 WHERE id = ".$agrupp2_nimi["id"];

//echo $query22111;

$result22111=mysql_query($query22111);







						?>



    <td width="16%" nowrap><img src="image/spacer.gif" width="73" height="11"> <a href="index.php?page=raamat_tree&op=<? echo implode(",",$tmp);?>&bookid=<? echo $bookid;?>"><img border=0 src="image/index_<?  if($openasi_alamg2 or $ava==1){ echo "39";  } else { echo "36"; }?>.gif" width=19 height=19 alt=""><img border=0 src="image/spacer.gif" width="10" height="10"></a></td>



    <td width="63%" align="left" class="navi"><? echo $agrupp2_nimi["id"]," ","Nmbr: ",$agrupp2["sort_order"]."(".$jarjekord.")";  ?>(t<? echo $agrupp2_nimi["type"];?>)<a href="index.php?page=raamatX_disp&aid=<? echo $agrupp2["oid2"]; ?>&bookid=<? echo $bookid;?>" class="ekraan_link" target="_blank"><? echo $agrupp2_nimi["nimi_est"];  ?></a> - <? echo $agrupp2_nimi["tundide_arv"]; ?> <?



//	uurin, kas seal sees m�ni objekt ka on ...



	$query34="SELECT id, oid2 FROM raamatX_exp WHERE oid1=".$agrupp2_nimi["id"];

//echo $query34;

	$result34=mysql_query($query34);

	if(!mysql_fetch_array($result34)){



	?>

      <span class="style2">(T&uuml;hi)</span>      <? }





// kas vastav exp objekt on olemas?

$queryd2="SELECT * FROM `exp` WHERE raamatX_id=".$agrupp2["oid2"]."";

$resultd2=mysql_query($queryd2);

$lined2=mysql_fetch_array($resultd2);



if($lined2["raamatX_id"]) {?>

          <a class="navi" href="<? echo $PHP_SELF."?page=exp_disp&expid=".$lined2["id"];  ?>" target="_blank">exp</a> <? }


// Kontrollin, et raamatx objektile vastav exp objekt oleks teemaga seotud.
// Vajadusel korrigeerin

		$query22xx="SELECT * FROM raamatX_exp WHERE oid1=".$agrupp["oid2"]." AND oid2= ".$lined2["id"];

		//echo $query22xx;

		$result22xx=mysql_query($query22xx);

		$exp_asi=mysql_fetch_array($result22xx);

		if(!$exp_asi["id"])

		{

			$query_expasi ="INSERT INTO `fyysika_ee`.`raamatX_exp` (`id`, `book_id`, `oid1`, `oid2`,`sort_order`,`naita_veebis`) VALUES (NULL, '".$bookid."', '".$agrupp["oid2"]."', '".$lined2["id"]."','".$agrupp2["sort_order"]."', '1');";
			echo $query_expasi;
			$result_expasi=mysql_query($query_expasi);
		}









	  ?>      </td>
<?
// näita või ära näita, raamatX_raamatX.naita_veebis.
?>
<td width="6%" align="left" class="navi">
<select class="fields" id="seos_rX_show_<? echo $agrupp2["id"];?>" name="naita_veebis_rx" onchange="muuda_order('raamatX_raamatX','naita_veebis','seos_rX_show_<? echo $agrupp2["id"];?>','<? echo $agrupp2["id"];?>')"><?
for ($i = 0; $i < 2; $i++)
{
	switch($i)
	{
		case 0: $txt="OFF";break;
		case 1: $txt="ON";break;
	}
	if($i==$agrupp2["naita_veebis"]) { $sel="selected"; } else { $sel="";}
		echo "<option value=\"".$i."\" ".$sel.">".$txt."</option>";
}
?>
  </select>
<?
// näita või ära näita nuppu peatüki lõpus, raamatX_raamatX.show_repo_button
?>

  <select class="fields" id="seos_rXb_show_<? echo $agrupp2["id"];?>" name="naita_veebis_rxb" onchange="muuda_order('raamatX_raamatX','show_repo_button','seos_rXb_show_<? echo $agrupp2["id"];?>','<? echo $agrupp2["id"];?>')"><?

  for ($i = 0; $i < 2; $i++)

  {
  	switch($i)
  	{
  		case 0: $txt="HIDE";break;
  		case 1: $txt="SHOW";break;
  	}

  	if($i==$agrupp2["show_repo_button"]) { $sel="selected"; } else { $sel="";}

  		echo "<option value=\"".$i."\" ".$sel.">".$txt."</option>";

  }
  ?>
      </select></td>

    <td width="4%" class="navi"><input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=raamatX_raamatX&id=<? echo $agrupp2["id"];?>&sel=<? echo $asi["sel"];?>','Delete','toolbar=0,width=900,height=950,status=yes');" ></td>

  		<td width="1%" bgcolor="#CCFF99" class=\"menu\" ><input type="button" name="suva2" class="button" value="Otsi ja lisa exp" onclick="window.open('addvalue_iid_asp.php?domain=raamatX_exp&amp;oid=<? echo $agrupp2["oid2"];?>&amp;sel=<? echo $sel;?>&amp;otsing=exp&amp;vali=nimi_est','File_upload','toolbar=0,width=800,height=680,status=yes');" />

  	</td>

  		<td width="1%" bgcolor="#CCFF99" class=\"menu\" ><a href="index.php?page=exp_disp&klass=raamatX&klass_id=<? echo $agrupp2["oid2"];?>&bookid=<? echo $bookid;?>&action=new" target="_blank" class="button">

        Uus</a></td>

    <td width="0%" bgcolor="#FFFF99"></td>

  	</tr>

</table>



<?

					if ($openasi_alamg2 or $ava==1)

					{

/////////////////////////////////////////////////////////////////

// Korrastame objektide metaandmeid



	// kui sort_order on m��ramata, siis v�rdsustan selle id-ga, saan esialgse j�rjestuse.

	$queryte1="UPDATE `raamatX_exp` SET sort_order=id WHERE oid1=".$agrupp2_nimi["id"]." and sort_order<1";

	//echo $queryte1;

	$resultte1=mysql_query($queryte1);

	$queryte2="SELECT * FROM `raamatX_exp` WHERE oid1=".$agrupp2_nimi["id"]." order by sort_order";

	//echo $queryte2;

	$resultte2=mysql_query($queryte2);

	$count_count=1;

	while($linete2=mysql_fetch_array($resultte2))

	{

		$queryte3="UPDATE `raamatX_exp` SET sort_order=".$count_count." WHERE id=".$linete2["id"]."";

		//echo $queryte3;

		$resultte3=mysql_query($queryte3);

		$count_count++;

	}

///////////////////////////////////////////////









// Laotame lahti alamgrupi 2 eksponaadid ...

						$query34="SELECT * FROM raamatX_exp WHERE oid1=".$agrupp2["oid2"]." ORDER BY sort_order";

						if ($n2ita_querysid) echo $query34."query34 rrt".$exp_seos;

						$id_prev=0;



						$result34=mysql_query($query34);

						if($result34 == NULL) {}

						while($exp_seos=mysql_fetch_array($result34))

						{

						//echo "<pre>";



						//var_dump($exp_seos);

						//echo "</pre>";

						//echo "<p>";

							$query35="SELECT * FROM exp WHERE id=".$exp_seos["oid2"];

							if ($n2ita_querysid) echo $query35."query35"."<p>";

							$result35=mysql_query($query35);

							if ($n2ita_querysid) echo "<p>as".$query35;

							if ($result35 == TRUE) $exponaat_nimi=mysql_fetch_array($result35);

				if(!$exponaat_nimi)
				{
					echo "t�hi seos, kustutame?";
					$query222x="DELETE FROM raamatX_exp WHERE id=".$exponaat["id"]." LIMIT 1";
					//$result222x=mysql_query($query222x);

					echo $query222x;
				}
				else
				{
					//echo "ja ".$exponaat_nimi["id"];
				}



									?>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="11" background="image/sinine.gif"><img src="image/valge.gif" width="80" height="1"></td>

  </tr>

  <tr>

    <td width="5%" rowspan="3" align="right" valign="top"><div align="right"><img src="image/spacer.gif" width="129" height="12"><span class="ekspon"><? echo $exp_seos["meta1"]; ?><img src="image/spacer.gif" alt="ert" width="<? echo 25 - 6*strlen($exp_seos["sort_order"]); ?>" height="9" /></span></div></td>

    <td width="5%" rowspan="3" align="right" valign="top" class="options">

   <select id="exp_order_<? echo $exp_seos["id"];?>" onchange="muuda_order('raamatX_exp','sort_order','exp_order_<? echo $exp_seos["id"];?>','<? echo $exp_seos["id"];?>')"><?

for ($i = 1; $i <= 100; $i++)

{

	if($i==$exp_seos["sort_order"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$i."\" ".$sel.">".$i."</option>";

}?></select>
<? //echo "exp_koht_".$exp_seos["id"]."";

?>

<select class="navi" name="exp_koht_<? echo $exp_seos["id"];?>" id="exp_koht_<? echo $exp_seos["id"];?>" onChange="muuda_order('raamatX_exp','oid1','exp_koht_<? echo $exp_seos["id"];?>','<? echo $exp_seos["id"];?>')">
        <?

echo "<option value=\"ok\" selected>Hea koht</option>";

for($i=0;$i<count($agrupp2_objekt_id);$i++)

{

		echo "<option value=\"".$agrupp2_objekt_id[$i]."\">".$agrupp2_objekt_id[$i]."</option>";

}?>
      </select></td>

    <td width="5%" rowspan="3" valign="top"><div align="center"><span class="ekspon"><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span><img height="30" src="<? echo $var_gpid[$exponaat_nimi["gpid_demo"]];?>"  alt="" border=0 ><span class="ekspon"><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span></div></td>

    <td class="ekspon"><a href="index.php?page=exp_disp&expid=<? echo $exponaat_nimi["id"];?>" target="_blank"><em><? echo $exponaat_nimi["nimi_est"]; ?></em></a> (<? echo $exponaat_nimi["owner_user_id"];?>)<br />


 	</span></td>

    <td width="1%" rowspan="3" valign="top" class="ekspon"><select class="fields" id="seos_show_<? echo $exp_seos["id"];?>" name="naita_veebis" onchange="muuda_order('raamatX_exp','naita_veebis','seos_show_<? echo $exp_seos["id"];?>','<? echo $exp_seos["id"];?>')"><?

for ($i = 0; $i < 2; $i++)

{

	switch($i)

	{

		case 0: $txt="OFF";break;

		case 1: $txt="ON";break;

	}

	if($i==$exp_seos["naita_veebis"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$i."\" ".$sel.">".$txt."</option>";

}



?>



  </select>

        </td>

    <td width="1%" rowspan="3" valign="top" class="ekspon"><select class="fields" id="exp_show_<? echo $exponaat_nimi["id"];?>" name="naita_veebis_est" onchange="muuda_order('exp','naita_veebis_est','exp_show_<? echo $exponaat_nimi["id"];?>','<? echo $exponaat_nimi["id"];?>')"><?

for ($i = 0; $i < 2; $i++)

{

	switch($i)

	{

		case 0: $txt="OFF";break;

		case 1: $txt="ON";break;

	}

	if($i==$exponaat_nimi["naita_veebis_est"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$i."\" ".$sel.">".$txt."</option>";

}



?>



  </select></td>

    <td width="1%" rowspan="3" valign="top" class="ekspon"><select class="fields" id="exp_slave_<? echo $exponaat_nimi["id"];?>" name="on_slave" onchange="muuda_order('exp','on_slave','exp_slave_<? echo $exponaat_nimi["id"];?>','<? echo $exponaat_nimi["id"];?>')"><?

for ($i = 0; $i < 2; $i++)

{

	switch($i)

	{

		case 0: $txt="Master";break;

		case 1: $txt="Slave";break;

	}

	if($i==$exponaat_nimi["on_slave"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$i."\" ".$sel.">".$txt."</option>";

}


?>



  </select>
<?
if($exponaat_nimi["gpid_demo"] == 21 || $exponaat_nimi["gpid_demo"] == 32|| $exponaat_nimi["gpid_demo"] == 20 || $exponaat_nimi["gpid_demo"] == 23)
{
  make_exp($exponaat_nimi["id"],$exponaat_nimi["gpid_demo"],$db);
}

?>

  </td>

    <td width="1%" rowspan="3" valign="top" class="ekspon"><input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=raamatX_exp&id=<? echo $exp_seos["id"]; ?>&sel=1&bookid=<? echo $bookid;?>','Delete','toolbar=0,width=920,height=800,status=yes');" >

    </td>

    <td width="2%" rowspan="3" valign="top" class="ekspon"><input name="button2" type="button" class="button2" onclick="window.open('delvalue_iid.php?domain=raamatX_exp&id=<? echo $exp_seos["id"]; ?>&sel=1&bookid=<? echo $bookid;?>','Delete','toolbar=0,width=420,height=200,status=yes');" value="x" /></td>

    <td width="8%" rowspan="3" align="right" valign="top" class="ekspon"><?



	if($exponaat_nimi["gpid_demo"] != 31)

	{

		if($exponaat_nimi["veeb_pilt_url"])

		{

			?><img width="60" src="<? echo urldecode($exponaat_nimi["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"><?

		}

		}

		else

		{

		?><img width="60" src="media/valem_pildid/<? echo urldecode($exponaat_nimi["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"> <?

		}

?></td>

  </tr>

  <tr>

<!--pane t�hele, et siin on k�situd otse title1-te, st teiselt poolt vaadates asi ei t��taks-->

    <td class="options"><?



if ($exponaat_nimi["gpid_demo"]<20)

{

	?><? echo "Allkiri: "; ?><? echo $exp_seos["title_est"]; ?>

<?



}

/*else

{

	echo $exponaat_nimi["nimi_est"];

}
*/
echo "<br>book_ID: ",$exp_seos["book_id"];

?></td>

  </tr>


</table>

	<?



if($exp_seos["book_id"]!=$bookid)

{

	$query_seosid1="UPDATE raamatX_exp SET book_id=".$bookid." WHERE id=".$exp_seos["id"];

//	echo $query_seosid;

	$result_seosid1=mysql_query($query_seosid1);
}
else
{
	echo "xxx";
}

$id_prev=$exp_seos["id"];





						} // end of alamgrupid 2 eksponaat



					}	// end of if



// vajadusel korrigeerime book_id v�lja raamatX_raamatX tabelis

if($agrupp2["book_id"]==0)

{

	$query221112="UPDATE raamatX_raamatX set book_id=".$bookid." WHERE id = ".$agrupp2["id"];

	//echo $query221112;

$result221112=mysql_query($query221112);

}







			}// end of while alamgrupp 2 nimi





// SIIA TULEB MILLALGI TUNNIL�PUMATERJAL ...





} // end of if alamgrupi 2  nimi






/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

// Laotame lahti alamgrupi 1 eksponaadid ...

		if ($openasi_alamg or $ava==1){

			$query24="SELECT * FROM raamatX_exp WHERE oid1=".$agrupp["oid2"]." ORDER BY sort_order";

			if ($n2ita_querysid) echo $query24."query24"."<p>";

			$result24=mysql_query($query24);

			while($exponaat=mysql_fetch_array($result24))

			{

				$query25="SELECT * FROM exp WHERE id=".$exponaat["oid2"];

				if ($n2ita_querysid) echo $query25."query25"."<p>";

				$result25=mysql_query($query25);

				$exponaat_nimi=mysql_fetch_array($result25);
				if(!$exponaat_nimi)
				{
					echo "t�hi seos, kustutame?";
					$query222="DELETE FROM raamatX_exp WHERE id=".$exponaat["id"]." LIMIT 1";
					$result222=mysql_query($query222);

					echo $query222;
				}

					if ($n2ita_querysid) echo "<p><pre>cvbn";

					//echo $query35;

					if ($n2ita_querysid) var_dump($exponaat_nimi);

					if ($n2ita_querysid) echo "</pre>";

									?>

<? if (1) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="7" background="image/sinine.gif"><img src="image/valge.gif" width="80" height="1"></td>

  </tr>

  <tr>

    <td width="10%" rowspan="3"><div align="left"><div align="left"><img src="image/spacer.gif" width="1

	" height="12"><span class="ekspon"><? echo $exponaat["sort_order"]; ?><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span>
    <? //echo "exp_koht_".$exponaat["id"]."";

?>

      <select class="navi" name="exp_koht_<? echo $exponaat["id"];?>" id="exp_koht_<? echo $exponaat["id"];?>" onChange="muuda_order('raamatX_exp','oid1','exp_koht_<? echo $exponaat["id"];?>','<? echo $exponaat["id"];?>')">
        <?

echo "<option value=\"ok\" selected>Hea koht</option>";

for($i=0;$i<count($agrupp2_objekt_id);$i++)

{

		echo "<option value=\"".$agrupp2_objekt_id[$i]."\">".$agrupp2_objekt_id[$i]."</option>";

}?>
      </select>
    </div><span class="ekspon"><? echo $exponaat["sort_order"]; ?><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span></div></td>

    <td width="5%" rowspan="3" valign="top"><div align="center"><span class="ekspon"><img height="30" src="<? echo $var_gpid[$exponaat_nimi["gpid_demo"]];?>"  alt="" border=0 ></span></div></td>

    <td valign="top" class="ekspon"><span class="navi"><? //echo $exponaat_nimi["id"]; ?></span> <? //echo $exponaat["oid2"]; ?><a href="index.php?page=exp_disp&expid=<? echo $exponaat_nimi["id"];?>" target="_blank"><em><? echo $exponaat_nimi["nimi_est"]; ?></em></a> (<? echo $exponaat_nimi["owner_user_id"]; ?>)<br />

      <? if($exponaat_nimi["video_url"]){ ?>

      <a class="button3" href="<? echo $exponaat_nimi["video_url"]; ?>">Video</a>

      <? }?>



    </td>

    <td width="2%" rowspan="3" class="ekspon"><div align="right">

        <input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=raamatX_exp&id=<? echo $exponaat["id"]; ?>&sel=1&bookid=<? echo $bookid;?>','Delete','toolbar=0,width=920,height=800,status=yes');" >

    </div></td>

    <td width="2%" rowspan="3" class="ekspon"><input name="button" type="button" class="button2" onclick="window.open('delvalue_iid.php?domain=<? echo $baas; ?>_exp&id=<? echo $exponaat["id"]; ?>&sel=1','Delete','toolbar=0,width=420,height=200,status=yes');" value="x" /></td>

    <td width="8%" rowspan="3" align="right" class="ekspon"><? if($exponaat_nimi["veeb_pilt_url"]){?><img width="60" src="<? echo urldecode($exponaat_nimi["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"><? } else { ?><img border=1 src="image/spacer.gif" width="6" height="6"><? }?></td>

  </tr>

  <tr>

<!--pane t�hele, et siin on k�situd otse title1-te, st teiselt poolt vaadates asi ei t��taks-->

    <td class="navi"></td>

  </tr>

  <tr>

    <td class="navi"><? echo $exponaat["title_est"]; ?></td>

  </tr>

</table>

<? }



if($exponaat["book_id"]!=$bookid)

{

	$query_seosids="UPDATE raamatX_exp SET book_id=".$bookid." WHERE id=".$exponaat["id"];

	//echo $query_seosid;

	$result_seosids=mysql_query($query_seosids);

}



?>





<?

		}	// end of if

	} // end of alamgrupid eksponaat

} // end of alamgrupi nimi



	} // ----------------- peagrupp avatud ---------

/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

// Laotame lahti alamgrupi 0 eksponaadid ...

		if ($openasi or $ava==1){

			$query24="SELECT * FROM raamatX_exp WHERE oid1=".$line["id"]." ORDER BY sort_order";

			if ($n2ita_querysid) echo $query24."query24"."<p>";

			$result24=mysql_query($query24);

			while($exponaat=mysql_fetch_array($result24))

			{

				$query25="SELECT * FROM exp WHERE id=".$exponaat["oid2"];

				if ($n2ita_querysid) echo $query25."query25"."<p>";

				$result25=mysql_query($query25);

				$exponaat_nimi=mysql_fetch_array($result25);
				if(!$exponaat_nimi)
				{
					echo "t�hi seos, kustutame?";
					$query2221="DELETE FROM raamatX_exp WHERE id=".$exponaat["id"]." LIMIT 1";
					$result2221=mysql_query($query2221);

					echo $query2221;
				}

					if ($n2ita_querysid) echo "<p><pre>cvbn";

					//echo $query35;

					if ($n2ita_querysid) var_dump($exponaat_nimi);

					if ($n2ita_querysid) echo "</pre>";

									?>

<? if ($ava==1) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="7" background="image/sinine.gif"><img src="image/valge.gif" width="80" height="1"></td>

  </tr>

  <tr>

    <td width="10%" rowspan="3" valign="top"><div align="left"><img src="image/spacer.gif" width="1

	" height="12"><span class="ekspon"><? echo $exponaat["sort_order"]; ?><img src="image/spacer.gif" alt="ert" width="19" height="9" /></span>
      <select class="navi" name="exp_koht_<? echo $exponaat["id"];?>" id="exp_koht_<? echo $exponaat["id"];?>" onChange="muuda_order('raamatX_exp','oid1','exp_koht_<? echo $exponaat["id"];?>','<? echo $exponaat["id"];?>')">
        <?

echo "<option value=\"ok\" selected>Hea koht</option>";

for($i=0;$i<count($agrupp2_objekt_id);$i++)

{

		echo "<option value=\"".$agrupp2_objekt_id[$i]."\">".$agrupp2_objekt_id[$i]."</option>";

}?>
      </select>
    </div></td>

    <td width="5%" rowspan="3" valign="top"><div align="center"><span class="ekspon"><img height="30" src="<? echo $var_gpid[$exponaat_nimi["gpid_demo"]];?>"  alt="" border=0 ></span></div></td>

    <td valign="top" class="ekspon"><span class="navi"><? //echo $exponaat_nimi["id"]; ?></span> <? //echo $exponaat["oid2"]; ?><a href="index.php?page=exp_disp&expid=<? echo $exponaat_nimi["id"];?>" target="_blank"><em><? echo $exponaat_nimi["nimi_est"]; ?></em></a> (<? echo $exponaat_nimi["owner_user_id"]; ?>)<br />

      <? if($exponaat_nimi["video_url"]){ ?>

      <a class="button3" href="<? echo $exponaat_nimi["video_url"]; ?>">Video</a>

      <? }?>



    </td>

    <td width="2%" rowspan="3" class="ekspon"><div align="right">

        <input type="button" class="button3" value="m" onClick="window.open('addvalue_iid_mod.php?domain=raamatX_exp&id=<? echo $exponaat["id"]; ?>&sel=1&bookid=<? echo $bookid;?>','Delete','toolbar=0,width=920,height=800,status=yes');" >

    </div></td>

    <td width="2%" rowspan="3" class="ekspon"><input name="button" type="button" class="button2" onclick="window.open('delvalue_iid.php?domain=<? echo $baas; ?>_exp&id=<? echo $exponaat["id"]; ?>&sel=1','Delete','toolbar=0,width=420,height=200,status=yes');" value="x" /></td>

    <td width="8%" rowspan="3" align="right" class="ekspon"><? if($exponaat_nimi["veeb_pilt_url"]){?><img width="60" src="<? echo urldecode($exponaat_nimi["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"><? } else { ?><img border=1 src="image/spacer.gif" width="6" height="6"><? }?></td>

  </tr>

  <tr>

<!--pane t�hele, et siin on k�situd otse title1-te, st teiselt poolt vaadates asi ei t��taks-->

    <td class="navi"></td>

  </tr>

  <tr>

    <td class="navi"><? echo $exponaat["title_est"]; ?></td>

  </tr>

</table>

<?
/////////////////////////////////////////////
if($bookid==62)
{
	//echo "formaadime pildid ...";
	//make_pic($exponaat_nimi["id"]);

}
}
}// pid=0 exp objektid
}
}



// M��ratlemata ...

?><a name="jarg"></a><? ?>
