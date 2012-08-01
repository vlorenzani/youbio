<?php
   $toscana = array("Arezzo","Massa Carrara", "Firenze","Grosseto","Livorno",
                    "Lucca","Pisa","Pistoia","Prato","Siena");
   echo "Le province della Toscana sono:<br><i>";
   for( $i = 0; $i < 10; $i = $i + 1 ) {
     echo "$toscana[$i]<br>";
}
   echo "</i>";
?>

<?php
    echo date("d/m/y")."<br>";
    echo date("d/m/Y")."<br>";
?>