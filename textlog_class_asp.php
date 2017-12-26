<?

$log_id = intval($_GET['log_id']);
$value= intval($_GET['value']);

$con = mysqli_connect('localhost', 'fyysika_ee', '4dNobeliNitro');

if (!$con)
  {
  	die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"fyysika_ee");

if($log_id)
{

$sql="UPDATE exparendus SET staatus='".$value."' WHERE id='".$log_id."'";

$result = mysqli_query($con,$sql);
}
echo $sql;

mysqli_close($con);
?> 