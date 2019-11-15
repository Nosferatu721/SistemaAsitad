<?php

class Medicamento
{
  private $db;
  private $id;
  private $fechaVen;
  private $laboratorio;
  private $tipo;
  private $nombre;
  private $descripton;
  private $estado;
  private $unidades;

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

  public function getFechaVen()
  {
    return $this->fechaVen;
  }

  public function setFechaVen($fechaVen)
  {
    $this->fechaVen = $fechaVen;
  }

  public function getLaboratorio()
  {
    return $this->laboratorio;
  }

  public function setLaboratorio($laboratorio)
  {
    $this->laboratorio = $laboratorio;
  }

  public function getTipo()
  {
    return $this->tipo;
  }

  public function setTipo($tipo)
  {
    $this->tipo = $tipo;
  }

  public function getNombre()
  {
    return $this->nombre;
  }

  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  public function getDescripcion()
  {
    return $this->descripton;
  }

  public function setDescripcion($descripton)
  {
    $this->descripton = $descripton;
  }

  public function getEstado()
  {
    return $this->estado;
  }

  public function setEstado($estado)
  {
    $this->estado = $estado;
  }

  public function getUnidades()
  {
    return $this->unidades;
  }

  public function setUnidades($unidades)
  {
    $this->unidades = $unidades;
  }

  public function findAll()
  {
    $sql = "SELECT * FROM medicamentos INNER JOIN tipomedicamento ON medicamentos.tipoMedicamento = tipomedicamento.idTipoMedicamento";
    $finded = $this->db->query($sql);
    return $finded;
  }

  public function findID()
  {
    $sql = "SELECT * FROM medicamentos INNER JOIN tipomedicamento ON medicamentos.tipoMedicamento = tipomedicamento.idTipoMedicamento WHERE idMedicamentos={$this->getId()}";
    $finded = $this->db->query($sql);
    return $finded->fetch_object();
    // El fetch_object() es para pasar los datos a un Objeto 'SOLO SE USA CUANDO ES UN REGISTRO'
  }

  public function findAllTiposM()
  {
    $sql = "SELECT * FROM tipomedicamento";
    $finded = $this->db->query($sql);
    return $finded;
  }

  public function save()
  {
    $sql = "INSERT INTO medicamentos VALUES (NULL, '{$this->getFechaVen()}', '{$this->getLaboratorio()}', '{$this->getTipo()}', '{$this->getNombre()}', '{$this->getDescripcion()}', 'Bien','{$this->getUnidades()}')";
    $saved = $this->db->query($sql);
    return $saved;
  }

  public function update()
  {
    $sql = "UPDATE medicamentos SET fechaVencimiento='{$this->getFechaVen()}', laboratorio='{$this->getLaboratorio()}', tipoMedicamento='{$this->getTipo()}', nombreMedicamento='{$this->getNombre()}', descripcionMedicamento='{$this->getDescripcion()}', estado='{$this->getEstado()}', unidades='{$this->getUnidades()}' WHERE idMedicamentos={$this->getId()}";
    $updated = $this->db->query($sql);
    return $updated;
  }

  public function delete()
  {
    $sql = "DELETE FROM medicamentos WHERE idMedicamentos={$this->getId()}";
    $deleted = $this->db->query($sql);
    return $deleted;
  }
}
