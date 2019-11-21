<?php
class Actividad
{
    private $db;
    private $id;
    private $fechaActividad;
    private $nombreActividad;
    private $horaActividad;
    private $abuelito_idAbuelito;
    private $usuario_idUsuario;
    private $tipoActividad;

    public function __construct()
  {
    $this->db = DataBase::conectar();
  }
// GET - SET ID
public function getId()
{
  return $this->id;
}
public function setId($id)
{
  $this->id = $id;
}

// GET - SET Fecha
public function getFechaActividad()
{
  return $this->fechaActividad;
}
public function setFechaActividad($fechaActividad)
{
  $this->fechaActividad= $this->db->real_escape_string($fechaActividad);
}



// GET - SET NombreActividad
public function getNombreActividad()
{
  return $this->nombreActividad;
}
public function setNombreActividad($nombreActividad)
{
  $this->nombreActividad = $this->db->real_escape_string($nombreActividad);
}

 // GET - SET horaActividad
 public function getHoraActividad()
{
  return $this->horaActividad;
}
public function setHoraActividad($horaActividad)
{
  $this->horaActividad = $this->db->real_escape_string($horaActividad);
}


// GET - SET abuelito_idAbuelito
public function getAbuelito_idAbuelito()
{
  return $this->abuelito_idAbuelito;
}
public function setAbuelito_idAbuelito($abuelito_idAbuelito)
{
  $this->abuelito_idAbuelito = $this->db->real_escape_string($abuelito_idAbuelito);
}
// GET - SET usuario_idUsuario
public function getUsuario_idUsuario()
{
  return $this->usuario_idUsuario;
}
public function setUsuario_idUsuario($usuario_idUsuario)
{
  $this->usuario_idUsuario = $this->db->real_escape_string($usuario_idUsuario);
}
// GET - SET tipoActividad
public function getTipoActividad()
{
  return $this->tipoActividad;
}
public function setTipoActividad($tipoActividad)
{
  $this->tipoActividad= $this->db->real_escape_string($tipoActividad);
}
public function findAll()
{
  $sql = "SELECT * FROM actividad INNER JOIN tipoActividad ON actividad.tipoActividad = tipoactividad.idTipoActividad INNER JOIN abuelito ON actividad.abuelito_idAbuelito = abuelito.idAbuelito INNER JOIN usuarios on actividad.usuario_idUsuario = usuarios.idUsuario";
  $finded = $this->db->query($sql);
  return $finded;
}

public function findAllTipoA()
{
  $sql = "SELECT * FROM tipoActividad";
  $finded = $this->db->query($sql);
  return $finded;
}
public function findAllAbuelito(){
  $sql= "SELECT * FROM abuelito";
  $finded= $this->db->query($sql);
  return $finded;
}
public function findAllUsuario(){
  $sql= "SELECT * FROM usuarios";
  $finded= $this->db->query($sql);
  return $finded;
}
public function findID(){
$sql= "SELECT * FROM actividad INNER JOIN abuelito on actividad.abuelito_idAbuelito= abuelito.idAbuelito INNER JOIN usuarios on actividad.usuario_idUsuario= usuarios.idUsuario INNER JOIN tipoactividad on actividad.tipoActividad= tipoactividad.idTipoActividad WHERE id={$this->getId()}";
$finded= $this->db->query($sql);
return $finded->fetch_object();
}

public function save()
{
  $sql = "INSERT INTO actividad VALUES (NULL, '{$this->getNombreActividad()}','{$this->getHoraActividad()}','{$this->getAbuelito_idAbuelito()}','{$this->getUsuario_idUsuario()}','{$this->getTipoActividad()}','{$this->getFechaActividad()}')";
  $saved = $this->db->query($sql);
  return $saved;
}

public function update()
{
  $sql = "UPDATE actividad SET 	nombreActividad='{$this->getNombreActividad()}', horaActividad='{$this->getHoraActividad()}', abuelito_idAbuelito='{$this->getAbuelito_idAbuelito()}', usuario_idUsuario='{$this->getUsuario_idUsuario()}', tipoActividad='{$this->getTipoActividad()}', fechaActividad='{$this->getFechaActividad()}' WHERE id={$this->getId()}";
  $updated = $this->db->query($sql);
  return $updated;
}

public function delete()
{
  $sql = "DELETE FROM actividad WHERE id={$this->getId()}";
  $deleted = $this->db->query($sql);
  return $deleted;
}
}




