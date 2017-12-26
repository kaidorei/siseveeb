<?
	include("connect.php");
	include("authsys.php");	
	require_once 'header.php';
	$kutse_id=$_GET["kutse_id"];
    $query="SELECT * FROM kutse WHERE id=".$kutse_id;
	//echo $query;
    $result=mysql_query($query);
	$line=mysql_fetch_array($result); 
 ?> 
  <table width="100%" border="0">
  <tr>
    <td><? echo $line["markused"]?></td>
  </tr>
</table>

  
