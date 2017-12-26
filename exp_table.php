<link href="scat.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="ahaa.js"></script>

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

	mb_internal_encoding('UTF-8');

	$action=$_GET["action"];

	$klass=$_GET["klass"];

	$bookid=$_GET["bookid"];

	$sel=$_GET["sel"];

	$kat=$_GET["kat"];

	

	$tykid_kat=explode(",", $kat);

	for($ii = 1; $ii < sizeof($tykid_vv); ++$ii)

	{

		

	}

	

	

	

	$veeb=$_GET["veeb"]; // parameeter k'eseb allpool konverteerida teatud sorts pilte veebiformaati

	$ord=$_GET["ord"];

	if($ord==NULL) {$ord="nimi_est";} 

	if($ord=="lupdate") {$ord = $ord." DESC";}	

	

	function getYoutubeDuration($videoid) {

      $xml = simplexml_load_file('https://gdata.youtube.com/feeds/api/videos/' . $videoid . '?v=2');

      $result = $xml->xpath('//yt:duration[@seconds]');

      $total_seconds = (int) $result[0]->attributes()->seconds;



      return $total_seconds;

}



function validYoutube($id){

    $id = trim($id);

    if (strlen($id) === 11){

        $file = @file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$id);

        return !!$file;

    }

    return false;

}



?><script>

function muuda(exp_id,field)

{

	var mylist=document.getElementById("list_"+field+"_" + exp_id).value;

//	document.getElementById("favorite").value=exp_id + " ja " + mylist;

	  

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

	

	xmlhttp.open("GET","exp_table_asp.php?expid="+exp_id+"&field="+field+"&value="+mylist,true);

	xmlhttp.send();	//mylist.options[mylist.selectedIndex].text;



}

function muuda_liik(valem_id)

{

	var mylist=document.getElementById("on_pohivara_" + valem_id).value;

//	document.getElementById("favorite").value=exp_id + " ja " + mylist;

	  

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

	

	xmlhttp.open("GET","valem_table_asp.php?valemid="+valem_id+"&liik="+mylist,true);

	xmlhttp.send();	//mylist.options[mylist.selectedIndex].text;



}



</script>





<?

//SQL rida ...

//mysql_query("UPDATE exp SET jarjest=jarjest-380;");





	if($action=="del")

	{

		$expid=$_GET["expid"];

		$mediadirs=array("exp_pildid","exp_doclist","exp_kasutusjuhend","exp_skeem");

		foreach($mediadirs as $tmp)

		{

			$dd="media/".$tmp;

			$q="SELECT url FROM ".$tmp." WHERE oid=".$expid;

//			echo $q;

			$r=mysql_query($q);

			while($line=mysql_fetch_array($r)){

				unlink(urldecode($line["url"]));  

				}	

		}				

		$tables=array('exp_lingid','exp_analoogid');

		

		foreach($tables as $name){

			$q="DELETE FROM ".$name." WHERE oid=".$expid;

			$r=mysql_query($q);

		}



		$tables=array('exp_naitused','exp_jnaitused','exparendus','exp_doclist','exp_pildid','exp_kasutusjuhend','exp_mudel','exp_naitused','exp_skeem','exp_vestlus');

		foreach($tables as $name){

			$q="DELETE FROM ".$name." WHERE expid=".$expid;

			$r=mysql_query($q);

		}



		$q="DELETE FROM exp WHERE id=".$expid;

		$r=mysql_query($q);

	}



// otsing stringi jarele ...

		$str='';

// kui on tehtud valik staatuse j'rgi .. 

	if($sel!=NULL) 

	{

		$str1 = " AND staatus_id =".$sel;

//	echo $str1;

	}

	else

	{	

		$str1='';

	}

// kui on tehtud valik demolisuse j'rgi .. 

/*	if($kat!=NULL) 

	{

		if(!strstr($kat,'2'))

		{

			$str2 = " AND gpid_demo IN (".$kat.")";

		}

		else

		{

			$str2 = " AND ((gpid_demo IN (".$kat.")) OR (CHAR_LENGTH(tex1)>0))";

		}

	}

	else

	{	

		$str2='';

	}

*/	

$str2 = " AND gpid_demo IN (".$kat.")";

	



if($kat==14)

{/*

	

//	echo "Tere kosmos <br>";

	

	$q_uudis="SELECT * from wp_posts WHERE post_parent=0";

	$r_uudis=mysql_query($q_uudis);

	while($uu=mysql_fetch_array($r_uudis))

	{

		//echo "uudis: ",$uu["ID"]." ".$uu["post_title"],"<br>";

// kas on juba andmebaasis ... 

		$q_uudis_exp="SELECT * from exp WHERE id_uudis=".$uu["ID"];

		$r_uudis_exp=mysql_query($q_uudis_exp);

		

// leiame viimase redaktsioon ...

		$q_uudis_r="SELECT * from wp_posts WHERE post_parent=".$uu["ID"]." order by ID DESC";

		$r_uudis_r=mysql_query($q_uudis_r);

		$uu_r=mysql_fetch_array($r_uudis_r);



// uuendan ...		

		if(!$uu_exp=mysql_fetch_array($r_uudis_exp))

		{

			//echo "Vaja lisada!!<br>";

		}

		else

		{

			//echo "Olemas!!<br>";

			$query_uuenda="UPDATE exp SET nimi_est='".$uu_r["post_title"]."' WHERE id=".$uu_exp["id"];

			echo $query_uuenda;

			mysql_query($query_uuenda);

		}

		

	

		

		

	}



	

*/}





	

	$query="SELECT * FROM exp where nimi_est LIKE '%".$_POST["search_str"]."%'".$str." ".$str1." ".$str2." and on_slave=0 ORDER BY ".$ord;

//	echo $query;



/*if($_POST["search_YTID"])	{

	$query="SELECT * FROM exp WHERE video_url LIKE '%".$_POST["search_YTID"]."%'".$str." ".$str1." ".$str2." ORDER BY ".$ord;

	}

	*/

	

//	echo $query;

	$result=mysql_query($query);

	include("globals.php");



	$count=0;

// liikide andmed andmebaasist	

	$liik=array();

	$query_liik="SELECT * FROM exp_grupid_demo ORDER BY id";

	$result_liik=mysql_query($query_liik);

	while($var=mysql_fetch_array($result_liik)){

		array_push($liik,$var);

//		echo $liik[$count]["nimi_lyhike"];

		$count++;

	}
	$count=0;

// uute liikide andmed	

	$liik_uus=array();

	$query_liik_uus="SELECT * FROM exp_grupid_uus ORDER BY id";

	$result_liik_uus=mysql_query($query_liik_uus);

	while($var=mysql_fetch_array($result_liik_uus)){

		array_push($liik_uus,$var);

//		echo $liik[$count]["nimi_lyhike"];

		$count++;

	}

	$count=0;

// staatuste andmed andmebaasist	

	$staatus=array();

	$query_staatus="SELECT * FROM exp_staatus ORDER BY id";

	$result_staatus=mysql_query($query_staatus);

	while($var=mysql_fetch_array($result_staatus)){

		array_push($staatus,$var);

//		echo $liik[$count]["nimi_lyhike"];

		$count++;

	}







?>	<input type="text" id="favorite" size="80">

<? if(strstr($kat,'6'))

		{

			?><?php /*?><a href="exp_print_doc.php?kat=<? echo $kat; ?>" target="_blank" class="options">update_doc</a><?php */?><?

		}

?>&nbsp;<a href="exp_print_raamatX.php?kat=<? echo $kat; ?>" target="_blank" class="options">update_raamatX</a><?



if(strstr($kat,'6') OR strstr($kat,'30') OR strstr($kat,'37')) 

{

?>



&nbsp;<a href="exp_print_slaidid.php?kat=<? echo $kat; ?>" target="_blank" class="options">update_slaidid</a>



<?

}

?>

 <table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

  <td class="menu" width="0%" align="center">&nbsp;</td> 

    <td class="menu" width="0%" align="center"><a href="index.php?page=exp_table&ord=rank&kat=<? echo $kat;?>">Rank</a></td>

    <td width="90%" align="left" class="navi"><span class="menu"><a href="index.php?page=exp_table&ord=nimi_est&kat=<? echo $kat;?>">Nimi</a></span></td>

    <td width="1%" align="left" class="navi">&nbsp;</td>

    <td width="1%" align="center" nowrap class="menu">Slave</td>

    <td width="1%" align="center" nowrap class="menu">Liik</td>

    <td width="1%" align="center" class="menu"  >Pilt&nbsp;<a href="index.php?page=exp_table&ord=lupdate&kat=<? echo $kat;?>">lpdate</a></td>

    <td width="1%" align="center" valign="middle"class="menu">Staatus</td>

    <td width="1%" align="center" valign="middle" class="navi"><? if($bookid) {?><a href="http://www.fyysika.ee/omad/exp_table_raamat.php?bookid=<? echo $bookid;?>&kat=<? echo $kat; ?>" target="_blank">pr</a><? }?></td>

   </tr><?



	$id_prev=0;

	$counter = 1;

	while($line=mysql_fetch_array($result))

	{

			// loeme kokku vastava id/ga vestluste kirjed exp_vestlus andmebaasis ...

					$query="SELECT COUNT( * ) FROM exparendus WHERE oid=".$line["id"]." ";

					$result1=mysql_query($query);

					$count=mysql_fetch_array($result1);

			//		echo $count[0];

if($bookid)

{

	

			// Kas raamatus ka midagi sees on?

					$query_33="SELECT * FROM raamatX_exp WHERE oid2=".$line["id"]." AND book_id=".$bookid;

					//echo $query_33;

					$result_33=mysql_query($query_33);

					if(mysql_fetch_array($result_33))

					{

						$on = 1;

					}

					else

					{

						$on = 0;

					}

			//		echo $count[0];

	

}

else

{

	

					$on=1;	

}

////////////////////////////////////////////

// Uuendame terve nimekirja kokku_est väljad



/*	$expid=$line["id"];

	include('setkokkuest.php');

*/

if($on==1)



{?>

			

  <tr>

    <td valign="top" class="navi" <? if($line["on_pohivara"]==1)

{ ?>bgcolor="#99FFCC"<? }?>><? echo $counter,".";?></td> 

    <td valign="top" class="menu_punane" ><? echo $line["rank"];?></td>

    <td valign="top" class="menu"><a href="index.php?page=exp_disp&expid=<? echo $line["id"]; ?>" target="_blank"><? echo $line["nimi_est"];?> 

      </a>	<? if($line["id_youtube"]) {?><span class="navi">(<? echo $line["time_youtube"]; ?>) 

</span><? }?>&nbsp;<span class="options"><? if($line["gpid_demo"]!=15){echo $line["kirjeldus_est"]; echo $line["probleem_est"]; }?></span><? 

	  

if($line["time_youtube"]=="00:00:00" && $line["id_youtube"])

{

	if(validYoutube($line["id_youtube"]))

	{

		$time1=getYoutubeDuration($line["id_youtube"]);

		$q_1="UPDATE exp SET time_youtube=SEC_TO_TIME(".$time1.") where id=".$line["id"];

		$r_1=mysql_query($q_1);

//		echo $q_1;

		echo "Time Set!";

	}

	else

	{

		?><span class="menu_punane">Youtube ID katki?</span><?

	}

}	  

	?>  

<? if($line["gpid_demo"]==31)

{

?><span class="navi"><? echo $line["tex"];

?></span>



<p align="center">

<img src="media/valem_pildid/<? echo $line["image"];?>" />

</p>	

<?

}

?>

</td>

    <td valign="top" class="menu"><? 

	

	if(($line["gpid_demo"]==6) AND $line["naita_veebis"]==1)

	{

	 ?><?php /*?><a href="media/exp_docs/EksperimentETAG<? echo $line["id"];?>.docx"><img src="image/icon_doc.jpg" alt="doc" height="30" border="0" /></a><?php */?><? 

	 } 

	 if(($line["gpid_demo"]==6 OR $line["gpid_demo"]==40) AND $line["naita_veebis"]==1)

	{

	 ?><a href="http://opik.fyysika.ee/index.php/exp/display/<? echo  $line["id"];?>" target="_blank" class="menu_punane"><img src="image/icon_eopik.png" alt="eopikus" height="30" border="0" /></a><?php /*?><a href="exp_print.php?domain=exp&id=<? echo $line["id"];?>" class="menu_punane" target="_blank"><img src="image/ico_exp_15_v.png" alt="print" width="30" height="30" border="0" /></a><?php */?><? }?><?

     

	if($line["gpid_demo"]==6 OR $line["gpid_demo"]==37)

	{

 

	 

	 ?><a href="http://opik.fyysika.ee/index.php/slide/run/<? echo $line["slideshow_id"];?>;" target="_blank"><img src="image/icon_slideshow.png" alt="slaididena" width="30" border="0" /></a><? 

	 

	}

	?></td> 

    <td valign="top" nowrap class="menu">

<select id="list_on_slave_<? echo $line["id"];?>" onchange="muuda('<? echo $line["id"];?>','on_slave')"><?

$pv=array(0,1);



for ($i = 0; $i < 2; $i++) 

{

	if($pv[$i]==0) $master="Master"; else $master="slave"; 

	if($pv[$i]==$line["on_slave"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$pv[$i]."\" ".$sel.">".$master."</option>"; 

}?>



</select>



<? 

if($line["on_slave"]==0)

{// Kontrollime, kas on mõne õpiku küljes 

	$r_2=mysql_fetch_array(mysql_query("SELECT * FROM raamatX_exp WHERE oid2=".$line["id"]));

	echo "<br>(<a href=\"index.php?page=raamatX_disp&aid=".$r_2["oid1"]."\" target=\"_blank\">".$r_2["oid1"]."</a>)";

}



?>



</td>

     <td align="left" valign="top" >

  <?    //echo "list_liik_".$line["id"];?>

  <select id="list_liik_<? echo $line["id"];?>" onchange="muuda('<? echo $line["id"];?>','liik')"><?

for ($i = 0; $i < count($liik); $i++) 

{

	if($liik[$i]["id"]==$line["gpid_demo"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$liik[$i]["id"]."\" ".$sel.">".$liik[$i]["nimi_lyhike"]."</option>"; 

}?>

    

  </select><br><select id="on_pohivara_<? echo $line["id"];?>" onchange="muuda_liik('<? echo $line["id"];?>')"><?

$pv=array(0,1);



for ($i = 0; $i < 2; $i++) 

{

	if($pv[$i]==$line["on_pohivara"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$pv[$i]."\" ".$sel.">".$pv[$i]."</option>"; 

}?>



</select>
<select id="list_liik_uus_<? echo $line["id"];?>" onchange="muuda('<? echo $line["id"];?>','liik_uus')"><?

for ($i = 0; $i < count($liik_uus); $i++) 

{

	if($liik_uus[$i]["id"]==$line["gpid"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$liik_uus[$i]["id"]."\" ".$sel.">".$liik_uus[$i]["nimi_lyhike"]."</option>"; 

}?>

    

  </select>
<!--<a href="exp_print.php?domain=exp&id=<? //echo $line["id"];?>" class="menu_punane" target="_blank"><img src="image/ico_exp_15_v.png" alt="print" width="30" height="30" border="0" /></a>-->

</td>

    <td valign="top"><? if($line["veeb_pilt_url"]) {?>

      <a href="<? 

	  

	  switch($line["gpid_demo"])

	  {

		case 1:

		case 4: 

		case 5: echo "http://www.youtube.com/v/",$line["id_youtube"];

		break;

		

	  	default: echo urldecode($line["veeb_pilt_url_s"]); 

		break;

	  }

	  

	 ?>" target="_blank"><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" width="100" border="0" /></a>

    <? } else { ?><img src="../images/spacer.gif"  width="40"/><? }?>

   </td>

    <td valign="top" class="navi">

    

<select id="list_show_<? echo $line["id"];?>" onchange="muuda('<? echo $line["id"];?>','show')"><?

for ($i = 0; $i < 2; $i++) 

{

	switch($i)

	{

		case 0: $txt="OFF";break;

		case 1: $txt="ON";break;

	}

	if($i==$line["naita_veebis"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$i."\" ".$sel.">".$txt."</option>"; 

}



?>

    

  </select><br>

  <select name="list_staatus_<? echo $line["id"];?>" id="list_staatus_<? echo $line["id"];?>" onchange="muuda('<? echo $line["id"];?>','staatus')">

    <?

for ($i = 0; $i < count($staatus); $i++) 

{

	if($staatus[$i]["id"]==$line["staatus_id"]) { $sel="selected"; } else { $sel="";}

		echo "<option value=\"".$staatus[$i]["id"]."\" ".$sel.">".$staatus[$i]["nimi"]."</option>"; 

}?>

  </select><? if($line["staatus_id"]==1) //kui asi on töös, siis näita kohe, kes tegeleb

{

	echo "<br>tegijad";

}

?></td>

    <td valign="top" nowrap class="smallbody">&nbsp;<? if($priv>=2) {?>

      <div align="right"><a onclick='javascript:kysi("index.php?page=exp_table&action=del&kat=<? echo $kat; ?>&expid=<? echo $line["id"]; ?>&bookid=<? echo $bookid;?>","Oled p&atilde;ris kindel, et soovid kustutada kirje <? echo $line["nimi_est"];?>?")' class="button2">x</a> 

        <?		

	$id_prev = $line["id"];

		 } ?>

		 <? if($priv>=2 and $line["gpid_demo"]==31) {?>

      <div align="right"><a onClick="window.open('addvalue_iid_merge.php?id=<? echo $line["id"]; ?>','Delete','toolbar=0,width=1200,height=850,status=yes, scrollbars=1');" class="button2">m</a> 

        <?		

	$id_prev = $line["id"];

		 } ?>

      </div></td>

  </tr>

<?

$counter++;

}

}	// ------------- peagrupi exponaat -----------

?>

</table>



