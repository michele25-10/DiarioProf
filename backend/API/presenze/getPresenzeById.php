<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../COMMON/connect.php';
include_once dirname(__FILE__) . '/../../MODEL/presenze.php';

if (!isset($_GET['id']) || ($id = explode("?id=", $_SERVER['REQUEST_URI'])[1]) == null) {
    http_response_code(400);
    echo json_encode(["message" => "Non ci sono abbastanza campi per la ricerca"]);
    die();
}

$dtbase = new Database();
$conn = $dtbase->connect();

$pres = new Presenze($conn);
$query = $pres->getPresenzeById($id);
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $inc_arr = array(
            'nome' => $nome,
            'cognome' => $cognome,
            'CF' => $CF,
            'id_incontro' => $id_incontro,
        );
    }
    http_response_code(200);
    echo (json_encode($inc_arr, JSON_PRETTY_PRINT));
} else {
    echo json_encode(-1);
}


$conn->close();
die();
