<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    INICIO DE SESION
  </title>
  </head>
    <link rel="stylesheet" href="../assets/css/login_css.css">        
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery.validate.js"></script>


    <body>
      <div id="contPrincipal"> 
      <div id="contSecundario">
      <div id="titulo">
                    <div class="loginInf">
                        Bienvenido
                    </div>
                    <div class="logoInf">
                        Secure Code
                    </div>
                    <hr>
                    <div class="loginRecuperacion">
                        <img src="/assets/img/secure.png" height="100" width="100">
                    </div>
                </div>
      <form id="formPrincipal" name="formPrincipal" action="./../Controller/controller_usuario.php" method="POST">
        <input type="hidden" name="action" value="login">  
        <label for="inpUsuario">Usuario:</label>
        <input id="inpUsuario" type ="text" name="inpUsuario" required >

        <label for="inpPassword">Contraseña: </label>
        <input id="inpPassword" type ="password" name="inpPassword" required minlength="4" maxlength="20">

        <button type="submit" id="btnclass">LOGIN</button>  

      


      </form>      
      
      </div>
      </div>





  </body>
</html>