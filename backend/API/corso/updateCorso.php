<?php
require("../../COMMON/connect.php");
require("../../MODEL/corso.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->id) || empty($data->id_quadrimestre) || empty($data->id_docente) || empty($data->id_tutor) || empty($data->data_inizio) || empty($data->data_fine) || empty($data->materia) || empty($data->sede)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();

$league = new Corso($conn);

$query = $league->updateCorso($data->id, $data->id_quadrimestre, $data->id_docente, $data->id_tutor, $data->data_inizio, $data->data_fine, $data->materia, $data->sede);
$result = $conn->query($query);

if ($result != false) {
    http_response_code(200);
    echo json_encode(["message" => true]);
} else {
    http_response_code(401);
    echo json_encode(["message" => false]);
}

die();