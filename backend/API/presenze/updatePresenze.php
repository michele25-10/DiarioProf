<?php
require("../../COMMON/connect.php");
require("../../MODEL/presenze.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

$db = new Database();
$conn = $db->connect();

$pres = new Presenze($conn);

$query = $pres->updatePresenze($row->id_incontro, $row->id_alunno, $row->status);
$result = $conn->query($query);

if ($result == false) {
    http_response_code(401);
    echo json_encode(["message" => false]);
    die();
}
if ($row->status == 0) {
    $query = $pres->incrementPresenza($row->id_alunno, $row->id_incontro);
    $res = $conn->query($query);
    if ($res == false) {
        http_response_code(401);
        echo json_encode(["message" => false]);
        die();
    }
}
if ($row->status == 1) {
    if ($result == false) {
        $query = $pres->decrementPresenza($row->id_alunno, $row->id_incontro);
        $res = $conn->query($query);

        http_response_code(401);
        echo json_encode(["message" => false]);
        die();
    }
}
die();
