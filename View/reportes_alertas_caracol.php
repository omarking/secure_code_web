<?php session_start();
include './master.php';
?>
<h1 style="text-align: center;">REPORTES DE COLONIAS MAYOR PELIGROSAS</h1><br>
<?php
// Valores con PHP. Estos podrían venir de una base de datos o de cualquier lugar del servidor
$etiquetas = [];
$datosVentas = [];
$con = new mysqli("localhost","root","12345","locateme2");
$sql = "SELECT distinctrow concat_ws(' ', T2.usNombres, T2.usPrimerApellido, T2.usSegundoAPellido) as USUARIO, count(t1.idusuario)
as TOTAL, t3.idColonia,  t4.colNombre as COLONIA
from alerta_emision as t1 inner join usuario as t2 on t1.idusuario=t2.idusuario
inner join usuario_colonia as t3 on t1.idusuario=t3.idusuario inner join colonia as t4 on t3.idColonia=t4.idColonia
group by colNombre order by  TOTAL desc limit 5;

"; // Consulta SQL
$query = $con->query($sql); // Ejecutar la consulta SQL
$data = array(); // Array donde vamos a guardar los datos
while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
    $data[]=$r; // Guardar los resultados en la variable $data
}
 foreach($data as $d):        
 
array_push($etiquetas, $d->COLONIA);
array_push($datosVentas, $d->TOTAL);
//foreach($etiquetas as $va): echo  $va;  endforeach;
endforeach;
?>



<script src="https://fonts.googleapis.com/css?family=Lato"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


<div id="masterPrincipal">
<div id="masterFormDetalleAlerta" >
<canvas id="oilChart" style="width: 150px;" height="50px;"></canvas>
</div></div>
<script type="text/javascript">
var oilCanvas = document.getElementById("oilChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 14;

var oilData = {
    labels: <?php echo json_encode($etiquetas) ?>,
    datasets: [
        {
            data:<?php echo json_encode($datosVentas) ?>,
            backgroundColor: [
                "#FF6384",
                "#63FF84",
                "#84FF63",
                "#8463FF",
                "#6384FF"
            ],
            borderColor: "black",
            borderWidth: 2
        }]
};

var chartOptions = {
  rotation: -Math.PI,
  cutoutPercentage: 30,
  circumference: Math.PI,
  legend: {
    position: 'left'
  },
  animation: {
    animateRotate: false,
    animateScale: true
  }
};

var pieChart = new Chart(oilCanvas, {
  type: 'doughnut',
  data: oilData,
  options: chartOptions
});
</script>