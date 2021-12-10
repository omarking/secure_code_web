<?php
require 'conexion.php';


class Usuario 
{
	protected $idusuario;
	protected $usNombres;
	protected $usPrimerApellido;
	protected $usSegundoApellido;
	protected $usFechaNac;
	protected $usTelefono;
	protected $usCalle;
	protected $usNumero;
	protected $usCorreo;
	protected $usUsuario;
	protected $usContrasenia;
	protected $usEstado;	

 protected function LogearUsuario(){
 	$connection = new Connection();
	$sql ="SELECT t1.idusuario, t1.usNombres, t1.usPrimerApellido, t1.usSegundoApellido, t1.usFechaNac, t1.usTelefono, t1.usCalle, t1.usNumero, t1.usCorreo, t1.usUsuario, t1.usContrasenia, t3.rol_descripcion as 'rol', t1.usEstado FROM usuario as t1 INNER JOIN roles_usuario as t2 on t2.idusuario=t1.idusuario INNER JOIN roles as t3 on t3.idroles=t2.idroles WHERE t1.idusuario='$this->idusuario' and usContrasenia='$this->usContrasenia' and t2.idroles='3'";
	$consulta=$connection->db->prepare($sql);
	$consulta->execute();
	$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
	
	foreach ($objUsuario as $usuario){}
	if (empty($usuario)){
		$usuario="sin datos";
	}
	return $usuario;	
 }
	public function MostrarUsuarios(){
	$connection = new Connection();
	$sql ="SELECT DISTINCT T1.idusuario AS 'CLAVE_USUARIO', CONCAT_WS(' ', usNombres, usPrimerApellido, usSegundoApellido) AS 'NOMBRE', usFechaNac AS 'FECHA_NACIMIENTO', usTelefono AS 'TELEFONO', usCalle AS 'CALLE',usCorreo AS 'CORREO', usNumero 'NUMERO' FROM usuario AS T1 INNER JOIN roles_usuario AS T2 ON T1.idusuario=T2.idusuario order by NOMBRE;";
	$consulta=$connection->db->prepare($sql);
	$consulta->execute();
	$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
	return $objUsuario;	
	}

	public function MostrarUsuariosAlerta($idusuario){
		$connection = new Connection();
		$sql ="SELECT DISTINCT idusuario AS 'CLAVE_USUARIO', CONCAT_WS(' ', usNombres, usPrimerApellido, usSegundoApellido) AS 'NOMBRE', usTelefono AS 'TELEFONO', usCalle AS 'CALLE',usCorreo AS 'CORREO', usNumero 'NUMERO'from usuario where idusuario=(SELECT distinct t1.idusuario from usuario_colonia as t1 inner join roles_usuario as t2 on t1.idusuario=t2.idusuario where idColonia=(select distinct idColonia from usuario_colonia  where idusuario=$idusuario  order by idColonia asc limit 1 )and t2.idroles=2);";
		$consulta=$connection->db->prepare($sql);
		$consulta->execute();
		$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
		return $objUsuario;	
		}


	public function DesplegarTipo(){
		$connection = new Connection();
		$sql ="SELECT idroles as 'ID_ROL', rol_descripcion as 'ROL' FROM `roles`;";
		$consulta=$connection->db->prepare($sql);
		$consulta->execute();
		$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
		return $objUsuario;	
		}
	
		public function  obtenerUltimoID(){
			$connection = new Connection();
			$sql ="select idusuario+1 as 'ULTIMO' from usuario order by idusuario desc limit 1;";
			$consulta=$connection->db->prepare($sql);
			$consulta->execute();
			$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
			return $objUsuario;	
			}

	

	public function getting($idusuario){
	
		$connection = new Connection();
		$sql ="SELECT distinct T1.idusuario AS 'CLAVE_USUARIO', CONCAT_WS(' ', usNombres, usPrimerApellido, usSegundoApellido) AS 'NOMBRE', usFechaNac AS 'FECHA_NACIMIENTO', usTelefono AS 'TELEFONO', usCalle AS 'CALLE',usCorreo AS 'CORREO', usNumero 'NUMERO', T3.rol_descripcion AS 'ROL' FROM usuario AS T1 INNER JOIN roles_usuario AS T2 ON T1.idusuario=T2.idusuario INNER JOIN roles AS T3 ON T2.idroles=T3.idroles WHERE T1.idusuario=$idusuario;";	
		$consulta=$connection->db->prepare($sql);
		$consulta->execute();
		$dato= $consulta->fetchAll(PDO:: FETCH_OBJ);
		return $dato;	
		}

	public function newUser($nickname,$selected,$nombre,$correro,$apellido_paterno,$apellido_materno,$password,$fecha_nacimiento,$calle,$numero_calle,$telefono){
		$connection = new Connection();
		if($selected=='Usuario'){
			$valor=1;
		}
		if($selected=='Lider'){
			$valor=2;
		}
		if($selected=='Administrador'){
			$valor=3;
		}
		$ultimo=$this->obtenerUltimoID();
		foreach( $ultimo as $va):			
		$sql ="INSERT INTO `usuario`(`idusuario`, `usNombres`, `usPrimerApellido`, `usSegundoApellido`, `usFechaNac`, `usTelefono`, `usCalle`, `usNumero`, `usCorreo`, `usUsuario`, `usContrasenia`, `usEstado`) 
		VALUES ($va->ULTIMO,'$nombre','$apellido_paterno','$apellido_materno','$fecha_nacimiento','$telefono','$calle','$numero_calle','$correro','$nickname','$password','A');";
		$consulta=$connection->db->prepare($sql);
		$consulta->execute();
		if($consulta->rowCount() > 0){	
		$this->newUserRol($selected,$va->ULTIMO);
			return true;
		
		}
		else{
		return false; 
		}
		
		
		endforeach;		

	}



	public function newUserRol($selected,$idusuario){
		$connection = new Connection();
		
		$ultimo=$this->obtenerUltimoID();
		foreach( $ultimo as $va):			
		$sql ="INSERT INTO `roles_usuario`( `idroles`, `idusuario`, `ad_rol_usu_estado`) 
		VALUES ($selected,$idusuario,'A')";
		$consulta=$connection->db->prepare($sql);
		$consulta->execute();
		if($consulta->rowCount() > 0){	
		
			return true;
		
		}
		else{
		return false; 
		}
		
		
		endforeach;		

	}


}
  ?>