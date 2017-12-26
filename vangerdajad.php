<?
//print_r($pageparams->pageid);print_r($pageparams->path);

//$viimased=$fys->array_query("SELECT * FROM syndmused WHERE pid=(SELECT id FROM  syndmused WHERE urltitle='kalender' AND pid=0)");

$temp99=array();

for ($i = 0; $i <= 10; $i++) 
{
	$temp2=array();
	$temp3=array();
	$temp4=array();
	$temp5=array();

	$aastaalgus  = date("Y-m-d", mktime (0,0,0,9,1,$i+2004));
	$aastalopp  = date("Y-m-d", mktime (0,0,0,8,31,$i+1+2004));
	$temp99[$i]["algus"]=$i+2004;
	$temp99[$i]["lopp"]=$i+1+2004;
	
	
		$algus="";
		// kammime aastate kaupa ...
		$ar2=$fys->array_query("SELECT * FROM reis WHERE algus >= '".$aastaalgus."' AND lopp <= '".$aastalopp."' AND naita_veeb=1 AND tyyp<3");
		foreach($ar2 as $as)
		{	
			//echo "hoi ";
			$ar3=$fys->array_query("SELECT oid2 FROM reis_isik WHERE oid1=".$as["id"]);
			foreach($ar3 as $ass)
			{
				$vangerdajad=$fys->array_query("SELECT * FROM isik WHERE id=".$ass["oid2"]);
				//echo $vangerdajad[0]["perenimi"]," ";
				if (!in_array($vangerdajad[0]["id"], $temp2))

				{
					array_push($temp2, $vangerdajad[0]["id"]);
					//echo $vangerdajad[0]["id"];
					array_push($temp3, $vangerdajad[0]["eesnimi"]." ".$vangerdajad[0]["perenimi"]);
					if($vangerdajad[0]["veeb_pilt_url"]!=NULL)
							{
							array_push($temp4, "http://www.fyysika.ee/omad/".urldecode($vangerdajad[0]["veeb_pilt_url"])."");
							}
							else
							{
							array_push($temp4, "http://www.fyysika.ee/omad/media/isik_pildid/polepilti.jpg");
							}
					array_push($temp5, "?details=1&index=".$vangerdajad[0]["id"]);
				}

			}
		//	echo $assi;
		}
	$temp99[$i]["id"]=$temp2;
	$temp99[$i]["nimi"]=$temp3;
	$temp99[$i]["pilt"]=$temp4;
	$temp99[$i]["link"]=$temp5;


/*				

	foreach($vangerdajad as $index=>$kirje){
	if($vangerdajad[$index]["veeb_pilt_url"]!=NULL)
			$vangerdajad[$index]["pildilink"]="http://www.fyysika.ee/omad/".urldecode($vangerdajad[$index]["veeb_pilt_url"])."";
			else
			$vangerdajad[$index]["pildilink"]="http://www.fyysika.ee/omad/media/isik_pildid/polepilti.jpg";
			}
			
	foreach($vangerdajad as $index=>$kirje){
			$vangerdajad[$index]["link"]="?details=1&index=".$index;
			}
*///	echo $temp99[$i]["algus"];
}
	$leht->assign("vanksid",$temp99);
// et siis smarty näitab "syndmused", siis omistatakse väärtuseid $viimased-le
	$leht->assign("isikud",$vangerdajad);

//$leht->assign("kuupaev",date("Y-m-d",$time));
$leht->assign("kuupaev","kuul: ".date("Y-m",$time));

if(isset($HTTP_GET_VARS["details"])){

$leht->assign("vant",$HTTP_GET_VARS["index"]);
}else{
$leht->assign("vant",-1);
}
?>