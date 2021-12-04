<?php
include 'conexion.php';


$nombre = ($_POST['nombre']);
$apellidoUno = ($_POST['apellidoUno']);
$apellidoDos = ($_POST['apellidoDos']);
$fechaNac = ($_POST['fechaNac']);
$telefono = ($_POST['telefono']);
$calle = ($_POST['calle']);
$numero = ($_POST['numero']);
$email = ($_POST['email']);
$usuario = ($_POST['usuario']);


$con ->query("call actualizarUsuario('$nombre','$apellidoUno','$apellidoDos','$fechaNac','$telefono','$calle','$numero','$email','$usuario')");

 mysqli_close($con);

?>
