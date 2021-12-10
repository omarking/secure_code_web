<?php session_start();
include './master.php';
?>
<div id="masterPrincipal">
        <div id="masterFormDetalleAlerta">
<div>

<?php
// Valores con PHP. Estos podrían venir de una base de datos o de cualquier lugar del servidor
$etiquetas = [];
$datosVentas = [];
require_once '../Model/report_conection.php';
$sql = "SELECT HOUR(aler_fecha) as HORA, count(aler_fecha) as TOTAL from alerta_emision group by HORA order by  HORA asc ;

"; // Consulta SQL
$query = $con->query($sql); // Ejecutar la consulta SQL
$data = array(); // Array donde vamos a guardar los datos
while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
    $data[]=$r; // Guardar los resultados en la variable $data
}
 foreach($data as $d):        
  $mes=$d->HORA;
  if($mes==0){
  $ms="00:00"; 
}
if($mes==1){
  $ms="01:00"; 
}
if($mes==2){
  $ms="02:00"; 
}
if($mes==3){
  $ms="03:00"; 
}
if($mes==4){
  $ms="04:00"; 
}
if($mes==5){
$ms="05:00"; 
}
if($mes==6){
$ms="06:00"; 
}
if($mes==7){
$ms="07:00"; 
}
if($mes==8){
$ms="08:00"; 
}
if($mes==9){
$ms="09:00"; 
}
if($mes==10){
$ms="10:00"; 
}
if($mes==11){
$ms="11:00"; 
}if($mes==12){
  $ms="12:00"; 
  }
if($mes==13){
$ms="13:00"; 
}
if($mes==14){
  $ms="14:00"; 
  }
if($mes==15){
$ms="15:00"; 
}
if($mes==16){
  $ms="16:00"; 
  }
if($mes==17){
$ms="17:00"; 
}
if($mes==18){
  $ms="18:00"; 
  }
if($mes==19){
$ms="19:00"; 
}
if($mes==20){
  $ms="20:00"; 
  }
if($mes==21){
$ms="21:00"; 
}
if($mes==22){
  $ms="22:00"; 
  }
if($mes==23){
$ms="23:00"; 
}





array_push($etiquetas, $ms);
array_push($datosVentas, $d->TOTAL);
//foreach($etiquetas as $va): echo  $va;  endforeach;
endforeach;
?>


    <!-- Importar chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<body>
    <div id="masterPrincipal">
        <div id="masterFormDetalleAlerta">
    <h1 style="text-align: center;">REPORTES ALERTAS POR HORA</h1><br>
    <canvas id="grafica" style="width: 150px;" height="50px;" ></canvas>
    <script type="text/javascript">
        // Obtener una referencia al elemento canvas del DOM
        const $grafica = document.querySelector("#grafica");
        // Pasaamos las etiquetas desde PHP
       
const etiquetas = <?php echo json_encode($etiquetas) ?>;

        // Podemos tener varios conjuntos de datos. Comencemos con uno
        const datosAlertas = {
            label: "ALERTAS POR HORA",
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
                  datosAlertas,
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
                width: 250,
        height: 350,
            }
        });
    </script>
</body>
  </div>
</div>
        
    
            </div></div></div>