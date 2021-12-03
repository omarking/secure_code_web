<?php
require '../Model/Alerta.php';
require 'starter_controller.php';
include '../assets/resources/pdf.php';
require '../Model/telegram.php';

class AlertaController extends Alerta
{
  private $model;
  public function __CONSTRUCT(){
    $this->model=new Alerta();
      }

  public function AlertaView(){
    require '../View/alertas.php';  
      }
  
  public function MostrarAlertas(){
    $alerta= new Alerta ();
    $dato=$alerta->MostrarAlerta();
    if (empty($dato)){
      echo $dato;}
    else{
        var_dump($dato) ;
        require_one('./../View/alertas.php');
        }
      }

  public function DetalleAlerta($idalerta){
    $alerta   = new Alerta();
    $dato=$alerta->getting($idalerta);
    return $dato;
    }
    
  public function EliminarGeneral($idalerta){
    $alerta   = new Alerta();
    if($dato=$alerta->EliminarGeneral($idalerta)){
      header("location:./../View/alertas_general.php");
      }
   }

  public function EliminarPendiente($idalerta){
    $alerta   = new Alerta();
    if($dato=$alerta->EliminarPendiente($idalerta)){
      header("location:./../View/alertas_general.php");
        }
     }

  public function generarPDF1($idalerta){
    $alerta   = new Alerta();
    $dato=$alerta->getting($idalerta);
    foreach($dato as $dato):
      $idusuario=$dato->CLAVE_USUARIO;   
      $title="Secure Code";
      $fecha= date("d"). "/". date("m"). "/". date("Y") ;
      $pdf = new PDF();
      $pdf->SetTitle($title);
      $pdf->PrintChapter(1,$title,$fecha,$idalerta,$dato->FECHA,$dato->CLAVE_USUARIO,$dato->NOMBRE,$dato->DESCRIPCION,$dato->aler_latitud,$dato->aler_longitud);
      $pdf->Output();
    endforeach;
      }

  public function generarPDFFInalizadp($idalerta, $seratencion,$codatencion){
    include '../assets/resources/finalpdf.php';   
    $alerta   = new Alerta();
        $dato=$alerta->getting($idalerta);
        foreach($dato as $dato):
          $idusuario=$dato->CLAVE_USUARIO;    
          $title="Secure Code";
          $fecha= date("d"). "/". date("m"). "/". date("Y") ;
          $pdf = new PDFFINAL();
          $pdf->SetTitle($title);
          $pdf->PrintChapter(1,$title,$fecha,$idalerta,$dato->FECHA,$dato->CLAVE_USUARIO,$dato->NOMBRE,$dato->DESCRIPCION,$dato->aler_latitud,$dato->aler_longitud, $seratencion,$codatencion);
          $pdf->Output();
        endforeach;
          }
    
  public function envioTelegram($idalerta,$chatID){
        
        $alerta   = new Alerta();
        $ubicacion=$_SESSION['infoDomicilio'];
        $calle = $_SESSION['calle'];
        $numero = $_SESSION['numero'];
        $colonia = $_SESSION['colonia'];
        $municipio = $_SESSION['municipio'];
        $dato=$alerta->getting($idalerta);
        foreach($dato as $dato):
        $idusuario=$dato->CLAVE_USUARIO;    
        date_default_timezone_set('America/Mexico_City');
        $fecha= date("d"). "/". date("m"). "/". date("Y") ;
        $hora=date("g:i a");

        $cabecera_message="Secure Code\n"."Fecha: ".$fecha." Hora: ".$hora."\nSe ha detectado una incidencia con el codigo de alerta: ".$idalerta."\n Descripcion: ".$dato->DESCRIPCION;
        $detalle_message="Emitida por el usuario: ".$dato->NOMBRE."\n Descripcion: ".$dato->DESCRIPCION;
        $ubicacion_calle="Ubicado en calle: ".$calle." numero: ".$numero;
        $ubicacion_municipio="Colonia: ".$colonia." Municipio: ".$municipio;
        endforeach;
        $messageTelegram = new Telegram();
        $messageTelegram->enviarTelegram($cabecera_message,$ubicacion_calle,$ubicacion_municipio, $detalle_message,$chatID);
       }


 
  public function atenderAlertaTelegram($idalerta, $identidad,$idusuario){
    $insntanciacontroller= new AlertaController();
    //PUSH NOTIFICATION
    #require '../Model/notification.php';
    //Obtener Token
    $dato=$insntanciacontroller->ObtenerColonia($idusuario);
    $iusuario=$dato;
    foreach ($iusuario as $va){
    
      $tusuario=$va->idusuario;
      $tcolonia=$va->idcolonia; 
      }
    //var_dump( $tcolonia);


    $token_colonia=$insntanciacontroller->ObtenerTokenTelegram($idusuario);
    foreach ($token_colonia as $va){
    
    $tcolonia=$va->chaIDColonia ; 
    }
    $insntanciacontroller->envioTelegram($idalerta,$tcolonia);
    header("location:./../View/alertas_detalle.php?idalerta=$idalerta");
      }
     
     
     
    public function atenderAlertaPush($idalerta, $identidad,$idusuario){
        $insntanciacontroller= new AlertaController();
        foreach ($insntanciacontroller->ObtenerUsuario($idusuario) as $tokens){
          //echo($tokens->idusuario);
   #       require '../Model/notification.php';
           #$notification= new PushNotification();
          #$notification-> enviarNotificacion($tokens->idusuario);
        
        } 
      }
    

      public function pushnotificacion($idalerta){
     #   require '../Model/notification.php';
     #   $notification= new PushNotification();

        date_default_timezone_set('America/Mexico_City');
        $fecha= date("d"). "/". date("m"). "/". date("Y") ;
        $hora=date("g:i a");

        $cabecera_message="Secure Code\n"+"Fecha: "+$fecha+" Hora: "+$hora+"\nSe ha detectado una incidencia con el codigo de alerta: "+$idalerta;
        $message=$cabecera_message;
      #  $notification-> enviarNotificacion($message);


      }
     

  public function DetalleIdentidad($identidad){
      $alerta   = new Alerta();
      $dato=$alerta->DetalleTipo($identidad);
      return $dato;
      }   

  public function CerrarAlerta($idatencion){
        $alerta   = new Alerta();
        if($dato=$alerta->CerrarAlert($idatencion)){
          
          header("location:./../View/alertas_aprobadas.php");
            }
        
        return $dato;
        } 


}


if (isset($_GET['action']) && $_GET['action']=='detalle'){
  $insntanciacontroller = new AlertaController();
  $this -> DetalleAlerta();
}
if (isset($_GET['action']) && $_GET['action']=='eliminar'){
  $insntanciacontroller = new AlertaController();
  $insntanciacontroller -> EliminarGeneral($_GET['idalerta']);
}

if (isset($_GET['action']) && $_GET['action']=='pdf'){
  $insntanciacontroller = new AlertaController();
    $insntanciacontroller -> generarPDF1($_GET['idalerta']);
}

if (isset($_GET['action']) && $_GET['action']=='pdffinalizado'){
  $insntanciacontroller = new AlertaController();
  
    $insntanciacontroller -> generarPDFFInalizadp($_GET['idalerta'], $_GET['semer'], $_GET['cod']);
}

if (isset($_GET['action']) && $_GET['action']=='atenciont'){
  session_start();
       
  $insntanciacontroller = new AlertaController();
  $insntanciacontroller -> atenderAlertaTelegram($_SESSION['idalerta'], $_GET['identidad'], $_SESSION['idpush']);
  
}

if (isset($_POST['action']) && $_POST['action']=='atenciont'){
  $idalerta=$_REQUEST['idalerta'];
  $identidad=$_POST['identidad'];
 
  $insntanciacontroller = new AlertaController();
  
$insntanciacontroller -> atenderAlertaTelegram($idalerta, $identidad, $_SESSION['idpush']);
}



if (isset($_GET['action']) && $_GET['action']=='atencion'){
  session_start();
       
  $insntanciacontroller = new AlertaController();
  $insntanciacontroller -> atenderAlertaPush($_SESSION['idalerta'], $_GET['identidad'], $_SESSION['idpush']);
  
}

if (isset($_POST['action']) && $_POST['action']=='atencion'){
  $idalerta=$_REQUEST['idalerta'];
  $identidad=$_POST['identidad'];
 
  $insntanciacontroller = new AlertaController();
  $insntanciacontroller -> atenderAlertaPush($idalerta, $identidad, $_SESSION['idpush']);
}

if (isset($_GET['action']) && $_GET['action']=='desplegar'){
  $identidad=$_GET['identidad'];
  echo $identidad;
  $insntanciacontroller = new AlertaController();
  #$insntanciacontroller -> atenderAlerta($_SESSION['idalerta'], $_GET['identidad']);
  
}

if (isset($_POST['action']) && $_POST['action']=='desplegar'){
  $identidad=$_POST['identidad'];
  
  $insntanciacontroller = new AlertaController();
  #$insntanciacontroller -> atenderAlerta($idalerta, $identidad);
}

if (isset($_GET['action']) && $_GET['action']=='cerrarAlerta'){
  $insntanciacontroller = new AlertaController();
  $insntanciacontroller -> CerrarAlerta($_GET['codalerta']);
}


 
?>