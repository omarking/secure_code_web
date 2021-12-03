<?php session_start();
include 'master.php';?>
<?php include './../Controller/controller_alerta.php';
   #   include './../Model/Alerta.php'; ?>      
<!DOCTYPE html>
<html>
<head>
	<title>ALERTAS ESPERA </title>
</head>
<body>    	
<style>
    body {
      background-color: #ffffff;}
  </style>
        <div id="encabezado">
        ALERTAS ATENDIDAS
        </div>
        <br><br>
       <div id="masterPrincipal">
         <div id="masterFormDetalleAlerta">
       <div class="datagrid">
       <table id="example" class="table table-striped table-bordered" style="width:100%">                      
                          <thead>
                            <tr>
                            <th> CODIGO DE ATENCION <i class="fas fa-exclamation-triangle"></i></th>
                            <th> CODIGO DE ALERTA <i class="fas fa-exclamation-triangle"></i></th>
                            <th> SERVICIO DE EMERGENCIA <i class="fas fa-hospital-alt"></i></th>
                            <th> FECHA ATENCION <i class="fas fa-calendar"></i></th>
                            <th> FECHA EMESION <i class="fas fa-calendar"></i></th>
                            <th> ESTADO <i class="fas fa-university"></th>
                            <th> LONGITUD <i class="fas fa-location-arrow"></i></th>
                            <th> LATITUD <i class="fas fa-location-arrow"></i></th></th>
                            <th> DESCRIPCION <i class="fas fa-info-circle"></th>
                            <th>  </th>
                            
                            
                          </tr>
                          </thead>
                        <tbody>
                          <?php 
                                $model= new Alerta();
                          foreach ($model->AtendidadAlertas() as $va ): ?>
                         <tr>  
                         <td>  <?php  echo $va->CODIGO_ATENCION;    ?> </td>
                         <td>  <?php  echo $va->CODIGO_ALERTA;   ?> </td>  
                         <td>  <?php  echo $va->ENTIDAD;      ?> </td>
                         <td>  <?php  echo $va->FECHA_ATENCION; ?> </td>
                         <td>  <?php  echo $va->FECHA_EMISION;   ?> </td>
                         <td>  <?php  echo $va->ESTADO;   ?> </td>
                         <td>  <?php  echo $va->LONGITUD;   ?> </td>
                         <td>  <?php  echo $va->LATITUD;   ?> </td>
                         <td>  <?php  echo $va->DESCRIPCION       ?> </td>
                         <td>  <i class="glyphicon glyphicon-edit"><a href="./alertas_finalizadas.php?idatencion=<?php echo $va->CODIGO_ATENCION; ?>"> DETALLE</a></i>           </td>
                        
                         
                        </tr>
                      <?php      endforeach; ?> 
                        </tbody>
                        
                        </table>
       </div> </div>
        
      
        </div>


</body>
</html>