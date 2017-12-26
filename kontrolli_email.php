


<?
include("connect.php");


function validate_email($email){
   $mailparts=explode("@",$email);
   $hostname = $mailparts[1];

   // validate email address syntax
   $exp = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";
   $b_valid_syntax=eregi($exp, $email);

   // get mx addresses by getmxrr
   $b_mx_avail=getmxrr( $hostname, $mx_records, $mx_weight );
   $b_server_found=0;

   if($b_valid_syntax && $b_mx_avail){
     // copy mx records and weight into array $mxs
     $mxs=array();

     for($i=0;$i<count($mx_records);$i++){
       $mxs[$mx_weight[$i]]=$mx_records[$i];
     }

     // sort array mxs to get servers with highest prio
     ksort ($mxs, SORT_NUMERIC );
     reset ($mxs);

     while (list ($mx_weight, $mx_host) = each ($mxs) ) {
       if($b_server_found == 0){

         //try connection on port 25
         $fp = @fsockopen($mx_host,25, $errno, $errstr, 2);
         if($fp){
           $ms_resp="";
           // say HELO to mailserver
           $ms_resp.=send_command($fp, "HELO microsoft.com");

           // initialize sending mail
           $ms_resp.=send_command($fp, "MAIL FROM:<support@microsoft.com>");

           // try receipent address, will return 250 when ok..
           $rcpt_text=send_command($fp, "RCPT TO:<".$email.">");
           $ms_resp.=$rcpt_text;

           if(substr( $rcpt_text, 0, 3) == "250")
             $b_server_found=1;

           // quit mail server connection
           $ms_resp.=send_command($fp, "QUIT");

         fclose($fp);

         }

       }
   }
  }
  return $b_server_found;
}

function send_command($fp, $out){

  fwrite($fp, $out . "\r\n");
  return get_data($fp);
}

function get_data($fp){
  $s="";
  stream_set_timeout($fp, 2);

  for($i=0;$i<2;$i++)
   $s.=fgets($fp, 1024);

  return $s;
}

// support windows platforms
if (!function_exists ('getmxrr') ) {
  function getmxrr($hostname, &$mxhosts, &$mxweight) {
   if (!is_array ($mxhosts) ) {
     $mxhosts = array ();
   }

   if (!empty ($hostname) ) {
     $output = "";
     @exec ("nslookup.exe -type=MX $hostname.", $output);
     $imx=-1;

     foreach ($output as $line) {
       $imx++;
       $parts = "";
       if (preg_match ("/^$hostname\tMX preference = ([0-9]+), mail
exchanger = (.*)$/", $line, $parts) ) {
         $mxweight[$imx] = $parts[1];
         $mxhosts[$imx] = $parts[2];
       }
     }
     return ($imx!=-1);
   }
   return false;
  }
}

echo "Tere <br>";
		$query="SELECT eesnimi,perenimi,  email1 FROM isik WHERE in_efs=1 ORDER BY eesnimi";
		$count=1;
	$result=mysql_query($query);
while($line=mysql_fetch_array($result))
{

$out=validate_email($line['email1']);
if ($out==0) echo $count,". ",$line['eesnimi']," ",$line['perenimi'], "  ",$line['email1']," ",$out,"<br>";
$count++;
}

?>

