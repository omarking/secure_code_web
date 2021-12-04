<?php
include 'conexion.php';


// $consultar = $con ->query("select tipoaler_descripcion from tipo_alerta");
// $resultado = array();

// /* fetch associative array */
// while ($row = $consultar->fetch_assoc()) {
//     $resultado[]=$row["tipoaler_descripcion"];
    
// }
// echo json_encode($resultado);
// *****************************
$consultar = $con ->query("select * from tipo_alerta");
$resultado = array();

while ($extraerDatos = $consultar->fetch_assoc()) {
    $resultado[]=$extraerDatos;
}
    echo json_encode($resultado);
 mysqli_close($con);

// *******************************
// // Decode JSON data to PHP associative array
// $arr = json_decode($resultado, true);
// echo "Parsing data by using PHP Array <br/>";

// // Access values from the associative array
// echo $arr["tipoaler_descripcion"]."<br/>";
// $obj = json_decode($resutado);
// echo "Parsing data by using PHP Object <br/>";

// // Access values from the returned object
// echo $obj->tipoaler_descripcion."<br/>";
?>