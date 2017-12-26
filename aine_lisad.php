<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
 <?
if($priv!=1)
{
?>
 <tr> 
    <td background="image/index_48.gif"> <table border="0" cellpadding="0" cellspacing="0" background="image/menu_taga.gif">
        <tr> 
          <td><img src="image/index_43.gif" width=10 height=18 alt=""></td>
          <td background="image/index_45.gif" class="menu">Lisad</td>
          <td><img src="image/index_47.gif" width=29 height=18 alt=""></td>
        </tr>
 </table></td>
</tr>



<? }?>
<?
?>
	<tr> 
		<td background="image/sinine.gif" class="menu"><img src="image/spacer.gif" width="10" height="10">Foorum/Arendus</td>
	  	</tr>
	  	<tr> 
		<td> 
		  <?
		include("textlog_class.php");
		include("textlog_naitus_class.php");
			$tmp=array("date","body");
			($priv==1) ? ($lisa=0) : ($lisa=1);			
		   log2("aine_alog",(isset($_GET["aine_alogopen"])?0:2),$expid,$_SESSION["mysession"]["login"],implode(",",$tmp), $lisa); ?>
		</td>
  	</tr>

</table>

