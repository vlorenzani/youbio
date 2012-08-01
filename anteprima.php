<?
function anteprima($testo, $lunghezza, $finale) {
return (count($parole = explode(' ', $testo)) > $lunghezza) ? implode(' ', array_slice($parole, 0, $lunghezza)) . $finale : $testo;
}
?>