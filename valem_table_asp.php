<?

$valemid = intval($_GET['valemid']);
$liik = intval($_GET['liik']);

$con = mysqli_connect('localhost', 'fyysika_ee', '4dNobeliNitro');
if (!$con)
  {
  	die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"fyysika_ee");

$sql="UPDATE exp SET on_pohivara=".$liik." WHERE id='".$valemid."'";

$result = mysqli_query($con,$sql);

echo $sql;

mysqli_close($con);
?> 