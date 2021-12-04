<?php
include 'conexion.php';

$correo = $_POST['correo'];
$consultar = $con ->query("CALL ubicacionGuardada('$correo')");
$resultado = array();
/* fetch associative array */
while($row = $consultar -> fetch_assoc()) {
    $resultado[]=$row['ubi_latitud'];
    $resultado[]=$row['ubi_longitud'];
    
}
echo json_encode($resultado);
 mysqli_close($con);

?>