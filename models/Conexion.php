<?php

//  Esta clase, le permitirá a los modelos acceder y consumir los datos
class Conexion{

  //  Atributos
  private $host = "localhost";    //  Servidor
  private $port = "3306";         //  Puerto comunicación DB
  private $database = "senati";   //  Nombre DB
  private $charset = "UTF8";     //  Codificación (idioma)
  private $user = "root";         //  Usuario (raíz)
  private $password = "";         //  contraseña
  
  //  Atributo (instancia PDO) que almacena la conexión
  private $pdo;

  //  Método 1: Acceder a la BD
  private function connectServer(){
    //  Constructor:
    //  new PDO("CADENA_CONEXION","USER", "PASSWORD")
    $conexion = new PDO(
      "mysql:host={$this->host};
      port={$this->port};
      dbname={$this->database};
      charset={$this->charset}",
      $this->user,
      $this->password);

    return $conexion;
  }

  //  Método 2: Retorna el acceso
  public function getConexion(){
    try{

        // Pasaremos la conexión al atributo/objeto $pdo
        $this->pdo  = $this->connectServer();

        //  Controlar los errores
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->pdo;
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

}

?>