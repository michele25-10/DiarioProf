<?php
function getArchieveDocente()
{
    $url = 'http://localhost/DiarioProf/backend/API/docente/getArchieveDocente.php';

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $doc_data = $decode_data;
        $doc_arr = array();
        if (!empty($doc_data)) {
            foreach ($doc_data as $doc) {
                $doc_record = array(
                    'CF' => $doc['CF'],
                    'nome' => $doc['nome'],
                    'cognome' => $doc['cognome'],
                    'telefono' => $doc['telefono']
                );
                array_push($doc_arr, $doc_record);
            }
            return $doc_arr;
        }
    } else {
        return -1;
    }
}
