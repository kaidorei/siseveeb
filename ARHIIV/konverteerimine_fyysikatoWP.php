<?
    /* Connecting, selecting database */
//	mb_internal_encoding('UTF-8');
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 
//	require_once 'header.php';
	require_once 'header.php';

$query="SELECT * FROM `fyysika` LIMIT 1";
$result=mysql_query($query);

while($line=mysql_fetch_array($result))
{
	
echo "Leht".$line["title"]."<br>";	

$query_insert = "INSERT INTO `fyysika_ee`.`wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_category`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES (NULL, '28', '2010-04-03 11:21:39', '2010-04-03 08:21:39', '".$db->real_escape_string($line["body"])."', '".$db->real_escape_string($line["title"])."', '0', '', 'publish', 'open', 'closed', '', 'fyysika.ee".$line["id"]."', '', '', '2014-04-09 10:52:54', '2014-04-09 07:52:54', '', '0', '', '0', 'page', '', '0');";

//echo $query_insert." <br>";
echo $query_insert." <br>";

//$r=mysql_query($query_insert);


}
?><embed src="media/exp_kasutusjuhend/792_biot_savart.html" width="100%" height="100%">
	echo "korras ...";


	