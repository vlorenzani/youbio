
<?
// includiamo il file di configurazione
include "include/config.php";
include "include/function.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
  <title><? echo $titolo5 ?></title>
</head>
<body>
<div id="header">
    <? include "header.php" ?>
    <div id="login"><? show_login()?></div>
</div>
    <div id="menu"> <? include "navigation.php" ?>
    </div>
<div id="contenitore">
	<div id="contenuto">
             
<form action="check_registrati.php" method="post" id="registrati">
     <! Passo variabili lat e lng al check>
     <input name="lat" type="hidden" id="lat" value="lat" onfocus="if(this.value=='lat') this.value='';" />
     <input name="lng" type="hidden" id="lng" value="lng" onfocus="if(this.value=='lng') this.value='';" />
 Inserisci il tuo nome
 <input name="name" type="text" id="name" value="Nome" onfocus="if(this.value=='Nome') this.value='';" /><br />
  Inserisci il tuo cognome
 <input name="surname" type="text" id="surname" value="Cognome" onfocus="if(this.value=='Cognome') this.value='';" /><br />
 Inserisci la username
 <input name="user" type="text" id="user" value="Nome Utente" onfocus="if(this.value=='Nome Utente') this.value='';" /><br />
 Inserisci la tua password
 <input name="pass" type="password" id="pass" value="Password" onfocus="if(this.value=='Password') this.value='';" /><br />
 Inserisci il tuo indirizzo email
 <input name="mail" type="text" id="mail" value="Em@il" onfocus="if(this.value=='Em@il') this.value='';" /><br />
 Citta
 <input name="city" type="text" id="city" value="Città" onfocus="if(this.value=='Città') this.value='';" /><br />
 <input name="registra" type="submit" value="Registrati" /><br />
</form>
	</div>
	<div id="widget">
		<h2>Widget</h2>
	</div>
</div> <!-- fine ricetta esterno -->
<div id="user_info"><? include 'info.php'; ?>
</div>

<div id="footer">
	  <?
    include("footer.php");
    ?>
</div>
</body>
</html>