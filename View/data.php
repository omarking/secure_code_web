<?php
session_start();
include 'master.php';

header('Content-Type: application/json');
$con = new mysqli("localhost","root","12345","locateme2");


    $data_points = array();
    $result = mysqli_query($con, "SELECT MONTH(aler_fecha) as mes, Year(aler_fecha)as 'año', COUNT(*) as Total FROM alerta_emision WHERE 
    aler_fecha BETWEEN '2018-01-01' AND '2030-12-31' GROUP BY mes;"); 
    while ($row = mysqli_fetch_array($result)) {
        $point = array("mesX" => $row['año'], "TotalY" => $row['Total']);
        array_push($data_points, $point);
    }
    echo json_encode($data_points);


?>