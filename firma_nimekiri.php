<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr background="image/sinine.gif"> 
		<td colspan="3"  bgcolor="#FF9900"><img src="image/sinine.gif" width="1" height="2"></td>
	</tr>
  	<tr > 
		    
    <td background="image/sinine.gif" class="menu" width="100%">Firmade nimekiri...</td>
  	</tr>
</table>
        
<table  width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="menu"> 
    <td width="50" > Nimi </td>
    <td width="150" >Aadress</td>
    <td width="150" >email</td>
    <td width="100" >www</td>
    <td width="100" >Telefon</td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <?
$query2="SELECT id,nimi, kirjeldus_est, riik, postiaadress, tel1, fax1, email1, www FROM firma";
$result2=mysql_query($query2);
		while($tulem=mysql_fetch_array($result2)){
					?>
  <tr class="fields"> 
    <td ><strong> 
      <?
					echo $tulem["nimi"];
					?>
      </strong> </td>
    <td ><? echo $tulem["riik"];?></td>
    <td ><? echo $tulem["email1"];?></td>
    <td><? echo $tulem["www"];?></td>
    <td ><? echo $tulem["tel1"];?></td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td class="fields" colspan="5" ><? echo $tulem["kirjeldus_est"];?></td>
  </tr>
  <tr background="image/sinine.gif"> 
    <td colspan="5" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
  </tr>
  <? }?>
</table>
        


