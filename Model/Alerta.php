<?php 
require 'conexion.php';

class Alerta 
{
	protected $idemision_alerta;
	protected $idusuario;
	protected $idtipo_alerta;
	protected $aler_latitud;
	protected $aler_longitud;
	protected $aler_fecha;
	protected $aler_estado;


	public function GeneralAlerta(){
 	$connection = new Connection();
	$sql ="SELECT idemision_alerta AS 'ID_ALERTA', T2.idusuario AS 'CLAVE_USUARIO', concat_ws(' ', T2.usNombres, 
	T2.usPrimerApellido, T2.usSegundoAPellido)as 'NOMBRE', tipoaler_descripcion AS 'DESCRIPCION', 
	aler_latitud AS 'LATITUD', aler_longitud AS 'LONGITUD', aler_fecha AS 'FECHA' FROM alerta_emision AS T1 INNER JOIN usuario AS T2 ON T1.idusuario=T2.idusuario INNER JOIN tipo_alerta AS T3 ON T1.idtipo_alerta=T3.idtipo_alerta order by ID_ALERTA desc";
	$consulta=$connection->db->prepare($sql);
	$consulta->execute();
	$dato= $consulta->fetchAll(PDO:: FETCH_OBJ);
	return $dato;	
}
public function PendientesAlerta(){
	$connection = new Connection();
   $sql ="SELECT idemision_alerta AS 'ID_ALERTA', T2.idusuario AS 'CLAVE_USUARIO', concat_ws(' ', T2.usNombres, 
   T2.usPrimerApellido, T2.usSegundoAPellido)as 'NOMBRE', tipoaler_descripcion AS 'DESCRIPCION', 
   aler_latitud AS 'LATITUD', aler_longitud AS 'LONGITUD', aler_fecha AS 'FECHA' FROM alerta_emision AS T1 INNER JOIN usuario AS T2 ON T1.idusuario=T2.idusuario INNER JOIN tipo_alerta AS T3 ON T1.idtipo_alerta=T3.idtipo_alerta WHERE aler_estado='A' order by FECHA desc";
   $consulta=$connection->db->prepare($sql);
   $consulta->execute();
   $dato= $consulta->fetchAll(PDO:: FETCH_OBJ);
   return $dato;	
}

public function AprobadasAlertas(){
	$connection = new Connection();
   $sql ="SELECT idemision_alerta AS 'ID_ALERTA', T2.idusuario AS 'CLAVE_USUARIO', concat_ws(' ', T2.usNombres, 
   T2.usPrimerApellido, T2.usSegundoAPellido)as 'NOMBRE', tipoaler_descripcion AS 'DESCRIPCION', 
   aler_latitud AS 'LATITUD', aler_longitud AS 'LONGITUD', aler_fecha AS 'FECHA' FROM alerta_emision AS T1 INNER JOIN usuario AS T2 ON T1.idusuario=T2.idusuario INNER JOIN tipo_alerta AS T3 ON T1.idtipo_alerta=T3.idtipo_alerta WHERE aler_estado='I' order by FECHA desc";
   $consulta=$connection->db->prepare($sql);
   $consulta->execute();
   $dato= $consulta->fetchAll(PDO:: FETCH_OBJ);
   return $dato;	
}

public function EsperaAlertas(){
	$connection = new Connection();
   $sql ="SELECT DISTINCT t1.idatencion_alerta as 'CODIGO_ATENCION', t1.idemision_alerta AS 'CODIGO_ALERTA', t3.enti_descripcion AS 'ENTIDAD', t1.ateFecha_atendida AS 'FECHA_ATENCION', T2.aler_fecha AS 'FECHA_EMISION', T1.ateObservaciones AS 'ESTADO', T2.aler_latitud AS 'LATITUD', T2.aler_longitud AS 'LONGITUD', t4.tipoaler_descripcion AS 'DESCRIPCION'
   from atencion_alerta as t1 INNER JOIN alerta_emision as t2 on t1.idemision_alerta=t2.idemision_alerta INNER JOIN entidades_emergencia as t3 on t1.identidades=t3.identidades_emergencia INNER JOIN tipo_alerta as t4 on t2.idtipo_alerta=t4.idtipo_alerta INNER JOIN usuario as t5 on t2.idusuario=t5.idusuario where t1.ateObservaciones='Espera' order by CODIGO_ATENCION desc";
  $consulta=$connection->db->prepare($sql);
   $consulta->execute();
   $dato= $consulta->fetchAll(PDO:: FETCH_OBJ);
   return $dato;	
}

public function AtendidadAlertas(){
	$connection = new Connection();
   $sql ="SELECT t1.idatencion_alerta as 'CODIGO_ATENCION', t1.idemision_alerta AS 'CODIGO_ALERTA', t3.enti_descripcion AS 'ENTIDAD', t1.ateFecha_atendida AS 'FECHA_ATENCION', T2.aler_fecha AS 'FECHA_EMISION', T1.ateObservaciones AS 'ESTADO', T2.aler_latitud AS 'LATITUD', T2.aler_longitud AS 'LONGITUD', t4.tipoaler_descripcion AS 'DESCRIPCION'
   from atencion_alerta as t1 INNER JOIN alerta_emision as t2 on t1.idemision_alerta=t2.idemision_alerta INNER JOIN entidades_emergencia as t3 on t1.identidades=t3.identidades_emergencia INNER JOIN tipo_alerta as t4 on t2.idtipo_alerta=t4.idtipo_alerta INNER JOIN usuario as t5 on t2.idusuario=t5.idusuario where t1.ateObservaciones='Atendido' order by FECHA_ATENCION desc";
  $consulta=$connection->db->prepare($sql);
   $consulta->execute();
   $dato= $consulta->fetchAll(PDO:: FETCH_OBJ);
   return $dato;	
}

public function AtendidadAlertasD($idatencion){
	$connection = new Connection();
   $sql ="SELECT t1.idatencion_alerta as 'CODIGO_ATENCION', t1.idemision_alerta 
   AS 'CODIGO_ALERTA', t3.enti_descripcion AS 'ENTIDAD', t1.ateFecha_atendida 
   AS 'FECHA_ATENCION', T2.aler_fecha AS 'FECHA_EMISION', T1.ateObservaciones AS 
   'ESTADO', T2.aler_latitud AS 'LATITUD', T2.aler_longitud AS 
   'LONGITUD', t4.tipoaler_descripcion AS 'DESCRIPCION', t5.idusuario as
    'CLAVE_USUARIO', CONCAT_WS(' ', t5.usNombres, t5.usPrimerApellido, t5.usSegundoApellido) 
	as 'NOMBRE_USUARIO' from atencion_alerta as t1 INNER JOIN alerta_emision as t2 on t1.idemision_alerta=t2.idemision_alerta
	 INNER JOIN entidades_emergencia as t3 on t1.identidades=t3.identidades_emergencia INNER JOIN tipo_alerta
	  as t4 on t2.idtipo_alerta=t4.idtipo_alerta INNER JOIN usuario
	 as t5 on t2.idusuario=t5.idusuario where t1.idatencion_alerta=$idatencion";
   $consulta=$connection->db->prepare($sql);
   $consulta->execute();
   $dato= $consulta->fetchAll(PDO:: FETCH_OBJ);
   return $dato;	
}


public function getting($ialerta){	
	$connection = new Connection();
	$sql ="SELECT idemision_alerta AS 'ID_ALERTA', T2.idusuario AS 'CLAVE_USUARIO', concat_ws(' ', T2.usNombres, T2.usPrimerApellido, T2.usSegundoAPellido)as 'NOMBRE', tipoaler_descripcion AS 'DESCRIPCION', aler_latitud as 'LATITUD', aler_longitud AS 'LONGITUD', aler_fecha AS 'FECHA', aler_longitud, aler_latitud FROM alerta_emision AS T1 INNER JOIN usuario AS T2 ON T1.idusuario=T2.idusuario INNER JOIN tipo_alerta AS T3 ON T1.idtipo_alerta=T3.idtipo_alerta WHERE idemision_alerta=$ialerta";		
	$consulta=$connection->db->prepare($sql);
	$consulta->execute();
	$dato= $consulta->fetchAll(PDO:: FETCH_OBJ);
	return $dato;	
		}

public function EliminarGeneral($idalerta){
	$connection = new Connection();
	$sql ="DELETE FROM alerta_emision WHERE idemision_alerta =$idalerta";		
	$consulta=$connection->db->prepare($sql);
	$consulta->execute();
	if($consulta->rowCount() > 0){	
		return true;
	}
	else{
    	return false; 
		}		
	}
	public function MostrarLiderAlerta($idusuario){
		$connection = new Connection();
		$sql ="SELECT DISTINCT idusuario AS 'CLAVE_USUARIO', CONCAT_WS(' ', usNombres, usPrimerApellido, usSegundoApellido) AS 'NOMBRE', usTelefono AS 'TELEFONO', usCalle AS 'CALLE',usCorreo AS 'CORREO', usNumero 'NUMERO'from usuario where idusuario=(SELECT distinct t1.idusuario from usuario_colonia as t1 inner join roles_usuario as t2 on t1.idusuario=t2.idusuario where idColonia=(select distinct idColonia from usuario_colonia  where idusuario=$idusuario  order by idColonia asc limit 1 )and t2.idroles=2 limit 1);";
		$consulta=$connection->db->prepare($sql);
		$consulta->execute();
		$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
		return $objUsuario;	
		}
		public function MostrarUsuarioAlerta($idusuario){
			$connection = new Connection();
			$sql ="SELECT DISTINCT idusuario AS 'CLAVE_USUARIO', CONCAT_WS(' ', usNombres, usPrimerApellido, usSegundoApellido) AS 'NOMBRE', usTelefono AS 'TELEFONO', usCalle AS 'CALLE',usCorreo AS 'CORREO', usNumero 'NUMERO'from usuario where idusuario=$idusuario;";
			$consulta=$connection->db->prepare($sql);
			$consulta->execute();
			$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
			return $objUsuario;	
			}
	
	
	public function actualizarAtencion($idalerta){
		$connection = new Connection();
		$sql ="UPDATE `alerta_emision` SET `aler_estado`='I' WHERE idemision_alerta =$idalerta";		
		$consulta=$connection->db->prepare($sql);
		$consulta->execute();
		if($consulta->rowCount() > 0){	
			return true;
		}
		else{
			return false; 
			}		
		}

	
		public function CerrarAlert($idatencion){
			$connection = new Connection();
			$sql ="UPDATE atencion_alerta set ateObservaciones ='Atendido',  ateFecha_atendida=now(), ateEstado='A' where idatencion_alerta=$idatencion";		
			echo $sql;
			$consulta=$connection->db->prepare($sql);
			$consulta->execute();
			if($consulta->rowCount() > 0){	
				return true;
			}
			else{
				return false; 
				}		
			}



		public function obtenerUltimoID(){
			$connection = new Connection();
			$sql ="select idusuario+1 as 'ULTIMO' from atencion_alerta order by idatencion_alerta desc limit 1;";
			$consulta=$connection->db->prepare($sql);
			$consulta->execute();
			$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
			return $objUsuario;	
			}


		public function atendeAlerta($idalerta, $identidades){
			$connection = new Connection();
			$fecha= date("d"). "/". date("m"). "/". date("Y") ;
			$sql ="INSERT INTO `atencion_alerta`( `idemision_alerta`, `identidades`, `ateObservaciones`, `ateFecha_atendida`, `ateEstado`) VALUES ($idalerta,$identidades,'Espera',$fecha,'I')";		
			$consulta=$connection->db->prepare($sql);
			$consulta->execute();
			if($consulta->rowCount() > 0){	
				return true;
			}
			else{
				return false; 
				}		
			}

	public function DesplegarTipo(){
		$connection = new Connection();
		$sql ="SELECT identidades_emergencia as 'CLAVE_ENTIDAD', enti_descripcion as 'DESCRIPCION', enti_telefono as 'TELEFONO', enti_direccion as 'DIRECCION', enti_correo as 'CORREO' from entidades_emergencia;";
		$consulta=$connection->db->prepare($sql);
		$consulta->execute();
		$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
		return $objUsuario;	
		}	

		public function DetalleTipo($identidad){
		$connection = new Connection();
		$sql ="SELECT identidades_emergencia as 'CLAVE_ENTIDAD', enti_descripcion as 'DESCRIPCION', enti_telefono as 'TELEFONO', enti_direccion as 'DIRECCION', enti_correo as 'CORREO' from entidades_emergencia where identidades_emergencia = $identidad;";
		$consulta=$connection->db->prepare($sql);
		$consulta->execute();
		$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
		return $objUsuario;	
		}


		public function ObtenerColonia($idusuario){
			$connection = new Connection();
			$sql ="SELECT distinct idusuario, idcolonia from usuario_colonia where idColonia=(select distinct idColonia from usuario_colonia  where idusuario=$idusuario  order by idColonia asc limit 1  );";
			$consulta=$connection->db->prepare($sql);
			$consulta->execute();
			$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
			return $objUsuario;

		}
		

		public function ObtenerTokenTelegram($idusuario){
			$connection = new Connection();
			
			$sql ="SELECT chaIDColonia from colonia where idColonia= (select distinct idColonia
			 from usuario_colonia where idusuario=$idusuario order by idColonia asc limit 1);";
			$consulta=$connection->db->prepare($sql);
			$consulta->execute();
			$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
			
			
			return $objUsuario;
		}
		
		
		public function ObtenerUsuario($idusuario){
			$connection = new Connection();
			
			//	echo $idusuario;
				//echo "";
			$sql ="SELECT distinct idusuario from usuario_colonia where idColonia=(select distinct idColonia from usuario_colonia  where idusuario=$idusuario  order by idColonia asc limit 1 );";
			$consulta=$connection->db->prepare($sql);
			$consulta->execute();
			$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
			return $objUsuario;
		}

		public function ObtenerUsuarioPush($idusuario){
			$connection = new Connection();
			
				//echo "";
			$sql ="SELECT token from token_usuario where idusuario =$idusuario";
			$consulta=$connection->db->prepare($sql);
			$consulta->execute();
			$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
			
			
			return $objUsuario;
		}

}

 ?>






















