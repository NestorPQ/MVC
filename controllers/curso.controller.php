<?php

require_once '../models/Cursos.php';

if (isset($_POST['operacion'])){

  $curso = new Curso();

  if ($_POST['operacion'] == 'listar'){
    $datosObtenidos = $curso ->listarCursos();
    //  En esta ocasión NO enviaremos un objero JSON, en su lugar
    //  el controlador renderizará las filas que necesita <tbody></tbodt>
    //  echo json_encode($datosObtenidos);


    //PASO 1: Verificar que el objeto contenga datos
    if ($datosObtenidos) {
      $numeroFila = 1;
      //  PASO 2: Recorrer todo el objeto
      foreach($datosObtenidos as $curso){
        //  PASO3 3: Ahora construimos las filas
        echo "
        <tr>
          <td>{$numeroFila}</td>
          <td>{$curso['nombrecurso']}</td>
          <td>{$curso['especialidad']}</td>
          <td>{$curso['complejidad']}</td>
          <td>{$curso['fechainicio']}</td>
          <td>{$curso['precio']}</td>
          <td>
            <a href='#' data-idcurso='{$curso['idcurso']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash'></i></a>

            <a href='#' data-idcurso='{$curso['idcurso']}' class='btn btn-success btn-sm editar'><i class='bi bi-pencil'></i></a>
          </td>

          
          </tr>
        ";
        $numeroFila++;
      }
    }
  }

  if($_POST['operacion'] == 'registrar'){
    //  Paso 1: Recoger los datos que nos envía la vista 
    $datosForm = [
      "nombrecurso" =>  $_POST['nombrecurso'],
      "especialidad" => $_POST['especialidad'],
      "complejidad" =>  $_POST['complejidad'],
      "fechainicio" =>  $_POST['fechainicio'],
      "precio" =>       $_POST['precio']
    ];

    //Paso 2: Enviar el arreglo como parámetro del método registrar
    $curso->registrarCurso($datosForm);
  }

  if ($_POST['operacion'] == 'eliminar') {
    $curso ->eliminarCurso($_POST['idcurso']);
  }
}