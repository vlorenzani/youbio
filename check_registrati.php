<?php
// Includo la connessione al database
require('include/config.php');
include 'include/function.php';

// Se il modulo viene inviato...
if(isset($_POST['registra']))
{
    
    // Dati Inviati dal modulo
    $name = (isset($_POST['name'])) ? trim($_POST['name']) : '';    // Metto nella variabile 'user' il dato inviato dal modulo, se non viene inviato dò di default ''
    $surname = (isset($_POST['surname'])) ? trim($_POST['surname']) : '';    // Metto nella variabile 'user' il dato inviato dal modulo, se non viene inviato dò di default ''
    $user = (isset($_POST['user'])) ? trim($_POST['user']) : '';    // Metto nella variabile 'user' il dato inviato dal modulo, se non viene inviato dò di default ''
    $pass = (isset($_POST['pass'])) ? trim($_POST['pass']) : '';    // Metto nella variabile 'pass' il dato inviato dal modulo, se non viene inviato dò di default ''
    $mail = (isset($_POST['mail'])) ? trim($_POST['mail']) : '';    // Metto nella variabile 'mail' il dato inviato dal modulo, se non viene inviato dò di default ''
    $city = (isset($_POST['city'])) ? trim($_POST['city']) : '';    // Metto nella variabile 'mail' il dato inviato dal modulo, se non viene inviato dò di default ''
    $lat = (isset($_POST['lat'])) ? trim($_POST['lat']) : '';    // Metto nella variabile 'mail' il dato inviato dal modulo, se non viene inviato dò di default ''
    $lng = (isset($_POST['lng'])) ? trim($_POST['lng']) : '';    // Metto nella variabile 'mail' il dato inviato dal modulo, se non viene inviato dò di default ''
   
    // Filtro i dati inviati se i magic_quotes del server sono disabilitati per motivi di sicurezza
    if (!get_magic_quotes_gpc()) {
        $name = addslashes($name);
        $surname = addslashes($surname);
        $user = addslashes($user);
        $pass = addslashes($pass);
        $mail = addslashes($mail);
        $city = addslashes($city);
        $lat = addslashes($lat);
        $lng = addslashes($lng);
    }
    
    
    // Controllo il Nome Utente
    if(strlen($name) < 2 || strlen($name) > 20)
        die('Nome troppo corto, o troppo lungo');
    // Controllo la Password
    elseif(strlen($pass) < 4 || strlen($pass) > 12)
        die('Password troppo corta, o troppo lunga');
    // Controllo l'email
    elseif(!eregi("^[a-z0-9][_\.a-z0-9-]+@([a-z0-9][0-9a-z-]+\.)+([a-z]{2,4})", $mail))
        die('Email non valida');
    // Controllo il nome utente non sia già occupato
    elseif(mysql_num_rows(mysql_query("SELECT username FROM users WHERE user = '$user' LIMIT 1")) == 1)
        die('Nome Utente non disponibile');
    // Controllo l'indirizzo email non sia già registrato
    elseif(mysql_num_rows(mysql_query("SELECT mail FROM users WHERE mail = '$mail' LIMIT 1")) == 1)
        die('Questo indirizzo email risulta gi&agrave; registrato ad un altro utente');
    // Registrazione dell'utente nel database
    else
    {
        //Inserisco la password in chiaro nella variabile per inviarla via mail.
        $password_mail = $pass;
        // Crypt della password per garantire una miglior sicurezza
        $pass = md5($pass);
       
        
        //Registro la data di registrazione
        $join_date = date("d-m-Y"); 
        // Query per l'inserimento dell'utente nel database
        $strSQL = "INSERT INTO users (name,surname,username,password,mail,city,join_date,lat,lng)";
        $strSQL .= "VALUES('$name','$surname','$user', '$pass', '$mail','$city','$join_date','$lat','$lng')";
        mysql_query($strSQL) OR die("Errore 003, contattare l'amministratore ".mysql_error()); 
        
        $from = 'staff@youbio.info';
        $from_name = 'Staff youbio.info';
        $subject = $name.' registrazione completata.';
        $body = 'Ciao '.$name.' ti sei registrato con successo. Ora puoi collegarsi al nostro sito e creare il tuo orto. Le credenziali per accedere sono: '.user.' la password &egrave; '.$password_mail;
        $to = $mail;
        smtpmailer($to, $from, $from_name, $subject, $body);
        // Reindirizzo l'utente ad una pagina di conferma della registrazione
        header('Location: registrato.php');
        exit;
    }
}
?>