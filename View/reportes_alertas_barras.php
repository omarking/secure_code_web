<?php session_start();
include './master.php';
?>
<script language="Javascript">
	function imprSelec(nombre) {
	  var ficha = document.getElementById('chart1');
	  var ventimp = window.open(' ', 'popimpr');
	  ventimp.document.write( ficha.innerHTML );
	  ventimp.document.close();
	  ventimp.print( );
	  ventimp.close();
	}
	</script>
    <div id="masterPrincipal">
        <div id="masterFormDetalleAlerta">

<div> <?php
  require_once '../Model/report_conection.php';
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
<br><h1 style="text-align: center;">REPORTE DE ATENCION DE ENTIDADES DE EMERGENCIA</h1><br><br><br>
<canvas id="chart1" style="width:50%;" height="80%"></canvas>
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

</div></div>
  </div>
