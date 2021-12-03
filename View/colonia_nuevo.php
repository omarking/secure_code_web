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
       <div id="masterPrincipal" style="text-align: center;">
	   <form id="masterFormDetalleAlerta" method="POST" action="../Controller/controller_colonia.php" >	
			<div id="masterbotones">
			<svg class="bi bi-alert-triangle text-success" width="32" height="32" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  
			</svg>
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="retornarPagina()">
  			<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
		</button>
        <button type="submit" class="btn btn-default" aria-label="Left Align">
  			<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
			  <input type="hidden" name="action" value="nuevo" >
		</button>
		</div>
		<br> <br><br>
	                     
				<div class="form-group">
        		  <label>NOMBRE
				  <i class="fas fa-user-tag"></i>
				  </label>
			      <input type="text" name="colnombre" required class="form-control" placeholder="NOMBRE DE LA COLONIA"  />
    	        </div>	
        		<div class="form-group">
        		  <label>CHAT ID
				  <i class="fas fa-envelope-open-text"></i>
				  </label>
			      <input type="text" name="colchatid" required class="form-control" placeholder="CHAT ID"  />
    			</div>
                <div class="form-group">
        		  <label>C.P.
				  <i class="fas fa-phone"></i>
				  </label>
			      <input type="text" name="colcp" required class="form-control" placeholder="C.P."  />
    			</div>
				<div class="form-group">
        		  <label>MUNICIPIO
				  <i class="fas fa-calendar"></i>
				  </label>
			      <input type="text" name="colmunicipio" required class="form-control" placeholder="MUNICIPIO"  />
    			</div>
		
        <div class="form-group">
        		  <label>ESTADO
				  <i class="fas fa-user"></i>
				  </label>
			      <input type="text" name="colestado"  required class="form-control" placeholder="ESTADO"  />
    			</div> 
                <div class="form-group">
        		  <label>LINK
				  <i class="fas fa-user"></i>
				  </label>
			      <input type="text" name="collink"  required class="form-control" placeholder="LINK DE REGISTRO"  />
    			</div> 
                
                </form>
            </div>	
               
		
           </div>
		
 </body>
 </html>




  