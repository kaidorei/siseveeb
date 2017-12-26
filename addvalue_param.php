<?
include("connect.php");
include("authsys.php");	
require_once 'header.php';

if($loginform==1){
	echo "Juurdepääs keelatud!";}
else {
	$tykid_liik_string = "ord,nimi,tahis,vaikev,vaikev_aste,min_v,min_v_aste,max_v,max_v_aste,dim_1,dim_2,dim_3,dim_4,dim_5,dim_6,dim_7,kirjeldus,naita_veebis";
	$oid=$_GET["oid"];	
	$id=$_GET["id"];	


	if($_GET["act"]=="new")
	{	
		$query="INSERT INTO `fyysika_ee`.`exp_param` (`id`, `oid`,`nimi`) VALUES (NULL, '".$oid."', 'Nimetu')";
		echo $query;
		$tmp=mysql_query($query);
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$id=$tmp["last_insert_id()"];
	}
	 elseif($_GET["act"]=="upi" and $_POST["nimi"])
	{
			$tykid_liik=explode(",", $tykid_liik_string);
			foreach($tykid_liik as $var)
			{
				$rida[$var]=$var."='".$db->real_escape_string($_POST[$var])."'";
			}
//				echo $_POST["nimi_est"];
				if($_GET["act"]=="upi" && $_POST["nimi"])
				{
						$query="UPDATE exp_param SET ".implode(",",$rida)." WHERE id=".$id;
						echo $query;
						$result=mysql_query($query);
				}
	}

$query="SELECT * FROM exp_param WHERE id=".$id;
echo $query;
$result=mysql_query($query);
$line=mysql_fetch_array($result);

?>
<script>
function aken(){
window.open('about:blank','uploader','width=450,height=20,top=100,toolbar=no');
return true;
}

function ending(){
	window.opener.location.reload();
	window.close();
}

function ehee(){
		self.opener.ending();
		window.close();
}
</script>

<link href="scat.css" rel="stylesheet" type="text/css">

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  	<tr> 
    	<td width="50" background="image/sinine.gif" class="menu" >V&auml;li</td>
    	<td width="370" background="image/sinine.gif" class="menu">Sisu</td>
  	</tr>
    
	<form name="form1" method="post" action="<? echo $PHP_SELF; ?>?act=upi&oid=<? echo $oid; ?>&id=<? echo $id; ?>" >
<tr background="image/sinine.gif"> 
	<td colspan="2" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>
<tr > 
    <td colspan="1" class="options" >Nimi</td>
    <td colspan="1" class="options" > 
      <input name="nimi" type="text" class="button" size="45" value="<? echo $line["nimi"]?>"></td>
</tr>
<tr >
  <td colspan="1" class="options" >Vaikev&auml;&auml;rtus</td>
  <td colspan="1" class="options" ><input name="vaikev" type="text" class="button" size="20" value="<? echo $line["vaikev"]?>"> 
    *10&#94;
      <input name="vaikev_aste" type="text" class="button" size="3" value="<? echo $line["vaikev_aste"]; ?>"></td>
</tr>
<tr >
  <td colspan="1" class="options" >T&auml;his</td>
  <td colspan="1" class="options" ><input name="tahis" type="text" class="button" size="45" value="<? echo $line["tahis"]?>"></td>
</tr>
<tr >
  <td colspan="1" class="options" >Min v&auml;&auml;rtus</td>
  <td colspan="1" class="options" ><input name="min_v" type="text" class="button" size="20" value="<? echo $line["min_v"]?>"> 
    *10&#94;
      <input name="min_v_aste" type="text" class="button" size="3" value="<? echo $line["min_v_aste"]; ?>"></td>
</tr>
<tr >
  <td colspan="1" class="options" >Max v&auml;&auml;rtus</td>
  <td colspan="1" class="options" ><input name="max_v" type="text" class="button" size="20" value="<? echo $line["max_v"]?>"> 
    *10&#94;
      <input name="max_v_aste" type="text" class="button" size="3" value="<? echo $line["max_v_aste"]; ?>"></td>
</tr>


    

  <tr>
    <td colspan="2"><span class="menu">
      <?
	  
	 for($iii=1; $iii<8; $iii++)
		{
			
			
		 switch ($iii)
	{
		case 1: $txt="m: "; break;
		case 2: $txt="kg: "; break;
		case 3: $txt="s: "; break;
		case 4: $txt="A: "; break;
		case 5: $txt="K: "; break;
		case 6: $txt="mol: "; break;
		case 7: $txt="cd: "; break;
		default: $txt="?"; break;
	}
		
			
			
			
	echo $txt;
			
	?>
		    <select class="fields" name="dim_<? echo $iii;?>"><?
for ($i = -3; $i < 4; $i++)
{
	if($i==$line["dim_".$iii]) { $sel="selected"; } else { $sel="";}
		echo "<option value=\"".$i."\" ".$sel.">".$i."</option>";
}

?>
    
  </select>
	<?
			}
	?>
    </span></td>
    </tr>
<tr align="left" > 
    <td colspan="2" class="menu" >
	<input type="submit" name="suva1" class="button" value="Salvesta" >
	<input type="button" name="suva12" class="button" value="Sulge aken" onClick="ending();"> 
    </td>
</tr>
<!--	<tr>
		<td class="options"> <?  //echo $dom; ?></td>
		<td class="options">
	<input name="userfile" size="45" type="file" class="button">
	<br>
	<span class="menu_punane"><strong>NB faili nimi ei tohi sisaldada t&uuml;hikuid ja t&auml;pit&auml;hti.</strong></span></td>  
</tr>
-->
</form>
</table>
<? } 

?>