<?php    include ('./master.php'); ?>

<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>
                 
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <a class="navbar-brand glyphicon glyphicon-user" href="#">CodeWay</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="glyphicon glyphicon-user"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link glyphicon glyphicon-home" href="/View/home.php">HOME <span class="sr-only">(current)</span></a>
      </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle glyphicon glyphicon-exclamation-sign" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ALERTAS</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item glyphicon glyphicon-list-alt" href="/View/alertas.php">GENERAL</a>
          <a class="dropdown-item glyphicon glyphicon-ok" href="#">ATENDIDAS</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle glyphicon glyphicon-user" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">USUARIOS</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item glyphicon glyphicon-user" href="#">USUARIOS</a>
          <a class="dropdown-item glyphicon glyphicon-plus" href="#">REGISTRAR NUEVO USUSARIO</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle glyphicon glyphicon-star" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SERV. EMERGENCIA</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item glyphicon glyphicon-star" href="#">SERVICIOS DE EMERGENCIA</a>
          <a class="dropdown-item glyphicon glyphicon-plus" href="#">REGISTRAR NUEVO SERVICIO DE EMERGENCIA</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link glyphicon glyphicon-stats" href="/View/home.php">REPORTES<span class="sr-only">(current)</span></a>
      </li>      
  </div>
  <div class="">
  <ul class="nav navbar-nav navbar-right">
  
      <a class="nav-link glyphicon glyphicon-user" href="/View/home.php">PERFIL<span class="sr-only">(current)</span></a>
      <a class="nav-link glyphicon glyphicon-user" href="/View/home.php">SALIR<span class="sr-only">(current)</span></a>
    </ul>
    </div>
  </nav>
<script type="text/javascript" src="js/bootstrap/bootstrap-dropdown.js"></script>
<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>
