<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../COMMON/connect.php';
include_once dirname(__FILE__) . '/../../MODEL/presenze.php';

if (!isset($_GET['id_incontro']) || ($id_incontro = explode("?id_incontro=", $_SERVER['REQUEST_URI'])[1]) == null) {
    http_response_code(400);
    echo json_encode(["message" => "Non ci sono abbastanza campi per la ricerca"]);
    die();
}

$dtbase = new Database();
$conn = $dtbase->connect();

$pres = new Presenze($conn);
$query = $pres->checkRegistro($id_incontro);
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    echo json_encode("true");
} else {
    echo json_encode("false");
}


$conn->close();
die();
