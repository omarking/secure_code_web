<?php
if (!isset($connection)){
require 'conexion.php';}

class Colonia 
{
	protected $idColonia;
	protected $colNombre;
	protected $colCP;
	protected $chatID;
	protected $colEstado;	

 
	public function MostrarColonia(){
	$connection = new Connection();
	$sql ="SELECT idColonia as ID_COLONIA, colNombre as NOMBRE, colCodigo_Postal as 'CP', chaIDColonia as CHATID, colEstado as ESTADO, colMunicipio as MUNICIPIO, col_url as LINK_COLONIA from colonia;";
	$consulta=$connection->db->prepare($sql);
	$consulta->execute();
	$objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
	return $objUsuario;	
	}

    public function DetalleMostrarColonia($idcolonia){
        $connection = new Connection();
        $sql ="SELECT idColonia as ID_COLONIA, colNombre as NOMBRE, colCodigo_Postal as 'CP', chaIDColonia as CHATID, colEstado as ESTADO, colMunicipio as MUNICIPIO, col_url as LINK_COLONIA from colonia where idColonia=$idcolonia;";
        $consulta=$connection->db->prepare($sql);
        $consulta->execute();
        $objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
        return $objUsuario;	
        }


        public function newColonia($colnombre,$colmunicipio, $chatid,$colcp,$colestado,$collink){
            $connection = new Connection();
            $sql ="INSERT into colonia (colNombre,colMunicipio, colCodigo_Postal, colEstado, chaIDColonia,col_url) values
            ('$colnombre','$colmunicipio', '$colcp','$colestado','$chatid','$collink')";
            $consulta=$connection->db->prepare($sql);
            $consulta->execute();
            if($consulta->rowCount() > 0){	   
                return true;
            }
            else{
            return false; 
            }}

            public function editColonia($idcolonia,$colnombre,$colmunicipio, $chatid,$colcp,$colestado,$collink){
                $connection = new Connection();
                $sql ="UPDATE colonia set colNombre='$colnombre' ,colMunicipio='$colmunicipio', colCodigo_Postal=$colcp, colEstado='$colestado', chaIDColonia='$chatid', col_url='$collink' where idColonia='$idcolonia'; ";
                $consulta=$connection->db->prepare($sql);
                $consulta->execute();
                if($consulta->rowCount() > 0){	   
                    return true;
                }
                else{
                return false; 
                }}
    


                public function DesplegarTipo(){
                    $connection = new Connection();
                    $sql ="SELECT idColonia as 'CLAVE_COLONIA', colNombre as 'COLONIA' from colonia;";
                    $consulta=$connection->db->prepare($sql);
                    $consulta->execute();
                    $objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
                    return $objUsuario;	
                    }	

    public function DetalleTipo($icolonia){
        $connection = new Connection();
        $sql ="SELECT distinct T1.idusuario AS 'CLAVE_USUARIO', CONCAT_WS(' ', usNombres, usPrimerApellido, usSegundoApellido) AS 'NOMBRE', usFechaNac AS 'FECHA_NACIMIENTO', usTelefono AS 'TELEFONO', usCalle AS 'CALLE',usCorreo AS 'CORREO', usNumero 'NUMERO', telegram as ESTADO_TELEGRAM from usuario_colonia  as t2 inner join usuario as T1 on T1.idusuario=t2.idusuario where idColonia=(select distinct idColonia from usuario_colonia  where idColonia=$icolonia  order by idusuario asc limit 1  );";
        $consulta=$connection->db->prepare($sql);
        $consulta->execute();
        $objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
        return $objUsuario;	
            }

public function DetalleColoniaUsuario($icolonia){
    
        $connection = new Connection();
        $sql ="SELECT distinct T1.idusuario AS 'CLAVE_USUARIO', CONCAT_WS(' ', usNombres, usPrimerApellido, usSegundoApellido) AS 'NOMBRE', usFechaNac AS 'FECHA_NACIMIENTO', usTelefono AS 'TELEFONO', usCalle AS 'CALLE',usCorreo AS 'CORREO', usNumero 'NUMERO', telegram as ESTADO_TELEGRAM from usuario as T1 where idusuario=$icolonia;";
        $consulta=$connection->db->prepare($sql);
        $consulta->execute();
        $objUsuario= $consulta->fetchAll(PDO:: FETCH_OBJ);
        return $objUsuario;	
            }

public function actualizarStatus($idusuario, $idestado){
    $connection = new Connection();
    
    $sql ="update usuario set telegram='$idestado' where idusuario=$idusuario";		
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



}
  ?>