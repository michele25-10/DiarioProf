<?php
function getArchiveCorsi()
{
    $url = 'http://localhost/DiarioProf/backend/API/corso/getArchieveCorsi.php';

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $corsi_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $corsi) {
                $corsi_record = array(
                    'id' => $corsi['id'],
                    'tipologia' => $corsi['tipologia'],
                    'id_quadrimestre' => $corsi['id_quadrimestre'],
                    'id_docente' => $corsi['id_docente'],
                    'id_tutor' => $corsi['id_tutor'],
                    'materia' => $corsi['materia'],
                    'data_inizio' => $corsi['data_inizio'],
                    'data_fine' => $corsi['data_fine'],
                    'nome_corso' => $corsi['nome_corso'],
                    'sede' => $corsi['sede'],
                );
                array_push($corsi_arr, $corsi_record);
            }
            return $corsi_arr;
        }
    } else {
        return -1;
    }
}
