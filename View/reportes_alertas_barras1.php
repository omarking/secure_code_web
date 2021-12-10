<?php session_start();
include './master.php';
?>
    <div id="masterPrincipal">
        <div id="masterFormDetalleAlerta">
<div> <?php
  require_once '../Model/report_conection.php';
$sql = "SELECT t2.tipoaler_descripcion as ALERTA, count(t2.tipoaler_descripcion)as TOTAL from alerta_emision as t1 inner join 
tipo_alerta as t2 on t1.idtipo_alerta=t2.idtipo_alerta group by ALERTA order by TOTAL ;
"; // Consulta SQL
$query = $con->query($sql); // Ejecutar la consulta SQL
$data = array(); // Array donde vamos a guardar los datos
while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
    $data[]=$r; // Guardar los resultados en la variable $data
}?>
    <title>Reporte de barras</title>
    <script src="chart.min.js"></script>
<br><h1 style="text-align: center;">REPORTE DE ATENCION DE TIPOS DE ALERTAS</h1><br><br><br>
<canvas id="chart1" style="width:50%;" height="80%"></canvas>
<script>
var ctx = document.getElementById("chart1");
var data = {
  labels: [ 
        <?php foreach($data as $d):          
        $ms=$d->ALERTA;
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
        },
        
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
        </div></div>
