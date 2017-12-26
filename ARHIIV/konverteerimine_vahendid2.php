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

	$query_u="SELECT * FROM exp_exp WHERE oid2=". $line["id"]."";
	//echo $query;
	$result_u=mysql_query($query_u);
	$line_u=mysql_fetch_array($result_u);
	$query_i="SELECT id, nimi_est FROM exp WHERE id=". $line_u["oid1"]."";
	//echo $query;
	$result_i=mysql_query($query_i);
	$line_i=mysql_fetch_array($result_i);
	echo $line_i["id"]." ".$line_i["nimi_est"]."<br>";




	$query_v="SELECT * FROM exp_vahendid WHERE oid1=". $line["id"]."";
	//echo $query;
	$result_v=mysql_query($query_v);
	while($line_v=mysql_fetch_array($result_v))
	{
		
		// vahendile vastav exp objekt
	$query_ii="SELECT id,nimi_est FROM exp WHERE vahend_id=". $line_v["oid2"]."";
	//echo $query;
	$result_ii=mysql_query($query_ii);
	$line_ii=mysql_fetch_array($result_ii);
	echo "Vahend:",$line_v["oid2"]," ",$line_ii["id"]," ",$line_ii["nimi_est"],"<br>";
		
		
		
		//Seoste ülekandmine ...
	$query4 = "INSERT INTO `fyysika_ee`.`exp_exp` (`id`, `oid1`, `oid2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`, `naita_veebis1`, `naita_veebis2`, `order1`, `order2`, `meta1`)
	
	VALUES
	
	(NULL, '".$line_i["id"]."', '".$line_ii["id"]."', '".$line_v["title1"]."', '".$line_v["title2"]."', '".$line_v["sisu1"]."', '".$line_v["sisu2"]."', '', '', '1', '1', '0', '0','0');";
	echo $query4." <br><br>";
//$result4=mysql_query($query4);
	
	}







	 
	 
	 
	 ?>
     
     
     
     
     </td>
    <td width="138" >
    
    
    </td>
  </tr>



	
	
<?	
$count++;
}

	?></table>


