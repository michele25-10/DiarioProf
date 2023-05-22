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
    if ($json_data == true) {
        $decode_data = json_decode($json_data, $assoc = true);
        $al_data = $decode_data;
        $al_arr = array();
        if (!empty($al_data)) {
            foreach ($al_data as $al) {
                $al_record = array(
                    'CF' => $al['CF'],
                    'nome' => $al['nome'],
                    'cognome' => $al['cognome'],
                    'tipologia' => $al['tipologia'],
                );
                array_push($al_arr, $al_record);
            }
            return $al_arr;
        }
    } else {
        return -1;
    }
}
function updateAlunno($data)
{
    $url = 'http://localhost/DiarioProf/backend/API/alunno/updateAlunno.php';

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
