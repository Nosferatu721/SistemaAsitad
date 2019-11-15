<?php
class abuelito
{
    private $db;
    private $id;
    private $nombre;
    private $apellido;
    private $fechaNacimiento;
    private $estado;
    private $estadoSalud;
    private $necesidades;
    private $examenesMedicos;

    public function  __construct()
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
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getApellido()
    {
        return $this->apellido;
    }
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    public function getNecesidades()
    {
        return $this->necesidades;
    }
    public function setNecesidades($necesidades)
    {
        $this->necesidades = $necesidades;
    }
    public function getExamenesMedico()
    {
        return $this->examenesMedicos;
    }
    public function setExamenesMedico($examenesMedicos)
    {
        $this->examenesMedicos = $examenesMedicos;
    }
    public function getEstadoSalud()
    {
        return $this->estadoSalud;
    }
    public function setEstadoSalud($estadoSalud)
    {
        $this->estadoSalud = $estadoSalud;
    }
    public function findAll()
    {
        $sql = "SELECT * FROM abuelito INNER JOIN examenesmedicos on examenesmedicos.idExamenesMedicos= abuelito.examenMedico";
        $abu = $this->db->query($sql);
        return $abu;
    }
    public function findAllExamenes()
    {
        $sql = "SELECT * FROM examenesmedicos";
        $exa = $this->db->query($sql);
        return $exa;
    }
    public function findId()
    {
        $sql = "SELECT * FROM abuelito INNER join examenesmedicos on abuelito.examenMedico= examenesmedicos.idExamenesMedicos WHERE idAbuelito={$this->getId()}";
        $finded = $this->db->query($sql);
        return $finded->fetch_object();
    }
    public function save()
    {
        $sql = "INSERT INTO abuelito values (null,'{$this->getNombre()}','{$this->getApellido()}','{$this->getFechaNacimiento()}', 'Activo','{$this->getNecesidades()}','{$this->getExamenesMedico()}','{$this->getEstadoSalud()}');";

        $saved = $this->db->query($sql);
        return $saved;
    }
    public function update()
    {
        $sql = "UPDATE abuelito SET nombreAbuelito='{$this->getNombre()}',apellido='{$this->apellido()}',fechaNacimiento='{$this->fechaNacimiento()}',estado='{$this->getEstado()}',necesidades='{$this->getNecesidades}',examenesMedicos='{$this->examenesMedicos()}'";
        $update = $this->db->query($sql);
        return $update;
    }
    public function delete()
    {
        $sql = "UPDATE abuelito SET estado='{$this->getEstado()}' WHERE idAbuelito= {$this->id}";
        $delete = $this->db->query($sql);
        $resul = false;
        if ($delete) {
            $resul = true;
        }
        return $resul;
    }
    public function activos()
    {
        $sql = "CALL abuelitoActivos(@a,@b)";
        $r = $this->db->query($sql);
        return $r;
    }
    public function getOne()
    {
        $sql = "SELECT * FROM abuelito WHERE idAbuelito= {$this->getId()}";
        $r = $this->db->query($sql);
        return $r->fetch_object();
    }
}
