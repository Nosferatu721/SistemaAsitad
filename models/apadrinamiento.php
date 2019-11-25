<?php
class Apadrinamiento
{
	private $db;
	private $id;
	private $fechaInicial;
	private $abuelito_idAbuelito;
	private $usuario_idUsuario;
	private $estado;
	private $razon;

	public function __construct()
	{
		$this->db = DataBase::conectar();
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}
	public function getFechaInicial()
	{
		return $this->fechaInicial;
	}
	public function setFechaInicial($fechaInicial)
	{
		$this->fechaInicial = $fechaInicial;
	}
	//
	public function getAbuelito_idAbuelito()
	{
		return $this->abuelito_idAbuelito;
	}
	public function setAbuelito_idAbuelito($abuelito_idAbuelito)
	{
		$this->abuelito_idAbuelito = $abuelito_idAbuelito;
	}
	//
	public function getUsuario_idUsuario()
	{
		return $this->usuario_idUsuario;
	}
	public function setUsuario_idUsuario($usuario_idUsuario)
	{
		$this->usuario_idUsuario = $usuario_idUsuario;
	}
	//
	public function getEstado()
	{
		return $this->estado;
	}
	public function setEstado($estado)
	{
		$this->estado = $estado;
	}
	public function getRazon()
	{
		return $this->razon;
	}
	public function setRazon($razon)
	{
		$this->razon = $razon;
	}
	// consultar apadrinamiento
	public function findAll()
	{
		$sql = "SELECT *, apadrinamiento.estado AS estadoAP FROM apadrinamiento INNER JOIN abuelito ON apadrinamiento.abuelito_idAbuelito = abuelito.idAbuelito INNER JOIN usuarios ON apadrinamiento.usuario_idUsuario = usuarios.idUsuario";
		$finded = $this->db->query($sql);
		return $finded;
	}
	//consultar po id apadrinamiento
	public function findID()
	{
		$sql = "SELECT *, apadrinamiento.estado AS estadoAP FROM apadrinamiento INNER JOIN abuelito ON apadrinamiento.abuelito_idAbuelito = abuelito.idAbuelito INNER JOIN usuarios ON apadrinamiento.usuario_idUsuario = usuarios.idUsuario WHERE id={$this->getId()}";
		$finded = $this->db->query($sql);
		return $finded->fetch_object();
	}
	// consultar por id usuario
	public function findAllUsuario()
	{
		$sql = "SELECT * FROM usuarios";
		$finded = $this->db->query($sql);
		return $finded;
	}
	//consultar por id abuelito
	public function findAllAbuelito()
	{
		$sql = "SELECT * FROM abuelito";
		$finded = $this->db->query($sql);
		return $finded;
	}
	//guardar
	public function save()
	{
		$sql = "INSERT INTO apadrinamiento VALUES (null,'{$this->getFechaInicial()}','{$this->getAbuelito_idAbuelito()}','{$this->getUsuario_idUsuario()}', 'Activa', '{$this->getRazon()}')";
		$saved = $this->db->query($sql);
		return $saved;
	}
	//actualizar- editar
	public function update()
	{
		$sql = "UPDATE apadrinamiento SET fechaInicial='{$this->getFechaInicial()}', abuelito_idAbuelito='{$this->getAbuelito_idAbuelito()}',usuario_idUsuario='{$this->getUsuario_idUsuario()}', razon='{$this->getRazon()}' WHERE id={$this->getId()}";
		$update = $this->db->query($sql);
		return $update;
	}
	//cancelar
	public function delete()
	{
		$sql = "UPDATE apadrinamiento SET estado='{$this->getEstado()}' WHERE id={$this->getId()}";
		$delete = $this->db->query($sql);
		return $delete;
	}
}
