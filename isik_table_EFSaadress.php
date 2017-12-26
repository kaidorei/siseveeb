<link href="scat.css" rel="stylesheet" type="text/css" />
<head>
<STYLE TYPE='text/css'>
P.pagebreakhere {page-break-before: always}
</STYLE>
</head>
<style type="text/css">
<!--
.style2 {font-size: 14px}
-->
</style>
    <?
$count_page=0;
$count_page_tot=0;
	
include("connect.php");

require('kas_on_lubatud_siseveebi.php');

include("globals.php");

$query="SELECT * FROM isik WHERE in_efs=1 AND paberajakiri=1 ORDER BY eesnimi ";
//echo $query;
$result=mysql_query($query);
$edasi=1;
$i=0;
?>


<!--.-->
	<? 
	
	
	while($count_page_tot<50){ 
//		echo $count_page, $edasi;
	if($count_page==0)
	{?>
  <table align="center" width="100%" height="1090" border="0">
	
	<? }
//		echo "edasi", $edasi;
?>

  	<? 
		$line=array();
	 	$temp=array();
	?>
   <tr height="11%"> 
 <? 
 			$iss=0;$ess=0;
 			while($iss<2&&$ess<25)
			{ 
 				$temp[$iss]=mysql_fetch_array($result);
				echo $temp[$i]["perenimi"];
			  	if ($temp[$iss]["adr_too2"]) $aadress=$temp[$iss]["adr_too2"]; else $aadress=$temp[$iss]["adr_kodu"];
			  	if(substr_count($aadress,',')>1)
			  	{
					$line[$iss]=$temp[$iss];
//			  		echo $line[$i]['eesnimi'];
					$iss++; 
			  	}
				$ess++;
			} 
	
	
	
	$i=0;
   while($i<3){ 
				   //if ($line[$i]["adr_too1"]) $aadress=$line[$i]["adr_too1"]; else $aadress=$line[$i]["adr_kodu"];
				?>
     <td width="50%" align="center"><span class="style2">
						</span>
					    <span class="fields_big_b"><? echo $line[$i]["eesnimi"]," ",$line[$i]["perenimi"];?><br /></span>
					    <span class="pealkiri">
			             <br />
					      
                         
       <? 	
				if (($line[$i]["adr_too2"]&&strlen($line[$i]["adr_too2"])>4)||($line[$i]["in_fi"]&&strlen($line[$i]["in_fi"])>4)) 
				echo $line[$i]["adr_too2"];/* echo str_replace(",", "<br>", $line[$i]["adr_too1"]);*/ 
				else /*echo str_replace(",", "<br>",$line[$i]["adr_kodu"]);*/ 
				echo $line[$i]["adr_kodu"];
				
				?>
         </div>
       <span class="style2"></span> </td>
					  <?
					$edasi=$line[$i]["eesnimi"];
					$i++; 
					
					
					
	}
	$i=0;
	?>
</tr>
 
	<? 
	$count_page++;
	$count_page_tot++;
	if ($count_page>7)
	{
	echo "</table>";
	$count_page=0;
	
	?><P CLASS="pagebreakhere">
 <?
	}
	
	} ?>
