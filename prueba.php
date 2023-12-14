<?php
/*$mysqli = new mysqli("localhost", "root", "ale12345678", "chat");

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT id, sentimiento, fecha FROM respuesta");

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Convertir fechas a formato legible para JavaScript
foreach ($data as &$row) {
    $row['fecha'] = date("Y-m-d H:i:s", strtotime($row['fecha']));
}

echo json_encode($data);

$mysqli->close();
?>*/


$mysqli = new mysqli("localhost", "root", "ale12345678", "chat");

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

//$result = $mysqli->query("SELECT DATE(fecha) as fecha, COUNT(*) as cantidad, AVG(CASE WHEN sentimiento = 'negativo' THEN 1 ELSE 0 END) as promedio_negativo FROM respuesta GROUP BY fecha");
//$result = $mysqli->query("SELECT DATE(fecha) as fecha, COUNT(*) as cantidad FROM respuesta WHERE sentimiento = 'negativo' GROUP BY fecha");
//$result = $mysqli->query("SELECT  fecha, COUNT(sentimiento) as cantidad FROM respuesta WHERE sentimiento = 'negativo' group by fecha ");
$result = $mysqli->query("SELECT DATE(fecha) as fecha, COUNT(*) as cantidad
FROM respuesta
WHERE sentimiento = 'negativo'
GROUP BY fecha
ORDER BY fecha");

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);



$mysqli->close();




?>
