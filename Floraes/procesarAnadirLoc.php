<?php

require_once __DIR__.'/localizacion.php';

$nombre = $_POST['nombreLoc'];

echo $nombre;

/* echo localizacion::existePorNombre($nombre); */
$r = localizacion::existePorNombre($nombre);
if($r) {
    echo "ERROR: la loc ya existe"; 
} else {
    localizacion::insertarLoc($nombre);
    echo "loc añadida correctamente"; 
}

header("Location: index.php");

?>