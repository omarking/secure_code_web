<?php 
Session_start();
include 'master.php';
include '../Controller/controller_colonia.php';?>

<!DOCTYPE html>
<html>
<head>
	<title>USUARIO COLONIAS </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>    	
<style>
    body {
      background-color: #ffffff;}
  </style>
        <div id="encabezado">
        REGISTRO DE USUARIOS POR COLONIA
        </div>
        <br><br>
       <div id="masterPrincipal">
         <div id="masterFormDetalleColonia">
       </div>
       <form method=post id="formulario" >
       <label>SERVICIO DE ATENCION REQUERIDO</label>
       <select required name='idcolonia' id='idcolonia' class="form-select form-select-lg mb-3" onchange="cambio()" aria-label=".form-select-lg example" >
    <option value="0" >SELECCIONA LA COLONIA:</option>
    <?php	$valores=new Colonia();
        foreach ($valores -> DesplegarTipo() as $va):
            echo '<option value="'.$va->CLAVE_COLONIA.'">'.$va->COLONIA.'</option>';
        endforeach;?>
    </select>
    <div class="form-group">        			  
									
                                    <p class="broken"></p>
                            </div>
        </div>
       	

    
</body>
<script>
function cambio(){
		$('#formulario').on('change', 'select', function (e) {
    	var val = $(e.target).val();
    	var text = $(e.target).find("option:selected").text(); //only time the find is required
    	var name = $(e.target).attr('name');
		//alert(val);
       
$.ajax({
  method: "POST",
  url: "ajax_colonias.php",
  data: { text: $(e.target).val() }
})
  .done(function( response ) {
    $("p.broken").html(response);
  });

});
 
	}	

</script>
</form>
</html>
