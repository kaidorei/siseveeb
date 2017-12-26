<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "kaido", "biefeldt")
     	or die("Could not connect");
    // print "Connected successfully";
    mysql_select_db("moodle_nina") or die("Could not select database"); 
?><link href="scat.css" rel="stylesheet" type="text/css" />
<br>
<?
	$count=1;
	$count_tunnistus=1;

$query="";
?>
<?
	$query="SELECT * FROM mdl_course WHERE id>24";
	$result=mysql_query($query);
//	echo $query;
//esimene tabeli rida annab kategooria nime ...	
	?>

			
<table width="100%" border="0" cellspacing="0" cellpadding="0">		<?

		while($line=mysql_fetch_array($result)){
			
$context_id = 0;
$range_g="";
switch($line["id"]) {
	case 25:
		$context_id=8526;
		$range_g=" itemid>168 AND itemid<178";//FPK
		break;
	case 26:
		$context_id=8605;
		$range_g=" itemid>177 AND itemid<186"; //FG
		break;
	case 27:
		$context_id=8620;
		$range_g=" itemid>186 AND itemid<195"; //K
		break;
	case 28:
		$context_id=8651;
		$range_g=" itemid>195 AND itemid<204";// B
		break;
}
		// vaatame, kas selline inimene on juba olemas
		
		$query_ryhmad="SELECT * FROM mdl_groups WHERE courseid=".$line["id"];

//	echo $query;
	$result_ryhmad=mysql_query($query_ryhmad);	
			
		while($line_ryhmad=mysql_fetch_array($result_ryhmad)){
			
	$query_m="SELECT * FROM mdl_groups_members WHERE groupid=".$line_ryhmad["id"];
		$result_m=mysql_query($query_m);
		while($line_m=mysql_fetch_array($result_m)){
			
		$query_r="SELECT * FROM mdl_role_assignments WHERE userid=".$line_m["userid"]." AND contextid=".$context_id;
		$result_r=mysql_query($query_r);
		$line_r=mysql_fetch_array($result_r);
		if (1) // õpilased=5
		{
			?>
 	       <tr> 
		   <td width="4%" class="navi"><? echo $count,".";?></td>
	       <td  width="18%" class="fields_left" nowrap><?
		   $line_isik=mysql_fetch_array($result_isik);
		    echo $line["fullname"]; ?></td>
           <td  width="16%" class="navi" nowrap><? echo $line_ryhmad["name"]; ?></td>
           <td  width="16%" class="menu" nowrap align="left"><?
		   
		$query_u="SELECT * FROM mdl_user WHERE id=".$line_m["userid"];
		$result_u=mysql_query($query_u);
		$line_u=mysql_fetch_array($result_u);
		   
		   
		   
		    echo $line_u["firstname"]." ".$line_u["lastname"]; ?></td>
           <td  width="16%" class="menu" nowrap align="left"><?  echo $line_u["email"]; ?></td>
           
           
          
		   <td width="14%" nowrap class="smallbody"><? 
		   
		   
		$query_k="SELECT * FROM mdl_user_info_data WHERE fieldid=38 AND userid=".$line_m["userid"];
		$result_k=mysql_query($query_k);
		$line_k=mysql_fetch_array($result_k);
		   echo $line_k["data"]?></td><td width="8%" nowrap class="smallbody"><? 
		   
		   
		$query_o="SELECT SUM(finalgrade) FROM `mdl_grade_grades` WHERE userid=".$line_m["userid"]." AND ".$range_g;
		$result_o=mysql_query($query_o);
		$line_o=mysql_fetch_array($result_o);
		   echo $line_o[0]; //echo $query_o;?></td>
		   <td width="8%" nowrap class="smallbody"><? if ($line_o[0]>2) {echo "+".$count_tunnistus; $count_tunnistus++;}?></td>
	       </tr>
	<? 
// lisa uus tegelane tõendite andmebaasi

		$query_t="INSERT INTO `moodle_nina`.`mdl_user_toendid_13` (`id`, `username`, `firstname`, `lastname`, `email`, `skype`, `phone1`, `phone2`, `institution`, `department`, `address`, `city`, `country`, `course`, `group`, `count`) VALUES (NULL, 'usern', '".$line_u["firstname"]."', '".$line_u["lastname"]."', '".$line_u["email"]."', '', '', '', '".$line_k["data"]."', '', '', '', 'EE', '".$line["fullname"]."', '".$line_ryhmad["name"]."', '".$line_o[0]."')";
//		echo $query_t; 
//		$result_t=mysql_query($query_t);

	$count++;
	}
		}}}	// ------------- peagrupi exponaat -----------
?>
</table>
