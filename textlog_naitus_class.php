<?  
function log_naitus($domain,$extent,$oid,$login,$fields,$lisa){
			if($extent>0){
					$limit="LIMIT ".$extent;
			} else { $limit="";}
			echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\"><tr><td class=\"fields\">";
			$query="SELECT * FROM ".$domain." WHERE oid=".$oid." ORDER BY id";
//			DESC on eelmise käsurea lõpust maas, millegipärast see ei töödanud ja ei viitsinu uurida, miks, niipalju neid näituseid ka ei ole ...
			$result=mysql_query($query);

			while($var=mysql_fetch_array($result)){ //$var=$line;
			//	print_r($var);
					$query2="SELECT eesnimi,perenimi FROM users_db WHERE id=".$var["user_id"];
//					echo $query2;
					$result2=mysql_query($query2);
					while($line2=mysql_fetch_array($result2))
					{
						echo "<table width=\"100%\"><tr><td colspan=\"2\" class=\"smallbody\" ><span class=\"navi\">".(($domain!="exp_jnaitused") && ($domain!="exp_naitused")?$var["lupdate"]:"")." (".$line2["eesnimi"]." ".$line2["perenimi"].") </span>";
						echo "</td></tr><tr><td colspan=\"2\" class=\"smallbody\">";
						echo "<b>".$var["datefrom"]."</b> kuni <b>".$var["dateto"]."</b></span><br>"; 
						echo "</td></tr><tr><td width=\"100%\" class=\"smallbody\">";
						echo $var["pealkiri_est"]."</span><br>"; 
						echo "</td>";
						// siia tuleb edit nupp ...
				 		echo "<td ><input type=\"button\" class=\"button3\" value=\"e\" onClick=\"window.open('addvalue_textlog_mod.php?domain=".$domain."&user=".$_SESSION["mysession"]["login"]."&valjad=".$fields."&identify=id&id=".$var["id"]."','Lisa','toolbar=0,width=820,height=570,status=yes');\"></td>";
						echo "</tr>";
						echo "<tr><td colspan=\"2\" class=\"smallbody\"><table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"1\"><tr><td background=\"images/sinine.gif\"><img src=\"images/sinine.gif\" width=\"1\" height=\"1\"></td></tr></table></td></tr></table>";
					}
					}

				echo "<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\"><tr><td width=\"100%\" class=\"menu\" align=\"right\"><a href=\"".keyke($domain."open")."\">".((strpos(keyke($domain."open"),$domain."open")==0)?"lühidalt":"veel")."</td><td><img src=\"images/index_41.gif\" border=\"0\"></td>";
					$query="SELECT privileegid FROM users_db WHERE username='".$login."'"; 
		            $result = mysql_query($query);
					$line=mysql_fetch_row($result);
					if($lisa==1)
					{
						echo "<td width=\"100%\" class=\"menu\" align=\"right\"><a href=\"#\" onClick=\"window.open('addvalue_textlog.php?domain=".$domain."&user=".$_SESSION["mysession"]["login"]."&valjad=".$fields."&identify=oid&oid=".$oid."','Lisa','toolbar=0,width=420,height=650,status=yes');\">lisa</a></td><td><img src=\"images/index_36.gif\" border=\"0\"></td>";
					}

					echo "</tr></table></td></tr></table>";
					//echo "</td></tr></table>";
	} ?>