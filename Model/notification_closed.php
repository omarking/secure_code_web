<?php
include './../Controller/controller_alerta.php'; 
    session_start();
	$idusuario=$_SESSION['idpush'];
    


    $insntanciacontroller= new AlertaController();
    foreach ($insntanciacontroller->ObtenerUsuario($idusuario) as $tokens){
      //echo($tokens->idusuario);
      require_once '../Model/notification.php';
       $notification= new PushNotification();
     

      if( $notification-> enviarNotificacion($tokens->idusuario)) {
        echo '<div class="alert alert-danger">Hubo un error al contactar al servidor intenta mas tarde</div>';
      } else {
        echo '<div class="alert alert-success">Correo enviado correctamente</div>';
      }
      
    
    }
  



?>
