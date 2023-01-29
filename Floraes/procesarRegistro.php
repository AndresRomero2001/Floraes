<?php
require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/Usuario.php';

$email = $_POST['email'];
$nombre = $_POST['nombre'];
$password = $_POST['contra'];

if($u = Usuario::crea($email, $password, "Usuario", $nombre)) {
    $_SESSION["logeado"] = true;
    $_SESSION["rol"] = $u->getRol();
    $_SESSION["email"] = $u->getEmail();
    header('Location: index.php');
} else {
    echo "ERROR: el email ya está registrado ";
}