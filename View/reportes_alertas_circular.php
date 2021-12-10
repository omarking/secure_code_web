<?php session_start();
include './master.php';
?>
    <div id="masterPrincipal">
        <div id="masterFormDetalleAlerta">
<div id=""> 
  <h1 style="text-align: center;">REPORTE DE USUARIOS FRECUENTES</h1>
  <?php

require_once '../Model/report_conection.php'; // Conectar a la BD
$sql = "select concat_ws(' ', T2.usNombres, T2.usPrimerApellido, T2.usSegundoAPellido) as USUARIO, count(t1.idusuario)as TOTAL from alerta_emision as t1 inner join usuario as t2 on t1.idusuario=t2.idusuario
group by USUARIO order by  TOTAL desc limit 3;
"; // Consulta SQL
$result = $con->query($sql); // Ejecutar la consulta SQL
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['USUARIO', 'TOTAL'],
      <?php
      if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            echo "['".$row['USUARIO']."', ".$row['TOTAL']."],";
          }
      }
      ?>
    ]);
    
    var options = {
        title: '',
        width: 900,
        height: 500,
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chart.draw(data, options);
}
</script>
</head>
<body>
    <!-- Display the pie chart -->
    <div id="piechart"></div>
</body>
</html>
  
</div>
  </div>
    </div></div>