<?php




class comentario{

    private $email;
    private $desc;
    private $id;


    public function __construct($id, $email, $desc)
    {
        $this->id = $id;
        $this->email = $email;
        $this->desc = $desc;

    }


    public static function getComentariosPlanta($idPlanta)
    {
        $comentarios = array();
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM comentarios WHERE idPlanta='%d'", $idPlanta);

        $rs = $conn->query($query);
        if($rs) {
            //$listaPlantas = array();
        
            while($row = mysqli_fetch_assoc($rs)){
                $com = new Comentario($row['id'], $row['email'], $row['descripcion']);
               $comentarios[] = $com;
                
                //echo " -- {$row['nombreLa']} -- ";
                /* $p = new Planta($row['id'], $row['nombreEs'], $row['nombreLa'], $row['otrosNombres'], $row['etimologia'], $row['curiosidades'], $row['parecidos'], $row['floracion'], $row['tam']);//new Categoria($row['id'], $row['nombre']);
                $listaPlantas[$row['id']] =  $p; */
               
            }
        }
        return $comentarios;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function getId()
    {
        return $this->id;
    }


    public static function nuevoComentario($idPlanta, $email, $desc)
    {
        /* $url = "verPlanta.php?idPlanta=".$_POST["idPlanta"]."&idLoc=".$_POST["idLoc"]; */
        /* INSERT INTO usuarios(email, contra, rol, nombre) VALUES('%s', '%s', '%s', '%s') */
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("INSERT INTO comentarios (idPlanta, email, descripcion) VALUES ('%d', '%s', '%s')",
                $conn->real_escape_string($idPlanta),
                $conn->real_escape_string($email),
                $conn->real_escape_string($desc));
    
        $rs = $conn->query($query);
        if($rs) {
            //$listaPlantas = array();
        
           /*  while($row = mysqli_fetch_assoc($rs)){
                $com = new Comentario($row['email'], $row['descripcion']);
               $comentarios[] = $com; */
               return true;
              /*  header('Location: '.$url); */
                //echo " -- {$row['nombreLa']} -- ";
                /* $p = new Planta($row['id'], $row['nombreEs'], $row['nombreLa'], $row['otrosNombres'], $row['etimologia'], $row['curiosidades'], $row['parecidos'], $row['floracion'], $row['tam']);//new Categoria($row['id'], $row['nombre']);
                $listaPlantas[$row['id']] =  $p; */
               
        }

        return false;
    }


    public static function borrarComen($idCom)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("DELETE FROM comentarios WHERE id = '%d'",
                $conn->real_escape_string($idCom));
    
        $rs = $conn->query($query);
        if($rs) {
          
               return true;
               
        }
    }





    
}