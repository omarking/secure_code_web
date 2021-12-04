<?php
 //Definimos 
 include 'conexion.php';
 
 //$json = file_get_contents('php://input');
// $obj = json_decode($json,true);
 //$email = $obj['correo'];
 
 $nombre = ($_POST['nombre']);
 $apellidoUno = ($_POST['apellidoUno']);
 $apellidoDos = ($_POST['apellidoDos']);
 $fechaNac = ($_POST['fechaNac']);
 $telefono = ($_POST['telefono']);
 $calle = ($_POST['calle']);
 $numero = ($_POST['numero']);
 $email = ($_POST['email']);
 $usuario = ($_POST['usuario']);
 $contrasenia = ($_POST['contrasenia']);
 

$consultar = $con -> query("call registrarUsuario('$nombre','$apellidoUno','$apellidoDos','$fechaNac','$telefono','$calle','$numero','$email','$usuario','$contrasenia')");
$resultado = array();

while ($row = $consultar->fetch_assoc()) {
    $resultado[]=$row;
}
    echo json_encode($resultado);
 mysqli_close($con);

?>