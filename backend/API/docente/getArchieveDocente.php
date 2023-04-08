<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../COMMON/connect.php';
include_once dirname(__FILE__) . '/../../MODEL/docente.php';

$dtbase = new Database();
$conn = $dtbase->connect();

$doc = new Docente($conn);
$query = $doc->getArchieveDocente();
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $docs_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $doc_arr = array(
            'CF' => $CF,
            'nome' => $nome,
            'cognome' => $cognome,
            'telefono' => $telefono,
        );
        array_push($docs_arr, $doc_arr);
    }
    http_response_code(200);
    echo (json_encode($docs_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode("-1");
}


$conn->close();
die();
