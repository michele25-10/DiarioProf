<?php

/*
 * Example PHP implementation used for the index.html example
 */

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
	DataTables\Editor\ValidateOptions,
	DataTables\Editor\SearchPaneOptions;

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'users' )
	->fields(
		Field::inst( 'first_name' )
			->validator( Validate::notEmpty( ValidateOptions::inst()
				->message( 'A first name is required' )	
			) ),
		Field::inst( 'last_name' )
			->validator( Validate::notEmpty( ValidateOptions::inst()
				->message( 'A last name is required' )	
			) ),
		Field::inst( 'city' ),
		Field::inst( 'description' )
	)
	->process( $_POST )
	->json();
