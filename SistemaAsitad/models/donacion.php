
<?php

class Donacion
{
  private $db;
  private $id;
  private $valor;
  private $fecha;
  private $tipo;
  private $abuelito_idAbuelito;
  private $usuario_idUsuario;
  private $descripcion;
  
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

  public function getValor()
  {
    return $this->valor;
  }
  public function setValor($valor)
  {
    $this->valor = $valor;
  }
  public function getfecha()
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

  // GET - SET abuelito_idAbuelito
function getAbuelito_idAbuelito()
{
  return $this->abuelito_idAbuelito;
}
function setAbuelito_idAbuelito($abuelito_idAbuelito)
{
  $this->abuelito_idAbuelito = $this->db->real_escape_string($abuelito_idAbuelito);
}
// GET - SET usuario_idUsuario
function getUsuario_idUsuario()
{
  return $this->usuario_idUsuario;
}
function setUsuario_idUsuario($usuario_idUsuario)
{
  $this->usuario_idUsuario = $this->db->real_escape_string($usuario_idUsuario);
}


public function findAll()
{
  $sql = "SELECT * FROM donacion INNER JOIN abuelito ON donacion.abuelito_idAbuelito = abuelito.idAbuelito INNER JOIN usuarios ON donacion.usuario_idUsuario = usuarios.idUsuario";
  $finded = $this->db->query($sql);
  return $finded;
}
public function findAllAbuelito(){
  $sql= "SELECT * FROM abuelito";
  $finded= $this->db->query($sql);
  return $finded;
}
public function findAllUsuarios(){
  $sql= "SELECT * FROM usuarios";
  $finded= $this->db->query($sql);
  return $finded;
}
public function findID()
{
  $sql = "SELECT * FROM donacion WHERE idDonacion={$this->getId()}";
  $finded = $this->db->query($sql);
  return $finded->fetch_object();
  // El fetch_object() es para pasar los datos a un Objeto 'SOLO SE USA CUANDO ES UN REGISTRO'
}

public function save()
{
  $sql = "INSERT INTO donacion VALUES (NULL, '{$this->getValor()}', '{$this->getFecha()}', '{$this->getTipo()}', '{$this->getAbuelito_idAbuelito()}', '{$this->getUsuario_idUsuario()}','{$this->getDescripcion()}')";
  $saved = $this->db->query($sql);
  return $saved;
}

public function update()
{
  $sql = "UPDATE donacion SET valorDonacion='{$this->getValor()}', fecha='{$this->getFecha()}', tipoDonacion='{$this->getTipo()}', abuelito_idAbuelito='{$this->getAbuelito_idAbuelito()}', usuario_idUsuario='{$this->getUsuario_idUsuario()}', descripcionDonacion='{$this->getDescripcion()}' WHERE idDonacion={$this->getId()}";
  $updated = $this->db->query($sql);
  return $updated;
}

public function delete()
{
  $sql = "DELETE FROM donacion WHERE idDonacion={$this->getId()}";
  $deleted = $this->db->query($sql);
  return $deleted;
}
}







