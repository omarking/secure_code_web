<?php 
require '../Model/Colonia.php';
#require 'starter_controller.php';

class ColoniaController extends Colonia
{

    public function MostrarColonia(){
        $colonia   = new Colonia();
        $dato=$colonia->MostrarColonia();
        return $dato;
        }   

    public function DetalleMostrarColonia($idcolonia){
        $colonia   = new Colonia();
        $dato=$colonia->DetalleMostrarColonia($idcolonia);
        return $dato;
        }

    public function AgregarColonia($colnombre,$colmunicipio, $chatid,$colcp,$colestado,$collink){
        $colonia   = new Colonia();
        $dato=$colonia->newColonia($colnombre,$colmunicipio, $chatid,$colcp,$colestado,$collink);
        return $dato;
        }    

    public function EditarColonia($idcolonia,$colnombre,$colmunicipio, $chatid,$colcp,$colestado,$collink){                    
        $colonia   = new Colonia();
        if( $dato=$colonia->editColonia($idcolonia,$colnombre,$colmunicipio, $chatid,$colcp,$colestado,$collink)){
          header("location:./../View/colonia_general.php");
        }
            }
                    
    public function EditarUsuarioColonia($idusuario, $idstatus){
        $colonia   = new Colonia();
        if($idstatus==1){
            $idstatus="ALTA";
        }
        if($idstatus==2){
            $idstatus="BAJA";
        }
        if($idstatus==3){
            $idstatus="PENDIENTE";
        }
        if($dato=$colonia->actualizarStatus($idusuario, $idstatus)){
          header("location:./../View/colonia_usuario.php");
        }    }
                            
                    

                      


}
if (isset($_POST['action']) && $_POST['action']=='registrar'){
	$insntanciacontroller = new ColoniaController();
    session_start();
	$insntanciacontroller -> EditarColonia($_SESSION['coloniaid'],$_POST['colnombre'], $_POST['colmunicipio'], $_POST['colchatid'], $_POST['colcp'], $_POST['colestado'],$_POST['collink']);
}

if (isset($_POST['action']) && $_POST['action']=='nuevo'){
	$insntanciacontroller = new ColoniaController();
    session_start();
	$insntanciacontroller -> AgregarColonia($_POST['colnombre'], $_POST['colmunicipio'], $_POST['colchatid'], $_POST['colcp'], $_POST['colestado'],$_POST['collink']);
}
if (isset($_POST['action']) && $_POST['action']=='editar'){
	$insntanciacontroller = new ColoniaController();
	session_start();
	$insntanciacontroller -> EditarUsuarioColonia($_SESSION['usuarioid'], $_POST['idstatus']);
}



 ?>


