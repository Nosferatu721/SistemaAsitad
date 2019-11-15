<?php

class Evento
{
  private $db;
  private $id;
  private $tipo;
  private $fecha;
  private $descripcion;
  private $estado;
  
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

  public function getFecha()
  {
    return $this->fecha;
  }

  public function setFecha($fecha)
  {
    $this->fecha = $fecha;
  }

  public function getTipo()
  {
    return $this->tipo;
  }

  public function setTipo($tipo)
  {
    $this->tipo = $tipo;
  }
   public function getDescripcion()
  {
    return $this->descripcion;
  }

  public function setDescripcion($descripcion)
  {
    $this->descripcion = $descripcion;
  }

  public function getEstado()
  {
    return $this->estado;
  }

  public function setEstado($estado)
  {
    $this->estado = $estado;
  }
  public function findAll()
  {
    $sql = "SELECT * FROM eventos INNER JOIN tipoevento ON eventos.tipoevento = tipoevento.idTipoEvento";
    $finded = $this->db->query($sql);
    return $finded;
  }


  public function findID()
  {
    $sql = "SELECT * FROM eventos INNER JOIN tipoevento ON eventos.tipoevento = tipoevento.idTipoEvento WHERE idEvento={$this->getId()}";
    $finded = $this->db->query($sql);
    return $finded->fetch_object();
    // El fetch_object() es para pasar los datos a un Objeto 'SOLO SE USA CUANDO ES UN REGISTRO'
  }

  public function findAllTiposM()
  {
    $sql = "SELECT * FROM tipoevento";
    $finded = $this->db->query($sql);
    return $finded;
  }

  public function save()
  {
    $sql = "INSERT INTO eventos VALUES (NULL, '{$this->getFecha()}', '{$this->getTipo()}', '{$this->getDescripcion()}', '{$this->getEstado()}')";
    $saved = $this->db->query($sql);
    return $saved;
  }

  public function update()
  {
    $sql = "UPDATE eventos SET fechaEvento='{$this->getFecha()}', tipoEvento='{$this->getTipo()}', descripcion='{$this->getDescripcion()}', estado='{$this->getEstado()} WHERE idEventos={$this->getId()}";
    $updated = $this->db->query($sql);
    return $updated;
  }

  public function delete()
  {
    $sql = "DELETE FROM eventos WHERE idEventos={$this->getId()}";
    $deleted = $this->db->query($sql);
    return $deleted;
  }
}