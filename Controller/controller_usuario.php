<?php 
require '../Model/Usuario.php';
#require 'starter_controller.php';

class UsuarioController extends Usuario
{
	
	public function LoginView(){
		require '../View/login.php';
	}
	public function Logout(){
		echo 'sesion no destruida';
		session_start();
		session_destroy();
		echo 'sesion destruida';
		require '../index.php';
	}

	public function redirectprincipal(){
		require '../View/home.php';
	}

	public function VerificarLogin($idusuario, $usContrasenia){
		$this-> idusuario=$idusuario;
		$this-> usContrasenia=$usContrasenia;
		$objLogin= $this->LogearUsuario();
		$hash= password_hash($this->usContrasenia, PASSWORD_BCRYPT);
		if($objLogin =="sin datos")
		{
			$_SESSION['error']="No se encontro el usuario";
			echo "<script>
			alert('No se encontro usuario');      
			window.location= '../View/login.php'
			</script>";
		}else{
			
			if(password_verify($this->usContrasenia, $hash)){
			session_start();
			$_SESSION['idusuario'] =$objLogin->idusuario;
			$_SESSION['usNombres'] =$objLogin->usNombres;
			$_SESSION['usPrimerApellido'] =$objLogin->usPrimerApellido;
			$_SESSION['usSegundoApellido'] =$objLogin->usSegundoApellido;
			$_SESSION['usFechaNac'] =$objLogin->usFechaNac;
			$_SESSION['usTelefono'] =$objLogin->usTelefono;
			$_SESSION['usCalle']=$objLogin->usCalle;
			$_SESSION['usNumero']=$objLogin->usNumero;
			$_SESSION['usCorreo']=$objLogin->usCorreo;
			$_SESSION['usUsuario']=$objLogin->usUsuario;
			$_SESSION['usContrasenia']=$objLogin->usContrasenia;  
			$_SESSION['usEstado']=$objLogin->usEstado;
			$_SESSION['rol']=$objLogin->rol; 
			
			$this -> redirectprincipal(); 
			}else{
				$_SESSION['error']="Contraseña incorrecta";
			 
				if(!empty($_SESSION['error'])){
					$error=$_SESSION['error'];
				   echo "<script type='text/javascript'> 
				   alert($error);
					 </script>";
					 $this->LoginView(); 
				  }
		
				}
				
			
		}
	}

public function DetalleUsuario($idusuario){
	$usuario   = new Usuario();
	$dato=$usuario->getting($idusuario);
  	return $dato;
 }
	
 public function obtenerUltimo(){
	$usuario   = new Usuario();
	$dato=$usuario->obtenerUltimoID();
  	return $dato;
 }

 
 public function nuevoUsuario($nickname,$selected,$nombre,$correro,$apellido_paterno,$apellido_materno,$password,$fecha_nacimiento,$calle,$numero_calle,$telefono,$idstatus){
	if($idstatus==1){
		$idstatus="ALTA";
	}
	if($idstatus==2){
		$idstatus="BAJA";
	}
	if($idstatus==3){
		$idstatus="PENDIENTE";
	}
	$usuario= new Usuario();
	if($dato=$usuario->newUser($nickname,$selected,$nombre,$correro,$apellido_paterno,$apellido_materno,$password,$fecha_nacimiento,$calle,$numero_calle,$telefono,$idstatus)){
		header("location:./../View/usuario_general.php");
		  }


 }



}

if (isset($_POST['action']) && $_POST['action']=='login'){
	$insntanciacontroller = new UsuarioController();
	$insntanciacontroller -> VerificarLogin($_POST['inpUsuario'], $_POST['inpPassword']);
}

if (isset($_GET['action']) && $_GET['action']=='login'){
	$insntanciacontroller = new UsuarioController();
	$insntanciacontroller -> LoginView();
}

if (isset($_GET['action']) && $_GET['action']=='logout'){
	echo 'sesion destruida';
	$insntanciacontroller = new UsuarioController();
	$insntanciacontroller -> Logout();
}

if (isset($_POST['action']) && $_POST['action']=='registrar'){
	$insntanciacontroller = new UsuarioController();
	
	$insntanciacontroller -> nuevoUsuario($_POST['nickname'], $_POST['selected'], $_POST['nombre'], $_POST['correro'], $_POST['apellido_paterno'], $_POST['apellido_materno'], $_POST['password'], $_POST['fecha_nacimiento'], $_POST['calle'], $_POST['numero_calle'], $_POST['telefono'],$_POST['idstatus']);
}


    ?>







 ?>