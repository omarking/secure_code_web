<?php
include 'conexion.php';

$correo = $_POST['correo'];
$consultar = $con ->query("select usuario.usNombres,usuario.usPrimerApellido,usuario.usSegundoApellido,usuario.usFechaNac,usuario.usTelefono,usuario.usCalle,usuario.usNumero,usuario.usUsuario FROM usuario WHERE usuario.usCorreo = '$correo'");
$resultado = array();
/* fetch associative array */

while($row = $consultar -> fetch_assoc()) {
    $resultado[]=$row["usNombres"];
    $resultado[]=$row["usPrimerApellido"];
    $resultado[]=$row["usSegundoApellido"];
    $resultado[]=$row["usFechaNac"];
    $resultado[]=$row["usTelefono"];
    $resultado[]=$row["usCalle"];
    $resultado[]=$row["usNumero"];
    // $resultado[]=$row["usCodigoPostal"];
    // $resultado[]=$row["usColonia"];
    // $resultado[]=$row["usMunicipio"];
    $resultado[]=$row["usUsuario"];
}
echo json_encode($resultado);
 mysqli_close($con);

?>