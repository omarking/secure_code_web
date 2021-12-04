<?php
include 'conexion.php';

$consultar = $con ->query("select * from colonia");
$resultado = array();

while ($extraerDatos = $consultar->fetch_assoc()) {
    $resultado[]=$extraerDatos;
}
    echo json_encode($resultado);
 mysqli_close($con);

?>