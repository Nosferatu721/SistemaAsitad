<?php
require_once 'models/abuelito.php';

class AbuelitoController
{
  public static function getAll()
  {
    $a = new Abuelito();
    $result = $a->findAll();
    return $result;
  }

  public function gestion()
  {
    // Instanciar un Objeto Abuelito
    $a = new Abuelito();
    // Ejecutar el Metodo findAll
    $abuelito = $a->findAll();

    $examenes = $a->findAllExamenes();

    if (isset($_GET['idAbuelito'])) {
      $id = $_GET['idAbuelito'];
      if ($id == '') {
        header('Location: ' . baseUrl . 'error/index');
      }
      $a3 = new Abuelito();
      $a3->setId($id);
      $r = $a3->findId();
    }
    require_once 'views/abuelito/crud.php';
  }

  public function registrar()
  {


    //var_dump($_POST); die();
    if (isset($_POST) && $_POST['nombre']  && $_POST['apellido'] && $_POST['fechaNacimiento']  && $_POST['necesidades'] && $_POST['examenesMedicos'] && $_POST['estadoSalud']) {
      // Guardar los datos en variables
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $fechaNacimiento = $_POST['fechaNacimiento'];
      $necesidades = $_POST['necesidades'];
      $examen = $_POST['examenesMedicos'];
      $salud = $_POST['estadoSalud'];
      // Instanciar un Objecto abuelito
      $a = new Abuelito();
      // Guardar los datos en el Objeto User
      $a->setNombre($nombre);
      $a->setApellido($apellido);
      $a->setFechaNacimiento($fechaNacimiento);
      $a->setExamenesMedico($examen);
      $a->setEstadoSalud($salud);
      $a->setNecesidades($necesidades);
      // Ejecutar el metodo para registrar
      $r = $a->save();

      if ($r) {
        $_SESSION['registrado'] = true;
        header('Location: ' . baseUrl . 'abuelito/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'abuelito/gestion');
    }
  }

  public function editar()
  {

    //var_dump($_POST); die();
    if (isset($_GET['idAbuelito']) && !empty($_GET['idAbuelito'])) {
      $editar = true;
      $id = $_GET['idAbuelito'];
      $abuelo = new abuelito();
      $abuelo->setId($id);
      $restEdit = $abuelo->findId();
      require_once 'views/abuelito/crud.php';
    } else {
      header('Location: ' . baseUrl . 'abuelito/gestion');
    }
  }

  public function eliminar()
  {

    if (isset($_GET['idAbuelito'])) {
      $id = $_GET['idAbuelito'];
      $abuelito1 = new abuelito();
      $abuelito1->setId($id);
      $ab = $abuelito1->findId();
      if ($ab->estado == 'Activo') {
        $e = 'Inactivo';
      } else {
        $e = 'Activo';
      }
      $abuelito2 = new abuelito();
      $abuelito2->setId($id);
      $abuelito2->setEstado($e);
      $delete = $abuelito2->delete();
      var_dump($delete);
      die();
      $_SESSION['estado'] = 'Cambiado';
      if (!$delete) {
        $_SESSION['estado'] = 'Error';
      }
    } else {
      $_SESSION['estado'] = 'Vacios';
    }
    header('Location: ' . baseUrl . 'abuelito/gestion');
  }
}
