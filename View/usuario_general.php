<?php session_start();
include 'master.php';
include './../Controller/controller_usuario.php';?>

	<title>USUARIOS</title>
    	
<style>
    body {
      background-color: #ffffff;}

  </style>
        <div id="encabezado">
        LISTADO DE USUARIOS
        </div>
        <br><br>
       <div id="masterPrincipal">
       <div id="masterFormDetalleAlerta">
       <div class="datagrid">
       <table id="example" class="table table-striped table-bordered" style="width:100%">                                   
                          <thead>
                            <tr>
                            <th> CLAVE USUARIO <i class="fas fa-id-card"></i></th>
                            <th> NOMBRE <i class="fas fa-user"></i></th>
                            <th> FECHA DE NACIMIENTO <i class="fas fa-calendar"></i></th>
                            <th> TELEFONO <i class="fas fa-phine"></i></th>
                            <th> CALLE <i class="fas fa-map-marked-alt"></i>  </th>
                            <th> CORREO <i class="fas fa-envelope-open-text"></i></th>
                            <th> NUMERO <i class="fas fa-map-marked-alt"></i>  </th>
                            <th>  EDITAR </th>
                            <th> ELIMINAR </th>
                          </tr>
                          </thead>
                        <tbody>
                          
                          <?php 
                                $model= new Usuario();
                          foreach ($model->MostrarUsuarios() as $va ): ?>
                         <tr>  
                         <td>  <?php  echo $va->CLAVE_USUARIO;    ?> </td>
                         <td>  <?php  echo $va->NOMBRE;   ?> </td>  
                         <td>  <?php  echo $va->FECHA_NACIMIENTO;      ?> </td>
                         <td>  <?php  echo $va->TELEFONO; ?> </td>
                         <td>  <?php  echo $va->CALLE;   ?> </td>
                         <td>  <?php  echo $va->CORREO;   ?> </td>
                         <td>  <?php  echo $va->NUMERO;   ?> </td>
                         <td>  <i class="glyphicon glyphicon-edit"><a href="./usuario_editar.php?idusuario=<?php echo $va->CLAVE_USUARIO; ?>"> Editar</a></i>           </td>
                         <td>  <i class="glyphicon glyphicon-edit"><a href="./usuario_nuevo.php?idusuario=<?php echo $va->CLAVE_USUARIO; ?>"> Eliminar</a></i>           </td>
                          </tr>
                      <?php      endforeach; ?> 
                        </tbody>
                        
                        </table>
       </div> </div></div>
        <br><br>
