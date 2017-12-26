<?
    /* Connecting, selecting database */
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
     print "Connected successfully";
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? // note that multibyte support is enabled here 


$query="SELECT * FROM kool WHERE tyyp=1";
$result=mysql_query($query);
$isik_id=3700;

while($line=mysql_fetch_array($result)){
if($line["kontakt2"])
{
$arr = split( '[ ]',trim($line["kontakt2"]), 2);
echo $line["kontakt2"]," on ",$arr[0]," ja ",$arr[1],"<br>";


$query_ees="SELECT * FROM `isik` WHERE `perenimi` LIKE '%".$arr[1]."%' AND `eesnimi` LIKE '%".$arr[0]."%'";
//echo $query_ees;
$on_ees=mysql_fetch_array(mysql_query($query_ees));
echo "kas on juba = ",$on_ees["id"],"<br>";

if(!$on_ees[0])
{		
$query1="INSERT INTO `fyysika_ee`.`isik` (`id`, `perenimi`, `eesnimi`, `username`, `password`, `privileegid`, `teaduskraad`, `diplom`, `diplom_aasta`, `veeb_pilt_url`, `veeb_pilt_url_s`, `a_num`, `isikukood`, `amet_est`, `amet_eng`, `amet_rus`, `mobla`, `skype`, `tel_too`, `tel_kodu`, `adr_too1`, `adr_too2`, `adr_kodu`, `email1`, `email2`, `in_buss`, `in_efs`, `in_efs_date`, `paberajakiri`, `eajakiri`, `on_fi`, `on_meedia`, `on_sk`, `on_ajak`, `on_ef`, `on_ut`, `on_promi`, `on_reisijuht`, `on_tugiisik`, `on_nublu`, `huvid`, `markused`, `tagasiside_vormist`, `lupdate`, `in_veeb`, `r_alg`, `maks2005`, `maks2006`, `maks2007`, `maks2008`, `maks2009`, `maks2010`, `maks2011`, `maks2012`, `b_kat`, `sammas`, `uiq`) VALUES (".$isik_id.", '".$arr[1]."', '".$arr[0]."', '', '', '0', '', '', '', NULL, '', NULL, '0', NULL, '', '', NULL, '', '".$line["tel2"]."', NULL, NULL, NULL, NULL, '".$line["email2"]."', NULL, '0', '0', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, NULL, '', CURRENT_TIMESTAMP, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '')";

echo $query1,"<br><br>";

//$result1=mysql_query($query1);
$query2="INSERT INTO `fyysika_ee`.`isik_kool` (`id`, `oid1`, `oid2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`) VALUES (NULL, '".$isik_id."', '".$line["id"]."', '', '', '', '', '', 'direktor')";
//$result2=mysql_query($query2);
echo $query2,"<br><br>";

}

else
{
$query2="INSERT INTO `fyysika_ee`.`isik_kool` (`id`, `oid1`, `oid2`, `title1`, `title2`, `sisse1`, `sisse2`, `sisu1`, `sisu2`) VALUES (NULL, '".$on_ees["id"]."', '".$line["id"]."', '', '', '', '', '', 'direktor')";
//$result2=mysql_query($query2);
echo $query2,"<br><br>";
}}
$isik_id++;
?><hr> <? }
?>

	