
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
  <title><? echo $titolo4 ?></title>
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
             <h4>Impariamo gli ortaggi</h4>
<?
    listaschede();
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