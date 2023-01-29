<?php

require_once __DIR__.'/planta.php';
require_once __DIR__.'/localizacionPlantas.php';

$nombre = $_GET['nombre'];
$nombreLatin = $_GET['nombreLatin'];
$otrosNombres = $_GET['otrosNombres'];
$etimologia = $_GET['etimologia'];
$curiosidades = $_GET['curiosidades'];
$parecidos = $_GET['parecidos'];
$floracion = $_GET['floracion'];
$tam = $_GET['tam'];
$localizaciones = $_GET['localizacionesElegidas'];
$idPlanta = $_GET['idPlanta'];
$idLoc = $_GET['idLoc'];

echo $_GET['nombre'];
echo $nombreLatin;
echo $otrosNombres;
echo $etimologia;
echo $curiosidades;
echo $parecidos;
echo $floracion;
echo $tam;
echo "<br>";
/* echo $localizaciones; */
foreach ($localizaciones as $loc) print "You selected $loc<br/>";      

if(Planta::actualizarPlanta($idPlanta, $nombre, $nombreLatin, $otrosNombres, $etimologia, $curiosidades, $parecidos, $floracion, $tam)) {
    localizacionPlantas::borrarLocPlanta($idPlanta);
    // una vez borradas las locs/planta antiguas y modificada la planta, hay q añadir las nuevas locs/plantas
    foreach ($localizaciones as $loc) {
        localizacionPlantas::insertarLocPlanta($idPlanta, $loc);
    }
    
    header("Location: verPlanta.php?idPlanta=$idPlanta&idLoc=$idLoc");
} else {
    echo '<h1>ERROR: no se ha podido insertar la planta</h1>';
}

?>