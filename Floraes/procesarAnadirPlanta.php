<?php

require_once __DIR__.'/planta.php';
require_once __DIR__.'/Foto.php';
require_once __DIR__.'/localizacionPlantas.php';

$nombre = $_POST['nombre'];
$nombreLatin = $_POST['nombreLatin'];
$otrosNombres = $_POST['otrosNombres'];
$etimologia = $_POST['etimologia'];
$curiosidades = $_POST['curiosidades'];
$parecidos = $_POST['parecidos'];
$floracion = $_POST['floracion'];
$tam = $_POST['tam'];
$localizaciones = $_POST['localizacionesElegidas'];
$idPlanta;

echo $_POST['nombre'];
echo $nombreLatin;
echo $otrosNombres;
echo $etimologia;
echo $curiosidades;
echo $parecidos;
echo $floracion;
echo $tam;
echo "<br>";
echo $localizaciones;
foreach ($localizaciones as $loc) print "You selected $loc<br/>"; 

var_dump($_FILES);



if($idPlanta = Planta::insertarPlanta($nombre, $nombreLatin, $otrosNombres, $etimologia, $curiosidades, $parecidos, $floracion, $tam)) {
    foreach ($localizaciones as $loc) {
        localizacionPlantas::insertarLocPlanta($idPlanta, $loc);
    }


    $foto = $_FILES['miniatura']['name'];

    if($foto != NULL) {
        $fileParts = pathinfo($foto);
        $validExtensions = Array('jpg','png', 'jpeg', 'webp');
        $extension = strtolower($fileParts['extension']);
        if (!in_array($extension, $validExtensions)) {
            echo "ERROR: formato de la imagen invalido";
        } else {
            $dir_subida = 'img/plantas/';
            
            if($idFoto = Foto::insertarFoto($idPlanta, $extension)) {
                echo "SI SE HA PODIDO INSERTAR LA FOTO";
            } else {
                echo "NO SE HA PODIDO INSERTAR LA FOTO";
            }

            $nombreMiniatura = "".$idFoto.".".$extension;
            $fichero_subido = $dir_subida . $nombreMiniatura;

            echo "fichero subido: $fichero_subido ";

            if (move_uploaded_file($_FILES['miniatura']['tmp_name'], $fichero_subido)) {
            echo "El fichero es válido y se subió con éxito.\n";
            } else {
            echo "El fichero no se ha podido mover a la dir $dir_subida, fichero subido: $fichero_subido";
            }
        }

    }

    
    header('Location: index.php');
} else {
    echo '<h1>ERROR: no se ha podido insertar la planta</h1>';
}

?>