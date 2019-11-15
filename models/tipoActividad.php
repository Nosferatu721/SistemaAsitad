<?php
class TipoActividad
{
    private $db;
    private $idtipoActividad;
    private $tipoActividad;

    public function __construct()
  {
    $this->db = DataBase::conectar();
  }
// GET - SET ID
public function getIdTipoActividad()
{
  return $this->idtipoActividad;
}
public function setId($idtipoActividad)
{
  $this->idtipoActividad = $idtipoActividad;
}

// GET - SET Fecha
public function getTipoActividad()
{
  return $this->tipoActividad;
}
public function setTipoActividad($tipoActividad)
{
  $this->tipoActividad= $this->db->real_escape_string($tipoActividad);
}
// Consultar Todos
public function findTipos()
{
  // Crear Sentencia
  $sql = "SELECT * FROM tipoactividad";
  // Enviamos La Sentencia
  $result = $this->db->query($sql);
  return $result;
}

// Consultar Por ID
public function findTipoAID()
{
  $sql = "SELECT * FROM tipoactividad WHERE idTipoActividad={$this->getIdTipoActividad()}";
  $tipo = $this->db->query($sql);
  return $tipo->fetch_object();
}


public function findAllTipoA()
{
  $sql = "SELECT * FROM tipoActividad";
  $finded = $this->db->query($sql);
  return $finded;
}


public function save()
{
  $sql = "INSERT INTO tipoactividad VALUES (NULL, '{$this->getTipoActividad()}'";
  $saved = $this->db->query($sql);
  return $saved;
}

public function update()
{
  $sql = "UPDATE tipoactividad SET tipoactividad='{$this->getTipoActividad()}', }";
  $updated = $this->db->query($sql);
  return $updated;
}

public function delete()
{
  $sql = "DELETE FROM tipoactividad WHERE idTipoactividad={$this->getId()}";
  $deleted = $this->db->query($sql);
  return $deleted;
}
}