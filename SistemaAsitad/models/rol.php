<?php 
    class Rol{
        private $db;
        private $idRol;
        private $tipoRol;
    
    public function __construct()
    {
        $this->db=DataBase::conectar();
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function getTipoRol(){
        return $this->tipoRol;
    }
    public function setTipoRol($tipoRol){
        $this->tipoRol=$tipoRol;
    }
    //buscar por id
    public function finId(){
        //crear sentencia
        $sql="SELECT * FROM rol ";
        //enviamos la sentencia
        $result= $this->db->query($sql);
        return $result;
    }
    //consultar usuario por id
    public function findRolID(){
    $sql="SELECT * FROM rol where idRol={$this->getId()}";
    $rol=$this->db->query($sql);
    return $rol->fetch_object();
    }
    //registrar 
    public function save(){
        $sql="INSERT INTO rol VALUES (null,'{$this->getTipoRol()}')";
        $saved = $this->db->query($sql);
        $result = false;
        if ($saved){
            $result = true;
        }
        return $result;
    }
    //editar
    public function update(){
    $sql="UPDATE rol SET tipoRol='{$this->getTipoRol()}'where idRol='{$this->getId()}'";
    $update = $this->db->query($sql);
    $result = false;
    if($update){
        $result=true;
    }
    return $result;
    }
    //eliminar
    public function delete(){
        $sql="DELETE FROM rol WHERE idRol='{$this->idRol}'";
        $delete =$this->db->query($sql);
        $result=false;
        if($delete){
            $result=true;
        }
        return $result;
    }

    }
?>