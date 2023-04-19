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

function addDocente($data){
    $url = 'http://localhost/DiarioProf/backend/API/docente/addDocente.php';

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

    if ($response->message == "aggiunto") //response == aggiunto vuol dire sessione senza errori
    {
        return 1;
    } else {
        return -1;
    }
}
