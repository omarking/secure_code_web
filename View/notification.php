<?php
include './../Controller/controller_alerta.php'; 
    session_start();
	$idusuario=$_SESSION['idpush'];
  $badera=false;


    $insntanciacontroller= new AlertaController();
    foreach ($insntanciacontroller->ObtenerUsuario($idusuario) as $tokens){
      //echo($tokens->idusuario);
      require_once '../Model/notification.php';
       $notification= new PushNotification();
     

      if( $notification-> enviarNotificacion($tokens->idusuario)) {
        $bandera=true;
      } else {
        $bandera=false;
      }
      
    
    }

  



?>

























