<?php
require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/Comentario.php';

if(isset($_SESSION["logeado"]))
{    
    if(Comentario::borrarComen($_POST["idComen"]))
    {
        $url = "verPlanta.php?idPlanta=".$_POST["idPlanta"]."&idLoc=".$_POST["idLoc"];
        header('Location: '.$url);
    } 

        
}