<?php
require("../../COMMON/connect.php");
require("../../MODEL/corso.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->tipologia) || empty($data->id_quadrimestre) || empty($data->id_docente) || empty($data->id_tutor) || empty($data->materia) || empty($data->data_inizio) || empty($data->data_fine) || empty($data->nome_corso) || empty($data->sede)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();

$league = new Corso($conn);

$query = $league->addCorso($data->tipologia, $data->id_quadrimestre, $data->id_docente, $data->id_tutor, $data->materia, $data->data_inizio, $data->data_fine, $data->nome_corso, $data->sede);
$result = $conn->query($query);

if ($result != false) {
    http_response_code(200);
    echo json_encode(["message" => true]);
} else {
    http_response_code(401);
    echo json_encode(["message" => false]);
}

die();
