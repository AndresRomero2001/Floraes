<?php
require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/planta.php';

class Localizacion{

    private $id;
    private $nombre;
    private $listaPlantas = array();


    public function __construct($id, $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    // no he conseguido que me funcionase con el WHERE nombre = '$n'
    public static function existePorNombre($nombre) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $n = $conn->real_escape_string($nombre);

        $query = sprintf("SELECT * FROM localizacion");
        $rs = $conn->query($query);
        
        if($rs) {
            while($row = mysqli_fetch_assoc($rs)){
                if(strtolower($row['nombre']) == strtolower($n)) return true;
            }
        }
        return false;
    }

    public static function insertarLoc($nombre) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $n = $conn->real_escape_string($nombre);

        $query = sprintf("INSERT INTO localizacion (nombre) 
                            VALUES('$n')");
        $rs = $conn->query($query);
        if($rs) return true;
        else return false;
    }

    public static function borrarLoc($idLoc) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $query = sprintf("DELETE FROM localizacion WHERE id='$idLoc'");
        $rs = $conn->query($query);
        if($rs) {
            echo $rs;
            return true;
        }
        else return false;
    }

    public static function getListaLocalizaciones()
    {
        $listaLoc = array();
        $listaPlant = Planta::getListaPlantas();
        

        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $query = sprintf("SELECT * FROM localizacion");
        $rs = $conn->query($query);
        if($rs) {
            //$listaPlantas = array();
            // $listaLocalizaciones = array();
            while($row = mysqli_fetch_assoc($rs)){//recorremos todas las localizaciones
                $lo = new Localizacion($row['id'], $row['nombre']);

                //cogemos los id de las plantas de dicha localizacion
                $query = sprintf("SELECT * FROM localizacion_plantas WHERE idLocalizacion = %d", $conn->real_escape_string($row['id']));
                $rs2 = $conn->query($query);
                if($rs2)
                {
                    $listaPlantas2 = array();
                    while($row2 = mysqli_fetch_assoc($rs2)){//recorremos todos los id de plantas asociados a una localizacion
                        $planta = $listaPlant[$row2['idPlanta']];
                        $listaPlantas2 [] = $planta;
                    }

                    $lo->setListaPlantas($listaPlantas2);//metemos la lista de plantas de la localizacion
                    $listaLoc[$lo->getId()] = $lo; //metemos la localizacion a la lista
                }
            }  
        }

        return $listaLoc;
    }

    static function getLocById($idLoc){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $query = sprintf("SELECT * FROM localizacion WHERE id = '$idLoc'");
        $rs = $conn->query($query);
        if($rs) {
            $row = mysqli_fetch_assoc($rs);
            $loc = new Localizacion($row['id'], $row['nombre']);
            return $loc;
        }
        return false;
    }

    public static function getNombreById($idLoc) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $query = sprintf("SELECT * FROM localizacion WHERE id = '$idLoc'");
        $rs = $conn->query($query);
        if($rs) {
            $row = mysqli_fetch_assoc($rs);
            return $row['nombre'];
        }
        return false;
    }


    public function setListaPlantas($listaPlantas)
    {
        $this->listaPlantas = $listaPlantas;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getListaPlantas()
    {
        return $this->listaPlantas;
    }
}