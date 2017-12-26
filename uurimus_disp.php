<?
	
	include("FCKeditor/fckeditor.php") ;
	require_once 'header.php';
	$eh=$_GET["action"];
	$uuid=$_GET["uuid"];
	$aid=$_GET["aid"];
	$klass=$_GET["klass"];
	$bookid=$_GET["bookid"];
	include("tabel_class_oid.php");
	include("tabel_class_iid.php");

	if($eh=="new"){
		$tmp=mysql_query("INSERT INTO uurimus (nimi_est) VALUES (\"Nimetu\")");
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$uuid=$tmp["last_insert_id()"];
		
		if($aid and $klass)
		{
			//echo "teeme kohe seose vastava ainevärgiga<br>";
			$query_insert="INSERT INTO ".$klass."_uurimus (oid1,oid2) VALUES (\"".$aid."\",\"".$uuid."\")";
			echo $query_insert;
			$tmp=mysql_query($query_insert);
				
		}
// uus süsteem - raanatX

		if($aid and $bookid)
		{
			//echo "teeme kohe seose vastava ainevärgiga<br>";
			$query_insert="INSERT INTO raamatX_uurimus (oid1,oid2,book_id) VALUES (\"".$aid."\",\"".$uuid."\",\"".$bookid."\")";
			echo $query_insert;
			$tmp=mysql_query($query_insert);
				
		}
//		echo $pid;
		// ------------------------------------------------
	} elseif($eh=="save" and $_POST["nimi_est"]){
		$uuid=$_GET["uuid"];
		$valjad=array("nimi_est","naita_veebis", "autorid", "juhendajad", "konk_aasta", "konk_koht", "klass","koolid","konk_klass");

		foreach($valjad as $var){
			$rida[$var]=$var."='".$db->real_escape_string($_POST[$var])."'";
		$query="UPDATE uurimus SET ".implode(",",$rida)." WHERE id=".$uuid;		}
		$result=mysql_query($query);
//	echo $query;
		}
//	$query="SELECT ".implode(",",$valjad)." FROM pacs WHERE id=".$pid;
	$query="SELECT * FROM uurimus WHERE id=".$uuid;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?>
<script src="ckeditor/ckeditor.js"></script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
 <link href="scat.css" rel="stylesheet" type="text/css" />


<form name="eksponaat" method="post" action="<? echo $PHP_SELF."?page=uurimus_disp&action=save&uuid=".$uuid; ?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="2">
    <tr>
      <td width="100%" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="3" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td width="6%" class="menu">Pealkiri</td>
          <td width="83%" align="left" ><div align="center">
            <input name="nimi_est" type="text" class="fields" value="<? echo $db->real_escape_string($line["nimi_est"]); ?>" size="80" >          
          </div></td>
          <td align="left" >	<? if($priv>=2) {?>
            <input class="button" type="submit" name="Submit" value="Salvesta"><? } ?>	</td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td colspan="4" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr>
          <td width="14%" nowrap="nowrap" class="navi">Koolid:</td>
          <td width="34%" ><input name="koolid" type="text" class="fields" value="<? echo $line["koolid"]; ?>" size="20" ></td>
          <td align="right"  class="navi" nowrap="nowrap">Juhendajad:</td>
          <td width="36%" class="fields" ><input name="juhendajad" type="text" class="fields" value="<? echo $line["juhendajad"]; ?>" size="20" /></td>
          </tr>
        <tr>
          <td colspan="2" nowrap="nowrap" class="navi"><?
				tabel2("kool_uurimus",$uuid,$_SESSION["mysession"]["login"],2,1,"Kool");
	?></td>
          <td colspan="2" align="left" nowrap="nowrap"  class="navi"><?
					tabel2("isik_uurimus",$uuid,$_SESSION["mysession"]["login"],2,1,"Juhendajad");
		?></td>
          </tr>
        <tr>
          <td nowrap="nowrap" class="navi">Autorid:</td>
          <td ><input name="autorid" type="text" class="fields" value="<? echo $line["autorid"]; ?>" size="20" ></td>
          <td align="right"  class="navi" nowrap="nowrap">Klass:</td>
          <td ><span class="fields">
            <input name="konk_klass" type="text" class="fields" value="<? echo $line["konk_klass"]; ?>" size="20" />
            <select name="klass" id="klass" class="fields_left">
              <option value="0" <? if($line["klass"]==0) { echo "selected"; }?>>?</option>
              <option value="1" <? if($line["klass"]==1) { echo "selected"; }?>>5-7</option>
              <option value="2" <? if($line["klass"]==2) { echo "selected"; }?>>8-9</option>
              <option value="3" <? if($line["klass"]==3) { echo "selected"; }?>>10-12</option>
            </select>
          </span></td>
          </tr>
        <tr> 
          <td class="navi" nowrap="nowrap">Esitamise aasta:</td><td ><!--<input name="konk_aasta" type="text" value="<? echo $line["konk_aasta"]; ?>" class="fields" size="5" />-->
            <select name="konk_aasta" id="select" class="fields_left">
              <option value="2014" <? if($line["konk_aasta"]==2014) { echo "selected"; }?>>2014</option>
              <option value="2013" <? if($line["konk_aasta"]==2013) { echo "selected"; }?>>2013</option>
              <option value="2012" <? if($line["konk_aasta"]==2012) { echo "selected"; }?>>2012</option>
              <option value="2011" <? if($line["konk_aasta"]==2011) { echo "selected"; }?>>2011</option>
              <option value="2010" <? if($line["konk_aasta"]==2010) { echo "selected"; }?>>2010</option>
              <option value="2009" <? if($line["konk_aasta"]==2009) { echo "selected"; }?>>2009</option>
              <option value="2008" <? if($line["konk_aasta"]==2008) { echo "selected"; }?>>2008</option>
              <option value="2007" <? if($line["konk_aasta"]==2007) { echo "selected"; }?>>2007</option>
              <option value="2006" <? if($line["konk_aasta"]==2006) { echo "selected"; }?>>2006</option>
              <option value="2005" <? if($line["konk_aasta"]==2005) { echo "selected"; }?>>2005</option>
              <option value="2004" <? if($line["konk_aasta"]==2004) { echo "selected"; }?>>2004</option>
              <option value="2003" <? if($line["konk_aasta"]==2003) { echo "selected"; }?>>2003</option>
              <option value="2002" <? if($line["konk_aasta"]==2002) { echo "selected"; }?>>2002</option>
              <option value="2001" <? if($line["konk_aasta"]==2001) { echo "selected"; }?>>2001</option>
              <option value="2000" <? if($line["konk_aasta"]==2000) { echo "selected"; }?>>2000</option>
              <option value="1999" <? if($line["konk_aasta"]==1999) { echo "selected"; }?>>1999</option>
              <option value="1998" <? if($line["konk_aasta"]==1998) { echo "selected"; }?>>1998</option>
              <option value="1997" <? if($line["konk_aasta"]==1997) { echo "selected"; }?>>1997</option>
              <option value="1996" <? if($line["konk_aasta"]==1996) { echo "selected"; }?>>1996</option>
              <option value="1995" <? if($line["konk_aasta"]==1995) { echo "selected"; }?>>1995</option>
            </select></td>
          <td width="16%" align="right"  class="navi" nowrap="nowrap">Saavutatud koht:</td>
          <td class="fields" ><input class="fields" name="konk_koht" type="text" value="<? echo $line["konk_koht"]; ?>" size="10" /></td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr background="images/sinine.gif"> 
          <td width="95%" colspan="2" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr>
          <td colspan="2" class="menu"><table width="100%" border="0" cellpadding="10">
            <tr>
              <td width="96%" class="options"><? echo $line["annot_est"];?></td>
              <td width="4%" valign="top"><input type="button" class="button3" value="m" onclick="window.open('uurimus_kirj_mod.php?id=<? echo $uuid; ?>&isik_id=<? echo $login_id;?>&isik_nimi=<? echo $login_nimi;?>&vali=annot_est&sel=1','Delete','toolbar=0, scrollbars=1,width=820,height=800,status=yes');" /></td>
              </tr>
            </table></td>
        </tr>
         <tr background="images/sinine.gif"> 
          <td colspan="2" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
        </tr>
       
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr> 
		<td width="49%" valign="top"><?
			tabel("uurimus_docs",$uuid,$_SESSION["mysession"]["login"], 0,"Failid");								
			?></td>
		<td width="51%" valign="top" >
		  <?
	//	echo $tootid;
		tabel("uurimus_pildid",$uuid,$_SESSION["mysession"]["login"], 1,"Pildid");								
		?></td>
	</tr>
   <tr background="images/sinine.gif"> 
	<td colspan="2" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr> 
	<td width="49%"><?
				tabel2("exp_uurimus",$uuid,$_SESSION["mysession"]["login"],2,1,"Mõõtmised");
	?></td>
	        <td width="51%" >&nbsp;</td>
  </tr>
  	<tr background="images/sinine.gif"> 
		<td colspan="2" background="images/sinine.gif"><img src="images/sinine.gif" width="1" height="1"></td>
	</tr>
</table>



	  </td></tr>
  </table>
</form>









