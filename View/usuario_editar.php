<?php session_start();
include 'master.php';
include './../Controller/controller_usuario.php';?>      
 <!DOCTYPE html>
 <html>
 <head>
 	<title>	DETALLE USUARIO</title>
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
        	DETALLE DE USUARIO
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
	
		
		</div>
		<br> <br><br>
		<?php $controller= new UsuarioController();
		foreach($controller->DetalleUsuario($_GET['idusuario']) as $alm ): ?>
		
		<div class="row">
		<div class="col-md-6">
              		<div class="form-group">
        			  <label>CLAVE DE USUARIO
					  <i class="fas fa-id-card"></i>
					  </label>
			    	  <input type="text" disabled name="idusuario" value="<?php echo $alm->CLAVE_USUARIO; ?>" class="form-control" placeholder="clave de usuario"/>
    				</div>
		</div>
		<div class="col-md-6">
				<div class="form-group">
        		  <label>ROL
				  <i class="fas fa-user-tag"></i>
				  </label>
			      <input type="text" name="rol" value="<?php echo $alm->ROL; ?>" class="form-control" placeholder="rol"  />
    			</div>
				</div> </div>
		<div class="row">
		<div class="col-md-6">
		<div class="form-group">
        		  <label>NOMBRE
				  <i class="fas fa-user"></i>
				  </label>
			      <input type="text" name="nombre" value="<?php echo $alm->NOMBRE; ?>" class="form-control" placeholder="nombre"  />
    			</div>              	
			</div>		
		<div class="col-md-6">
				<div class="form-group">
        		  <label>FECHA NACIMIENTO
				  <i class="fas fa-calendar"></i>
				  </label>
			      <input type="text" name="fecha_nacimiento" value="<?php echo $alm->FECHA_NACIMIENTO; ?>" class="form-control" placeholder="FECHA NACIMIENTO"  />
    			</div>
		</div> 
		<div class="row">
		<div class="col-md-6">
              	<div class="form-group">
        		  <label>TELEFONO
				  <i class="fas fa-phone"></i>
				  </label>
			      <input type="text" name="telefono" value="<?php echo $alm->TELEFONO; ?>" class="form-control" placeholder="telefono"  />
    			</div>
		</div>
		<div class="col-md-6">
    			<div class="form-group">
        		  <label>CORREO
				  <i class="fas fa-envelope-open-text"></i>
				  </label>
			      <input type="text" name="correo" value="<?php echo $alm->CORREO; ?>" class="form-control" placeholder="correo"  />
    			</div>
				</div>	</div>
				<div class="row">
				<div class="col-md-6">				
    			<div class="form-group">
        		  <label>CALLE
				  <i class="fas fa-map-marked-alt"></i>
				  </label>
			      <input type="text" name="calle" value="<?php echo $alm->CALLE; ?>" class="form-control" placeholder="calle"  />
    			</div></div>
				<div class="col-md-6">
				<div class="form-group">
        		  <label>NUMERO
				  <i class="fas fa-map-marked-alt"></i>
				  </label>
			      <input type="text" name="latitud" value="<?php echo $alm->NUMERO; ?>" class="form-control" placeholder="numero"  />
    			</div>
				</div>
		</div>		    		
		<?php      endforeach; ?> 
              </form>
           </div>
		
 </body>
 </html>