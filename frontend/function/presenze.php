<?php
function addPresenze($data)
{
    $url = 'http://localhost/DiarioProf/backend/API/presenze/addPresenze.php';

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

function checkRegistro($id_incontro)
{
    $url = 'http://localhost/DiarioProf/backend/API/presenze/checkRegistro.php?id_incontro=' . $id_incontro;

    $json_data = file_get_contents($url);

    $jsond_decode = json_decode($json_data);

    return $jsond_decode;
}

function getPresenzeByIncontro($incontro)
{
    $url = 'http://localhost/DiarioProf/backend/API/presenze/getPresenzeByIncontro.php?id_incontro=' . $incontro;

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $pres_data = $decode_data;
        $pres_arr = array();
        if (!empty($pres_data)) {
            foreach ($pres_data as $pres) {
                $pres_record = array(
                    'id' => $pres['id'],
                    'nome' => $pres['nome'],
                    'cognome' => $pres['cognome'],
                    'status' => $pres['status'],
                );
                array_push($pres_arr, $pres_record);
            }
            return $pres_arr;
        }
    } else {
        return -1;
    }
}

function updatePresenze($data)
{
    $url = 'http://localhost/DiarioProf/backend/API/presenze/updatePresenze.php';

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

    if ($response->message == false) //response == true vuol dire sessione senza errori
    {
        return -1;
    } else {
        return 1;
    }
}
