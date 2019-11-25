<?php
session_start();
require_once 'config/db.php';
require_once 'autoload.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
if (isset($_GET['accion']) && $_GET['accion'] != 'pdf' && $_GET['accion'] != 'certPDF') {
  require_once 'views/layout/header.php';
}

if (isset($_SESSION['l']) && $_SESSION['l'] == 'es') {
  require_once 'assets/lang/es.php';
} elseif (isset($_SESSION['l']) && $_SESSION['l'] == 'en') {
  require_once 'assets/lang/en.php';
} else {
  require_once 'assets/lang/es.php';
}

// Mostrar Error 404
function showError()
{
  $error = new errorController();
  $error->index();
}

// Comprobamos si existe algun Controlador
if (isset($_GET['controlador'])) {
  // Guardamos el Controlador en una Variable
  $nombreController = $_GET['controlador'] . 'Controller';
} elseif (!isset($_GET['controlador']) && !isset($_GET['accion'])) {
  // Si no existe un controlador asignamos uno por Defecto
  $nombreController = controllerDefault;
} else {
  showError();
  exit();
}

// Comprobar si existe la Clase Controladora
if (class_exists($nombreController)) {
  // Instanciamos el controlador
  $controller = new $nombreController();
  // Ahora comprobamos si existe un ( accion ) y si el accion existe en el controlador
  if (isset($_GET['accion']) && method_exists($controller, $_GET['accion'])) {
    // Guardamos el accion
    $accion = $_GET['accion'];
    // Ejecutar peticion
    $accion != 'RPass' ? Utils::verify() : 'Success Sesion';
    $controller->$accion();
  } elseif (!isset($_GET['controlador']) && !isset($_GET['accion'])) {
    $actionDefault = actionDefault;
    $controller->$actionDefault();
  } else {
    showError();
  }
} else {
  showError();
}
