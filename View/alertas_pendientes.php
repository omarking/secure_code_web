<?php session_start();
include 'master.php';?>
<?php include './../Controller/controller_alerta.php';
   #   include './../Model/Alerta.php'; ?>      
<!DOCTYPE html>
<html>
<head>
	<title>ALERTAS PENDIENTES</title>
</head>
<body>
  
<style>
    body {
      background-color: #ffffff;}

  </style>
        <div id="encabezado">
        HISTORIAL DE ALERTAS PENDIENTES
        </div>
        <br><br>
       <div id="masterPrincipal">
       <div id="masterFormDetalleAlerta">
       <div class="datagrid">
       <table id="example" class="table table-striped table-bordered" style="width:100%">                      
                          <thead>
                            <tr>
                            <th> ID ALERTA <i class="fas fa-exclamation-triangle"></i></th>
                            <th> CLAVE USUARIO <i class="fas fa-id-card"></i></th>
                            <th> NOMBRE <i class="fas fa-user"></i></th>
                            <th> DESCRIPCION <i class="fas fa-info-circle"></i></th>
                            <th> LOGITUD <i class="fas fa-location-arrow"></i></th>
                            <th> LATITUD <i class="fas fa-location-arrow"></i></th>
                            <th> FECHA <i class="fas fa-calendar"></i></th>
                            <th></th>
                            <th></th>
                          </tr>
                          </thead>
                        <tbody>
                          
                          <?php 
                                $model= new Alerta();
                          foreach ($model->PendientesAlerta() as $va ): ?>
                         <tr>  
                         <td>  <?php  echo $va->ID_ALERTA;    ?> </td>
                         <td>  <?php  echo $va->CLAVE_USUARIO;   ?> </td>  
                         <td>  <?php  echo $va->NOMBRE;      ?> </td>
                         <td>  <?php  echo $va->DESCRIPCION; ?> </td>
                         <td>  <?php  echo $va->LONGITUD;   ?> </td>
                         <td>  <?php  echo $va->LATITUD;   ?> </td>
                         <td>  <?php  echo $va->FECHA       ?> </td>
                         <td>  <i class="glyphicon glyphicon-edit"><a href="./alertas_detalle.php?idalerta=<?php echo $va->ID_ALERTA; ?>"> Editar</a></i>           </td>
                         <td>  <i class="glyphicon glyphicon-edit"><a href="../Controller/controller_alerta.php?action=eliminar&idalerta=<?php echo $va->ID_ALERTA; ?>"> Eliminar</a></i></td>
                        </tr>
                      <?php      endforeach; ?> 
                        </tbody>
                        
                        </table>
       </div> </div>
        </div>
        


</body>
</html>