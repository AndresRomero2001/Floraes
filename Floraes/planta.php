<?php

require_once __DIR__.'/config.php';
require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/Comentario.php';

class Planta{

    private $id;
    private $nombreEs;
    private $nombreLa;
    private $otrosNombres;
    private $etimologia;
    private $curiosidades;
    private $parecidos;
    private $floracion;
    private $tam;

    private $idsFotos = array();

    private $comentarios = array(); //calve email usuario y valor el comentario


    public function __construct($id, $nombreEs, $nombreLa, $otrosNombres, $etimologia, $curiosidades, $parecidos, $floracion, $tam)
    {
        $this->id = $id;
        $this->nombreEs = $nombreEs;
        $this->nombreLa = $nombreLa;
        $this->otrosNombres = $otrosNombres;
        $this->etimologia = $etimologia;
        $this->curiosidades = $curiosidades;
        $this->parecidos = $parecidos;
        $this->floracion = $floracion;
        $this->tam = $tam;

        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM fotos WHERE idPlanta='%d'", $id);

        $idsF = array();

        $rs = $conn->query($query);
        if($rs) {
            $cont = 0;
            while($row = mysqli_fetch_assoc($rs)){
                $idsF[$row['idFoto']] = "".$row['idFoto'].$row['extension'];
                /* if($cont>0) $idsF[$row['idFoto']] = "".$row['idFoto'].$row['extension'];
                else {
                    $idsF[] = "".$row['idFoto'].$row['extension'];
                    $cont++;
                } */
                
            }
        }
        $this->idsFotos = $idsF;

        $this->comentarios = Comentario::getComentariosPlanta($id);
    }

    public static function insertarPlanta($nombreEs, $nombreLa, $otrosNombres, $etimologia, $curiosidades, $parecidos, $floracion, $tam) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

       // $nombre = $conn->real_escape_string($nombreEs);

        $query = sprintf("INSERT INTO plantas (nombreEs, nombreLa, otrosNombres, etimologia, curiosidades, parecidos, 
                        floracion, tam) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                         $conn->real_escape_string($nombreEs),
                         $conn->real_escape_string($nombreLa),
                         $conn->real_escape_string($otrosNombres),
                         $conn->real_escape_string($etimologia),
                         $conn->real_escape_string($curiosidades),
                         $conn->real_escape_string($parecidos),
                         $conn->real_escape_string($floracion),
                         $conn->real_escape_string($tam));
        $rs = $conn->query($query);
        if($rs) return $conn->insert_id;
        else return false;
    }

    public static function actualizarPlanta($id, $nombreEs, $nombreLa, $otrosNombres, $etimologia, $curiosidades, $parecidos, $floracion, $tam) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $nombre = $conn->real_escape_string($nombreEs);

        $query = sprintf("UPDATE plantas 
                        SET nombreEs = '%s', nombreLa = '%s', otrosNombres = '%s',
                            etimologia = '%s', curiosidades='%s', parecidos='%s', 
                            floracion = '%s', tam='%d'
                        WHERE id = '%d'", 
                        $conn->real_escape_string($nombreEs),
                        $conn->real_escape_string($nombreLa),
                        $conn->real_escape_string($otrosNombres),
                        $conn->real_escape_string($etimologia),
                        $conn->real_escape_string($curiosidades),
                        $conn->real_escape_string($parecidos),
                        $conn->real_escape_string($floracion),
                        $conn->real_escape_string($tam),
                        $conn->real_escape_string($id));
        $rs = $conn->query($query);
        if($rs) return true;
        else return false;
    }

    public static function borrarPlanta($idPlanta) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        // borramos las fotos de la planta de la carpeta img/plantas
        $query2 = sprintf("SELECT * FROM fotos WHERE idPlanta='$idPlanta'");
        $rs2 = $conn->query($query2);
        if($rs2) {
            while($row = mysqli_fetch_assoc($rs2)){
                if(unlink("img/plantas/".$row['idFoto'].$row['extension'])){
                    echo " borrado correctamente ";
                } else {
                    echo " no se ha podido borrar ";
                }
            }
        }

        $query = sprintf("DELETE FROM plantas WHERE id='$idPlanta'");
        $rs = $conn->query($query);
        if($rs) return true;
        else return false;
    }

    public static function borrarPlantaEnLoc($idPlanta, $idLoc) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $query2 = sprintf("SELECT count(*) as totalLocs FROM localizacion_plantas WHERE idPlanta='$idPlanta'");
        $rs2 = $conn->query($query2);
        if($rs2) {
            $data=mysqli_fetch_assoc($rs2);
            if($data['totalLocs'] == 1) {
                echo " solo hay 1 loc ";
                Planta::borrarPlanta($idPlanta);
                return true;
            } else {
                echo " hay mas de 1 loc ";
                $query = sprintf("DELETE FROM localizacion_plantas WHERE idPlanta='$idPlanta' AND idLocalizacion='$idLoc'");
                $rs = $conn->query($query);
                if($rs) return true;
                else return false;
            }
        }
        
    }

    public static function getListaPlantas()
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM plantas");
        $listaPlantas = array();
        // $queryLocalizaciones = sprintf("SELECT * FROM plantas");
            $rs = $conn->query($query);
            if($rs) {
                //$listaPlantas = array();
            
                while($row = mysqli_fetch_assoc($rs)){
                    //echo " -- {$row['nombreLa']} -- ";
                    $p = new Planta($row['id'], $row['nombreEs'], $row['nombreLa'], $row['otrosNombres'], $row['etimologia'], $row['curiosidades'], $row['parecidos'], $row['floracion'], $row['tam']);//new Categoria($row['id'], $row['nombre']);
                    $listaPlantas[$row['id']] =  $p;
                   
                }
            }
            return $listaPlantas;
    }

    public static function getPlantaById($id) {
        $p = null;
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM plantas WHERE id='%d'", $id);
        $rs = $conn->query($query);
        if($rs) {
            $row = mysqli_fetch_assoc($rs);
            $p = new Planta($row['id'], $row['nombreEs'], $row['nombreLa'], $row['otrosNombres'], $row['etimologia'], $row['curiosidades'], $row['parecidos'], $row['floracion'], $row['tam']);
        }
        return $p;
    }

    public function setIdsFotos($ids = array())
    {
        $this->idsFotos = $ids;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreEs()
    {
        return $this->nombreEs;
    }

    public function getNombreLa()
    {
        return $this->nombreLa;
    }

    public function getTam(){
        return $this->tam;
    }

    public function getOtrosNombres(){
        return $this->otrosNombres;
    }

    public function getEtimologia(){
        return $this->etimologia;
    }

    public function getCuriosidades(){
        return $this->curiosidades;
    }

    public function getParecidos(){
        return $this->parecidos;
    }

    public function getFloracion(){
        return $this->floracion;
    }

    public function getIdsFotos()
    {
        return $this->idsFotos;
    }

    public function getComentarios()
    {
        return $this->comentarios;
    }
}