<?php
function getArchieveAlunni()
{
    $url = 'http://localhost/DiarioProf/backend/API/alunno/getArchieveAlunni.php';

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $al_data = $decode_data;
        $al_arr = array();
        if (!empty($al_data)) {
            foreach ($al_data as $al) {
                $al_record = array(
                    'SIDI' => $al['SIDI'],
                    'CF' => $al['CF'],
                    'nome' => $al['nome'],
                    'cognome' => $al['cognome'],
                    'telefono' => $al['telefono']
                );
                array_push($al_arr, $al_record);
            }
            return $al_arr;
        }
    } else {
        return -1;
    }
}

function getStudentByCorsoName($nome_corso)
{
    $url = 'http://localhost/DiarioProf/backend/API/alunno/getStudentByCorsoName.php?nome_corso=' . $nome_corso;

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $al_data = $decode_data;
        $al_arr = array();
        if (!empty($al_data)) {
            foreach ($al_data as $al) {
                $al_record = array(
                    'CF' => $al['CF'],
                    'nome' => $al['nome'],
                    'cognome' => $al['cognome'],
                );
                array_push($al_arr, $al_record);
            }
            return $al_arr;
        }
    } else {
        return -1;
    }
}
