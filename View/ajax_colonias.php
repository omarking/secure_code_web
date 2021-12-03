               		   <form method="GET">
                          <div class="datagrid">
       <table id="example" name="example" class="table table-striped table-bordered" style="width:100%">                      
                          <thead>
                            <tr>
                            <th> CLAVE DE USUARIO <i class="fas fa-exclamation-triangle"></i></th>
                            <th> NOMBRE <i class="fas fa-exclamation-triangle"></i></th>
                            <th> TELEFONO <i class="fas fa-exclamation-triangle"></i></th>
                            <th> CORREO <i class="fas fa-calendar"></i></th>
                            <th> ESTADO TELEGRAM <i class="fas fa-calendar"></i></th>                        
                            <th>  </th>
                          </tr>
                          </thead>
                        <tbody>
                        <?php include './../Model/Colonia.php'; 
                        $text = $_POST['text'];
                        
                                $model= new Colonia();
                                session_start();
                                
                                foreach ($model->DetalleTipo($text) as $va ):
                                    $valor =$va->CLAVE_USUARIO;
                                
                          ?>
                         <tr>  
                         <td>  <?php  echo $va->CLAVE_USUARIO;     ?> </td>
                         <td>  <?php  echo $va->NOMBRE;   ?> </td>  
                         <td>  <?php  echo $va->TELEFONO; ?> </td>
                         <td>  <?php  echo $va->CORREO;   ?> </td>
                         <td>  <?php  echo $va->ESTADO_TELEGRAM;   ?> </td>
                         <td>  <i class="glyphicon glyphicon-edit"><a href="./colonia_usuarioDetalle.php?idusuario =<?php echo $va->CLAVE_USUARIO;    ?>"> Editar</a></i>           </td>
                         <td>  <i class="glyphicon glyphicon-edit"><a href="./usuario_nuevo.php?idusuario=<?php echo $va->CLAVE_USUARIO; ?>"> Eliminar</a></i>           </td>
                          </tr>
                      <?php      endforeach; 
                      
                      
                      
                      ?>                     
                        
                        </tbody>
                        
                        </table>


       </div>
       </form>

       <script>
$('#example').find('tr').click( function(){
  var row = $(this).find('td:first').text();
  $.ajax({
  method: "POST",
  url: "ajax_colonia.php",
  data: { usuarioid: row}
})
  .done(function( response ) {
    $("p.broken").html(response);
  });
});
       </script>