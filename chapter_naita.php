<head>
<link href="scat.css" rel="stylesheet" type="text/css">
</head>
<? 

include("connect.php");
//require('kas_on_lubatud_siseveebi.php');
include("globals.php");
$chid=$_GET["chid"];
$result = sql_val($userid,"SELECT * FROM `chapter` WHERE id='".$chid."' LIMIT 1",1,0);
?> <body>
 <table width="750" border="0">
  <tr>
    <td colspan="3" class="pealkiri"><? echo $result["nimi_est"];?></td>
   </tr>
   <? if($result["algus_est"]) { ?> 
  <tr>
    <td width="55">&nbsp;</td>
    <td width="385"><? echo $result["algus_est"];?></td>
    <td width="296">&nbsp;</td>
  </tr>
  <? }
$result_tykid = sql_rida($userid,"SELECT * FROM chapter_exp WHERE oid1=".$chid." ORDER BY order1",1,0);
	while($line_tykid=mysql_fetch_array($result_tykid))
	{
		$result_tykk = sql_val($userid,"SELECT * FROM exp WHERE id=".$line_tykid["oid2"]."",1,0);
  ?>
  <tr>
    <td valign="top"><span class="smallbody"><? echo $line_tykid["title1"]; ?></span></td>
    <td><? 
	
	if($line_tykid["sisse1"]) echo $line_tykid["sisse1"]; 
	
switch	($result_tykk["gpid_demo"])
{
	case 2: if($result_tykk["seletus_est"]){ ?><table width="50" border="0" align="right">
			  <tr>
				<td><? echo $result_tykk["seletus_est"];?>
				
			</td>
			  </tr>
			  <tr>
				<td><? if ($result_tykk["kirjeldus_est"]) ?>
				  <em><span class="smallbody"><? echo $result_tykk["kirjeldus_est"];?></span></em></td>
			  </tr>
			</table> <? } break;
	
	
	
	case 5: if ($result_tykk["video_url"]){?><table width="50" border="0" align="right">
			  <tr>
				<td><object width="319" <? if ($line_tykid["height1"]) {?> height="<? echo $line_tykid["height1"]; ?>"  <? }?>>
                  <param name="movie" value="<? echo $result_tykk["video_url"]; ?>" />
                  <param name="wmode" value="transparent" />
                  <embed type="application/x-mplayer2" pluginspage="http://microsoft.com/windows/mediaplayer/en/download/" id="mediaPlayer" name="mediaPlayer" displaysize="4" autosize="-1" bgcolor="darkblue" showcontrols="-1" showtracker="1" showdisplay="0" showstatusbar="0" videoborder3d="-1" src="<? echo $result_tykk["video_url"]; ?>" autostart="True" designtimesp="5311" loop="True" height="285" <? if ($line_tykid["width1"]) {?>width="<? echo $line_tykid["width1"]; ?>" <? }?>> </embed>
              </object>
				
			</td>
			  </tr>
			  <tr>
				<td><? if ($result_tykk["kirjeldus_est"]) ?>
				  <em><span class="smallbody"><? echo $result_tykk["kirjeldus_est"];?></span></em></td>
			  </tr>
			</table>
               
                <? 
				} 
				
	break;
	
	
	
	
	
	case 9: if($result_tykk["veeb_pilt_url"]){
			?><table width="50" border="0" align="right">
			  <tr>
				<td><a href=<? echo urldecode($result_tykk["veeb_pilt_url_s"]); ?>  target=_blank><img src="<? echo urldecode($result_tykk["veeb_pilt_url"]); ?>" <? if ($line_tykid["width1"]) {?>width="<? echo $line_tykid["width1"]; ?>" <? }?> <? if ($line_tykid["height1"]) {?> height="<? echo $line_tykid["height1"]; ?>"  <? }?>border="0" alt="Veebipilt puudub" name="veeb_pilt_url" align="right" style="background-color: #CCCCCC"></a>
				
			</td>
			  </tr>
			  <tr>
				<td><? if ($result_tykk["kirjeldus_est"]) ?>
				  <em><span class="smallbody"><? echo $result_tykk["kirjeldus_est"];?></span></em></td>
			  </tr>
			</table><? }
			
			break;
	default:  break;	
}
	


 if ($line_tykid["sisu1"]) echo $line_tykid["sisu1"]; ?></td>
    <td valign="top" class="smallbody"><? $result_nupud = sql_rida($userid,"SELECT * FROM exp_nupula WHERE oid1=".$line_tykid["oid2"]."",1,0);
	while($line_nupud=mysql_fetch_array($result_nupud))
	{
		$result_nupp = sql_val($userid,"SELECT * FROM nupula WHERE id=".$line_nupud["oid2"]."",1,0); ?>
		Lugu: <a href="index.php?page=nupula_disp&nid=<? echo $line_nupud["oid2"]; ?>"><? echo $result_nupp["nimi_est"];?> </a>
    <?	}?></td>
  </tr>
   <? 	} 
   
   
   if($result["lopp_est"]) { ?> 
  <tr>
    <td width="55">&nbsp;</td>
    <td width="385"><? echo $result["lopp_est"];?></td>
    <td width="296">&nbsp;</td>
  </tr>
  <? }?>
</table>
</body>