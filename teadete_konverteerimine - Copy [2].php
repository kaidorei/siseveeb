<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 


$query="SELECT * FROM uudis WHERE liik=2 AND sisu=1 ORDER BY id LIMIT 1";
$result=mysql_query($query);
$post_id=3700;
while($line=mysql_fetch_array($result)){


			
			$query1="INSERT INTO  `fyysika_ee`.`wp_posts` (
`ID` ,
`post_author` ,
`post_date` ,
`post_date_gmt` ,
`post_content` ,
`post_title` ,
`post_category` ,
`post_excerpt` ,
`post_status` ,
`comment_status` ,
`ping_status` ,
`post_password` ,
`post_name` ,
`to_ping` ,
`pinged` ,
`post_modified` ,
`post_modified_gmt` ,
`post_content_filtered` ,
`post_parent` ,
`guid` ,
`menu_order` ,
`post_type` ,
`post_mime_type` ,
`comment_count`
)
VALUES (
'".$post_id."',  '2',  '".$line['lupdate']."',  '".$line['lupdate']."',  '<img src=\"".urldecode($line["veeb_pilt_url_s"])."\" width=\"600\" height=\"538\" ></br>".$line['body']."',  '".$line['title']."',  '0',  '',  'publish',  'open',  'open',  '',  '',  '',  '',  '".$line['lupdate']."',  '".$line['lupdate']."',  '',  '0',  'http://www.fyysika.ee/wordpress/?p=".$post_id."',  '0',  'post',  '',  '0'
)";

//$result1=mysql_query($query1);


$query2="INSERT INTO `fyysika_ee`.`wp_term_relationships` (
		`object_id` ,
		`term_taxonomy_id` ,
		`term_order` 
		)
		VALUES (
		'".$post_id."', '39', '0')";
//$result2=mysql_query($query2);
$query55="INSERT INTO `fyysika_ee`.`wp_term_relationships` (
		`object_id` ,
		`term_taxonomy_id` ,
		`term_order` 
		)
		VALUES (
		'".$post_id."', '40', '0')";
//$result55=mysql_query($query55);
$query66="INSERT INTO `fyysika_ee`.`wp_postmeta` (
		`post_id` ,
		`meta_key` ,
		`meta_value` 
		)
		VALUES (
		'".$post_id."', 'thumb', '".urldecode($line["veeb_pilt_url_s"])."')";
//$result55=mysql_query($query55);


/*if($line['eesti_asi'])
{
$query2="INSERT INTO `fyysika_ee`.`wp_term_relationships` (
		`object_id` ,
		`term_taxonomy_id` ,
		`term_order` 
		)
		VALUES (
		'".$post_id."', '19', '0')";
//$result2=mysql_query($query2);
}
*/
			echo $line[title], " -> ",$query1," </br></br></br> ",$query2," </br>",$query55,"</br>",$query66,"</br>";
			
$post_id++;
}
?>

	