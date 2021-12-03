<?php 
if (!isset($_SESSION['idusuario'])) {
    header('location: ../View/login.php');
}    
 ?>                               
<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<meta name="viewport"content="width=device-width, initial-scale=1" style="width:100%">
<title> </title>
<link rel="icon" type="image/png" sizes="16x16" href="../assets/resources/favicon-16x16.png">
  <link rel="stylesheet" href="./../assets/css/master_css.css">        
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>
</head>
<body >
                 

<nav class="navbar navbar-expand-lg navbar" style="background-color: #004aad;">
  <a class="navbar-brand glyphicon glyphicon-user"  style="color:white ;">SecureCode</a>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" >
      <li class="nav-item active">
        <a class="nav-link glyphicon glyphicon-home" href="/View/home.php" style="color:white;">HOME <span class="sr-only">(current)</span></a>
      </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle glyphicon glyphicon-exclamation-sign" style="color:white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ALERTAS</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item glyphicon glyphicon-list-alt" style="font-size:small;" style="color:black;" href="/View/alertas_general.php">GENERAL</a>
          <a class="dropdown-item glyphicon glyphicon-hourglass" href="/View/alertas_pendientes.php">PENDIENTES</a>
          <a class="dropdown-item glyphicon glyphicon-ok" href="/View/alertas_aprobadas.php">APROBADAS</a>
          <a class="dropdown-item fas fa-clock" href="/View/alertas_espera.php">ESPERA</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle glyphicon glyphicon-user" style="color:white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">USUARIOS</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item glyphicon glyphicon-user" href="./usuario_general.php" style="color:black;">USUARIOS</a>
          <a class="dropdown-item glyphicon glyphicon-plus" href="./usuario_nuevo.php" style="color:black;">REGISTRAR NUEVO USUSARIO</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle glyphicon glyphicon-star" href="#" id="navbarDropdown" style="color:white;"role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SERV. EMERGENCIA</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item glyphicon glyphicon-star" href="./servicios_general.php"style="color:black;">SERVICIOS DE EMERGENCIA</a>
          <a class="dropdown-item glyphicon glyphicon-plus" href="./sericio_nuevo.php"style="color:black;">REGISTRAR NUEVO SERVICIO DE EMERGENCIA</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle glyphicon glyphicon-stats" href="#" id="navbarDropdown" style="color:white;"role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">REPORTES</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown"> 
        <a class="dropdown-item glyphicon glyphicon-star" href="./reportes_alertas_barras.php"style="color:black;">REPORTE DE ATENCION DE ENTIDADES DE EMERGENCIA</a>
        <a class="dropdown-item glyphicon glyphicon-star" href="./reportes_alertas_barras1.php"style="color:black;">REPORTE DE ATENCION DE TIPOS DE ALERTAS</a>
        <a class="dropdown-item glyphicon glyphicon-star" href="./reportes_alertas_circular.php"style="color:black;">REPORTE DE USUARIOS FRECUENTES</a>
        <a class="dropdown-item glyphicon glyphicon-star" href="./reportes_alertas_circular1.php"style="color:black;">REPORTE DE ALERTAS</a>
        <a class="dropdown-item glyphicon glyphicon-star" href="./reportes_alertas_lineal.php"style="color:black;">REPORTES ALERTAS POR MES</a>
        <a class="dropdown-item glyphicon glyphicon-star" href="./reportes_alertas_lineal1.php"style="color:black;">REPORTES ALERTAS POR HORA</a>
        <a class="dropdown-item glyphicon glyphicon-star" href="./reportes_alertas_caracol.php"style="color:black;">REPORTES DE COLONIAS MAYOR PELIGROSAS</a>
        <a class="dropdown-item glyphicon glyphicon-star" href="./reportes_alertas_caracol2.php"style="color:black;">REPORTES DE ALTA DE TELEGRAM</a>
      </li> 
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle glyphicon glyphicon-home" style="color:white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">COLONIAS</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item glyphicon glyphicon-home" href="./colonia_general.php" style="color:black;">COLONIAS</a>
          <a class="dropdown-item glyphicon glyphicon-plus" href="./colonia_nuevo.php" style="color:black;">REGISTRAR NUEVA COLONIA</a>
          <a class="dropdown-item glyphicon glyphicon-plus" href="./colonia_usuario.php" style="color:black;">USUARIO COLONIA COLONIA</a>
          <a target="_blank" class="dropdown-item glyphicon glyphicon-plus" href="../assets/resources/ManualTelegram.pdf" style="color:black;">MANUAL COLONIAS</a>
      </li>         
  </div>
  <div >
  <ul class="nav navbar-nav navbar-right">  
      <a class="nav-link glyphicon glyphicon-user" href="/View/usuario_perfil.php" style="color:white;"><?php echo $_SESSION["usNombres"];?></a>
      <a class="nav-link glyphicon glyphicon-log-out" href="../Controller/controller_usuario.php?action=logout" style="color:white;">SALIR</a>
    </ul>
    </div>
  </nav>
<script type="text/javascript" ></script>
<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>
<script type="text/javascript">
        $(document).ready(function() {
    $('#example').DataTable({   "searching": true, 
    "bLengthChange": false, 
    "order": [[ 0, "desc" ]],

    rowCallback:function(row,data){
			if(data[4] <= ""){
				$($(row).find("td")).css("background-color","#F11111");
			}
      
		},
    
     });
} );





    </script>
</body>
</html>				
</body>
</html>
