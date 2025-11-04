<html><body><center>
<?php
include("welcome.php");
…
…
?>
<?php
$mul = $_POST["mul"];
$num = $_POST["num"];
echo '<table align=\"center\ border= 2">';
for ( $i = 1; $i <= $mul; $i++)
{
echo "<tr><td>";
echo $num." x ".$i;
echo "</td><td> = </td> <td> ";
echo $num * $i;
echo "</td></tr>";
}
echo "</table>";
?>
</center></body></html>