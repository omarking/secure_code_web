<?php
include 'conexion.php';

$correo = $_POST['correo'];
$consultar = $con ->query("call verEU('$correo')");
$resultado = array();
/* fetch associative array */

while($row = $consultar -> fetch_assoc()) {
    $resultado[]=$row;
    // $resultado[]=$row["usCodigoPostal"];
    // $resultado[]=$row["usColonia"];
    // $resultado[]=$row["usMunicipio"];
}
echo json_encode($resultado);
 mysqli_close($con);

?>


