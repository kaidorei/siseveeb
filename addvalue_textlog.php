<?
include("FCKeditor/fckeditor.php") ;
include("connect.php");
include("authsys.php");	
//include("authsys.php");	
//include("tabel_class_oid.php");

if($loginform==1) { echo "Juurdepääs keelatud!";}
else {	
	  	$oid=$_GET["oid"];	
	  	$dom=$_GET["domain"];
	  	$identify=$_GET["identify"];
		$user=$_GET["user"];
		$tmp=$_GET["valjad"];
		$vaal=explode(",",$tmp);
//..........................................................................................................................................
	  $tehtud=0;	
		if($_GET["act"]=="upi"){	
			echo "uuendan ... ";
			$var1=$_POST;
			$var = array_pop($var1);
			echo $var;
			$vaartus=implode("\",\"",$var1);
			$valjad=$tmp;	
			echo $valjad."<br>".$vaartus."</br>";
			$query="SELECT id FROM isik WHERE username='".$user."'";
			$resa=mysql_query($query);
			$line=mysql_fetch_row($resa);
			$query="INSERT INTO ".$dom." (".$valjad.",".$identify.",user_id) VALUES (\"".$vaartus."\",\"".$oid."\",\"".$line[0]."\")";
			echo $query;
			$result=mysql_query($query);
			$tehtud=1;
		}
	?>

	
<meta charset="utf-8">
<link href="scat.css" rel="stylesheet" type="text/css">
<style type="text/css">

<!--

.back {
	background-color: #FFFFFF;
	border: 2px none #CCCCCC;
}

-->

</style>

<script>

function aken(){
window.open('about:blank','uploader','width=920,height=220,top=100,toolbar=no');
return true;



}
function ending(){
	window.opener.location.reload();
		window.close();
}

function ehee(){
		self.opener.ending();
		window.close();
}

</script>
<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>>
<? if($tehtud!=1) {?>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
      <tr>
        <td width="50" background="image/sinine.gif" class="menu" >V&auml;li</td>
        <td background="image/sinine.gif" class="menu">Sisu</td>
      </tr>
      <form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&user=<? echo $user; ?>&identify=<? echo $identify; ?>&oid=<? echo $oid; ?>&domain=<? echo $dom; ?>&valjad=<? echo $tmp; ?>" target="uploader" onSubmit="return aken();">
        <?
foreach($vaal as $v)
{ ?>
        <tr background="image/sinine.gif">
          <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr>
          <td colspan="1" class="options" ><? 
				switch($v){
		
					case "pealkiri_est":
							echo "&Uuml;rituse nimi";
							break;

					case "annot_est":
							echo "annot EST";
							break;
		
					case "annot_eng":
							echo "annot ENG";
							break;
		
					case "annot_rus":
							echo "annot RUS";
							break;
		
					case "kirjeldus_est":
							echo "Kirjeldus EST";
							break;		
					case "kirjeldus_eng":
							echo "Kirjeldus ENG";
							break;		
					case "kirjeldus_rus":
							echo "Kirjeldus RUS";
							break;		
		
					case "datefrom":
							echo "Millest (kuup&auml;ev)";
							break;
		
					case "dateto":
							echo "Milleni (kuup&auml;ev)";
							break;

					case "date":
							echo "Kuup&auml;ev";
							break;
					case "koht":
							echo "Koht";
							break;
		
					case "kylastusi":
							echo "K&uuml;lastajaid";
							break;
					case "body":
							echo "sisu";
							break;
							
					case "title":
							echo "pealkiri";
							break;
					case "valislink":
							echo "link allikale";
							break;
				}
		
			 ?></td>
          <td class="options" ><? 
			  switch($v){
					case "pealkiri_est":
							echo "<input class=\"fields\" name=\"".$v."\" type=\"text\">";
							break;
					case "kylastusi":
							echo "<input class=\"fields\" name=\"".$v."\" type=\"text\">";
							break;
					case "koht":
							echo "<input class=\"fields\" name=\"".$v."\" type=\"text\">";
							break;
					case "dateto":
							echo "<input class=\"fields\" name=\"".$v."\" type=\"text\" value=\"".date("Y-m-d")."\">";
							break;
		
					case "datefrom":
							echo "<input class=\"fields\" name=\"".$v."\" type=\"text\" value=\"".date("Y-m-d")."\">";
							break;		
		
					case "date":
							echo "<input name=\"".$v."\" type=\"hidden\" value=\"".date("Y-m-d")."\">".date("Y-m-d");
							break;
		
					case "body":
							
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"6\" class=\"fields\"></textarea>";
							break;		 
/*							$ridasid=300;
							$oFCKeditor = new FCKeditor($v) ;
							$oFCKeditor->BasePath = 'FCKeditor/';
							$oFCKeditor->Width  = '100%' ;
							$oFCKeditor->Height = $ridasid ;
							$oFCKeditor->Toolbar = 'Basic' ;
							$oFCKeditor->Create() ;
*/							break;
									 
					case "annot_est":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"2\" class=\"fields\"></textarea>";
							break;		 
					case "annot_eng":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"2\" class=\"fields\"></textarea>";
							break;		 
					case "annot_rus":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"2\" class=\"fields\"></textarea>";
							break;		 
					case "kirjeldus_est":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"4\" class=\"fields\"></textarea>";
							break;		 
					case "kirjeldus_eng":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"4\" class=\"fields\"></textarea>";
							break;		 
					case "kirjeldus_rus":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"4\" class=\"fields\"></textarea>";
							break;		 
					case "title":
							echo "<textarea name=\"".$v."\" cols=\"70\" rows=\"2\" class=\"fields\"></textarea>";
							break;		 
					case "valislink":
							echo "<textarea name=\"".$v."\" cols=\"70\" rows=\"1\" class=\"fields\">http://</textarea>";
							break;		 
	
						}
			?></td>
        </tr>
        <? } ?>
        
        <tr background="image/sinine.gif">
          <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
        </tr>
        <tr align="left" >
          <td colspan="2" class="menu" >&nbsp;</td>
        </tr>
        <tr align="left" >
          <td colspan="2" class="menu" ><input name="button2" type="submit"  class="button" value="Lisa" >
          <input name="button" type="button"  class="button" onClick="window.close();" value="Katkesta"></td>
        </tr>
      </form>
</table>
<? 
} 
}
?>
