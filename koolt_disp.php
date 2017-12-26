<?
	$eh=$_GET["action"];
	$fid=$_GET["fid"];

    $query="SELECT * FROM kool WHERE id=".$fid;
//	echo $query;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
	//echo $line['nimi'];
 ?>
<link href="*" rel="stylesheet" type="text/css" />
 
<br>

<form name="kool" method="post" action="<? echo $PHP_SELF."?page=koolt_disp&action=save&fid=".$fid;?> ">
  <span class="pealkiri"><a href="<? echo $PHP_SELF."?page=kool_disp&fid=".$fid;?>"><? echo $line['nimi']; ?></a>  </span>
  <table width="670" border="0">
    <tr>
      <td width="420" valign="top"><table width="100%" border="0">
 	<tr > 
		    <td background="image/sinine.gif" class="menu">Kooli juurde kinnitatud &otilde;pilased   ... </td>
	      </tr>
        <tr> 
                  <td><p align="left"><?
												include("globals.php");
						include("tabel_class_iid.php");
						include("tabel_class_iid_opetaja.php");
						tabel_opetaja("isik_kool",$fid,$_SESSION["mysession"]["login"],2,1,"nublu");
			?>            
                  </p></td>
          </tr>
      </table><table width="420" border="0" cellpadding="0" cellspacing="2">
          <tr>
      <td width="100%" valign="top">


  

<table width="100%" border="0">
 	<tr > 
		    <td background="image/sinine.gif" class="menu">Koolile v&auml;lja laenatud vahendid ... </td>
	      </tr>
        <tr> 
                  <td><p align="left"><?
						tabel2("kool_vahendid",$fid,$_SESSION["mysession"]["login"],1,1);
			?>            
                  </p></td>
          </tr>
      </table> </td>
</table></td>
      <td width="240" valign="top"><table width="100%" border="0">
 	<tr > 
		    <td background="image/sinine.gif" class="menu">V&otilde;rgustiku teised koolid  ... </td>
	      </tr>
        <tr> 
                  <td><p align="left"><?
						tabel2("kool_kool",$fid,$_SESSION["mysession"]["login"],1,1);
			?>            
                  </p></td>
          </tr>
      </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
   	<tr > 
		    <td background="image/sinine.gif" class="menu">F&uuml;&uuml;sika&otilde;petaja ... </td>
	        <td align="center" background="image/sinine.gif" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&action=new&kool_id=<? echo $line["id"];?>&aine=fyysika" target="_blank">Uus</a></td>
  	</tr>
          <tr background="image/sinine.gif"> 
				<td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
		  </tr><?
			?>  
			<tr>
            	<td colspan="2"><?
						tabel_opetaja("isik_kool",$fid,$_SESSION["mysession"]["login"],2,1,"fyysika");
			?>            </td>
          </tr      
  	><tr > 
		    <td background="image/sinine.gif" class="menu">Keemia&otilde;petaja ... </td>
	        <td align="center" background="image/sinine.gif" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&action=new&kool_id=<? echo $line["id"];?>&aine=keemia" target="_blank">Uus</a></td>
  	</tr>
          <tr background="image/sinine.gif"> 
				<td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
		  </tr>
			<tr>
            	<td colspan="2"><?
						tabel_opetaja("isik_kool",$fid,$_SESSION["mysession"]["login"],2,1,"keemia");
			?>            </td>
          </tr><tr > 
		    <td background="image/sinine.gif" class="menu">Bioloogia&otilde;petaja ... </td>
	        <td align="center" background="image/sinine.gif" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&action=new&kool_id=<? echo $line["id"];?>&aine=bioloogia" target="_blank">Uus</a></td>
  	</tr>
          <tr background="image/sinine.gif"> 
				<td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
		  </tr>
			<tr>
            	<td colspan="2"><?
						tabel_opetaja("isik_kool",$fid,$_SESSION["mysession"]["login"],2,1,"bioloogia");
			?>            </td>
          </tr><tr > 
		    <td background="image/sinine.gif" class="menu">Geograafia&otilde;petaja ... </td>
	        <td align="center" background="image/sinine.gif" class="menu"><a href="http://www.fyysika.ee/omad/index.php?page=isik_disp&action=new&kool_id=<? echo $line["id"];?>&aine=geograafia" target="_blank">Uus</a></td>
  	</tr>
          <tr background="image/sinine.gif"> 
				<td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
		  </tr>
			<tr>
            	<td colspan="2"><?
						tabel_opetaja("isik_kool",$fid,$_SESSION["mysession"]["login"],2,1,"geograafia");
			?>            </td>
          </tr>
          <tr background="image/sinine.gif"> 
				<td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
		  </tr>
			
			<tr>
			  <td colspan="2" >
		      <?
			  	$url_t="image/eesti_v".$line["id"].".jpg";
				$url = "image/eesti_v.jpg"; // name/location of original image.
				
				$src_img = ImageCreateFromJPEG($url); // make 'connection' to image
				
				$quality = 100; //quality of the .jpg
				$src_width = imagesx($src_img); // width original image
				$src_height = imagesy($src_img); // height original image
				
			  	$x=($line["PK"]-373877)*($src_width/(745237-373877));
			  	$y=$src_height - ($line["LK"]-6345722)*($src_height/(6648619-6345722));
//				echo $x," ",$y;
								
				$dest_img = imagecreatetruecolor($src_width,$src_height); 
				
				
				imagecopyresampled($dest_img, $src_img, 0, 0, 0 ,0, $src_width, $src_height, $src_width, $src_height); 

				// allocate some solors
				$white    = imagecolorallocate($dest_img, 0xFF, 0xFF, 0xFF);
				$gray     = imagecolorallocate($dest_img, 0xC0, 0xC0, 0xC0);
				$darkgray = imagecolorallocate($dest_img, 0x90, 0x90, 0x90);
				$navy     = imagecolorallocate($dest_img, 0x00, 0x00, 0x80);
				$darknavy = imagecolorallocate($dest_img, 0x00, 0x00, 0x50);
				$red      = imagecolorallocate($dest_img, 0xFF, 0x00, 0x00);
				$darkred  = imagecolorallocate($dest_img, 0x90, 0x00, 0x00);

				imagefilledarc($dest_img, $x, $y, 10, 10, 0, 360, $red, IMG_ARC_PIE);
				imageellipse($dest_img, $x, $y, 10, 10, $white);
				imagejpeg($dest_img, $url_t, $quality); 
				imagedestroy($src_img); 
				imagedestroy($dest_img);

 if ($url_t) {?> <p><a class="ekraan_link" href="http://www.regio.ee/?op=body&amp;id=24&amp;marker=<? echo $line["PK"]; ?>|<? echo $line["LK"]; ?>|<? echo $line["nimi"]; ?>|symbol_circle_anim" target="_blank"><img src="<? echo $url_t;?>" /></a></p> <? }?></td>
		  </tr>
			<tr>
			  <td colspan="2" class="ekraan_link" >Punane ring t&auml;histab kooli asukohta (kui koordinaadid on olemas) </td>
		  </tr>
	    </table>      </td>
    </tr>
  </table>
</form>

