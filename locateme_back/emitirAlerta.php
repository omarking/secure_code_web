<?php
include 'conexion.php';


$correo = ($_POST['correo']);
$alerta = $_POST['alerta'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];


$con ->query("CALL emitirAlerta('$correo','$alerta','$latitud','$longitud')");
 mysqli_close($con);

?>

