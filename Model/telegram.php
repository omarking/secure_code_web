<?php
 
class Telegram{


  public $token = "2040817676:AAFe3zXvBL63TBFbn7o8McUxcj--66c3Luc";
  public$id = "-1001708737578";
  
  public function enviarTelegram( $caabecera_message,$uubicacion_calle,$uubicacion_municipio,$udetalle_message,$chatID){
  $telegram= new Telegram();
  
  $telegram->enviarTelegramm( $caabecera_message,$uubicacion_calle,$uubicacion_municipio,$udetalle_message,$chatID);

                      ///SERVIDOR///
 // $telegram->enviarTelegramSevidor( $caabecera_message,$uubicacion_calle,$uubicacion_municipio,$udetalle_message,$chatID);

  
  }
  
  public function enviarTelegramm( $caabecera_message,$uubicacion_calle,$uubicacion_municipio,$udetalle_message,$chatID){
    $bandera=false;
    $chaID=strval($chatID);
    $chaID=urlencode($chatID);
    //echo $chaID;
    $cabecera_message=urlencode($caabecera_message);     
      $detalle_message=urlencode($udetalle_message);
      $ubicacion_calle=urlencode($uubicacion_calle);
      $ubicacion_municipio=urlencode($uubicacion_municipio);
      $_SESSION['message']=$caabecera_message.'\n\n'.$udetalle_message.'\n\n'.$uubicacion_calle.'\n\n'.$uubicacion_municipio;
 
      if($telegramUrl = "https://estadia-1719110304.darkstark96.repl.co/telegram/telegram2.php?message=$cabecera_message&chatid=$chaID"){
        $bandera=true;            
        $geocodeResponseData = file_get_contents($telegramUrl);
        #$responseData = json_decode($geocodeResponseData, true);
          }
      if($telegramUrl = "https://estadia-1719110304.darkstark96.repl.co/telegram/telegram2.php?message=$detalle_message&chatid=$chaID"){
        $geocodeResponseData = file_get_contents($telegramUrl);
        $bandera=true;
        #$responseData = json_decode($geocodeResponseData, true);
      }
      if($telegramUrl = "https://estadia-1719110304.darkstark96.repl.co/telegram/telegram2.php?message=$ubicacion_calle&chatid=$chaID"){
        $geocodeResponseData = file_get_contents($telegramUrl);
        #$responseData = json_decode($geocodeResponseData, true);
        $bandera=true;
      }
      if($telegramUrl = "https://estadia-1719110304.darkstark96.repl.co/telegram/telegram2.php?message=$ubicacion_municipio&chatid=$chatID"){
        $geocodeResponseData = file_get_contents($telegramUrl);
        #$responseData = json_decode($geocodeResponseData, true);
        $bandera=true;
      }
      #var_dump(json_decode($geocodeResponseData));
      }


/*              SERVIDOR      */

public function enviarTelegramSevidor( $caabecera_message,$uubicacion_calle,$uubicacion_municipio,$udetalle_message,$chatID){
  
  $token = "2040817676:AAFe3zXvBL63TBFbn7o8McUxcj--66c3Luc";
  $ID = "-1001708737578";
  $bandera=false;
  $ID=strval($chatID);
  $ID=urlencode($chatID);
  //echo $chaID;
  $cabecera_message=urlencode($caabecera_message);     
    $detalle_message=urlencode($udetalle_message);
    $ubicacion_calle=urlencode($uubicacion_calle);
    $ubicacion_municipio=urlencode($uubicacion_municipio);
    $_SESSION['message']=$caabecera_message.'\n\n'.$udetalle_message.'\n\n'.$uubicacion_calle.'\n\n'.$uubicacion_municipio;



https://api.telegram.org/bot2040817676:AAFe3zXvBL63TBFbn7o8McUxcj--66c3Luc/sendMessage?chat_id=$chatID&text=$detalle_message

    if($telegramUrl = "https://api.telegram.org/bot2040817676:AAFe3zXvBL63TBFbn7o8McUxcj--66c3Luc/sendMessage?chat_id=$chatID&text=$cabecera_message"){
      $bandera=true;            
      $geocodeResponseData = file_get_contents($telegramUrl);
      #$responseData = json_decode($geocodeResponseData, true);
        }
    if($telegramUrl = "https://api.telegram.org/bot2040817676:AAFe3zXvBL63TBFbn7o8McUxcj--66c3Luc/sendMessage?chat_id=$chatID&text=$detalle_message"){
      
      $geocodeResponseData = file_get_contents($telegramUrl);
      $bandera=true;
      #$responseData = json_decode($geocodeResponseData, true);
    }
    
    if($telegramUrl = "https://api.telegram.org/bot2040817676:AAFe3zXvBL63TBFbn7o8McUxcj--66c3Luc/sendMessage?chat_id=$chatID&text=$ubicacion_calle"){
      $geocodeResponseData = file_get_contents($telegramUrl);
      #$responseData = json_decode($geocodeResponseData, true);
      $bandera=true;
    }
    if($telegramUrl = "https://api.telegram.org/bot2040817676:AAFe3zXvBL63TBFbn7o8McUxcj--66c3Luc/sendMessage?chat_id=$chatID&text=$ubicacion_municipio"){
      $geocodeResponseData = file_get_contents($telegramUrl);
      #$responseData = json_decode($geocodeResponseData, true);
      $bandera=true;
    }
    #var_dump(json_decode($geocodeResponseData));
    }
   
      
    }
?>