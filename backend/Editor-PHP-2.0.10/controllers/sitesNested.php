<?php

// DataTables PHP library
include( "../lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;

Editor::inst( $db, 'sites' )
    ->fields(
        Field::inst( 'id' )->set( false ),
        Field::inst( 'name' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'continent' )->validator( 'Validate::notEmpty' )
    )
    ->process( $_POST )
    ->json();
