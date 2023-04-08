<?php
function getArchiveQuadrimestre()
{
    $url = 'http://localhost/DiarioProf/backend/API/quadrimestre/getArchieveQuadrimestre.php';

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $quad_data = $decode_data;
        $quad_arr = array();
        if (!empty($quad_data)) {
            foreach ($quad_data as $quad) {
                $quad_record = array(
                    'id' => $quad['id'],
                    'data_inizio' => $quad['data_inizio'],
                    'data_fine' => $quad['data_fine'],
                );
                array_push($quad_arr, $quad_record);
            }
            return $quad_arr;
        }
    } else {
        return -1;
    }
}
