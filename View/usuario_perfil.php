<?php session_start();
include 'master.php' ?>
<?php include './../Controller/controller_usuario.php';?>      
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
        	INFORMACION DE USUARIO
		</div>
        <br><br>
       <div id="masterPrincipal">
	   <form >	
			<div id="masterbotones">
			<svg class="bi bi-alert-triangle text-success" width="32" height="32" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  
			</svg>
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="retornarPagina()">
  			<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default" aria-label="Left Align">
  			<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default" aria-label="Left Align">
  			<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
		</button>
		</div>
		<br> <br><br>
		
		<div class="row">
		<div class="col-md-6">
              		<div class="form-group">
        			  <label>CLAVE DE USUARIO
					  <i class="fas fa-id-card"></i>
					  </label>
			    	  <input type="text" name="idusuario" value="<?php echo $_SESSION['idusuario']; ?>" class="form-control" placeholder="clave de usuario"/>
    				</div>
		</div>
		<div class="col-md-6">
				<div class="form-group">
        		  <label>ROL
				  <i class="fas fa-user-tag"></i>
				  </label>
			      <input type="text" name="rol" value="Administrador" class="form-control" placeholder="rol"  />
    			</div>
				</div> </div>
		<div class="row">
		<div class="col-md-6">
		<div class="form-group">
        		  <label>NOMBRE
				  <i class="fas fa-user"></i>
				  </label>
			      <input type="text" name="nombre" value="<?php echo $_SESSION['usNombres']; ?>" class="form-control" placeholder="nombre"  />
    			</div>              	
			</div>		
		<div class="col-md-6">
				<div class="form-group">
        		  <label>FECHA NACIMIENTO
				  <i class="fas fa-calendar"></i>
				  </label>
			      <input type="text" name="fecha_nacimiento" value="<?php echo $_SESSION['usFechaNac']; ?>" class="form-control" placeholder="FECHA NACIMIENTO"  />
    			</div>
		</div> 
		<div class="row">
		<div class="col-md-6">
              	<div class="form-group">
        		  <label>TELEFONO
				  <i class="fas fa-phone"></i>
				  </label>
			      <input type="text" name="telefono" value="<?php echo $_SESSION['usTelefono']; ?>" class="form-control" placeholder="telefono"  />
    			</div>
		</div>
		<div class="col-md-6">
    			<div class="form-group">
        		  <label>CORREO
				  <i class="fas fa-envelope-open-text"></i>
				  </label>
			      <input type="text" name="correo" value="<?php echo $_SESSION['usCorreo']; ?>" class="form-control" placeholder="correo"  />
    			</div>
				</div>	</div>
				<div class="row">
				<div class="col-md-6">				
    			<div class="form-group">
        		  <label>CALLE
				  <i class="fas fa-map-marked-alt"></i> 
				  </label>
			      <input type="text" name="calle" value="<?php echo $_SESSION['usCalle']; ?>" class="form-control" placeholder="calle"  />
    			</div></div>
				<div class="col-md-6">
				<div class="form-group">
        		  <label>NUMERO
				  <i class="fas fa-map-marked-alt"></i> 
				  </label>
			      <input type="text" name="latitud" value="<?php echo $_SESSION['usNumero']; ?>" class="form-control" placeholder="numero"  />
    			</div>
				</div>
		</div>		    		
		
              </form>
           </div>
		
 </body>
 </html>