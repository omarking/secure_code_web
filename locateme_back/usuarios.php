<?php
include 'conexion.php';
$email = $_POST['email'];
$consultar = $con ->query("call verUC('$email')");
$resultado = array();

while ($extraerDatos = $consultar->fetch_assoc()) {
    $resultado[]=$extraerDatos;
}
    echo json_encode($resultado);
 mysqli_close($con);

?>