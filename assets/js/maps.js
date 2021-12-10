		function findMe(){
			var output = document.getElementById('map');

			// Verificar si soporta geolocalizacion
			if (navigator.geolocation) {

				
				output.innerHTML = "<p>Tu navegador soporta Geolocalizacion</p>";
				
				
			}else{
				output.innerHTML = "<p>Tu navegador no soporta Geolocalizacion</p>";
			}

			//Obtenemos latitud y longitud
			function localizacion(){
				
				
				var latitude = parseInt(document.getElementById('latitud').value);
				var longitude = parseInt(document.getElementById('longitud').value);				
				var imgURL = "https://maps.googleapis.com/maps/api/staticmap?center="+latitude+","+longitude+"&size=600x300&markers=color:red%7C"+latitude+","+longitude+"&key=AIzaSyDg6py7cZHPkgOHPZ3TdbTC5s6dB70_D9I";
				output.innerHTML ="<img src='"+imgURL+"' >";
				

			}

			function error(){
				output.innerHTML = "<p>No se pudo obtener tu ubicación</p>";

			}

			navigator.geolocation.getCurrentPosition(localizacion,error);

		}
