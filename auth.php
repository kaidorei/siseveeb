<style type="text/css">
<!--
.lahter {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: bold;
	color: #333333;
}
-->
</style>

<link href="scat.css" rel="stylesheet" type="text/css">
      <?  
    if ($loginform==1){
		?>
<br>



<table width="85%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#426442">
  <tr> 
    <td bgcolor="#999999" class="options"><strong> login</strong></td>
  </tr>
  <tr> 
    <td bgcolor="#CCCCCC" align="center"> 
      <table WIDTH="105" align="center" frame=void rules=none>
        <form method="post" action="<? echo "index.php"; ?>" name=loginform>
          <tr> 
            <td width="97" height="23" align="left" class="options">kasutaja: 
            </td>
          <tr> 
            <td align="left"> <input name="login" type="text" class="lahter" size=15 maxlength=50> 
            </td>
          <tr> 
            <td align="left" class="options">salas&otilde;na: </td>
          <tr> 
            <td align="left"> <input name="passwd" type="password" class="lahter" size=15 maxlength=50> 
            </td>
 
          <tr> 
           <td align="left" class="logintext"><div align="left"> 
                <p class="logintext">&nbsp;</p>
              </div></td>
          <tr> 

            <td align="left" class="logintext"> <input name="sent" type=submit class="options" value="login"> 

            </td>

        </form>

      </table>    </td>

  </tr>

</table>

      <p>
  <? }

	   else { 

		$tmp = session_id();         // session is already started 

          include("ahaa.php");	
?>
  <?

		}

	   ?>
      </p>
     <!-- <h1>Hetkel rivist v&auml;ljas, saab korda ca tunni p&auml;rast </h1>-->
