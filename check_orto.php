<?
// includiamo il file di configurazione
include "include/config.php";
include "include/function.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
  <meta name="description" content="<? echo $meta_description ?>" />
  <meta name="keywords" content="<? echo $meta_keywords ?>" />
  <meta name="author" content="<? echo $meta_author ?>" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
  <title>Orto creato</title>
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
       <?
$id_utente=$_SESSION['login_user'];
$id_ortaggio=$_POST['id_ortaggio'];
$data_semina=$_POST['data_semina'];
//Inserire controllo se non viene passato id_utente la query viene eseguita lo stesso, non va bene
//Query di inserimento
$query="INSERT INTO orto (id_utente, id_ortaggio, data_semina) VALUES ('".$id_utente."','".$id_ortaggio."','".$data_semina."')";
mysql_query($query);
echo "<br>Ciao ".$id_utente." il tuo orto &egrave; stato creato correttamente.<br>";
?>
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
