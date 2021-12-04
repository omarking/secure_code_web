<?php
include 'conexion.php';

$consultar = $con ->query("select * from roles");
$resultado = array();

while ($extraerDatos = $consultar->fetch_assoc()) {
    $resultado[]=$extraerDatos;
}
    echo json_encode($resultado);
 mysqli_close($con);

?>