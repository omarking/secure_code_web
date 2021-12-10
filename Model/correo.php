<?php
session_start();
require '../assets/resources/PHPMailer/class.phpmailer.php';
require '../assets/resources/PHPMailer/class.smtp.php';
$correo = $_POST['text'];
$dom=$_SESSION['infoDomicilio'];
$incidencia=$_SESSION['identidadDes'];
$message='Secure Code ha detectado una incidencia de tipo: '.$incidencia.' ubicada en el domicilio: '.$dom;
$mail = new PHPMailer();
//Definir que vamos a usar SMTP
$mail->IsSMTP();
//Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
// 0 = off (producción)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug  = 0;
//Ahora definimos gmail como servidor que aloja nuestro SMTP
$mail->Host       = 'smtp.gmail.com';
//El puerto será el 587 ya que usamos encriptación TLS
$mail->Port       = 587;
//Definmos la seguridad como TLS
$mail->SMTPSecure = 'tls';
//Tenemos que usar gmail autenticados, así que esto a TRUE
$mail->SMTPAuth   = true;
//Definimos la cuenta que vamos a usar. Dirección completa de la misma
$mail->Username   = "oscarrdz6808@gmail.com";
//Introducimos nuestra contraseña de gmail
$mail->Password   = "oscar4321";
//Definimos el remitente (dirección y, opcionalmente, nombre)
$mail->SetFrom('oscarrdz6808@gmail.com', 'SecureCode');
//Esta línea es por si queréis enviar copia a alguien (dirección y, opcionalmente, nombre)
$mail->AddReplyTo('oscarrdz6808@gmail.com','El de la réplica');
//Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
$mail->AddAddress($correo, 'El Destinatario');
//Definimos el tema del email
$mail->Subject = 'Se ha detectado una incidencia';
//Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
$mail->MsgHTML(file_get_contents('contents.html'));
//Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
$mail->Body = $message;
//Enviamos el correo
if(!$mail->Send()) {
  echo '<div class="alert alert-danger">Hubo un error al contactar al servidor intenta mas tarde</div>';
} else {
  echo '<div class="alert alert-success">Correo enviado correctamente</div>';
}

?>





