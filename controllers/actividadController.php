<?php
require_once 'models/actividad.php';

class ActividadController
{
  public function gestion()
  {
    // Instanciar un Objeto Actividad
    $ac = new Actividad();
    // Ejecutar el Metodo findAll
    $actividad = $ac->findAll();
    // Instanciar un Objeto Actividad para pedir los Tipos
    $ac2 = new Actividad();
    // Ejecutar el Metodo findAllTiposA
    $tipos = $ac2->findAllTipoA();
    // instancia objeto actividad abuelo
    $ac3 = new Actividad();
    //ejecutar medoto findallAbuelo
    $abuelo= $ac3->findAllAbuelito();
    //instancia obejto actividad usuarios
    $ac4 = new Actividad();
    //ejecutar metodo findAllUsuario
    $users = $ac4->findAllUsuario();
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if ($id == '') {
        header('Location: ' . baseUrl . 'error/index');
      }
      $ac5 = new Actividad();
      $ac5->setId($id);
      $r = $ac5->findID();
    }
    require_once 'views/actividad/crud.php';
  }

  public function registrar()
  {
    if (isset($_POST)  && $_POST['nombreActividad'] && $_POST['horaActividad']&& $_POST['abuelito_idAbuelito']&& $_POST['usuario_idUsuario'] && $_POST['tipoActividad'] && $_POST['fechaActividad']) {
      // Guardar los datos en variables
      $nombreActividad = $_POST['nombreActividad'];
      $horaActividad = $_POST['horaActividad'];
      $abuelito_idAbuelito = $_POST['abuelito_idAbuelito'];
      $usuario_idUsuario = $_POST['usuario_idUsuario']; 
      $tipoActividad = $_POST['tipoActividad'];
      $fechaActividad = $_POST['fechaActividad'];
      // Instanciar un Objecto Actividad
      $ac = new Actividad();
      // Guardar los datos en el Objeto User
      
      $ac->setNombreActividad($nombreActividad);
      $ac->setHoraActividad($horaActividad);
      $ac->setAbuelito_idAbuelito($abuelito_idAbuelito);
      $ac->setUsuario_idUsuario($usuario_idUsuario);
      $ac->setTipoActividad($tipoActividad);
      $ac->setFechaActividad($fechaActividad);
      // var_dump($ac); die();
      // Ejecutar el metodo para registrar
      $r = $ac->save();
      if ($r) {
        $_SESSION['registrado'] = true;
        header('Location: ' . baseUrl . 'actividad/gestion');
      }
    } else {
      echo 'No registra';
      // header('Location: ' . baseUrl . 'actividad/gestion');
    }
  }

  public function actualizar()
  {
   
    if (isset($_POST)  && $_POST['fechaActividad'] && $_POST['nombreActividad'] && $_POST['horaActividad']&& $_POST['abuelito_idAbuelito']&& $_POST['usuario_idUsuario'] && $_POST['tipo']) {
      // Guardar los datos en variables
      $id =$_POST['id']; 
      $nombreActividad = $_POST['nombreActividad'];
      $horaActividad = $_POST['horaActividad'];
      $abuelito_idAbuelito = $_POST['abuelito_idAbuelito'];
      $usuario_idUsuario = $_POST['usuario_idUsuario']; 
      $tipo = $_POST['tipo'];
      $fechaActividad = $_POST['fechaActividad'];
      // Instanciar un Objecto Actividad
      $ac = new Actividad();
      // Guardar los datos en el Objeto User
      $ac->setId($id);
      $ac->setNombreActividad($nombreActividad);
      $ac->setHoraActividad($horaActividad);
      $ac->setAbuelito_idAbuelito($abuelito_idAbuelito);
      $ac->setUsuario_idUsuario($usuario_idUsuario);
      $ac->setTipoActividad($tipo);
      $ac->setFechaActividad($fechaActividad);
    
      // Ejecutar el metodo para registrar
      $r = $ac->update();
      if ($r) {
        $_SESSION['actualizado'] = true;
        header('Location: ' . baseUrl . 'actividad/gestion');
      }
    } else {
      $_SESSION['no actualizo']=true;
      header('Location: ' . baseUrl . 'actividad/gestion');
    }
  }

  public function eliminar()
  {
    if (isset($_GET['id']) && !$_GET['id'] == '') {
      $idActividad = $_GET['id'];
      $m = new Actividad();
      $m->setId($idActividad);
      $r = $m->delete();
      if ($r) {
        $_SESSION['eliminado'] = true;
        header('Location: ' . baseUrl . 'actividad/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'actividad/gestion');
    }
  }
}
