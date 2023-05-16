<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../COMMON/connect.php';
include_once dirname(__FILE__) . '/../../MODEL/quadrimestre.php';

$dtbase = new Database();
$conn = $dtbase->connect();

$quad = new Quadrimestre($conn);
$query = $quad->getArchiveQuadrimestre();
$result = $conn->query($query);
if (mysqli_num_rows($result) > 0) {
    $quads_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $quad_arr = array(
            'id' => $id,
            'data_inizio' => $data_inizio,
            'data_fine' => $data_fine
        );
        array_push($quads_arr, $quad_arr);
    }
    http_response_code(200);
    echo (json_encode($quads_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode("-1");
}


$conn->close();
die();
