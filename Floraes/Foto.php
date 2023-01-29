<?php

require_once __DIR__.'/config.php';
require_once __DIR__.'/Aplicacion.php';

class Foto{

    private $id;
    private $idPlanta;
    private $extension;

    public function __construct($id, $idPlanta, $extension) {
        $this->id = $id;
        $this->idPlanta = $idPlanta;
        $this->extension = $extension;
    }

    public static function insertarFoto($idPlanta, $extension) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $extensionFinal = ".".$extension;
        $query = sprintf("INSERT INTO fotos(idPlanta, extension) VALUES('%d', '%s')", $idPlanta, $extensionFinal);
        $rs = $conn->query($query);
        if($rs) return $conn->insert_id;
        else return false;
    }

    public static function borrarFoto($idPlanta, $idFoto) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $query = sprintf("DELETE FROM fotos WHERE idPlanta='%d' AND idFoto='%d'", $idPlanta, $idFoto);
        $rs = $conn->query($query);
        if($rs) return true;
        else return false;
    }
}