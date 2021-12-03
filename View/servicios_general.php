<?php session_start();
include 'master.php';?>
<?php #include 'Controller/controller_servicioemergencia.php';
      include './../Model/SerEmergencia.php'; ?>      
<!DOCTYPE html>
<html>
<head>
	<title>SERVICIOS DE ATENCIÓN</title>
</head>
<body>
    	
<style>
    body {
      background-color: #ffffff;}

  </style>
        <div id="encabezado">
        SERVICIOS DE ATENCIÓN
        </div>
        <br><br>
       <div id="masterPrincipal">
         <did id="masterFormDetalleAlerta">
       <div class="datagrid">
       <table id="example" class="table table-striped table-bordered" style="width:100%">                                
                          <thead>
                            <tr>
                            <th> ID ENTIDAD <i class="fas fa-id-card"></i></th>
                            <th> DESCRIPCION <i class="fas fa-info-circle"></i></th>
                            <th> TELEFONO <i class="fas fa-phone"></i></th>
                            <th> DIRECCION <i class="fas fa-map-marked-alt"></i></th>
                            <th> CORREO <i class="fas fa-envelope-open-text"></i></th>
                            <th> ESTADO <i class="fas fa-university"></i><th>
                            <th></th>
                            <th></th>
                          </tr>
                          </thead>
                        <tbody>
                          
                          <?php 
                                $model= new SerEmergencia();
                          foreach ($model->MostrarServicios() as $va ): ?>
                         <tr>  
                         <td>  <?php  echo $va->ID_ENTIDAD;    ?> </td>
                         <td>  <?php  echo $va->DESCRIPCION;   ?> </td>  
                         <td>  <?php  echo $va->TELEFONO;      ?> </td>
                         <td>  <?php  echo $va->DIRECCION; ?> </td>
                         <td>  <?php  echo $va->CORREO;   ?> </td>
                         <td>  <?php  echo $va->ESTADO;   ?> </td>

                         <td>  <i class="glyphicon glyphicon-edit"><a href="./servicios_editar.php?identidad=<?php echo $va->ID_ENTIDAD; ?>"> Editar</a></i>           </td>
                         <td>  <i class="glyphicon glyphicon-edit"><a href="./alertas_detalle.php?idalerta=<?php echo $va->ID_ALERTA; ?>"> Eliminar</a></i>           </td>
                          </tr>
                      <?php      endforeach; ?> 
                        </tbody>
                        
                        </table>
       </div> </div>
        </div>


</body>
</html>