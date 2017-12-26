<? 	
	$count=1;
	$id_0=30000;
	
//require_once 'header.php';
	
include("connect.php");
include("globals.php");


$query="SELECT * FROM exp WHERE nimi_est LIKE '%Vajalikud materjalid%' AND gpid_demo=35 ORDER BY nimi_est";
//echo $query;
$result=mysql_query($query);
?>

<table width="100%">
<?
	while($line=mysql_fetch_array($result))
	{
?>


<tr>
   <td width="1%" valign="top" >
     
     
     <? echo $count;?>.</td>
   <td width="85%" valign="top" ><strong>Nimi:</strong>
     <? 
	echo $line["nimi_est"];	?>
     <br />
 
    <?

	$query_u="delete FROM exp_exp WHERE oid2=". $line["id"]."";
	echo $query_u;
//	$result_u=mysql_query($query_u);
	$query_i="SELECT id, nimi_est FROM exp WHERE id=". $line_u["oid1"]."";
	//echo $query;
//	$result_i=mysql_query($query_i);
	$line_i=mysql_fetch_array($result_i);
	echo $line_i["id"]." ".$line_i["nimi_est"]."<br>";




	$query_v="delete FROM exp_vahendid WHERE oid1=". $line["id"]."";
	echo $query_v;
	//$result_v=mysql_query($query_v);
	 ?>
     </td>
    <td width="138" >
    </td>
  </tr>
<?	
$count++;
}
$query="delete FROM exp WHERE nimi_est LIKE '%Vajalikud materjalid%' and gpid_demo=35";
echo $query;
//$result=mysql_query($query);

	?></table>


