<?php session_start();
include 'master.php';
 include './../Controller/controller_alerta.php';?>    

<!DOCTYPE html>
<html>
 <head>
 	<title>	DETALLE ALERTA</title>
	<script src="../assets/js/maps.js"></script>
	<script src="../mysql.js"></script>	
	<script>
	var place_id;
	function retornarPagina(){
			history.go(-1);
		}
	function solicitud(){									
		var latitude=document.getElementById("latitud").value; 
		var longitude=document.getElementById("longitud").value; 
		latitude=parseFloat(latitude);
		longitude=parseFloat(longitude);
		var Http = new XMLHttpRequest();
		var url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + latitude + ',' + longitude+ '&key=AIzaSyDg6py7cZHPkgOHPZ3TdbTC5s6dB70_D9I';
		Http.open('POST', url);
		Http.send();
		Http.onload = function() {
			const datajson=Http.responseText;
			var decoded_data=JSON.parse(datajson);
			numero=decoded_data['results'][0]['address_components'][0]['long_name'];
			calle=decoded_data['results'][0]['address_components'][1]['long_name'];
			colonia=decoded_data['results'][0]['address_components'][2]['long_name'];
			general=decoded_data['results'][0]['formatted_address'];
			municipio=decoded_data['results'][0]['address_components'][3]['long_name'];
			estado=decoded_data['results'][0]['address_components'][4]['long_name'];			
			//cp=decoded_data['results'][0]['address_components'][6]['long_name'];
			//alert(cp);
			place_id=decoded_data['results'][0]['place_id'];							
			document.getElementById("adicional_general").value=general; 			
			document.getElementById("adicional_calle").value=calle; 
			document.getElementById("adicional_numero").value=numero; 
			document.getElementById("adicional_colonia").value=colonia; 
			document.getElementById("adicional_municipio").value=municipio;
			//document.getElementById("adicional_cp").value=cp; 																
			document.getElementById("adicional_estado").value=estado; 																
			//alert(place_id);
			var idpush=document.getElementById("idusuario").value;	
			var alerta=document.getElementById("idalerta").value;									
			var message="La alerta: "+alerta+" ha sido atendida con exito";
			//alert(place_id);
			$.ajax({
  			method: "POST",
  			url: "session.php",
  			data: { text: general,
					calle:calle,
					numero:numero,
					colonia:colonia,
					municipio:municipio,
					idpush:idpush,			
					idalerta:"",
					identidadDes:"",
					message:message,
			}
				})
  			.done(function( response ) {
    		$("p.broken").html(response);
  			});
      
		}
		}					
	
	

	function initMap(){
		var latitude = document.getElementById('latitud').value;
		var longitude = document.getElementById('longitud').value;
		latitude=parseFloat(latitude);
		longitude=parseFloat(longitude);		
		var coordenadas = {lat:latitude, lng:longitude };
		var mapa= new google.maps.Map(document.getElementById('map'),{zoom:17, center:coordenadas});
  		var marker = new google.maps.Marker({position: coordenadas, map:mapa});	
		var popup = new google.maps.InfoWindow({content: 'Ubicacion de la alerta'});
		popup.open(map, marker);
		solicitud();	  
		}

	function showInfo() {
    	mapa.setZoom(16); //aumenta el zoom
    	mapa.setCenter(marker.getPosition());
		var contentString = 'Ubicación Actual';
    	var infowindow = new google.maps.InfoWindow({
    	content: 'Aqui es donde estudio, lee mas información en: '});
 		infowindow.open(mapa,marker);
		}
	 
		//Dispara accion al dar un clic en el marcador		
	//	google.map.event.addListener(marker, 'click', showInfo);
	</script> 	        			
	<style>
		body {
			background-color: #ffffff;
			}
  	</style>	
</head>
<body >    
    <div id="encabezado">DETALLE DE ALERTA EN ESPERA</div>
       <div id="masterPrincipal">
			<form id="masterFormDetalleAlerta" name="masterFormDetalleAlerta" action="../Controller/controller_alerta.php" >			
				<p hidden class="broken"></p>
				<div id="masterbotones">
				<svg class="bi bi-alert-triangle text-success" width="32" height="32" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"></svg>
				<abbr title="ATRAS">
					<button type="button" class="btn btn-default" aria-label="Left Align" onclick="retornarPagina()" >
  					<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
					</button>
				</abbr>
				<abbr title="IMPRIMIR">
					<a target="_blank"  href='../Controller/controller_alerta.php?action=pdf&idalerta=<?php echo $_SESSION['idalerta']?>'; class="btn btn-default" aria-label="Left Align">
  					<span class="glyphicon glyphicon-print" aria-hidden="true" target="_blank"></span>
					</a>
				</abbr>
			
				
				</div>
		<br> 
			<?php $controller= new AlertaController();		
			foreach($controller->AtendidadAlertasD($_GET['idatencion']) as $alm ): 	
				$_SESSION['idalerta']=$alm->CODIGO_ALERTA;?>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							<label>CLAVE DE ATENCION
							<i class="fas fa-info-circle"></i>
							</label>
							<input type="text" disabled name="idatencion" id="idatencion" value="<?php echo $alm->CODIGO_ATENCION; ?>" class="form-control" placeholder="clave de atencion"/>
								
						</div>
						<div class="form-group">
							<label>CODIGO DE ALERTA
							<a class="glyphicon glyphicon-warning-sign" style="color:black;"></a>
							</label>
							<input type="text" name="idalerta" id="idalerta" disabled value="<?php echo $alm->CODIGO_ALERTA; ?>" class="form-control"   />
						</div>  
						<div class="form-group">
							<label>CLAVE DE USUARIO
							<i class="fas fa-address-card"></i>
							</label>
							<input type="text" name="idusuario" id="idusuario" disabled value="<?php echo $alm->CLAVE_USUARIO; $_SESSION['idpush']=$alm->CLAVE_USUARIO;?>" class="form-control" placeholder="clave de usuario"  />
						</div>
						<div class="form-group">
							<label>NOMBRE
							<i class="fas fa-user"></i>
							</label>
							<input type="text" name="nombre" id="nombre" disabled value="<?php echo $alm->NOMBRE_USUARIO; ?>" class="form-control" placeholder="nombre"  />
						</div>
						<div class="form-group">
							<label>DESCRIPCION
							<i class="fas fa-info"></i>
							</label>
							<input type="text" name="descripcion" id="descripcion" disabled value="<?php echo $alm->DESCRIPCION; ?>" class="form-control" placeholder="descripcion"  />
						</div>
						<div class="form-group">
							<label>UBICACION
							<i class="fas fa-map-marked-alt"></i>
							</label>
							<input type="text"   id="ubicacion" disabled name="ubicacion" value="<?php echo $alm->LONGITUD. " ".$alm->LATITUD; ?>"  class="form-control" placeholder="longitud"  />
						</div>
						<div class="form-group">
							<label>FECHA DE EMISION
							<i class="fas fa-calendar"></i>
						</label>
							<input type="text"   id="fechaemision" disabled name="fechaemision" value="<?php echo $alm->FECHA_EMISION; ?>"  class="form-control" placeholder="longitud"  />
						</div>
						<div class="form-group">
							<input hidden type="text" id="latitud" disabled name="latitud" value="<?php echo $alm->LATITUD; ?>" class="form-control" placeholder="latitud"  />
							<input hidden type="text" id="longitud" disabled name="longitud" value="<?php echo $alm->LONGITUD; ?>" class="form-control" placeholder="latitud"  />
						</div>
						</div>
						<div class="col-md-6"><br>
						<div id="map" style="height:400px; width: 600px;"> MAPA </div>
						</div>
						<div class="form-group">
							<label>SERVICIO DE EMERGENCIA SOLICITADO
							<i class="fas fa-shield-alt"></i>
							</label>
							<input type="text"   id="identidad" disabled name="identidad" value="<?php echo $alm->ENTIDAD; ?>"  class="form-control" placeholder="longitud"  />
						</div>
					</div>	
			   <?php   
			   endforeach ?> 
				
					<div id="divoculto" > 
							<div class="form-group">
							<label>DOMICILIO GENERAL
							<i class="fas fa-map-marked-alt"></i>
							</label>
							<input type="text" disabled  id="adicional_general" class="form-control" placeholder=""/>
							</div>
							
							<div class="row">					
								<div class="col-md-6">
									<div class="form-group">
									<label>CALLE
									<i class="fas fa-map-marked-alt"></i>
									</label>
									<input type="text" disabled name="adicional_calle" id="adicional_calle" class="form-control" placeholder="#"/>
									</div>
								</div>					
								<div class="col-md-6">
									<div class="form-group">
										<label>NUMERO
										<i class="fas fa-map-marked-alt"></i>
										</label>
										<input type="text" disabled name="adicional_numero" id="adicional_numero" class="form-control" placeholder="#"/>
									</div>
								</div>
							</div>
							<div class="row">					
								<div class="col-md-6">
									<div class="form-group">
										<label>COLONIA
										<i class="fas fa-map-marked-alt"></i>
										</label>
										<input type="text" disabled name="adicional_colonia" id="adicional_colonia" class="form-control" placeholder="#"/>
									</div>
								</div>					
								<div class="col-md-6">
									<div class="form-group">
										<label>CIUDAD
										<i class="fas fa-city"></i>
										</label>
										<input type="text" disabled name="adicional_municipio" id="adicional_municipio" class="form-control" placeholder="#"/>
									</div>
								</div>
								<div class="row">					
								<div class="col-md-6">
									<div class="form-group">
										<label>CP
										<i class="fas fa-map-marked-alt"></i>
										</label>
										<input type="text" disabled name="adicional_cp" id="adicional_cp" class="form-control" placeholder="#"/>
									</div>
								</div>					
								<div class="col-md-6">
									<div class="form-group">
										<label>ESTADO
										<i class="fas fa-map-marked-alt"></i>
										</label>
										<input type="text" disabled name="adicional_estado" id="adicional_estado" class="form-control" placeholder="#"/>
									</div>
								</div>
								</div>	<br>
									<div id="btncerrar"	><br>
								<abbr title="CERRAR">
								<button type="button" style="background-color: #004aad; color:#ffffff;";  onclick="validar();"; class="btn btn-default" aria-label="Left Align">
  								CERRAR ALERTA
								</button>
									</abbr>	</div>
									<p class="broken"></p>
											

						</div>
					</div> 					
			</form>
			<script>
				function validar(){					
					var idalerta=document.getElementById("idalerta").value;	

					$.ajax({
  method: "GET",
  url: "notification.php",
   
})
  .done(function( response ) {
    $("p.broken").html(response);
  });	
  $.ajax({
  method: "GET",
  url: "../Controller/controller_alerta.php",
   data:{
	   action:'cerrarAlerta',
	   codalerta:idalerta
   }
})
  .done(function( response ) {
    location.href ='../View/alertas_aprobadas.php';
  });														
				}


			</script>
		</div> 					
	</div>	
</body>
</html>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDg6py7cZHPkgOHPZ3TdbTC5s6dB70_D9I&callback=initMap"async defer></script>