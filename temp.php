<?php

$sql = "SELECT * FROM users";
$query = @mysql_query($sql) or die (mysql_error());
$count_utenti= mysql_num_rows($query);
?>
?>
