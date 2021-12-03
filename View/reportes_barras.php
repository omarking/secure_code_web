<?php
session_start();
include 'master.php';?>
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
    <title>Gráficas con chart.js y PHP | By Parzibyte</title>
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
            label: "Ventas por mes",
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