<?php  
    require '../Model/SerEmergencia.php';


class ServEmergenciaController extends SerEmergencia
{

    private $model;
    public function __CONSTRUCT(){
          $this->model=new SerEmergencia();
      }
    
    public function DetalleServicios($identidad){
        $servicio= new SerEmergencia();
            $dato=$servicio-> getting($identidad);
            return $dato;
    }

}

?>