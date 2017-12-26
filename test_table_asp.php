<?

$seosid = intval($_GET['seosid']);
$show = intval($_GET['show']);

$con = mysqli_connect('localhost', 'fyysika_ee', '4dNobeliNitro');
if (!$con)
  {
  	die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"fyysika_ee");

$sql="UPDATE test_nupula SET naita_veebis1=".$show." WHERE id='".$seosid."'";

$result = mysqli_query($con,$sql);

echo $show." ja ".$sql;

mysqli_close($con);
?> 