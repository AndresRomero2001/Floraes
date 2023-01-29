<?php

require_once __DIR__.'/planta.php';
require_once __DIR__.'/localizacionPlantas.php';

$idPlanta = $_GET['idPlanta'];
$idLoc;
if(isset($_GET['idLoc'])) $idLoc = $_GET['idLoc'];


echo $_GET['idPlanta'];
echo "<br>";   

// si idLoc va en la URL es q se quiere borrar la planta de una loc específica, si no está
// es que se quiere borrar de todas las locs
if(isset($_GET['idLoc'])) {
    if(Planta::borrarPlantaEnLoc($idPlanta, $idLoc)) { 
        echo "borrando solo la de localizacion ";
        echo $idPlanta;
        echo $idLoc;
        header('Location: index.php');
    } else { 
        echo '<h1>ERROR: no se ha podido borrar la planta</h1>';
    }
} else {
    if(Planta::borrarPlanta($idPlanta)) { 
        echo "borrando todas ";
        echo $idPlanta;
        header('Location: index.php');
    } else {
        echo '<h1>ERROR: no se ha podido insertar la planta</h1>';
    }
}


?>