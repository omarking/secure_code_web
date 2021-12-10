<?php session_start();
include 'master.php';
include './../Controller/controller_colonia.php';?>      
 <!DOCTYPE html>
 <html>
 <head>
 	<title>	DETALLE COLONIA</title>
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
        	DETALLE DE COLONIA
		</div>
        <br><br>
       <div id="masterPrincipal">
	   <form id="masterFormDetalleAlerta" method="POST" action="../Controller/controller_colonia.php" >	
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
		<br> <br><br>
		<?php $controller= new ColoniaController();
		foreach($controller->DetalleMostrarColonia($_GET['idcolonia']) as $alm ): 
            
            $idcolonia= $alm->ID_COLONIA;
            $_SESSION['coloniaid']=$idcolonia;
            //echo $_SESSION['coloniaid'];
        ?>
 
                         
                         
                         
		<div class="row">
		<div class="col-md-6">
              		<div class="form-group">
        			  <label>CLAVE DE COLONIA
					  <i class="fas fa-id-card"></i>
					  </label>
			    	  <input type="text"  required disabled name="idcolonia" value="<?php echo $alm->ID_COLONIA; ?>" class="form-control" placeholder="clave de usuario"/>
    				</div>
		</div>
		<div class="col-md-6">
				<div class="form-group">
        		  <label>NOMBRE
				  <i class="fas fa-user-tag"></i>
				  </label>
			      <input type="text" required name="colnombre" value="<?php echo $alm->NOMBRE; ?>" class="form-control" placeholder="rol"  />
    			</div>
				</div> </div>
		<div class="row">
        <div class="col-md-6">
    			<div class="form-group">
        		  <label>CHAT ID
				  <i class="fas fa-envelope-open-text"></i>
				  </label>
			      <input type="text" required name="colchatid" value="<?php echo $alm->CHATID; ?>" class="form-control" placeholder="CHAT ID"  />
    			</div>
                <div class="col-md-6">
              	<div class="form-group">
        		  <label>C.P.
				  <i class="fas fa-phone"></i>
				  </label>
			      <input type="text" required name="colcp" value="<?php echo $alm->CP; ?>" class="form-control" placeholder="telefono"  />
    			</div>
		</div></div>
        
		<div class="col-md-6">
				<div class="form-group">
        		  <label>MUNICIPIO
				  <i class="fas fa-calendar"></i>
				  </label>
			      <input type="text" required name="colmunicipio" value="<?php echo $alm->MUNICIPIO; ?>" class="form-control" placeholder="FECHA NACIMIENTO"  />
    			</div>
		
        <div class="form-group">
        		  <label>ESTADO
				  <i class="fas fa-user"></i>
				  </label>
			      <input type="text" required name="colestado" value="<?php echo $alm->ESTADO; ?>" class="form-control" placeholder="nombre"  />
    			</div> 
               </div>	
                <div class="col-md-6">
	            <div class="form-group">
        		  <label>LINK
				  <i class="fas fa-user"></i>
				  </label>
			      <input type="text" required name="collink"  value="<?php echo $alm->LINK_COLONIA; ?>" class="form-control" placeholder="LINK DE REGISTRO"  />
    			</div>  	
			</div>	
            </div>
				    		
		<?php      endforeach; ?> 
              </form>
           </div>
		
 </body>
 </html>




  