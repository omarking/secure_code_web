<?php
include './../Controller/controller_alerta.php'; 
$text = $_POST['text'];
session_start();
	$idalerta=$_SESSION['idalerta'];

    $controller=new AlertaController();		
	$controller= new AlertaController();
    $controller->actualizarAtencion($idalerta);      
    $controller->atendeAlerta($idalerta, $text);  
	
	
	foreach($controller->DetalleIdentidad($text) as $alm ): 	?>
                <script>
					function enviarCorreo(){
						correoidentidad=document.getElementById("correoidentidad").value; 
						if(
						$.ajax({
  			method: "POST",
  			url: "../Model/correo.php",
  			data: { 				
				  text: correoidentidad,
			}
				})
  			.done(function( response ) {
    		$("p.broken").html(response);
  			})){

				alert("CORREO ENVIADO")	;

			  }
			  		}
					</script>
		

						   
									<div class="form-group">
										<label>TELEFONO
										<i class="fas fa-phone"></i>
										</label>
										<input type="text" disabled name="telefonoidentidad" id="telefonoidentidad" class="form-control" value="<?php echo $alm->TELEFONO; ?>"/>
									</div>
												
									<div class="form-group">
										<label>DIRECCION
										<i class="fas fa-map-marked-alt"></i>
										</label>
										<input type="text" disabled name="dirrecionidentidad" id="dirrecionidentidad" class="form-control" value="<?php echo $alm->DIRECCION; ?>"/>
									</div>
									
								
									<div class="form-group">
										<label>CORREO
										<i class="fas fa-envelope-open-text"></i>
										</label>
										<input type="text" disabled name="correoidentidad" id="correoidentidad" class="form-control" value="<?php echo $alm->CORREO; ?>"/>
									</div>
								 	
								
                                
									<div class="form-group">        			  
										<abbr title="ATENCION">
										
										<button style="height: auto; width: auto; font-size:x-large; background-color:#004aad; color:white;" type="button" onclick="enviarCorreo()" aria-label="Left Align">ENVIAR
										<span class="glyphicon glyphicon-envelope" aria-hidden="true" ></span></button>
											<input type="hidden" name="action" value="atencion">  
											
											</a>
										</abbr>
										<p class="broken"></p>
								</div>							
							
				



                            <?php endforeach;
							
						
							?>





