<?
include "config/config.php";
if(!isset($_SESSION['login']))
{
    //echo 'Non sei loggato';
    header('Location: error_login.php');
    exit;
}
?>
<html>
    <head>
        <title>Check Annuncio</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        
        <div id="header">
    <?
    include("header.php");
    ?>
    </div>
    <div id="container">
    <div id="content">
        <br>
       <?
include "config/config.php";
$username=$_SESSION['login_user'];
$city=$_POST['city'];
$message=$_POST['annuncio'];
$expiry_date=$_POST['expiry_date'];
//Inserire controllo se non viene passato id_utente la query viene eseguita lo stesso, non va bene.
//Inserire check tabella se presente o meno.
//Query di inserimento.
$query="INSERT INTO mercato (username, city, message, expiry_date) VALUES ('$username','$city','$message','$expiry_date')";
mysql_query($query) OR die("Errore 003, contattare l'amministratore ".mysql_error());
echo "<br>Ciao ".$username." il tuo annuncio &egrave; stato creato correttamente.<br>";
?>
    </div>
</div>   
    <div id="footer">
     <?
    include("footer.php");
    ?>
</div>
    </body>
</html>
