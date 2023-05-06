<?php
require("../../COMMON/connect.php");
require("../../MODEL/presenze.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

$db = new Database();
$conn = $db->connect();

$pres = new Presenze($conn);

$query = $pres->updatePresenze($data->id, $data->status);
$result = $conn->query($query);

if ($result == false) {
    http_response_code(401);
    echo json_encode(["message" => false]);
    die();
}
if ($data->status == 0) {
    $query = $pres->incrementPresenza($data->id_alunno, $data->id_incontro);
    $res = $conn->query($query);
    if ($res == false) {
        http_response_code(401);
        echo json_encode(["message" => false]);
        die();
    }
    if ($res == true) {
        http_response_code(201);
        echo json_encode(["message" => true]);
        die();
    }
}
if ($data->status == 1) {
    $query = $pres->decrementPresenza($data->id_alunno, $data->id_incontro);
    $res = $conn->query($query);
    if ($result == false) {
        http_response_code(401);
        echo json_encode(["message" => false]);
        die();
    }
    if ($res == true) {
        http_response_code(201);
        echo json_encode(["message" => true]);
        die();
    }
}
die();
