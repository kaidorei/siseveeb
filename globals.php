<? function keyke($string){
		$var=$GLOBALS[_GET];
		//print_r($var);
		$new="";
		unset($var["action"]);
		if(array_key_exists($string,$var)) {
				unset($var[$string]); 
					$tmp=1;
					}
					while(list($var2,$val)=each($var)){
					$new.=$var2."=".$val."&";
					}	
					$new=substr($new,0,strlen($new)-1);			
		if($tmp==1) {	return $_SERVER['PHP_SELF']."?".$new;	
		} else {
			return $_SERVER['PHP_SELF']."?".$new."&".$string."=true";
		} 
}

function timestamp2($timestamp){ 

				   return( substr($timestamp, 0, 4).'-'. substr($timestamp, 5, 2).'-'. substr($timestamp, 8, 2) ); 

				}
function kuud($num){ 
			switch($num)
				{
				case "01":
					$kuu='jaan.';
					break;
				case "02":
					$kuu='veebr.';
					break;
				case "03":
					$kuu='m&auml;rts';
					break;
				case "04":
					$kuu='aprill';
					break;
				case "05":
					$kuu='mai';
					break;
				case "06":
					$kuu='juuni';
					break;
				case "07":
					$kuu='juuli';
					break;
				case "08":
					$kuu='aug.';
					break;
				case "09":
					$kuu='sept.';
					break;
				case "10":
					$kuu='okt.';
					break;
				case "11":
					$kuu='nov.';
					break;
				case "12":
					$kuu='dets.';
					break;
				}
   return($kuu); 
}

// Small hack for the PDF invoice
// Morten Piibeleht, 13.07.2011
function utf_months($month) {
	if($month == 3) return 'märts';
	else return kuud($month);
}


function kuup($d){
$kuu=substr($d,5,2);
$paeva=substr($d,8,2);
$kuul = kuud($kuu, $keel);			
$aasta=substr($d,0,4);
$temp=sprintf("%d. %s %d.a.", $paeva, $kuul,$aasta);
return($temp); 
}

function sql_rida($userid,$queryx,$logisse,$kaja)
{
	//echo $userid, " ",$tabel, " ",$query;
	
	$result=mysql_query($queryx);
	
	
	if($logisse==1)
	{
		$query_logisse="INSERT INTO `fyysika_ee`.`aa_logi` (`userid`, `query`, `time`) VALUES ('".$userid."', \"kaido".$queryx."\", CURRENT_TIMESTAMP);";
		$result_log=mysql_query($query_logisse);
	}
	if($kaja==1)
	{
		echo $queryx;
	}
	return ($result);
}
function sql_val($userid,$query,$logisse,$kaja)
{
	//echo $userid, " ",$tabel, " ",$query;
	
	$result=mysql_query($query);
	$line=mysql_fetch_array($result); 
	
	if($logisse==1)
	{
		$query_logisse="INSERT INTO `fyysika_ee`.`aa_logi` (`userid`, `query`, `time`) VALUES ('".$userid."', \"".$query."\", CURRENT_TIMESTAMP);";
		$result_log=mysql_query($query_logisse);
	}
	if($kaja==1)
	{
		echo $query_logisse;
	}
	return $line;
}
?>
