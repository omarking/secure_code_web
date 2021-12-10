  	$(document).ready(function() {
		

		// validate signup form on keyup and submit
		$("#formPrincipal").validate({
			rules: {
				
				inpUsuario: {
					required: true,
				},
				inpPassword: {
					required: true,
					minlength: 5
				}
			},
			messages: {
				inpUsuario: {
					required: "Ingresa tu nombre de usuario",
				},
				inpPassword: {
					required: "Ingresa tu contraseña",
					minlength: "Tu contraseña debe de tener al menos 5 digitos"
				}
			}
		});
	});
