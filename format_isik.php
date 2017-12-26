<?
		include("connect.php");


		function make_isik($iid)
		{

			$id_pilt=$_GET["id_pilt"];			//pildi id tabelis ..._pildid


			$query="SELECT * FROM isik WHERE id=".$iid;
			//echo $query."<br>";
			$result=mysql_query($query);
			$line=mysql_fetch_array($result);
			$text = "Telefon: ".$line["mobla"]." <br> E-mail: ".$line["email1"]."";

			$query1="UPDATE exp SET kirjeldus_est = '".$text."' WHERE ext_id=".$iid." AND gpid_demo = 53 LIMIT 1";
			//echo $query1."<br>";
			$result1=mysql_query($query1);

			$query11="UPDATE exp SET nimi_est = '".trim($line["eesnimi"])." ".trim($line["perenimi"])."' WHERE ext_id=".$iid." AND gpid_demo = 53 LIMIT 1";
			//echo $query1."<br>";
			$result11=mysql_query($query11);

			$querys="SELECT * FROM exp WHERE ext_id=".$iid." AND gpid_demo = 53 LIMIT 1";
			//echo $querys."<br>";
			$results=mysql_query($querys);
			$lines=mysql_fetch_array($results);

			if(!$lines["veeb_pilt_url"])
			{
				$query2="UPDATE exp SET veeb_pilt_url = '".$line["veeb_pilt_url"]."', veeb_pilt_url_s = '".$line["veeb_pilt_url_s"]."' WHERE ext_id=".$iid." AND gpid_demo = 53 LIMIT 1";
				//echo $query2."<br>";
				$result2=mysql_query($query2);
			}

return TRUE;
		}
/*		echo "hei";
		make_pic(62301);
*/
?>
