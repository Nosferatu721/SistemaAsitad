<?php 
    class Apadrinamiento{
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
        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id=$id;
        }
        public function getFechaIncial(){
            return $this-> fechaInicial;
        }
        public function setFechaIncial($fechaInicial){
            $this->fechaInicial=$fechaInicial;
        }
        public function getAbuelito_idAbuelito(){
            return $this->abuelito_idAbuelito;
        }
        public function setAbuelito_idAbuelito($abuelito_idAbuelito){
            $this->fechaInicial=$fechaInicial;
        }
        public function getUsuario_idUsuario(){
            return $this->usuario_idUsuario;
        }
        public function setUsuario_idUsuario($usuario_idUsuario){
            $this->usuario_idUsuario=$usuario_idUsuario;
        }
        private function getEstado(){
            return $this->estado;
        }
        private function setEstado($estado){
            $this->estado=$estado;
        }
        private function getRazon(){
            return $this->razon;
        }
        private function setRazon(){
            $this->razon=$razon;
        }
        // consultar apadrinamiento
        public function findAll(){
            $sql="SELECT * FROM apadrinamiento INNER JOIN abuelito ON apadrinamiento.abuelito_idAbuelito=id INNER JOIN usuarios ON apadrinamiento.usuario_idUsuario=usuarios.id";  
            $finded=$this->db->query($sql);
            return $finded; 
        }
        //consultar po id apadrinamiento
        public function findID(){
        $sql="SELECT * FROM apadrinamiento INNER JOIN abuelito ON apadrinamiento.abuelito_idAbuelito=id INNER JOIN usuarios ON apadrinamiento.usuario_idUsuario=usuarios.id WHERE id={$this->getId()}";
        $finded =$this->db->query($sql);
        return $finded;
        }
        // consultar por id usuario
        public function findAllUsuario(){
            $sql="SELECT * FROM usuarios";
            $finded=$this->db->query($sql);
            return $finded;
        }
        //consultar por id abuelito
        public function findAllAbuelito(){
            $sql="SELECT * FROM abuelito";
            $finded=$this->db->query($sql);
            return $finded;
        }
        //guardar
        public function save(){
            $sql= "INSERT INTO apadrinamiento VALUES (null,'{$this->getFechaInial()}','{$this->getAbuelito_idAbuelito()}','{$this->getUsuario_idUsuario()}','{$this->getEstado()}','{$this->getRazon}')";
            $saved= $this->db->query($sql);
            return $saved;
        }
        //actualizar- editar
        public function update (){
            $sql= "UPDATE apadrinamiento SET fechaInicial='{$this->getFechaInial()}', abuelito_idAbuelito='{$this->getAbuelito_idAbuelito()}',usuario_idUsuario='{$this->getUsuario_idUsuario()}', estado='{$this->getEstado()}',razon='{$this->getRazon()}' WHERE id={$this->getId}";
            $update =$thhis->db->query($sql);
            return $update;
        }
        //cancelar
        public function delete(){
        $sql="DELETE FROM apadrinamiento WHERE id={$this->getId()}";
        $delete =$this->db->query($sql);
        return $delete;
        }
    }
?>