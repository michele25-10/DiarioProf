<?php
require("../../COMMON/connect.php");
require("../../MODEL/docente.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->CF) || empty($data->nome) || empty($data->cognome) || empty($data->telefono)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();

$league = new Docente($conn);

$query = $league->addDocente($data->CF, $data->nome, $data->cognome, $data->telefono);
$result = $conn->query($query);

if ($result != false) {
    http_response_code(200);
    echo json_encode(["message" => "aggiunto"]);
} else {
    http_response_code(401);
    echo json_encode(["message" => false]);
}
die();
