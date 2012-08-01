<?php
        $id_utente=$_SESSION['login_user'];
        require('include/config.php');
if(isset($_SESSION['login']))
    echo '<a href="profilo.php" title="Il mio profilo">'.$id_utente.'</a>| <a href="mp.php" title="I tuoi messaggi privati">Messaggi privati</a>|<a href="logout.php" title"Disconneti">Logout</a><br />';
else
    //include 'popuplogin.php';
    include "login.php";
//echo '<a href="registrati.php" title"Registrati subito">Registrazione</a><br /><a href="login.php">Login</a><br />';
?>      