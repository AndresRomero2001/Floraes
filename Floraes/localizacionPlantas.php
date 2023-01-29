<?php

require_once __DIR__.'/config.php';
require_once __DIR__.'/Aplicacion.php';

class localizacionPlantas{

    private $id;
    private $idPlanta;
    private $idLocalizacion;

    public function __construct($id, $idPlanta, $idLocalizacion)
    {
        $this->id = $id;
        $this->idPlanta = $idPlanta;
        $this->idLocalizacion = $idLocalizacion;
    }

    public static function insertarLocPlanta($idPlanta, $idLocalizacion) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $query = sprintf("INSERT INTO localizacion_plantas (idPlanta, idLocalizacion) 
                            VALUES('%d', '%d')", $idPlanta, $idLocalizacion);
        $rs = $conn->query($query);
        if($rs) return true;
        else return false;
    }

    public static function borrarLocPlanta($idPlanta) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        /* $query = sprintf("DELETE FROM localizacion_plantas 
                          WHERE idPlanta = '$idPlanta' AND idLocalizacion = '$idLoc' "); */
        $query = sprintf("DELETE FROM localizacion_plantas 
                            WHERE idPlanta = '$idPlanta'");
        $rs = $conn->query($query);
        if($rs) return true;
        else return false;
    }

    public static function getLocsPlanta($idPlanta) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $query = sprintf("SELECT * FROM localizacion_plantas 
                          WHERE idPlanta = '$idPlanta'");
        $rs = $conn->query($query);
        if($rs) {
            $listaLocs;
            while($row = mysqli_fetch_assoc($rs)){
                $listaLocs[] = $row['idLocalizacion'];
            }
            return $listaLocs;
        }
        else return false;
    }
}