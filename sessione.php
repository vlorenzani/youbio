<?php 
//dati per il login 
$login_user="m3xican"; 
$pass_user="189bbbb00c5f1fb7fba9ad9285f193d1"; //passwd="prova" 
$redirect="http://localhost/~m3xican/m3xican/su.php"; 
 
//gestione della sessione nel caso in cui i cookie sono disabilitati 
if(IsSet($_POST['PHPSESSID']) && !IsSet($_COOKIE['PHPSESSID'])) 
{ 
  $PHPSESSID=$_POST['PHPSESSID']; 
  header("Location: $redirect?PHPSESSID=$PHPSESSID"); //si ricarica la pagina di login 
} 
 
session_start(); //si inizia o continua la sessione 
 
//controllo user e passwd da login 
if(IsSet($_POST['posted_username']) && IsSet($_POST['posted_password'])) 
{ 
  if($login_user==($_POST['posted_username']) && $pass_user==md5($_POST['posted_password'])) 
    $_SESSION['user']=$_POST['posted_username']; 
} 
 
//creazione cookie per login automatico 
if(IsSet($_POST['ricorda']) && IsSet($_SESSION['user'])) 
{ 
  $cok=md5($login_user)."%%".$pass_user; 
  setcookie("sav_user",$cok,time()+31536000); 
} 
 
//logout 
if($_GET['logout']==1) 
{ 
  $_SESSION=array(); // Desetta tutte le variabili di sessione. 
  session_destroy(); //DISTRUGGE la sessione. 
  if(IsSet($_COOKIE['sav_user'])) //se presente si distrugge il cookie di login automatico 
    setcookie("sav_user",$cok,time()-31536000); 
  header("Location: $redirect"); //si ricarica la pagina di login 
  exit; //si termina lo script in modo da ritornare alla schermata di login 
} 
 
//controllo user e passwd da cookie 
if(IsSet($_COOKIE['sav_user'])) 
{ 
  $info_cok=$_COOKIE['sav_user']; 
  $cok_user=strtok($info_cok,"%%"); 
  $cok_pass=strtok("%%"); 
  setcookie("sav_user",$info_cok,time()+31536000); 
 
  if($cok_user==md5($login_user) && $cok_pass==$pass_user) 
    $_SESSION['user']=$login_user; 
} 
 
//caso in cui si vuole ricordare il login, ma i cookie sono off 
if(!IsSet($_COOKIE['PHPSESSID']) && IsSet($_POST['ricorda'])) 
  header("Location: $redirect?nocookie=1"); 
?> 
<HTML> 
<HEAD> 
</HEAD> 
<BODY> 
<?php 
 
$PHPSESSID=session_id(); 
 
if(!IsSet($_SESSION['user'])) //non siamo loggati, pagina di login 
{ 
  if($_GET['nocookie']==1) //i cookie sono off e si vuole ricordare il login 
    print("Spiacente, ma con i cookie disabilitati non posso fare i miracoli ;)<BR> 
Attivali se vuoi ricordare il tuo login.<BR>"); 
  print("<BR><BR> <FORM METHOD=POST ACTION=\"login.php\"> 
username: 
<INPUT TYPE=TEXT SIZE=20 NAME=posted_username><BR> 
password: 
<INPUT TYPE=PASSWORD SIZE=20 NAME=posted_password><BR> 
ricordami: <INPUT TYPE=CHECKBOX NAME=ricorda VALUE=1><BR><BR> 
<INPUT TYPE=SUBMIT NAME=SUBMIT VALUE=\"Loggami\"><BR>"); 
 
  if(!IsSet($_COOKIE['PHPSESSID'])) //i cookie sono off, dobbiamo propagare noi il PHPSESSID 
    print("<INPUT TYPE=HIDDEN NAME=PHPSESSID VALUE=$PHPSESSID>"); 
  print("</FORM>"); 
} 
else //siamo loggati pagina riservata 
{ 
  $username=$_SESSION['user']; 
  print("Il tuo ID ?: $PHPSESSID <BR><BR>"); 
  print("Sei loggato come: $login_user<BR><BR>"); 
  print("<A HREF=\"login.php?logout=1\">logout</A>"); 
} 
?> 
</BODY> 
</HTML> 