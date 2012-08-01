
<?
// includiamo il file di configurazione
include "include/config.php";
include "include/function.php";
session();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
        <title><?echo $titolo2?></title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.21/themes/base/jquery-ui.css" type="text/css" media="all" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js" type="text/javascript"></script>
<script src="http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-it.js" type="text/javascript"></script>
<script>
	$(function() {
		$( "#data_semina" ).datepicker({
    dateFormat:'dd/mm/yy'
  });
	});
	</script>
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
        <h4>Crea il tuo orto</h4>
<form action="check_orto.php" method="post">
Nome ortaggio<br>
<select name="id_ortaggio">
  <option>Basilico</option>
  <option>Carote</option>
  <option>Pomodori</option>
  <option>Lattuga</option>
  <option>Zucchine</option>
</select>
<br>
Data semina:<br>
 <input name="data_semina" type="text" id="data_semina">
 <br>
<input name="submit" type="submit" value="Crea il tuo orto">
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