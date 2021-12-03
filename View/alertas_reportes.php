<?php session_start();
include 'master.php';
include './../Controller/controller_alerta.php';?>

<!DOCTYPE html>
<html>
<head>
	<title>REPORTES DE ALERTAS</title>
    <script>
function openReport(evt, reportName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(reportName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
</head>
<body>  
<style>
    body {
      background-color: #ffffff;}

  </style>
        <div id="encabezado">
        REPORTES DE ALERTAS
        </div>
        <br><br>
       <div id="masterPrincipal">
       <div id="masterFormDetalleAlerta">
       <div class="tab">
  <button class="tablinks" onclick="openReport(event, 'Barras2')">Barras</button>
  <button class="tablinks" onclick="openReport(event, 'Circular')">Circular</button>
  <button class="tablinks" onclick="openReport(event, 'Lineal')">Lineal</button>
  <button class="tablinks" onclick="openReport(event, 'Barras1')">Lineal</button>
</div>

<!-- Tab content -->
<div id="Barras2" class="tabcontent">
  <div> <?php
  $con = new mysqli("localhost","root","12345","locateme2"); // Conectar a la BD
$sql = "SELECT t2.enti_descripcion AS ENTIDAD, count(t2.enti_descripcion)as TOTAL
from atencion_alerta as t1 inner join entidades_emergencia as t2 on t1.identidades=t2.identidades_emergencia
 group by ENTIDAD order by TOTAL;
"; // Consulta SQL
$query = $con->query($sql); // Ejecutar la consulta SQL
$data = array(); // Array donde vamos a guardar los datos
while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
    $data[]=$r; // Guardar los resultados en la variable $data
}?>
    <title>Reporte de barras</title>
    <script src="chart.min.js"></script>
<h1>Grafica de Barra</h1>
<canvas id="chart1" style="width:100%;" height="100"></canvas>
<script>
var ctx = document.getElementById("chart1");
var data = {
  labels: [ 
        <?php foreach($data as $d):          
        $ms=$d->ENTIDAD;
        ?>
        "<?php echo $ms?>", 
        <?php endforeach; ?>
        ],
        datasets: [{
            label: 'No. Alertas',
            data: [
        <?php foreach($data as $d):?>
        <?php echo $d->TOTAL;?>, 
        <?php endforeach; ?>
            ],
            backgroundColor: "#004aad",
            borderColor: "#fff",
            borderWidth: 2
        }]
    };
var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    };
var chart1 = new Chart(ctx, {
    type: 'bar', /* valores: line, bar*/
    data: data,
    options: options
});
</script>
</body>
</html>


  </div>
</div>

<div id="Circular" class="tabcontent">
  <h3>CIRUCLAR</h3>
  <?php

$con = new mysqli("localhost","root","12345","locateme2"); // Conectar a la BD
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
        title: 'Grafica circular de usuarios mas frecuentes',
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

<div id="Lineal" class="tabcontent">
  <div>
  <!DOCTYPE html>
<html lang="es">
<?php
// Valores con PHP. Estos podrían venir de una base de datos o de cualquier lugar del servidor
$etiquetas = [];
$datosVentas = [];
$con = new mysqli("localhost","root","12345","locateme2");
$sql = "SELECT distinct MONTH(aler_fecha) as mes, Year(aler_fecha)as 'año', COUNT(*) as Total FROM alerta_emision WHERE 
aler_fecha BETWEEN '2018-01-01' AND '2030-12-31' GROUP BY mes;

"; // Consulta SQL
$query = $con->query($sql); // Ejecutar la consulta SQL
$data = array(); // Array donde vamos a guardar los datos
while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
    $data[]=$r; // Guardar los resultados en la variable $data
}
 foreach($data as $d):        
  $mes=$d->mes;
  if($mes==1){
  $ms="ENERO"; 
}
if($mes==2){
  $ms="FEBRERO"; 
}
if($mes==3){
  $ms="MARZO"; 
}
if($mes==4){
  $ms="ABRIL"; 
}
if($mes==5){
  $ms="MAYO"; 
}
if($mes==6){
$ms="JUNIO"; 
}
if($mes==7){
$ms="JULIO"; 
}
if($mes==8){
$ms="AGOSTO"; 
}
if($mes==9){
$ms="SEPTIEMBRE"; 
}
if($mes==10){
$ms="OCTUBRE"; 
}
if($mes==11){
$ms="NOVIEMBRE"; 
}
if($mes==12){
$ms="DICIEMBRE"; 
}
array_push($etiquetas, $ms);
array_push($datosVentas, $d->Total);
//foreach($etiquetas as $va): echo  $va;  endforeach;
endforeach;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Importar chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
</head>

<body>
    <h1>Gráfica creada con PHP</h1>
    <canvas id="grafica"></canvas>
    <script type="text/javascript">
        // Obtener una referencia al elemento canvas del DOM
        const $grafica = document.querySelector("#grafica");
        // Pasaamos las etiquetas desde PHP
       
const etiquetas = <?php echo json_encode($etiquetas) ?>;

        // Podemos tener varios conjuntos de datos. Comencemos con uno
        const datosVentas2020 = {
            label: "ALERTAS POR MES",
            // Pasar los datos igualmente desde PHP
            data: <?php echo json_encode($datosVentas) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
        };
        new Chart($grafica, {
            type: 'line', // Tipo de gráfica
            data: {
                labels: etiquetas,
                datasets: [
                    datosVentas2020,
                    // Aquí más datos...
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                },
            }
        });
    </script>
</body>

</html>
  </div>
</div>
        
    
            </div>
        </div>

        <div id="Barras1" class="tabcontent">
  <div> 
  <h3>CIRUCLAR</h3>
  <?php

$con = new mysqli("localhost","root","12345","locateme2"); // Conectar a la BD
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
        title: 'Grafica circular de usuarios mas frecuentes',
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
</div>
