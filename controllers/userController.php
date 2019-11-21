<?php
require_once 'models/user.php';

class UserController
{
  public function gestion()
  {
    $u = new User();
    $use = $u->findAll();
    $u2 = new User();
    $rol = $u2->findRol();
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if ($id == '') {
        header('Location:' . baseUrl . 'error/index');
      }
      $u3 = new User();
      $u3->setId($id);
      $r = $u3->findId();
    }
    require_once 'views/usuario/crud.php';
  }
  public function index()
  {
    require_once 'views/index.php';
  }

  public function login()
  {
    require_once 'views/login.php';
  }

  public static function getAll()
  {
    $u = new User();
    $result = $u->findAll();
    return $result;
  }

  public function logear()
  {
    if (isset($_POST) && $_POST['correo'] && $_POST['contraseÃ±a']) {
      $correo = $_POST['correo'];
      $contraseÃ±a = $_POST['contraseÃ±a'];
      $u = new User();
      $u->setCorreo($correo);
      $userFind = $u->findId();
      if ($userFind) {
        if ($userFind->PASSWORD == $contraseÃ±a) {
          $_SESSION['userLog'] = $userFind;
          header('Location: ' . baseUrl . 'user/index');
        } else {
          $_SESSION['login'] = 'ContraPaila';
          header('Location: ' . baseUrl);
        }
      } else {
        $_SESSION['login'] = 'NoExiste';
        header('Location: ' . baseUrl);
      }
    } else {
      $_SESSION['login'] = 'vacios';
      header('Location: ' . baseUrl);
    }
  }
  public function registrar()
  {
    // var_dump($_POST); die ();
    if (isset($_POST) && $_POST['nombre']  && $_POST['apellido'] && $_POST['correo'] && $_POST['contrasena'] && $_POST['rol']) {
      // Guardar los datos en variables
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $correo = $_POST['correo'];
      $contrasena = $_POST['contrasena'];
      $rol = $_POST['rol'];

      // Instanciar un Objecto User
      $u = new User();
      // Guardar los datos en el Objeto User
      $u->setNombre($nombre);
      $u->setApellido($apellido);
      $u->setCorreo($correo);
      $u->setContraseÃ±a($contrasena);
      $u->setRol($rol);
      // Ejecutar el metodo para registrar
      $r = $u->save();
      if ($r) {
        $_SESSION['registrado'] = true;
        header('Location: ' . baseUrl . 'user/gestion');
      }
    } else {
      echo 'no registrado';
    }
  }

  public function logout()
  {
    if (isset($_SESSION['userLog'])) {
      $_SESSION['userLog'] = null;
      unset($_SESSION['userLog']);
    }
    header('Location: ' . baseUrl);
  }
  public function reLogear()
  {
    require_once 'views/lagout.php';
  }
  public function volverInicio()
  {
    require_once 'views/login.php';
  }
  public function eliminar()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $use = new User();
      $use->setId($id);
      $us = $use->findId();
      if ($us->estado == 'Activo') {
        $e = 'Inactivo';
      } else {
        $e = 'Activo';
      }
      $user2 = new User();
      $user2->setId($id);
      $user2->setEstado($e);
      $delete = $user2->delete();


      $_SESSION['estado'] = 'Cambiado';
      if (!$delete) {
        $_SESSION['estado'] = 'Error';
      }
    } else {
      $_SESSION['estado'] = 'Vacios';
    }
    header('Location: ' . baseUrl . 'user/gestion');
  }
  public function corre()
  {

    if (isset($_POST) && !empty($_POST['id'])) {
      $e = new User();
      $dataU = $e->findId();
      if ($dataU && is_object($dataU)) {
        require_once 'lib/email/contra.php';
      } else {
        $_SESSION['correo'] = 'ErrorDatos';
        header('Location:' . baseUrl . 'evento/correos');
      }
    } else {
      $_SESSION['correos'] = 'Vacios';
      header('Location:' . baseUrl . 'evento/correos');
    }
  }
  // PDF USUARIOS
  public function pdf()
  {
    $u = new Usuario();
    $dataUsers = $u->findUsers();
    $u2 = new Usuario();
    $porcent = $u2->countUsers();
    require_once 'lib/pdf/usuarios/pdfUsuarios.php';
  }
  // INGLES
  public function lang()
  {
    if (isset($_GET['l']) && $_GET['l'] != '') {
      $l = $_GET['l'];
      if ($l == 'en') {
        $_SESSION['l'] = $l;
      } elseif ($l == 'es') {
        $_SESSION['l'] = langDefault;
      }
      header('Location: ' . baseUrl . 'user/index');
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }
  // Certificado
  public function cert()
  {
    require_once 'views/usuario/certificado.php';
  }

  public function certPDF()
  {
    if ($_POST['user'] == 'Elija...') {
      header('Location: ' . baseUrl . 'user/cert');
    } else {
      $u = new User();
      $u->setId($_POST['user']);
      $dataUser = $u->findUId();
      require_once 'lib/pdf/usuarios/certificado.php';
    }
  }
}
