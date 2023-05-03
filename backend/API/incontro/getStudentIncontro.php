<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../COMMON/connect.php';
include_once dirname(__FILE__) . '/../../MODEL/incontro.php';

if (!isset($_GET['data']) || ($data = explode("?data=", $_SERVER['REQUEST_URI'])[1]) == null){
    http_response_code(400);
    echo json_encode(["message" => "Non ci sono abbastanza campi per la ricerca"]);
    die();
}

$dtbase = new Database();
$conn = $dtbase->connect();

$incontro = new Incontro($conn);
$array = explode("%20", $data);
$date = $array[0];
$ora = $array[1];
$query = $incontro->getStudentsIncontro($date,$ora);
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $incs_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $inc_arr = array(
            'nome' => $nome,
            'cognome' => $cognome,
        );
        array_push($incs_arr, $inc_arr);
    }
    http_response_code(200);
    echo (json_encode($incs_arr, JSON_PRETTY_PRINT));
} else {
    echo json_encode(-1);
}


$conn->close();
die();