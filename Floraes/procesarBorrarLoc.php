<?php

require_once __DIR__.'/localizacion.php';

var_dump($_POST);
var_dump($_GET);
$idLoc = $_POST['idLoc'];

echo $idLoc;

echo "rs ".localizacion::borrarLoc($idLoc);

header("Location: index.php");

?>