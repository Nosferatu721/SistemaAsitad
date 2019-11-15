<?php
require_once 'models/tipoActividad.php';

class tipoActividadController
{
    public function gestion(){
        Utils::isAdmin();
        $tp= new TipoActividad;
        $tipos = $tp->findTipos();
        require_once 'views/actividad/tipoActividad/crud.php';
    }
    public static function getAll()
    {
      $tp = new TipoActividad();
      $tipos = $tp->findTipos();
      return $tipos;
    }
    //registar
    public function registrar(){
        Utils::isAdmin();
        if(isset ($_POST)&& !empty($_POST['tipoActividad'])){
            $tipoActividad = $_POST['tipoActividad'];
            $tp = new TipoActividad();
            $tp->setTipoActividad($tipoActividad);
            if(isset($_GET['idTipoActividad'])){
                $id= $_GET ['idTipoActividad'];
                $tp->setId($id);
                $save= $tp->update();
            }else{
                $save= $tp->save();
            }
            if($save){
                if(isset ($_GET['idTipoActividad'])){
                    $_SESSION['saveEdit']= 'Editado';
                }else{
                    $_SESSION['saveEdit']= 'Registrado';
                }
            }
            else{
                $_SESSION['eror']= 'ErrorRegistrado';
            }
        }else{
            $_SESSION ['eror']= 'ErorDatos';
        }
        header('Location:'.baseUrl.'tipoMerma/gestion');
    }
    //editar
    public function editar(){
        Utils::isAdmin();
        if(isset($_GET['idTipoActividad'])&& $_GET ['idTipoActividad'] !=''){
            $editar = true;
            $id = $_GET['idTipoActividad'];
            $tp = new TipoActividad();

            $tp->setId ($id);
            $tipoEdit = $tp->findTipoAID();
            require_once 'views/actividad/tipoActividad/crud.php';
            }else{
                header('Location:'.baseUrl.'eror/index');
            }
        }
        public function eliminar(){
            Utils::idAdmin();
            if(isset($_GET['idTipoActividad'])){
                $id = $_GET ['idTipoActividad'];
                $tp= new TipoActividad();
                $tp->setId($id);
                $delete= $tp->delete();
                if($delete){
                    $_SESSION['delete']= 'eliminado';
                }
                else{
                    $_SESSION['delete']= 'NoQuery';
                }
            }
            header('Location:'.baseUrl.'tipoActividad/gestion');
        }
    }
 ?>