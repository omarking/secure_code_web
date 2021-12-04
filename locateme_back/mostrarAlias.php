<?php
include 'conexion.php';

$correo = $_POST['correo'];
$consultar = $con ->query("select usuario.usUsuario from usuario where usuario.usCorreo = '$correo'");
$resultado = array();
/* fetch associative array */
while ($row = $consultar->fetch_assoc()) {
    $resultado[]=$row["usUsuario"]; 
}
echo json_encode($resultado);
 mysqli_close($con);

?>