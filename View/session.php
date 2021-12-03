<?php
session_start();
$text = $_POST['text'];
$calle = $_POST['calle'];
$numero = $_POST['numero'];
$colonia = $_POST['colonia'];
$municipio = $_POST['municipio'];
$idpush = $_POST['idpush'];
$incidencia=$_POST['identidadDes'];
$idalerta=$_POST['idalerta'];
$message=$_POST['message'];
#echo $text;
$_SESSION['infoDomicilio']=$text;
$_SESSION['calle']=$calle;
$_SESSION['numero']=$numero;
$_SESSION['colonia']=$colonia;
$_SESSION['municipio']=$municipio;
$_SESSION['idpush']=$idpush;
$_SESSION['identidadDes']=$incidencia;					
$_SESSION['idalerta']=$idalerta;
$_SESSION['message']=$message;

?>