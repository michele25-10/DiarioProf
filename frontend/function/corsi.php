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

function countCorsoByType($tipologia)
{
    $url = 'http://localhost/DiarioProf/backend/API/corso/countCorsiByType.php?type=' . $tipologia;

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $corsi_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $corsi) {
                $corsi_record = array(
                    'count' => $corsi['count'],
                );
                array_push($corsi_arr, $corsi_record);
            }
            return $corsi_arr[0]['count'];
        }
    } else {
        return -1;
    }
}

function addCorso($data)
{
    $url = 'http://localhost/DiarioProf/backend/API/corso/addCorso.php';

    $curl = curl_init($url); //inizializza una nuova sessione di cUrl
    //Curl contiene il return del curl_init 

    curl_setopt($curl, CURLOPT_URL, $url); // setta l'url 
    curl_setopt($curl, CURLOPT_POST, true); // specifica che è una post request
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ritorna il risultato come stringa


    $headers = array(
        "Content-Type: application/json",
        "Content-Lenght: 0",
    );


    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // setta gli headers della request

    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    $responseJson = curl_exec($curl); //eseguo

    curl_close($curl); //chiudo sessione

    $response = json_decode($responseJson); //decodifico la response dal json

    if ($response->message == true) //response == true vuol dire sessione senza errori
    {
        return 1;
    } else {
        return -1;
    }
}

function getCorsiByType($type)
{
    $url = 'http://localhost/DiarioProf/backend/API/corso/getCorsiByType.php?type=' . $type;

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

function getCorsoByNomeCorso($nome_corso)
{
    $url = 'http://localhost/DiarioProf/backend/API/corso/getCorsoByNomeCorso.php?nome_corso=' . $nome_corso;

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $corsi_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $corsi) {
                $corsi_record = array(
                    'id' => $corsi['id'],
                );
                array_push($corsi_arr, $corsi_record);
            }
            return $corsi_arr[0]['id'];
        }
    } else {
        return -1;
    }
}

function getInfoCorsoDate($id)
{
    $url = 'http://localhost/DiarioProf/backend/API/corso/getInfoCorsoDate.php?id=' . $id;

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $corsi_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $corsi) {
                $corsi_record = array(
                    'data_inizio' => $corsi['data_inizio'],
                    'note' => $corsi['note'],
                    'aula' => $corsi['aula'],
                    'id_incontro' => $corsi['id'],
                );
                array_push($corsi_arr, $corsi_record);
            }
            return $corsi_arr;
        }
    } else {
        return -1;
    }
}

function getInfoCorsoStudent($id)
{
    $url = 'http://localhost/DiarioProf/backend/API/corso/getInfoCorsoStudent.php?id=' . $id;

    $json_data = file_get_contents($url);
    if ($json_data  == true) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $corsi_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $corsi) {
                $corsi_record = array(
                    'nome' => $corsi['nome'],
                    'cognome' => $corsi['cognome'],
                    'CF'  => $corsi['CF']
                );
                array_push($corsi_arr, $corsi_record);
            }
            return $corsi_arr;
        }
    } else {
        return -1;
    }
}

function updateCorso($data)
{
    $url = 'http://localhost/DiarioProf/backend/API/corso/updateCorso.php';

    $curl = curl_init($url); //inizializza una nuova sessione di cUrl
    //Curl contiene il return del curl_init 

    curl_setopt($curl, CURLOPT_URL, $url); // setta l'url 
    curl_setopt($curl, CURLOPT_POST, true); // specifica che è una post request
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ritorna il risultato come stringa


    $headers = array(
        "Content-Type: application/json",
        "Content-Lenght: 0",
    );


    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // setta gli headers della request

    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    $responseJson = curl_exec($curl); //eseguo

    curl_close($curl); //chiudo sessione

    $response = json_decode($responseJson); //decodifico la response dal json
    if ($response->message == true) //response == true vuol dire sessione senza errori
    {
        return 1;
    } else {
        return -1;
    }
}
function getArchiveCorsiStorico()
{
    $url = 'http://localhost/DiarioProf/backend/API/corso/getArchieveCorsiStorico.php';

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
function getStudentPresenze($id)
{
    $url = 'http://localhost/DiarioProf/backend/API/corso/getStudentPresenze.php?id=' . $id;

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $corsi_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $corsi) {
                $corsi_record = array(
                    'nome' => $corsi['nome'],
                    'cognome' => $corsi['cognome'],
                    'CF'  => $corsi['CF'],
                    'numero_presenze' => $corsi['numero_presenze'],
                );
                array_push($corsi_arr, $corsi_record);
            }
            return $corsi_arr;
        }
    } else {
        return -1;
    }
}

function getCorsiByTipologia($type)
{
    $url = 'http://localhost/DiarioProf/backend/API/corso/getCorsiByTipologia.php?type=' . $type;

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
