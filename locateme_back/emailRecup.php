<?php
include 'conexion.php';
    $correo = ($_POST['correo']);
    $consultar = $con ->query("call verContrasenia('$correo')");
$resultado = array();
/* fetch associative array */
while ($row = $consultar->fetch_assoc()) {
    $resultado[]=$row["usContrasenia"]; 
}
 echo json_encode($resultado);

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "codeway.corp@gmail.com";
    $subject = "Recuperación de contraseña";
    $message = " RECUERDA GUARDARLA MUY BIEN \n\n Tu contraseña ingresada está entre comillas: \n".json_encode($resultado[0]);
    $headers = "From:" . $from;
    mail($correo,$subject,$message, $headers);
     mysqli_close($con);
?>

