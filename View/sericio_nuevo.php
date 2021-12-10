<?php session_start();
include 'master.php';
include './../Controller/controller_usuario.php'?>      
 <!DOCTYPE html>
 <html>
 <head>
 	<title>	NUEVO SERVICIO DE EMERGENCIA</title>
	<script>
	function retornarPagina(){
	history.go(-1);
		} 
	</script> 
</head>
 <body>			
	<style>
    body {
      background-color: #ffffff;
	}
  </style>
        <div id="encabezado">
		NUEVO SERVICIO DE EMERGENCIA
		</div>
        <br><br>
       <div id="masterPrincipal">
	   <form id="masterFormDetalleAlerta" >	
			<div id="masterbotones">
			<svg class="bi bi-alert-triangle text-success" width="32" height="32" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  
			</svg>
<button type="button" class="btn btn-default" aria-label="Left Align" onclick="retornarPagina()">
  			<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default" aria-label="Left Align">
  			<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
		</button>
		</div>
		<br> <br><br>
		
		<div class="row">
		<div class="col-md-6">
              		<div class="form-group">
        			  <label>CLAVE DE ENTIDAD
					  <i class="fas fa-id-card"></i> 
					  </label>
			    	  <input type="text" name="idservicio"  class="form-control" placeholder="clave de alerta"/>
    				</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
        		  <label>DESCRIPCION
				  <i class="fas fa-info"></i>  
				  </label>
			      <input type="text" name="fecha"  class="form-control" placeholder="fecha"  />
    			</div>              	
		</div>	</div>
		<div class="row">
		<div class="col-md-6">
				<div class="form-group">
        		  <label>TELEFONO
				  <i class="fas fa-phone"></i> 
				  </label>
			      <input type="text" name="idusuario" class="form-control" placeholder="clave de usuario"  />
    			</div>
		</div>
		<div class="col-md-6">
              	<div class="form-group">
        		  <label>DIRECCION
				  <i class="fas fa-map-marked-alt"></i> 
				  </label>
			      <input type="text" name="nombre"  class="form-control" placeholder="nombre"  />
    			</div>
		</div>
        <div class="row">
        <div class="col-md-6">
    			<div class="form-group">
        		  <label>CORREO
				  <i class="fas fa-envelope-open-text"></i>  
				  </label>
			      <input type="text" name="descripcion" class="form-control" placeholder="descripcion"  />
    			</div>
        </div>
		<div class="col-md-6">
    			<div class="form-group">
        		  <label>ESTADO
				  <i class="fas fa-envelope-open-text"></i>
				  </label>
			      <input type="text" name="longitud"  class="form-control" placeholder="longitud"  />
    			</div>
				</div>
				</div>
		
              </form>
           </div>
		
 </body>
 </html>