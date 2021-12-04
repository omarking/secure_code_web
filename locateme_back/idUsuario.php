<?php
 //Definimos 
 include 'conexion.php';
 
 $email = ($_POST["email"]); 

 $consultar = $con ->query("select usuario.idusuario from usuario where usCorreo = '$email'");
 
 $resultado = array();

 while ($row = $consultar->fetch_assoc()) {
	$resultado[]=$row["idusuario"];
 }
	//  echo json_decode($resultado('idusuario'));
	echo json_encode($resultado);
	 mysqli_close($con); 
?>
