<?php

// avvio la sessione
if(!isset($_SESSION)) 
{ 
session_start(); 
}  

// Parametri DB

$dbhost = 'localhost';
$dbname = 'orto';
$dbuser = 'orto';
$dbpass = 'password.123';

//
// Inizializza la connessione con il db
//
$connect = @mysql_connect($dbhost, $dbuser, $dbpass);
if (!$connect) {
	die ('Non riesco a connettermi: ' . mysql_error());
}

//Seleziona il database 
$db_selected = mysql_select_db($dbname, $connect);
if (!$db_selected) {
	die ("Errore nella selezione del database: " . mysql_error());
}

// Parametri nome pagine sito
$titolo1 = "Youbio.info Social Network versione beta 0.1";
$titolo2 = "Crea il tuo orto";
$titolo3 = "Visualizza il tuo orto";
$titolo4 = "Impara gli ortaggi";
$titolo5 = "Registrati a Condividi il tuo orto";
$titolo6 = "Messaggi privati";
$titolo7 = "Il mio profilo";
$titolo8 = "Scheda Ortaggio";
$titolo9 = "Diventa Green";
$titolo10 = "Redazione";
$titolo20 = "La tua Dashboard";


//Gestione errori
$error_login = "Effettua il login per entrare";


// Parametri sito
$meta_description = "Youbio.info Un social network tutto verde, dedicato alla coltivazione e alla sostenibilità ambientale. ";
$meta_keywords ="Creare un orto, gestire un orto, ortaggi, verdure, crescere ortaggi";
$meta_author ="Condividi il tuo orto";


$settings['sito']['dominio'] = '';
$settings['sito']['percorso'] = '/var/www/'.$settings['sito']['dominio'].'/';
$settings['sito']['url_ns'] = 'http://www.'.$settings['sito']['dominio'];
$settings['sito']['url'] = $settings['sito']['url_ns'].'/';
$settings['sito']['debug'] = 0;
$settings['sito']['hashsalt'] = '';
$settings['sito']['encrypt_key'] = '';
$settings['sito']['versione'] = '0.4.0';

?>
