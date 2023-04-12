<?php

// DataTables PHP library
include( "../lib/DataTables.php" );

$values = $_REQUEST['values']['team.continent'];
if (! $values) {
    echo json_encode( [] );
    return;
}

$countries = $db
    ->select( 'country', ['id as value', 'name as label'], ['continent' => $_REQUEST['values']['team.continent']] )
    ->fetchAll();

echo json_encode( [
    'options' => [
        'team.country' => $countries
    ]
] );
