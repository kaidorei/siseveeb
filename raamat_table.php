<link href="scat.css" rel="stylesheet" type="text/css" />



<? 	

	mb_internal_encoding('UTF-8');

	$action=$_GET["action"];

	$klass=$_GET["klass"];

	$sel=$_GET["sel"];

	$kat=$_GET["kat"];

	$veeb=$_GET["veeb"]; // parameeter k'eseb allpool konverteerida teatud sorts pilte veebiformaati

	$ord=$_GET["ord"];

	if($ord==NULL) {$ord="nimi_est";} 

	if($ord=="lupdate") {$ord = $ord." DESC";}	



?>

<?

//SQL rida ...

//mysql_query("UPDATE exp SET jarjest=jarjest-380;");





	if($action=="del")

	{

		$bookid=$_GET["bookid"];

		$q="DELETE FROM raamat WHERE id=".$bookid;

		$r=mysql_query($q);

	}



// otsing stringi jarele ...

		$str='';

	

	$query="SELECT * FROM raamat WHERE nimi_est LIKE '%".$_POST["search_str"]."%'".$str." ORDER BY ".$ord;



	

//	echo $query;

	$result=mysql_query($query);

	include("globals.php");



?><table width="100%" border="0">

  <tr>

    <td width="61%"><table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr> 

    <td width="1%" align="center">&nbsp;</td>

    <td width="90%" align="center" class="navi"> <img src="image/spacer.gif" width="10" height="5"><span class="menu"><a href="index.php?page=exp_table&ord=nimi_est&kat=<? echo $kat;?>">Nimi</a></span></td>

    <?	$bookid = $line["id"];

?>

    <td width="5%" align="center" class="menu"  >Pilt</td>

    <td width="1%" colspan="2" align="center" valign="middle">&nbsp;</td>

    </tr>

<?



	while($line=mysql_fetch_array($result))

	{

					?>

			

  <tr> 

    <td colspan="6" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

  </tr>

  <tr> 

    <td valign="top"><img border=0 src="image/index_41.gif" width=19 height=19 alt="">    </td>

    <td valign="top" class="menu"><a href="index.php?page=raamat_tree&bookid=<? echo $line["id"]; ?>" target="_blank"><? echo $line["nimi_est"];?></a> (<a href="index.php?page=raamat_disp&bookid=<? echo $line["id"]; ?>" target="_blank">edit</a>) </td>

    <td width="18%" rowspan="2" valign="middle"><? if ($line["veeb_pilt_url"]) {?><a href=<? echo urldecode($line["veeb_pilt_url_s"]); ?> target=_blank><img src="<? echo urldecode($line["veeb_pilt_url"]); ?>" alt="Veebipilt puudub" name="veeb_pilt_url" style="background-color: #CCCCCC" / height="70"></a><? } else {?>

              <img src="image/noimage.jpg" height="70" />              <? }?>

   </td>

    <td width="5%" rowspan="2" valign="top" nowrap class="smallbody">&nbsp;<? if($priv>=2) {?>

      <div align="right"><a href="index.php?page=raamat_table&action=del&kat=<? echo $kat; ?>&bookid=<? echo $line["id"]; ?>" class="menu_punane">x</a> 

        <?		

	$id_prev = $line["id"];

		 } ?></div></td>

    </tr>

  <tr>

    <td colspan="2" valign="top"><?php

				

			 

					$query_liigid = "SELECT * FROM exp_grupid ORDER BY id";

					$result_liigid = $db->query($query_liigid);

					while($row = $result_liigid->fetch_assoc()) {

						echo '<a href="?page=exp_table&kat=' . $row['alamgrupid'] . '&bookid='.$line["id"].'" target="_blank"><img height="25" src="' . $row['ico_url_v'] . '" alt="&nbsp;' . $row['nimi'] . '" title="' . $row['nimi'] . '" border="0"></a>';

						if($row["id"] == $_GET['kat']) $liigipilt = $row['ico_url_v'];

					}

			 

				?></td>

    </tr>

<?

}	

?>

</table></td>

    <td width="39%" valign="top"><table width="100%" border="0" cellpadding="0">

   <tr>

     <td colspan="2" background="image/sinine.gif" class="options">Foorum/Arendus</td>

     </tr>

<?

	$query="SELECT * FROM raamatXarendus ORDER BY id DESC LIMIT 15";

	$result=mysql_query($query);

	

	while($line=mysql_fetch_array($result))

	{

		$query_exp="SELECT * FROM raamatX WHERE id=".$line["oid"]."";

		$result_exp=mysql_query($query_exp);

		$line_exp=mysql_fetch_array($result_exp)

?> 

   <tr>

     <td colspan="2" align="right" valign="top" class="options">

     

     

     					<? $query2="SELECT eesnimi,perenimi FROM isik WHERE id=".$line["user_id"];

					$result2=mysql_query($query2);

					$line2=mysql_fetch_array($result2); ?>

	<? echo $line["date"]; ?> ( <? echo $line2["eesnimi"];?> <? echo $line2["perenimi"];?> )</td>

     </tr>

   <tr>

    <td width="51%" valign="top" class="options"><a href="http://www.fyysika.ee/omad/index.php?page=exp_disp&expid=<? 	echo $line["oid"];?>"><? 	echo $line_exp["nimi_est"];?></a>      </td>

    <td width="49%" valign="top" class="options"><? 	echo $line["body"];?></td>

  </tr><tr>

									<td colspan="2" background="image/sinine.gif"><img height="1" width="1" src="image/sinine.gif" /></td>

			  </tr>

<?

	

	}

	

	

	 ?>

 </table></td>

  </tr>

</table>



 



