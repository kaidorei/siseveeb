<?   
		  	  		  $tmp=array();
					  if($openasi){
						foreach($open as $val){
							if($val!=$controll["id"]){ 
								array_push($tmp,$val); 
								}
							}
						} else {
						$tmp=$open;
						array_push($tmp,$line["id"]);
						}
						echo implode(",",$tmp); 
						
?>