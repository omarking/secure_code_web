
<?php
 //Definimos 
 include 'conexion.php';
 
 //$json = file_get_contents('php://input');
// $obj = json_decode($json,true);
 //$email = $obj['correo'];
 
 $email = ($_POST['email']);
 $lat = ($_POST['lat']);
 $long = ($_POST['long']);

$con -> query("call guardarUbicacion('$email','$lat','$long')");
	mysqli_close($con);
?>
