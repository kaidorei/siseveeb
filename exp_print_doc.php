<?php
	mb_internal_encoding('UTF-8');
include("connect.php");
require_once 'header.php';
include("globals.php");

$kat=$_GET["kat"];

echo "Uuendan k&otilde;igi t&ouml;&ouml;tubade allalaetavad doc failid ... <br>";

//echo $_POST["submit_value"];
//echo $expid;
//$id=$_GET["id"];

require_once 'phpword/PHPWord.php';

$query_temp="SELECT * FROM exp WHERE gpid_demo=6 AND naita_veebis=1 order by id"; //6 tähendab töötubasid
//echo $query_temp."<br><br>";
$result_temp=mysql_query($query_temp);
while($line_temp=mysql_fetch_array($result_temp))
{ 

// New Word Document
$PHPWord = new PHPWord();
$PHPWord->addFontStyle('rStyle', array('bold'=>true, 'italic'=>true, 'size'=>16));
$PHPWord->addFontStyle('uStyle', array('bold'=>true, 'italic'=>true, 'size'=>12));
$tableStyle = array(
    'borderSize' => 6,
    'cellMargin' => 60
);
$firstRowStyle = array();
$PHPWord->addTableStyle('tabel1', $tableStyle, $firstRowStyle);

$query_vahh="SELECT * FROM exp_exp WHERE oid1=".$line_temp["id"]." AND naita_veebis1=1 order by order1";
//echo $query_vahh,"<br>";
$result_vahh=mysql_query($query_vahh);
$section = $PHPWord->createSection();
$section->addText(kohendatekst($line_temp["nimi_est"]), 'rStyle');
$section->addText(kohendatekst($line_temp["kirjeldus_est"]));
//$footer = $section->addFooter();
//$footer->addImage('http://www.online-image-editor.com/styles/2013/images/example_image.png');


$count_row=0;
$samm=NULL;

while($line_vahh=mysql_fetch_array($result_vahh))
{
	//echo $line_vahh["oid2"];
	$query_vahh1="SELECT * FROM exp WHERE id=".$line_vahh["oid2"];
	$result_vahh1=mysql_query($query_vahh1);
	$line_vahh1=mysql_fetch_array($result_vahh1);
	switch ($line_vahh1["gpid_demo"])
	{
		case 35: //katsevandid
			$samm[$count_row][1]=kohendatekst($line_vahh1["kokku_est"]);
			$samm[$count_row][2]=9;
			$samm[$count_row][3]=$line_vahh["oid2"];
		break;
		case 4: // video
		case 5: // video
			$samm[$count_row][0]=urldecode($line_vahh1["veeb_pilt_url"]);
			$samm[$count_row][1]="Vaata videot: ".kohendatekst($line_vahh1["nimi_est"]);
			$samm[$count_row][2]=5;
			$samm[$count_row][3]="Vaata videot: http://www.youtube.com/v/".$line_vahh1["id_youtube"];
		break;
		case 9:
		if(!$line_vahh["title1"])
		{
			$samm[$count_row][0]=urldecode($line_vahh1["veeb_pilt_url"]);
			$samm[$count_row][1]=kohendatekst($line_vahh1["kirjeldus_est"]);
			$samm[$count_row][2]=1;
		}
		else
		{
			$samm[$count_row][0]=urldecode($line_vahh1["veeb_pilt_url"]);
			$samm[$count_row][1]=kohendatekst($line_vahh["title1"]);
		}
		break;
		case 32: // kontrollküsimused
		case 21:
			$query_liik="SELECT * FROM `exp_grupid_demo` WHERE id=".$line_vahh1["gpid_demo"];
			$result_liik=mysql_query($query_liik);
			$liik=mysql_fetch_array($result_liik); 
			//echo $liik["ico_url_v"];
			$samm[$count_row][0]='image/ico_exp_'.$line_vahh1["gpid_demo"].'_v.png';
			$samm[$count_row][1]=kohendatekst($line_vahh1["probleem_est"]);

		break;
		case 15: //tekst 
			$samm[$count_row][1]=kohendatekst($line_vahh1["kirjeldus_est"]);
			break;
	}
$count_row++;
}


for($ii=0;$ii<$count_row;$ii++)
{
		if($samm[$ii][2]==9) //kui on katsevahendid
		{
			$section->addText('Katsevahendid', 'uStyle');
			$query_vahh12="SELECT * FROM exp_vahendid WHERE oid1=".$samm[$ii][3];
			//echo $query_vahh12;
			$result_vahh12=mysql_query($query_vahh12);
			$count_r=1;
			while($line_vahh12=mysql_fetch_array($result_vahh12))
			{
				$query_vahh13="SELECT * FROM vahendid WHERE id=".$line_vahh12["oid2"];
				//echo $query_vahh1;
				$result_vahh13=mysql_query($query_vahh13);
				$line_vahh13=mysql_fetch_array($result_vahh13);
				if($line_vahh12["title1"])
				{
					$section->addText(kohendatekst($count_r.'. '.$line_vahh12["title1"]));
				}
				else
				{
					$section->addText(kohendatekst($count_r.'. '.$line_vahh13["nimi_est"]));
				}
				//echo $line_vahh1["nimi_est"],"<br>";
				$count_r++;
			}
		}

		else
		{
		$table = $section->addTable('tabel1');
		$table->addRow();
		if($samm[$ii][0]) // pildiga asjad
		{
			switch ($samm[$ii][2])
			{
				case 1: // pildid
				{
					$table->addCell(3000)->addImage($samm[$ii][0], array('width'=>200, 'height'=>175, 'align'=>'center'));
					$table->addCell(6000)->addText($samm[$ii][1]);
					break;
				}
				case 5:
				{
					$table->addCell(3000)->addImage($samm[$ii][0], array('width'=>200, 'height'=>175, 'align'=>'center'));
					$table->addCell(6000)->addText($samm[$ii][3]);
					break;
				}
				default: 
				{
					$table->addCell(3000)->addImage($samm[$ii][0], array('width'=>100, 'height'=>100, 'align'=>'center'));
					$table->addCell(6000)->addText($samm[$ii][1]);
					break;
				}
					
			}
		}
		else // ilma pildita asjad
		{
		//echo "adsf ".urldecode($line_vahh1["veeb_pilt_url"]);
			$table->addCell(9000)->addText($samm[$ii][1]);
		}
		$section->addText('');
}
}
$section->addImage('image/ETAG.jpg');
$section->addImage('image/88x31.png');

// Save File
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$failinimi = 'media/exp_docs/EksperimentETAG'.$line_temp["id"].'.docx';
$objWriter->save('media/exp_docs/EksperimentETAG'.$line_temp["id"].'.docx');
?>
Loodud fail: <a target="_blank" href="http://www.fyysika.ee/omad/<? echo $failinimi;?>"><? echo $failinimi;?></a> <a href="exp_print.php?domain=exp&id=<? echo $line_temp["id"];?>" class="menu_punane" target="_blank"><img src="image/ico_exp_15_v.png" alt="print" width="30" height="30" border="0" /></a><br>
<?
}

function kohendatekst($text)
{
//	echo "enne:",$text,"<br>";
	$html_tag = array("<p>","</p>","<br />","&nbsp","&rdquo;");
	$text = str_replace($html_tag, "", $text);
	$text = str_replace('&auml;', 'ä', $text);
	$text = str_replace('&Auml;', 'Ä', $text);
	$text = str_replace('&uuml;', 'ü', $text);
	$text = str_replace('&Uuml;', 'Ü', $text);
	$text = str_replace('&ouml;', 'ö', $text);
	$text = str_replace('&Ouml;', 'Ö', $text);
	$text = str_replace('&otilde;', 'õ', $text);
	$text = str_replace('&Otilde;', 'Õ', $text);
	$text = str_replace('&ndash;', '-', $text);
//	echo "edasi:",$text,"<br>";
return $text;
}
?>