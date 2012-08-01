<?
// includiamo il file di configurazione
include "include/config.php";
include "include/function.php";
session();
?>
<html>
<head>
<title>Scambia</title>
<link rel="stylesheet" type="text/css" href="css/style.css"></link>
 <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      }
    };

    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(44.0750963, 10.700323),
        zoom: 8,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
      downloadUrl("creaxml.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b> <br/>" + address;
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon,
            shadow: icon.shadow
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>
  </script>
</head>
 <body onload="load()">
    
    <div id="header">
    <?
    include("header.php");
    ?>
    </div>
    <div id="container">
    <div id="content">
        
        <div id="map" style="width: 720px; height: 480px"></div>
        <br>
        Qui puoi inserire i tuoi annunci per scambiare verdure, terreno e strumenti per coltivare.
        <br>
        Pubblica un tuo annuncio <a href="inserisci_annuncio.php">clicca qui</a>
        <br><br>
        
        <?

//$_SESSION['login_user'];
// estraiamo i dati relativi all'id dell'utente
//$id_utente="1";
$id_utente= $_SESSION['login_user'];
//Query SQL SELECT * from orto WHERE id_utente = 'f.lorenzi' ORDER BY data_semina
$sql = "SELECT * from mercato ORDER BY expiry_date";
$query = @mysql_query($sql) or die (mysql_error());

//Hello utente
    echo "<br>Attualmente ci sono questi scambi: <br>";

//verifichiamo che siano presenti records
if(mysql_num_rows($query) > 0){
  // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
  while($row = mysql_fetch_array($query)){
    $username = stripslashes($row['username']);
    $city = stripslashes($row['city']);
    $message = stripslashes($row['message']);
    $write_date = $row['write_date'];
    $expiry_date = $row['expiry_date'];

    //Visualizzo i dati del mercato
    echo "L'utente ".$username."<br>";
    echo $message."<br>";
    echo "Citt&agrave; ".$city;
    echo " Annuncio pubblicato il ".$write_date."<br>";
    echo " L'annuncio scadr&agrave; il ".$expiry_date;
    echo "<hr>";
  } 
}else{
  // se in tabella non ci sono records...
  echo 'Non ci sono scambi in questo momento<br>Crea il tuo annuncio <a href="inserisci_annuncio.php">clicca qui</a>';
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