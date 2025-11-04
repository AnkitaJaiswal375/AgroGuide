<?php
$lang = $_POST['lang'];
$OS = $_POST['OS'];
$count = count ($lang);
echo "<b> Your Favorite Language(s) are: </b></br>";
for($i = 0; $i< $count; $i++)
{
echo ($i + 1 . "." . $lang[$i] . "<br/>");
}
echo "</br></br><b> Your Favorite Operating System(s) are: </b></br>";
$count = count($OS);
for($i = 0; $i < $count ; $i++)
{
echo($i + 1 . "." . $OS[$i] . "<br/>");
}
?>