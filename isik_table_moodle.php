<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "kaido", "biefeldt")
     	or die("Could not connect");
    // print "Connected successfully";
    mysql_select_db("moodle") or die("Could not select database"); 
?><link href="scat.css" rel="stylesheet" type="text/css" />
<br>
<?
	$action=$_GET["action"];
	$liik=$_GET["liik"];
	$efs=$_GET["efs"];
	$count=1;

	
$query="";
?>
<span class="pealkiri"> Enda pildid füüsikute moodle'isse sisestanud isikud ...</span>
<?
		$query="SELECT * FROM mdl_user WHERE picture=1";
	// kui on vaikimisi k6ik valitud, 						

	$result=mysql_query($query);
//	echo $query;
//esimene tabeli rida annab kategooria nime ...	
	?>

			
<table width="100%" border="0" cellspacing="0" cellpadding="0">		<?

		while($line=mysql_fetch_array($result)){
		
			?>
	        <tr background="image/sinine.gif"> 
          	<td colspan="8" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
	        </tr>
 	       <tr> 
		   <td width="3%" class="navi"><? echo $count,".";?><img border=0 src="image/spacer.gif" width="10" height="10"></td>
	       <td  width="40%" class="menu" nowrap><? echo $line["firstname"]." ".$line["lastname"]; ?></td>
           <td  width="9%" class="navi" nowrap><? if ($line["email"]) { ?><a href="mailto:<? echo $line["email"]; ?>" class="navi" ><? echo $line["email"]; ?></a><? } ?></td>
           <td  width="10%" class="menu" nowrap align="center"><? echo $line["mobla"]; ?></td>
           <td  width="9%" class="navi" nowrap> <? if($line["b_kat"]){?>
             B             <? }?> </td>
           <td  width="11%" class="menu" nowrap><a href="skype:<? echo $line["skype"]; ?>?chat"><?php if ($line["skype"]) {?><img src='http://mystatus.skype.com/mediumicon/<? echo $line["skype"]; ?>' style="border: none;" alt="Proovi helistada!" /></a><?php }?>
<!--see va pildi küsimine Skype'ist annab exploreris ühe tulemuse, Mozillas teise, õige  ...--></td>
           <td width="9%" valign="middle"> <img width="50" border="0" src="https://www.fi.tartu.ee/moodle/user/pix.php/<? echo $line["id"];?>/f1.jpg" alt="x" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC">    </td>
		   <td width="9%" nowrap class="smallbody"><?  //echo "https://www.fi.tartu.ee/moodle/user/pix.php/".$line["id"]."/f1.jpg"; ?></td>
	       </tr>
	<?
	$count++;
	}	// ------------- peagrupi exponaat -----------
?>
</table>
