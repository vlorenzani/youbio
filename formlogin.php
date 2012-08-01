<?php
// Includo la connessione al database
require('include/config.php');


// Se il modulo viene inviato...
if(isset($_POST['login']))
{
    
    // Dati Inviati dal modulo
    $user = (isset($_POST['user'])) ? trim($_POST['user']) : '';    // Metto nella variabile 'user' il dato inviato dal modulo, se non viene inviato dò di default ''
    $pass = (isset($_POST['pass'])) ? trim($_POST['pass']) : '';    // Metto nella variabile 'pass' il dato inviato dal modulo, se non viene inviato dò di default ''
    
    // Filtro i dati inviati se i magic_quotes del server sono disabilitati per motivi di sicurezza
    if (!get_magic_quotes_gpc()) {
        $user = addslashes($user);
        $pass = addslashes($pass);
    }
    
    // Crypto la password e la confronto con quella nel database
    $pass = md5($pass);
    
    // Controllo l'utente esiste
    $query = mysql_query("SELECT id_user, username FROM users WHERE username = '$user' AND password = '$pass' LIMIT 1");
    
    // Se ha trovato un record
    if(mysql_num_rows($query) == 1)
    {
        // prelevo l'id dal database
        $login = mysql_fetch_array($query);
        
            // Creo una variabile di sessione
        $_SESSION['login'] = $login['id_user'];
        $_SESSION['login_user'] = $login['username'];
        // reindirizzo l'utente
        header('Location: index.php');
        exit;
    }
    // se non esiste da l'errore
    else
        die (header("Location:error_login.php"));
    
    //header("Location:index.php");
//die('Nome Utente o Password errati');
}
?>
   <a href="registrati.php" title"Registrati subito">Registrati</a>
<form action="" method="post">
    Nome utente
 <input name="user" type="text" id="user" value="Nome Utente" onfocus="if(this.value=='Nome Utente') this.value='';" />
 Password
 <input name="pass" type="password" id="pass" value="Password" onfocus="if(this.value=='Password') this.value='';" />
 <input name="login" type="submit" value="Login" />
</form>
