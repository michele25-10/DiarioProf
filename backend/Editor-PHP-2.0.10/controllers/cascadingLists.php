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


// Example PHP implementation used for the cascadingLists.html example

Editor::inst( $db, 'team' )
	->field(
		Field::inst( 'team.name' ),
		Field::inst( 'team.continent' )
            ->options( Options::inst()
                ->table( 'continent' )
                ->value( 'id' )
                ->label( 'name' )
            ),
		Field::inst( 'continent.name' ),
		Field::inst( 'team.country' )
            ->options( Options::inst()
                ->table( 'country' )
                ->value( 'id' )
                ->label( 'name' )
            ),
		Field::inst( 'country.name' )
	)
	->leftJoin( 'continent', 'continent.id', '=', 'team.continent' )
	->leftJoin( 'country',   'country.id',   '=', 'team.country' )
	->process($_POST)
	->json();
