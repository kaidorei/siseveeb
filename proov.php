<?php
$_POST['pooleli'];
echo "pooleli=",$pooleli;
$pooleli++;
$j2tka=1;
?>

<script>
function proovi_veel(id) {
  vorm = document.forms ['muugi'];
  vorm.pooleli.value=id;
  vorm.submit();
}
</script>

<form name="muugi" action="proov.php">
MD5<input type="text" name="md5" ><br >
Pooleli<input type="text" name="pooleli" value="">
<input type="submit" value="Lammuta!!">
</form>

<script>
<?PHP if ($j2tka) echo "proovi_veel(".$pooleli.")";?>
</script>