<?php

require_once __DIR__.'/Foto.php';

$idPlanta = $_POST['idPlanta'];
$idFoto = $_POST['idFoto'];
$idLoc = $_POST['idLoc'];

echo $idPlanta;
echo "<br>";
echo $idFoto;   
echo $idLoc;

if(Foto::borrarFoto($idPlanta, $idFoto)) {
    header("Location: verPlanta.php?idPlanta=$idPlanta&idLoc=$idLoc");
} else {
    echo "ERROR: no se ha podido borrar la foto";
}


?>