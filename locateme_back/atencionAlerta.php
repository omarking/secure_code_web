<?php
 //Definimos 
 include 'conexion.php';
 
 //$json = file_get_contents('php://input');
// $obj = json_decode($json,true);
 //$email = $obj['correo'];
 
 $emision = ($_POST['emision']);
 $entidad = ($_POST['entidad']);
 $observacion = ($_POST['observacion']);

$con -> query("CALL guardarAtencion($emision,$entidad,'$observacion')");
	mysqli_close($con);
?>