<?php
// includiamo il file di configurazione
include "include/config.php";
include "include/function.php";

session();
?>
<html>
<head>
<title>Cosa ne pensi?</title>
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
       <h1>Inserisci un tuo commento:</h1>
<?

$id_utente= $_SESSION['login_user'];
// se sono stati inviati dei parametri valorizziamo con essi le variabili
// per l'inserimento nella tabella
if(isset($_POST['submit'])){
  if(isset($_POST['testo'])){
    $testo = addslashes($_POST['testo']);
  }
  if(isset($_POST['id'])){
    $com_art = addslashes($_POST['id']);
  }

  // popoliamo i campi della tabella commenti con i dati ricevuti dal form
  $sql = "INSERT INTO commenti (com_autore, com_testo, com_art) VALUES ('$id_utente', '$testo', '$com_art')";
  
  // se l'inserimento ha avuto successo inviamo una notifica
  if (@mysql_query($sql) or die (mysql_error())){
    echo "Commento inserito con successo.";
  } 
}else{
  //controlliamo che l'id dell'articolo sia realamente esistente
  if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
    $com_art = addslashes($_GET['id']);
    $sql = "SELECT id_ortaggio FROM ortaggi WHERE id_ortaggio='$com_art'";
    $query = @mysql_query($sql) or die (mysql_error());
    if(mysql_num_rows($query) > 0){
      // se non sono stati inviati dati dal form mostriamo il modulo per l'inserimento
      ?>
<form action="insert_comment.php" method="post">
Inserisci il commento:<br>
<textarea name="testo" cols="40" rows="10"></textarea><br>
<input name="id" type="hidden" value="<? echo $com_art; ?>">
<input name="submit" type="submit" value="Invia">
</form>
      <?
      // se l'id dell'articolo non esiste o non è numerico inviamo delle notifiche
    }else{
      echo "Impossibile inserire un commento.";
    }
  }else{
    echo "Impossibile inserire un commento.";
  }
}
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