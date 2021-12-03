<?php session_start();
include 'master.php'?>
<?php include './../Controller/controller_usuario.php';?>      
 <!DOCTYPE html>
 <html>
 <head>
 	<title>	NUEVO USUARIO</title>
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
        	NUEVO USUARIO
		</div>
        <br>
       <div id="masterPrincipal">
	   <form id="masterFormDetalleAlerta" method="POST" action="../Controller/controller_usuario.php">	
			<div id="masterbotones">
			<svg class="bi bi-alert-triangle text-success" width="32" height="32" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  
			</svg>
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="retornarPagina()">
  			<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
		</button>
		<button type="submit" class="btn btn-default" aria-label="Left Align">
  			<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
			  <input type="hidden" name="action" value="registrar" >
		</button>
		</div>
		<br>
		
		<div class="row">
		<div class="col-md-6">
			<?php $controller= new UsuarioController();
					foreach($controller->obtenerUltimo() as $alm ): ?>

			
              		<div class="form-group">
        			  <label>NICKNAME
					  <i class="fas fa-portrait"></i>
					  </label>
			    	  <input type="text" name="nickname" id="nickname"  class="form-control" placeholder="INGRESA NICKNAME"/>
    				</div>
					<?php      endforeach; ?> 
		</div>
		<div class="col-md-6">
				<div class="form-group">
        		  <label>ROL
				  <i class="fas fa-user-tag"></i>
				  </label><br>
			      <select  id="selected" name="selected" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
        			<option value="0">SELECCIONA EL ROL:</option>
        	<?php	$valores=new Usuario();
          	foreach ($valores -> DesplegarTipo() as $va):?>
            <?php echo '<option value="'.$va->ID_ROL.'">'.$va->ROL.'</option>';?>        
			<?php endforeach;?>
		</select>
	  
    			</div>
				</div> </div>
		<div class="row">
		<div class="col-md-6">
		<div class="form-group">
        		  <label>NOMBRE
				  <i class="fas fa-user"></i>
				  </label>
			      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="INGRESA EL NOMBRE"  />
    			</div>              	
			</div>		
		<div class="col-md-6">
				<div class="form-group">
        		  <label>CORREO
				  <i class="fas fa-envelope-open-text"></i>
				  </label>
			      <input type="text" name="correro" id="correro" class="form-control" placeholder="INGRESA TU CORREO"  />
    			</div>
		</div> 
		<div class="row">
		<div class="col-md-6">
              	<div class="form-group">
        		  <label>APELLIDO PATERNO
				  <i class="fas fa-user-edit"></i>
				  </label>
			      <input type="text" name="apellido_paterno" id="apellido_paterno"  class="form-control" placeholder="INGRESA TU APELLIDO PATERNO"/>
    			</div>
		</div>
		<div class="col-md-6">
    			<div class="form-group">
        		  <label>APELLIDO MATERNO
				  <i class="fas fa-user-edit"></i>
				  </label>
			      <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" placeholder="INGRESA TU APELLIDO MATERNO"  />
    			</div>
				</div>	</div>
				<div class="row">
				<div class="col-md-6">				
    			<div class="form-group">
        		  <label>CONTRASEÑA
				  <i class="fas fa-lock"></i>
				  </label>
			      <input type="password" name="password" id="password" class="form-control" placeholder="INGRESA TU CONTRASEÑA"  />
    			</div></div>
				<div class="col-md-6">
				<div class="form-group">
        		  <label>CONFIRMA TU CONTRASEÑA
				  <i class="fas fa-lock"></i>
				  </label>
			      <input type="password" name="password_confirmacion" class="form-control" placeholder="CONFIRMA TU CONTRASEÑA"  />
    			</div>
				</div>
				</div>		    		
				<div class="row">
				<div class="col-md-6">				
    			<div class="form-group">
        		  <label>FECHA DE NACIMIENTO
				  <i class="fas fa-calendar"></i>
				  </label>
			      <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"  class="form-control" placeholder="INGRESA TU FECHA DE NACIMIENTO"  />
    			</div></div>
				<div class="col-md-6">
				<div class="form-group">
        		  <label>TELEFONO
				  <i class="fas fa-phone"></i>
				  </label>
			      <input type="number" name="telefono" id="telefono" class="form-control" placeholder="INGRESA TU TELEFONO"  />
    			</div>
				</div>
				</div>		
				<div class="row">
				<div class="col-md-6">				
    			<div class="form-group">
        		  <label>CALLE
				  <i class="fas fa-map-marked-alt"></i>  
				  </label>
			      <input type="text" name="calle" id="calle"  class="form-control" placeholder="INGRESA LA CALLE DE TU DOMICILIO"  />
    			</div></div>
				<div class="col-md-6">
				<div class="form-group">
        		  <label>NUMERO
				  <i class="fas fa-map-marked-alt"></i> 
				  </label>
			      <input type="number" name="numero_calle" id="numero_calle" class="form-control" placeholder="EL NUMERO DE TU DOMICILIO"  />
    			</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
        		  <label>ESTADO TELEGRAM
				  <i class="fas fa-user-tag"></i>
				  </label>
			      

                  <select required name='idstatus' id='idstatus' class="form-select form-select-lg mb-3"  aria-label=".form-select-lg example" >
    <option value="0" >SELECCIONA EL STATUS DE TELEGRAM:</option>
            <option value="1">ALTA</option>
            <option value="2">BAJA</option>
            <option value="3">PENDIENTE</option>      
    </select>

                </div>
				</div>
			</div>  
			
			</form>
           </div>
		
 </body>
 </html>