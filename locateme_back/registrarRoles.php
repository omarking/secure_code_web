<?php
 //Definimos 
 include 'conexion.php';
 
 //$json = file_get_contents('php://input');
// $obj = json_decode($json,true);
 //$email = $obj['correo'];
 
 $rol = ($_POST['rol']);
 $email = ($_POST['email']);
 

$con -> query("call guardarRoles($rol,'$email')");

	mysqli_close($con);
?>