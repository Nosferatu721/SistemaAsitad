<?php
require_once 'models/examenes.php';

class ExamenesController
{
  public function gestion()
  {
    // Instanciar un Objeto Medicamento
    $e = new Examenes();
    // Ejecutar el Metodo findAll
    $examenes = $e->findAll();
    // Instanciar un Objeto Medicamento para pedir los Tipos
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if ($id == '') {
        header('Location: ' . baseUrl . 'error/index');
      }
      $e3 = new Examenes();
      $e3->setId($id);
      $r = $e3->findID();
    }
    require_once 'views/examenes/crud.php';
  }

  public function registrar()
  {
    if(isset ($_POST)){
      $fecha= isset ($_POST['fecha'])? $_POST['fecha']: false;
      $nombre= isset ($_POST['nombre'])? $_POST['nombre']: false;
      $descripcion = isset($_POST['descripcion'])? $_POST['descripcion']: false ;
      //$documento = isset($_POST['documento'])? $_POST['documento']: false ;

      if($fecha && $nombre && $descripcion ){
        $examen= new Examenes();
        $examen->setFecha($fecha);
        $examen->setNombre($nombre);
        $examen->setDescripcion($descripcion);

      	// Guardar el documento
				if(isset($_FILES['archivo'])){
					$file = $_FILES['archivo'];
					$filename = $file['name'];
					$mimetype = $file['type'];if($mimetype == "application/pdf" || $mimetype == 'application/msword' || $mimetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ){

						if(!is_dir('uploads/public')){
							mkdir('uploads/public', 0777, true);
						}

						$examen->setDocumento($filename);
						move_uploaded_file($file['tmp_name'], 'uploads/public/'.$filename);
					}
				}
				
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$examen->setId($id);
					
					$save = $examen->edit();
				}else{
					$save = $examen->save();
				}
				
				if($save){
					$_SESSION['producto'] = "complete";
				}else{
					$_SESSION['producto'] = "failed";
				}
			}else{
				$_SESSION['producto'] = "failed";
			}
		}else{
			$_SESSION['producto'] = "failed";
		}
    header('Location: ' . baseUrl . 'examenes/gestion');
	}


  public function actualizar()
  {
    if (isset($_POST) && $_POST['fecha']  && $_POST['medicamento_idMedicamento'] && $_POST['enfermedad_idEnfermedad']) {
      // Guardar los datos en variables
      $id = $_GET['id'];
      $nombre = $_POST['fecha'];
      $descripcion = $_POST['medicamento_idMedicamento'];
      $unidades = $_POST['enfermedad_idEnfermedad'];
      
      // Instanciar un Objecto Medicamento
      $e = new Examenes();
      // Guardar los datos en el Objeto User
      $e->setId($id);
      $e->setFecha($fecha);
      $e->setMedicamentos_idMedicamento($medicamentos_idMedicamentos);
      $e->setEnfermedad_idEnfermedad($enfermedad_idEnfermedad);
      // Ejecutar el metodo para registrar
      $r = $e->update();
      if ($r) {
        $_SESSION['actualizado'] = true;
        header('Location: ' . baseUrl . 'examenes/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'examenes/gestion');
    }
  }

  public function eliminar()
  {
    if (isset($_GET['id']) && !$_GET['id'] == '') {
      $idExamenesMedicos = $_GET['id'];
      $e = new Examenes();
      $e->setId($idExamenesMedicos);
      $r = $e->delete();
      if ($r) {
        $_SESSION['eliminado'] = true;
        header('Location: ' . baseUrl . 'examenes/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'examenes/gestion');
    }
  }
}
