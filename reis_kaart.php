<?

include("connect.php");
include("globals.php");

$reisid=$_GET["reisid"];

?><!DOCTYPE html><html>  <head>    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />    
<style type="text/css">      
html { height: 100% }      
body { height: 100%; margin: 0; padding: 0 }      
#map_canvas { height: 100% }    
</style>    
<script type="text/javascript"      
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDR4WA-58fkK13A9rWfWm7IrzJcWBpDEU4&sensor=true">    
</script>    
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&language=et"></script>
<script type="text/javascript">      
function initialize() 
{        
var myOptions = {center: new google.maps.LatLng(58.780320962717, 25.1427626796516), zoom: 7,mapTypeId: google.maps.MapTypeId.ROADMAP};        
var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
var iconFile_kool = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'; 
var iconFile_site = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'; 
var iconFile_tahm = 'http://maps.google.com/mapfiles/ms/icons/black-dot.png'; 

<?


	$query_asi="SELECT * FROM reis_kool WHERE oid1=".$reisid." ORDER BY id";
	$result_asi=mysql_query($query_asi);
	$count=0;
	while($line_asi=mysql_fetch_array($result_asi))
	{
		$query_asi1="SELECT * FROM kool WHERE id=".$line_asi["oid2"]."";
//		echo $query_asi1;
		$result_asi1=mysql_query($query_asi1);
		$line_asi1=mysql_fetch_array($result_asi1); 


		if ($line_asi1["WG_LA"])
		{
		echo "var myLatlng_s",$line_asi1["id"]," = new google.maps.LatLng(".$line_asi5["WG_LA"].",".$line_asi5["WG_LO"].");\n";
		echo "var marker_s",$line_asi1["id"]," = new google.maps.Marker({position: myLatlng_s",$line_asi1["id"],", map: map, title:'".$line_asi5["nimi"]."' });\n";
?>
		marker_s<? echo $line_asi1["id"]; ?>.setIcon(iconFile_site) ;
		
		
var contentString_s<? echo $line_asi1["id"];?> = '<div id="content_s<? echo $line_asi1["id"];?>">'+
    '<div id="siteNotice_s<? echo $line_asi1["id"];?>">'+
    '</div>'+
    '<h3 id="firstHeading" class="firstHeading"><? echo $line_asi1["nimi"],": ", $line_asi5["nimi"];?></h3>'+
    '<div id="bodyContent">'+
    '<p><? echo $line_asi5["WG_LA"]," N ",$line_asi5["WG_LO"]," E"; ?>' +
    '</p>'+
    '</div>'+
    '</div>';
	
var infowindow_s<? echo $line_asi1["id"];?> = new google.maps.InfoWindow({
    content: contentString_s<? echo $line_asi1["id"];?>
});
google.maps.event.addListener(marker_s<? echo $line_asi1["id"];?>, 'click', function() {
  infowindow_s<? echo $line_asi1["id"];?>.open(map,marker_s<? echo $line_asi1["id"];?>);
});
<?
}


		$count++;
	}

?>

}    
</script>  
</head>  

<body onload="initialize()">    
<div id="map_canvas" style="width:100%; height:100%"></div>  
</body>
</html>