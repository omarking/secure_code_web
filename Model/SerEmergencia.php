<?php
require 'conexion.php';


class SerEmergencia
{
	protected $identidad_emergencia;
	protected $enti_descripcion;
	protected $enti_telefono;
	protected $enti_direccion;
	protected $enti_correo;
	protected $enti_estado;
	


	public function MostrarServicios(){
	$connection = new Connection();
	$sql ="SELECT identidades_emergencia AS 'ID_ENTIDAD', enti_descripcion AS 'DESCRIPCION', enti_telefono AS 'TELEFONO', enti_direccion AS 'DIRECCION', enti_correo AS 'CORREO', enti_estado AS 'ESTADO' FROM entidades_emergencia;";
	$consulta=$connection->db->prepare($sql);
	$consulta->execute();
	$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
	return $objUsuario;	
	}


    public function getting($identidad){
	
        $connection = new Connection();
        $sql ="SELECT identidades_emergencia AS 'ID_ENTIDAD', enti_descripcion AS 'DESCRIPCION', enti_telefono AS 'TELEFONO', enti_direccion AS 'DIRECCION', enti_correo AS 'CORREO', enti_estado AS 'ESTADO' FROM entidades_emergencia WHERE identidades_emergencia= $identidad;";		
        $consulta=$connection->db->prepare($sql);
        $consulta->execute();
        $dato= $consulta->fetchAll(PDO:: FETCH_OBJ);
        return $dato;	
        }

}
  ?>