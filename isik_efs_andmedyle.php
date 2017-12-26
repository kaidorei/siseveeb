<?
include("connect.php");
include("globals.php");

$query="SELECT * FROM isik_efs";
$result=mysql_query($query);


while($line=mysql_fetch_array($result))

{
	$query1="SELECT * FROM isik WHERE perenimi='".$line["perenimi"]."' AND eesnimi='".$line["eesnimi"]."'";
//	echo $query1,"</br>";
	$result1=mysql_query($query1);
	$line1=mysql_fetch_array($result1);
	if($line1)
	{
/*		echo "olemas </br>";
		if(!$line1["teaduskraad"])
		{
		$query2="UPDATE isik SET teaduskraad='".$line["teaduskraad"]."' WHERE id=".$line1["id"]."";
		echo $query2;
		$result2=mysql_query($query2);
		$line2=mysql_fetch_array($result2);
		}
		else
		{
		}
*/		
	}
	else
	{
		echo "</br>";
		
		$query3="INSERT INTO isik (perenimi, eesnimi, username, password, privileegid, teaduskraad, veeb_pilt_url, veeb_pilt_url_s, a_num, isikukood, amet_est, amet_eng, amet_rus, mobla, skype, tel_too, tel_kodu, adr_too1, adr_too2, adr_kodu, email1, email2, in_buss, in_efs, on_fi, on_reisijuht, on_fyysikaopetaja, huvid, markused,  in_veeb, r_alg, b_kat, sammas, diplom, diplom_aasta) VALUES('".$line["perenimi"]."', '".$line["eesnimi"]."', '', '', 0, '".$line["teaduskraad"]."', 'NULL', '', 'NULL', '".$line["isikukood"]."', '".$line["amet_est"]."', '', '', 'NULL', '', '".$line["tel_too"]."', '".$line["tel_kodu"]."', '".$line["adr_too1"]."', '".$line["adr_too2"]."', '".$line["adr_kodu"]."', '".$line["email1"]."', '".$line["email2"]."', 0, 1, 0, 0, 0, 'NULL', 'NULL', 0, 0, 0, 1, '".$line["diplom"]."', '".$line["diplom_aasta"]."')";
echo $query3,"</br>";
		$result3=mysql_query($query3);
		$line3=mysql_fetch_array($result3);
	}
	?></br><?
}

	?>



