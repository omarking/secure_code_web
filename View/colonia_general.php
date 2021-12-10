<?php 

Session_start();
include 'master.php';

 include '../Controller/controller_colonia.php';?>
    

    <script>
        $(document).ready(function(){
  
  $("datagrid").dataTable({
    
    rowCallback:function(row,data)
    {
      
      if(data[3] == 43629)
      {
        $($(row).find("td")[2]).css("background-color","green");
      }
      else if(data[2] == "Bueno"){
          $($(row).find("td")[2]).css("background-color","blue");
      }
      else{
          $($(row).find("td")[2]).css("background-color","red");
      }
      
    }
    
  });
  
})

</script>

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
        REGISTRO DE COLONIAS
        </div>
        <br><br>
       <div id="masterPrincipal">
         <div id="masterFormDetalleAlerta">
       <div class="datagrid">
       <table id="example" name="example" class="table table-striped table-bordered" style="width:100%">                      
                          <thead>
                            <tr>
                            <th> CODIGO DE COLONIA <i class="fas fa-exclamation-triangle"></i></th>
                            <th> NOMBRE <i class="fas fa-exclamation-triangle"></i></th>
                            <th> MUNICIPIO <i class="fas fa-exclamation-triangle"></i></th>
                            <th> C.P. <i class="fas fa-calendar"></i></th>
                            <th> CHAT ID <i class="fas fa-calendar"></i></th>
                            <th> URL <i class="fas fa-calendar"></i></th>
                            <th> ESTADO <i class="fas fa-university"></th>
                            <th>  </th>
                          </tr>
                          </thead>
                        <tbody>
                          <?php 
                                $model= new Colonia();
                          foreach ($model->MostrarColonia() as $va ): 
                             
                            ?>

                         
                         <tr>  
                         <td>  <?php  echo $va->ID_COLONIA;    ?> </td>
                         <td>  <?php  echo $va->NOMBRE;   ?> </td>  
                         <td>  <?php  echo $va->MUNICIPIO; ?> </td>
                         <td>  <?php  echo $va->CP; ?> </td>
                         <td>  <?php  echo $va->CHATID; ?> </td>
                         <td>  <?php  echo $va->LINK_COLONIA; ?> </td>
                         <td>  <?php  echo $va->ESTADO;   ?> </td>                         
                         <td>  <i class="glyphicon glyphicon-edit"><a href="./colonia_editar.php?idcolonia=<?php echo $va->ID_COLONIA; ?>"> DETALLE</a></i>           </td>
                        
                         
                        </tr>
                      <?php      endforeach; ?> 
                        </tbody>
                        
                        </table>
       </div> </div>
        
      
        </div>

</body>
</html>