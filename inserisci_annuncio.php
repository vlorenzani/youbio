<?
// includiamo il file di configurazione
include "include/config.php";
if(!isset($_SESSION['login']))
{
    //echo 'Non sei loggato';
    header('Location: error_login.php');
    exit;
}
?>
<html>
<head>
<title>Inserisci annuncio</title>
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
        <script type="text/javascript">
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(mia_posizione);
}else{
  alert('La geo-localizzazione NON è possibile');
}

function mia_posizione(position) {
  var lat = position.coords.latitude;
  var lng = position.coords.longitude;
  document.getElementById('posizione').innerHTML = 'La tua posizione: ' + lat + ',' + lng;  
}
</script>
        
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
        <h4>Inserisci annuncio di scambio</h4>
<form action="check_annuncio.php" method="post">
    <input name="lat" type="text" size="30">
    <input name="lng" type="text" size="30">
    <div id="posizione"></div>
Citt&agrave;<br>
<input name="city" type="text" size="30"><br>
Annuncio<br>
<textarea name="annuncio" cols="40" rows="10"></textarea><br>
Data scadenza annuncio<br>
 <input name="expiry_date" type="text" id="data_semina">
 <br>
<input name="submit" type="submit" value="Pubblica annuncio">
</form>
    </div>
</div>   
    <div id="footer">
     <?
    include("footer.php");
    ?>
</div>
</body>
</html>