<head>
<STYLE TYPE='text/css'>
P.pagebreakhere {page-break-before: always}
</STYLE>
</head>
<? 



include("connect.php");

require('kas_on_lubatud_siseveebi.php');


include("globals.php");
$aid=$_GET["aid"];
$query=" SELECT * FROM `arve` ORDER BY nmbr DESC LIMIT 200 ";
$result=mysql_query($query);


while($line=mysql_fetch_array($result))
{

$query2="SELECT * FROM kool WHERE id=".$line["kool_id"];
$result2=mysql_query($query2);
$line_kool=mysql_fetch_array($result2);


?>
<body>
<table  align="center" width="705" border="0">
  <tr>
    <td width="699">
<img width=699 height=96
src="image/image002.jpg" v:shapes="_x0000_i1025" /></p>
  <p align=right style='text-align:right;
'><span style='font-size:10.0pt'><br />
    <br />
    <br />
    <br />
                                                                                                                                                                        </span>Registrikood
    80046424</p>
  <p align=right style='text-align:right;
'>Arveldusarve: 1120073071
    Swedbank</p>
  <p align=center style='text-align:center;
'><span style='font-size:14.0pt;
'><br />
    <br />
    <br />
    ARVE NR. <?php echo $line['nmbr']; ?></span><br />
    <br />
    <br />
  </p>
  <p align=right style='text-align:right;
'><b><?php echo $line['date']; ?></b></p>
  <table border=0 cellspacing=0 cellpadding=0>
    <tr>
      <td width="289" valign=top><p align=left style='
  text-align:left;text-autospace:
  none;'>
        <?php echo $line_kool['nimi']; ?><br />
          <?php echo $line_kool['aadress']; ?></p>
        <p align=left style='
  text-align:left;text-autospace:
  none;'><?php if($line['maksja_nimi']) { ?> Maksja:<br /><?php } echo $line['maksja_nimi']; ?><br />
          <?php echo $line['maksja_aadress']; ?></p>
        <p align=left style='
  text-align:left;text-autospace:
  none;'>&nbsp;</p></td>
      </tr>
	</table>
  <table border=1 cellspacing=0 cellpadding=3>
	
    <tr>
      <td width=44 valign=top><span lang=ET>Nr</span></td>
      <td width=328 valign=top>Kauba, teenuse nimetus</td>
      <td width=126 valign=top><span> </span>Kogus</td>
      <td width=116 valign=top><span style='font-size:10.0pt;font-weight:normal'> </span><span lang=ET>Ühiku hind</span></td>
      <td width=85 valign=top><span lang=ET>Summa</span></td>
    </tr>
    <tr>
      <td width=44 valign=top>&nbsp;</td>
      <td width=328 valign=top>&nbsp;</td>
      <td width=126 valign=top><p align=left style='text-align:left;
  '><span lang=ET>(tk)</span></p></td>
      <td width=116 valign=top><span lang=ET style='font-weight:normal'> EUR</span></td>
      <td width=85 valign=top><span lang=ET style='font-weight:normal'>EUR</span></td>
    </tr>
    <tr>
      <td width=44 valign=top><p align=left style='text-align:left;
  '><span lang=ET>1</span></p></td>
      <td width=328 valign=top><p align=left style='text-align:left;
  '><span lang=ET><?php echo $line['mis_tehtud']; ?></span></p></td>
      <td width=126 valign=top><p align=left style='text-align:left;
  '><span lang=ET> 1</span></p></td>
      <td width=116 valign=top><p align=left style='text-align:left;
  '><span lang=ET><?php echo $line['summa']; ?></span></p></td>
      <td width=85 valign=top><p align=left style='text-align:left;
  '><span lang=ET><?php echo $line['summa']; ?></span></p></td>
    </tr>
    <tr>
      <td width=44>&nbsp;</td>
      <td width=328>&nbsp;</td>
      <td width=126>&nbsp;</td>
      <td width=116><p align=left style='text-align:left;
  '><b><span lang=ET>Tasuda:</span></b></p></td>
      <td width=85><p align=left style='text-align:left;
  '><b><span lang=ET><?php echo $line['summa']; ?></span></b></p></td>
    </tr>
    <tr>
      <td colspan=5 valign=top><p align=left style='text-align:left;
  '><span lang=ET><br>
          Summa sõnadega: <?php echo $line['summa_sonadega']; ?></span></p></td>
    </tr>
  </table>
  <p align=left style='text-align:left;
'><span lang=ET><br />
  <br />
    Märkus: Eesti Füüsika Selts ei ole 
    käibemaksukohuslane.</span></p>
  <p align=left style='text-align:left;
'><span lang=ET>                                                                                                                           <img width=108 height=75
src="image/image004.jpg" v:shapes="_x0000_i1026">  </span></p>
  <p align=left style='text-align:left;
'><span lang=ET>Arve väljastas:                                                                   /Kaido Reivelt/ EFS juhatuse esimees</span></p>
</div></td>
  </tr>
</table>
<P CLASS="pagebreakhere">.</p>
<? }

?>


</body>