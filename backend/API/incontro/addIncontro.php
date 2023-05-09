<?php
require("../../COMMON/connect.php");
require("../../MODEL/incontro.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->id_corso) || empty($data->data_inizio) || empty($data->id_aula)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();

$incontro = new Incontro($conn);

$query = $incontro->addIncontro($data->id_corso, $data->data_inizio, $data->id_aula);
$result = $conn->query($query);

if ($result != false) {
    http_response_code(200);
    echo json_encode(["message" => true]);
} else {
    http_response_code(401);
    echo json_encode(["message" => false]);
}

die();
