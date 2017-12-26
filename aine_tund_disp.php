<?
	$eh=$_GET["action"];
	$aid=$_GET["aid"];
	$bookid=$_GET["bookid"];
	$parent=$_GET["parent"];
	require_once 'header.php';
	include("tabel_class_iid.php");
	$baas="raamatX";

	if($eh=="save"){
		$valjad=array("nimi_est","naita_veebis", "kokkuv_est","opilane_est","sissej_est","meetod_est","valjund_est","tundide_arv");
		foreach($valjad as $var){
			$rida[$var]=$var."=\"".$db->real_escape_string($_POST[$var])."\"";
		}
	if($eh=="save"and $_POST["nimi_est"]){
		$query="UPDATE ".$baas." SET ".implode(",",$rida)." WHERE id=".$aid;		}
//		echo $query;
//		$result=mysql_query($query);
		$result = $db->query($query);	
	}	
	$query="SELECT * FROM ".$baas." WHERE id=".$aid;
//	echo $query;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?>
<meta charset="utf-8">
<link href="scat.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js"></script>

<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=aine_tund_disp&klass=".$baas."&action=save&aid=".$aid; ?>">

<table width="100%" border="0">
<tr><td width="51%"><input name="nimi_est" type="text" class="pealkiri" value="<? echo $line["nimi_est"]; ?>" size="60" /></td>
  <td width="44%"><input class="button" type="submit" name="Submit2" value="Salvesta" /></td>
  <td colspan="2" align="right"><span class="menu_punane">Tunde:</span></td>
  <td width="2%"><input align="middle" name="tundide_arv" type="text" class="menu_punane" value="<? echo $line["tundide_arv"]; ?>" size="2" /></td>
</tr>
<tr>
  <td colspan="5"><?
				tabel2($baas."_oskus",$aid,$_SESSION["mysession"]["login"],1,1,"Õpieesmärgid - mis peaks tunni lõpuks klaar olema");
	?></td>
  </tr>
<tr>
  <td colspan="5"><span class="navi">
    <?
				tabel2($baas."_".$baas,$aid,$_SESSION["mysession"]["login"],1,1,"Alateemad - materjal peab olema jaotatud alateemadeks, need tekivad siia");
				
//Paneme alateemad nö tallele.

		$query_sub="SELECT * FROM ".$baas."_".$baas." WHERE oid1=".$aid." ORDER BY id";
	$sub=array();
	$sub_nimi=array();
    $result_sub=mysql_query($query_sub);
	while($line_sub=mysql_fetch_array($result_sub))
	{
//		echo $line_sub["oid2"],"  ";
		array_push($sub,$line_sub["oid2"]);	

		$query_sub_nimi="SELECT nimi_est FROM ".$baas." WHERE id=".$line_sub["oid2"];
		$result_sub_nimi=mysql_query($query_sub_nimi);
		$line_sub_nimi=mysql_fetch_array($result_sub_nimi);
		array_push($sub_nimi,$line_sub_nimi["nimi_est"]);	
	} 
			
				
				
	?>
  </span></td>
</tr>
<tr>
  <td colspan="5"><?
				tabel2($baas."_exp",$aid,$_SESSION["mysession"]["login"],1,1,"Motivatsioonipakett - mida jutustada õpilastele huvi äratamiseks",1);
				//echo $baas;
		?></td>
</tr>
 
         <tr>
          <td align="left" valign="top" class="options">TUND (Õppemeetodid/ praktilised tööd ja IKT kasutamine/ hindamine/ õppekeskkond, näitlikustamine):</td>
          </tr>
        <tr>
          <td colspan="2" align="center" valign="top"><textarea class="ckeditor" cols="120" name="meetod_est" rows="50"><? echo $line["meetod_est"];?></textarea></td>
          </tr>

 
 
  <tr>
    <td colspan="5">
  <table width="100%" border="0">
  <?
		for($i=0;$i<count($sub);$i++)
		{?>
      <tr>
        <td width="69%" valign="top"><div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>
        <td width="31%" valign="top"><?
				tabel2($baas."_exp",$sub[$i],$_SESSION["mysession"]["login"],1,1,"Õpiobjektid: ".$sub_nimi[$i]);
				//echo $baas;
		?></td>
        </tr>
      <? }?>
</table>
</td>
  </tr>
 
 
 
 <tr>
    <td colspan="5" valign="top">
      <table width="100%">
        
        
        
</table></td>
    </tr>
  <tr>
  <td colspan="5"><table width="100%" border="0">
      <tr>
        <td ><?
				tabel2($baas."_nupula",$aid,$_SESSION["mysession"]["login"],1,1,"&Uuml;lesanded tunni kui terviku kohta");
	?></td>
    </tr>
      <tr>
        <td class="fields">Test: </td>
      </tr>
      <tr>
          <td class="fields">Alateemade ülesanded:</td>
      </tr>     
		<? for($i=0;$i<count($sub);$i++)
		{ ?>
<tr>
        <td><?
				tabel2($baas."_nupula",$sub[$i],$_SESSION["mysession"]["login"],1,1,$sub_nimi[$i] );
				//echo $baas;
		?></td>
        
      </tr><? }?></table>

  </td>
  </tr>
</table>
</form>







