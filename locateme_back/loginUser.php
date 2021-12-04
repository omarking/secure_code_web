<?php
include 'conexion.php';
// Obtenemos el JSON recibido en la variable.
// $json = file_get_contents('php://input');
 
// // Recibimos el JSON y se almacena en la variable $ obj.
// $obj = json_decode($json,true);

// // Obtenemos el correo de la matriz JSON $ obj y almacenamos en $ email.
// $correo = $obj['correo'];

// // Obtenemos la contraseña de la matriz JSON $ obj y almacenamos en $ password.
// $contrasenia = $obj['contrasenia'];
// // Obtenemos el correo de la matriz JSON $ obj y almacenamos en $ email.
 $correo = $_POST['correo'];

 $contrasenia = $_POST['contrasenia'];
 
 //Aplicamos la consulta de inicio de sesión de usuario con correo electrónico y contraseña.
 $consultar = $con ->query("select usContrasenia from usuario where usCorreo = '$correo' and usContrasenia = '$contrasenia'");
 $resultado = array();

 while ($extraerDatos = $consultar->fetch_assoc()) {
	 $resultado[]=$extraerDatos;
 }
	 echo json_encode($resultado);
	 
	 mysqli_close($con);
?>