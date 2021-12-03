<?php session_start();
include './master.php';
?>
    <div id="masterPrincipal">
        <div id="masterFormDetalleAlerta">
<div id=""> 
  <h1 style="text-align: center;">REPORTE DE ALERTAS</h1>
  <?php

$con = new mysqli("localhost","root","12345","locateme2"); // Conectar a la BD
$sql = "SELECT  ateObservaciones as ESTADO, count(ateObservaciones) as TOTAL from atencion_alerta group by ateObservaciones order by total;
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
      ['ESTADO', 'TOTAL'],
      <?php
      if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            echo "['".$row['ESTADO']."', ".$row['TOTAL']."],";
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