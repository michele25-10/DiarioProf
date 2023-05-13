<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../COMMON/connect.php';
include_once dirname(__FILE__) . '/../../MODEL/corso.php';

$dtbase = new Database();
$conn = $dtbase->connect();

$league = new Corso($conn);
$query = $league->getArchiveCorsoStorico();
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $leagues_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $league_arr = array(
            'id' => $id,
            'tipologia' => $tipologia,
            'id_quadrimestre' => $id_quadrimestre,
            'id_docente' => $id_docente,
            'id_tutor' => $id_tutor,
            'materia' => $materia,
            'data_inizio' => $data_inizio,
            'data_fine' => $data_fine,
            'nome_corso' => $nome_corso,
            'sede' => $sede,
        );
        array_push($leagues_arr, $league_arr);
    }
    http_response_code(200);
    echo (json_encode($leagues_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode("-1");
}


$conn->close();
die();
