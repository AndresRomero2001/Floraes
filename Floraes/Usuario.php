<?php 


class Usuario{

  // public $nombre;

   

 //  public $contra;

   //public $rol;

    private $email;
    private $nombre;
    private $password;

    private $rol;



   private function __construct($email, $password, $rol, $nombre)
   {
      
       $this->email = $email;
       $this->password = $password;
       $this->rol = $rol;
       $this->nombre = $nombre;
   }

   public static function login($email, $password)
   {
       $usuario = self::buscaUsuario($email);
      /* if ($usuario && $usuario->compruebaPassword($password)) //modo con cifrado de contrasenias*/
       if($usuario && $password == $usuario->password) //modo sin cifrado de contrasenias
       { 
           return $usuario;
       }
       return false;
   }

   public static function buscaUsuario($email)
   {
       $app = Aplicacion::getInstancia();
       $conn = $app->conexionBd();
       $query = sprintf("SELECT * FROM usuarios U WHERE U.email = '%s'", $conn->real_escape_string($email));
       $rs = $conn->query($query);
       $result = false;
       if ($rs) {
           if ( $rs->num_rows == 1) {
               $fila = $rs->fetch_assoc();
               $user = new Usuario($fila['email'], $fila['contra'], $fila['rol'], $fila['nombre']);
              
               $result = $user;
           }
           $rs->free();
       } else {
           echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
           exit();
       }
       return $result;
   }



  /*  public static function buscaUsuarioPorId($idU)
   {
       $app = Aplicacion::getInstancia();
       $conn = $app->conexionBd();
       $query = sprintf("SELECT * FROM usuarios U WHERE U.id = '%s'", $conn->real_escape_string($idU));
       $rs = $conn->query($query);
       $result = false;
       if ($rs) {
           if ( $rs->num_rows == 1) {
               $fila = $rs->fetch_assoc();
               $user = new Usuario($fila['nombre'], $fila['email'], $fila['contrasenia'], $fila['rol'], $fila['direccion'], $fila['telefono']);
               $user->id = $fila['id'];
               $result = $user;
           }
           $rs->free();
       } else {
           echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
           exit();
       }
       return $result;
   } */

   /**
    * Devuelve el usuario creado si ha ido bien y false si no
    * DEBUG: por ahora guarda las contraseñas sin cifrar por comodidad
    */
   public static function crea($email, $password, $rol, $nombre)
   {
       $user = self::buscaUsuario($email);
       if ($user) {
           return false;
       }
       $user = new Usuario($email, $password/*self::hashPassword($password)*/, $rol, $nombre);
       return self::guarda($user);
   }
   
   private static function hashPassword($password)
   {
       return password_hash($password, PASSWORD_DEFAULT);
   }

   public static function guarda($usuario)
   {
       if ($usuario->id !== null) {
           return self::actualiza($usuario);
       }
       return self::inserta($usuario);
   }

   private static function inserta($usuario)
   {
       $app = Aplicacion::getInstancia();
       $conn = $app->conexionBd();
       $query=sprintf("INSERT INTO usuarios(email, contra, rol, nombre) VALUES('%s', '%s', '%s', '%s')"
           , $conn->real_escape_string($usuario->email)
           , $conn->real_escape_string($usuario->password)
           , $conn->real_escape_string($usuario->rol)
            , $conn->real_escape_string($usuario->nombre));
       if ( $conn->query($query) ) {
           
       } else {
           echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
           exit();
       }
       return $usuario;
   }
   
   private static function actualiza($usuario)
   {
       $result = false;
       $app = Aplicacion::getInstancia();
       $conn = $app->conexionBd();
       $query=sprintf("UPDATE usuarios U SET  contra='%s', rol='%s' WHERE U.email=%s"
            , $conn->real_escape_string($usuario->password)
           , $conn->real_escape_string($usuario->rol)
           , $conn->real_escape_string($usuario->email));
       if ( $conn->query($query) ) {
           if ( $conn->affected_rows != 1) {
               echo "No se ha podido actualizar el usuario: ";
           }
           else{
               $result = $usuario;
           }
       } else {
           echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
       }
       
       return $result;
   }
  
   private static function borra($usuario)
   {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        //$query = sprintf("DELETE FROM usuarios U WHERE U.id = %d", $idUsuario);
        //$query = sprintf("DELETE FROM usuarios U WHERE U.id = %d", $conn->real_escape_string($idUsuario));
        $query = sprintf("DELETE FROM usuarios WHERE usuarios.email = %s", $conn->real_escape_string($usuario->getEmail()));
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
       //return self::borraPorId($usuario->id);
   }
   
   /* public static function borraPorId($idUsuario)
   {
       if (!$idUsuario) {
           return false;
       } 

       $app = Aplicacion::getInstancia();
       $conn = $app->conexionBd();
       //$query = sprintf("DELETE FROM usuarios U WHERE U.id = %d", $idUsuario);
       //$query = sprintf("DELETE FROM usuarios U WHERE U.id = %d", $conn->real_escape_string($idUsuario));
       $query = sprintf("DELETE FROM usuarios WHERE usuarios.id = %s", $conn->real_escape_string($idUsuario));
       if ( ! $conn->query($query) ) {
           error_log("Error BD ({$conn->errno}): {$conn->error}");
           return false;
       }
       return true;
   } */


   public function getEmail()
   {
       return $this->email;
   }

   public function getRol()
   {
       return $this->rol;
   }
  

  
  



   public function compruebaPassword($password)
   {
       return password_verify($password, $this->password);
   }

   public function cambiaPassword($nuevoPassword)
   {
       // $this->password = $nuevoPassword; //por ahora sin cifrar
       $this->password = self::hashPassword($nuevoPassword);
   }
   
   public function borrate()
   {
       if ($this->id !== null) {
           return self::borra($this);
       }
       return false;
   }




}





?>