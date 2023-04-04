<?php

require_once "Conexion.php";

//  MODELO = contiene la lógica
//  extends : HERENCIA (POO)  en PHP
class Curso extends Conexion{
  //  Objeto que almacene la conexión que viene desde el padre(Conexion)
  //  y la compartirá con todos los métodos(CRUD+)
  private $accesoBD;

  //  Constructor
  public function __CONSTRUCT(){  
    $this->accesoBD = parent::getConexion();
  
  }


  //  Método listar cursos
  public function listarCursos(){
    try {
      //  1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_cursos_listar()");
      //  2. Ejecutamos la consulta
      $consulta->execute();
      //  3. Devolvemos el resulatado
      return $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  //  Método registrar curso
  public function registrarCurso($datos = []){
    try {
      //  PASO 1: Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_cursos_registrar(?,?,?,?,?)");
      //  PASO 2: Ejecutamos la consulta
      $consulta->execute(
        array(
          $datos["nombrecurso"],
          $datos["especialidad"],
          $datos["complejidad"],
          $datos["fechainicio"],
          $datos["precio"]
      )
    );

    } catch (Exception $e) {
      die($e ->getMessge());
    }

  }

  //  Método eliminar curso
  public function eliminarCurso($idcurso = 0){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_cursos_eliminar(?)");
      $consulta->execute(array($idcurso));
    } catch (Exception $e) {
      die($e->getMessage());
    }
    

  }

  //  Método actualizar curso
  public function actualizarCurso(){

  }
}
?>