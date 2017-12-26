<?

$expid = intval($_GET['expid']);
$field = $_GET['field'];
$value= intval($_GET['value']);

$con = mysqli_connect('localhost', 'fyysika_ee', '4dNobeliNitro');
if (!$con)
  {
  	die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"fyysika_ee");



if($field == "liik")
{

$sql="UPDATE exp SET gpid_demo='".$value."' WHERE id='".$expid."'";

$result = mysqli_query($con,$sql);
}
if($field == "show")
{

$sql="UPDATE exp SET naita_veebis='".$value."' WHERE id='".$expid."'";

$result = mysqli_query($con,$sql);
}
if($field == "staatus")
{

$sql="UPDATE exp SET staatus_id='".$value."' WHERE id='".$expid."'";

$result = mysqli_query($con,$sql);
}
if($field == "on_slave")
{

$sql="UPDATE exp SET on_slave='".$value."' WHERE id='".$expid."'";

$result = mysqli_query($con,$sql);
}
echo "field=",$field,"sql=",$sql;

mysqli_close($con);
?> 