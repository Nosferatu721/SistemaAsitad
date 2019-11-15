
<?php
require_once 'models/donacion.php';

class DonacionController
{
  public function gestion()
  {
    
    // Instanciar un Objeto Donacion
    $d = new Donacion();
    // Ejecutar el Metodo findAll
    $donacion = $d->findAll();

    // Instanciar un Objeto Medicamento para pedir los Tipos
    $d2 = new Donacion();
    // Ejecutar el Metodo findAllTiposM
    $abue = $d2->findAllAbuelito();
    //onstanciar un objeto usuario 
    $d3= new Donacion();
    //ejecutar el metodo findallusuario
    $usuar= $d2->findAllUsuarios();

    // 
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if ($id == '') {
        header('Location: ' . baseUrl . 'error/index');
      }
      $d4 = new Donacion();
      $d4->setId($id);
      $r = $d4->findID();
    }
    require_once 'views/donacion/crud.php';
  }

  public function registrar()
  {
    if (isset($_POST) && $_POST['valor']  && $_POST['fecha'] && $_POST['tipo'] && $_POST['abuelito_idAbuelito'] && $_POST['usuario_idUsuario'] && $_POST['descripcion']) {
      // Guardar los datos en variables
      $valor = $_POST['valor'];
      $fecha = $_POST['fecha'];
      $tipo = $_POST['tipo'];
      $abuelito_idAbuelito = $_POST['abuelito_idAbuelito'];
      $usuario_idUsuario = $_POST['usuario_idUsuario'];
      $descripcion = $_POST['descripcion'];
      // Instanciar un Objecto Donacion
      $d = new Donacion();
      // Guardar los datos en el Objeto User
      $d->setValor($valor);
      $d->setFecha($fecha);
      $d->setTipo($tipo);
      $d->setAbuelito_idAbuelito($abuelito_idAbuelito);
      $d->setUsuario_idUsuario($usuario_idUsuario);
      $d->setDescripcion($descripcion);
      
      // Ejecutar el metodo para registrar
      $r = $d->save();
      if ($r) {
        $_SESSION['registrado'] = true;
        header('Location: ' . baseUrl . 'donacion/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'donacion/gestion');
    }
  }

  public function actualizar()
  {
    if (isset($_POST) && $_GET['id']  && $_POST['valor'] && $_POST['fecha'] && $_POST['tipo'] && $_POST['abuelito_idAbuelito'] && $_POST['usuario_idUsuario'] && $_POST['descripcion']) {
      // Guardar los datos en variables
      $id = $_GET['id'];
      $valor = $_POST['valor'];
      $fecha = $_POST['fecha'];
      $tipo = $_POST['tipo'];
      $abuelito_idAbuelito = $_POST['abuelito_idAbuelito'];
      $usuario_idUsuario = $_POST['usuario_idUsuario'];
      $descripcion = $_POST['descripcion'];
      // Instanciar un Objecto Donacion
      $d = new Donacion();
      // Guardar los datos en el Objeto User
      $d->setId($id);
      $d->setvalor($valor);
      $d->setFecha($fecha);
      $d->setTipo($tipo);
      $d->setAbuelito_idAbuelito($abuelito_idAbuelito);
      $d->setUsuario_idUsuario($usuario_idUsuario);
      $d->setDescripcion($descripcion);
      // Ejecutar el metodo para registrar
      $r = $d->update();
      if ($r) {
        $_SESSION['actualizado'] = true;
        header('Location: ' . baseUrl . 'donacion/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'donacion/gestion');
    }
  }

  public function eliminar()
  {
    if (isset($_GET['id']) && !$_GET['id'] == '') {
      $idDonacion = $_GET['id'];
      $d = new Donacion();
      $d->setId($idDonacion);
      $r = $d->delete();
      if ($r) {
        $_SESSION['eliminado'] = true;
        header('Location: ' . baseUrl . 'donacion/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'donacion/gestion');
    }
  }
}
