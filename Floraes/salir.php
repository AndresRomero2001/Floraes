<?php

require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/config.php';


if(isset( $_SESSION["logeado"]))
{

unset($_SESSION["logeado"]);
unset($_SESSION["rol"]);
unset($_SESSION["email"]);
session_destroy();
header('Location: index.php');

}

