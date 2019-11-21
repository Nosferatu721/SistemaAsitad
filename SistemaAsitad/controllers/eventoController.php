<?php
require_once 'models/evento.php';
require_once 'models/user.php';

class eventoController
{
  public function gestion()
  {
    // Instanciar un Objeto Medicamento
    $e = new Evento();
    // Ejecutar el Metodo findAll
    $eventos = $e->findAll();

    // Instanciar un Objeto Medicamento para pedir los Tipos
    $e2 = new Evento();
    // Ejecutar el Metodo findAllTiposM
    $tipos = $e2->findAllTiposM();
    // 
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if ($id == '') {
        header('Location: ' . baseUrl . 'error/index');
      }
      $e3 = new Eventos();
      $e3->setId($id);
      $r = $e3->findID();
    }
    require_once 'views/evento/crud.php';
  }
  public function correos(){
    require_once 'views/evento/correos.php';
  }
  public function cor(){
    require_once 'ExampleMailPHP-master/sendEmail.php';
  }
 
  public function registrar()
  {
    if (isset($_POST) && $_POST['tipo']  && $_POST['fecha'] && $_POST['descripcion'] && $_POST['estado']) {
      // Guardar los datos en variables
      $tipo = $_POST['tipo'];
      $fecha = $_POST['fecha'];
      $descripcion = $_POST['descripcion'];
      $estado = $_POST['estado'];
      
      // Instanciar un Objecto Medicamento
      $e = new Evento();
      // Guardar los datos en el Objeto User
      $e->setTipo($tipo);
      $e->setFecha($fecha);
      $e->setDescripcion($descripcion);
      $e->setEstado($estado);
    
      // Ejecutar el metodo para registrar
      $r = $e->save();
      if ($r) {
        $_SESSION['registrado'] = true;
        header('Location: ' . baseUrl . 'evento/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'evento/gestion');
    }
  }

  public function actualizar()
  {
    if (isset($_POST) && $_POST['tipo']  && $_POST['fecha'] && $_POST['descripcion'] && $_POST['estado']) {
      // Guardar los datos en variables
      $id = $_GET['id'];
      $tipo = $_POST['tipo'];
      $fecha = $_POST['fecha'];
      $descripcion = $_POST['descripcion'];
      $estado = $_POST['estado'];
      
      // Instanciar un Objecto Medicamento
      $e = new Evento();
      // Guardar los datos en el Objeto User
      $e->setId($id);
      $e->setTipo($tipo);
      $e->setTipo($fecha);
      $e->setDescripcion($descripcion);
      $e->setEstado($estado);
     
      // Ejecutar el metodo para registrar
      $r = $e->update();
      if ($r) {
        $_SESSION['actualizado'] = true;
        header('Location: ' . baseUrl . 'evento/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'evento/gestion');
    }
  }

  public function eliminar()
  {
    if (isset($_GET['id']) && !$_GET['id'] == '') {
      $idEventos = $_GET['id'];
      $e = new Eventos();
      $e->setId($idEventos);
      $r = $e->delete();
      if ($r) {
        $_SESSION['eliminado'] = true;
        header('Location: ' . baseUrl . 'evento/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'evento/gestion');
    }
  }
}