<html>
<body>
 <?php
 if($_POST["courses"]=='CS301' OR $_POST["courses"] == 'EC301')
 { $ctype='UG Course'; }
 else
 { $ctype='PG Course'; }
 if($_POST["category"]=='full-time')
 { $catg='full time';}
 else
 { $catg='part time';}
 echo "</b> You are registered for a ".$ctype.":".$_POST["courses"]."</b></br>";
 echo "This is a <b>".$catg."course</b>";
 ?>
</body>
</html>