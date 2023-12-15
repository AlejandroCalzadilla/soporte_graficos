<?php

$mysqli = new mysqli("localhost", "root", "ale12345678", "chat");

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}


$fechaInicio = $_GET['fechaInicio']; // Obtén la fecha de inicio desde la URL
$fechaFin = $_GET['fechaFin']; // Obtén la fecha de fin desde la URL

// Consultas por día con filtro de fechas
$result = $mysqli->query("SELECT DATE(fecha) as fecha, COUNT(*) as cantidad
    FROM respuesta
    WHERE sentimiento = 'negativo' AND fecha BETWEEN '$fechaInicio' AND '$fechaFin'
    GROUP BY fecha
    ORDER BY fecha");

$data1 = array();
while ($row1 = $result->fetch_assoc()) {
    $data1[] = $row1;
}

$result2 = $mysqli->query("SELECT DATE(fecha) as fecha, COUNT(*) as cantidad
    FROM respuesta
    WHERE sentimiento = 'positivo' AND fecha BETWEEN '$fechaInicio' AND '$fechaFin'
    GROUP BY fecha
    ORDER BY fecha");

$data2 = array();
while ($row2 = $result2->fetch_assoc()) {
    $data2[] = $row2;
}

$result3 = $mysqli->query("SELECT DATE(fecha) as fecha, COUNT(*) as cantidad
    FROM respuesta
    WHERE sentimiento = 'neutro' AND fecha BETWEEN '$fechaInicio' AND '$fechaFin'
    GROUP BY fecha
    ORDER BY fecha");

$data3 = array();
while ($row3 = $result3->fetch_assoc()) {
    $data3[] = $row3;
}
$result4 = $mysqli->query("SELECT DATE(fecha) as fecha, COUNT(*) as cantidad
    FROM respuesta
    WHERE sentimiento = 'negativo'
    GROUP BY month(fecha)
     ORDER BY month(fecha)");

    $data4 = array();
    while ($row4 = $result4->fetch_assoc()) {
        $data4[] = $row4;
    }
    $result5 = $mysqli->query("SELECT DATE(fecha) as fecha, COUNT(*) as cantidad
    FROM respuesta
    WHERE sentimiento = 'positivo'
    GROUP BY month(fecha)
     ORDER BY month(fecha)");

    $data5= array();
    while ($row5 = $result5->fetch_assoc()) {
        $data5[] = $row5;
    }
    $result6 = $mysqli->query("SELECT DATE(fecha) as fecha, COUNT(*) as cantidad
    FROM respuesta
    WHERE sentimiento = 'neutro'
    GROUP BY month(fecha)
     ORDER BY month(fecha)");

    $data6= array();
    while ($row6 = $result6->fetch_assoc()) {
        $data6[] = $row6;
    }


$mysqli->close();


// Llamar a las funciones y obtener los resultados como JSON
$datosCombinados = array(
    "negativosdia" => $data1,
    "positivosdia" => $data2,
    "neutrosdia"=>$data3,
    "negativosmes" => $data4,
    "positivosmes" => $data5,
    "neutrosmes"=>$data6,
    
);

// Envía la respuesta JSON combinada
echo json_encode($datosCombinados);


?>
