<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr> 

    <td background="images/index_48.gif"> <table border="0" cellpadding="0" cellspacing="0" background="images/menu_taga.gif">

        <tr> 

          <td><img src="images/index_43.gif" width=10 height=18 alt=""></td>

          <td background="images/index_45.gif" class="menu">Lisad</td>

          <td><img src="images/index_47.gif" width=29 height=18 alt=""></td>

        </tr>

      </table></td>

  </tr>

  <tr> 

    <td background="images/sinine.gif" class="menu"><img src="images/spacer.gif" width="10" height="10">Inimesed</td>

  </tr>

  <tr> 

    <td>

      <?

		include("textlog_class.php");

		$tmp=array("date","body");

		//log2("isik_alog",(isset($_GET["logopen"])?0:2),$iid,$_SESSION["mysession"]["login"],implode(",",$tmp));

	

	?>

    </td>

  </tr>

  <?	

			

		?>

  <tr> 

    <td background="images/sinine.gif" class="menu"><img src="images/spacer.gif" width="10" height="10">Pildid</td>

  </tr>

  <tr> 

    <td> 

      <? include("tabel_class_oid.php");

		  //								tabel("isik_pildid",$iid);								

		  								?>

    </td>

  </tr>

</table>

