<?	
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
	require_once 'header.php';


$query="SELECT * FROM exp WHERE (gpid_demo=34 or gpid_demo=21) and `probleem_est` LIKE '%ext{%' and id=12506 ORDER BY id LIMIT 50";
echo $query;
$result=mysql_query($query);
?>

<table width="100%">


<?

	while($line=mysql_fetch_array($result))
	{
?>


<tr>
     <td width="85%" valign="top" >
     <? 
	 
		//asendan  ...
		$tykid_uus = NULL;
		$tykid_vv=explode("ext{", $line["probleem_est"]);
		$tykid_uus=$tykid_vv[0];
		echo "VANA: ",$line["probleem_est"],"<br>";
		$uus=$tykid_vv[0];
		for($ii = 1; $ii < sizeof($tykid_vv); ++$ii)
		{
			echo $line["id"],": ",$tykid_vv[$ii],"<br>";
			$tykid_vvv=explode("}", $tykid_vv[$ii]);
			echo "1: ",$tykid_vvv[0],"<br>";
			echo "2: ",trim($tykid_vvv[1],'{'),"<br>";
			$uus = $uus."\\text{".$tykid_vvv[0]."}\\,\\text{".trim($tykid_vvv[1],'{')."}".$tykid_vvv[2]."".$tykid_vvv[3]."";
		}
		echo "UUS: ",$uus,"<br><br>";
		$query_vv="UPDATE exp SET probleem_est='".$db->real_escape_string($uus)."' WHERE id=".$line["id"];
//		$result_vv=mysql_query($query_vv);

		echo "<br>",$query_vv;
 	 ?>
     </td>
  </tr>
<?	
}

	?></table>


