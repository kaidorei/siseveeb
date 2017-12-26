<?

require_once 'header.php';
mb_internal_encoding('UTF-8');
include("connect.php");
// Ühtlustan raamatute struktuuri:
// Igal pid=1 alajaotusel on alajaotused Kokkuvõte, Kontrollküsimused ja Lisamaterjalid
// Kõik gpid_demo = 32 ja 20 objektid kontrollküsimuste alla
//echo "+";
//$line_temp["id"]=$_GET["id"];
//Kohustuslikud alajaotused, mille olemasolu kontrollime
$query_temp="select * from isik where id in (SELECT oid2 as id FROM reis_isik where oid1 in (select id as id from reis where tyyp < 3))";
//echo $query_temp."<br>";
//	echo $query;
?>	 <?



if($result = $db->query($query_temp)) {
$count_row = 0;

?>
<div style= "border-spacing:5px;">

<?

	while($row = $result->fetch_row())
	{
?>
<div style = "float: left; width: 200px; height: 270px;">
<?
if($row[10]!=NULL)
		{
			?>
			<img width = "150" src="http://www.fyysika.ee/omad/<? echo urldecode($row[10]);?>">

			<?
		}
		else
		{
			?>
			<img width = "150" src="http://www.fyysika.ee/omad/media/isik_pildid/polepilti.jpg">
			<?
		}
		echo '<br>'. $row[3].' '.$row[2].' ';
		?>
	</div>
		<?
$count_row ++;
	}


	?>

</div>
	<?
} else {
	trigger_error('MySQL error: ' . $db->error, E_USER_WARNING);
	trigger_error('Related query: ' . $query, E_USER_NOTICE);
}
?>
