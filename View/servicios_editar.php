<?php session_start();
include 'master.php';
      include '../Controller/controller_servicioemergencia.php'?>
 


 <html>
 <head>
 	<title>	DETALLE ENTIDADAES</title>
	 <script>

function retornarPagina(){
history.go(-1);

} </script> 
</head>
 <body>
            			
	<style>
    body {
      background-color: #ffffff;}
  	</style>
    <div id="encabezado">
    DETALLE DE SERVICIO DE ENTIDAD
    </div>
        <br><br>
       <div id="masterPrincipal">
		<form id="masterFormDetalleAlerta">	
			<div id="masterbotones">
			<svg class="bi bi-alert-triangle text-success" width="32" height="32" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  
			</svg>
<button type="button" class="btn btn-default" aria-label="Left Align" onclick="retornarPagina()">
  			<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
		</button>
		
		</div>
		<br> <br><br>
		<?php $controller= new ServEmergenciaController();		
		foreach($controller->DetalleServicios($_GET['identidad']) as $alm ): ?>
		
		<div class="row">
		<div class="col-md-6">
              		<div class="form-group">
        			  <label>CLAVE DE ENTIDAD
					  <i class="fas fa-id-card"></i> 
					  </label>
			    	  <input type="text" name="idservicio" value="<?php echo $alm->ID_ENTIDAD; ?>" class="form-control" placeholder="clave de alerta"/>
    				</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
        		  <label>DESCRIPCION
				  <i class="fas fa-info"></i> 
				  </label>
			      <input type="text" name="fecha" value="<?php echo $alm->DESCRIPCION; ?>" class="form-control" placeholder="fecha"  />
    			</div>              	
		</div>	</div>
		<div class="row">
		<div class="col-md-6">
				<div class="form-group">
        		  <label>TELEFONO
				  <i class="fas fa-phone"></i> 
				  </label>
			      <input type="text" name="idusuario" value="<?php echo $alm->TELEFONO; ?>" class="form-control" placeholder="clave de usuario"  />
    			</div>
		</div>
		<div class="col-md-6">
              	<div class="form-group">
        		  <label>DIRECCION
				  <i class="fas fa-map-marked-alt"></i> 
				  </label>
			      <input type="text" name="nombre" value="<?php echo $alm->DIRECCION; ?>" class="form-control" placeholder="nombre"  />
    			</div>
		</div>
        <div class="row">
        <div class="col-md-6">
    			<div class="form-group">
        		  <label>CORREO
				  <i class="fas fa-envelope-open-text"></i>
				  </label>
			      <input type="text" name="descripcion" value="<?php echo $alm->CORREO; ?>" class="form-control" placeholder="descripcion"  />
    			</div>
        </div>
		<div class="col-md-6">
    			<div class="form-group">
        		  <label>ESTADO
				  <i class="fas fa-map-marked-alt"></i> 
				  </label>
			      <input type="text" name="longitud" value="<?php echo $alm->ESTADO; ?>" class="form-control" placeholder="longitud"  />
    			</div>
				</div>
				</div>
		
					
		<?php      endforeach; ?> 
              </form>
           </div>
	
 </body>
 </html>