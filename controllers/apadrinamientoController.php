<?php
require_once 'models/apadrinamiento.php';

class ApadrinamientoController
{
	public static function getAll()
	{
		$a = new Apadrinamiento();
		$result = $a->findAll();
		return $result;
	}

	public function gestion()
	{
		//instraciar un objeto apadrinamiento
		$a = new Apadrinamiento();
		//ejecutar el metodo findAll
		$apadrinamiento = $a->findAll();
		//instanciar un objeto apadrinamiento para abauelito
		$a2 = new Apadrinamiento();
		//ejecutar metodo findAllAbuelito
		$abuelo = $a2->findAllAbuelito();
		//instanciar objeto apadrinamiento para usuario
		$a3 = new Apadrinamiento();
		//ejecutar metodo findAllUsurio
		$usuario = $a3->findAllUsuario();

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			if ($id == '') {
				header('Location:' . baseUrl . 'error/index');
			}
			$a4 = new Apadrinamiento();
			$a4->setId($id);
			$r = $a4->findID();
		}
		require_once 'views/apadrinamiento/crud.php';
	}
	public function registrar()
	{
		if (isset($_POST) && $_POST['fechaInicial'] && $_POST['abuelito'] && $_POST['user'] && $_POST['razon']) {
			// guardar datos en variables
			$fechaInicial = $_POST['fechaInicial'];
			$abuelito_idAbuelito = $_POST['abuelito'];
			$usuario_idUsuario = $_POST['user'];
			$razon = $_POST['razon'];
			//instanciar un objeto apadrinamiento
			$a = new Apadrinamiento();
			//guardar los datos en el objeto apadrinamiento
			$a->setFechaInicial($fechaInicial);
			$a->setAbuelito_idAbuelito($abuelito_idAbuelito);
			$a->setUsuario_idUsuario($usuario_idUsuario);
			$a->setRazon($razon);
			$r = $a->save();
			if ($r) {
				$_SESSION['registrado'] = true;
				header('Location:' . baseUrl . 'apadrinamiento/gestion');
			}
		} else {
			header('Location:' . baseUrl . 'apadrinamiento/gestion');
		}
	}
	public function actualizar()
	{
		if (isset($_POST) && $_GET['id'] && $_POST['fechaInicial'] && $_POST['abuelito'] && $_POST['user'] && $_POST['razon']) {
			// guardar datos en variables
			$id = $_GET['id'];
			$fechaInicial = $_POST['fechaInicial'];
			$abuelito_idAbuelito = $_POST['abuelito'];
			$usuario_idUsuario = $_POST['user'];
			$razon = $_POST['razon'];
			//instanciar un objeto apadrinamiento
			$a = new Apadrinamiento();
			//guardar los datos en el objeto apadrinamiento
			$a->setId($id);
			$a->setFechaInicial($fechaInicial);
			$a->setAbuelito_idAbuelito($abuelito_idAbuelito);
			$a->setUsuario_idUsuario($usuario_idUsuario);
			$a->setRazon($razon);
			$r = $a->update();
			if ($r) {
				$_SESSION['actualizado'] = true;
				header('Location:' . baseUrl . 'apadrinamiento/gestion');
			}
		} else {
			header('Location:' . baseUrl . 'apadrinamiento/gestion');
		}
	}
	public function eliminar()
	{
		if (isset($_GET['id']) && !$_GET['id'] == '') {
			$id = $_GET['id'];
			$a = new  Apadrinamiento();
			$a->setId($id);
			$XD = $a->findID();
			$status = $XD->estadoAP;
			if ($status == 'Activa') {
				$a->setEstado('Inactiva');
			} else {
				$a->setEstado('Activa');
			}
			$r = $a->delete();
			if ($r) {
				header('Location:' . baseUrl . 'apadrinamiento/gestion');
			}
		} else {
			header('Location:' . baseUrl . 'apadrinamiento/gestion');
		}
	}
}
