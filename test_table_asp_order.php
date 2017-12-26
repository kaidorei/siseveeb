<?

$seosid = intval($_GET['seosid']);
$order = intval($_GET['order']);
$domain = $_GET['domain'];
$field = $_GET['field'];

if(!$domain)
{
	$domain="test_nupula";	
}
if(!$field)
{
	$field="order1";	
}

$con = mysqli_connect('localhost', 'fyysika_ee', '4dNobeliNitro');
if (!$con)
  {
  	die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"fyysika_ee");

$sql="UPDATE ".$domain." SET ".$field."=".$order." WHERE id='".$seosid."'";

$result = mysqli_query($con,$sql);

echo $sql;

mysqli_close($con);
?> 