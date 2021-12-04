
<?php
include 'conexion.php';

$alerta = $_POST['alerta'];
$consultar = $con ->query("select tipoaler_descripcion from tipo_alerta where idtipo_alerta=$alerta");
$resultado = array();
/* fetch associative array */
while ($row = $consultar->fetch_assoc()) {
    $resultado[]=$row["tipoaler_descripcion"]; 
}
echo json_encode($resultado);
 mysqli_close($con);

?>