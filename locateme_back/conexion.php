<?php
 // Conexion con MySLQ
 //$con = mysqli_connect("localhost","u743223069_locatem3","bdLocateme3","u743223069_locateme","3306");
 $con = mysqli_connect("127.0.0.1","root","12345","locateme2");
 if ($con) {
         //echo "conexion exitosa";
    }else{
        echo "Fallo la conexion ";
        exit();
    }
 ?>