<html>

<head>
<title>EFS: korraline veebileht</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1257">
<? include("connect.php");
//require('kas_on_lubatud_siseveebi.php');
include("globals.php");
$vahemik_algus=date("Y-m-d",mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));	
?>
<link href="scat.css" rel="stylesheet" type="text/css">
<body>
  <span class="fields_big">Alates  <? echo $vahemik_algus;
  
  ?></span>
  <table width="100%" border="0">
  <tr>
    <td bgcolor="#FFFF00" class="pealkiri">Pikem lugu: </td>
  </tr>
  <tr>
    <td><?
	
	
	
$query_lugu=" SELECT * FROM uudis WHERE show_page=1 AND liik=3 ORDER BY lupdate DESC LIMIT 5 ";
//echo $query_lugu;
$result_lugu=mysql_query($query_lugu);
while($line_lugu=mysql_fetch_array($result_lugu))
{
	if($line_lugu['lupdate']>$vahemik_algus)
	{
		?>   <strong><a href="<? echo $line_lugu['ext_link']; ?>"><? echo $line_lugu['title'], "</br>"; ?></a></strong><?
		echo $line_lugu['body'], "</br>"; 
	}
}	
	?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFF00" class="pealkiri">Uudised: </td>
  </tr>
  <tr>
    <td><?
$query_uudis=" SELECT * FROM uudis WHERE show_page=1 AND liik=1 OR liik=2 AND eesti_asi=0 ORDER BY lupdate DESC LIMIT 5 ";
//echo $query_lugu;
$result_uudis=mysql_query($query_uudis);
while($line_uudis=mysql_fetch_array($result_uudis))
{
	if($line_uudis['lupdate']>$vahemik_algus)
	{
?>
      <strong><? echo $line_uudis['title'], "</br>"; ?></strong><?
echo $line_uudis['body'], "</br>"; 
	
	}
	
}	
	?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFF00" class="pealkiri">Eesti teadusuudised </td>
  </tr>
  <tr>
    <td><?
$query_uudis=" SELECT * FROM uudis WHERE show_page=1 AND eesti_asi=1 ORDER BY lupdate DESC LIMIT 1 ";
//echo $query_lugu;
$result_uudis=mysql_query($query_uudis);
$line_uudis=mysql_fetch_array($result_uudis);
?>
      <strong><? echo $line_uudis['title'], "</br>"; ?></strong><?
	echo $line_uudis['body'], "</br>"; 
	
	
	
	
	?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFF00" class="pealkiri">BLOGI - toimetaja nurgake, viimane kuu ... al <? echo $vahemik_algus;?> </td>
  </tr>
  <tr>
    <td>
	
	<?
$temp=array();
$temp1=array();
$temp2=array();

$query_blogi = "SELECT * FROM wp_terms WHERE term_id=5";
$result_blogi=mysql_query($query_blogi);
 	while($line_blogi=mysql_fetch_array($result_blogi))
	{
	 	$query_blogi1 = "SELECT * FROM wp_term_relationships WHERE term_taxonomy_id='".$line_blogi["term_id"]."' ORDER BY object_id DESC LIMIT 5";
//		echo $query_blogi1;
		$result_blogi1=mysql_query($query_blogi1);
		while($line_blogi1=mysql_fetch_array($result_blogi1))
		{
					$query_blogi2 ="SELECT * FROM wp_posts WHERE id='".$line_blogi1["object_id"]."' AND post_status='publish' ORDER BY post_date DESC LIMIT 1";
//					echo $query_blogi2;
					$result_blogi2=mysql_query($query_blogi2);
					while($line_blogi2=mysql_fetch_array($result_blogi2))
					{
						$algus=$line_blogi2["post_date"];
//						echo $algus," ja ",date("Y-m-d",mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")))," --- ";
						if($algus>$vahemik_algus)
						{
								$kuu=substr($algus,5,2);
								$paeva=substr($algus,8,2);
								$kuua = kuud($kuu,1);			
								$aasta=substr($algus,0,4);
								$aeg=$paeva.".".$kuu.".".$aasta."";
								?>
			  <strong><? echo $aeg,": ",$line_blogi2["post_title"],"</br>"; ?>      </strong><?
								echo $line_blogi2["post_content"],"</br>";
						}

					}
		}
		}
	
	
	
	?>	</td>
  </tr>
  <tr>
    <td bgcolor="#FFFF00" class="pealkiri">BLOGI - muu huvitav elu-olu, viimane kuu ... al <? echo $vahemik_algus;?> </td>
  </tr>
  <tr>
    <td><?
$temp=array();
$temp1=array();
$temp2=array();

$query_blogi = "SELECT * FROM wp_terms WHERE term_id <> 5";
$result_blogi=mysql_query($query_blogi);
 	while($line_blogi=mysql_fetch_array($result_blogi))
	{
	 	$query_blogi1 = "SELECT * FROM wp_term_relationships WHERE term_taxonomy_id='".$line_blogi["term_id"]."' ORDER BY object_id DESC LIMIT 5";
//		echo $query_blogi1;
		$result_blogi1=mysql_query($query_blogi1);
		while($line_blogi1=mysql_fetch_array($result_blogi1))
		{
					$query_blogi2 ="SELECT * FROM wp_posts WHERE id='".$line_blogi1["object_id"]."' AND post_status='publish' ORDER BY post_date DESC LIMIT 1";
//					echo $query_blogi2;
					$result_blogi2=mysql_query($query_blogi2);
					while($line_blogi2=mysql_fetch_array($result_blogi2))
					{
						$algus=$line_blogi2["post_date"];
//						echo $algus," ja ",date("Y-m-d",mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")))," --- ";
						if($algus>$vahemik_algus)
						{
								$kuu=substr($algus,5,2);
								$paeva=substr($algus,8,2);
								$kuua = kuud($kuu,1);			
								$aasta=substr($algus,0,4);
								$aeg=$paeva.".".$kuu.".".$aasta."";
								?>
      <strong><? echo $aeg,": ",$line_blogi2["post_title"],"</br>"; ?> </strong>
    <?
								echo $line_blogi2["post_content"],"</br>";
						}

					}
		}
		}
	
	
	
	?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFF00" class="pealkiri">Õpiobjektid alates  <? echo $vahemik_algus;?> </td>
  </tr>
  <tr>
    <td><?
		$query_exp=" SELECT * FROM exp_paeva WHERE date<".$vahemik_algus." ORDER BY id DESC LIMIT 5 ";
		echo $query_exp;
		$result_exp=mysql_query($query_exp);
		while($line_exp=mysql_fetch_array($result_exp))
		{
		
		
			$query_exp_sisu=" SELECT * FROM exp WHERE id=".$line_exp['id']."  LIMIT 1";
			echo $query_exp_sisu;
			$result_exp_sisu=mysql_query($query_exp_sisu);
			$line_uudis=mysql_fetch_array($result_uudis);
			?>
			<strong><a href="<? echo $line_exp_sisu['ext_link']; ?>"><? echo $line_exp_sisu['nimi_est'], "</br>"; ?></a></strong><? echo $line_lugu_sisu['kirjeldus_est'], "</br>"; 
		}	
	?></td>
  </tr>
</table>
</body>

</html>
