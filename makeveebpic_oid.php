<?
		include("connect.php");
		include("authsys.php");	
			$oid=$_GET["oid"];	
			$dom=$_GET["domain"];
			$id_pilt=$_GET["id_pilt"];	
			$query="SELECT id,nimi,url FROM ".$dom." WHERE id=".$id_pilt;
			//		  echo $dom;
			$result=mysql_query($query);
			$line=mysql_fetch_array($result); 
			$arr_dom = explode( "_",$dom);
			
			?> <p class="Pealkiri">Tee veebipilt pildile "<? echo $line["nimi"]; ?>"  tabelis <? echo $domain;?></p>
			<?
			$tehtud=0;	
			//			if($_GET["act"]=="upi"){	
			echo "oota ... ";
			$str = urldecode($line["url"]);
			$idpic = $line["id"];
			// lõikan maha faililaiendi ja kirjutan pildi kujul id.laiend kataloogi mis all näha ...
			$arr = split( '[.]',$str, 2);
			if($arr[1] == "jpg" or $arr[1] == "JPG"){
			//teeme veebifailid, ühe pisikese, teise suurema ..
			$arr1 = split( '[/]',$arr[0], 3);
			$url="media/".$domain."_veeb/".$arr1[2].".".$arr[1];
			//												echo "kaido", $url;
			$url_s="media/".$domain."_veeb/".$arr1[2]."s.".$arr[1];
			echo $url, $url_s;				
			$image = $str; // name/location of original image.
			$new_image = $url; // name/location of generated thumbnail.
			$new_image_s = $url_s; // name/location of generated thumbnail.
			
			$src_img = ImageCreateFromJPEG($image); // make 'connection' to image
			
			$quality = 100; //quality of the .jpg
			$src_width = imagesx($src_img); // width original image
			$src_height = imagesy($src_img); // height original image
			
			//thumbnail ...				
			$dest_height = 100; //max height of the thumbnail
			$ar = $src_width / $src_height; // aspect ratio
			$dest_width = $dest_height * $ar; //width thumbnail (image will scale down completely to this width)
			//weeb image ...				
			$dest_height_s = 500; //max height of the thumbnail
			$dest_width_s = $dest_height_s * $ar; //width thumbnail (image will scale down completely to this width)
			
			//				$divX = $src_width / $dest_width; // factor to calculate the scaled down height
							
			$dest_img = imagecreatetruecolor($dest_width,$dest_height); 
			$dest_img_s = imagecreatetruecolor($dest_width_s,$dest_height_s); 
			imagecopyresampled($dest_img, $src_img, 0, 0, 0 ,0, $dest_width, $dest_height, $src_width, $src_height); 
			imagecopyresampled($dest_img_s, $src_img, 0, 0, 0 ,0, $dest_width_s, $dest_height_s, $src_width, $src_height); 
			imagejpeg($dest_img, $new_image, $quality); 
			imagejpeg($dest_img_s, $new_image_s, $quality); 
			imagedestroy($src_img); 
			imagedestroy($dest_img);
			imagedestroy($dest_img_s);
			
			
			// kirjutan andmebaasi vastava kirje ... pildi url/i				
			//				echo $query;				
			}
			//				} 
			?>
			
