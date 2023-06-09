<?php

function addAlunnoToCorso($id_corso, $id_alunno)
{
    $url = 'http://localhost/DiarioProf/backend/API/iscrizione/addAlunnoToCorso.php';

    $data = array(
        "id_corso" => $id_corso,
        "id_alunno" => $id_alunno,
    );

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
