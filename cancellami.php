<?php
include "include/config.php";
include "include/function.php";
$id_utente= $_SESSION['login_user'];
echo $id_utente."<br>";
$sql = "DELETE FROM users where username = '$id_utente';";
$result = @mysql_query($sql) or die (mysql_error());
echo "Sei stato cancellato dal portale come hai richiesto.";
logout();
?>
