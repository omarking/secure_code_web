<?php
 //Definimos 
 include 'conexion.php';
 
 //$json = file_get_contents('php://input');
// $obj = json_decode($json,true);
 //$email = $obj['correo'];
 
 $email = ($_POST['email']);
 $token = ($_POST['token']);

$con -> query("call guardarToken('$email','$token')");
	mysqli_close($con);
?>


