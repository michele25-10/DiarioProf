<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../COMMON/connect.php';
include_once dirname(__FILE__) . '/../../MODEL/alunno.php';

$dtbase = new Database();
$conn = $dtbase->connect();

$alunno = new Alunno($conn);
$query = $alunno->getArchieveAlunni();
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $als_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $al_arr = array(
            'SIDI' => $SIDI,
            'CF' => $CF,
            'nome' => $nome,
            'cognome' => $cognome,
            'telefono' => $telefono,
        );
        array_push($als_arr, $al_arr);
    }
    http_response_code(200);
    echo (json_encode($als_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode("-1");
}


$conn->close();
die();
