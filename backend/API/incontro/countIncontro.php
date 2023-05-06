<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../COMMON/connect.php';
include_once dirname(__FILE__) . '/../../MODEL/incontro.php';

$dtbase = new Database();
$conn = $dtbase->connect();

$incontro = new Incontro($conn);
$query = $incontro->countIncontro();
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $incs_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $inc_arr = array(
            'partecipanti' => $partecipanti,
            'data' => $data,
            'nome_corso' =>$nome_corso,
        );
        array_push($incs_arr, $inc_arr);
    }
    http_response_code(200);
    echo (json_encode($incs_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode("-1");
}


$conn->close();
die();