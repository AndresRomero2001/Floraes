<?php
require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/Usuario.php';
require_once __DIR__.'/Comentario.php';

if(isset($_SESSION["logeado"]))
{    
    if(Comentario::nuevoComentario($_POST["idPlanta"], $_SESSION["email"], $_POST["coment"]))
    {
        $url = "verPlanta.php?idPlanta=".$_POST["idPlanta"]."&idLoc=".$_POST["idLoc"];
        header('Location: '.$url);
    }
   /*  $url = "verPlanta.php?idPlanta=".$_POST["idPlanta"]."&idLoc=".$_POST["idLoc"];
    // INSERT INTO usuarios(email, contra, rol, nombre) VALUES('%s', '%s', '%s', '%s')
    $app = Aplicacion::getInstancia();
    $conn = $app->conexionBd();
    $query = sprintf("INSERT INTO comentarios (idPlanta, email, descripcion) VALUES ('%d', '%s', '%s')",
            $conn->real_escape_string($_POST["idPlanta"]),
            $conn->real_escape_string($_SESSION["email"]),
            $conn->real_escape_string($_POST["coment"]));

    $rs = $conn->query($query);
    if($rs) {
        //$listaPlantas = array();

           header('Location: '.$url);

           
    } */
  

        
} 