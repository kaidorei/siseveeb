<?

	include("connect.php");
	include("globals.php");
	mb_internal_encoding('UTF-8');

	$eh=$_GET["action"];

	$kid=$_GET["kid"];

	$kool_id=$_GET["kool_id"];

	$etendus_id=$_GET["etendus_id"];

	if($eh=="new"){

		$tmp=mysql_query("INSERT INTO kutse (nimi, date) VALUES (\"Kes kutsub?\", \"".date("Y-m-d")."\")");
//		echo $tmp, "uus kutse";
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$kid=$tmp["last_insert_id()"];
		$valjad=array("nimi","aadress", "kontakt1", "tel1","email1","maksab","soov_kuup", "markused", "etendus_id");

		foreach($valjad as $var){

			$rida[$var]=$var."=\"".$_POST[$var]."\"";

		}



			$query="UPDATE kutse SET ".implode(",",$rida)." WHERE id=".$kid." LIMIT 1";

//				echo "SAVE           ", $query;		

			$result=mysql_query($query);











	}	

    $query="SELECT * FROM kutse WHERE id=".$kid;

//	echo $query;

    $result=mysql_query($query);
if($result)
	$line=mysql_fetch_array($result); 

 ?> 

<br>
<? 
if(!$kid)
{
?>
<form name="kool" method="post" action="<? echo $PHP_SELF."?page=kutsed_disp&action=new";?> ">

<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="menu">Kool/asutus:</td> 

            <td class="menu"><input name="nimi" type="text" class="fields" value="<? echo $line["nimi"]; ?>" size="50" >            </td>

          </tr>



          <tr>
            <td class="menu">Aadress:</td> 

            <td class="menu"><input name="aadress" type="text" class="fields" value="<? echo $line["aadress"]; ?>" size="50" ></td>

          </tr>

          <tr>
            <td class="menu">Kontaktisik*:</td> 

            <td class="menu"><input name="kontakt1" type="text" required class="fields" value="<? echo $line["kontakt1"]; ?>" size="50" /></td>

          </tr>

            <tr>
              <td class="menu">Telefon*:</td> 

              <td class="menu"><input name="tel1" type="text" required class="fields" value="<? echo $line["tel1"]; ?>" size="50" /></td>

            </tr>

          <tr>
            <td class="menu">e-mail*:</td> 

            <td class="menu"><input name="email1" type="text" required class="fields" value="<? echo $line["email1"]; ?>" size="50" /></td>

          </tr>

          <tr>
            <td class="menu">Soovitav kuup&auml;ev <span class="fields">(aaaa-kk-pp)</span></td>
            
            <td class="menu"><input name="soov_kuup" type="text" class="fields" value="<? echo $line["soov_kuup"]; ?>" size="50" /></td>
            
          </tr>
          <tr>
            <td colspan="2" class="menu">Kirjuta siia oma ürituse kohta lähemalt*
            :</td>
          </tr>
          <tr>
            <td colspan="2" align="center" class="menu"><textarea  name="markused" cols="80" rows="20" required type="text" value="" ><? echo $line["markused"]; ?> </textarea></td>
            </tr>
          <tr>
            <td class="menu">&nbsp;</td>
            <td class="menu"><input class="button" type="submit" name="Saada" value="SAADA"></td>
          </tr>

            </table>

             





  

 </td>

</table></td>

    </tr>

  </table>

  













</form>

<? } 
else

{
	echo "Tänud kutse eest!";
}?>