<?php
require("../../COMMON/connect.php");
require("../../MODEL/iscrizione.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->id_corso) || empty($data->id_alunno)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();

$iscrizione = new Iscrizione($conn);

$query = $iscrizione->addAlunnoToCorso($data->id_corso, $data->id_alunno);
$result = $conn->query($query);

if ($result != false) {
    http_response_code(200);
    echo json_encode(["message" => true]);
} else {
    http_response_code(401);
    echo json_encode(["message" => false]);
}

die();
