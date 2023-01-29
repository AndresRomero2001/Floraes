<?php

require_once __DIR__.'/Foto.php';

$idPlanta = $_POST['idPlanta'];
$idLoc = $_POST['idLoc'];
echo $idPlanta ." ";

var_dump($_FILES);

$foto = $_FILES['foto']['name'];

if($foto != NULL) {
    $fileParts = pathinfo($foto);
    $validExtensions = Array('jpg','png', 'jpeg', 'webp');
    $extension = strtolower($fileParts['extension']);
    if (!in_array($extension, $validExtensions)) {
        echo "ERROR: formato de la imagen invalido";
        echo "-- $extension --";
    } else {
        $dir_subida = 'img/plantas/';
        
        if($idFoto = Foto::insertarFoto($idPlanta, $extension)) {
            echo "SI SE HA PODIDO INSERTAR LA FOTO";
        } else {
            echo "NO SE HA PODIDO INSERTAR LA FOTO";
        }

        $nombreFoto = "".$idFoto.".".$extension;
        $fichero_subido = $dir_subida . $nombreFoto;

        echo "fichero subido: $fichero_subido ";

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido)) {
        echo "El fichero es válido y se subió con éxito.\n";
        } else {
        echo "El fichero no se ha podido mover a la dir $dir_subida, fichero subido: $fichero_subido";
        }
    }

}
    //?idPlanta=56&idLoc=2
    /* header('Location: plantas.php?idPlanta=' + $idPlanta + '&idLoc=' + $idLoc); */
    header("Location: verPlanta.php?idPlanta=$idPlanta&idLoc=$idLoc");

?>