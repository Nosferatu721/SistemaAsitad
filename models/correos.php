<?php 
    class correos{
        private $db;

        public function __construct()
        {
            $this->db = DataBase:: conectar();
        }
    }
?>