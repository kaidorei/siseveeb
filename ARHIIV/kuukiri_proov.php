<link rel="Shortcut Icon" href="http://www.fyysika.ee/images/F.ico">
<?
$k_kuu = $_GET["kuu"];
$k_aasta=$_GET["aasta"];

switch ($k_kuu)
{
	case 'jaanuar': $k=1; break;
	case 'veebruar': $k=2; break;
	case 'marts': $k=3; break;
	case 'aprill': $k=4; break;
	case 'mai': $k=5; break;
	case 'juuni': $k=6; break;
	case 'juuli': $k=7; break;
	case 'august': $k=8; break;
	case 'september': $k=9; break;
	case 'oktoober': $k=10; break;
	case 'november': $k=11; break;
	case 'detsember': $k=12; break;
	default: $k=date("m"); break;
}

if (!$k_aasta) {$k_aasta=date("Y");}

//echo $k, " ", $k_aasta;

if($k_kuu && k_aasta)
{
?>
<html>

<head>
<title>EFS kuukiri: <? echo $k_kuu," ",$k_aasta; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1257">
<? include("connect.php");
//require('kas_on_lubatud_siseveebi.php');
include("globals.php");
include("lyhenda_html.php");
$vahemik_algus=date("Y-m-d",mktime(0, 0, 0, $k, 1,   date("Y")));	
$vahemik_lopp=date("Y-m-d",mktime(0, 0, 0, $k+1, 1,   date("Y")));	

?>
<style type="text/css">
<!--
.kiri_vaike {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: rgb(51, 51, 51); 
}
.kiri_pealkiri {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: rgb(98, 100, 105);
}
.kiri {
	font-family: Arial, Helvetica, sans-serif; 
	font-size: 12px; 
	font-weight: 400; 
	color: rgb(76, 76, 76); 
	margin-top: 10px;
	}
.kiri_kuup {	font-family: Arial, Helvetica, sans-serif; 
	color: rgb(76, 76, 76); 
font-size: 16px}
-->
</style>
<body  bgcolor="#eeeeee" text="#000000">
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
    <td width="394" bgcolor="#CCCCCC"><span class="kiri">Eesti F&uuml;&uuml;sika Seltsi kuukiri</span></td>
    <td width="250" align="right" bgcolor="#CCCCCC" class="kiri"><? echo $k_kuu," ",$k_aasta; ?></td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF" class="kiri">
      <table width="100%" border="0" cellpadding="10">
        <tr>
          <td width="76%" class="kiri">      
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
								echo $line_blogi2["post_content"];
						}

	
	
	
	?></td>
          <td width="24%" class="kiri">&nbsp;</td>
        </tr>
      </table>
</td>
    </tr>
  <tr>
    <td colspan="2" class="kiri">     
</td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC" class="kiri_pealkiri">&Uuml;ks m&otilde;te</td>
  </tr>
  <tr>
    <td colspan="2" class="kiri"><table width="100%" border="0" cellpadding="10">
        <tr>
          <td class="kiri"><?

					$query_blogi2 ="SELECT * FROM wp_posts WHERE ID=10165";
//					echo $query_blogi2,"</br></br>";
					$result_blogi2=mysql_query($query_blogi2);
					$line_blogi2=mysql_fetch_array($result_blogi2);
					$algus=$line_blogi2["post_date"];
//					echo $algus," ja ",date("Y-m-d",mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")))," --- ";
					$kuu=substr($algus,5,2);
					$paeva=substr($algus,8,2);
					$kuua = kuud($kuu,1);			
					$aasta=substr($algus,0,4);
					$aeg=$paeva.".".$kuu.".".$aasta."";
					?>
  <strong><? echo $line_blogi2["post_title"],"</br>"; ?> </strong>
  <?
					echo $line_blogi2["post_content"],"</br></br>";
	?></td>
        </tr>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2" bgcolor="#CCCCCC" class="kiri_pealkiri">Vastsed videod, demoeksperimendid, õpiobjektid</td>
  </tr>
  <tr>
    <td colspan="2" class="kiri"><table width="100%" border="0">
      <tr>
<?
		$query_exp=" SELECT * FROM exp_paeva WHERE date>'".$vahemik_algus."' AND date<'".$vahemik_lopp."' ORDER BY id DESC LIMIT 4 ";
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
       <td class="kiri" width="25%" valign="top" align="center"><a href="http://www.fyysika.ee/opik/index.php?tase=asi&idex=<? echo $line_exp['pid'];?>&idse=<? echo $line_exp_kat['id'];?>"><img src="/omad/<? echo urldecode($line_exp_sisu["veeb_pilt_url"]); ?>" alt="d" border="0"></a><br>
          <? echo $line_exp_sisu['nimi_est']; ?></td>
	<?  
		}	
	?>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><!--<table width="100%" border="0">
      <tr>
        <td bgcolor="#CCCCCC" class="kiri_pealkiri">Terminoloogiauuendused</td>
        </tr>
      <tr>
        <td class="kiri"><table width="100%" border="0" cellpadding="10">
        <tr>
          <td class="kiri">Mida viimase kuu jooksul <a href="http://www.fyysika.ee/sonaraamat">www.fyysika.ee/sonaraamat</a>-sse kantud on. </td>
        </tr>
      </table></td>
        </tr>
    </table>--></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0">
      <tr>
        <td bgcolor="#CCCCCC" class="kiri_pealkiri">Meelespea!</td>
        </tr>
      <tr>
        <td class="kiri"><table width="100%" border="0" cellpadding="5">
        <tr>
          <td class="kiri_vaike">Kui Teil on liikmemaks juhtumisi veel tasumata, siis seda on võimalik ka teha pangaülekandega 1120073071, Swedpank. Liikmemaksu suurused on 200 kr. ja pensionäridele/õppuritele 30 kr. Tasumisel märkige kindlasti selgitusse ära, et tegemist on liikmemaksuga. </td>
        </tr>
      </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#eeeeee" class="kiri"><div align="center"><table width="100%" border="0" cellpadding="5">
        <tr>
          <td class="kiri"><div align="center" class="kiri_vaike">Kirjuta meile efs@fyysika.ee. 
            
            Kui te ei soovi enam seda veebiajakirja saada, siis saada palun sellekohane e-mail. <br>
            Meie postiaadress: EFS, Riia 142, 51014 Tartu. </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
</body>

</html>
<? }?>