<?
		include("FCKeditor/fckeditor.php") ;
		include("connect.php");
		require_once 'header.php';
		if($loginform==1) { echo "Juurdepääs keelatud!";}
		else {	
	  $id=$_GET["id"];	
	  $master=$_POST["master"];	
	  $tehtud=0;	
		if($_GET["act"]=="upi")
		{	
			echo "uuendan ... ";
			$var=$_POST;
			
			$dom2=substr($dom,strpos($dom,"_")+1,strlen($dom));
			
			$query="UPDATE exp SET ... WHERE id=".$id;
				
			$result=mysql_query($query);
//			$tehtud=1;
		}
		?>
<link href="scat.css" rel="stylesheet" type="text/css">

<!--<script>
function aken(){
window.open('about:blank','uploader','width=550, height=220,top=100,toolbar=no');
return true;
}

function ending(){
	window.opener.location.reload();
	window.close();
}

function reload(){
	window.location.reload();
}


function ehee(){
		self.opener.ending();
		window.close();
}
</script>
--><? 

//	echo $dom1." ".$dom2;

//slave
	$query="SELECT * FROM exp WHERE id=".$id;
	$result=mysql_query($query);
	$line=mysql_fetch_array($result); 
//			echo $query;
//master
	$query_m="SELECT * FROM exp WHERE id=".$master;
	$result_m=mysql_query($query_m);
	$line_m=mysql_fetch_array($result_m); 
	

?>
<body>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr> 
    <td width="44%" align="center" background="image/sinine.gif" class="menu" >See v&auml;li ...</td>
    <td background="image/sinine.gif" class="menu">&nbsp;</td>
    <td align="center" background="image/sinine.gif" class="menu">... neelatakse selle v&auml;lja poolt</td>
  </tr>
<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&id=<? echo $id; ?>&domain=<? echo $dom; ?>&sel=<? echo $sel; ?>" > 
<tr background="image/sinine.gif"> 
    <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
   <tr>
    <td></td></tr>    
    <tr background="image/sinine.gif"> 
	  <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
    </tr>
 <tr> 
    <td align="center" class="options" ><? echo $id." (".$line["valem_id"].")";?></td>
    <td width="6%" align="center" valign="middle" class="options" >--&gt;&gt;</td>
    <td width="50%" align="center" valign="middle" class="options" ><input name="master" type="text" value="<? echo $master; ?>" size="10" /></td>
    </tr>
<tr background="image/sinine.gif"> 
    <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
    <tr>
      <td align="center" class="options" ><a href="/omad/index.php?page=exp_disp&expid=<? echo $line["id"];?>" target="_blank"><? echo $line["nimi_est"];?></a></td>
      <td align="center" class="options" >&nbsp;</td>
      <td align="center" class="options" ><a href="/omad/index.php?page=exp_disp&expid=<? echo $line_m["id"];?>" target="_blank"><? echo $line_m["nimi_est"];?></a></td>
    </tr>
<tr background="image/sinine.gif"> 
  <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
    <tr>
     <td align="center" class="options" ><? echo $line["tex"];?></td>
     <td align="center" class="options" >&nbsp;</td>
     <td align="center" class="options" ><? echo $line_m["tex"];?></td>
    </tr>
<tr background="image/sinine.gif"> 
  <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
   <tr background="image/sinine.gif"> 
     <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
   </tr>
  <tr>
     <td align="center" valign="top" class="options" ><img src="media/valem_pildid/<? echo $line["image"];?>" />
</td>
     <td align="center" class="options" >&nbsp;</td>
     <td align="center" class="options" ><img src="media/valem_pildid/<? echo $line_m["image"];?>" /></td>
    </tr>
  <tr background="image/sinine.gif"> 
     <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
   </tr>
   
  
  <tr>
    <td align="center" valign="top" class="options" ><?
	$query_r1="SELECT * FROM raamatX_exp WHERE oid2=".$line["id"];
	$result_r1=mysql_query($query_r1);
  	while($line_r1=mysql_fetch_array($result_r1))
		{
		$query_r11="SELECT nimi_est FROM raamatX WHERE id=".$line_r1["oid1"];
		$result_r11=mysql_query($query_r11);
		$line_r11=mysql_fetch_array($result_r11);

			
			echo "<a href=\"/omad/index.php?page=raamatX_disp&aid=".$line_r1["oid1"]."\" target=\"_blank\">".$line_r1["oid1"]."</a>: ".$line_r11["nimi_est"]." (".$line_r1["id"].")<br>"; ?>
			
			<a href="http://opik.fyysika.ee/index.php/book/section/<? echo $line_r1["oid1"];?>" target="_blank" class="menu_punane"><img src="image/icon_eopik.png" alt="eopikus" height="20" border="0" /></a><br>
			
			<?
		} 
    
    
    ?></td>
    <td align="center" class="options" >1_2</td>
    <td align="center" class="options" ><?
	$query_r2="SELECT * FROM raamatX_exp WHERE oid2=".$line_m["id"];
	$result_r2=mysql_query($query_r2);
  	while($line_r2=mysql_fetch_array($result_r2))
		{
		$query_r21="SELECT nimi_est FROM raamatX WHERE id=".$line_r2["oid1"];
		$result_r21=mysql_query($query_r21);
		$line_r21=mysql_fetch_array($result_r21);

			
			echo "<a href=\"/omad/index.php?page=raamatX_disp&aid=".$line_r2["oid1"]."\" target=\"_blank\">".$line_r2["oid1"]."</a>: ".$line_r21["nimi_est"]." (".$line_r2["id"].")<br>";
			?>
			<a href="http://opik.fyysika.ee/index.php/book/section/<? echo $line_r2["oid1"];?>" target="_blank" class="menu_punane"><img src="image/icon_eopik.png" alt="eopikus" height="20" border="0" /></a><br>
			
			<?
		} 
    
    
    ?></td>
  </tr>
    <tr background="image/sinine.gif"> 
     <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
   </tr>
 
  <tr>
    <td align="center" valign="top" class="options" ><?
	$query_r3="SELECT * FROM raamatX WHERE tekst LIKE '%@{".$line["id"]."}@%' or tekst LIKE '%@{".$line["valem_id"]."}@%'";
	$result_r3=mysql_query($query_r3);
  	while($line_r3=mysql_fetch_array($result_r3))
		{
		$query_r31="SELECT nimi_est FROM raamatX WHERE id=".$line_r3["id"];
		$result_r31=mysql_query($query_r31);
		$line_r31=mysql_fetch_array($result_r31);

			
			echo "<a href=\"/omad/index.php?page=raamatX_disp&aid=".$line_r3["id"]."\" target=\"_blank\">".$line_r3["id"]."</a>: ".$line_r31["nimi_est"]."<br>";
		} 
    
    
    ?></td>
    <td align="center" class="options" >@{}@</td>
    <td align="center" class="options" ><?
	$query_r4="SELECT * FROM raamatX WHERE tekst LIKE '%@{".$line_m["id"]."}@%' or tekst LIKE '%@{".$line_m["valem_id"]."}@%'";
//	echo $query_r4;
	$result_r4=mysql_query($query_r4);
  	while($line_r4=mysql_fetch_array($result_r4))
		{
		$query_r41="SELECT nimi_est FROM raamatX WHERE id=".$line_r4["id"];
		$result_r41=mysql_query($query_r41);
		$line_r41=mysql_fetch_array($result_r41);

			
			echo "<a href=\"/omad/index.php?page=raamatX_disp&aid=".$line_r4["id"]."\" target=\"_blank\">".$line_r4["id"]."</a>: ".$line_r41["nimi_est"]."<br>";
		} 
    
    
    ?></td>
  </tr>
<tr background="image/sinine.gif"> 
    <td colspan="3" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr align="left" > 
    <td colspan="3" class="menu" ><input type="submit" name="suva1" class="button" value="Uuenda" >
      <input type="submit"  class="button" value="Merge" >
      <input type="button"  class="button" value="Katkesta" onClick="window.close();"></td>
  </tr>
  <? 
 	$query_x="SELECT * FROM raamatX_exp WHERE oid2=".$line["id"];
	$result_x=mysql_query($query_x);
  	while($line_x=mysql_fetch_array($result_x))
		{
   ?>
  <tr align="left" >
    <td colspan="3" class="options" ><?
    
	$query_x1="UPDATE raamatX_exp SET oid2= ".$line_m["id"]." WHERE id=".$line_x["id"];
		echo $query_x1."<br>";
//		$result_x1=mysql_query($query_x1);
	
	
	?></td>
  </tr>
    <tr align="left" >
    <td class="options" ><?
		
		$query_x2="select tekst from raamatX where id=".$line_x["oid1"];
		//echo $query_x2."<br>";
		$result_x2=mysql_query($query_x2);
		$line_x2=mysql_fetch_array($result_x2);
		$tekst = $line_x2["tekst"];
		echo $line_x2["tekst"];
		if(strpos ($tekst,"@{".$line["id"]."}@"))
		{
			$tekst_uus = str_replace("@{".$line["id"]."}@","@{".$line_m["id"]."}@",$tekst);
		}
		else
		{
			$tekst_uus = str_replace("@{".$line["valem_id"]."}@","@{".$line_m["id"]."}@",$tekst);
		}
			
?></td>
    <td class="options" >&nbsp;</td>
    <td class="options" ><? echo $tekst_uus;?></td>
  </tr><?			
		} 
    
    
    ?>
</form>
</table>
<? 

}
?>
