<?php
 //Definimos 
 include 'conexion.php';
 
 //$json = file_get_contents('php://input');
// $obj = json_decode($json,true);
 //$email = $obj['correo'];
 
 $col = ($_POST['col']);
 $email = ($_POST['email']);

$con -> query("call guardarColonia($col,'$email')");
	mysqli_close($con);
?>