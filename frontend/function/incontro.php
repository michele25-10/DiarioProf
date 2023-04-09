<?php
function getArchieveIncontri()
{
    $url = 'http://localhost/DiarioProf/backend/API/incontro/getArchieveIncontri.php';

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $inc_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $incontri) {
                $incontri_record = array(
                    'id' => $incontri['id'],
                    'id_corso' => $incontri['id_corso'],
                    'data_inizio' => $incontri['data_inizio'],
                    'note' => $incontri['note'],
                );
                array_push($inc_arr, $incontri_record);
            }
            return $inc_arr;
        }
    } else {
        return -1;
    }
}
