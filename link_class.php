<?  function lingid($domain,$oid,$login){



						

					   	$query2="SELECT * FROM ".$domain." WHERE oid=".$oid." ORDER BY id DESC";

				        $result2=mysql_query($query2);

						$query="SELECT privileegid FROM isik WHERE username='".$login."'"; 

						$result = mysql_query($query);

						$line=mysql_fetch_row($result);

						echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\">";

						echo "<tr><td width=\"100%\" background=\"images/sinine.gif\" class=\"menu\">Nimi</td>";

						if ($line["privileegid"]==2){

							echo "<td width=\"10%\" background=\"images/sinine.gif\" class=\"menu\" ></td>";

						}

						echo"</tr>";

							//	echo $query2;

								 echo "<tr>";

						while($t=mysql_fetch_array($result2)){

						 		echo "<td class=\"fields\"><a href=\"".urldecode($t["url"])."\" target=\"_new\">".$t["pealkiri"]."</a></td>";

									echo $expid;

									 echo "<td >";

									 	$query="SELECT privileegid FROM isik WHERE username='".$login."'"; 

							            $result = mysql_query($query);

										$line=mysql_fetch_row($result);

										if ($line["privileegid"]==2){

										 	echo "<input type=\"button\" class=\"button2\" value=\"x\" onClick=\"window.open('dellink.php?domain=".$domain."&rid=".$t["id"]."','Delete','toolbar=0,width=420,height=200,status=yes');\" >";

										}

									 echo "</td>";

									 echo "</tr>";

								    }				

						  echo "<tr background=\"images/sinine.gif\"><td colspan=\"2\" background=\"images/sinine.gif\"><img src=\"images/sinine.gif\" width=\"1\" height=\"1\"></td>";

        				  echo "</tr><tr align=\"left\" >";

						  echo "<td colspan=\"2\" class=\"menu\" ><input type=\"button\" name=\"suva1\" class=\"button\" value=\"Lisa uus\" onClick=\"window.open('addlink.php?domain=".$domain."&oid=".$oid."','File_upload','toolbar=0,width=690,height=160,status=yes');\">";

						  echo	"</td></tr></table>";

					}

		?>