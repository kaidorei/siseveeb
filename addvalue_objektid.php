<?
		include("connect.php");
		include("authsys.php");	
		if($loginform==1) { echo "Juurdepääs keelatud!";}
		else {	
	  $id_from=$_GET["id_from"];	
	  $id_to=$_GET["id_to"];	
	  $dom=$_GET["domain"];
	  $sel=$_GET["sel"];
	  $tehtud=0;	
		if($_GET["act"]=="upi"){	
			echo "uuendan ... <br>";
			$var=$_POST;
			
			$query2="SELECT * FROM raamatX_exp where oid1=".$id_from;
//			echo $query2,"<br>";
			$result2=mysql_query($query2);
			while($line2=mysql_fetch_array($result2))
				{
					$nimi="jah".$line2["oid2"];
//					echo $nimi;
//					$jah=$_GET[$nimi];
				if(isset($_POST[$nimi]))
				{
//					echo "trallaööa";
					
					$query="INSERT INTO raamatX_exp (oid1,oid2) VALUES (\"".$id_to."\",\"".$line2["oid2"]."\")";
					echo $query,"<br>";
					$result=mysql_query($query);
				}
				}
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
$baasid=array("raamatX_exp");
?>
<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&id_from=<? echo $id_from;?>&id_to=<? echo $id_to; ?>&domain=<? echo $dom; ?>&sel=<? echo $sel; ?>" target="uploader" onSubmit="return aken();"> 
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
   	<tr> 
	    
      <td> <table width="100%" border="0">
  <tbody>
  
        <?
			$query="SELECT privileegid FROM users_db WHERE username='".$login."'"; 
			$result = mysql_query($query);
			$line=mysql_fetch_row($result);
$i = 0;
while($baasid[$i] != NULL)
{
			echo "Doonoriga liidetud exp objektid:<br>";
			$query2="SELECT * FROM ".$baasid[$i]." where oid1=".$id_from;
//			echo $query2,"<br>";
			$result2=mysql_query($query2);
			while($line2=mysql_fetch_array($result2))
				{
					$query3="SELECT * FROM exp where id=".$line2["oid2"];
					$result3=mysql_query($query3);
					$line3=mysql_fetch_array($result3);
					//kontrollime, kas see on juba olemas, st kas on vaja liita ...
					$query4="SELECT * FROM raamatX_exp where oid1=".$id_to." and oid2=".$line2["oid2"];
					$result4=mysql_query($query4);
   ?><tr>
      <td><? echo $line2["oid2"]; ?></td>
      <td><? echo $line3["nimi_est"] ?></td>
      <td><? 
	  		$olemas ="";
			if($line4=mysql_fetch_array($result4)) 
			{
				echo "OLEMAS!";
			}
			else
			{ 
				$nimi="jah".$line2["oid2"];
//				echo $nimi;
				
				?>
				<input type="checkbox" name="<? echo $nimi;?>" checked >
				<?
			}
			?></td>
 <?

                    ?>    </tr><?

				}
	$i++;
}?>
      </tbody>
</table>
    </td>
  </tr>
<tr background="image/sinine.gif"> 
    <td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"><input type="submit"  class="button" value="Lisa" ></td>
</tr>
</form>
</table>
<? 
} 
}
?>