<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../COMMON/connect.php';
include_once dirname(__FILE__) . '/../../MODEL/corso.php';

if (!isset($_GET['type']) || ($type = explode("?type=", $_SERVER['REQUEST_URI'])[1]) == null) {
    http_response_code(400);
    echo json_encode(["message" => "Non ci sono abbastanza campi per la ricerca"]);
    die();
}

$dtbase = new Database();
$conn = $dtbase->connect();

$league = new Corso($conn);
$query = $league->getNomeCorsoMax($type);
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $counts_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $count_arr = array(
            'count' => $nome_corso,
        );
        array_push($counts_arr, $count_arr);
    }
    http_response_code(200);
    echo (json_encode($counts_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode("-1");
}

$conn->close();
die();
