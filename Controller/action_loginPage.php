<?php
    include './../bd/BDconnection.php';
    $usuario =$_POST['inpUsuario'];
    $password = $_POST['inpPassword'];
    $idusuario=""; $usUsuario=""; $usContrasenia="";
    $consulta = "SELECT * FROM usuario as t1 INNER JOIN roles_usuario as t2 on t1.idusuario=t2.idusuario WHERE t1.idusuario='$usuario' and usContrasenia='$password' and t2.idroles='3';"; 
    $resultado =mysqli_query($conn, $consulta);
    while ($row = mysqli_fetch_assoc($resultado)) {                
        $idusuario = $row[ 'idusuario' ];
        $usNombres = $row['usNombres'];
        $usPrimerApellido = $row['usPrimerApellido'];
        $usPrimerApellido = $row['usSegundoApellido'];
        $usFechaNac = $row['usFechaNac'];
        $usTelefono = $row['usTelefono'];
        $usCalle = $row['usCalle'];
        $usNumero = $row['usNumero'];
        $usCorreo = $row['usCorreo'];
        $usUsuario = $row["usUsuario"];
        $usEstado = $row["usEstado"];
        $usContrasenia = $row["usContrasenia"];
        }
        
    if($idusuario != $usuario || $usContrasenia != $password){ 
        echo '<script language="javascript">';
        echo 'alert("Verfica tus datos")';
        header("Refresh:0; url=index.php");    
        echo '</script>';
    }

    elseif($idusuario == $usuario & $password == $usContrasenia) {
        echo '<script language="javascript">';
        echo 'alert("Inicio exitoso")';
        header("location: ./../views/home.php");
        echo '</script>';
    } 
?>