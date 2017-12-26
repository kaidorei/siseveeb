<script>
function muuda_st(log_id)
{
	var mylist=document.getElementById("list_st_" + log_id).value;
//	document.getElementById("favorite").value=exp_id + " ja " + mylist;
	  
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	
	
//	xmlhttp.open("POST","demo_post.asp",true);
//	xmlhttp.send();

	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("favorite").value=xmlhttp.responseText;
		}
		
	  }
	
	xmlhttp.open("GET","textlog_class_asp.php?log_id="+log_id+"&value="+mylist,true);
	xmlhttp.send();	//mylist.options[mylist.selectedIndex].text;

}
</script>
<?  
function log2($domain,$extent,$oid,$login,$fields){
			if($extent>0){
					$limit="LIMIT ".$extent;
			} else { $limit="";} ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td colspan="2" class="fields"> <?
			$query="SELECT * FROM ".$domain." WHERE oid=".$oid." ORDER BY id DESC ".$limit;
//			echo $query;
			$result=mysql_query($query);
			while($var=mysql_fetch_array($result)){ //$var=$line;
				//	print_r($var);
					$query2="SELECT eesnimi,perenimi FROM isik WHERE id=".$var["user_id"];
					$result2=mysql_query($query2);
					while($line2=mysql_fetch_array($result2)){ ?>
					<tr>
						<td colspan="2" class="smallbody" ><span class="navi"><? echo $var["date"]; ?> ( <? echo $line2["eesnimi"];?> <? echo $line2["perenimi"];?> )</span></td>
					</tr>
					<? } ?>
					<tr>
					  <td class="smallbody" width="99%"><? echo $var["body"]; ?></td>
					  <td class="smallbody"><select class="smallbody" name="list_st<? echo $var["id"];?>" id="list_st_<? echo $var["id"];?>" onchange="muuda_st('<? echo $var["id"];?>')">
    <?
$staatus_nimi=array("!?!?","ok","chat");
for ($i = 0; $i < 3; $i++) 
{
	if($i==$var["staatus"]) { $sel="selected"; } else { $sel="";}
		echo "<option value=\"".$i."\" ".$sel.">".$staatus_nimi[$i]."</option>"; 
}?>
  </select></td>
              </tr>
					<tr>
									<td colspan="2" background="image/sinine.gif"><img height="1" width="1" src="image/sinine.gif" /></td>
			  </tr>
				<? } ?>
</table>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>&nbsp;</td>
					  <td width="100%" class="menu" align="right"><a href="#" onClick="window.open('addvalue_textlog.php?domain=<? echo $domain;?>&user=<? echo $_SESSION["mysession"]["login"];?>&valjad=<? echo $fields; ?>&identify=oid&oid=<? echo $oid; ?>','Lisa','toolbar=0,width=620,height=550,status=yes')">Uus&nbsp;teade</a></td><td><img src="image/index_41.gif" border="0"></td><td width="100%" class="menu" align="right"><a href=" <? echo keyke($domain."open"); ?>"><? echo ((strpos(keyke($domain."open"),$domain."open")==0)?"lühidalt":"näita&nbsp;vanemaid");?></a></td>
						<? $query="SELECT privileegid FROM isik WHERE username='".$login."'"; 
						$result = mysql_query($query);
						$line=mysql_fetch_row($result); ?></td>
						
						
				  </tr>
				</table><!--<input type="text" id="favorite" size="40">-->
<?	} ?>
