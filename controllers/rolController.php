<?php
require_once 'modls/rol.php';
class rolController
{
    public function gestion()
    {
        Utils::isAdmin();
        $r = new Rol();
        $roles = $r->findRolID();
        require_once 'views/rol/crud.php';
    }
    public static function getAll()
    {
        $r = new Rol();
        $roles = $r->findRolID();
        return $roles;
    }
    //registrar
    public function registrar()
    {
        utils::isAdmin();
        //verificacion de envio del post
        if (isset($_POST) && !empty($_POST['tipoRol'])) {
            //almacena datos en variables
            $tipoRol = $_POST['tipoRol'];
            //objeto de rol
            $rol = new Rol();
            //almacena los datos
            $rol->setTipoRol($tipoRol);
            //insert o update
            if (isset($_GET['idRol'])) {
                $id = $_GET['idRol'];
                $rol->setId($id);
                $save = $rol->update();
            } else {
                $save = $rol->save();
            } //verificamos si fue exitoso
            if ($save) {
                if (isset($_GET['id'])) {
                    $_SESSION['saveEdit'] = 'Editado';
                } else {
                    $_SESSION['saveEdit'] = 'Registrado';
                }
            } else {
                $_SESSION['error'] = 'ErrorRegistro';
            }
        } else {
            $_SESSION['notData'] = 'ErrorDatos';
        }
        header('Location: ' . baseUrl . 'cargo/gestion');
    }
    //editar
    public function editar(){
        Utils::isAdmin();
        if(isset($_GET['id'])&& $_GET['id']!=''){
            $editar= true;
            $id= $_GET['id'];
            $rol= new Rol();
            $carEdit= $rol->findRolID();
            require_once 'views/rol/crud.php';
        }else{
            header('Location:'.baseUrl.'eror/index');
        }
    }
    //eliminar
    public function eliminar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id= $_GET['id'];
            $r= new Rol();
            $r->setId($id);
            $delete= $r->delete();
            if($delete){
                $_SESSION['delete']= 'eliminado';
            }else{
                $_SESSION['delete']= 'NoQuery';
            }
        }
        header('Location:'.baseUrl.'rol/gestion');
    }
}
