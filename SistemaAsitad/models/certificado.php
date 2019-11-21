<?php
class ActividCertificadoad
{
    private $db;
    private $idCertificado;
    private $tipoCertificado;
    private $descripcion;
    private $horaCertificado;
    private $usuario_idCertificadoUsuario;

    public function __construct()
  {
    $this->db = DataBase::conectar();
  }
// GET - SET idCertificadoCERTIFICADO
function getidCertificado()
{
  return $this->idCertificado;
}
function setidCertificado($Certificado)
{
  $this->idCertificado = $Certificado;
}

// GET - SET TIPOCERTIFICADO
function getTipoCertificado()
{
  return $this->tipoCertificado;
}
function settipoCertificado($tipo)
{
  $this->tipoCertificado= $this->db->real_escape_string($tipo);
}

 // GET - SET descripcion
function getdescripcion()
{
  return $this->descripcion;
}
function setdescripcion($descripcion)
{
  $this->descripcion= $this->db->real_escape_string($descripcion);
}


// GET - SET hora certificado
function gethoraCertificado()
{
  return $this->horaCertificado;
}
function sethoraCertificado($hora)
{
  $this->horaCertificado = $this->db->real_escape_string($hora);
}
// GET - SET usuario_idCertificadoUsuario
function getUsuario_idCertificadoUsuario()
{
  return $this->usuario_idCertificadoUsuario;
}
function seUsuario_idCertificadoUsuario($usuario_idCertificadoUsuario)
{
  $this->usuario_idCertificadoUsuario = $this->db->real_escape_string($usuario_idCertificadoUsuario);
}

public function getAll(){
$certificado =$this->db->query("SELECT * FROM certificado");
return $certificado;


}
public function save()
{
  $sql = "INSERT INTO certificado VALUES (NULL, '{$this->gettipoCertificado()}', '{$this->getdescripcion()}', 'Bien(?)','{$this->gethoraCertificado()}')";
  $saved = $this->db->query($sql);
  return $saved;
}

public function update()
{
  $sql = "UPDATE certificado SET tipoCertificado='{$this->getTipoCertificado()}', descripcion='{$this->getDescripcion()}',  horaCertificado='{$this->getHoraCertificado()}";
  $updated = $this->db->query($sql);
  return $updated;
}

public function delete()
{
  $sql = "DELETE FROM certificado WHERE idCertificado={$this->getId()}";
  $deleted = $this->db->query($sql);
  return $deleted;
}

}
