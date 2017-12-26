<?
$k_kuu = $_GET["kuu"];
$k_aasta=$_GET["aasta"];

if($k_kuu && k_aasta)
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="et" lang="et">
<head>
<title>EFS kuukiri: <? echo $k_kuu," ",$k_aasta; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
<link rel="Shortcut Icon" href="http://www.fyysika.ee/images/F.ico" />
<link href="kuukiri.css" rel="stylesheet" type="text/css" />
<? include("connect.php");
include("lyhenda_html.php");
//require('kas_on_lubatud_siseveebi.php');
include("globals.php");
$vahemik_algus=date("Y-m-d",mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));	
?>
<body>
  <table width="656" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2" bgcolor="#eeeeee" class="kiri_pealkiri"><div align="center"><span class="kiri_vaike">Kui sa ei näe seda kirja korrektselt, siis kasuta oma veebisirvikut, selleks kliki <a href="http://www.fyysika.ee/omad/kuukiri.php?aasta=2009&kuu=oktoober">siia</a>. </span></div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF" class="kiri_pealkiri"><div align="right"><img src="image/fyysika_banner.jpg" alt="banner" width="650" height="69"><br>
    </div>
      <div align="right"></div></td>
  </tr>
  <tr>
    <td width="394" bgcolor="#FFFFFF" class="kiri_kuup"><span class="kiri_kuup">Eesti Füüsika Seltsi kuukiri </span></td>
    <td width="250" bgcolor="#FFFFFF" class="kiri_kuup"><div align="right"><span class="kiri_kuup"><? echo $k_kuu," ",$k_aasta; ?></span></div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC" class="kiri_pealkiri">Eessõna ja kalendrijutt </td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF" class="kiri"><p class="kiri">
      <?
$temp=array();
$temp1=array();
$temp2=array();

					$query_blogi2 ="SELECT * FROM  `wp_posts` WHERE  `post_title` LIKE  '%Eesti Füüsika Selts: ".$k_kuu."%'AND post_type='post'LIMIT 0 , 30";
//					echo $query_blogi2;
					$result_blogi2=mysql_query($query_blogi2);
					$line_blogi2=mysql_fetch_array($result_blogi2);
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
      <? // echo $aeg,": ",$line_blogi2["post_title"],"</br>"; ?> 
      <?
								echo $line_blogi2["post_content"],"</br>";
						}

	
	
	
	?>
    </p>
    <p align="right" class="kiri"><a href="http://www.fyysika.ee/teated" class="kiri">Vaata ka FYYSIKA.EE kalendrit</a> </p></td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC" class="kiri_pealkiri">Uudised</td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF" class="kiri"><?
$query_uudis=" SELECT * FROM uudis WHERE show_page=1 AND liik=1 OR liik=2 ORDER BY lupdate DESC LIMIT 5 ";
//echo $query_lugu;
$result_uudis=mysql_query($query_uudis);
while($line_uudis=mysql_fetch_array($result_uudis))
{
	if($line_uudis['lupdate']>$vahemik_algus)
	{
	$bodylimit=350;
?>
      <p><strong><? echo $line_uudis['title'], "</br>"; ?></strong>
        <?
echo lyhenda($line_uudis['body'],$bodylimit); 


	?> 
      </p>
      <p align="right"><a href="http://www.fyysika.ee/uudised/meie?uudis_sisu=<? echo $line_uudis['id']; ?>" class="kiri">Loe edasi...</a></p>
      <?
	}
	
}	
	?>    </td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC" class="kiri_pealkiri">Pikem lugu</td>
  </tr>
  <tr>
    <td colspan="2" class="kiri"><?
	
	
	
$query_lugu=" SELECT * FROM uudis WHERE show_page=1 AND liik=3 ORDER BY lupdate DESC LIMIT 5 ";
//echo $query_lugu;
$result_lugu=mysql_query($query_lugu);
while($line_lugu=mysql_fetch_array($result_lugu))
{
	if($line_lugu['lupdate']>$vahemik_algus)
	{
		?>   <!--<strong><a href="<? //echo $line_lugu['ext_link']; ?>"><? //echo $line_lugu['title'], "</br>"; ?></a></strong>-->
        <?
		$arr = split( '[/]',$line_lugu['ext_link']);
		$query_lugu_1=" SELECT * FROM teadus WHERE urltitle='".$arr['4']."' LIMIT 1";
		//echo $query_lugu_1;
		$result_lugu_1=mysql_query($query_lugu_1);
		$line_lugu_1=mysql_fetch_array($result_lugu_1);
		echo lyhenda($line_lugu_1['body'],2500), "</br>";
		?><p align="right"><a href="<? echo $line_lugu['ext_link']; ?>" class="kiri">Loe edasi...</a> </p><?
	}
}	
	?>      </td>
  </tr>
  
  <tr>
    <td colspan="2" bgcolor="#CCCCCC" class="pealkiri"><span class="kiri_pealkiri">BLOGI - <? echo $k_kuu," ",$k_aasta;?></span> </td>
  </tr>
  <tr>
    <td colspan="2" class="kiri"><?
$temp=array();
$temp1=array();
$temp2=array();

$query_blogi = "SELECT * FROM wp_terms";
$result_blogi=mysql_query($query_blogi);
 	while($line_blogi=mysql_fetch_array($result_blogi))
	{
	 	$query_blogi1 = "SELECT * FROM wp_term_relationships WHERE term_taxonomy_id='".$line_blogi["term_id"]."' ORDER BY object_id DESC LIMIT 5";
//		echo $query_blogi1;
		$result_blogi1=mysql_query($query_blogi1);
		while($line_blogi1=mysql_fetch_array($result_blogi1))
		{
					$query_blogi2 ="SELECT * FROM wp_posts WHERE id='".$line_blogi1["object_id"]."' AND post_status='publish' AND `post_title` NOT LIKE  '%Eesti Füüsika Selts: ".$k_kuu."%' ORDER BY post_date DESC LIMIT 1";
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
								echo $line_blogi2["post_content"],"</br></br>";
						}

					}
		}
		}
	
	
	
	?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC" class="kiri_pealkiri">Vastsed videod, demoeksperimendid, õpiobjektid</td>
  </tr>
  <tr>
    <td colspan="2" class="kiri">	<table width="100%" border="0">
      <tr>
<?
		$query_exp=" SELECT * FROM exp_paeva WHERE date>'".$vahemik_algus."' ORDER BY id DESC LIMIT 4 ";
//		echo $query_exp;
		$result_exp=mysql_query($query_exp);
		while($line_exp=mysql_fetch_array($result_exp))
		{//echo "hei";
		
		
			$query_exp_sisu=" SELECT * FROM exp WHERE id=".$line_exp['pid']."  LIMIT 1";
			//echo $query_exp_sisu;
			$result_exp_sisu=mysql_query($query_exp_sisu);
			$line_exp_sisu=mysql_fetch_array($result_exp_sisu);
			
			$query_exp_kat=" SELECT * FROM aine_exp WHERE oid2=".$line_exp['pid']."  LIMIT 1";
			//echo $query_exp_sisu;
			$result_exp_kat=mysql_query($query_exp_kat);
			$line_exp_kat=mysql_fetch_array($result_exp_kat);
			
			
			
			?>
       <td class="kiri" width="25%" valign="top"><a href="http://www.fyysika.ee/opik/index.php?tase=asi&idex=<? echo $line_exp['pid'];?>&idse=<? echo $line_exp_kat['id'];?>"><img src="/omad/<? echo urldecode($line_exp_sisu["veeb_pilt_url"]); ?>" alt="d" border="0"></a><br>
          <? echo $line_exp_sisu['nimi_est']; ?></td>
	<?  
		}	
	?>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0">
      <tr>
        <td bgcolor="#CCCCCC" class="kiri_pealkiri">Meelespea!</td>
        </tr>
      <tr>
        <td class="kiri">Kui Teil on liikmemaks juhtumisi veel tasumata, siis seda on võimalik ka teha pangaülekandega 1120073071, Swedpank. Liikmemaksu suurused on 200 kr. ja pensionäridele/õppuritele 30 kr. Tasumisel märkige kindlasti selgitusse ära, et tegemist on liikmemaksuga. </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#eeeeee" class="kiri"><div align="center">Kirjuta meile efs@fyysika.ee. 
      
      Kui te ei soovi enam seda veebiajakirja saada, siis saada palun sellekohane e-mail.
      
      <br>
    Meie postiaadress: EFS, Riia 142, 51014 Tartu. </div></td>
  </tr>
</table>
</body>

</html>
<? }?>