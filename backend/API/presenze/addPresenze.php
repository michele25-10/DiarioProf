<?php
require("../../COMMON/connect.php");
require("../../MODEL/presenze.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

$db = new Database();
$conn = $db->connect();

$pres = new Presenze($conn);
foreach ($data as $row) {

    //Check se fare un edit o un update
    $sql = "SELECT p.id
    FROM diario.presenze p
    WHERE p.id_incontro = '" . $row->id_incontro . "' AND p.id_alunno = '" . $row->id_alunno . "';";

    $check = $conn->query($sql);

    if (mysqli_num_rows($check) > 0) {
        $query = $pres->updatePresenze($row->id_incontro, $row->id_alunno, $row->status);
        $result = $conn->query($query);
        if ($result == false) {
            http_response_code(401);
            echo json_encode(["message" => false]);
            die();
        }
    } else {
        $query = $pres->addPresenze($row->id_incontro, $row->id_alunno, $row->status);
        $result = $conn->query($query);
        if ($result == false) {
            http_response_code(401);
            echo json_encode(["message" => false]);
            die();
        }
    }
}
if ($result != false) {
    http_response_code(200);
    echo json_encode(["message" => true]);
}

die();
