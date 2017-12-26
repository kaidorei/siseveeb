<?
		include("connect.php");
		include("authsys.php");	
		if($loginform==1) { echo "Juurdepääs keelatud!";}
		else {	
	  $oid=$_GET["oid"];	
	  $dom=$_GET["domain"];
	  $sel=$_GET["sel"];
	  $tehtud=0;	
		if($_GET["act"]=="upi"){	
			echo "uuendan ... ";
			$var=$_POST;
			switch($sel)
			{
				case '1': $query="INSERT INTO ".$dom." (oid1,oid2) VALUES (\"".$oid."\",\"".$_POST["entity"]."\")";
				break;
	
				case '2': $query="INSERT INTO ".$dom." (oid1,oid2) VALUES (\"".$_POST["entity"]."\",\"".$oid."\")";
				break;
			}
//			echo $query,"sel = ", $sel;
			$result=mysql_query($query);
			$tehtud=1;
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
window.open('about:blank','uploader','width=450,height=20,top=100,toolbar=no');
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
<?
$baasid=array("exp_doclist","firma_doc","isik_doc","knowhow_docs","uudis_doc","pacs_doc","tootuba_kasutusjuhend","naitus_doc");
?>
<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&oid=<? echo $oid; ?>&domain=<? echo $dom; ?>&sel=<? echo $sel; ?>" target="uploader" onSubmit="return aken();"> 
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
   	<tr> 
	    
      <td> 
        <?
			$query="SELECT privileegid FROM users_db WHERE username='".$login."'"; 
			$result = mysql_query($query);
			$line=mysql_fetch_row($result);
$i = 0;
while($baasid[$i] != NULL)
{
			$query2="SELECT id,oid,nimi,url FROM ".$baasid[$i];
			$result2=mysql_query($query2);
			$line2=mysql_fetch_array($result2);
			echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\">";
			echo "<tr><td width=\"100%\" background=\"images/sinine.gif\" class=\"menu\">Docs: ".$baasid[$i]."</td>";
			if ($line[0]["privileegid"]==2){
				echo "<td colspan = \"3\"  width=\"10%\" background=\"images/sinine.gif\" class=\"menu\" ></td>";
				if($weeb==1)
				{
					echo "<td width=\"10%\" background=\"images/sinine.gif\" class=\"menu\" ></td>";
				}
			}
			echo "</tr>";
			while($tulem=mysql_fetch_array($result2))
			{
				 echo "<tr><td class=\"fields\">";
				 switch($baasid[$i])
				 {
				 	case "exp_doclist":
						$query3="SELECT id,nimi_est FROM exp WHERE id='".$tulem["oid"]."'"; 
						$result3 = mysql_query($query3);
						$line3=mysql_fetch_array($result3);
						echo "Seade ",$line3["nimi_est"],"->";
						break;
				 	case "naitus_doc":
						$query3="SELECT id,nimi_est FROM naitus WHERE id='".$tulem["oid"]."'"; 
						$result3 = mysql_query($query3);
						$line3=mysql_fetch_array($result3);
						echo "N&auml;itus ",$line3["nimi_est"],"->";
						break;
				 	case "knowhow_docs":
						$query3="SELECT id,nimi_est FROM knowhow WHERE id='".$tulem["oid"]."'"; 
						$result3 = mysql_query($query3);
						$line3=mysql_fetch_array($result3);
						echo "Knowhow ",$line3["nimi_est"],"->";
						break;
				 	case "isik_doc":
						$query3="SELECT id,eesnimi,perenimi, FROM inimesed WHERE id='".$tulem["oid"]."'"; 
						$result3 = mysql_query($query3);
						$line3=mysql_fetch_array($result3);
						echo "Isik ",$line3["eesnimi"]," ",$line3["perenimi"],"->";
						break;
				 	case "firma_doc":
						$query3="SELECT id,nimi FROM firma WHERE id='".$tulem["oid"]."'"; 
						$result3 = mysql_query($query3);
						$line3=mysql_fetch_array($result3);
						echo "Firma ",$line3["nimi"],"->";
						break;
				 	case "uudis_docs":
						$query3="SELECT id,nimi_est FROM uudis WHERE id='".$tulem["oid"]."'"; 
						$result3 = mysql_query($query3);
						$line3=mysql_fetch_array($result3);
						echo "Knowhow ",$line3["nimi_est"],"->";
						break;
				 	case "pacs_doc":
						$query3="SELECT id,nimi_est FROM pacs WHERE id='".$tulem["oid"]."'"; 
						$result3 = mysql_query($query3);
						$line3=mysql_fetch_array($result3);
						echo "PACS ",$line3["nimi_est"],"->";
						break;
				 	case "tootuba_doc":
						$query3="SELECT id,nimi_est FROM tootuba WHERE id='".$tulem["oid"]."'"; 
						$result3 = mysql_query($query3);
						$line3=mysql_fetch_array($result3);
						echo "Töötuba ",$line3["nimi"],"->";
						break;
				 }
				 echo "<a href=\"".urldecode($tulem["url"])."\" target=_blank>".$tulem["nimi"]."</a></td>";
//......................................................................................................................................
				if ($line[0]["privileegid"]==2){
					echo "<td ><input type=\"submit\" class=\"button3\" value=\"+\" onClick=\"window.open('addvalue_oid_mod.php?domain=".$d."&oid=".$oid."&id=".$tulem["id"]."&act=mod','File_upload','toolbar=0,width=440,height=320,status=yes');\" ></td>";
				}
//......................................................................................................................................
				echo "</tr>";
			}				
			  echo	"</table>";
$i++;
}
	?>
         </td>
  </tr>
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
</form>
</table>
<? 
} 
}
?>