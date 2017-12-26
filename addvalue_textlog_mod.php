<?
include("connect.php");
include("authsys.php");	

if($loginform==1) { echo "Juurdepääs keelatud!";}
else {	
	  	$id=$_GET["id"];	
	  	$dom=$_GET["domain"];
	  	$identify=$_GET["identify"];
		$user=$_GET["user"];
		$tmp=$_GET["valjad"];
		$vaal=explode(",",$tmp);
//..........................................................................................................................................
	  $tehtud=0;	
		if($_GET["act"]=="upi"){	
			$var=$_POST;
//			echo $var[0];
			$vaartus=implode("\",\"",$var);
			$valjad=$tmp;	
			echo $valjad."<br>";
			$query="SELECT id FROM users_db WHERE username='".$user."'";
			$resa=mysql_query($query);
			$line=mysql_fetch_row($resa);
//			$query="UPDATE ".$dom." (".$valjad.",user_id) SET (\"".$vaartus."\",\"".$line[0]."\") WHERE id=".$id;
			$result=mysql_query($query);

			$valjad=array("pealkiri_est","annot_est","annot_rus","annot_eng","kylastusi","koht","datefrom","dateto", "kirjeldus_est", "kirjeldus_eng", "kirjeldus_rus");
			foreach($valjad as $var){
				$rida[$var]=$var."='".$_POST[$var]."'";
				}
			$query="UPDATE ".$dom." SET ".implode(",",$rida)." WHERE id=".$id;
				echo $query;
			$result=mysql_query($query);


		}
	?>

	

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
<? if($tehtud!=1) {?><table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr> 

    <td width="50" background="image/sinine.gif" class="menu" >V&auml;li</td>
    <td background="image/sinine.gif" class="menu">Sisu</td>

  </tr>

<?
	$valjad=array("pealkiri_est","annot_est","annot_rus","annot_eng","kylastusi","koht","datefrom","dateto", "kirjeldus_est", "kirjeldus_eng", "kirjeldus_rus");
    $query="SELECT ".implode(",",$valjad)." FROM ".$domain." WHERE id=".$id;
	echo $query;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
?>

<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&user=<? echo $user; ?>&identify=<? echo $identify; ?>&id=<? echo $id; ?>&domain=<? echo $dom; ?>&valjad=<? echo $tmp; ?>" target="uploader" onSubmit="return aken();"> 
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
							echo "Külastajaid";
							break;
					case "body":
							echo "sisu";
							break;
							
					case "fotod":
							echo "fotod";
							break;
				}
		
			 ?></td>
			
      <td colspan="1" class="options" > 
        <? 
			  switch($v){
					case "pealkiri_est":
							echo "<input class=\"fields\" name=\"".$v."\" type=\"text\"value=\"".$line["pealkiri_est"]."\">";
							break;
					case "kylastusi":
							echo "<input class=\"fields\" name=\"".$v."\" type=\"text\"value=\"".$line["kylastusi"]."\">";
							break;
					case "koht":
							echo "<input class=\"fields\" name=\"".$v."\" type=\"text\"value=\"".$line["koht"]."\">";
							break;
					case "dateto":
							echo "<input class=\"fields\" name=\"".$v."\" type=\"text\" value=\"".$line["dateto"]."\">";
							break;
		
					case "datefrom":
							echo "<input class=\"fields\" name=\"".$v."\" type=\"text\" value=\"".$line["datefrom"]."\">";
							break;		
		
					case "date":
							echo "<input name=\"".$v."\" type=\"hidden\" value=\"".date("Y-m-d")."\">".date("Y-m-d");
							break;
		
					case "body":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"2\" class=\"fields\">".$line["body"]."</textarea>";
							break;
									 
					case "annot_est":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"2\" class=\"fields\">".$line["annot_est"]."</textarea>";
							break;		 
					case "annot_eng":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"2\" class=\"fields\">".$line["annot_eng"]."</textarea>";
							break;		 
					case "annot_rus":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"2\" class=\"fields\">".$line["annot_rus"]."</textarea>";
							break;		 
					case "kirjeldus_est":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"4\" class=\"fields\">".$line["kirjeldus_est"]."</textarea>";
							break;		 
					case "kirjeldus_eng":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"4\" class=\"fields\">".$line["kirjeldus_eng"]."</textarea>";
							break;		 
					case "kirjeldus_rus":
							echo "<textarea name=\"".$v."\" cols=\"55\" rows=\"4\" class=\"fields\">".$line["kirjeldus_rus"]."</textarea>";
							break;		 
	
						}
			?>
        </td>
		  </tr>

<? } ?>

  </tr> <tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>

  <tr align="left" > 
      <td colspan="2" class="menu" > <input name="submit" type="submit"  class="button" value="Muuda" >
        <input type="button"  class="button" value="Katkesta" onClick="window.close();"> 
    </td>

  </tr></form>
</table>
<? 
} 
}
?>