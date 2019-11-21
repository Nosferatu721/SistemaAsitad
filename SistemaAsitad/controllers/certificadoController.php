<?php
require_once 'models/certificado.php';

class CertificadoController
{
  public function gestion()
  {
    // Instanciar un Objeto Certificado
    $m = new Certificado();
    // Ejecutar el Metodo findAll
    $medicamentos = $m->findAll();

    // Instanciar un Objeto Certificado para pedir los Tipos
    $m2 = new Certificado();
    // Ejecutar el Metodo findAllTiposM
    $tipos = $m2->findAllTiposM();
    // 
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if ($id == '') {
        header('Location: ' . baseUrl . 'error/index');
      }
      $m3 = new Certificado();
      $m3->setId($id);
      $r = $m3->findID();
    }
    require_once 'views/certificado/crud.php';
  }

  public function registrar()
  {
    if (isset($_POST) && $_POST['tipo']  && $_POST['descripcion'] && $_POST['hora'] ) {
      // Guardar los datos en variables
      $tipoCertificado = $_POST['tipo'];
      $descripcion = $_POST['descripcion'];
      $horaCertificado = $_POST['hora'];

      // Instanciar un Objecto Certificado
      $m = new Certificado();
      // Guardar los datos en el Objeto User
      $m->settipoCertificado($tipoCertificado);
      $m->setDescripcion($descripcion);
      $m->sethoraCertificado($horaCertificado);
      // Ejecutar el metodo para registrar
      $r = $m->save();
      if ($r) {
        $_SESSION['registrado'] = true;
        header('Location: ' . baseUrl . 'certificado/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'certificado/gestion');
    }
  }

  public function actualizar()
  {
    if (isset($_POST) && $_POST['tipo']) {
      // Guardar los datos en variables
      $id = $_GET['id'];
      $tipoCertificado= $_POST['tipo'];
      $descripcion = $_POST['descripcion'];
      $horaCertificado = $_POST['horaCertificado'];
      // Instanciar un Objecto Certificado
      $m = new Certificado();
      // Guardar los datos en el Objeto User
      $m->setId($id);
      $m->setNombre($tipo);
      $m->setDescripcion($descripcion);
      $m->setUnidades($hora);
      // Ejecutar el metodo para registrar
      $r = $m->update();
      if ($r) {
        $_SESSION['actualizado'] = true;
        header('Location: ' . baseUrl . 'certificado/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'certificado/gestion');
    }
  }

  public function eliminar()
  {
    if (isset($_GET['id']) && !$_GET['id'] == '') {
      $idMedicamento = $_GET['id'];
      $m = new Medicamento();
      $m->setId($idCertificado);
      $r = $m->delete();
      if ($r) {
        $_SESSION['eliminado'] = true;
        header('Location: ' . baseUrl . 'certificado/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'certificado/gestion');
    }
  }
}
