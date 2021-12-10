<?php session_start();
include 'master.php';
include './../Model/Colonia.php';
?>      
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
        	DETALLE DE USUARIO COLONIA
		</div>
        <br><br>
       <div id="masterPrincipal">
	   <form id="masterFormDetalleAlerta" method="POST" action="../Controller/controller_colonia.php">>	
			<div id="masterbotones">
			<svg class="bi bi-alert-triangle text-success" width="32" height="32" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  
			</svg>
		<button type="button" class="btn btn-default" aria-label="Left Align" onclick="retornarPagina()">
  			<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
		</button>
        <button type="button" onclick="validar()" class="btn btn-default" aria-label="Left Align">
  			<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
			  <input type="hidden" name="action" value="editar" >
		</button>
	
		
		</div>
		<br> <br><br>


		<?php $controller= new Colonia();
		foreach($controller->DetalleColoniaUsuario($_SESSION['usuarioid']) as $alm ): ?>
		
		<div class="row">
		<div class="col-md-6">
              		<div class="form-group">
        			  <label>CLAVE DE USUARIO
					  <i class="fas fa-id-card"></i>
					  </label>
			    	  <input type="text" disabled id="idusuario" name="idusuario" value="<?php echo $alm->CLAVE_USUARIO; ?>" class="form-control" placeholder="clave de usuario"/>
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
				</div> </div>
		<div class="row">
		<div class="col-md-6">
		<div class="form-group">
        		  <label>NOMBRE
				  <i class="fas fa-user"></i>
				  </label>
			      <input type="text"disabled name="nombre" value="<?php echo $alm->NOMBRE; ?>" class="form-control" placeholder="nombre"  />
    			</div>              	
			</div>		
		<div class="col-md-6">
				<div class="form-group">
        		  <label>TELEFONO
				  <i class="fas fa-calendar"></i>
				  </label>
                  <input type="text" disabled name="telefono" value="<?php echo $alm->TELEFONO; ?>" class="form-control" placeholder="telefono"  />
    			</div>
		</div> 
		<div class="row">
		<div class="col-md-6">
              	<div class="form-group">
        		  <label>CORREO
				  <i class="fas fa-phone"></i>
				  </label>
			      <input type="text"  disabled name="correo" value="<?php echo $alm->CORREO; ?>" class="form-control" placeholder="correo"  /> 
    			</div>
		</div>
		</div>	
        	    		
		<?php      endforeach; ?> 
              
           </div>
           </form>

		   <script>function validar(){
var nombreVariable=document.getElementById
('idstatus');
if(nombreVariable.value==0 || nombreVariable.value == "")
  {
   alert("Selecciona Una opción");
     nombreVariable.focus();
  }else {
    $("#masterFormDetalleAlerta").submit();
  }
}

</script>

 </body>
 </html>