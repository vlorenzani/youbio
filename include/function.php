<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function smtpmailer($to, $from, $from_name, $subject, $body) { 
        include "include/mail-php/class.phpmailer.php";
	//Impostazioni SMTP
        define('GUSER', 'staff@youbio.info'); // GMail username
        define('GPWD', 'Admq2w3e4'); // GMail password
        global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}

function show_login () {
    $id_utente=$_SESSION['login_user'];
        require('include/config.php');
        if(isset($_SESSION['login']))
         echo '<div id="utente-loggato"><a href="settings.php" title="Le mie impostazioni">'.$id_utente.'</a>| <a href="mp.php" title="I tuoi messaggi privati">Messaggi privati</a>|<a href="logout.php" title"Disconneti">Logout</a><br /></div>';
            else
          //include 'popuplogin.php';
              include "formlogin.php";
            //echo '<a href="registrati.php" title"Registrati subito">Registrazione</a><br /><a href="login.php">Login</a><br />';
}

 function datediff($tipo, $partenza, $fine)
    {
        switch ($tipo)
        {
            case "A" : $tipo = 365;
            break;
            case "M" : $tipo = (365 / 12);
            break;
            case "S" : $tipo = (365 / 52);
            break;
            case "G" : $tipo = 1;
            break;
        }
        $arr_partenza = explode("/", $partenza);
        $partenza_gg = $arr_partenza[0];
        $partenza_mm = $arr_partenza[1];
        $partenza_aa = $arr_partenza[2];
        $arr_fine = explode("/", $fine);
        $fine_gg = $arr_fine[0];
        $fine_mm = $arr_fine[1];
        $fine_aa = $arr_fine[2];
        $date_diff = mktime(12, 0, 0, $fine_mm, $fine_gg, $fine_aa) - mktime(12, 0, 0, $partenza_mm, $partenza_gg, $partenza_aa);
        $date_diff  = floor(($date_diff / 60 / 60 / 24) / $tipo);
        return $date_diff;
    }

function show_ortov3() {
    //$_SESSION['login_user'];
// estraiamo i dati relativi all'id dell'utente
//$id_utente="1";
$id_utente= $_SESSION['login_user'];
//Query SQL SELECT * from orto WHERE id_utente = 'f.lorenzi' ORDER BY data_semina
$sql = "SELECT * from orto WHERE id_utente = '$id_utente' ORDER BY data_semina";
$query = @mysql_query($sql) or die (mysql_error());

//Hello utente
    echo "<br>Il tuo orto &egrave; composto da: <br>";
//verifichiamo che siano presenti records
if(mysql_num_rows($query) > 0){
  // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
  while($row = mysql_fetch_array($query)){
    $id_utente = stripslashes($row['id_utente']);
    $id_ortaggio = stripslashes($row['id_ortaggio']);
    $data_semina = $row['data_semina'];
    echo $id_ortaggio;
    echo " seminati il ".$data_semina;
    //Calcolo la differenza tra la data di semina e la giorna odierna.
    $now = date("d/m/Y");
    $giornidasemina = datediff("G", $data_semina, $now);
    echo " sono trascorsi ".$giornidasemina." giorni dalla semina.";
    
    // Mostra il tempo di raccolto.
    $sql2 = "SELECT tempo_raccolto FROM ortaggi where nome_ortaggio = '$id_ortaggio'";
    $query2 = @mysql_query($sql2) or die (mysql_error());
    $row = mysql_fetch_array($query2);
    $tempo_raccolto = stripslashes($row['tempo_raccolto']);
    //
    $giorniprevisione= $tempo_raccolto - $giornidasemina;
    echo "<br>Il raccolto sarà pronto tra ".$giorniprevisione." giorni (Previsione).";
    echo "<hr>";
  } 
}else{
  // se in tabella non ci sono records...
  echo "Non hai ancora seminato nessun ortaggio.";
}
}    
    
function show_ortov2() {
    //$_SESSION['login_user'];
// estraiamo i dati relativi all'id dell'utente
//$id_utente="1";
$id_utente= $_SESSION['login_user'];
//Query SQL SELECT * from orto WHERE id_utente = 'f.lorenzi' ORDER BY data_semina
$sql = "SELECT * from orto WHERE id_utente = '$id_utente' ORDER BY data_semina";
$query = @mysql_query($sql) or die (mysql_error());

//Hello utente
    echo "<br>Il tuo orto &egrave; composto da: <br>";
//verifichiamo che siano presenti records
if(mysql_num_rows($query) > 0){
  // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
  while($row = mysql_fetch_array($query)){
    $id_utente = stripslashes($row['id_utente']);
    $id_ortaggio = stripslashes($row['id_ortaggio']);
    $data_semina = $row['data_semina'];
    echo $id_ortaggio;
    echo " seminati il ".$data_semina;
    //Calcolo la differenza tra la data di semina e la giorna odierna.
    $now = date("d/m/Y");
    $giornidasemina = datediff("G", $data_semina, $now);
    echo " sono trascorsi ".$giornidasemina." giorni dalla semina.";
    
    // Mostra il tempo di raccolto.
    $sql2 = "SELECT tempo_raccolto FROM ortaggi where id_ortaggio = '1'";
    $query2 = @mysql_query($sql2) or die (mysql_error());
    $row = mysql_fetch_array($query2);
    $tempo_raccolto = stripslashes($row['tempo_raccolto']);
    //
    $giorniprevisione= $tempo_raccolto - $giornidasemina;
    echo "<br>Il raccolto sarà pronto tra ".$giorniprevisione." giorni (Previsione).";
    echo "<hr>";
  } 
}else{
  // se in tabella non ci sono records...
  echo "Non hai ancora seminato nessun ortaggio.";
}
}

//Mostra orto
function show_orto() {
    //$_SESSION['login_user'];
// estraiamo i dati relativi all'id dell'utente
//$id_utente="1";
$id_utente= $_SESSION['login_user'];
//Query SQL SELECT * from orto WHERE id_utente = 'f.lorenzi' ORDER BY data_semina
$sql = "SELECT * from orto WHERE id_utente = '$id_utente' ORDER BY data_semina";
$query = @mysql_query($sql) or die (mysql_error());

//Hello utente
    echo "<br>Il tuo orto &egrave; <br>";

//verifichiamo che siano presenti records
if(mysql_num_rows($query) > 0){
  // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
  while($row = mysql_fetch_array($query)){
    $id_utente = stripslashes($row['id_utente']);
    $id_ortaggio = stripslashes($row['id_ortaggio']);
    $data_semina = $row['data_semina'];

    
    echo $id_ortaggio;
    echo " Seminate il ".$data_semina;
    echo "<hr>";
  } 
}else{
  // se in tabella non ci sono records...
  echo "Non hai ancora seminato nessun ortaggio.";
}
}

function cancellami() {
    $id_utente= $_SESSION['login_user'];
    $sql = "DELETE FROM users where username = '$id_utente';";
    $result = @mysql_query($sql) or die (mysql_error());
    logout();
}

//Count user joined
function countuser () {
$sql = "SELECT * FROM users";
$query = @mysql_query($sql) or die (mysql_error());
$count_user= mysql_num_rows($query);
echo $count_user;
}

function lastuser () {
    $sql="SELECT username FROM users ORDER BY id_user desc Limit 1;";
    $query = @mysql_query($sql) or die (mysql_error());
    $row = mysql_fetch_array($query);
    $userid =$row['username'];
    echo '<a href="profile.php?userid='.$userid.'">'.$userid.'</a>';
}

//Logout- Esegue il logout cancellando la sessione e reinderizza sulla index
function logout () {
session_destroy();
header("Location:index.php");
}

//Check Session
function session () {
    if(!isset($_SESSION['login']))
{
    //echo 'Non sei loggato';
    header('Location: error_login.php');
    exit;
}
}

function show_scheda () {
// controlliamo che sia stato inviato un id numerico alla pagina
if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
  // valorizziamo la variabile relativa all'id dell'articolo e includiamo il file di configurazione
  $id_ortaggio = $_GET['id'];
//Per test  
//$id_ortaggio = '1';

  // selezioniamo dalla tabella i dati relativi all'articolo
  $sql = "SELECT * FROM ortaggi WHERE id_ortaggio='$id_ortaggio'";
  $query = @mysql_query($sql) or die (mysql_error());

  // se per quell'id esiste un articolo..
  if(mysql_num_rows($query) > 0){
    // ...estraiamo i dati e mostriamoli a video
    $row = mysql_fetch_array($query) or die (mysql_error());
    $nome_ortaggio = stripslashes($row['nome_ortaggio']);
    $difficolta = stripslashes($row['difficolta']);
    $clima = stripslashes($row['clima']);
    $tempo_raccolto = stripslashes($row['tempo_raccolto']);
    $descrizione = stripslashes($row['descrizione']);
    $data = $row['data_creazione'];
    
    echo "Nome ortaggio ".$nome_ortaggio;
    echo "<br>Difficolta nella coltivazione ".$difficolta;
    echo "<br>Clima ".$clima;
    echo "<br>Tempo raccolto ".$tempo_raccolto;
    echo "<br>".$descrizione;
    $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);
    echo "| <br>Scheda inserita il <b>" . $data . "</b>"; 
  
    // link alla pagina dei commenti  
    echo "<br><a href=\"insert_comment.php?id=$id_ortaggio\">Invia un commento</a><br><br>";
  }
}else{
  // se per l'id non esiste un articolo..
  echo "Nessun articolo trovato.";
}
 // visualizziamo tutti i commenti
    $sql_com = "SELECT com_autore, com_testo FROM commenti WHERE com_art='$id_ortaggio'";
    $query_com = @mysql_query($sql_com) or die (mysql_error());
    if(mysql_num_rows($query_com) > 0){
      echo "Commenti:<br>";
      while($row_com = mysql_fetch_array($query_com)){
        $com_autore = stripslashes($row_com['com_autore']);
        $com_testo = stripslashes($row_com['com_testo']);
        echo $com_testo . "<br>";
        echo "Inserito da <b>". $com_autore . "</b>";
        echo "<hr>"; 
      }
    }
}

//Funzione che estrae gli articoli del portale
function show_articoli () {

// estraiamo i dati relativi agli ortaggi dalla tabella, limito a 2 devo implementare più pagine
$sql = "SELECT * FROM articoli ORDER BY id_articolo DESC Limit 2";
$query = @mysql_query($sql) or die (mysql_error());

//verifichiamo che siano presenti records
if(mysql_num_rows($query) > 0){
  // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
  while($row = mysql_fetch_array($query)){
    $id_articolo = $row['id_articolo'];
    $sezione = stripslashes($row['sezione']);
    $titolo = stripslashes($row['titolo']);
    $testo = stripslashes($row['testo']);
    $tag = stripslashes($row['tag']);
    $data_creazione = $row['data_creazione'];
    
    //valorizziamo una variabile con il link all'intera scheda
    $link = " <br><a href=\"articolo.php?id=$id_articolo\">Continua a leggere..</a><br>";

    echo "<h3>".$titolo."</h3><br>";
    echo $data_creazione;
    echo " Postato in ".$sezione."<br>";
    anteprima($testo);
    echo "<br>Tag<b> ".$tag."</b><br>";
    
    echo $link;

    // stampiamo una serie di informazioni
    echo  "| Commenti: "; 
  
    // mostriamo il numero di commenti relativi ad ogni articolo
    $conta = "SELECT COUNT(com_id) as conta from commenti WHERE com_art = '$id_ortaggio'";
    $conto = @mysql_query ($conta);
    $tot = @mysql_fetch_array ($conto);
    echo $sum2 = $tot['conta'];
    echo "<hr>";
  } 
}else{
  // se in tabella non ci sono records...
  echo "Nessun articolo inserito.<br> Si prega di contattare lo staff";
}
}

function anteprima ($testo) {
    $limit=100;
    $txt= $testo;
    while($txt[$limit]!=" ")$limit--;
    echo substr($txt,0,$limit);
}


//Funzione che estrae le schede Ortaggi dal db
function listaschede () {

// estraiamo i dati relativi agli ortaggi dalla tabella, limito a 2 devo implementare più pagine
$sql = "SELECT * FROM ortaggi ORDER BY id_ortaggio DESC Limit 2";
$query = @mysql_query($sql) or die (mysql_error());

//verifichiamo che siano presenti records
if(mysql_num_rows($query) > 0){
  // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
  while($row = mysql_fetch_array($query)){
    $id_ortaggio = $row['id_ortaggio'];
    $nome_ortaggio = stripslashes($row['nome_ortaggio']);
    $difficolta = stripslashes($row['difficolta']);
    $clima = stripslashes($row['clima']);
    $tempo_raccolto = stripslashes($row['tempo_raccolto']);
    $descrizione = stripslashes($row['descrizione']);
    $data_creazione = $row['data_creazione'];
    
    //valorizziamo una variabile con il link all'intera scheda
    $link = " <br><a href=\"scheda.php?id=$id_ortaggio\">Apri la scheda</a><br>";

    echo "<h4>".$nome_ortaggio."</h4><br>";
    echo "Livello difficolta ".$difficolta." Da 1 a 5";
    echo "<br>Clima ".$clima;
    echo "<br>Tempo raccolto ".$tempo_raccolto;
    echo "<br>Descrizione ".$descrizione;
    echo "<br><br>";
    echo $link;
    // formattiamo la data nel formato europeo
    $data_creazione = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data_creazione);

    // stampiamo una serie di informazioni
    echo  "| Scheda inserita il <b>" . $data_creazione . "</b>";
    echo  "| Commenti: "; 
  
    // mostriamo il numero di commenti relativi ad ogni articolo
    $conta = "SELECT COUNT(com_id) as conta from commenti WHERE com_art = '$id_ortaggio'";
    $conto = @mysql_query ($conta);
    $tot = @mysql_fetch_array ($conto);
    echo $sum2 = $tot['conta'];
    echo "<hr>";
  } 
}else{
  // se in tabella non ci sono records...
  echo "Nessun ortaggio inserito.<br> Si prega di contattare lo staff";
}
}



function upload_avatar() {
    echo "Invia il tuo avatar";
}


function show_mp() {
 
//$_SESSION['login_user'];
// estraiamo i dati relativi all'id dell'utente
//$id_utente="1";
$id_utente= $_SESSION['login_user'];
//Query SQL SELECT * from orto WHERE id_utente = 'f.lorenzi' ORDER BY data_semina
$sql = "SELECT * from mp WHERE username_recevier = '$id_utente' ORDER BY write_date";
$query = @mysql_query($sql) or die (mysql_error());
    echo "<br>Messaggi privati: <br><br>";

//verifichiamo che siano presenti records
if(mysql_num_rows($query) > 0){
  // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
  while($row = mysql_fetch_array($query)){
    $username_sender = stripslashes($row['username_sender']);
    $object = stripslashes($row['object']);
    $message = stripslashes($row['message']);
    $write_date = stripslashes($row['write_date']);
      
    echo "Da ".$username_sender;
    echo "<br>Inviato il ".$write_date;
    echo "<br>Oggetto ".$object;
    echo "<br>Messaggio:<br>".$message;
   // echo "<br>Rispondi a <a href=\"invia_mp.php?username=$username_sender\">a</a>";
    //echo "<br><a href=\"insert_comment.php?id=$id_ortaggio\">Invia un commento</a><br><br>";
    echo "<hr>";
  } 
}else{
  // se in tabella non ci sono records...
  echo "Non hai nessun messaggio privato.";
}
}

function showcity () {
$username= $_SESSION['login_user'];
$sql = "SELECT city from users WHERE username = '$username'";
$query = @mysql_query($sql) or die (mysql_error());
  while($row = mysql_fetch_array($query)){
    $city= stripslashes($row['city']);
    echo '<br>Citt&agrave; '.$city.'<br>';
  }        
}


function show_avatar () {
    $username= $_SESSION['login_user'];
    $sql= "SELECT avatar_location from users WHERE username = '$username'";
    $query = @mysql_query($sql) or die (mysql_error());
    while($row = mysql_fetch_array($query)){
    $avatar_location= stripslashes($row['avatar_location']);
    echo "<br>";
    //Echo dell'immagine
    echo "<img src=\"http://www.youbio.info/$avatar_location\">"; 
    }
}

//Funzione leggi articolo
function show_articolo () {
// controlliamo che sia stato inviato un id numerico alla pagina
if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
  // valorizziamo la variabile relativa all'id dell'articolo e includiamo il file di configurazione
  $id_articolo = $_GET['id'];
//Per test  
//$id_ortaggio = '1';

  // selezioniamo dalla tabella i dati relativi all'articolo
  $sql = "SELECT * FROM articoli WHERE id_articolo = '$id_articolo'";
  $query = @mysql_query($sql) or die (mysql_error());

  // se per quell'id esiste un articolo..
  if(mysql_num_rows($query) > 0){
    // ...estraiamo i dati e mostriamoli a video
    $row = mysql_fetch_array($query) or die (mysql_error());
    $sezione = stripslashes($row['sezione']);
    $titolo = stripslashes($row['titolo']);
    $testo = stripslashes($row['testo']);
    $tag = stripslashes($row['tag']);
    $data_creazione = $row['data_creazione'];
    
    echo "<b>".$titolo."</b><br>";
    echo "Nella sezione ".$sezione."<br>";
    echo $testo."<br>";
    echo $tag."<br>";
    $data_creazione = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data_creazione);
    echo "<br>Scheda inserita il <b>" . $data_creazione . "</b>"; 
  
    // link alla pagina dei commenti  
    echo "<br><a href=\"insert_comment.php?id=$id_articolo\">Invia un commento</a><br><br>";
  }
}else{
  // se per l'id non esiste un articolo..
  echo "Nessun articolo trovato.";
}
 // visualizziamo tutti i commenti
    $sql_com = "SELECT com_autore, com_testo FROM commenti WHERE com_art='$id_articolo'";
    $query_com = @mysql_query($sql_com) or die (mysql_error());
    if(mysql_num_rows($query_com) > 0){
      echo "Commenti:<br>";
      while($row_com = mysql_fetch_array($query_com)){
        $com_autore = stripslashes($row_com['com_autore']);
        $com_testo = stripslashes($row_com['com_testo']);
        echo $com_testo . "<br>";
        echo "Inserito da <b>". $com_autore . "</b>";
        echo "<hr>"; 
      }
    }
}


function show_profile ($userid) {
    //Descriviti in 140 caratteri
    //http:///it/user/profile?userid=11506
    
 //Provo la funzione con i caratteri   
if(isset($_GET['userid'])){    
    // controlliamo che sia stato inviato un id numerico alla pagina
//if(isset($_GET['userid'])&&(is_numeric($_GET['userid']))){
  // valorizziamo la variabile relativa all'id dell'articolo e includiamo il file di configurazione
$userid = $_GET['userid'];
//Per test  
//$id_ortaggio = '1';

//Show Avatar
    $sql= "SELECT avatar_location from users WHERE username = '$userid'";
    $query = @mysql_query($sql) or die (mysql_error());
    while($row = mysql_fetch_array($query)){
    $avatar_location= stripslashes($row['avatar_location']); 
    }


  // selezioniamo dalla tabella i dati relativi all'articolo
  $sql = "SELECT * FROM users WHERE username = '$userid'";
  $query = @mysql_query($sql) or die (mysql_error());

  // se per quell'id esiste un articolo..
  if(mysql_num_rows($query) > 0){
    // ...estraiamo i dati e mostriamoli a video
    $row = mysql_fetch_array($query) or die (mysql_error());
    $username = stripslashes($row['username']);
    $avatar_location = stripcslashes($row['avatar_location']);
    $about = stripslashes($row['about']);

    //Mostro i dati
    echo "<b>".$username."</b><br>";
     //Echo dell'immagine
    echo "<img src=\"http://www.youbio.info/$avatar_location\">";
    echo "<br>".$about;
    echo "L'orto di ".$username."<br>";
    show_orto_friend($username);
    //Subito dopo funzione che mostra l'orto da creare
  }
}else{
  // se non gli ho passato nessun userid, non mostro profilo.
  header('Location: index.php');
    
}
 // visualizziamo tutti i commenti
    $sql_com = "SELECT com_autore, com_testo FROM commenti WHERE com_art='$id_articolo'";
    $query_com = @mysql_query($sql_com) or die (mysql_error());
    if(mysql_num_rows($query_com) > 0){
      echo "Commenti:<br>";
      while($row_com = mysql_fetch_array($query_com)){
        $com_autore = stripslashes($row_com['com_autore']);
        $com_testo = stripslashes($row_com['com_testo']);
        echo $com_testo . "<br>";
        echo "Inserito da <b>". $com_autore . "</b>";
        echo "<hr>"; 
      }
    }
}

function show_orto_friend($username) {
$sql = "SELECT * from orto WHERE id_utente = '$username' ORDER BY data_semina";
$query = @mysql_query($sql) or die (mysql_error());

//verifichiamo che siano presenti records
if(mysql_num_rows($query) > 0){
  // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
  while($row = mysql_fetch_array($query)){
    $id_utente = stripslashes($row['id_utente']);
    $id_ortaggio = stripslashes($row['id_ortaggio']);
    $data_semina = $row['data_semina'];
    echo $id_ortaggio;
    echo " seminati il ".$data_semina;
    //Calcolo la differenza tra la data di semina e la giorna odierna.
    $now = date("d/m/Y");
    $giornidasemina = datediff("G", $data_semina, $now);
    echo " sono trascorsi ".$giornidasemina." giorni dalla semina.";
    
    // Mostra il tempo di raccolto.
    $sql2 = "SELECT tempo_raccolto FROM ortaggi where id_ortaggio = '1'";
    $query2 = @mysql_query($sql2) or die (mysql_error());
    $row = mysql_fetch_array($query2);
    $tempo_raccolto = stripslashes($row['tempo_raccolto']);
    //
    $giorniprevisione= $tempo_raccolto - $giornidasemina;
    echo "<br>Il raccolto sarà pronto tra ".$giorniprevisione." giorni (Previsione).";
    echo "<hr>";
  } 
}else{
  // se in tabella non ci sono records...
  echo "Non ha ancora seminato nessun ortaggio.";
}
}

?>