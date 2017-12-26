<?
		include("connect.php");


		function make_pic($exp_id)
		{
		
			$id_pilt=$_GET["id_pilt"];			//pildi id tabelis ..._pildid


			$mis_nurk=5;
			$kylg=1;
			$t_height=262;
			$t_width=300;
			$suurendus=1;
			$t_height_s = round($t_height * 3.125,0);
			$t_width_s = round($t_width * 3.125,0);

			$query="SELECT * FROM exp_pildid WHERE oid=".$exp_id;
//			echo $query."<br>";
			$result=mysql_query($query);

			while($line=mysql_fetch_array($result))
			{ 
				$str = urldecode($line["url"]);
				$image = $str; 					// name/location of original image.
//				echo $image."<br>";

// lõikan maha faililaiendi ja kirjutan pildi kujul id.laiend kataloogi mis all näha ...
				$arr = split( '[.]',$str, 2);

//echo $arr[1];			

			

//teeme veebifailid, ühe pisikese, teise suurema ...

				$url="media/exp_pildid/".$exp_id."_".$line["id"].".jpg";
				$url_s="media/exp_pildid/".$exp_id."_".$line["id"]."s.jpg";
				$url_png="media/exp_pildid/".$exp_id."_".$line["id"].".png";
				$url_s_png="media/exp_pildid/".$exp_id."_".$line["id"]."s.png";
				$new_image = $url; // name/location of generated thumbnail.
				$new_image_s = $url_s; // name/location of generated thumbnail.
				$new_image_png = $url_png; // name/location of generated thumbnail.
				$new_image_s_png = $url_s_png; // name/location of generated thumbnail.
				
//				echo $url_s."<br>";
	
				$quality = 70; //quality of the .jpg

				switch($arr[1])
	
				{
					case "jpeg":
					case "JPEG":
					case "JPG":
					case "jpg": $src_img = imagecreatefromjpeg($image); 				
					break;
	
					case "PNG":
					case "png": $src_img = imagecreatefrompng($image); 
					break;
				}
	
				$src_width = imagesx($src_img); // width original image
				$src_height = imagesy($src_img); // height original image
				
				$dest_height = $t_height; // vaikimisi väärtus aktiivse algpildi ala kõrgusele
				$dest_width = $t_width; // vaikimisi väärtus aktiivse algpildi ala laiusele

// määrame, kas pilt on kõrge või lai

				$src_aspect_ratio=$src_width/$src_height;
				
				$dest_aspect_ratio=$dest_width/$dest_height;
				if($dest_aspect_ratio>$src_aspect_ratio)
				{// kõrge pilt
					$kylg = 2;
				}
				else
				{// lai pilt
					$kylg = 1;
				}
				
				$src_x=0; 
				$src_y=0; 
				
			
				switch ($kylg)
			
				{
					case 1:	// Kui mängu läheb max laius ... siis saab kohe paika panna allika x-algpunkti ja laiuse
						$dest_x=0;
						$dest_x_s=0; 
						$dest_width = $t_width; 
						$dest_width_s = $t_width_s;	
						$dest_height = $t_height/$src_aspect_ratio; 
						$dest_height_s =  $t_height_s/$src_aspect_ratio;
						$dest_y=($t_height-$dest_height)/2; 
						$dest_y_s=($t_height_s-$dest_height_s)/2;
					break;
			
					case 2:	// Kui mängu läheb max kõrgus ... siis saab kohe paika panna allika y-alguspunkti ja laiuse
						$dest_y=0; 
						$dest_y_s=0;
						$dest_height = $t_height; 
						$dest_height_s =  $t_height_s;
						$dest_width = $t_width*$src_aspect_ratio; 
						$dest_width_s = $t_width_s*$src_aspect_ratio;	
						$dest_x=($t_width-$dest_width)/2;
						$dest_x_s=($t_width_s-$dest_width_s)/2; 
				break;
			}
				
//	echo "Nurk ",$mis_nurk,", allika l&k ",$src_width, " ja  ", $src_height, ", tulemuse l&k ",$dest_width, " ja  ", $dest_height,", tulemus_s l&k ",$dest_width_s, " ja  ", $dest_height_s,", külje valik: ", $kylg;
				
					$dest_img = imagecreatetruecolor($t_width,$t_height); 
					$dest_img_s = imagecreatetruecolor($t_width_s,$t_height_s); 
					
					$white = imagecolorallocate($dest_img, 255, 255, 255);
					$white_s = imagecolorallocate($dest_img_s, 255, 255, 255);

					imagefill($dest_img, 0, 0, $white);
					imagefill($dest_img_s, 0, 0, $white_s);



// Teeme väikese pöidlapildi...

					imagecopyresampled($dest_img, $src_img, $dest_x, $dest_y, $src_x ,$src_y, $dest_width, $dest_height, $src_width, $src_height); 

// Teeme suure pöidlapildi ...

					imagecopyresampled($dest_img_s, $src_img, $dest_x_s, $dest_y_s, $src_x ,$src_y,  $dest_width_s, $dest_height_s, $src_width, $src_height);

// Kirjutame faili

					imagejpeg($dest_img, $new_image, $quality); 
					imagejpeg($dest_img_s, $new_image_s, $quality); 

//					echo  $new_image_s, $new_image,"<br>";

// puhver kinni ...

					imagedestroy($dest_img);
					imagedestroy($dest_img_s);

// kirjutan andmebaasi vastava kirje ... pildi url/i				

					$query="UPDATE exp SET veeb_pilt_url='".urlencode($url)."' , veeb_pilt_w=0 , veeb_pilt_h=0 WHERE id=".$exp_id;
	//				echo $query."<br>";
					$result=mysql_query($query);
					
					$query="UPDATE exp SET veeb_pilt_url_s='".urlencode($url_s)."' WHERE id=".$exp_id;
//					echo $query."<br>";
					$result=mysql_query($query);

// kirjutan pisipildi ka XX_pildid tabelisse.

					$query="UPDATE exp_pildid SET veeb_pilt_url='".urlencode($url)."' WHERE id=".$line["id"];
					//echo $query."<br>";
					$result=mysql_query($query);
					
					$query="UPDATE exp_pildid SET veeb_pilt_url_s='".urlencode($url_s)."' WHERE id=".$line["id"];
					//echo $query."<br>";
					$result=mysql_query($query);

					imagedestroy($src_img); 
		}

return TRUE;
		}
/*		echo "hei";
		make_pic(62301);
*/
?>