<link href="scat.css" rel="stylesheet" type="text/css" />
<head>
<STYLE TYPE='text/css'>
P.pagebreakhere {page-break-before: always}
</STYLE>
</head>
<?
$count_page=0;
$count_page_tot=0;
	
include("connect.php");
require('kas_on_lubatud_siseveebi.php');
include("globals.php");


$query="SELECT * FROM kool WHERE tyyp=1 ORDER BY nimi";
//echo $query;
$result=mysql_query($query);

$edasi=1;
$count_page_tot = 0;
$count_page=0;


//while($count_page_tot<510){ 
while($line=mysql_fetch_array($result)){
//	echo $count_page, $edasi;
	
		if($count_page==0)
		{
//		echo "lehealgus";
		?>
  		<table align="center" width="100%" height="1090"  border="0">
	<? 	}
	
	?>
   <tr height="10%"> 
 <? 

			?>
   	 <td width="50%" align="center">
       	<span class="pealkiri"><? echo $line["nimi"],"</br>";?></span> 
	   	<span class="pealkiri"><em><? echo str_replace(",", "<br>", $line["aadress"]); ?></em></span>	   </td>		
   	 <? $line=mysql_fetch_array($result);?>
    	<td width="50%" align="center">       	
		<span class="pealkiri"><? echo $line["nimi"],"</br>";?></span> 
	   	<span class="pealkiri"><em><? echo str_replace(",", "<br>", $line["aadress"]); ?></em></span>
		</td>			
		<?
		?>
	</tr>
 
	<? 
	$count_page++;
			if ($count_page>7)
			{
			echo "</table>";
			$count_page=0;
			?><P CLASS="pagebreakhere">
			<?
			}
	} ?>
