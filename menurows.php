<?php if(!defined('SISEVEEB')) header('Location: index.php');
?>

<link href="scat.css" rel="stylesheet" type="text/css" />
<tr>
	<td>
		<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td width="80%" align="right" background="image/index_05_1.gif">
				<table border="0"  cellpadding="0" cellspacing="0" background="image/menu_taga_1.gif">
				<tr>
					<?php if($priv >= 3) { ?>
					<td class="menu"><a href="index.php?page=promo_table&pw=<? echo $line["password"]; ?>&liik=2">Promo</a></td>
					<td class="menu" nowrap></td>
					<td class="menu"><img src="image/index_09_1.gif" width=24 height=29 alt=""></td>
					<?php } ?>
					<td class="menu"><a href="index.php?page=masin_table&liik=2">KUTSED</a></td>
					<td><img src="image/index_09_1.gif" width=24 height=29 alt=""></td>
					<td class="menu" nowrap>
						<?php
							if($dom == 'kool') echo '<input type="checkbox" name="kool" value="1" checked="checked">';
							else echo '<input type="checkbox" name="kool" value="1">';
						?>
					</td>
				<td class="menu"><a href="index.php?page=kool_table">Koolid</a></td>
					<td align="left" background="image/index_05.gif" class="navi">
				<a href="index.php?page=koolg_table&pw=<? echo $line["password"]; ?>&liik=2">
				<img src="image/globe_vvv.png" alt="globe_koolid" title="Globe koolid" width="25" border="0">
				</a>
			</td>
            <td align="left" background="image/index_05.gif" class="navi" valign="middle">
				<a href="index.php?page=kool_table&sel=10" ><img src="image/fkb.png" border="0" alt="globe"  /></a>
		  </td><td class="menu"><img src="image/index_09_1.gif" width=24 height=29 alt=""></td>
					<td class="menu" nowrap>
						<?php
							if($dom == 'reis') echo '<input type="checkbox" name="reis" value="1" checked="checked">';
							else echo '<input type="checkbox" name="reis" value="1">';
						?>
					</td>
					<td class="menu"><a href="index.php?page=reis_table">Reisid</a></td>
					<td><img src="image/index_09_1.gif" width=24 height=29 alt=""></td>
					<td class="menu" nowrap>
						<label>
							<input type="checkbox" name="etendus" value="1" <? if ($_POST["etendus"]  or $dom=="etendus") { echo "checked=","\"checked\"";}?>>
						</label>
					</td>
					<td class="menu" nowrap><a href="index.php?page=etendus_table&pw=<? echo $line["password"]; ?>">Kavad</a></td>

					<td class="menu"><img src="image/index_09_1.gif" width=24 height=29 alt=""></td>

			    <td class="menu"><a href="index.php?page=arve_table">Arved</a></td>

					<td class="menu"><img src="image/index_09_1.gif" width=24 height=29 alt=""></td>

			    <td class="menu"><a href="index.php?page=toend_table">T</a></td>

					<td class="menu"><img src="image/index_09_1.gif" width=24 height=29 alt=""></td>

					<td class="menu" nowrap>

						<?php

							if($dom == 'isik') echo '<input type="checkbox" name="isik" value="1" checked="checked">';

							else echo '<input type="checkbox" name="isik" value="1">';

						?>

					</td>



					<td class="menu"><a href="index.php?page=isik_table">Isik</a></td>

					<td class="menu"><img src="image/index_09_1.gif" width=24 height=29 alt=""></td>

					<td class="menu"><a href="index.php?page=job_table">HINNAKALK.</a></td>

					<td class="menu"><img src="image/index_09_1.gif" width=24 height=29 alt=""></td>



					<? if ($priv>=2){?>

						<!--

						<td class="menu"><a href="index.php?page=tool_table&pw=<? //echo  $line["password"]; ?>">M</a></td>

						<td class="menu"><img src="image/index_09_1.gif" width=24 height=29 alt=""></td>

						<td class="menu"><a href="index.php?page=isik_table&pw=<? //echo  $line["password"]; ?>&liik=2">Isik&nbsp;FI</a></td>

						<td class="menu"><img src="image/index_09_1.gif" width=24 height=29 alt=""></td>

						-->

						<td class="menu" nowrap>

							<label>

								<input type="checkbox" name="firma" value="1" <? if ($_POST["firma"] or $dom=="firma") { echo "checked=","\"checked\"";}?>>

							</label>

						</td>



						<td class="menu"><a href="index.php?page=firma_table">Firmad</a></td>

					<? } ?>





				</tr>



				</table>

			</td>

		</tr>

		</table>

	</td>

</tr>



<tr>

	<td align="right">

		<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		<tr>

			<td width="3%" nowrap class="menu">

						<label>

							<input type="checkbox" name="exp" value="1" <? if ($_POST["exp"] or $dom=="exp") { echo "checked=","\"checked\"";}?>>

						</label></td><td bgcolor="#FFFFFF" width="86%" align="left" valign="middle" class="navi">

			</td>
			<td width="11%" align="right" >

				<table border="0" cellpadding="0" cellspacing="0" background="image/menu_taga.gif">

				<tr> 



					<td class="menu" nowrap><a href="index.php?page=foorum_table">AVALEHT</a></td>





					<td><img src="image/index_11.gif" width=17 height=29 alt=""></td>

				</tr>

				</table>

			</td>

		</tr>

		</table>

	</td>

</tr>

<? if ($priv>=2) { ?>

<tr>

	<td align="right">

		<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		<tr>





			<td width="80%" align="right" background="image/index_05.gif">

				<table border="0" cellpadding="0" cellspacing="0" background="image/menu_taga.gif">

				<tr>

					<td><img src="image/index_07.gif" alt="" width=28 height=29 border="0"></td>

					<!-- <td class="menu"><a href="index.php?page=raamat_table&pw=<? //echo  $line["password"]; ?>">Raamat</a></td>

					<td class="menu"><img src="image/index_09.gif" width=24 height=29 alt=""></td> -->

					<?php /*?><td class="menu" nowrap>

						<input type="checkbox" name="uudis" value="1" <? if ($_POST["uudis"] or $dom=="uudis") { echo "checked=","\"checked\"";}?>>

					</td>

					<td class="menu"><a href="index.php?page=uudis_table&pw=<? echo $line["password"]; ?>">Uudised</a></td>

					<td class="menu"><img src="image/index_09.gif" width=24 height=29 alt=""></td><?php */?>





					<td class="menu" nowrap><a href="index.php?page=raamat_table" class="menu_punane">Raamat</a></td><td class="menu"><img src="image/index_09.gif" width=24 height=29 alt=""></td>

					<td class="menu" nowrap><a href="index.php?page=raamatX_table&pid=1" class="menu_punane">Tegum/Tund</a></td>

					<td><img src="image/index_09.gif" width=24 height=29 alt=""></td>

          <td class="menu" nowrap><a href="index.php?page=raamatX_table&pid=2">&Otilde;ppet&uuml;kid</a></td><td><img src="image/index_09.gif" width=24 height=29 alt=""></td>

					<td class="menu" nowrap><a href="index.php?page=oskus_table">P&otilde;hivara</a></td>





					<td class="menu"><img src="image/index_09.gif" width=24 height=29 alt=""></td>



		<? if ($priv>=7) { ?>











					<td class="menu"><a href="index.php?page=pohivara_table&pw=<? echo $line["password"]; ?>&liik=2">M&auml;rks&otilde;nad</a></td><td class="menu"><img src="image/index_09.gif" width=24 height=29 alt=""></td><td class="menu" nowrap>

						<label>

							<input type="checkbox" name="pacs" value="1" <? if ($_POST["pacs"] or $dom=="pacs") { echo "checked=","\"checked\"";}?>>

						</label>

					</td>

					<td class="menu"><a href="index.php?page=pacs_table&liik=2">Kamp</a></td><td><img src="image/index_09.gif" width=24 height=29 alt=""></td>

					<td class="menu" nowrap>

						<label>

							<input type="checkbox" name="vahendid" value="1" <? if ($_POST["vahendid"] or $dom=="vahendid") { echo "checked=","\"checked\"";}?>>

						</label>

					</td>



					<td class="menu" nowrap><a href="index.php?page=vahendid_table">Vah-d</a></td>

					<td><img src="image/index_09.gif" width=24 height=29 alt=""></td>

					<td class="menu" nowrap><a href="index.php?page=uurimus_table">Uurimus</a></td>



		<? } ?>



					<td><img src="image/index_11.gif" width=17 height=29 alt=""></td>

				</tr>

				</table>

			</td>

		</tr>

		</table>

	</td>

</tr>



<? } ?>
