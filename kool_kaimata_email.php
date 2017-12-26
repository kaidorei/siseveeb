<link href="scat.css" rel="stylesheet" type="text/css" />
<br>
<?	
include("connect.php");

require('kas_on_lubatud_siseveebi.php');


include("globals.php");



	$query="SELECT * FROM kool ";
//	echo $query;
	$result=mysql_query($query);
//WHILE ALGAB--------------------------------------------------------------------------------------------------------------------------
	while($line=mysql_fetch_array($result)){
	
			// kui on tehtud valik staatuse järele ...
			$state = 0;
			//... siis uurime, kas kool on olnud juba kusagil reisil asjaline ...
				$query1="SELECT id,oid1 FROM reis_kool WHERE oid2=".$line["id"];
				//	echo $query1;
				$result1=mysql_query($query1);
				$line1=mysql_fetch_array($result1);		
				
				if($line1==NULL&&$line["yldine_email"])
				{
				echo $line["yldine_email"],"; ";
				} // end of 
  
   }

?>
</table>
