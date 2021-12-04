<?php

include 'conexion.php';

$email = $_POST['email'];
$consultar = $con ->query("call verToken('$email')");
$resultado = array();
/* fetch associative array */
while ($row = $consultar->fetch_assoc()) {
    $resultado[]=$row["token"]; 
}
echo json_encode($resultado);
 mysqli_close($con);

?>