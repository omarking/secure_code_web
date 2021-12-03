
<head><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script></head>
<div style="text-align: center;">
<form method=post id="formulario" action="../Controller/controller_alerta.php">
<body >
    <br>
    <input type="hidden" required name="action" value="deplegar">  

    <div class="row">
					 <div class="col-md-6">
					 <div class="divAtencion">							
									<p class="parrafoInfo" style="font-size: x-large;">ATENCION!</p>
									<p class="parrafoAtencion" style="font-size: x-large;" >	Notificacion a servicios mediente correo:		</p>
									<p class="parrafoInfo">-PARA AGILIZAR EL PROCESO COMUNICATE.</p>									
                  <br>
                  <label>SERVICIO DE ATENCION REQUERIDO</label>
                  <select required name='identidad' id='identidad' class="form-select form-select-lg mb-3" onchange="cambio()" aria-label=".form-select-lg example" >
    <option value="0" >SELECCIONA EL SERVICIO:</option>
    <?php	$valores=new Alerta();
        foreach ($valores -> DesplegarTipo() as $va):
            echo '<option value="'.$va->CLAVE_ENTIDAD.'">'.$va->DESCRIPCION.'</option>';
        endforeach;?>
    </select>
									
								
                                
									<div class="form-group">        			  
									
										<p class="broken"></p>
								</div>							
														
							</div>
					</div>
					<div class="col-md-6">

							<div class="row">					
								
									<div class="divAtencion">							
									<p class="parrafoInfo" style="font-size: x-large;">¡NOTA!</p>
									<p class="parrafoAtencion" style="font-size: x-large;" >	Notificacion a usuarios mediante:		</p>
									<p class="parrafoInfo">-Notificacion push. </p>
									<br>
									<p class="broke"></p><br>
									
                                
									<div class="form-group">        			  
										
									<button id="miBoton" style="height: auto; width: auto; font-size:x-large; background-color:#004aad; color:white;" type="button" onclick="validarpush()" aria-label="Left Align">NOTIFICAR
									<i class="fas fa-comment-alt"></i></button>
											<input type="hidden" name="action" value="atencion">  
											
											</a>
										</abbr>								
								</div>
								
</div>

							</div>	
							
<div class="row">						
	<div class="divAtencion">							
		<p class="parrafoInfo" style="font-size: x-large;">¡NOTA!</p>
		<p class="parrafoAtencion" style="font-size: x-large;" >	Notificacion a usuarios mediante:		</p>
		<p class="parrafoInfo">-Envio de mensaje en Telegram mediante SecureCodeBot.</p>
		<br>
		<p class="brok"></p>
		<br>			
			<div class="form-group">        			  			
				<button id="miBoton" style="height: auto; width: auto; font-size:x-large; background-color:#004aad; color:white;" type="button"  onclick="validar()" aria-label="Left Align">ENVIAR MENSAJE TELEGRAM
				<i class="fab fa-telegram"></i></button>
				<input type="hidden" name="action" value="atenciont">  				
				</a>
				</abbr>								
			</div>
	</div>							
</div>	
</div>
</div>	
			<input hidden type="text" disabled  />							                        
            </div>
<script>
function cambio(){
		$('#masterFormDetalleAlerta').on('change', 'select', function (e) {
    	var val = $(e.target).val();
    	var text = $(e.target).find("option:selected").text(); //only time the find is required
    	var name = $(e.target).attr('name');
		//console.log(val);
       
$.ajax({
  method: "POST",
  url: "ajax.php",
  data: { text: $(e.target).val() }
})
  .done(function( response ) {
    $("p.broken").html(response);
  });

});
 
	}	

</script>

<script>
function validar(){
    $("#masterFormDetalleAlerta").submit();
  
}

function validarpush(){
    
	$.ajax({
  method: "GET",
  url: "notification.php",
  
})
  .done(function( response ) {
    $("p.broke").html(response);
  });
  
}


</script>

<?php 


?>
</form>